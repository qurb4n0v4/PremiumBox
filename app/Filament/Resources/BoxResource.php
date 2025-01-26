<?php

namespace App\Filament\Resources;

use App\Models\Box;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\BoxResource\Pages;

class BoxResource extends Resource
{
    protected static ?string $model = Box::class;
    protected static ?string $navigationIcon = 'heroicon-o-gift-top';

    protected static ?string $navigationGroup = 'Ana Səhifə';

    protected static ?string $navigationLabel = 'Qutu məlumatları';

    protected static ?string $pluralModelLabel = 'Qutu məlumatları';
    protected static ?string $modelLabel = 'Qutu məlumatları';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title_small')
                    ->label('Small Title')
                    ->nullable(),

                Forms\Components\TextInput::make('title_large')
                    ->label('Large Title')
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->nullable(),

                Forms\Components\TextInput::make('button_text')
                    ->label('Button Text')
                    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('boxes'),

                Forms\Components\TextInput::make('link')
                    ->label('Link')
                    ->required()
                    ->url(),

                Forms\Components\TextInput::make('color')
                    ->label('Background Color')
                    ->default('#ffffff')
                    ->required()
                    ->reactive()
                    ->placeholder('#ffffff'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('image')
                    ->label('Şəkil')
                    ->formatStateUsing(function ($state) {
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),

                TextColumn::make('title_small')
                    ->label('Birinci Başlıq'),

                TextColumn::make('title_large')
                    ->label('İkinci Başlıq'),

                TextColumn::make('description')
                    ->label('Açıqlama')
                    ->limit(90),

                TextColumn::make('button_text')
                    ->label('Buton mətni'),

                TextColumn::make('link')
                    ->label('Link'),

                TextColumn::make('color')
                    ->label('Arxa fon rəngi'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBoxes::route('/'),
            'create' => Pages\CreateBox::route('/create'),
            'edit' => Pages\EditBox::route('/{record}/edit'),
        ];
    }
}


