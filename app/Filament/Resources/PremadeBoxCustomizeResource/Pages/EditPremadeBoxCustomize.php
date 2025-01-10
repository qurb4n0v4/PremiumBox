<?php

namespace App\Filament\Resources\PremadeBoxCustomizeResource\Pages;

use App\Filament\Resources\PremadeBoxCustomizeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPremadeBoxCustomize extends EditRecord
{
    protected static string $resource = PremadeBoxCustomizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
