<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CorporateGiftResource\Pages;
use App\Models\CorporateGift;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                    ->required()
                    ->columnSpan(2),
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(13),
                TextInput::make('paragraph')
                    ->label('Paragraph')
                    ->required()
                    ->maxLength(22),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(5)
                    ->maxLength(1000),
                FileUpload::make('images')
                    ->label('Additional Images')
                    ->directory('corporate_gifts')
                    ->multiple()
                    ->image()
                    ->columnSpan(2),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('image')
                    ->label('Image')
                    ->formatStateUsing(function ($state) {
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),
                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('paragraph')
                    ->label('Paragraph')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('M d, Y H:i'),
            ])
            ->filters([
                // Add filters if required
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
        return [
            // Add relationships if needed
        ];
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
