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
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Gift Boxes';

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

                // Color input to set the background color
                Forms\Components\TextInput::make('color')
                    ->label('Background Color')
                    ->default('#ffffff')  // Optional: Set a default color
                    ->required() // Optional: Set the field as required
                    ->reactive()
                    ->placeholder('#ffffff'), // Optional: Provide a placeholder
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public'),

                TextColumn::make('title_small')
                    ->label('Small Title'),

                TextColumn::make('title_large')
                    ->label('Large Title'),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(90),

                TextColumn::make('button_text')
                    ->label('Button Text'),

                TextColumn::make('link')
                    ->label('Link'),

                TextColumn::make('color')
                    ->label('Background Color'),
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


