<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content\Category;
use App\Models\Content\CategoryPost;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::truncate();
        $categories = [
            [
                'name' => [
                    'ar' => 'الذكاء الاصطناعي',
                    'en' => 'Artificial Intelligence'
                ],
                'type' => 'post',
                'status' => 1,
            ],
            [
                'name' => [
                    'ar' => 'كتابة المحتوى باستخدام الذكاء الاصطناعي',
                    'en' => 'AI Content Writing'
                ],
                'type' => 'post',
                'status' => 1,
            ],
            [
                'name' => [
                    'ar' => 'الروبوتات والنظم الذكية',
                    'en' => 'Robotics and Intelligent Systems'
                ],
                'type' => 'post',
                'status' => 1,
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = CategoryPost::create($categoryData);
            $category->clearMediaCollection();
            $imagePath = public_path('images\categories\category.png');
            $defaultCoverPath = public_path('category.png');
            $sourcePath = file_exists($imagePath) ? $imagePath : $defaultCoverPath;
            if (file_exists($sourcePath)) {
                $category->addMedia($sourcePath)
                    ->preservingOriginal()
                    ->toMediaCollection('default');
            }

        }
    }
}
