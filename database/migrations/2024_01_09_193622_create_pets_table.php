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
        Schema::create('image', function (Blueprint $table) {
            $table->id('image_id');
            $table->text('name');
            $table->text('file_name');
            $table->text('mime_type');
            $table->text('path');
            $table->text('file_hash');
            $table->text('disk');
            $table->text('extension');
            $table->integer('size');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('specie', function (Blueprint $table) {
            $table->id('specie_id');
            $table->string('specie');
            $table->softDeletes();
        });

        Schema::create('gender', function (Blueprint $table) {
            $table->id('gender_id');
            $table->string('gender');
            $table->softDeletes();
        });

        Schema::create('size', function (Blueprint $table) {
            $table->id('size_id');
            $table->string('size');
            $table->softDeletes();
        });

        Schema::create('life_stage', function (Blueprint $table) {
            $table->id('life_stage_id');
            $table->string('life_stage');
            $table->softDeletes();
        });

        Schema::create('pet', function (Blueprint $table) {
            $table->id('pet_id');
            $table->string('name');
            $table->foreignId('specie_id')->constrained('specie', 'specie_id')->onDelete('cascade');
            $table->foreignId('gender_id')->constrained('gender', 'gender_id')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('size', 'size_id')->onDelete('cascade');
            $table->foreignId('life_stage_id')->constrained('life_stage', 'life_stage_id')->onDelete('cascade');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('veterinary_care', function (Blueprint $table) {
            $table->id('veterinary_care_id');
            $table->string('veterinary_care')->unique();
            $table->softDeletes();
        });

        Schema::create('pet_vet_care', function (Blueprint $table) {
            $table->id('pet_vet_care_id');
            $table->foreignId('pet_id')->constrained('pet', 'pet_id')->onDelete('CASCADE');
            $table->foreignId('veterinary_care_id')->constrained('veterinary_care', 'veterinary_care_id')->onDelete('CASCADE');
            $table->unique(['pet_id', 'veterinary_care_id']);
            $table->softDeletes();
        });

        Schema::create('suitable_living', function (Blueprint $table) {
            $table->id('suitable_living_id');
            $table->string('suitable_living')->unique();
            $table->softDeletes();
        });

        Schema::create('pet_suit_living', function (Blueprint $table) {
            $table->id('pet_suit_living_id');
            $table->foreignId('pet_id')->constrained('pet', 'pet_id')->onDelete('CASCADE');
            $table->foreignId('suitable_living_id')->constrained('suitable_living', 'suitable_living_id')->onDelete('CASCADE');
            $table->unique(['pet_id', 'suitable_living_id']);
            $table->softDeletes();
        });

        Schema::create('temperament', function (Blueprint $table) {
            $table->id('temperament_id');
            $table->string('temperament')->unique();
            $table->softDeletes();
        });

        Schema::create('pet_temperament', function (Blueprint $table) {
            $table->id('pet_temperament_id');
            $table->foreignId('pet_id')->constrained('pet', 'pet_id')->onDelete('CASCADE');
            $table->foreignId('temperament_id')->constrained('temperament', 'temperament_id')->onDelete('CASCADE');
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
            $table->foreignId('pet_id')->constrained('pet', 'pet_id')->onDelete('CASCADE');
            $table->foreignId('sociable_with_id')->constrained('sociable_with', 'sociable_with_id')->onDelete('CASCADE');
            $table->unique(['pet_id', 'sociable_with_id']);
            $table->softDeletes();
        });

        Schema::create('pet_image', function (Blueprint $table) {
            $table->id('pet_image_id');
            $table->foreignId('pet_id')->constrained('pet', 'pet_id')->onDelete('CASCADE');
            $table->foreignId('image_id')->constrained('image', 'image_id')->onDelete('CASCADE');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_image');
        Schema::dropIfExists('pet_temperament');
        Schema::dropIfExists('pet_suit_living');
        Schema::dropIfExists('pet_vet_care');
        Schema::dropIfExists('pet_soc_with');
        Schema::dropIfExists('temperament');
        Schema::dropIfExists('sociable_with');
        Schema::dropIfExists('suitable_living');
        Schema::dropIfExists('veterinary_care');
        Schema::dropIfExists('pet');
        Schema::dropIfExists('life_stage');
        Schema::dropIfExists('size');
        Schema::dropIfExists('gender');
        Schema::dropIfExists('specie');
        Schema::dropIfExists('image');
    }
};
