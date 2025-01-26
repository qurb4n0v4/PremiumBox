<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserCardForBuildABoxResource\Pages;
use App\Filament\Resources\UserCardForBuildABoxResource\RelationManagers;
use App\Models\UserCardForBuildABox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserCardForBuildABoxResource extends Resource
{
    protected static ?string $model = UserCardForBuildABox::class;

    protected static ?string $navigationGroup = 'Orders';

    protected static ?string $navigationLabel = 'Build A Box Orders';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user.name')
                    ->label('User Name')
                    ->disabled(),
                Forms\Components\TextInput::make('giftBox.title')
                    ->label('Gift Box Title')
                    ->disabled(),
                Forms\Components\TextInput::make('box_customization_text')
                    ->label('Box Customization Text')
                    ->nullable()
                    ->disabled(),
                Forms\Components\TextInput::make('selected_font')
                    ->label('Selected Font')
                    ->nullable()
                    ->disabled(),
                Forms\Components\TextInput::make('card.name')
                    ->label('Card Name')
                    ->disabled(),
                Forms\Components\TextInput::make('recipient_name')
                    ->label('Recipient Name')
                    ->nullable()
                    ->disabled(),
                Forms\Components\TextInput::make('sender_name')
                    ->label('Sender Name')
                    ->nullable()
                    ->disabled(),
                Forms\Components\TextArea::make('card_message')
                    ->label('Card Message')
                    ->nullable()
                    ->disabled(),
                Forms\Components\Repeater::make('userBuildABoxCardItems.images')
                    ->relationship('images') // İlişkili modeli bağlayın
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->disk('public') // Görsellerin nereye kaydedileceğini belirtin
                            ->image(), // Görsel olarak tanımlayın
                    ])
                    ->columns(1)
                    ->label('Images')
                    ->disabled(),

                Forms\Components\TextInput::make('chooseItem.name')
                    ->label('Item Name')
                    ->disabled(),
                Forms\Components\Textarea::make('selected_variants')
                    ->label('Selected Variants')
                    ->disabled(),
                Forms\Components\Textarea::make('user_text')
                    ->label('User Text')
                    ->disabled(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'rejected' => 'Rejected',
                        'completed' => 'Completed',
                    ])
                    ->default('pending')
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User Name'),
                Tables\Columns\TextColumn::make('giftBox.title')
                    ->label('Gift Box Title'),
                Tables\Columns\TextColumn::make('box_customization_text')
                    ->label('Box Customization Text'),
                Tables\Columns\TextColumn::make('selected_font')
                    ->label('Selected Font'),
                Tables\Columns\TextColumn::make('card.name')
                    ->label('Card Name'),
                Tables\Columns\TextColumn::make('recipient_name')
                    ->label('Recipient Name'),
                Tables\Columns\TextColumn::make('sender_name')
                    ->label('Sender Name'),
                Tables\Columns\TextColumn::make('card_message')
                    ->label('Card Message'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),
                Tables\Columns\TextColumn::make('userBuildABoxCardItems.images.image')
                    ->label('Image')
                    ->formatStateUsing(function ($state) {
                        // Split the comma-separated image paths if multiple images are present
                        $imagePaths = explode(',', $state);

                        $html = '';
                        foreach ($imagePaths as $image) {
                            $image = trim($image); // Remove extra spaces if any
                            $imageUrl = asset('storage/' . $image); // Generate the image URL

                            // Append each image to the HTML output
                            $html .= '<img src="' . $imageUrl . '" alt="Media" style="width: 100px; height: auto; margin-right: 10px;" />';
                        }

                        return $html;
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('userBuildABoxCardItems.chooseItem.name')
                    ->label('Item Name'),
                Tables\Columns\TextColumn::make('userBuildABoxCardItems.selected_variants')
                    ->label('Selected Variants')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : $state),
                Tables\Columns\TextColumn::make('userBuildABoxCardItems.user_text')
                    ->label('User Text'),
            ])
            ->filters([
                // Apply filters if needed
            ])
            ->actions([
                // Add actions like view or edit
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['giftBox', 'card', 'userBuildABoxCardItems.images', 'userBuildABoxCardItems.chooseItem']);
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
            'index' => Pages\ListUserCardForBuildABoxes::route('/'),
            'create' => Pages\CreateUserCardForBuildABox::route('/create'),
            'edit' => Pages\EditUserCardForBuildABox::route('/{record}/edit'),
        ];
    }
}
