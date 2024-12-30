<?php

namespace App\Filament\Resources\GiftSetResource\Pages;

use App\Filament\Resources\GiftSetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGiftSet extends EditRecord
{
    protected static string $resource = GiftSetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
