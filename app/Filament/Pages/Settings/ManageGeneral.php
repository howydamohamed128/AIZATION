<?php

namespace App\Filament\Pages\Settings;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\Catalog\BranchResource;
use App\Forms\Components\SelectFontAwesomeIcon;
use App\Models\Content\Page;
use App\Settings\GeneralSettings;
use App\Traits\Filament\HasTranslationLabel;
use Filament\Forms\Components\Section;

class ManageGeneral extends SettingsPage
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string $settings = GeneralSettings::class;
    protected static ?string $slug = 'settings/general';
    protected static ?int $navigationSort = 4;
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('SettingsTabs')
                    ->tabs([
                        // Tab 1: General
                        Forms\Components\Tabs\Tab::make(__('sections.general'))
                            ->schema([
                                FileUpload::make('app_logo'),
                                FileUpload::make('fav_icon')->label(__('forms.fields.favicon')),
                                TextInput::make('app_name'),
                                TextInput::make('app_email')
                                    ->email()
                                    ->required(),
                                TextInput::make('app_phone')
                                    ->type('number')
                                    ->numeric()
                                    ->required(),
                            ]),
                        Forms\Components\Tabs\Tab::make(__('sections.footer'))
                            ->schema([
                                Section::make('footer')
                                    ->heading('')
                                    ->schema([
                                        FileUpload::make('footer.image')->label(__('forms.fields.image')),
                                        FileUpload::make('footer.logo')->label(__('forms.fields.logo')),
                                        Tabs::make('Label')
                                            ->tabs([
                                                Tabs\Tab::make(__('panel.languages.arabic'))
                                                    ->schema([
                                                        Textarea::make('footer.title.ar')
                                                            ->label(__('forms.fields.title'))
                                                            ->required(),
                                                        Textarea::make('footer.sub_title.ar')
                                                            ->label(__('forms.fields.sub_title'))
                                                            ->required(),
                                                    ]),
                                                Tabs\Tab::make(__('panel.languages.english'))
                                                    ->schema([
                                                        Textarea::make('footer.title.en')
                                                            ->label(__('forms.fields.title'))
                                                            ->required(),
                                                        Textarea::make('footer.sub_title.en')
                                                            ->label(__('forms.fields.sub_title'))
                                                            ->required(),
                                                    ]),
                                            ]),
                                    ])->collapsible()
                                    ->statePath('content')
                            ]),
                        Forms\Components\Tabs\Tab::make(__('sections.posts_settings'))
                            ->schema([
                                Section::make('posts')
                                    ->heading('')
                                    ->schema([
                                        FileUpload::make('posts.image')->label(__('forms.fields.image')),
                                        Tabs::make('Label')
                                            ->tabs([
                                                Tabs\Tab::make(__('panel.languages.arabic'))
                                                    ->schema([
                                                        Textarea::make('posts.title.ar')
                                                            ->label(__('forms.fields.title'))
                                                            ->required(),
                                                        Textarea::make('posts.sub_title.ar')
                                                            ->label(__('forms.fields.sub_title'))
                                                            ->required(),
                                                        Textarea::make('posts.description.ar')
                                                            ->label(__('forms.fields.description'))
                                                            ->required(),
                                                    ]),
                                                Tabs\Tab::make(__('panel.languages.english'))
                                                    ->schema([
                                                        Textarea::make('posts.title.en')
                                                            ->label(__('forms.fields.title'))
                                                            ->required(),
                                                        Textarea::make('posts.sub_title.en')
                                                            ->label(__('forms.fields.sub_title'))
                                                            ->required(),
                                                        Textarea::make('posts.description.en')
                                                            ->label(__('forms.fields.description'))
                                                            ->required(),
                                                    ]),
                                            ]),
                                    ])->collapsible()
                                    ->statePath('content')
                            ]),
                        Forms\Components\Tabs\Tab::make(__('sections.social_links'))
                            ->schema([
                                Repeater::make('social_links')->schema([
                                    SelectFontAwesomeIcon::make('icon')->searchable()->allowHtml(),
                                    TextInput::make('link')->url(),
                                ]),
                            ]),

                    ])->columns(1),
            ])->columns(1);
    }

    public static function getNavigationLabel(): string
    {
        return __("menu.general");
    }

    public function getHeading(): string|Htmlable
    {
        return __('sections.global_settings');
    }

    // public static function getNavigationGroup(): ?string
    // {
    //     return __('menu.settings');
    // }

    public function getTitle(): string|Htmlable
    {
        return __('sections.global_settings');
    }


    public function getBreadcrumbs(): array
    {
        return [
            null => static::getNavigationGroup(),
            static::getUrl() => static::getNavigationLabel(),
        ];
    }
}
