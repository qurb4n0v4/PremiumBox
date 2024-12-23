<?php

namespace App\Filament\Resources\BoxCategoryResource\Pages;

use App\Filament\Resources\BoxCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBoxCategories extends ListRecords
{
    protected static string $resource = BoxCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
