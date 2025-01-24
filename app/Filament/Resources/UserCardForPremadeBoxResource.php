<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserCardForPremadeBoxResource\Pages;
use App\Filament\Resources\UserCardForPremadeBoxResource\RelationManagers;
use App\Models\UserCardForPremadeBox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserCardForPremadeBoxResource extends Resource
{
    protected static ?string $model = UserCardForPremadeBox::class;

    protected static ?string $navigationGroup = 'Orders';

    protected static ?string $navigationLabel = 'Premade Box Orders';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('premade_box_id')
                    ->label('Premade Box Name')
                    ->relationship('premadeBox', 'name') // Relationship'i tanımlıyoruz
                    ->disabled(),

                Forms\Components\Select::make('gift_box_id')
                    ->label('Gift Box Title')
                    ->relationship('giftBox', 'title') // Relationship'i tanımlıyoruz
                    ->disabled(),

                Forms\Components\Textarea::make('box_text')
                    ->label('Box Text')
                    ->disabled(),

                Forms\Components\TextInput::make('selected_font')
                    ->label('Selected Font')
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'rejected' => 'Rejected',
                        'accepted' => 'Accepted',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('premadeBox.name')
                    ->label('Premade Box Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('giftBox.title')
                    ->label('Gift Box Title')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('box_text')
                    ->label('Box Text')
                    ->disabled(),

                TextColumn::make('selected_font')
                    ->label('Selected Font')
                    ->disabled(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => fn ($state): bool => $state === 'pending',
                        'danger' => fn ($state): bool => $state === 'rejected',
                        'success' => fn ($state): bool => $state === 'accepted',
                    ])
                    ->formatStateUsing(fn ($state): string => ucfirst($state)),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
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
            'index' => Pages\ListUserCardForPremadeBoxes::route('/'),
            'create' => Pages\CreateUserCardForPremadeBox::route('/create'),
            'edit' => Pages\EditUserCardForPremadeBox::route('/{record}/edit'),
        ];
    }
}
