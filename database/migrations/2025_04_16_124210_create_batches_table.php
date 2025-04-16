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
        Schema::create('batches', function (Blueprint $table) {
            $table->uuid('id')->default(new Expression('(uuid())'));
            $table->foreignUuid('organization_id');
            $table->string('name');
            $table->enum('batch_type',["auction","interest"]);
            $table->date('starts_on');
            $table->date('ends_on');
            $table->integer('due_date');
            $table->integer('scheme');
            $table->decimal('fund_amount', total:25, places:2);
            $table->enum('batch_status',["upcoming","active","completed"])->default('upcoming');
            $table->float('commission_rate');
            $table->timestamps();

            $table->primary('id');

            //Relations
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
