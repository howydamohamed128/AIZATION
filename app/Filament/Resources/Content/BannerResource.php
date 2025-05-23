<?php

namespace App\Filament\Resources\Content;

use Filament\Tables;
use Filament\Forms\Form;
use App\Enum\ModelStatus;
use Filament\Tables\Table;
use App\Models\Content\Banner;
use Filament\Resources\Resource;
use App\Filament\Resources\Content;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Traits\Filament\HasTranslationLabel;
use Filament\Resources\Concerns\Translatable;
use App\Filament\Resources\BannerResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Filament\Resources\BannerResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use App\Filament\Resources\Content\BannerResource\Pages\EditBanner;
use App\Filament\Resources\Content\BannerResource\Pages\CreateBanner;

class BannerResource extends Resource implements HasShieldPermissions
{
    use HasTranslationLabel;
    use Translatable;

    protected static ?string $model = Banner::class;
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form->schema([
            SpatieMediaLibraryFileUpload::make('image')
                ->label(__('forms.fields.image'))
                ->required(),
            RichEditor::make('title')
                ->required()
                ->columnSpan([
                    'xl' => 2,
                ])
                ->translateLabel(),
            RichEditor::make('sub_title')
                ->required()
                ->columnSpan([
                    'xl' => 2,
                ])
                ->translateLabel(),
            RichEditor::make('description')
                ->required()
                ->columnSpan([
                    'xl' => 2,
                ])
                ->translateLabel(),

            Toggle::make('status')->default(1)
                ->onColor('success')
                ->offColor('danger'),
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title')->html()->limit(30)->tooltip(fn($record) => strip_tags($record->title)),
                TextColumn::make('sub_title')->html()->limit(30)->tooltip(fn($record) => strip_tags($record->sub_title)),
                TextColumn::make('description')->html()->limit(30)->tooltip(fn($record) => strip_tags($record->description)),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('forms.fields.image'))
                    ->translateLabel(),
                TextColumn::make('created_at')
                    ->date('d/m/Y H:i:s'),
                IconColumn::make('status')
                    ->boolean()
                    ->action(
                        \Filament\Tables\Actions\Action::make('active')
                            ->label(fn(Banner $record): string => $record->status ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            ->disabled(fn(Model $record): bool => !filament()->auth()->user()->can('update', $record))
                            ->requiresConfirmation()
                            ->action(fn(Banner $record) => $record->toggleStatus())
                    ),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('status')
                    ->options(ModelStatus::class)
            ])
            ->actions([
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\RestoreBulkAction::make(),
                    // ExportBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Content\BannerResource\Pages\ListBanners::route('/'),
            'create' => CreateBanner::route('/create'),
            'edit' => EditBanner::route('/{record}/edit'),
        ];
    }

    // public static function getNavigationGroup(): ?string
    // {
    //     return __('menu.banners');
    // }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view_any',
            'create',
            'update',
            'delete',
            'export',
            'restore',
            'delete_any',
        ];
    }
}
