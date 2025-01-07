<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GiftBoxDetailResource\Pages;
use App\Models\GiftBoxDetail;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GiftBoxDetailResource extends Resource
{
    protected static ?string $model = GiftBoxDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = 'Gift Boxes Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('gift_box_id')
                    ->relationship('giftBox', 'title')
                    ->required()
                    ->label('Gift Box'),
                Forms\Components\FileUpload::make('images')
                    ->multiple()
                    ->label('Images')
                    ->required(),
                Forms\Components\TextInput::make('box_name')
                    ->required()
                    ->label('Box Name'),
                Forms\Components\Toggle::make('available_same_day_delivery')
                    ->label('Available for Same Day Delivery'),
                Forms\Components\Textarea::make('paragraph')
                    ->label('Paragraph')
                    ->nullable(),
                Forms\Components\Textarea::make('additional')
                    ->label('Additional Information')
                    ->nullable(),
                Forms\Components\FileUpload::make('customize_image')
                ->label('Customize Image')
                    ->image()
                    ->directory('customize-images'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('giftBox.title')
                    ->label('Gift Box'),
                Tables\Columns\TextColumn::make('box_name')
                    ->label('Box Name'),
                Tables\Columns\BooleanColumn::make('available_same_day_delivery')
                    ->label('Same Day Delivery'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGiftBoxDetails::route('/'),
            'create' => Pages\CreateGiftBoxDetail::route('/create'),
            'edit' => Pages\EditGiftBoxDetail::route('/{record}/edit'),
        ];
    }
}
