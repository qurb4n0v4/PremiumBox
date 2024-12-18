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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Select::make('blog_id')
                    ->label('Blog')
                    ->options(\App\Models\Blog::all()->pluck('title', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('description')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->nullable(),
            ]);


    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->limit(50),
                Tables\Columns\TextColumn::make('description')->limit(2000),
                Tables\Columns\ImageColumn::make('image')->size(50),
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
