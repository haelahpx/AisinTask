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
        Schema::create('data', function (Blueprint $table) {
            $table->id('data_id');
            $table->unsignedBigInteger('user_id');
            $table->string('data_name');
            $table->enum('type', ['document', 'image'])->default('image');
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->string('data_url');
            $table->timestamps();

            // set the fk
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
