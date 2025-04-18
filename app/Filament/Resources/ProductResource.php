<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->maxValue(100000),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('products')
                    ->required(),

                Forms\Components\Select::make('category')
                    ->required()
                    ->options([
                        'Electronics' => 'Electronics',
                        'Fashion' => 'Fashion',
                        'Home Appliances' => 'Home Appliances',
                        'Books' => 'Books',
                        'Sports' => 'Sports',
                        'Beauty' => 'Beauty',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Electronics' => 'info',
                        'Fashion' => 'success',
                        'Home Appliances' => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable()
                    ->color('success'),

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
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Electronics' => 'Electronics',
                        'Fashion' => 'Fashion',
                        'Home Appliances' => 'Home Appliances',
                        'Books' => 'Books',
                        'Sports' => 'Sports',
                        'Beauty' => 'Beauty',
                    ]),

                Tables\Filters\Filter::make('price_range')
                    ->form([
                        Forms\Components\TextInput::make('min_price')
                            ->numeric()
                            ->placeholder('Min price'),
                        Forms\Components\TextInput::make('max_price')
                            ->numeric()
                            ->placeholder('Max price'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['min_price'],
                                fn(Builder $query, $minPrice): Builder => $query->where('price', '>=', $minPrice),
                            )
                            ->when(
                                $data['max_price'],
                                fn(Builder $query, $maxPrice): Builder => $query->where('price', '<=', $maxPrice),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
