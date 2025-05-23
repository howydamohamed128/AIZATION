<?php

namespace App\Filament\Resources\Content\NewsLetterResource\Pages;

use App\Filament\Resources\Content\NewsLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsLetters extends ListRecords
{
    protected static string $resource = NewsLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}