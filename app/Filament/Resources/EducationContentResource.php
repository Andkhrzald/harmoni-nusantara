<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationContentResource\Pages\ManageEducationContents;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;

class EducationContentResource extends Resource
{
    protected static ?string $navigationLabel = 'Konten Edukasi';

    protected static ?string $modelLabel = 'Konten Edukasi';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required(),
                Forms\Components\Textarea::make('summary')
                    ->label('Ringkasan')
                    ->rows(3),
                Forms\Components\Textarea::make('content')
                    ->label('Konten')
                    ->rows(6),
                Forms\Components\Select::make('religion_category_id')
                    ->label('Kategori Agama')
                    ->relationship('religionCategory', 'name')
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('type')
                    ->label('Tipe')
                    ->options([
                        'article' => 'Artikel',
                        'video' => 'Video',
                        'infographic' => 'Infografis',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('source_url')
                    ->label('URL Sumber')
                    ->url(),
                Forms\Components\TextInput::make('author')
                    ->label('Penulis'),
                Forms\Components\Toggle::make('is_published')
                    ->label('Dipublikasikan')
                    ->default(false),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable(),
                Tables\Columns\TextColumn::make('religionCategory.name')->label('Agama'),
                Tables\Columns\TextColumn::make('type')->label('Tipe'),
                Tables\Columns\BooleanColumn::make('is_published')->label('Dipublikasikan'),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'article' => 'Artikel',
                        'video' => 'Video',
                        'infographic' => 'Infografis',
                    ]),
                Tables\Filters\Filter::make('is_published')
                    ->query(fn ($query) => $query->where('is_published', true))
                    ->label('Hanya Dipublikasikan'),
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
            'index' => ManageEducationContents::route('/'),
        ];
    }
}
