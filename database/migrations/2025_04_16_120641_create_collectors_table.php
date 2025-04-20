<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('collectors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->date('dob')->nullable();
            $table->text('aadhar_front_photo_key')->nullable();
            $table->text('aadhar_back_photo_key')->nullable();
            $table->foreignUuid('bank_details_id')->nullable()->references('id')->nullOnDelete()->cascadeOnUpdate()->on('bank_details');
            $table->foreignUuid('contact_id')->nullable()->references('id')->nullOnDelete()->cascadeOnUpdate()->on('contacts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collectors');
    }
};
