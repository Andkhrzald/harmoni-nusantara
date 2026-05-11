<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationProjectResource\Pages\ManageDonationProjects;
use App\Models\DonationProject;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class DonationProjectResource extends Resource
{
    protected static ?string $model = DonationProject::class;

    protected static ?string $navigationLabel = 'Proyek Donasi';

    protected static ?string $modelLabel = 'Proyek Donasi';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4),
                Forms\Components\TextInput::make('target_amount')
                    ->label('Target Dana')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                Forms\Components\TextInput::make('current_amount')
                    ->label('Dana Terkumpul')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai'),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Berakhir'),
                Forms\Components\TextInput::make('organization_name')
                    ->label('Nama Organisasi'),
                Forms\Components\TextInput::make('image_url')
                    ->label('URL Gambar')
                    ->url(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable(),
                Tables\Columns\TextColumn::make('target_amount')
                    ->label('Target')
                    ->formatStateUsing(fn ($state) => 'Rp '.number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('current_amount')
                    ->label('Terkumpul')
                    ->formatStateUsing(fn ($state) => 'Rp '.number_format($state, 0, ',', '.')),
                Tables\Columns\BooleanColumn::make('is_active')->label('Aktif'),
                Tables\Columns\TextColumn::make('end_date')->label('Berakhir')->date(),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_active')
                    ->query(fn ($query) => $query->where('is_active', true))
                    ->label('Hanya Aktif'),
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
            'index' => ManageDonationProjects::route('/'),
        ];
    }
}
