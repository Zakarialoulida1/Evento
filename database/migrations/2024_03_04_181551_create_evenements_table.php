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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->unique();
            $table->date('date');
            $table->string('image') ;
            $table->string('location');
            $table->foreignId('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('available_places');
            $table->enum('type_of_reservation',['Automatique','par_confirmation'])->default('Automatique'); 
            $table->enum('Status',['not_confirmed_yet','confirmed'])->default('not_confirmed_yet'); 
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
