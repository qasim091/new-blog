<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_ads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Ad name for identification
            $table->enum('position', [
                'after_featured', 
                'before_latest',
                'home_after_3rd',
                'home_after_7th',
                'blog_after_3rd',
                'blog_after_7th',
                'blog_before_pagination',
                'blog_detail_after_first_paragraph',
                'blog_detail_middle_content',
                'blog_detail_before_last_2_tags'
            ])->default('after_featured');
            $table->text('ad_code'); // AdSense code
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0); // For ordering multiple ads in same position
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
        Schema::dropIfExists('home_ads');
    }
}
