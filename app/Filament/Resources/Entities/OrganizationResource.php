<?php

namespace App\Filament\Resources\Entities;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enum\ModelStatus;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use App\Models\Entities\Organization;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Filament\HasTranslationLabel;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\Entities\OrganizationResource\Pages;
use App\Filament\Resources\Entities\OrganizationResource\RelationManagers;

class OrganizationResource extends Resource
{
    use HasTranslationLabel;
    use Translatable;
    protected static ?string $model = Organization::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 3;

     public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('basic_information')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label(__('forms.fields.image'))
                            ->required(),
                        // TextInput::make('name'),
                        TextInput::make('meta_data.link')
                            ->url()
                            ->label(__('forms.fields.link')),
                        Toggle::make('status')
                            ->default(1)
                            ->onColor('success')
                            ->offColor('danger'),
                        Hidden::make('type')->default('organization'),
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')->rowIndex(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('forms.fields.image'))
                    ->translateLabel(),
                // TextColumn::make('name'),
                IconColumn::make('status')
                    ->boolean()
                    ->action(
                        Action::make('Active')
                            ->label(fn(Organization $record): string => $record->status ? __('panel.messages.deactivate') : __('panel.messages.activate'))
                            ->disabled(fn(Model $record): bool => !auth()->user()->can('update', $record))
                            ->requiresConfirmation()
                            ->action(fn(Organization $record) => $record->toggleStatus())

                    ),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('status')
                    ->options(ModelStatus::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.entities');
    }
}
