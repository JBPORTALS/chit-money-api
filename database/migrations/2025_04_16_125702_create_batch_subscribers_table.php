<?php

use App\Models\Subscriber;
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
        Schema::create('batch_subscriber', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(new Expression('(uuid())'));
            $table->foreignUuid('batch_id')->references('id')->cascadeOnDelete()->cascadeOnUpdate()->on('batches');
            $table->string('subscriber_id');
            $table->string('chit_id');
            $table->boolean('is_freezed')->default(FALSE);
            $table->dateTimeTz('freezed_at', precision: 0)->nullable();
            $table->timestamps();

            $table->foreign('subscriber_id')->references('id')->cascadeOnDelete()->cascadeOnUpdate()->on('subscribers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_subscribers');
    }
};
