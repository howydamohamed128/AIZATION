<?php

namespace App\Filament\Resources\Posts\CategoryPostResource\Pages;

use App\Filament\Resources\Posts\CategoryPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoryPost extends CreateRecord
{
    protected static string $resource = CategoryPostResource::class;

      use CreateRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
