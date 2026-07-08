<?php
namespace App\Http\Controllers;
use App\Models\Gear;
use Illuminate\Http\Request;

class GearController extends Controller {
    public function index() { return response()->json(Gear::latest()->get(), 200); }
    public function store(Request $request) {
        $gear = Gear::create($request->all());
        return response()->json(['message' => 'Gear sukses ditambah!', 'data' => $gear], 201);
    }
    public function update(Request $request, $id) {
        $gear = Gear::find($id);
        if ($gear) $gear->update($request->all());
        return response()->json(['message' => 'Gear diupdate!', 'data' => $gear], 200);
    }
    public function destroy($id) {
        $gear = Gear::find($id);
        if ($gear) $gear->delete();
        return response()->json(['message' => 'Gear dihapus!'], 200);
    }
}