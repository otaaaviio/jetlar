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

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('file_name');
            $table->text('mime_type');
            $table->text('path');
            $table->text('file_hash');
            $table->text('disk');
            $table->text('extension');
            $table->text('size');
            $table->timestamps();
        });

        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('$normalized_name')->storedAs('upper(f_unaccent(name))');
            $table->string('specie');
            $table->string('gender');
            $table->string('size');
            $table->string('age');
            $table->text('veterinary_care');
            $table->string('temperament');
            $table->text('suitable_living');
            $table->text('sociable_with');
            $table->string('description');
            $table->foreignIdFor(\App\Models\File::class, 'cover_id')->nullable()->constrained('files')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
        Schema::dropIfExists('files');

        DB::unprepared('DROP FUNCTION IF EXISTS public.f_unaccent(text) CASCADE;');
        \DB::unprepared('DROP FUNCTION IF EXISTS public.f_unaccent(text);');
        \DB::unprepared('DROP FUNCTION IF EXISTS public.immutable_unaccent(regdictionary, text);');
        \DB::unprepared('DROP EXTENSION IF EXISTS "unaccent";');
    }
};
