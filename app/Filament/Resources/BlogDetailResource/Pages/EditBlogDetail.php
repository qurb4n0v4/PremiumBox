<?php

namespace App\Filament\Resources\BlogDetailResource\Pages;

use App\Filament\Resources\BlogDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogDetail extends EditRecord
{
    protected static string $resource = BlogDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
