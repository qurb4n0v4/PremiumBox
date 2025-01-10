<?php

namespace App\Filament\Resources\PremadeBoxResource\Pages;

use App\Filament\Resources\PremadeBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPremadeBoxes extends ListRecords
{
    protected static string $resource = PremadeBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
