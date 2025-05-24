<?php

namespace App\Filament\Resources\Entities\ExpertResource\Pages;

use App\Filament\Resources\Entities\ExpertResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExperts extends ListRecords
{
    protected static string $resource = ExpertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
