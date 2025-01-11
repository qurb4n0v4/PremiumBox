<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PremadeBoxCustomizeResource\Pages;
use App\Models\PremadeBoxCustomize;
use App\Models\GiftBox;
use App\Models\PremadeBox;
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
                    ->label('Premade Box')
                    ->options(PremadeBox::pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Forms\Components\Repeater::make('boxes')
                    ->schema([
                        Forms\Components\Select::make('gift_boxes_id')
                            ->label('Gift Box')
                            ->options(GiftBox::pluck('title', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $giftBox = GiftBox::find($state);

                                if ($giftBox) {
                                    $set('gift_boxes_title', $giftBox->title);

                                    $image = $giftBox->image;
                                    if (is_string($image)) {
                                        $image = json_decode($image, true);
                                    }
                                    $set('gift_boxes_image', $image);
                                } else {
                                    $set('gift_boxes_title', null);
                                    $set('gift_boxes_image', null);
                                }
                            }),

                        Forms\Components\TextInput::make('gift_boxes_title')
                            ->label('Gift Box Title')
                            ->disabled(),

                        Forms\Components\FileUpload::make('gift_boxes_image')
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

                Tables\Columns\TextColumn::make('boxes')
                    ->label('Gift Boxes')
                    ->formatStateUsing(function ($state) {
                        // Önce veriyi debug edelim
                        \Log::info('Boxes State:', ['state' => $state]);

                        if (empty($state) || !is_array($state)) {
                            return '-';
                        }

                        $result = collect($state)->map(function ($box) {
                            \Log::info('Box Item:', ['box' => $box]); // Her bir box'ı kontrol edelim

                            // Key'leri kontrol edelim
                            $title = data_get($box, 'gift_box_title', '-');

                            // Image verisi için güvenli erişim
                            $image = data_get($box, 'gift_box_image');
                            if (is_array($image)) {
                                $imagePath = data_get($image, 0, '-');
                            } else {
                                $imagePath = $image ?? '-';
                            }

                            // String formatını döndür
                            return sprintf('%s (%s)', $title, $imagePath);
                        });

                        \Log::info('Result:', ['result' => $result->toArray()]);

                        return $result->implode(', ');
                    })
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereJsonContains('boxes', ['gift_box_title' => $search]);
                    }),

                Tables\Columns\TextColumn::make('name')
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
