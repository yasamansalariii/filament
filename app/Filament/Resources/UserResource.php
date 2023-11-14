<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tables\Columns\TextColumn;
use Forms\Components\TextInput;
use Filament\Resources\Resource;
use Forms\Components\DateTimePicker;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ViewUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel ='کاربر مدیر' ;
    protected static ?string $modelLabel =' کاربر مدیر ' ;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label(__('نام'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                ->label(__('ایمیل'))
                    ->email()
                    ->required()
                    ->maxLength(255),
                    Forms\Components\DateTimePicker::make('email_verified_at')->label(__('تاریخ تایید ایمیل'))
                    ->jalali()
                    ->required(),
                    Forms\Components\TextInput::make('password')
                ->label(__('رمز عبور'))
                    ->password()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('نام'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('ایمیل'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                
                    ->label(__('تاریخ تایید ایمیل'))
                    ->jalaliDateTime()
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
