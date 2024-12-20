<?php

namespace App\Filament\Resources\PopUpHomeResource\Pages;

use App\Filament\Resources\PopUpHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPopUpHome extends EditRecord
{
    protected static string $resource = PopUpHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
