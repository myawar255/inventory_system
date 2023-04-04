<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('userid')->nullable();
            $table->integer('cat_id')->nullable();
            $table->string('productname', 250)->nullable();
            $table->string('productcode', 200)->nullable();
            $table->string('grit_number', 250)->nullable();
            $table->string('stock', 50)->nullable();
            $table->double('opening_stock')->nullable();
            $table->string('unit')->nullable();
            $table->double('purchase_price')->nullable();
            $table->string('comments', 500)->nullable();
            $table->text('image')->nullable();
            $table->double('sale_price')->nullable();
            $table->float('sale_discount_percent')->default(0)->nullable();
            $table->float('sale_discount')->nullable();
            $table->integer('sequence')->nullable();
            $table->tinyInteger('show_on_web')->nullable();
            $table->tinyInteger('admin_auth_show_on_web')->nullable();
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
        Schema::dropIfExists('products');
    }
}
