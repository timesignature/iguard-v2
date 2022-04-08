<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->text('address')->nullable();
            $table->text('lat')->nullable();
            $table->text('lng')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('company_id')->nullable();
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
        Schema::dropIfExists('sites');
    }
};
