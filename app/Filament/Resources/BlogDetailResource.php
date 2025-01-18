<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogDetailResource\Pages;
use App\Models\BlogDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class  BlogDetailResource extends Resource
{
    protected static ?string $model = BlogDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $navigationLabel = 'Blog Details';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('blog_id')
                    ->label('Blog')
                    ->options(\App\Models\Blog::all()->pluck('title', 'id'))
                    ->required(),

                Repeater::make('blog_details') // This will store repeater data
                ->label('Blog Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->maxLength(255),

                        Forms\Components\TextArea::make('description')
                            ->label('Description')
                            ->required(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->nullable(),
                    ])
                    ->collapsible()
                    ->addable(true)
                    ->deletable(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Display related Blog title
                Tables\Columns\TextColumn::make('blog.title')
                    ->label('Blog')
                    ->limit(50),

                // Display the created_at and updated_at timestamps
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
            ])
            ->filters([
                // Add any necessary filters here
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
            'index' => Pages\ListBlogDetails::route('/'),
            'create' => Pages\CreateBlogDetail::route('/create'),
            'edit' => Pages\EditBlogDetail::route('/{record}/edit'),
        ];
    }
}
