<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlideResource\Pages;
use App\Models\Slide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class SlideResource extends Resource
{
    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';
    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Slides';

    protected static ?string $pluralModelLabel = 'Slides';
    protected static ?string $modelLabel = 'Slide';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title_small')
                    ->label('Small Title')
                    ->nullable(),

                Forms\Components\TextInput::make('title_large')
                    ->label('Large Title')
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->nullable(),

                Forms\Components\TextInput::make('button_text')
                    ->label('Button Text')
                    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('slides')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('image')
                    ->label('Image')
                    ->formatStateUsing(function ($state) {
                        return '<img src="' . asset('storage/' . $state) . '" alt="Media" style="width: 100px; height: auto;" />';
                    })
                    ->html(),


        TextColumn::make('title_small')
                    ->label('Small Title'),

                TextColumn::make('title_large')
                    ->label('Large Title'),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(90),

                TextColumn::make('button_text')
                    ->label('Button Text'),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
        ];
    }
}
