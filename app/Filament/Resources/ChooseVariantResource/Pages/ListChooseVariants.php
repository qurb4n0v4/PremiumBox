<?php

namespace App\Filament\Resources\ChooseVariantResource\Pages;

use App\Filament\Resources\ChooseVariantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChooseVariants extends ListRecords
{
    protected static string $resource = ChooseVariantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
