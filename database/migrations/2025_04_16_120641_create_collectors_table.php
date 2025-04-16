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
        Schema::create('collectors', function (Blueprint $table) {
            $table->uuid('id')->defaultRandom();
            $table->string('name');
            $table->date('dob');
            $table->text('aadhar_front_photo_key');
            $table->text('aadhar_back_photo_key');
            $table->foreignUuid('bank_details_id');
            $table->foreignUuid('contact_id');
            $table->timestamps();

            $table->primary('id');

            //Relations
            $table->foreign('bank_details_id')->references('id')->on('bank_details');
            $table->foreign('contact_id')->references('id')->on('contacts');
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
