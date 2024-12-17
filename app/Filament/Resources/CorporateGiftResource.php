<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CorporateGiftResource\Pages;
use App\Models\CorporateGift;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;

class CorporateGiftResource extends Resource
{
    protected static ?string $model = CorporateGift::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $label = 'Corporate Gift';
    protected static ?string $pluralLabel = 'Corporate Gifts';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->label('Image')
                    ->directory('corporate_gifts')
                    ->image()
                    ->required(),
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('paragraph')
                    ->label('Paragraph')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Image'),
                TextColumn::make('title')->label('Title')->searchable(),
                TextColumn::make('paragraph')->label('Paragraph')->searchable(),
                TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCorporateGifts::route('/'),
            'create' => Pages\CreateCorporateGift::route('/create'),
            'edit' => Pages\EditCorporateGift::route('/{record}/edit'),
        ];
    }
}
