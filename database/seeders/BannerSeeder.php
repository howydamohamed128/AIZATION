<?php

namespace Database\Seeders;

use App\Models\Content\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::truncate();

        $banner = Banner::create([
            'status' => true,
            'title' => [
                'ar' => 'تحويل الفرص إلى قيم حقيقية',
                'en' => 'Turning Opportunities into Real Value',
            ],
            'sub_title' => [
                'ar' => 'كلمات ومنتديات الذكاء الاصطناعي',
                'en' => 'AI Talks and Forums',
            ],
            'description' => [
                'ar' => 'نؤمن بقدرة الذكاء الاصطناعي على تحويل المؤسسات من خلال الذكاء الاصطناعي، والحوكمة، والبيانات، والتكنولوجيا.',
                'en' => 'We believe in AI’s potential to transform institutions through artificial intelligence, governance, data, and technology.',
            ],
        ]);
        $banner->clearMediaCollection();
        $imagePath = public_path('images\banners\Subtract.png');
        $defaultCoverPath = public_path('default_banner.png');
        $sourcePath = file_exists($imagePath) ? $imagePath : $defaultCoverPath;
        if (file_exists($sourcePath)) {
            $banner->addMedia($sourcePath)
                ->preservingOriginal()
                ->toMediaCollection('default');
        }


       
    }
}
