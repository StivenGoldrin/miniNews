<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('snippet')->nullable();
            $table->string('url')->nullable();
            $table->string('image_url')->nullable();
            $table->string('language', 10)->nullable();
            $table->string('source')->nullable();
            $table->string('locale', 10)->nullable();
            $table->json('category_id')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
