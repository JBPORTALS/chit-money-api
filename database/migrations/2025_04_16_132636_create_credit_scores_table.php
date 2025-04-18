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
        Schema::create('credit_scores', function (Blueprint $table) {
            $table->uuid('id')->default(new Expression('(uuid())'));
            $table->foreignUuid('payment_id');
            $table->integer('score');
            $table->timestamps();

            $table->primary('id');

            //Relations
            $table->foreign('payment_id')->references('id')->cascadeOnDelete()->cascadeOnUpdate()->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_scores');
    }
};
