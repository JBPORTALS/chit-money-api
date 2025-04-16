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
        Schema::create('bank_details', function (Blueprint $table) {
            $table->uuid('id')->default(new Expression('(uuid())'));
            $table->string('account_holder_name');
            $table->text('account_number');
            $table->string('ifsc_code');
            $table->string('branch_name');
            $table->string('account_type');
            $table->string('upi_id');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_details');
    }
};
