<?php

namespace App\Filament\Resources\Content;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\NewsLetter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Mail\SendEmailNotification;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use App\Traits\Filament\HasTranslationLabel;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use App\Filament\Resources\NewsLetterResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use App\Filament\Resources\Content\NewsLetterResource\Pages\ListNewsLetters;

class NewsLetterResource extends Resource implements HasShieldPermissions
{
    use HasTranslationLabel;

    protected static ?string $model = NewsLetter::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('created_at')->date('Y-m-d H:i:s'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Action::make('sendMessage')
                //     ->label(__('panel.actions.send_message'))
                //     ->icon('heroicon-o-envelope-open')
                //     ->form([
                //         TextInput::make('title')
                //             ->label(__('forms.fields.address'))
                //             ->required(),
                //         Textarea::make('message')
                //             ->label(__('forms.fields.message_body'))
                //             ->required()
                //             ->rows(10)
                //             ->translateLabel(),
                //     ])
                //     ->action(function (array $data, NewsLetter $record): void {
                //         // Mail::to($record->email)->send(new SendEmailNotification($data['title'], $data['message']));
                //         \Filament\Notifications\Notification::make()->title(__('panel.messages.success'))
                //         ->body(__('panel.messages.sms_email_successfully'))
                //         ->success()
                //         ->send();
                //     }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->exports([
                        ExcelExport::make('CSV')
                            ->fromTable()
                            ->withFilename(fn () => static::getPluralLabel().'-'.now()->format('Y-m-d'))
                            ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                    ]),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNewsLetters::route('/'),
            // 'create' => Pages\CreateNewsLetter::route('/create'),
            // 'edit' => Pages\EditNewsLetter::route('/{record}/edit'),
        ];
    }

    // public static function getNavigationGroup(): ?string
    // {
    //     return __('menu.content');
    // }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view_any',
        ];
    }

    public static function can(string $action, ?Model $record = null): bool
    {
        return true;
    }
}