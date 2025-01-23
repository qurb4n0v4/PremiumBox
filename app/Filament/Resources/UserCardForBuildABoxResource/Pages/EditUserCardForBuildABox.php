<?php

namespace App\Filament\Resources\UserCardForBuildABoxResource\Pages;

use App\Filament\Resources\UserCardForBuildABoxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserCardForBuildABox extends EditRecord
{
    protected static string $resource = UserCardForBuildABoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
