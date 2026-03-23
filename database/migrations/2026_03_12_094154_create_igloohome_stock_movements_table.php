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
        Schema::create('igloohome_stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable()->unique();
            $table->foreignId('product_id')
                ->constrained('igloohome_products')
                ->onDelete('cascade');
            $table->enum('type',['in','out']);
            $table->integer('qty');
            $table->date('movement_date')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('shipped_by')->nullable();
            $table->string('shipped_to')->nullable();
            $table->date('shipped_on')->nullable();
            $table->string('status')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('carrier')->nullable();
            $table->string('reference_document')->nullable();
            $table->integer('stock_before')->nullable();
            $table->integer('stock_after')->nullable();
            $table->string('note')->nullable();
            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('igloohome_stock_movements');
    }
};