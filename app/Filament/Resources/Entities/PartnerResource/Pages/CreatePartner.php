<?php

namespace App\Filament\Resources\Entities\PartnerResource\Pages;

use App\Filament\Resources\Entities\PartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePartner extends CreateRecord
{
    protected static string $resource = PartnerResource::class;
    use CreateRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\LocaleSwitcher::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
