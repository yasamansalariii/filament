<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Compound;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\CompoundResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CompoundResource\RelationManagers;
use App\Filament\Resources\CompoundResource\Pages\EditCompound;
use App\Filament\Resources\CompoundResource\Pages\ViewCompound;
use App\Filament\Resources\CompoundResource\Pages\ListCompounds;
use App\Filament\Resources\CompoundResource\Pages\CreateCompound;

class CompoundResource extends Resource
{
    protected static ?string $model = Compound::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'مدیریت سیستم';
    protected static ?string $navigationLabel ='ترکیبات ';
    protected static ?string $modelLabel ='ترکیبات  ';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label(__('عنوان محصول')),
                    
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label(__('ترکیبات'))
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('عنوان محصول'))
                    ->searchable()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('description')
                    ->label(__('ترکیبات')),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->jalaliDate()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->jalaliDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

              
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListCompounds::route('/'),
            'create' => Pages\CreateCompound::route('/create'),
            'view' => Pages\ViewCompound::route('/{record}'),
            'edit' => Pages\EditCompound::route('/{record}/edit'),
        ];
    }    
}
