<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index() {
        return response()->json(Experience::latest()->get(), 200);
    }

    public function store(Request $request) {
        $request->validate([
            'role' => 'required|string',
            'company' => 'required|string',
            'date' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|array', // Harus array karena poin-poin
            'tech' => 'nullable|array',
        ]);
        
        $exp = Experience::create($request->all());
        return response()->json(['message' => 'Pengalaman berhasil ditambahkan!', 'data' => $exp], 201);
    }

    public function update(Request $request, $id) {
        $exp = Experience::find($id);
        if (!$exp) return response()->json(['message' => 'Data tidak ditemukan'], 404);
        
        $exp->update($request->all());
        return response()->json(['message' => 'Pengalaman diupdate!', 'data' => $exp], 200);
    }

    public function destroy($id) {
        $exp = Experience::find($id);
        if ($exp) $exp->delete();
        return response()->json(['message' => 'Data dihapus!'], 200);
    }
}