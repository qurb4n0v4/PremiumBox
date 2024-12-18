<?php

namespace App\Filament\Resources\BlogDetailResource\Pages;

use App\Filament\Resources\BlogDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogDetail extends CreateRecord
{
    protected static string $resource = BlogDetailResource::class;
}
