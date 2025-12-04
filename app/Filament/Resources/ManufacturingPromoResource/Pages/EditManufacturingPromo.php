<?php

namespace App\Filament\Resources\ManufacturingPromoResource\Pages;

use App\Filament\Resources\ManufacturingPromoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManufacturingPromo extends EditRecord
{
    protected static string $resource = ManufacturingPromoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
