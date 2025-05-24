<?php

namespace App\Filament\Resources\Entities\ExpertResource\Pages;

use App\Filament\Resources\Entities\ExpertResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExpert extends CreateRecord
{
    protected static string $resource = ExpertResource::class;

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

