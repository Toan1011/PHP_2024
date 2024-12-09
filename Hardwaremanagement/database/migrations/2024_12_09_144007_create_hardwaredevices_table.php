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
        Schema::create('hardwaredevices', function (Blueprint $table) {
            $table->id();
            $table->string('device_name'); // Tên thiết bị
            $table->string('type'); // Loại thiết bị
            $table->boolean('status'); // Trạng thái hoạt động
            $table->unsignedBigInteger('center_id'); // Liên kết với bảng it_centers
            $table->foreign('center_id')->references('id')->on('itcenters')->onDelete('cascade'); // Tham chiếu và cascading
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hardwaredevices');
    }
};
