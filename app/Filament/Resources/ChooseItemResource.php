<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChooseItemResource\Pages;
use App\Models\ChooseItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;

class ChooseItemResource extends Resource
{
    protected static ?string $model = ChooseItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationLabel = 'Choose Items';

    protected static ?string $pluralLabel = 'Choose Items';
    protected static ?string $navigationGroup = 'Gift Boxes Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('company_name')
                    ->required()
                    ->maxLength(18),
                TextInput::make('name')
                    ->required()
                    ->maxLength(14),
                TextInput::make('price')
                    ->required()
                    ->numeric(),
                Select::make('button')
                    ->options([
                        'Add to Box' => 'Add to Box',
                        'Custom Product' => 'Custom Product',
                        'Choose Variant' => 'Choose Variant',
                    ])
                    ->required(),
                FileUpload::make('normal_image')
                    ->required(),
                FileUpload::make('hover_image'),
                TextInput::make('category')
                    ->required()
                    ->maxLength(255),
                TextInput::make('production_time')
                    ->required()
                    ->numeric(),
                TextInput::make('width')
                    ->required()
                    ->numeric(),
                TextInput::make('height')
                    ->required()
                    ->numeric(),
                TextInput::make('length')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_name')->sortable()->searchable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('price')->sortable(),
                TextColumn::make('button')->sortable(),
                TextColumn::make('category')->sortable()->searchable(),
                TextColumn::make('production_time')->sortable(),
                TextColumn::make('width'),
                TextColumn::make('height'),
                TextColumn::make('length'),
                TextColumn::make('created_at')->label('Created')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('button')
                    ->options([
                        'Add to Box' => 'Add to Box',
                        'Custom Product' => 'Custom Product',
                        'Choose Variant' => 'Choose Variant',
                    ]),
            ]);
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
