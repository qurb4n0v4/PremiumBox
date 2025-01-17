<?php

namespace App\Providers;

use Filament\FilamentServiceProvider as ServiceProvider;
use Filament\Facades\Filament;
use App\Filament\Resources\PremadeBoxCustomizeResource;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::registerResources([
            PremadeBoxCustomizeResource::class,
        ]);

    }
}

