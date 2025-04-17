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
        Schema::create('payouts', function (Blueprint $table) {
            $table->uuid('id')->default(new Expression('(uuid())'));
            $table->foreignUuid('batch_subscriber_id');
            $table->decimal('month', total: 25, places: 2);
            $table->decimal('amount', total: 25, places: 2);
            $table->decimal('deductions', total: 25, places: 2);
            $table->decimal('total_amount', total: 25, places: 2);
            $table->enum('status', ["requested", "accepted", "rejected", "disbursed", "cancelled"]);
            $table->string('rejection_reason')->nullable();
            $table->dateTimeTz('paid_at')->nullable();
            $table->dateTimeTz('requested_at')->nullable();
            $table->dateTimeTz('accepted_at')->nullable();
            $table->dateTimeTz('rejected_at')->nullable();
            $table->dateTimeTz('disbursed_at')->nullable();
            $table->dateTimeTz('cancelled_at')->nullable();
            $table->enum('payment_mode', ["cash", "online"]);
            $table->string('transaction_id')->nullable(); //if it's online payment mode
            $table->timestamps();

            $table->primary('id');

            //Relations
            $table->foreign('batch_subscriber_id')->references('id')->on('batch_subscribers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
