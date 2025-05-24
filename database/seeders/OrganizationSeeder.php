<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entities\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\File;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        // Organization::truncate();

        $directory = public_path('images/entities/organizations');
        $files = File::files($directory);

        foreach ($files as $file) {
            $partner = Organization::create([
                'type' => 'organization',
            ]);

            $partner->clearMediaCollection('default');
            $partner->addMedia($file->getPathname())
                ->preservingOriginal()
                ->toMediaCollection('default');
        }
    }
}
