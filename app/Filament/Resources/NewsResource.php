<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\News;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use form\Components\select;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use function Laravel\Prompts\form;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NewsResource\Pages;


use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NewsResource\RelationManagers;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\select::make('author_id')
                    ->relationship('author', 'name')
                    ->required(),
                Forms\Components\select::make('category_id')
                    ->relationship('newsCategory', 'title')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required()
                    ->maxLength(255),
                Forms\components\textinput::make('slug')
                    ->readOnly(),
                Forms\Components\RichEditor::make('content')
                    ->required(),
                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                tables\Columns\TextColumn::make('author.name')->label('Author')->sortable()->searchable(),
                tables\Columns\TextColumn::make('newsCategory.title')->label('Category')->sortable()->searchable(),
                tables\columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'draft' => 'gray',
                    'reviewing' => 'warning',
                    'published' => 'success',
                    'rejected' => 'danger',
                    default => 'gray',
                }),
                tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->relationship('newsCategory', 'title'),
                Tables\Filters\SelectFilter::make('author')->relationship('author', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Tombol Approve
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (News $record) => $record->update(['status' => 'published'])), // <--- PERHATIKAN KOMA DI SINI

                // Tombol Reject
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                Forms\Components\Textarea::make('rejection_note')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->action(function (News $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'rejection_note' => $data['rejection_note'],
                        ]);
                    }),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
