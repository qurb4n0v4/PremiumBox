<?php

namespace App\Filament\Resources\CustomProductDetailResource\Pages;

use App\Filament\Resources\CustomProductDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomProductDetail extends EditRecord
{
    protected static string $resource = CustomProductDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
