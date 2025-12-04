<?php

namespace App\Filament\Resources\ManufacturingPromoResource\Pages;

use App\Filament\Resources\ManufacturingPromoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManufacturingPromos extends ListRecords
{
    protected static string $resource = ManufacturingPromoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
