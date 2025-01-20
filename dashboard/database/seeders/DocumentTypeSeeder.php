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
        DocumentType::create(['name' => 'NIT']);
        DocumentType::create(['name' => 'CÉDULA DE CIUDADANÍA']);
        DocumentType::create(['name' => 'CÉDULA DE EXTRANJERÍA']);
    }
}
