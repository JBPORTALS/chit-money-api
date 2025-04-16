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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->default(new Expression('(uuid())'));
            $table->foreignUuid('batch_subscriber_id');
            $table->decimal('penalty', total:25, places:2);
            $table->decimal('subscription_amount', total:25, places:2);
            $table->decimal('total_amount', total:25, places:2);
            $table->enum('payment_mode',["cash","online"]);
            $table->string('transaction_id')->nullable();
            $table->dateTimeTz('paid_at');
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
        Schema::dropIfExists('payments');
    }
};
