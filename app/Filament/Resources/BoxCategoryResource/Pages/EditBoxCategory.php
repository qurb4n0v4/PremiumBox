<?php

namespace App\Filament\Resources\BoxCategoryResource\Pages;

use App\Filament\Resources\BoxCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBoxCategory extends EditRecord
{
    protected static string $resource = BoxCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
