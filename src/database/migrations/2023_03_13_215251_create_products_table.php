<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Author;

return new class extends Migration
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
            $table->string('title');
            $table->decimal('list_price',10,2);
            $table->integer('stock_quantity');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('author_id')->references('id')->on('authors');
            $table->timestamps();
            $table->enum('status',['active','passive'])->default('active');
            $table->enum('deleted',['not_delete','deleted'])->default('not_delete');
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
};
