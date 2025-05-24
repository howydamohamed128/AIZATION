<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entities\Partner;
use Illuminate\Support\Facades\File;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        // Partner::truncate();

        $directory = public_path('images/entities/partners');
        $files = File::files($directory);

        foreach ($files as $file) {
            $partner = Partner::create([
                'type' => 'partner',
            ]);

            $partner->clearMediaCollection('default');
            $partner->addMedia($file->getPathname())
                ->preservingOriginal()
                ->toMediaCollection('default');
        }
    }
}
