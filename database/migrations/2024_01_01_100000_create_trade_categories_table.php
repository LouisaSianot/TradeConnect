<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trade_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g. Electrician, Plumber, Mechanic
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Seed the three pilot categories directly so they exist from day one.
        DB::table('trade_categories')->insert([
            ['name' => 'Electrician', 'slug' => 'electrician', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Plumber', 'slug' => 'plumber', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mechanic', 'slug' => 'mechanic', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('trade_categories');
    }
};