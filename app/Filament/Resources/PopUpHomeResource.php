<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PopUpHomeResource\Pages;
use App\Models\PopUpHome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class PopUpHomeResource extends Resource
{
    protected static ?string $model = PopUpHome::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square-stack';

    protected static ?string $navigationGroup = 'Content Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title1')
                    ->label('Title for Image 1')
                    ->required(),
                Forms\Components\FileUpload::make('image1')
                    ->label('Image 1')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('title2')
                    ->label('Title for Image 2')
                    ->required(),
                Forms\Components\FileUpload::make('image2')
                    ->label('Image 2')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title1')
                    ->label('Title 1'),
                Tables\Columns\TextColumn::make('image1')
                    ->label('Image 1')
                    ->formatStateUsing(function ($state) {
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('title2')
                    ->label('Title 2'),
                Tables\Columns\TextColumn::make('image2')
                    ->label('Image 2')
                    ->formatStateUsing(function ($state) {
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPopUpHomes::route('/'),
            'create' => Pages\CreatePopUpHome::route('/create'),
            'edit' => Pages\EditPopUpHome::route('/{record}/edit'),
        ];
    }
}
