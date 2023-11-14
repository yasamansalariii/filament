<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\UserResource\Pages\CreateUser;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
