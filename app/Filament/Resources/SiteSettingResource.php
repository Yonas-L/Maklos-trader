<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Filament\Resources\SiteSettingResource\RelationManagers;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Unique identifier for this setting (e.g., navbar_logo)'),

                Forms\Components\Select::make('type')
                    ->required()
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'image' => 'Image',
                        'url' => 'URL',
                    ])
                    ->default('text')
                    ->reactive()
                    ->helperText('Type of setting value'),

                // Conditional field based on type
                Forms\Components\FileUpload::make('value')
                    ->label('Image')
                    ->image()
                    ->directory('logos')
                    ->visibility('public')
                    ->maxSize(2048) // 2MB
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml', 'image/webp'])
                    ->imagePreviewHeight('200')
                    ->helperText('Upload logo image (max 2MB, PNG/JPG/SVG/WebP)')
                    ->visible(fn(callable $get) => $get('type') === 'image')
                    ->formatStateUsing(fn($state, callable $get) => $get('type') === 'image' ? $state : null)
                    ->dehydrated(fn(callable $get) => $get('type') === 'image')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('value')
                    ->label('Value')
                    ->rows(3)
                    ->visible(fn(callable $get) => $get('type') === 'textarea')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('value')
                    ->label('Value')
                    ->visible(fn(callable $get) => in_array($get('type'), ['text', 'url']))
                    ->url(fn(callable $get) => $get('type') === 'url')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('meta')
                    ->label('Metadata (JSON)')
                    ->helperText('Optional metadata in JSON format')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('value')
                    ->label('Preview')
                    ->circular()
                    ->visible(fn($record) => $record?->type === 'image'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Value')
                    ->limit(50)
                    ->visible(fn($record) => $record?->type !== 'image')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'image' => 'success',
                        'url' => 'info',
                        'textarea' => 'warning',
                        default => 'gray',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
