<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_books', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('book_name')->nullable();
            $table->string('author_name')->nullable();
            $table->string('subject')->nullable();
            $table->longText('desc')->nullable();
            $table->integer('book_id');
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
        Schema::dropIfExists('requested_books');
    }
}
