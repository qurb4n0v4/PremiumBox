<?php

namespace App\Filament\Resources\CorporateGiftResource\Pages;

use App\Filament\Resources\CorporateGiftResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCorporateGifts extends ListRecords
{
    protected static string $resource = CorporateGiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
