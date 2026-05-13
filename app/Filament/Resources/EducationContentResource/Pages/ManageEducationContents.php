<?php

namespace App\Filament\Resources\EducationContentResource\Pages;

use App\Filament\Resources\EducationContentResource;
use Filament\Resources\Pages\ManageRecords;

class ManageEducationContents extends ManageRecords
{
    protected static string $resource = EducationContentResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
