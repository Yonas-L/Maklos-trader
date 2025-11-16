<?php

namespace App\Filament\Resources\ManufacturingStepResource\Pages;

use App\Filament\Resources\ManufacturingStepResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManufacturingStep extends EditRecord
{
    protected static string $resource = ManufacturingStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
