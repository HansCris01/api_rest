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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50)->nullable();//nulo
            $table->string('last_name', 50)->nullable(); //nulo
            $table->string('email')->unique(); //no nulo ya esta por defecto
            $table->string('phone')->unique(); //no nulo ya esta por defecto
            $table->date('birth_date'); //no nulo ya esta por defecto
            $table->date('enrollment_date');//no nulo ya esta por defecto
            $table->boolean('status', 1);//Esto de aquí no debe ser nulo porque es la eliminación logica
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
