<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FactCheckResource\Pages\ManageFactChecks;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;

class FactCheckResource extends Resource
{
    protected static ?string $navigationLabel = 'Cek Fakta';

    protected static ?string $modelLabel = 'Cek Fakta';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('claim')
                    ->label('Klaim')
                    ->required(),
                Forms\Components\Textarea::make('fact')
                    ->label('Fakta')
                    ->rows(4),
                Forms\Components\Select::make('verdict')
                    ->label('Verdict')
                    ->options([
                        'true' => 'Benar',
                        'false' => 'Hoax',
                        'misleading' => 'Menyesatkan',
                        'unverified' => 'Belum Terverifikasi',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('source')
                    ->label('Sumber')
                    ->rows(2),
                Forms\Components\Select::make('religion_category_id')
                    ->label('Kategori Agama')
                    ->relationship('religionCategory', 'name')
                    ->preload(),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Featured')
                    ->default(false),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('claim')->label('Klaim')->searchable()->limit(50),
                Tables\Columns\BadgeColumn::make('verdict')
                    ->label('Verdict')
                    ->colors([
                        'success' => 'true',
                        'danger' => 'false',
                        'warning' => 'misleading',
                        'gray' => 'unverified',
                    ]),
                Tables\Columns\TextColumn::make('religionCategory.name')->label('Agama'),
                Tables\Columns\BooleanColumn::make('is_featured')->label('Featured'),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('verdict')
                    ->options([
                        'true' => 'Benar',
                        'false' => 'Hoax',
                        'misleading' => 'Menyesatkan',
                        'unverified' => 'Belum Terverifikasi',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageFactChecks::route('/'),
        ];
    }
}
