<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_category', function (Blueprint $table) {
            $table->foreignId('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->boolean('is_filter')->default(false);
            $table->boolean('is_variation')->default(false);

            $table->primary(['attribute_id', 'category_id']);

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
        Schema::dropIfExists('attribute_category');
    }
}
