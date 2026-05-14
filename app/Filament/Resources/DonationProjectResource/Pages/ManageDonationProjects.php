<?php

namespace App\Filament\Resources\DonationProjectResource\Pages;

use App\Filament\Resources\DonationProjectResource;
use Filament\Resources\Pages\ManageRecords;

class ManageDonationProjects extends ManageRecords
{
    protected static string $resource = DonationProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
