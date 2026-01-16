<?php

namespace App\Filament\Resources\SiteSettingResource\Pages;

use App\Filament\Resources\SiteSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteSetting extends EditRecord
{
    protected static string $resource = SiteSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $type = $data['type'] ?? 'text';

        // Map the specific field back to the generic 'value' column
        if ($type === 'image') {
            $data['value'] = $data['image_value'] ?? null;
        } elseif ($type === 'textarea') {
            $data['value'] = $data['textarea_value'] ?? null;
        } else {
            $data['value'] = $data['text_value'] ?? null;
        }

        // Remove temporary fields to act clean (optional but good practice)
        unset($data['image_value'], $data['textarea_value'], $data['text_value']);

        return $data;
    }
}
