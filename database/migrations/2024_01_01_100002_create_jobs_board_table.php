<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs_board', function (Blueprint $table) {
            // Named jobs_board (not 'jobs') to avoid clashing with Laravel's
            // own queue jobs table.
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('trade_category_id')->constrained()->restrictOnDelete();
            $table->foreignId('tradesperson_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->enum('status', ['open', 'assigned', 'completed', 'cancelled'])->default('open');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs_board');
    }
};