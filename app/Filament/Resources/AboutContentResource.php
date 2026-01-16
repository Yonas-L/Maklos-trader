<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutContentResource\Pages;
use App\Filament\Resources\AboutContentResource\RelationManagers;
use App\Models\AboutContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutContentResource extends Resource
{
    protected static ?string $model = AboutContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'About Us';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('experience_years')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('label')
                    ->maxLength(255),
                Forms\Components\TextInput::make('headline')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('mission_title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('mission_description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('vision_title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('vision_description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('values_title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('values_description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('experience_years')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('headline')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mission_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vision_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('values_title')
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
            'index' => Pages\ListAboutContents::route('/'),
            'create' => Pages\CreateAboutContent::route('/create'),
            'edit' => Pages\EditAboutContent::route('/{record}/edit'),
        ];
    }
}
