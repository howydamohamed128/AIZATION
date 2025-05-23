<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void {
        $this->migrator->add('general.app_logo', '');
                $this->migrator->add('general.fav_icon', '');

        $this->migrator->add('general.app_name', 'John Doe');
        $this->migrator->add('general.app_email', 'john_doe@example.com');
        $this->migrator->add('general.app_address', 'Riyadh, Saudi Arabia');
        $this->migrator->add('general.app_phone', '5123456789');
        $this->migrator->add('general.app_whatsapp', '5123456789');

        $this->migrator->add('general.social_links', []);
                $this->migrator->add('general.app_mobile', '5125956789');

    }
};
