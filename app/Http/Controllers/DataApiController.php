<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataApiController extends Controller
{
    // Mendapatkan semua data
    public function index()
    {
        $data = Data::all();
        if (!$data) {
             return response()->json(['message' => 'API is working']);
        }
        return response()->json(Data::all());
    }

    // Mendapatkan satu data berdasarkan ID
    public function show($id)
    {
        $data = Data::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($data, 200);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'photo' => 'nullable|image|max:2048', // Validasi file photo jika ada
        ]);

        $data = new Data();
        $data->name = $validated['name'];
        $data->address = $validated['address'];

        // Menyimpan file photo jika ada
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('photos', 'public');
        }

        $data->save();

        return response()->json($data, 201);
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $data = Data::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data->name = $validated['name'];
        $data->address = $validated['address'];

        // Mengupdate file photo jika ada
         if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($data->photo && file_exists(storage_path('app/public/' . $data->photo))) {
                unlink(storage_path('app/public/' . $data->photo));  // Hapus foto lama
            }
            // Simpan foto baru
            $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $data->save();

        return response()->json($data, 200);
    }

    // Menghapus data
    public function destroy($id)
    {
        $data = Data::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Hapus photo jika ada
        if ($data->photo && file_exists(storage_path('app/public/' . $data->photo))) {
            unlink(storage_path('app/public/' . $data->photo));  // Hapus foto dari storage
        }

        $data->delete();
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
}

