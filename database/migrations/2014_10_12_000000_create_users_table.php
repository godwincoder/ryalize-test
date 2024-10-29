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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary ID
            $table->string('name'); //Users name
            $table->string('email')->unique(); //Users email
            $table->timestamp('email_verified_at')->nullable(); // Users email
            $table->string('password'); // Users password
            $table->rememberToken(); // Remeber token to login user automatically
            $table->timestamps(); // User created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
