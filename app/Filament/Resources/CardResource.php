<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardResource\Pages;
use App\Models\Card;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class CardResource extends Resource
{
    protected static ?string $model = Card::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Cards';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Kartın Adı')
                ->required()
                ->maxLength(255),

            TextInput::make('price')
                ->label('Kartın Qiyməti')
                ->numeric()
                ->nullable()
                ->minValue(0)
                ->maxLength(10)
                ->placeholder('Məsələn: 99.99'),

            FileUpload::make('image')
                ->label('Kartın Şəkli')
                ->image()
                ->required()
                ->disk('public')
                ->directory('card_images'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Kartın Adı')->sortable()->searchable(),
            Tables\Columns\ImageColumn::make('image')->label('Kartın Şəkli')->sortable(),
            Tables\Columns\TextColumn::make('price')
                ->label('Kartın Qiyməti')
                ->sortable()
                ->formatStateUsing(fn ($state) => $state !== null ? number_format($state, 2) . ' ₺' : 'Qiymət verilməyib'),
            Tables\Columns\TextColumn::make('created_at')->label('Yaradılma Tarixi')->sortable(),
        ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }
}
