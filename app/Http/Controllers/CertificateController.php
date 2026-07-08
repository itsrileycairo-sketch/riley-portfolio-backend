<?php
namespace App\Http\Controllers;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller {
    public function index() { return response()->json(Certificate::latest()->get(), 200); }
    public function store(Request $request) {
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('certificates', 'public');
            $data['image'] = url('storage/' . $path);
        }
        return response()->json(['message' => 'Sertifikat ditambah!', 'data' => Certificate::create($data)], 201);
    }
    public function update(Request $request, $id) {
        $cert = Certificate::find($id);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            if ($cert->image) Storage::disk('public')->delete(str_replace(url('storage') . '/', '', $cert->image));
            $path = $request->file('image')->store('certificates', 'public');
            $data['image'] = url('storage/' . $path);
        }
        $cert->update($data);
        return response()->json(['message' => 'Sertifikat diupdate!', 'data' => $cert], 200);
    }
    public function destroy($id) {
        $cert = Certificate::find($id);
        if ($cert && $cert->image) Storage::disk('public')->delete(str_replace(url('storage') . '/', '', $cert->image));
        $cert->delete();
        return response()->json(['message' => 'Sertifikat dihapus!'], 200);
    }
}