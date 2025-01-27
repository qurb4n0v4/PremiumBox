<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatResource\Pages;
use App\Filament\Resources\ChatResource\RelationManagers;
use App\Models\Chat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChatResource extends Resource
{
    protected static ?string $model = Chat::class;

    protected static ?string $navigationGroup = 'İstifadəçi təklifləri/istəkləri';
    protected static ?string $navigationLabel = 'İstifadəçi istəkləri';

    protected static ?string $pluralModelLabel = 'İstifadəçi istəkləri';
    protected static ?string $modelLabel = 'İstifadəçi istəkləri';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChats::route('/'),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('gift_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('message')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->label('İstifadəçi adı'),
                TextColumn::make('gift_type')->searchable()->label('Hədiyyə növü'),
                TextColumn::make('message')->limit(50)->label('Mesaj'),
                TextColumn::make('created_at')
                    ->label('Yaradıldı')
                    ->searchable()
                    ->dateTime('d-m-Y H:i:s'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
}
