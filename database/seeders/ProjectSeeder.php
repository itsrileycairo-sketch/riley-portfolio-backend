<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title' => 'Miniature IoT Lift & Auto Agriculture',
            'slug' => 'iot-lift-agri',
            'category' => 'IoT & Embedded',
            'description' => 'Prototipe sistem lift miniatur dan otomasi agrikultur menggunakan mikrokontroler Arduino dan integrasi sensor presisi tinggi.',
            'tech_stack' => json_encode(['Arduino', 'C++', 'IoT Sensors']),
            'github_link' => '#',
            'featured_image' => 'https://via.placeholder.com/600x400/10b981/ffffff?text=IoT+Prototype'
        ]);

        Project::create([
            'title' => 'Academic AI Chatbot Edu',
            'slug' => 'ai-chatbot-edu',
            'category' => 'AI & Data',
            'description' => 'Asisten virtual cerdas berbasis Python yang mampu memproses dan menjawab pertanyaan dari buku panduan akademik secara otomatis menggunakan sistem RAG.',
            'tech_stack' => json_encode(['Python', 'LangChain', 'FAISS']),
            'github_link' => '#',
            'featured_image' => 'https://via.placeholder.com/600x400/06b6d4/ffffff?text=AI+Chatbot'
        ]);

        Project::create([
            'title' => 'Web CMS Security Hardening',
            'slug' => 'cms-security-audit',
            'category' => 'Full Stack Web',
            'description' => 'Audit keamanan komprehensif dan peningkatan sistem API pada CMS berbasis web, mencakup proteksi brute-force dan penguatan autentikasi.',
            'tech_stack' => json_encode(['Laravel', 'PHP', 'Security']),
            'github_link' => '#',
            'featured_image' => 'https://via.placeholder.com/600x400/6366f1/ffffff?text=CMS+Security'
        ]);
    }
}