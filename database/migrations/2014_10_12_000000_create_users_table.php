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
            $table->id();
            $table->text('name')->nullable();
            $table->text('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('password')->nullable();
            $table->text('api_token')->nullable();
            $table->text('image')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->text('type')->nullable(); //super,admin,moderator,employee
            $table->boolean('isActive')->default(false); //super,admin,moderator,employee
            $table->rememberToken();
            $table->timestamps();
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
