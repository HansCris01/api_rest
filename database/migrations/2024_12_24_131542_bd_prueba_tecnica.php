<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        $databaseName = 'bd_prueba_tecnica'; //Es el mismo nombre de base de datos que esta en la env

        DB::statement("CREATE DATABASE IF NOT EXISTS `$databaseName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        $databaseName = 'bd_prueba_tecnica'; //Es el mismo nombre de base de datos que esta en la env

        DB::statement("DROP DATABASE IF EXISTS `$databaseName`");
    }
};
