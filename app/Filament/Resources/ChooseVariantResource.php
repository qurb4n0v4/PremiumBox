<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChooseVariantResource\Pages;
use App\Models\ChooseVariant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class ChooseVariantResource extends Resource
{
    protected static ?string $model = ChooseVariant::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationLabel = 'Choose Variants';

    protected static ?string $navigationGroup = 'Gift Boxes Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General Information')
                    ->schema([
                        Forms\Components\Select::make('choose_item_id')
                            ->relationship('chooseItem', 'name')
                            ->required()
                            ->label('Product'),

                        Forms\Components\FileUpload::make('images')
                            ->label('Images')
                            ->image()
                            ->multiple()
                            ->disk('public')
                            ->directory('variant-images')
                            ->reorderable()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('available_same_day_delivery')
                            ->label('Same Day Delivery')
                            ->default(false),

                        Forms\Components\Textarea::make('paragraph')
                            ->label('Description')
                            ->nullable(),
                    ]),
                Section::make('Variant Settings')
                    ->schema([
                        Forms\Components\Toggle::make('has_variants')
                            ->label('Has Variants')
                            ->default(false)
                            ->reactive(),

                        Forms\Components\TextInput::make('variant_selection_title')
                            ->label('Variant Selection Title')
                            ->required()
                            ->hidden(fn (callable $get) => !$get('has_variants')),

                        Forms\Components\Repeater::make('variants')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Variant Name')
                                    ->required(),

                                Forms\Components\FileUpload::make('image')
                                    ->label('Variant Image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('variant-images')
                                    ->required(),

                                Forms\Components\TextInput::make('price')
                                    ->label('Variant Price')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->hidden(fn (callable $get) => !$get('has_variants'))
                            ->columnSpanFull()
                            ->defaultItems(0)
                            ->createItemButtonLabel('Add Variant'),
                    ])
                    ->collapsed()
                    ->collapsible(),
                Section::make('Custom Text Settings')
                    ->schema([
                        Forms\Components\Toggle::make('has_custom_text')
                            ->label('Has Custom Text')
                            ->default(false)
                            ->reactive(),

                        Forms\Components\TextInput::make('text_field_placeholder')
                            ->label('Text Field Placeholder')
                            ->hidden(fn (callable $get) => !$get('has_custom_text')),
                    ])
                    ->collapsed()
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('chooseItem.name')
                    ->label('Product')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('images')
                    ->label('Images')
                    ->circular()
                    ->stacked()
                    ->limit(3),

                Tables\Columns\BooleanColumn::make('available_same_day_delivery')
                    ->label('Same Day Delivery'),

                Tables\Columns\TextColumn::make('paragraph')
                    ->label('Description')
                    ->limit(50),

                Tables\Columns\BooleanColumn::make('has_variants')
                    ->label('Has Variants'),

                Tables\Columns\BooleanColumn::make('has_custom_text')
                    ->label('Has Custom Text'),

                Tables\Columns\TextColumn::make('text_field_placeholder')
                    ->label('Text Field Placeholder')
                    ->limit(30),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListChooseVariants::route('/'),
            'create' => Pages\CreateChooseVariant::route('/create'),
            'edit' => Pages\EditChooseVariant::route('/{record}/edit'),
        ];
    }
}
