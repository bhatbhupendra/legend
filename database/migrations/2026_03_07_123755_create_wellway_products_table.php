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
        Schema::create('wellway_products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('name_en');
            $table->string('name_jp')->nullable();
            $table->string('color')->nullable();
            $table->string('hinge')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('buy_price', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wellway_products');
    }
};