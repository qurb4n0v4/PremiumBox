<?php

namespace App\Filament\Resources\UserCardForBuildABoxResource\Pages;

use App\Filament\Resources\UserCardForBuildABoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserCardForBuildABoxes extends ListRecords
{
    protected static string $resource = UserCardForBuildABoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
