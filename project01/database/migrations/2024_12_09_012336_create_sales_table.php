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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id'); // Khóa chính
            $table->unsignedBigInteger('medicine_id'); // Khóa ngoại tham chiếu đến bảng "medicines"
            $table->integer('quantity'); // Số lượng thuốc bán ra
            $table->datetime('sale_date'); // Ngày giờ bán hàng
            $table->string('customer_phone', 20)->default('0000000000'); // Hoặc có thể để mặc định là một số điện thoại
            // Thiết lập khóa ngoại
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
