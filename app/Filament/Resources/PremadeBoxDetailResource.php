<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PremadeBoxDetailResource\Pages;
use App\Models\PremadeBoxDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use App\Models\PremadeBox;
use Illuminate\Database\Eloquent\Builder;

class PremadeBoxDetailResource extends Resource
{
    protected static ?string $model = PremadeBoxDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Premade Box Details';
    protected static ?string $pluralLabel = 'Premade Box Details';
    protected static ?string $singularLabel = 'Premade Box Detail';

    protected static ?string $navigationGroup = 'Premade Gift Boxes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('premade_box_id')
                    ->label('Premade Box')
                    ->options(PremadeBox::all()->pluck('name', 'id'))
                    ->required(),

                Forms\Components\FileUpload::make('images')
                    ->label('Images')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('premade-box-details/images')
                    ->nullable(),

                Forms\Components\TextArea::make('paragraph')
                    ->label('Paragraph')
                    ->nullable(),

                Forms\Components\Repeater::make('insiding')
                    ->schema([
                        Forms\Components\TextInput::make('item')
                            ->label('Item')
                            ->maxLength(255)
                            ->required(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->disk('public')
                            ->directory('insiding_images')
                            ->maxSize(10240)
                            ->nullable(),
                    ])
                    ->columns(1)
                    ->nullable(),

                Forms\Components\TextInput::make('recipient')
                    ->label('Recipient')
                    ->maxLength(255)
                    ->required(),

                Forms\Components\TextInput::make('occasion')
                    ->label('Occasion')
                    ->maxLength(255)
                    ->nullable(),

                Forms\Components\TextInput::make('production_time')
                    ->label('Production Time (days)')
                    ->numeric()
                    ->required(),
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

                Tables\Columns\ImageColumn::make('images')
                    ->label('Images')
                    ->getStateUsing(function(PremadeBoxDetail $record) {
                        $images = $record->images;
                        if (is_string($images)) {
                            return json_decode($images);
                        }
                        return $images ?? [];
                    })
                    ->limit(1),

                Tables\Columns\TextColumn::make('paragraph')
                    ->label('Paragraph')
                    ->limit(50),

                Tables\Columns\TextColumn::make('recipient')
                    ->label('Recipient'),

                Tables\Columns\TextColumn::make('occasion')
                    ->label('Occasion'),

                Tables\Columns\TextColumn::make('production_time')
                    ->label('Production Time (days)'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
            ])
            ->filters([]);
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
