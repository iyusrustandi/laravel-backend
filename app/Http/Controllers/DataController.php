<?php

//app/Http/Controllers/DataController.php

namespace App\Http\Controllers;
use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    // Method untuk menampilkan daftar data
    public function index()
    {
      
        $data = Data::paginate(5); 
        return view('data.index', compact('data'));
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    // Asumsi model Data memiliki relasi dengan model Tag
    $data = Data::with('tags') // Sesuaikan dengan relasi yang ada, misalnya 'tags'
        ->where('name', 'like', "%{$query}%")
        ->orWhere('address', 'like', "%{$query}%")
        ->orWhereHas('tags', function($q) use ($query) {
            $q->where('name', 'like', "%{$query}%"); // Misalnya mencari berdasarkan nama tag
        })
        ->paginate(5); // Menggunakan paginasi dengan 5 hasil per halaman

    // Menambahkan query pencarian ke pagination links
    $data->appends(['query' => $query]);

    return view('data.index', compact('data'));
}

    // Method untuk menampilkan form tambah data
    public function create()
    {
        return view('data.create');
    }

    // Method untuk menyimpan data yang ditambahkan
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',  // Validasi opsional untuk foto
        ]);

        // Simpan file foto, jika ada
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
        }

        // Simpan data ke database
        $data = Data::create($validatedData);

        // Redirect ke halaman lain atau kembali ke index dengan pesan sukses
        return redirect()->route('data.index')->with('success', 'Data successfully added.');
    }

    public function edit($id)
    {
        $data = Data::findOrFail($id); // Fetch a single item, not a paginated result
        return view('data.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',  // Validasi opsional untuk foto
        ]);

        // Cari data yang akan diperbarui
        $data = Data::findOrFail($id);

        // Periksa apakah ada file foto yang diupload
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($data->photo && file_exists(storage_path('app/public/' . $data->photo))) {
                unlink(storage_path('app/public/' . $data->photo));  // Hapus foto lama
            }
            // Simpan foto baru
            $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
        }

        // Update data ke database
        $data->update($validatedData);

        // Redirect ke halaman lain atau kembali ke index dengan pesan sukses
        return redirect()->route('data.index')->with('success', 'Data successfully updated.');
    }

    public function destroy($id)
    {
        // Cari data yang akan dihapus
        $data = Data::findOrFail($id);

        // Hapus file foto jika ada
        if ($data->photo && file_exists(storage_path('app/public/' . $data->photo))) {
            unlink(storage_path('app/public/' . $data->photo));  // Hapus foto dari storage
        }

        // Hapus data dari database
        $data->delete();

        // Redirect ke halaman lain atau kembali ke index dengan pesan sukses
        return redirect()->route('data.index')->with('success', 'Data successfully deleted.');
    }


}
