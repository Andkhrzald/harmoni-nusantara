<?php

namespace App\Filament;

use App\Filament\Resources\DonationProjectResource;
use App\Filament\Resources\EducationContentResource;
use App\Filament\Resources\FactCheckResource;
use App\Filament\Resources\ForumMessageResource;
use App\Filament\Resources\ForumParticipantResource;
use App\Filament\Resources\ReligionCategoryResource;
use App\Filament\Resources\VolunteerResource;
use Filament\Panel;
use Filament\PanelProvider;

class AdminPanel extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->brandName('Harmoni Nusantara - Admin')
            ->login()
            ->resources([
                ReligionCategoryResource::class,
                EducationContentResource::class,
                DonationProjectResource::class,
                FactCheckResource::class,
                VolunteerResource::class,
                ForumMessageResource::class,
                ForumParticipantResource::class,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources');
    }
}
