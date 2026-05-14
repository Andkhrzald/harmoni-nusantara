<?php

namespace App\Filament\Resources\ReligionCategoryResource\Pages;

use App\Filament\Resources\ReligionCategoryResource;
use Filament\Resources\Pages\ManageRecords;

class ManageReligionCategories extends ManageRecords
{
    protected static string $resource = ReligionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
