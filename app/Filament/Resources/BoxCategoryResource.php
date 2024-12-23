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
    protected static ?string $navigationGroup = 'Creating items';

    // Define the form layout
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('box_size') // Add box_size to the form
            ->nullable() // Allow null values
            ->maxLength(255), // You can adjust the max length if needed
        ]);
    }

    // Define the table layout
    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('box_size') // Display box_size in the table
            ->sortable() // Allow sorting by box_size
            ->searchable(), // Make box_size searchable
        ])
            ->filters([
                // Add any filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Define the available pages for this resource
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBoxCategories::route('/'),
            'create' => Pages\CreateBoxCategory::route('/create'),
            'edit' => Pages\EditBoxCategory::route('/{record}/edit'),
        ];
    }
}
