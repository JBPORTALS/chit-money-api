<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->uuid('id')->default(new Expression('(uuid())'));
            $table->string('display_userId')->nullable();
            $table->string('name')->nullable();
            $table->date('dob')->nullable();
            $table->text('aadhar_front_photo_key')->nullable();
            $table->text('aadhar_back_photo_key')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_relationship')->nullable();
            $table->string('nominee_phone_number')->nullable();
            $table->foreignUuid('bank_details_id')->nullable();
            $table->foreignUuid('contact_id')->nullable();
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
        Schema::dropIfExists('subscribers');
    }
};
