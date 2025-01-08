<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomProductDetailResource\Pages;
use App\Models\CustomProductDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class CustomProductDetailResource extends Resource
{
    protected static ?string $model = CustomProductDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationLabel = 'Custom Product Details';

    protected static ?string $navigationGroup = 'Gift Boxes Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('same_day_delivery')
                    ->label('Eyni Gün Çatdırılma Mövcuddur')
                    ->default(false),

                Forms\Components\Textarea::make('description')
                    ->label('Təsvir')
                    ->nullable(),

                Forms\Components\FileUpload::make('images')
                    ->label('Şəkillər')
                    ->multiple()
                    ->disk('public') // Şəkillər "public" diskində saxlanacaq
                    ->nullable(),

                Forms\Components\Toggle::make('require_user_images')
                    ->label('Şəkil əlavə etmə tələb olunur')
                    ->default(false),

                Forms\Components\TextInput::make('user_image_title')
                    ->label('Şəkil əlavə et başlığı')
                    ->nullable()
                    ->visible(fn (callable $get) => $get('require_user_images')),

                Forms\Components\TextInput::make('user_image_limit')
                    ->label('Şəkil limiti')
                    ->type('number')
                    ->nullable()
                    ->visible(fn (callable $get) => $get('require_user_images')),

                Forms\Components\Toggle::make('require_user_choices')
                    ->label('Seçim tələb olunur')
                    ->default(false),

                Forms\Components\TextInput::make('user_choice_title')
                    ->label('Seçim başlığı')
                    ->nullable()
                    ->visible(fn (callable $get) => $get('require_user_choices')),

                Forms\Components\Repeater::make('user_choices')
                    ->label('Seçimlər')
                    ->schema([
                        Forms\Components\TextInput::make('choice')
                            ->label('Seçim'),
                    ])
                    ->nullable()
                    ->visible(fn (callable $get) => $get('require_user_choices')),

                Forms\Components\Toggle::make('require_textarea')
                    ->label('Textarea tələb olunur')
                    ->default(false),

                Forms\Components\TextInput::make('textarea_placeholder')
                    ->label('Textarea Placeholder')
                    ->nullable()
                    ->visible(fn (callable $get) => $get('require_textarea')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BooleanColumn::make('same_day_delivery')
                    ->label('Eyni Gün Çatdırılma'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Təsvir')
                    ->limit(50),

                Tables\Columns\TagsColumn::make('images')
                    ->label('Şəkillər'),

                Tables\Columns\BooleanColumn::make('require_user_images')
                    ->label('Şəkil Tələb olunur'),

                Tables\Columns\TextColumn::make('user_image_title')
                    ->label('Şəkil başlığı'),

                Tables\Columns\TextColumn::make('user_image_limit')
                    ->label('Şəkil limiti'),

                Tables\Columns\BooleanColumn::make('require_user_choices')
                    ->label('Seçim Tələb olunur'),

                Tables\Columns\TextColumn::make('user_choice_title')
                    ->label('Seçim başlığı'),

                Tables\Columns\TagsColumn::make('user_choices')
                    ->label('Seçimlər'),

                Tables\Columns\BooleanColumn::make('require_textarea')
                    ->label('Textarea tələb olunur'),

                Tables\Columns\TextColumn::make('textarea_placeholder')
                    ->label('Textarea Placeholder'),
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
