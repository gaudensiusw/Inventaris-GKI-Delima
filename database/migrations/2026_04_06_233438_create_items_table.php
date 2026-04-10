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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('condition', ['Baik', 'Dipinjam', 'Diperbaiki', 'Rusak Ringan', 'Rusak Berat', 'Hilang', 'Tidak Digunakan', 'Penghapusan'])->default('Baik');
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->date('acquired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
