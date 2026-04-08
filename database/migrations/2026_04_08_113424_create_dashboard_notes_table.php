<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dashboard_notes', function (Blueprint $table) {
            $table->id();
            $table->text('note');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('color', 20)->default('yellow'); // yellow, blue, green
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dashboard_notes');
    }
};