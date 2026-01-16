<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentContactsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Recent Contact Messages';

    protected function getPollingInterval(): ?string
    {
        return '30s';
    }

    public static function canView(): bool
    {
        return false; // Hidden from dashboard per user request
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactMessage::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->label(''),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('subject')
                    ->limit(40),
                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->label('Received'),
            ])
            ->actions([
                Tables\Actions\Action::make('markAsRead')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->label('Read')
                    ->visible(fn(ContactMessage $record): bool => !$record->is_read)
                    ->action(fn(ContactMessage $record) => $record->update(['is_read' => true])),
                Tables\Actions\Action::make('view')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn(ContactMessage $record): string =>
                        route('filament.adminPanel.resources.contact-messages.view', $record))
                    ->openUrlInNewTab(),
            ])
            ->paginated(false);
    }
}
