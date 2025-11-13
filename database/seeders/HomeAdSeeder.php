<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeAd;

class HomeAdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing ads
        HomeAd::truncate();

        // Demo AdSense code template
        $demoAdCode = function($position, $size) {
            return <<<HTML
<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px; border-radius: 12px; text-align: center; min-height: {$size}px;">
    <div style="color: white;">
        <div style="font-size: 32px; margin-bottom: 10px;">📢</div>
        <h3 style="color: white; margin: 0 0 8px 0; font-size: 20px;">Demo Advertisement</h3>
        <p style="color: rgba(255,255,255,0.9); margin: 0; font-size: 14px;">Position: {$position}</p>
        <p style="color: rgba(255,255,255,0.7); margin: 8px 0 0 0; font-size: 12px;">Replace with actual AdSense code</p>
    </div>
</div>
HTML;
        };

        // Home Page Ads
        HomeAd::create([
            'name' => 'Home - After 3rd Article',
            'position' => 'home_after_3rd',
            'ad_code' => <<<HTML
<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 8px; color: white; text-align: center; width: 100%; height: 100%;">
    <h4 style="margin: 0 0 8px 0; font-size: 18px; font-weight: bold;">Your Ad Here</h4>
    <p style="margin: 0; font-size: 14px; opacity: 0.9;">Replace with AdSense code</p>
</div>
HTML,
            'is_active' => true,
            'order' => 0,
        ]);

        HomeAd::create([
            'name' => 'Home - After 7th Article',
            'position' => 'home_after_7th',
            'ad_code' => <<<HTML
<div style="background: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%); padding: 30px; border-radius: 8px; color: white; text-align: center; width: 100%; height: 100%;">
    <h4 style="margin: 0 0 8px 0; font-size: 18px; font-weight: bold;">Featured Ad</h4>
    <p style="margin: 0; font-size: 14px; opacity: 0.9;">Premium placement</p>
</div>
HTML,
            'is_active' => true,
            'order' => 0,
        ]);


        // Blog Listing Page Ads
        HomeAd::create([
            'name' => 'Blog List - After 3rd Post',
            'position' => 'blog_after_3rd',
            'ad_code' => <<<HTML
<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 8px; color: white; text-align: center; width: 100%; height: 100%;">
    <h4 style="margin: 0 0 8px 0; font-size: 18px; font-weight: bold;">Your Ad Here</h4>
    <p style="margin: 0; font-size: 14px; opacity: 0.9;">Replace with AdSense code</p>
</div>
HTML,
            'is_active' => true,
            'order' => 0,
        ]);

        HomeAd::create([
            'name' => 'Blog List - After 7th Post',
            'position' => 'blog_after_7th',
            'ad_code' => <<<HTML
<div style="background: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%); padding: 30px; border-radius: 8px; color: white; text-align: center; width: 100%; height: 100%;">
    <h4 style="margin: 0 0 8px 0; font-size: 18px; font-weight: bold;">Featured Ad</h4>
    <p style="margin: 0; font-size: 14px; opacity: 0.9;">Premium placement</p>
</div>
HTML,
            'is_active' => true,
            'order' => 0,
        ]);

        HomeAd::create([
            'name' => 'Blog List - Before Pagination',
            'position' => 'blog_before_pagination',
            'ad_code' => <<<HTML
<div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); padding: 40px; border-radius: 12px; text-align: center; min-height: 120px;">
    <div style="color: white;">
        <div style="font-size: 32px; margin-bottom: 10px;">📄</div>
        <h3 style="color: white; margin: 0 0 8px 0; font-size: 20px;">Bottom Banner Ad</h3>
        <p style="color: rgba(255,255,255,0.9); margin: 0; font-size: 14px;">Blog List - Before Pagination</p>
        <p style="color: rgba(255,255,255,0.7); margin: 8px 0 0 0; font-size: 12px;">Responsive Banner</p>
    </div>
</div>
HTML,
            'is_active' => true,
            'order' => 0,
        ]);

        // Blog Details Page Ads

        HomeAd::create([
            'name' => 'Blog Detail - After Two Paragraphs',
            'position' => 'blog_detail_after_first_paragraph',
            'ad_code' => <<<HTML
<div style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); padding: 40px; border-radius: 12px; text-align: center; min-height: 120px;">
    <div style="color: #333;">
        <div style="font-size: 32px; margin-bottom: 10px;">📝</div>
        <h3 style="color: #333; margin: 0 0 8px 0; font-size: 20px;">In-Content Ad</h3>
        <p style="color: #555; margin: 0; font-size: 14px;">Blog Detail - After Two Paragraphs</p>
        <p style="color: #777; margin: 8px 0 0 0; font-size: 12px;">High Engagement Zone</p>
    </div>
</div>
HTML,
            'is_active' => true,
            'order' => 0,
        ]);

        HomeAd::create([
            'name' => 'Blog Detail - Middle of Content',
            'position' => 'blog_detail_middle_content',
            'ad_code' => <<<HTML
<div style="background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%); padding: 40px; border-radius: 12px; text-align: center; min-height: 120px;">
    <div style="color: white;">
        <div style="font-size: 32px; margin-bottom: 10px;">🎯</div>
        <h3 style="color: white; margin: 0 0 8px 0; font-size: 20px;">Mid-Article Ad</h3>
        <p style="color: rgba(255,255,255,0.9); margin: 0; font-size: 14px;">Blog Detail - Middle of Content</p>
        <p style="color: rgba(255,255,255,0.7); margin: 8px 0 0 0; font-size: 12px;">Maximum Visibility</p>
    </div>
</div>
HTML,
            'is_active' => true,
            'order' => 0,
        ]);

        HomeAd::create([
            'name' => 'Blog Detail - Before Last 2 Tags',
            'position' => 'blog_detail_before_last_2_tags',
            'ad_code' => <<<HTML
<div style="background: linear-gradient(135deg, #d299c2 0%, #fef9d7 100%); padding: 40px; border-radius: 12px; text-align: center; min-height: 120px;">
    <div style="color: #333;">
        <div style="font-size: 32px; margin-bottom: 10px;">🏁</div>
        <h3 style="color: #333; margin: 0 0 8px 0; font-size: 20px;">Before Last 2 Tags</h3>
        <p style="color: #555; margin: 0; font-size: 14px;">Blog Detail - Before Last 2 Tags in Description</p>
        <p style="color: #777; margin: 8px 0 0 0; font-size: 12px;">Final Engagement Point</p>
    </div>
</div>
HTML,
            'is_active' => true,
            'order' => 0,
        ]);



        $this->command->info('✅ Created 8 demo ads for all positions!');
        $this->command->info('📍 Positions covered:');
        $this->command->info('   - Home: After 3rd Article');
        $this->command->info('   - Home: After 7th Article');
        $this->command->info('   - Blog List: After 3rd Post');
        $this->command->info('   - Blog List: After 7th Post');
        $this->command->info('   - Blog List: Before Pagination');
        $this->command->info('   - Blog Detail: After Two Paragraphs');
        $this->command->info('   - Blog Detail: Middle of Content');
        $this->command->info('   - Blog Detail: Before Last 2 Tags in Description');
        $this->command->info('');
        $this->command->info('🎨 All ads are active and ready to display!');
        $this->command->info('📝 Visit /admin/home-ads to manage them.');
    }
}
