<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentType::create(['name' => 'CEDULA DE CIUDADANIA']);
        DocumentType::create(['name' => 'CEDULA DE EXTRANJERIA']);
        DocumentType::create(['name' => 'NIT']);
    }
}
