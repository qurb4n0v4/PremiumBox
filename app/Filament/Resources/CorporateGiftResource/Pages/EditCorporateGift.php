<?php

namespace App\Filament\Resources\CorporateGiftResource\Pages;

use App\Filament\Resources\CorporateGiftResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCorporateGift extends EditRecord
{
    protected static string $resource = CorporateGiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
