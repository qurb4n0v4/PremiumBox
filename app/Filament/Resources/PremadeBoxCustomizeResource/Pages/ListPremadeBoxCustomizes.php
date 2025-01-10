<?php

namespace App\Filament\Resources\PremadeBoxCustomizeResource\Pages;

use App\Filament\Resources\PremadeBoxCustomizeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPremadeBoxCustomizes extends ListRecords
{
    protected static string $resource = PremadeBoxCustomizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
