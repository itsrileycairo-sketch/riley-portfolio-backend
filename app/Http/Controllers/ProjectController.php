<?php
namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller {
    public function index() { return response()->json(Project::latest()->get(), 200); }

    public function store(Request $request) {
        $data = $request->except('image');

        // Jika ada file gambar yang diupload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $data['image'] = url('storage/' . $path); // Simpan URL penuh
        }

        if(isset($data['tech']) && !is_array($data['tech'])) {
            $data['tech'] = array_map('trim', explode(',', $data['tech']));
        }

        $project = Project::create($data);
        return response()->json(['message' => 'Project ditambah!', 'data' => $project], 201);
    }

    public function update(Request $request, $id) {
        $project = Project::find($id);
        if (!$project) return response()->json(['message' => 'Not found'], 404);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Hapus gambar lama agar storage tidak penuh
            if ($project->image) {
                $oldPath = str_replace(url('storage') . '/', '', $project->image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('projects', 'public');
            $data['image'] = url('storage/' . $path);
        }

        if(isset($data['tech']) && !is_array($data['tech'])) {
            $data['tech'] = array_map('trim', explode(',', $data['tech']));
        }

        $project->update($data);
        return response()->json(['message' => 'Project diupdate!', 'data' => $project], 200);
    }

    public function destroy($id) {
        $project = Project::find($id);
        if ($project) {
            if ($project->image) {
                $oldPath = str_replace(url('storage') . '/', '', $project->image);
                Storage::disk('public')->delete($oldPath);
            }
            $project->delete();
        }
        return response()->json(['message' => 'Data dihapus!'], 200);
    }
}