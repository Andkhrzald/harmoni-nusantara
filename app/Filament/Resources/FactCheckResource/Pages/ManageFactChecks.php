<?php

namespace App\Filament\Resources\FactCheckResource\Pages;

use App\Filament\Resources\FactCheckResource;
use Filament\Resources\Pages\ManageRecords;

class ManageFactChecks extends ManageRecords
{
    protected static string $resource = FactCheckResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
