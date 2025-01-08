<?php

namespace App\Filament\Resources\CustomProductDetailResource\Pages;

use App\Filament\Resources\CustomProductDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomProductDetail extends CreateRecord
{
    protected static string $resource = CustomProductDetailResource::class;
}
