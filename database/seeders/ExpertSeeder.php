<?php

namespace Database\Seeders;

use App\Models\Entities\Expert;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ExpertSeeder extends Seeder
{
    public function run()
    {
        // Expert::truncate();

        $experts = [
            [
                'name' => [
                    'ar' => 'معاذ العمري',
                    'en' => 'Moaz Al-Omari'
                ],
                'role' => [
                    'ar' => 'الرئيس التنفيذي، مستشار الذكاء الاصطناعي',
                    'en' => 'CEO, AI Consultant'
                ],
                'image' => 'moaz.png',
            ],
            [
                'name' => [
                    'ar' => 'لطفي أبو سالم',
                    'en' => 'Lotfi Abu Salem'
                ],
                'role' => [
                    'ar' => 'مدير العمليات',
                    'en' => 'Operations Manager'
                ],
                'image' => 'lotfy.png',
            ],
            [
                'name' => [
                    'ar' => 'د. محمود جبر',
                    'en' => 'Dr. Mahmoud Jabr'
                ],
                'role' => [
                    'ar' => 'مستشار التميز المؤسسي',
                    'en' => 'Institutional Excellence Consultant'
                ],
                'image' => 'mahmoud.png',
            ],
            [
                'name' => [
                    'ar' => 'أحمد شحروج',
                    'en' => 'Ahmed Shahrouj'
                ],
                'role' => [
                    'ar' => 'مستشار التعليم والابتكار',
                    'en' => 'Education and Innovation Consultant'
                ],
                'image' => 'ahmed.png',
            ],
            [
                'name' => [
                    'ar' => 'د. روبرت كوليز',
                    'en' => 'Dr. Robert Collis'
                ],
                'role' => [
                    'ar' => 'مستشار برامج بناء القدرات',
                    'en' => 'Capacity Building Programs Consultant'
                ],
                'image' => 'robert.png',
            ],
        ];

        foreach ($experts as $data) {
            $expert = Expert::create([
                'name' => $data['name'],
                'job_title' => $data['role'],

                'type' => 'expert',
            ]);

            $imagePath = public_path('images/entities/experts/' . $data['image']);
            if (File::exists($imagePath)) {
                $expert->clearMediaCollection('default');
                $expert->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('default');
            }
        }
    }
}
