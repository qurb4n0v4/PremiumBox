<?php

namespace App\Filament\Resources\UserCardForPremadeBoxResource\Pages;

use App\Filament\Resources\UserCardForPremadeBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserCardForPremadeBoxes extends ListRecords
{
    protected static string $resource = UserCardForPremadeBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
