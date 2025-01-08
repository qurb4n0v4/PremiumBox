<?php

namespace App\Filament\Resources\ChooseVariantResource\Pages;

use App\Filament\Resources\ChooseVariantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChooseVariant extends EditRecord
{
    protected static string $resource = ChooseVariantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
