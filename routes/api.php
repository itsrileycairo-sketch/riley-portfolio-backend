<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GearController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
|
*/

// --- 1. AUTH (login) ---
Route::post('/login', [AuthController::class, 'login']);

// --- 2. CHAT (public) ---
Route::post('/chat', function (Request $request) {
    $prompt = $request->input('message');

    $systemPrompt = "Kamu adalah AI Assistant eksklusif untuk web portofolio Nolan Fortino Ramadhany (Riley). Dia adalah mahasiswa Teknik Komputer, ahli Full Stack Web & IoT. Gaya bahasamu asik, gaul, kekinian, ramah, namun tetap sopan, profesional, dan informatif saat menjawab pertanyaan. Jangan terlalu kaku. Pastikan setiap jawabanmu diformat dalam paragraf yang rapi dan terstruktur agar mudah dibaca. Pertanyaan pengguna: " . $prompt;

    try {
        $response = Http::withoutVerifying()->withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
            'contents' => [
                ['parts' => [['text' => $systemPrompt]]]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, struktur respon AI tidak dikenali.';
            return response()->json(['reply' => $reply]);
        } else {
            $errorData = $response->json();
            $googleErrorMessage = $errorData['error']['message'] ?? 'Unknown Error dari Google';
            return response()->json(['reply' => 'Error Google: ' . $googleErrorMessage]);
        }
    } catch (\Exception $e) {
        return response()->json(['reply' => 'Server Error: ' . $e->getMessage()]);
    }
});

// --- 3. ROUTE PUBLIK (GET) untuk dibaca oleh frontend portfolio dan dashboard ---
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);
Route::get('/experiences', [ExperienceController::class, 'index']);
Route::get('/certificates', [CertificateController::class, 'index']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/gears', [GearController::class, 'index']);
Route::get('/settings', [SettingController::class, 'index']);

// Skills (jika masih dipakai)
Route::get('/skills', function () {
    return response()->json(\App\Models\Skill::all());
});

// --- 4. ROUTE KHUSUS ADMIN (dilindungi Sanctum) ---
Route::middleware('auth:sanctum')->group(function () {
    // Info user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Projects
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

    // Experiences
    Route::post('/experiences', [ExperienceController::class, 'store']);
    Route::put('/experiences/{id}', [ExperienceController::class, 'update']);
    Route::delete('/experiences/{id}', [ExperienceController::class, 'destroy']);

    // Certificates
    Route::post('/certificates', [CertificateController::class, 'store']);
    Route::put('/certificates/{id}', [CertificateController::class, 'update']);
    Route::delete('/certificates/{id}', [CertificateController::class, 'destroy']);

    // Blogs
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::put('/blogs/{id}', [BlogController::class, 'update']);
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);

    // Gears
    Route::post('/gears', [GearController::class, 'store']);
    Route::put('/gears/{id}', [GearController::class, 'update']);
    Route::delete('/gears/{id}', [GearController::class, 'destroy']);

    // Settings (dashboard kirim token, jadi di dalam grup)
    Route::post('/settings', [SettingController::class, 'store']);
});