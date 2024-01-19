<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id('file_id');
            $table->text('name');
            $table->text('file_name');
            $table->text('mime_type');
            $table->text('path');
            $table->text('file_hash');
            $table->text('disk');
            $table->text('extension');
            $table->text('size');
            $table->text('pet_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('species', function (Blueprint $table) {
            $table->id('specie_id');
            $table->string('specie');
            $table->softDeletes();
        });

        Schema::create('genders', function (Blueprint $table) {
            $table->id('gender_id');
            $table->string('gender');
            $table->softDeletes();
        });

        Schema::create('sizes', function (Blueprint $table) {
            $table->id('size_id');
            $table->string('size');
            $table->softDeletes();
        });

        Schema::create('life_stages', function (Blueprint $table) {
            $table->id('life_stage_id');
            $table->string('life_stage');
            $table->softDeletes();
        });

        Schema::create('pets', function (Blueprint $table) {
            $table->id('pet_id');
            $table->string('name');
            $table->foreignId('specie_id')->constrained('species', 'specie_id')->onDelete('cascade');
            $table->foreignId('gender_id')->constrained('genders', 'gender_id')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes', 'size_id')->onDelete('cascade');
            $table->foreignId('life_stage_id')->constrained('life_stages', 'life_stage_id')->onDelete('cascade');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('veterinary_cares', function (Blueprint $table) {
            $table->id('veterinary_care_id');
            $table->string('veterinary_care')->unique();
            $table->softDeletes();
        });

        Schema::create('pet_vet_cares', function (Blueprint $table) {
            $table->id('pet_vet_care_id');
            $table->foreignId('pet_id')->constrained('pets', 'pet_id')->onDelete('CASCADE');
            $table->foreignId('veterinary_care_id')->constrained('veterinary_cares', 'veterinary_care_id')->onDelete('CASCADE');
            $table->unique(['pet_id', 'veterinary_care_id']);
            $table->softDeletes();
        });

        Schema::create('suitable_livings', function (Blueprint $table) {
            $table->id('suitable_living_id');
            $table->string('suitable_living')->unique();
            $table->softDeletes();
        });

        Schema::create('pet_suit_livings', function (Blueprint $table) {
            $table->id('pet_suit_living_id');
            $table->foreignId('pet_id')->constrained('pets', 'pet_id')->onDelete('CASCADE');
            $table->foreignId('suitable_living_id')->constrained('suitable_livings', 'suitable_living_id')->onDelete('CASCADE');
            $table->unique(['pet_id', 'suitable_living_id']);
            $table->softDeletes();
        });

        Schema::create('temperaments', function (Blueprint $table) {
            $table->id('temperament_id');
            $table->string('temperament')->unique();
            $table->softDeletes();
        });

        Schema::create('pet_temperaments', function (Blueprint $table) {
            $table->id('pet_temperament_id');
            $table->foreignId('pet_id')->constrained('pets', 'pet_id')->onDelete('CASCADE');
            $table->foreignId('temperament_id')->constrained('temperaments', 'temperament_id')->onDelete('CASCADE');
            $table->unique(['pet_id', 'temperament_id']);
            $table->softDeletes();
        });

        Schema::create('sociable_with', function (Blueprint $table) {
            $table->id('sociable_with_id');
            $table->string('sociable_with')->unique();
            $table->softDeletes();
        });

        Schema::create('pet_soc_with', function (Blueprint $table) {
            $table->id('pet_soc_with_id');
            $table->foreignId('pet_id')->constrained('pets', 'pet_id')->onDelete('CASCADE');
            $table->foreignId('sociable_with_id')->constrained('sociable_with', 'sociable_with_id')->onDelete('CASCADE');
            $table->unique(['pet_id', 'sociable_with_id']);
            $table->softDeletes();
        });

        Schema::create('pet_files', function (Blueprint $table) {
            $table->id('pet_file_id');
            $table->foreignId('pet_id')->constrained('pets', 'pet_id')->onDelete('CASCADE');
            $table->foreignId('file_id')->constrained('files', 'file_id')->onDelete('CASCADE');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_files');
        Schema::dropIfExists('pet_temperaments');
        Schema::dropIfExists('pet_suit_livings');
        Schema::dropIfExists('pet_vet_cares');
        Schema::dropIfExists('pet_soc_with');
        Schema::dropIfExists('temperaments');
        Schema::dropIfExists('sociable_with');
        Schema::dropIfExists('suitable_livings');
        Schema::dropIfExists('veterinary_cares');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('life_stages');
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('genders');
        Schema::dropIfExists('species');
        Schema::dropIfExists('files');
    }
};
