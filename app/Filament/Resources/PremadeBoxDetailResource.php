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

    protected static ?string $navigationGroup = 'Hazır hədiyyə qutuları və məhsulları';
    protected static ?string $navigationLabel = 'Hazır qutu haqqında detaylı informasiya';

    protected static ?string $pluralModelLabel = 'Hazır qutu haqqında detaylı informasiya';
    protected static ?string $modelLabel = 'Hazır qutu haqqında detaylı informasiya';

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
                    ->directory('premade-box-details')
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
                    ->label('Hazır qutu')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('images')
                    ->label('Şəkil')
                    ->getStateUsing(fn (PremadeBoxDetail $record) => $record->images ?? [])
                    ->limit(1),

                Tables\Columns\TextColumn::make('paragraph')
                    ->label('Paraqraf'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Yaradıldı')
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
