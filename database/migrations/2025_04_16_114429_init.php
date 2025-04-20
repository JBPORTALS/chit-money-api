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
        //Contacts
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(new Expression('(uuid())'));
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->integer('pincode');
            $table->timestamps();
        });

        //Bank Details
        Schema::create('bank_details', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(new Expression('(uuid())'));
            $table->string('account_holder_name');
            $table->text('account_number');
            $table->string('ifsc_code');
            $table->string('branch_name');
            $table->enum('account_type', ["savings", "current"]);
            $table->string('upi_id');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->timestamps();
        });

        //Collectors
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

        //Subscribers
        Schema::create('subscribers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('display_userId')->nullable();
            $table->string('name')->nullable();
            $table->date('dob')->nullable();
            $table->text('aadhar_front_photo_key')->nullable();
            $table->text('aadhar_back_photo_key')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_relationship')->nullable();
            $table->string('nominee_phone_number')->nullable();
            $table->foreignUuid('bank_details_id')->nullable()->references('id')->nullOnDelete()->cascadeOnUpdate()->on('bank_details');
            $table->foreignUuid('contact_id')->nullable()->references('id')->nullOnDelete()->cascadeOnUpdate()->on('contacts');
            $table->timestamps();
        });

        //Organizations
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(new Expression('(uuid())'));
            $table->string('collector_id');
            $table->string('name');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->string('registration_certificate_key');
            $table->timestamps();

            $table->foreign('collector_id')->references('id')->cascadeOnDelete()->cascadeOnUpdate()->on('collectors');

        });

        //Batches
        Schema::create('batches', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(new Expression('(uuid())'));
            $table->foreignUuid('organization_id')->references('id')->cascadeOnDelete()->cascadeOnUpdate()->on('organizations');
            $table->string('name');
            $table->enum('batch_type', ["auction", "interest"]);
            $table->date('starts_on');
            $table->date('ends_on');
            $table->integer('due_date');
            $table->integer('scheme');
            $table->decimal('fund_amount', total: 25, places: 2);
            $table->enum('batch_status', ["upcoming", "active", "completed"])->default('upcoming');
            $table->float('commission_rate');
            $table->timestamps();
        });

        //Batch Subscriber
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

        //Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(new Expression('(uuid())'));
            $table->foreignUuid('batch_subscriber_id')->references('id')->cascadeOnDelete()->cascadeOnUpdate()->on('batch_subscriber');
            $table->decimal('penalty', total: 25, places: 2);
            $table->decimal('subscription_amount', total: 25, places: 2);
            // $table->decimal('total_amount', total: 25, places: 2); //No need to store, we can calculate it at runtime
            $table->enum('payment_mode', ["cash", "online"]);
            $table->string('transaction_id')->nullable();
            $table->dateTimeTz('paid_at');
            $table->timestamps();
        });

        //Payouts
        Schema::create('payouts', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(new Expression('(uuid())'));
            $table->foreignUuid('batch_subscriber_id')->references('id')->cascadeOnDelete()->cascadeOnUpdate()->on('batch_subscriber');
            $table->decimal('month', total: 25);
            $table->decimal('amount', total: 25, places: 2);
            // $table->decimal('deductions', total: 25, places: 2); Can be calculated based on the applied commision rate
            $table->decimal('applied_commision_rate', total: 25, places: 2);
            //$table->decimal('total_amount', total: 25, places: 2); No need. Can be calculate during the runtime
            $table->enum('status', ["requested", "accepted", "rejected", "disbursed", "cancelled"]);
            $table->string('rejection_reason')->nullable();
            $table->dateTimeTz('paid_at')->nullable();
            $table->dateTimeTz('requested_at')->nullable();
            $table->dateTimeTz('accepted_at')->nullable();
            $table->dateTimeTz('rejected_at')->nullable();
            $table->dateTimeTz('cancelled_at')->nullable();
            $table->enum('payment_mode', ["cash", "online"]);
            $table->string('transaction_id')->nullable(); //if it's online payment mode
            $table->timestamps();
        });

        //Credit Scores
        Schema::create('credit_scores', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(new Expression('(uuid())'));
            $table->foreignUuid('payment_id')->references('id')->cascadeOnDelete()->cascadeOnUpdate()->on('payments');
            $table->integer('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
