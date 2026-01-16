<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductHighlightResource\Pages;
use App\Filament\Resources\ProductHighlightResource\RelationManagers;
use App\Models\ProductHighlight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductHighlightResource extends Resource
{
    protected static ?string $model = ProductHighlight::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->required()
                            ->maxLength(255)
                            ->default('Products'),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('slug')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image_path')
                            ->image()
                            ->directory('products')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Product Details (for Expanded Card)')
                    ->description('These fields are displayed when hovering over the product card.')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->placeholder('e.g., 450 ETB')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('weight')
                            ->placeholder('e.g., 150g')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('source')
                            ->placeholder('e.g., Organic Extract')
                            ->maxLength(100),
                        Forms\Components\Repeater::make('benefits')
                            ->label('Benefits (displayed as bullet list)')
                            ->simple(
                                Forms\Components\TextInput::make('benefit')
                                    ->placeholder('e.g., Deep Cleansing')
                                    ->required()
                            )
                            ->addActionLabel('Add Benefit')
                            ->defaultItems(1)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('in_stock')
                            ->label('In Stock')
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured on Homepage'),
                        Forms\Components\TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListProductHighlights::route('/'),
            'create' => Pages\CreateProductHighlight::route('/create'),
            'edit' => Pages\EditProductHighlight::route('/{record}/edit'),
        ];
    }
}
