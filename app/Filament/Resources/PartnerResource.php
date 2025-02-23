<?php

namespace App\Filament\Resources;

use App\Models\Partner;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\PartnerResource\Pages;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Ana Səhifə';
    protected static ?string $pluralModelLabel = 'Tərəfdaşlarımız';



    protected static ?string $navigationLabel = 'Tərəfdaşlarımız';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tərəfdaş Adı')
                    ->required(),
                Forms\Components\FileUpload::make('logo')
                    ->label('Partner Logo')
                    ->image()
                    ->disk('public')
                    ->directory('partners')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Tərəfdaş Adı')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('logo')
                    ->label('Tərəfdaşımızın logosu')
                    ->formatStateUsing(function ($state) {
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
