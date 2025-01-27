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

    protected static ?string $navigationGroup = 'Ana Səhifə';

    protected static ?string $navigationLabel = 'Pop up';

    protected static ?string $pluralModelLabel = 'Pop up';
    protected static ?string $modelLabel = 'Pop up';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title1')
                    ->label('Title for Image 1')
                    ->nullable()
                    ->default(''), // Default dəyər təyin olundu
                Forms\Components\FileUpload::make('image1')
                    ->label('Image 1')
                    ->nullable()
                    ->image()
                    ->directory('pop-up'),
                Forms\Components\TextInput::make('title2')
                    ->label('Title for Image 2')
                    ->nullable()
                    ->default(''), // Default dəyər təyin olundu
                Forms\Components\FileUpload::make('image2')
                    ->label('Image 2')
                    ->nullable()
                    ->image()
                    ->directory('pop-up'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title1')
                    ->label('Qutu hazırlama üçün başlıq')
                    ->formatStateUsing(fn ($state) => $state ?: '-'), // Boş dəyəri "-" kimi göstər
                Tables\Columns\TextColumn::make('image1')
                    ->label('Qutu hazırlama üçün şəkil')
                    ->formatStateUsing(function ($state) {
                        return $state
                            ? '<img src="' . asset('storage/' . $state) . '" alt="Image 1" style="width: 100px; height: auto;" />'
                            : 'No Image';
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('title2')
                    ->label('Hazır qutu üçün başlıq')
                    ->formatStateUsing(fn ($state) => $state ?: '-'), // Boş dəyəri "-" kimi göstər
                Tables\Columns\TextColumn::make('image2')
                    ->label('Hazır qutu üçün şəkil')
                    ->formatStateUsing(function ($state) {
                        return $state
                            ? '<img src="' . asset('storage/' . $state) . '" alt="Image 2" style="width: 100px; height: auto;" />'
                            : 'No Image';
                    })
                    ->html(),
            ])
            ->filters([
                // Buraya əlavə filtrlər əlavə edə bilərsiniz
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
