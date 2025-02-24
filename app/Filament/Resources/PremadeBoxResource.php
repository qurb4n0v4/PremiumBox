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

    protected static ?string $navigationGroup = 'Hazır hədiyyə qutuları və məhsulları';
    protected static ?string $navigationLabel = 'Hazır qutular';

    protected static ?string $pluralModelLabel = 'Hazır qutular';
    protected static ?string $modelLabel = 'Hazır qutular';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(20),
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
                Tables\Columns\TextColumn::make('name')->searchable()->label('Adı'),
                Tables\Columns\TextColumn::make('title')->searchable()->label('Başlıq'),
                Tables\Columns\TextColumn::make('price')->label('Qiymət'),
                Tables\Columns\TextColumn::make('normal_image')
                    ->label('Şəkil')
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return '<img src="' . asset('storage/default-image.jpg') . '" alt="No Image Available" style="width: 100px; height: auto;" />';
                        }
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('hover_image')
                    ->label('Digər şəkil')
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return '<img src="' . asset('storage/default-image.jpg') . '" alt="No Image Available" style="width: 100px; height: auto;" />';
                        }
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('recipient')->label('Alıcı'),
                Tables\Columns\TextColumn::make('occasion')->label('Kateqoriya'),
                Tables\Columns\TextColumn::make('production_time')->label('İstehsal tarixi'),
                Tables\Columns\TextColumn::make('created_at')->label('Yaradıldı')->dateTime(),
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
