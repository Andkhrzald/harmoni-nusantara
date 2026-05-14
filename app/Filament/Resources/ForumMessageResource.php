<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForumMessageResource\Pages;
use App\Models\ForumMessage;
use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class ForumMessageResource extends Resource
{
    protected static ?string $model = ForumMessage::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static string|UnitEnum|null $navigationGroup = 'Ruang Bersama';

    protected static ?string $navigationLabel = 'Pesan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Textarea::make('content')
                    ->required()
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengirim')
                    ->default('AI Assistant'),
                Tables\Columns\TextColumn::make('content')
                    ->label('Pesan')
                    ->limit(60)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_ai')
                    ->label('AI')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('is_ai')
                    ->label('Tipe')
                    ->options([
                        '0' => 'Pesan User',
                        '1' => 'Pesan AI',
                    ]),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForumMessages::route('/'),
        ];
    }
}
