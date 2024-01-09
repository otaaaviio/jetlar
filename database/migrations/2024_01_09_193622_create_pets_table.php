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
        \DB::unprepared('CREATE EXTENSION IF NOT EXISTS "unaccent";');
        \DB::unprepared(<<<QUERY
    CREATE OR REPLACE FUNCTION public.immutable_unaccent(regdictionary, text)
    RETURNS text
    LANGUAGE c IMMUTABLE PARALLEL SAFE STRICT AS
    '\$libdir/unaccent', 'unaccent_dict';
    QUERY);
            \DB::unprepared(<<<QUERY
    CREATE OR REPLACE FUNCTION public.f_unaccent(text)
    RETURNS text
    LANGUAGE sql IMMUTABLE PARALLEL SAFE STRICT
    RETURN public.immutable_unaccent(regdictionary 'public.unaccent', $1);
    QUERY);

        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('$normalized_name')->storedAs('upper(f_unaccent(name))');
            $table->string('specie');
            $table->string('gender');
            $table->string('size');
            $table->string('age');
            $table->string('veterinary_care');
            $table->string('temperament');
            $table->string('suitable_living');
            $table->string('sociable_with');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
