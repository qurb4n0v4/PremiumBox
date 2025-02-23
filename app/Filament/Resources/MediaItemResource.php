<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaItemResource\Pages;
use App\Models\MediaItem;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class MediaItemResource extends Resource
{
    protected static ?string $model = MediaItem::class;

    protected static ?string $navigationLabel = 'Sosial Media video/şəkil';
    protected static ?string $navigationIcon = 'heroicon-o-share';
    protected static ?string $navigationGroup = 'Ana Səhifə';
    protected static ?string $pluralModelLabel = 'Sosial Media video/şəkil';


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('media_type')
                    ->label('Media Type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                    ])
                    ->required(),

                Forms\Components\FileUpload::make('media_path')
                    ->label('Media File')
                    ->acceptedFileTypes(['image/*', 'video/*'])
                    ->disk('public')
                    ->required()
                    ->directory('media')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('media_type')
                ->label('Media növü')
                    ->searchable(),

                Tables\Columns\TextColumn::make('media_path')
                    ->label('Media')
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->media_type === 'image') {
                            return '<img src="' . asset('storage/' . $record->media_path) . '" alt="Media" style="width: 100px; height: auto;" />';
                        } elseif ($record->media_type === 'video') {
                            return '<video width="100" controls>
                                        <source src="' . asset('storage/' . $record->media_path) . '" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>';
                        }
                        return '';
                    })
                    ->html()
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
            'index' => Pages\ListMediaItems::route('/'),
            'create' => Pages\CreateMediaItem::route('/create'),
            'edit' => Pages\EditMediaItem::route('/{record}/edit'),
        ];
    }
}
