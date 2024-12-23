<?php

namespace App\Filament\Resources\GiftBoxResource\Pages;

use App\Filament\Resources\GiftBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGiftBoxes extends ListRecords
{
    protected static string $resource = GiftBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
