<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->dateTime('date_of_birth');
            $table->string('phone_number');
            $table->ipAddress();
            $table->string('iban');
            $table->timestamps();
            $table->boolean('is_fraud');
            $table->string('fraud_reason')->nullable();
            $table->unsignedBigInteger('scan_id');
            $table->foreign('scan_id')->references('id')->on('scans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
