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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('reported_by', 50)->nullable();
            $table->dateTime('reported_date');
            $table->text('description');
            $table->enum('urgency', ['Low', 'Medium', 'High']); // ENUM cho mức độ sự cố
            $table->enum('status', ['Open', 'In Progress', 'Resolved']);// ENUM cho trạng thái sự cố
            $table->unsignedBigInteger('computer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
