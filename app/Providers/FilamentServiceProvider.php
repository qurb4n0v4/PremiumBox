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
//        // Filament servislerini çalıştırmadan önce giriş kontrolü yapın
//        Filament::serving(function () {
//            // Admin olmayan kullanıcıları yönlendir
//            if (auth()->check() && auth()->user()->role !== 'admin') {
//                auth()->logout();
//                return redirect('/admin/login')->with('error', 'You do not have admin access.');
//            }
//        });

    }
}

