<?php

namespace App\Filament\Resources;

use App\Models\GiftSet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\GiftSetResource\Pages;

class GiftSetResource extends Resource
{
    protected static ?string $model = GiftSet::class;
    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $navigationLabel = 'Gift Sets';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(30),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->nullable()
                    ->helperText('Provide a description of the gift set.'),

                Forms\Components\FileUpload::make('normal_image')
                    ->label('Normal Image')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('gift_sets')
                    ->helperText('Upload the normal image for the gift set.'),

                Forms\Components\FileUpload::make('hover_image')
                    ->label('Hover Image')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('gift_sets')
                    ->helperText('Upload the hover image for the gift set.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Corrected: No need to call image() method here
                Tables\Columns\TextColumn::make('normal_image')
                    ->label('Image')
                    ->formatStateUsing(function ($state) {
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(90),

                Tables\Columns\TextColumn::make('hover_image')
                    ->label('Hover image')
                    ->formatStateUsing(function ($state) {
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGiftSets::route('/'),
            'create' => Pages\CreateGiftSet::route('/create'),
            'edit' => Pages\EditGiftSet::route('/{record}/edit'),
        ];
    }
}
