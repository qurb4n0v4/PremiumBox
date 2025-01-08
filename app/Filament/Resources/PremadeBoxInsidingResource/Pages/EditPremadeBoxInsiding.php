<?php

namespace App\Filament\Resources\PremadeBoxInsidingResource\Pages;

use App\Filament\Resources\PremadeBoxInsidingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPremadeBoxInsiding extends EditRecord
{
    protected static string $resource = PremadeBoxInsidingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
