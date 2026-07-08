<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller {
    // FUNGSI INI WAJIB ADA BIAR FRONTEND BISA BACA DATA
    public function index() {
        return response()->json(Setting::all(), 200);
    }

    public function store(Request $request) {
        foreach ($request->all() as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return response()->json(['message' => 'Pengaturan Beranda tersimpan!'], 200);
    }
}