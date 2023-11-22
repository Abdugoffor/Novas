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
        Schema::create('stafs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('adres');
            $table->string('img');
            $table->string('file');
            $table->string('working_time');
            // $table->foreignId('department_id')->constrained(); // "customers" jadvalidagi "id" larni ishora qiladi
            // $table->foreignId('salary__type_id')->constrained(); // "customers" jadvalidagi "id" larni ishora qiladi
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->foreignId('salary__type_id')->constrained('salary__types')->onDelete('cascade');
            $table->string('sum');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stafs');
    }
};
