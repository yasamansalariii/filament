<?php

namespace App\Filament\Resources\CompoundResource\Pages;

use App\Filament\Resources\CompoundResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompound extends ViewRecord
{
    protected static string $resource = CompoundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
