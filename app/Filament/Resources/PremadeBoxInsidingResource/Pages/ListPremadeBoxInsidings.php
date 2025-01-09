<?php

namespace App\Filament\Resources\PremadeBoxInsidingResource\Pages;

use App\Filament\Resources\PremadeBoxInsidingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPremadeBoxInsidings extends ListRecords
{
    protected static string $resource = PremadeBoxInsidingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
