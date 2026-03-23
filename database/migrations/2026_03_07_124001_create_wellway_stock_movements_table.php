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
        Schema::create('wellway_stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable()->unique(); // Accounting / Order reference /User manually inputs this based on external accounting system
            $table->foreignId('product_id')->constrained('wellway_products')->onDelete('cascade');
            $table->enum('type', ['in', 'out']); // in = received, out = sold
            $table->integer('qty');
            //stock qty tracking
            $table->integer('stock_before')->nullable();
            $table->integer('stock_after')->nullable();
            // Date movement recorded
            $table->date('movement_date')->nullable();
            // Shipment information
            $table->string('requested_by')->nullable();
            $table->string('shipped_by')->nullable();
            $table->string('shipped_to')->nullable();
            $table->date('shipped_on')->nullable();
            // Order / shipment status
            $table->enum('status', [
                    'initialized',
                    'processing',
                    'packed',
                    'shipped',
                    'delivered',
                    'cancelled',
                    'returned'
                ])->default('initialized');
            // Optional tracking fields (recommended)
            $table->string('tracking_number')->nullable();
            $table->string('carrier')->nullable(); // DHL / FedEx etc
            $table->string('reference_document')->nullable();
            $table->string('note')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wellway_stock_movements');
    }
};