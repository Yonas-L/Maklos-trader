<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageContactSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationLabel = 'Contact Settings';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $title = 'Manage Contact Info';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.manage-contact-settings';

    public ?array $data = [];

    public function mount(): void
    {
        // Fetch existing settings
        $settings = SiteSetting::whereIn('key', ['email', 'phone', 'address'])->pluck('value', 'key');

        // Handle phone: could be simple string or JSON array
        $phoneValue = $settings['phone'] ?? '';
        $phones = [];

        // Attempt to decode if it looks like JSON, otherwise treat as single number
        $decoded = json_decode($phoneValue, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            // It's a JSON array of phones
            // Repeater expects array of arrays normally? No, simple array if simple field
            // But Repeater usually binds to an array of items. 
            // Let's store as: [['number' => '...'], ['number' => '...']]
            foreach ($decoded as $p) {
                $phones[] = ['number' => $p];
            }
        } elseif (!empty($phoneValue)) {
            // Single value legacy
            $phones[] = ['number' => $phoneValue];
        }

        $this->form->fill([
            'email' => $settings['email'] ?? '',
            'address' => $settings['address'] ?? '',
            'phones' => $phones,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Contact Email')
                    ->email()
                    ->required(),

                Repeater::make('phones')
                    ->label('Phone Numbers')
                    ->schema([
                        TextInput::make('number')
                            ->label('Phone Number')
                            ->tel()
                            ->required(),
                    ])
                    ->defaultItems(1)
                    ->addActionLabel('Add another phone number'),

                Textarea::make('address')
                    ->label('Location / Address')
                    ->rows(3)
                    ->required(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Save Email
        SiteSetting::updateOrCreate(
            ['key' => 'email'],
            ['value' => $data['email'], 'type' => 'text']
        );

        // Save Address
        SiteSetting::updateOrCreate(
            ['key' => 'address'],
            ['value' => $data['address'], 'type' => 'textarea'] // or text
        );

        // Save Phones
        // Extract numbers from repeater structure: [['number' => '123'], ['number' => '456']]
        $phones = array_column($data['phones'], 'number');

        // Save as JSON encoded array
        SiteSetting::updateOrCreate(
            ['key' => 'phone'], // Using 'phone' key for backward compat but content is JSON
            ['value' => json_encode($phones), 'type' => 'text'] // Type text to store stringified JSON
        );

        Notification::make()
            ->success()
            ->title('Settings Saved')
            ->send();
    }

    public function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Save Changes')
                ->submit('save'),
        ];
    }
}

