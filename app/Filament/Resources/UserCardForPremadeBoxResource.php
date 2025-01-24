<?php
namespace App\Filament\Resources;

use App\Filament\Resources\UserCardForPremadeBoxResource\Pages;
use App\Models\UserCardForPremadeBox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                    ->relationship('premadeBox', 'name')
                    ->disabled(),

                Forms\Components\Select::make('gift_box_id')
                    ->label('Gift Box Title')
                    ->relationship('giftBox', 'title')
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

                // Kolonlar disabled olmalı, formdaki gibi sadece status değiştirilebilir
                TextColumn::make('box_text')
                    ->label('Box Text')
                    ->disabled(),

                TextColumn::make('selected_font')
                    ->label('Selected Font')
                    ->disabled(),

                // Items kısmındaki bilgileri kullanıcıya gösterebiliriz
                TextColumn::make('items.insiding.name')
                    ->label('Insiding Name')
                    ->sortable()
                    ->searchable()
                    ->disabled(),

                TextColumn::make('items.selected_variant')
                    ->label('Selected Variant')
                    ->disabled(),

                TextColumn::make('items.custom_text')
                    ->label('Custom Text')
                    ->disabled(),

                // userCardDetails ilişkisini almak için doğru yolu kullanıyoruz
                TextColumn::make('userCardDetails.card.name')
                    ->label('Card Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('userCardDetails.to_name')
                    ->label('To Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('userCardDetails.from_name')
                    ->label('From Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('userCardDetails.message')
                    ->label('Message')
                    ->sortable()
                    ->searchable(),

                // Status'ü BadgeColumn ile renkli hale getiriyoruz
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => fn($state): bool => $state === 'pending',
                        'danger' => fn($state): bool => $state === 'rejected',
                        'success' => fn($state): bool => $state === 'accepted',
                    ])
                    ->formatStateUsing(fn($state): string => ucfirst($state)),
            ])
            ->filters([])
            ->actions([
                // Sadece status değiştirilebilir olacak, diğer kolonlara dokunulamayacak
                Tables\Actions\Action::make('changeStatus')
                    ->label('Change Status')
                    ->action(function ($record) {
                        // Burada status değişim işlemi yapılacak
                    })
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            // İlişkiler burada tanımlanabilir
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
