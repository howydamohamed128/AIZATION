<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string|null $app_logo;
    public string|null $fav_icon;
    public string $app_name;
    public string $app_email;
    public string $app_phone;
    public string $app_mobile;
    public string $app_whatsapp;
    public string $app_address;
    public string $description;
    public string $working_hours;
    public array $content;
    public array $social_links = [];


    public static function group(): string
    {
        return 'general';
    }
}