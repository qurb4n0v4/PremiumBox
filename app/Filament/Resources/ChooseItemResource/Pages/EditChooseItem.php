<?php

namespace App\Filament\Resources\ChooseItemResource\Pages;

use App\Filament\Resources\ChooseItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChooseItem extends EditRecord
{
    protected static string $resource = ChooseItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
