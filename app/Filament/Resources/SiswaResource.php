<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Kelas;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use DesignTheBox\BarcodeField\Forms\Components\BarcodeInput;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    //TODO: Kelas ID bukan id_kelas tapi kelas_id

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nis')->unique('siswas', 'nis', ignoreRecord:true),
                TextInput::make('nama_siswa'),
                Select::make('kelas_id')
                ->label('Kelas')
                ->relationship('kelas', 'id')
                ->searchable()
                ->preload()
                ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->label()}")
                ,
                Select::make('jenis_kelamin')
                ->options([
                    'Laki-Laki' => 'LAKI-LAKI'
                    ,
                    'Perempuan' => 'PEREMPUAN'
                ]),
                TextInput::make('no_hp'),
                BarcodeInput::make('unique_code')
                ->icon('heroicon-o-arrow-right') // Specify your Heroicon name here
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
