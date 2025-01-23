<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PremadeBoxInsidingResource\Pages;
use App\Models\PremadeBoxInsiding;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PremadeBoxInsidingResource extends Resource
{
    protected static ?string $model = PremadeBoxInsiding::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Premade Box Insidings';

    protected static ?string $navigationGroup = 'Premade Gift Boxes';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Əsas Məlumatlar')
                    ->schema([
                        Forms\Components\Select::make('premade_box_id')
                            ->relationship('premadeBox', 'name')
                            ->required()
                            ->label('Hazır Qutu')
                            ->default('Default Name'),

                        Forms\Components\TextInput::make('name')
                            ->label('Ad')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image')
                            ->label('Məhsul Şəkli')
                            ->image()
                            ->required()
                            ->directory('premade-box-insidings'),

                        Forms\Components\TextInput::make('quantity')
                            ->label('Say')
                            ->required()
                            ->default(1)
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(100)
                            ->step(1),

                    ]),

                Section::make('Şəkil Yükləmə Parametrləri')
                    ->schema([
                        Forms\Components\Toggle::make('allow_image_upload')
                            ->label('Şəkil Yükləmə İcazəsi')
                            ->default(false)
                            ->reactive(),

                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('image_upload_title')
                                    ->label('Şəkil Yükləmə Başlığı')
                                    ->hidden(fn (callable $get) => !$get('allow_image_upload')),

                                Forms\Components\TextInput::make('max_image_count')
                                    ->label('Maximum Şəkil Sayı')
                                    ->type('number')
                                    ->minValue(1)
                                    ->hidden(fn (callable $get) => !$get('allow_image_upload')),
                            ]),
                    ])
                    ->collapsed()
                    ->collapsible(),

                Section::make('Mətn Sahəsi Parametrləri')
                    ->schema([
                        Forms\Components\Toggle::make('allow_text')
                            ->label('Mətn Sahəsi İcazəsi')
                            ->default(false)
                            ->reactive(),

                        Forms\Components\TextInput::make('text_field_placeholder')
                            ->label('Mətn Sahəsi Placeholder')
                            ->hidden(fn (callable $get) => !$get('allow_text')),
                    ])
                    ->collapsed()
                    ->collapsible(),

                Section::make('Variant Parametrləri')
                    ->schema([
                        Forms\Components\Toggle::make('allow_variant_selection')
                            ->label('Variant Seçimi İcazəsi')
                            ->default(false)
                            ->reactive(),

                        Forms\Components\Repeater::make('variant_options')
                            ->label('Variantlar')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Variant Adı')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('price')
                                    ->label('Variant Qiyməti')
                                    ->nullable()
                                    ->numeric(),
                            ])
                            ->hidden(fn (callable $get) => !$get('allow_variant_selection'))
                            ->columnSpanFull()
                            ->defaultItems(0)
                            ->createItemButtonLabel('Variant Əlavə Et'),
                    ])
                    ->collapsed()
                    ->collapsible(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('premadeBox.name')
                    ->label('Premade Box Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')->sortable(),
                Tables\Columns\TextColumn::make('image')
                    ->label('Məhsul Şəkli')
                    ->formatStateUsing(function ($state) {
                        return '<img src="' . asset('storage/' . $state) . '" alt="Məhsul Şəkli" style="width: 100px; height: auto;" />';
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('quantity')->sortable(),
                Tables\Columns\BooleanColumn::make('allow_image_upload')->sortable(),
                Tables\Columns\TextColumn::make('image_upload_title')->default(fn ($record) => $record->image_upload_title ?? 'No title'),
                Tables\Columns\TextColumn::make('max_image_count')->default(fn ($record) => $record->max_image_count ?? 0),
                Tables\Columns\BooleanColumn::make('allow_text')->sortable(),
                Tables\Columns\TextColumn::make('text_field_placeholder')->default(fn ($record) => $record->text_field_placeholder ?? 'No placeholder'),
                Tables\Columns\BooleanColumn::make('allow_variant_selection')->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPremadeBoxInsidings::route('/'),
            'create' => Pages\CreatePremadeBoxInsiding::route('/create'),
            'edit' => Pages\EditPremadeBoxInsiding::route('/{record}/edit'),
        ];
    }
}
