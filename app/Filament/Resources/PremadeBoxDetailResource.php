<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PremadeBoxDetailResource\Pages;
use App\Models\PremadeBoxDetail;
use App\Models\PremadeBox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class PremadeBoxDetailResource extends Resource
{
    protected static ?string $model = PremadeBoxDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Premade Box Details';
    protected static ?string $pluralLabel = 'Premade Box Details';
    protected static ?string $singularLabel = 'Premade Box Detail';
    protected static ?string $navigationGroup = 'Premade Gift Boxes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('premade_box_id')
                    ->label('Premade Box')
                    ->options(PremadeBox::pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\FileUpload::make('images')
                    ->label('Images')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('premade-box-details/images')
                    ->nullable(),

                Forms\Components\Textarea::make('paragraph')
                    ->label('Paragraph')
                    ->rows(4)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('premadeBox.name')
                    ->label('Premade Box')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('images')
                    ->label('Images')
                    ->getStateUsing(fn (PremadeBoxDetail $record) => $record->images ?? [])
                    ->limit(1),

                Tables\Columns\TextColumn::make('paragraph')
                    ->label('Paragraph')
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
            ])
            ->filters([])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPremadeBoxDetails::route('/'),
            'create' => Pages\CreatePremadeBoxDetail::route('/create'),
            'edit' => Pages\EditPremadeBoxDetail::route('/{record}/edit'),
        ];
    }
}
