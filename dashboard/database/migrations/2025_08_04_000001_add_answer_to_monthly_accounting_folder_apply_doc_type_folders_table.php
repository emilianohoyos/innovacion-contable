<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('monthly_accounting_folder_apply_doc_type_folders', function (Blueprint $table) {
            $table->boolean('answer')->default(false)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_accounting_folder_apply_doc_type_folders', function (Blueprint $table) {
            $table->dropColumn('answer');
        });
    }
};
