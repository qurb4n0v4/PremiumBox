<?php

namespace App\Filament\Resources\PremadeBoxDetailResource\Pages;

use App\Filament\Resources\PremadeBoxDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPremadeBoxDetails extends ListRecords
{
    protected static string $resource = PremadeBoxDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
