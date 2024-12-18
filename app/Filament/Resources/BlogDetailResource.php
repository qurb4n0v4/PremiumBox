<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogDetailResource\Pages;
use App\Models\BlogDetail;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogDetailResource extends Resource
{
    protected static ?string $model = BlogDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $navigationLabel = 'Blog Details';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Blog selection dropdown
                Forms\Components\Select::make('blog_id')
                    ->label('Select Blog')
                    ->relationship('blog', 'title') // Relating Blog model
                    ->required()
                    ->searchable()
                    ->options(function () {
                        return Blog::all()->pluck('title', 'id'); // Fetch all blogs with titles and ids
                    }),

                // Blog details repeater
                Forms\Components\Repeater::make('blog_details')
                    ->label('Blog Details')
                    ->schema([
                        // Detail Title Input
                        Forms\Components\TextInput::make('title')
                            ->label('Detail Title')
                            ->required()
                            ->maxLength(255),

                        // Detail Description Textarea
                        Forms\Components\Textarea::make('description')
                            ->label('Detail Description')
                            ->required()
                            ->rows(4),

                        // Detail Image Upload
                        Forms\Components\FileUpload::make('image')
                            ->label('Detail Image')
                            ->image()
                            ->directory('blog-details')
                            ->visibility('public')
                            ->nullable(),
                    ])
                    ->defaultItems(1) // Set default item count for repeater
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Blog column
                Tables\Columns\TextColumn::make('blog.title')
                    ->label('Blog')
                    ->searchable()
                    ->sortable(),

                // Blog Detail Title column
                Tables\Columns\TextColumn::make('title')
                    ->label('Detail Title')
                    ->searchable()
                    ->sortable(),

                // Blog Image column
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular(),

                // Created At column
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Filter by Blog
                Tables\Filters\SelectFilter::make('blog_id')
                    ->label('Filter by Blog')
                    ->relationship('blog', 'title'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Edit action
                Tables\Actions\DeleteAction::make(), // Delete action
                Tables\Actions\ViewAction::make(), // View action
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Bulk delete action
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // You can add relation managers here if needed
        ];
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
