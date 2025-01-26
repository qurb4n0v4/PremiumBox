<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomProductDetailResource\Pages;
use App\Models\CustomProductDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class CustomProductDetailResource extends Resource
{
    protected static ?string $model = CustomProductDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = 'Hədiyyə qutuları və məhsulları';
    protected static ?string $navigationLabel = 'Tənzimləmələri olan məhsullar';

    protected static ?string $pluralModelLabel = 'Tənzimləmələri olan məhsullar';
    protected static ?string $modelLabel = 'Tənzimləmələri olan məhsullar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Əsas Məlumatlar')
                    ->schema([
                        Forms\Components\Select::make('choose_item_id')
                            ->relationship('chooseItem', 'name')
                            ->required()
                            ->label('Məhsul'),

                        Forms\Components\Toggle::make('same_day_delivery')
                            ->label('Eyni Gün Çatdırılma')
                            ->default(false),

                        Forms\Components\Textarea::make('description')
                            ->label('Məhsul Təsviri')
                            ->nullable(),

                        Forms\Components\FileUpload::make('images')
                            ->label('Məhsul Şəkilləri')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->directory('product-images')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->maxFiles(5)
                            ->columnSpanFull(),
                    ]),

                Section::make('Şəkil Yükləmə Parametrləri')
                    ->schema([
                        Forms\Components\Toggle::make('allow_user_images')
                            ->label('İstifadəçi şəkil yükləyə bilər')
                            ->default(false)
                            ->reactive(),

                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('image_upload_title')
                                    ->label('Şəkil yükləmə başlığı')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('allow_user_images')),

                                Forms\Components\TextInput::make('max_image_count')
                                    ->label('Maximum şəkil sayı')
                                    ->type('number')
                                    ->minValue(1)
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('allow_user_images')),
                            ]),
                    ])
                    ->collapsed()
                    ->collapsible(),

                Section::make('Variant Parametrləri')
                    ->schema([
                        Forms\Components\Toggle::make('has_variants')
                            ->label('Variant seçimi var')
                            ->default(false)
                            ->reactive(),

                        Forms\Components\TextInput::make('variant_selection_title')
                            ->label('Variant seçimi başlığı')
                            ->required()
                            ->hidden(fn (callable $get) => !$get('has_variants')),

                        Forms\Components\Repeater::make('variants')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Variant adı')
                                    ->required(),
                                Forms\Components\FileUpload::make('image')
                                    ->label('Variant şəkli')
                                    ->image()
                                    ->disk('public')
                                    ->directory('variants')
                                    ->required(),
                                Forms\Components\TextInput::make('price')
                                    ->label('Variant qiyməti')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->hidden(fn (callable $get) => !$get('has_variants'))
                            ->columnSpanFull()
                            ->defaultItems(0)
                            ->createItemButtonLabel('Variant əlavə et'),
                    ])
                    ->collapsed()
                    ->collapsible(),

                Section::make('Mətn Sahəsi Parametrləri')
                    ->schema([
                        Forms\Components\Toggle::make('has_custom_text')
                            ->label('Mətn sahəsi var')
                            ->default(false)
                            ->reactive(),

                        Forms\Components\TextInput::make('text_field_placeholder')
                            ->label('Mətn sahəsi placeholder')
                            ->required()
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
                    ->label('Məhsul')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('images')
                    ->label('Şəkillər')
                    ->circular()
                    ->stacked()
                    ->limit(3),

                Tables\Columns\BooleanColumn::make('same_day_delivery')
                    ->label('Eyni Gün Çatdırılma'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Təsvir')
                    ->limit(50),

                Tables\Columns\BooleanColumn::make('allow_user_images')
                    ->label('Şəkil yükləmə'),

                Tables\Columns\TextColumn::make('max_image_count')
                    ->label('Max şəkil sayı'),

                Tables\Columns\BooleanColumn::make('has_variants')
                    ->label('Variant seçimi'),

                Tables\Columns\BooleanColumn::make('has_custom_text')
                    ->label('Mətn sahəsi'),
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
            'index' => Pages\ListCustomProductDetails::route('/'),
            'create' => Pages\CreateCustomProductDetail::route('/create'),
            'edit' => Pages\EditCustomProductDetail::route('/{record}/edit'),
        ];
    }
}
