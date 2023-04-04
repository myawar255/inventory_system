<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 100)->nullable();
            $table->string('customer_address', 100)->nullable();
            $table->string('customer_phone', 30)->nullable();
            $table->string('contact_person', 100)->nullable();
            $table->string('comment', 255)->nullable();
            $table->double('opening_balance')->nullable();
            $table->double('current_balance')->nullable();
            $table->integer('customer_city_id')->nullable();
            $table->integer('ct_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('image')->nullable();
            $table->integer('synced')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
