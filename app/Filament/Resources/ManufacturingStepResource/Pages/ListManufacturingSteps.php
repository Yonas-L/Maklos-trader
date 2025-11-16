<?php

namespace App\Filament\Resources\ManufacturingStepResource\Pages;

use App\Filament\Resources\ManufacturingStepResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManufacturingSteps extends ListRecords
{
    protected static string $resource = ManufacturingStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
