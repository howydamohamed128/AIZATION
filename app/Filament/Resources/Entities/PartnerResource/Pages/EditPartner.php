<?php

namespace App\Filament\Resources\Entities\PartnerResource\Pages;

use App\Filament\Resources\Entities\PartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPartner extends EditRecord
{
    protected static string $resource = PartnerResource::class;

    use EditRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            // Actions\LocaleSwitcher::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
