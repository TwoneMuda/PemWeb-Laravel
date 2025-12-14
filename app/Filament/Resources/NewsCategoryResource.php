<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use function Laravel\Prompts\form;
use function Laravel\Prompts\table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Resources\NewsCategoryResource\Pages;
use App\Filament\Resources\NewsCategoryResource\RelationManagers;

class NewsCategoryResource extends Resource
{
    protected static ?string $model = NewsCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->readOnly()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                tables\Columns\TextColumn::make('slug')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListNewsCategories::route('/'),
            'create' => Pages\CreateNewsCategory::route('/create'),
            'edit' => Pages\EditNewsCategory::route('/{record}/edit'),
        ];
    }
}
