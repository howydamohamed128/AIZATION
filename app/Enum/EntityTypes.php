<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum EntityTypes: string implements HasLabel {
    case EXPERT = 'expert';
    case PARTNER = 'partner';
    case ORGANIZATION = 'organization';
    public function getLabel(): ?string {
        return __("panel.enums.$this->value");
    }

    public function getColor(): string {
        return match ($this->value) {
            'expert', => 'warning',
            'partner'=> 'primary',
            'organization' => 'success',
        };

    }

}
