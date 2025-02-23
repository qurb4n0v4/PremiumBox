<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressResource\Pages;
use App\Filament\Resources\AddressResource\RelationManagers;
use App\Models\Address;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'İstifadəçi məlumatı';
    protected static ?string $navigationLabel = 'İstifadəçi ünvanları';
    protected static ?string $pluralModelLabel = 'İstifadəçi adresləri';




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user.name')
                    ->label('User Name')
                    ->disabled(), // Düzenlenemez
                Forms\Components\TextInput::make('receiver_name')
                    ->label('Receiver Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->label('Phone Number')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('zip_code')
                    ->label('Zip Code')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('district')
                    ->label('District')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('İstifadəçi adı') // Kullanıcı adı
                    ->searchable(),
                TextColumn::make('receiver_name')
                    ->label('Göndərilən şəxsin adı')
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->label('Telefon nömrəsi'),
                TextColumn::make('zip_code')
                    ->label('Zip Kod'),
                TextColumn::make('district')
                    ->label('Məkan'),
                TextColumn::make('created_at')
                    ->label('Yaradıldı')
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('district')
                    ->label('District')
                    ->options(Address::query()->pluck('district', 'district')->toArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
