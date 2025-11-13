<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_category_buttons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('url')->nullable();
            $table->string('bg_color')->default('bg-primary');
            $table->string('text_color')->default('text-white');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('set null');
            $table->index(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_category_buttons');
    }
};
