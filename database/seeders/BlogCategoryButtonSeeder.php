<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategoryButton;

class BlogCategoryButtonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buttons = [
            [
                'title' => 'Latest Articles',
                'slug' => 'latest-articles',
                'category_id' => null,
                'url' => route('bloglist'),
                'bg_color' => 'bg-primary',
                'text_color' => 'text-white',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Featured Posts',
                'slug' => 'featured-posts',
                'category_id' => null,
                'url' => '#',
                'bg_color' => 'bg-primary',
                'text_color' => 'text-white',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Popular Articles',
                'slug' => 'popular-articles',
                'category_id' => null,
                'url' => '#',
                'bg_color' => 'bg-primary',
                'text_color' => 'text-white',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Tech Articles',
                'slug' => 'tech-articles',
                'category_id' => null,
                'url' => '#',
                'bg_color' => 'bg-primary',
                'text_color' => 'text-white',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Tutorials',
                'slug' => 'tutorials',
                'category_id' => null,
                'url' => '#',
                'bg_color' => 'bg-primary',
                'text_color' => 'text-white',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'News & Updates',
                'slug' => 'news-updates',
                'category_id' => null,
                'url' => '#',
                'bg_color' => 'bg-primary',
                'text_color' => 'text-white',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($buttons as $button) {
            BlogCategoryButton::create($button);
        }
    }
}
