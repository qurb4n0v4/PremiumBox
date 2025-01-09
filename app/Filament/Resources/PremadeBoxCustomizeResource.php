<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PremadeBoxCustomizeResource\Pages;
use App\Models\PremadeBoxCustomize;
use App\Models\GiftBox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PremadeBoxCustomizeResource extends Resource
{
    protected static ?string $model = PremadeBoxCustomize::class;

    protected static ?string $slug = 'premade-box-customizes';

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Premade Box Customize';
    protected static ?string $navigationGroup = 'Premade Gift Boxes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('premade_boxes_id')
                    ->relationship('premadeBox', 'name')
                    ->required()
                    ->label('Premade Box')
                    ->searchable(),

                Forms\Components\Select::make('gift_box_id')
                    ->label('Gift Box')
                    ->options(GiftBox::pluck('title', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        $giftBox = GiftBox::find($state);

                        if ($giftBox) {
                            $boxData = [
                                'title' => $giftBox->title,
                                'price' => $giftBox->price,
                                'image' => $giftBox->image,
                            ];
                            $set('boxes', json_encode($boxData));
                        } else {
                            $set('boxes', null);
                        }
                    }),

                Forms\Components\Textarea::make('boxes')
                    ->label('Boxes Data')
                    ->disabled()
                    ->rows(3),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name'),

                Forms\Components\FileUpload::make('card_image')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('card-images')
                    ->maxSize(5120) // 5MB
                    ->label('Card Image'),

                Forms\Components\TextInput::make('card_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Card Name'),

                Forms\Components\Textarea::make('boxes')
                    ->nullable()
                    ->label('Boxes Configuration')
                    ->columnSpanFull()
                    ->json(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('premadeBox.name')
                    ->label('Premade Box')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('giftBox.name')
                    ->label('Gift Box')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('card_image')
                    ->label('Card Image'),

                Tables\Columns\TextColumn::make('card_name')
                    ->label('Card Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('boxes')
                    ->label('Boxes Data')
                    ->formatStateUsing(fn ($state) => json_decode($state, true)['title'] ?? 'N/A'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPremadeBoxCustomizes::route('/'),
            'create' => Pages\CreatePremadeBoxCustomize::route('/create'),
            'edit' => Pages\EditPremadeBoxCustomize::route('/{record}/edit'),
        ];
    }
}
