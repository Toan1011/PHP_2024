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
        Schema::create('laptops', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 50); // Hãng sản xuất
            $table->string('model', 100); // Mẫu laptop
            $table->text('specifications'); // Thông số kỹ thuật
            $table->boolean('rental_status')->default(false);
            $table->unsignedBigInteger('renter_id')->nullable(); // ID người thuê, cho phép null
            $table->foreign('renter_id')->references('id')->on('renters')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
};
