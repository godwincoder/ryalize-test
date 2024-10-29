<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Primary ID
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->index(); // Foreign key reference to users and index for performance
            $table->foreignId('location_id')->constrained()->onUpdate('cascade'); // Foreign key to locations
            $table->decimal('amount', 10, 3); // Transaction amount
            $table->enum('transaction_type', ['credit', 'debit']); //Type of transaction
            $table->enum('status', ['pending', 'completed', 'failed']); // Status of transaction
            $table->timestamps(); // Created and updated time of transcation
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
