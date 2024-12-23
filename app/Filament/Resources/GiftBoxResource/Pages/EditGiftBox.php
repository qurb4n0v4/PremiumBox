<?php

namespace App\Filament\Resources\GiftBoxResource\Pages;

use App\Filament\Resources\GiftBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGiftBox extends EditRecord
{
    protected static string $resource = GiftBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
