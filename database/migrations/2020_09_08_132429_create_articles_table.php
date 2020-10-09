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
            $table->foreignId('author_id')->constrained('authors');
            $table->string('cover_img')->nullable();
            $table->string('title')->nullable();
            $table->longText('byline')->nullable();
            $table->string('place')->nullable();
            $table->integer('read_time')->nullable();
            $table->longText('content')->nullable();
            $table->string('content_img')->nullable();
            $table->boolean('hero_article')->default(0);
            $table->boolean('secondary_article')->default(0);
            $table->boolean('approved')->default(0);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
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
