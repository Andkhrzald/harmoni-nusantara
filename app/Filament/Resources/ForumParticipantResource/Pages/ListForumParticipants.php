<?php

namespace App\Filament\Resources\ForumParticipantResource\Pages;

use App\Filament\Resources\ForumParticipantResource;
use Filament\Resources\Pages\ListRecords;

class ListForumParticipants extends ListRecords
{
    protected static string $resource = ForumParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
