<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('desc')->nullable();
            $table->integer('category_id');
            $table->integer('author_id');
            $table->string('isbn_number')->nullable();
            $table->date('published_date')->nullable();
            $table->string('price')->nullable();
            $table->string('qty')->nullable()->default(0);
            $table->string('remaining')->nullable()->default(0);
            $table->string('cover_image')->nullable();

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
        Schema::dropIfExists('books');
    }
}
