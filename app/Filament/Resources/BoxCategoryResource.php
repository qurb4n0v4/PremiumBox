<?php

namespace App\Filament\Resources;

use App\Models\BoxCategory;
use App\Filament\Resources\BoxCategoryResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class BoxCategoryResource extends Resource
{
    protected static ?string $model = BoxCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Gift Boxes Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('width')
                ->nullable() // Allow null values
                ->maxLength(255),

            Forms\Components\TextInput::make('height')
                ->nullable() // Allow null values
                ->maxLength(255),

            Forms\Components\TextInput::make('length')
                ->nullable() // Allow null values
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('width')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('height')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('length')->sortable()->searchable(),
        ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBoxCategories::route('/'),
            'create' => Pages\CreateBoxCategory::route('/create'),
            'edit' => Pages\EditBoxCategory::route('/{record}/edit'),
        ];
    }
}
