<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChooseItemResource\Pages;
use App\Models\ChooseItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ChooseItemResource extends Resource
{
    protected static ?string $model = ChooseItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Gift Boxes Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),

                Forms\Components\Select::make('button')
                    ->options([
                        'Add to Box' => 'Add to Box',
                        'Custom Product' => 'Custom Product',
                        'Choose Variant' => 'Choose Variant',
                    ])
                    ->required(),

                Forms\Components\FileUpload::make('normal_image')
                    ->required()
                    ->image(),

                Forms\Components\FileUpload::make('hover_image')
                    ->image(), // Optional image upload
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('price')->sortable(),
                Tables\Columns\TextColumn::make('button')->sortable(),
                Tables\Columns\ImageColumn::make('normal_image')
                    ->label('Normal Image'),
                Tables\Columns\ImageColumn::make('hover_image')
                    ->label('Hover Image'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([]);
    }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChooseItems::route('/'),
            'create' => Pages\CreateChooseItem::route('/create'),
            'edit' => Pages\EditChooseItem::route('/{record}/edit'),
        ];
    }
}
