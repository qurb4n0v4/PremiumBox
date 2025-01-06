<?php

namespace App\Filament\Resources;

use App\Models\GiftBox;
use App\Filament\Resources\GiftBoxResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use App\Models\BoxCategory;
use Filament\Tables\Columns\ImageColumn;

class GiftBoxResource extends Resource
{
    protected static ?string $model = GiftBox::class;
    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Gift Boxes Management';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('company_name')
                ->required()
                ->maxLength(14),
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(15),
            Forms\Components\TextInput::make('price')
                ->required()
                ->numeric(),
            Forms\Components\Select::make('box_category_id')
                ->relationship('category', 'name')
                ->options(BoxCategory::pluck('name', 'id'))
                ->required(),
            Forms\Components\FileUpload::make('image')
                ->image()
                ->required()
                ->maxSize(5 * 1024)
                ->disk('public')
                ->directory('gift-box-images')
                ->columnSpan(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('company_name')->searchable(),
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('price'),
            Tables\Columns\TextColumn::make('boxCategory.name')->label('Category'),
            Tables\Columns\TextColumn::make('image')
                ->label('Image')
                ->formatStateUsing(function ($state) {
                    return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                })
                ->html(),
        ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGiftBoxes::route('/'),
            'create' => Pages\CreateGiftBox::route('/create'),
            'edit' => Pages\EditGiftBox::route('/{record}/edit'),
        ];
    }
}
