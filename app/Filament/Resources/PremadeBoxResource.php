<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PremadeBoxResource\Pages;
use App\Models\PremadeBox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class PremadeBoxResource extends Resource
{
    protected static ?string $model = PremadeBox::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Premade Boxes';
    protected static ?string $pluralLabel = 'Premade Boxes';
    protected static ?string $singularLabel = 'Premade Box';

    protected static ?string $navigationGroup = 'Premade Gift Boxes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required(),
                Forms\Components\FileUpload::make('normal_image')
                    ->label('Normal Image')
                    ->image()
                    ->directory('premade-boxes')
                    ->required(),
                Forms\Components\FileUpload::make('hover_image')
                    ->label('Hover Image')
                    ->image()
                    ->directory('premade-boxes')
                    ->nullable(),
                Forms\Components\Select::make('recipient')
                    ->options([
                        'kişi' => 'Kişi',
                        'qadın' => 'Qadın',
                        'qız uşağı' => 'Qız Uşağı',
                        'oğlan uşağı' => 'Oğlan Uşağı',
                        'hər ikisi' => 'Hər İkisi',
                    ])
                    ->nullable()
                    ->label('Recipient'),
                Forms\Components\TextInput::make('occasion')
                    ->nullable()
                    ->maxLength(255)
                    ->label('Occasion'),
                Forms\Components\TextInput::make('production_time')
                    ->numeric()
                    ->nullable()
                    ->label('Production Time'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('price')->sortable(),
                Tables\Columns\TextColumn::make('normal_image')
                    ->label('Normal Image')
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return '<img src="' . asset('storage/default-image.jpg') . '" alt="No Image Available" style="width: 100px; height: auto;" />';
                        }
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('hover_image')
                    ->label('Hover Image')
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return '<img src="' . asset('storage/default-image.jpg') . '" alt="No Image Available" style="width: 100px; height: auto;" />';
                        }
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('recipient')->label('Recipient')->sortable(),
                Tables\Columns\TextColumn::make('occasion')->label('Occasion')->sortable(),
                Tables\Columns\TextColumn::make('production_time')->label('Production Time')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
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
            'index' => Pages\ListPremadeBoxes::route('/'),
            'create' => Pages\CreatePremadeBox::route('/create'),
            'edit' => Pages\EditPremadeBox::route('/{record}/edit'),
        ];
    }
}
