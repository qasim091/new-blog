<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogArticlesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('blog_articles', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('category_id');
        $table->unsignedBigInteger('author_id')->nullable();
        $table->string('page_title')->nullable();
        $table->text('meta_desc')->nullable();
        $table->string('title');
        $table->string('views_count')->default(1);
        $table->string('slug');
        $table->string('image')->nullable();
        $table->text('description')->nullable();
        $table->enum('approval', ['Pending', 'Approved', 'Failed'])->default('Pending');
        $table->boolean('status')->default(1);
        $table->timestamps();
        $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('blog_articles');
  }
}
