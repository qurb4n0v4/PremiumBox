<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PremadeBoxCustomizeResource\Pages;
use App\Models\PremadeBoxCustomize;
use App\Models\GiftBox;
use App\Models\Card;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Builder;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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

                Forms\Components\Repeater::make('boxes')
                    ->schema([
                        Forms\Components\Select::make('gift_box_id')
                            ->label('Gift Box')
                            ->options(GiftBox::pluck('title', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $giftBox = GiftBox::find($state);

                                if ($giftBox) {
                                    $set('gift_box_title', $giftBox->title);
                                    $set('gift_box_price', $giftBox->price);

                                    $image = $giftBox->image;
                                    if (is_string($image)) {
                                        $image = json_decode($image, true);
                                    }
                                    $set('gift_box_image', $image);
                                } else {
                                    $set('gift_box_title', null);
                                    $set('gift_box_price', null);
                                    $set('gift_box_image', null);
                                }
                            }),

                        Forms\Components\TextInput::make('gift_box_title')
                            ->label('Gift Box Title')
                            ->disabled(),

                        Forms\Components\TextInput::make('gift_box_price')
                            ->label('Gift Box Price')
                            ->disabled(),

                        Forms\Components\FileUpload::make('gift_box_image')
                            ->label('Gift Box Image')
                            ->image()
                            ->disabled()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                                return 'gift_boxes/' . $file->getClientOriginalName();
                            }),
                    ])
                    ->createItemButtonLabel('Add Gift Box')
                    ->label('Gift Boxes'),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name'),

                Forms\Components\Repeater::make('cards')
                    ->schema([
                        Forms\Components\Select::make('card_id')
                            ->label('Card')
                            ->options(Card::pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $card = Card::find($state);

                                if ($card) {
                                    $set('card_name', $card->name);
                                    $set('card_price', $card->price);
                                    $set('card_image', $card->image);

                                    $image = $card->image;
                                    if (is_string($image)) {
                                        $image = json_decode($image, true);
                                    }
                                    $set('card_image', $image);
                                } else {
                                    $set('card_name', null);
                                    $set('card_price', null);
                                    $set('card_image', null);
                                }
                            }),

                        Forms\Components\TextInput::make('card_name')
                            ->label('Card Name')
                            ->disabled(),

                        Forms\Components\TextInput::make('card_price')
                            ->label('Card Price')
                            ->disabled(),

                        Forms\Components\FileUpload::make('card_image')
                            ->label('Card Image')
                            ->image()
                            ->disabled()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                                return 'cards/' . $file->getClientOriginalName();
                            }),
                    ])
                    ->createItemButtonLabel('Add Card')
                    ->label('Cards')

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

                Tables\Columns\TextColumn::make('boxes')
                    ->label('Gift Boxes')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return '-';

                        return collect($state)->map(function ($box) {
                            return $box['gift_box_title'];
                        })->join(', ');
                    })
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('boxes', 'like', "%{$search}%");
                    }),

                Tables\Columns\TextColumn::make('cards')
                    ->label('Cards')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return '-';

                        return collect($state)->map(function ($card) {
                            return $card['card_name'];
                        })->join(', ');
                    })
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('cards', 'like', "%{$search}%");
                    }),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('card_image')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('card_name')
                    ->searchable()
                    ->sortable(),
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
