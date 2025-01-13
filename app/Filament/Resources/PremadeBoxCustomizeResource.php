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
use Illuminate\Database\Eloquent\Builder;

class PremadeBoxCustomizeResource extends Resource
{
    protected static ?string $model = PremadeBoxCustomize::class;
    protected static ?string $slug = 'premade-box-customizes';
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Premade Box Customize';
    protected static ?string $navigationGroup = 'Premade Gift Boxes';

    public static function form(Form $form): Form
    {
        return $form->schema([
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
                        ->afterStateUpdated(function ($state, callable $set) {
                            $giftBox = GiftBox::find($state);
                            if ($giftBox) {
                                $set('gift_boxes_title', $giftBox->title);
                                $set('gift_boxes_image', $giftBox->image);
                            }
                        }),

                    Forms\Components\Hidden::make('gift_boxes_title'),
                    Forms\Components\Hidden::make('gift_boxes_image'),
                ])
                ->createItemButtonLabel('Add Gift Box')
                ->label('Gift Boxes')
                ->columns(1)
                ->defaultItems(1)
                ->minItems(1)
                ->maxItems(10)
                ->grid(1)
                ->collapsible()
                ->cloneable()
                ->reorderable()
                ->columnSpanFull(),

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
                        ->getStateUsing(function ($record) {
                            if (!$record->boxes) {
                                return '-';
                            }

                            $boxes = is_string($record->boxes) ? json_decode($record->boxes, true) : $record->boxes;

                            return collect($boxes)->map(function ($box) {
                                $giftBox = GiftBox::find($box['gift_boxes_id']);
                                if (!$giftBox) return '-';

                                return sprintf(
                                    "ID: %s | Title: %s <br> <img src='%s' style='max-width: 50px; height: auto;'>",
                                    $giftBox->id,
                                    $giftBox->title,
                                    asset($giftBox->image)
                                );
                            })->implode('<br><hr><br>');
                    })
                    ->html()
                    ->wrap()
                    ->alignLeft(),

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
