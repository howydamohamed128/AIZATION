<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;
use Illuminate\Support\Facades\Storage;

return new class extends SettingsMigration {

    public function up(): void
    {
        $postImage = $this->saveImageToStorage('images/settings/post.png', 'post.png');
        $footerImage = $this->saveImageToStorage('images/settings/footer.jpg', 'footer.jpg');
        $logoImage = $this->saveImageToStorage('images/settings/Group.png', 'Group.png');

        $this->migrator->add('general.content', [
            'footer' => [
                'title' => [
                    'ar' => 'حيث تلتقي الابتكارات التقنية بالاحتياجات اليومية',
                    'en' => 'Where Tech Innovations Meet Daily Needs',
                ],
                'sub_title' => [
                    'ar' => 'تحويل الفرص إلى قيم حقيقية بالذكاء الاصطناعي',
                    'en' => 'Turning Opportunities into Real Value with AI',
                ],
                'image' => $footerImage,
                'logo' => $logoImage,
            ],
            'posts' => [
                'title' => [
                    'ar' => 'اكتشف مقالاتنا',
                    'en' => 'Explore Our Articles',
                ],
                'sub_title' => [
                    'ar' => 'أحدث اتجاهات التكنولوجيا',
                    'en' => 'Latest Tech Trends',
                ],
                'description' => [
                    'ar' => 'اغمر نفسك في عالم التكنولوجيا من خلال مقالاتنا التخصيصية، اكتشف كيف تُغير التكنولوجيا العالم.',
                    'en' => 'Immerse yourself in the world of tech through our personalized articles. Discover how technology is transforming the world.',
                ],
                'image' => $postImage,
            ],
        ]);
    }

    private function saveImageToStorage(string $sourcePath, string $storagePath): string
    {
        $fullPath = public_path($sourcePath);
        
        if (file_exists($fullPath)) {
            Storage::disk('public')->put($storagePath, file_get_contents($fullPath));
            return $storagePath;
        }

        return '';  
    }
};
