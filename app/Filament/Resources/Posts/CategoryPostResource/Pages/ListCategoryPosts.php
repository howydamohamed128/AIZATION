<?php

namespace App\Filament\Resources\Posts\CategoryPostResource\Pages;

use App\Filament\Resources\Posts\CategoryPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryPosts extends ListRecords
{
    protected static string $resource = CategoryPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
