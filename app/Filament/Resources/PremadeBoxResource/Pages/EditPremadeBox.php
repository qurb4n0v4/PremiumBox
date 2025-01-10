<?php

namespace App\Filament\Resources\PremadeBoxResource\Pages;

use App\Filament\Resources\PremadeBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPremadeBox extends EditRecord
{
    protected static string $resource = PremadeBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
