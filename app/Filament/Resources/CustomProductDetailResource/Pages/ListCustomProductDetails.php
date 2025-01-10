<?php

namespace App\Filament\Resources\CustomProductDetailResource\Pages;

use App\Filament\Resources\CustomProductDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomProductDetails extends ListRecords
{
    protected static string $resource = CustomProductDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
