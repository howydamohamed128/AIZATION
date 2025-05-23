<?php

namespace App\Filament\Resources\Posts\CategoryPostResource\Pages;

use App\Filament\Resources\Posts\CategoryPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryPost extends EditRecord
{
    protected static string $resource = CategoryPostResource::class;
    use EditRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
