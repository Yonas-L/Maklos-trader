<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroContentResource\Pages;
use App\Filament\Resources\HeroContentResource\RelationManagers;
use App\Models\HeroContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HeroContentResource extends Resource
{
    protected static ?string $model = HeroContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description_one')
                    ->label('Description One')
                    ->helperText('First paragraph shown below the title')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description_two')
                    ->label('Description Two')
                    ->helperText('Second paragraph shown below the title')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('whatsapp_number')
                    ->label('WhatsApp Number')
                    ->helperText('Phone number for WhatsApp button (e.g., 251912345678)')
                    ->maxLength(255),
                Forms\Components\TextInput::make('button_primary_label')
                    ->maxLength(255),
                Forms\Components\TextInput::make('button_primary_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('button_secondary_label')
                    ->maxLength(255),
                Forms\Components\TextInput::make('button_secondary_url')
                    ->maxLength(255),
                Forms\Components\Section::make('Social Media Links')
                    ->description('Configure social media icons displayed in hero section')
                    ->schema([
                        Forms\Components\Toggle::make('show_social_icons')
                            ->label('Show Social Icons')
                            ->default(true),
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->url()
                            ->prefix('https://facebook.com/'),
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->prefix('https://instagram.com/'),
                        Forms\Components\TextInput::make('twitter_url')
                            ->label('X/Twitter URL')
                            ->url()
                            ->prefix('https://twitter.com/'),
                        Forms\Components\TextInput::make('linkedin_url')
                            ->label('LinkedIn URL')
                            ->url()
                            ->prefix('https://linkedin.com/'),
                    ])
                    ->columns(2)
                    ->collapsible(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('button_primary_label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('button_primary_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('button_secondary_label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('button_secondary_url')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ListHeroContents::route('/'),
            'create' => Pages\CreateHeroContent::route('/create'),
            'edit' => Pages\EditHeroContent::route('/{record}/edit'),
        ];
    }
}
