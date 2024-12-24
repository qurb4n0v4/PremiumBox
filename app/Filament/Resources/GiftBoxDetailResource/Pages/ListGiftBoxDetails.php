<?php

namespace App\Filament\Resources\GiftBoxDetailResource\Pages;

use App\Filament\Resources\GiftBoxDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGiftBoxDetails extends ListRecords
{
    protected static string $resource = GiftBoxDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
