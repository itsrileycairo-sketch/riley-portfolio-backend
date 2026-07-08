<?php
namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller {
    public function index() { return response()->json(Blog::latest()->get(), 200); }
    public function store(Request $request) {
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blogs', 'public');
            $data['image'] = url('storage/' . $path);
        }
        return response()->json(['message' => 'Blog ditambah!', 'data' => Blog::create($data)], 201);
    }
    public function update(Request $request, $id) {
        $blog = Blog::find($id);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            if ($blog->image) Storage::disk('public')->delete(str_replace(url('storage') . '/', '', $blog->image));
            $path = $request->file('image')->store('blogs', 'public');
            $data['image'] = url('storage/' . $path);
        }
        $blog->update($data);
        return response()->json(['message' => 'Blog diupdate!', 'data' => $blog], 200);
    }
    public function destroy($id) {
        $blog = Blog::find($id);
        if ($blog && $blog->image) Storage::disk('public')->delete(str_replace(url('storage') . '/', '', $blog->image));
        $blog->delete();
        return response()->json(['message' => 'Blog dihapus!'], 200);
    }
}