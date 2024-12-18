<?php

namespace App\Filament\Resources\BlogDetailResource\Pages;

use App\Filament\Resources\BlogDetailResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogDetails extends ListRecords
{
    protected static string $resource = BlogDetailResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

