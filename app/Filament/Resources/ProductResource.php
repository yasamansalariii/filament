<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Tables\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Filament\Resources\ProductResource\Pages\CreateProduct;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'مدیریت سیستم';
    protected static ?string $navigationLabel ='محصولات ';
    protected static ?string $modelLabel ='محصول ';


    public static function form(Form $form): Form
    {
        return $form
            // ->schema([
            //     Forms\Components\Section::make('کال کافه')
                ->schema([

                Forms\Components\TextInput::make('title')
                ->required()
                ->label(__('عنوان'))
                ->minLength(2)
                ->maxLength(255),
              
                TinyEditor::make('description')->label(__('توضیحات'))
                
                ->fileAttachmentsDisk('public')
                ->fileAttachmentsVisibility('public')
                ->fileAttachmentsDirectory('uploads')
                ->profile('default|simple|full|minimal|none|custom')
                ->rtl() // Set RTL or use ->direction('auto|rtl|ltr')
                ->columnSpan('full'),

                Forms\Components\FileUpload::make('image')
                ->label(__('عکس'))
                ->image()
                ->disk('public')
                ->directory('products/thumbnails')
                 ->nullable(),

                Forms\Components\TextInput::make('price')
                 ->required()
                 ->label(__('قیمت'))
                 ->minLength(0)
                 ->numeric()
                 ->maxLength(1000),

                // ->currencyMask(thousandSeparator: ',',decimalSeparator: '.',precision: 3),
                Forms\Components\TextInput::make('stock')
                ->required()
                ->label(__('موجودی'))
                ->minLength(0)
                ->numeric(),
                 Forms\Components\Select::make('category_id')
                 ->label(__('بخش'))
                 ->relationship('categories', 'title')
                 ->searchable()
                 ->required(),
                //   forms\components\TextInput::make('updated_at')->required()->hidden(),
                //   forms\components\TextInput::make('created_at')->required()->hidden(),
                ])


                ;

    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('title')->label(__('عنوان')),
            ])
            ->columns([
                TextColumn::make('description')->label(__('توضیحات'))->html(),
             ])
             ->columns([
                ImageColumn::make('image')->label(__('عکس')),
             ])
             ->columns([
                TextColumn::make('price')->label(__('قیمت')),
             ])
             ->columns([
                TextColumn::make('stock')->label(__('موجودی')),
             ])
             ->columns([
                TextColumn::make('category_id')->label(__('بخش')),
             ])

              ->columns([
               TextColumn::make('updated_at')->jalaliDate()->sortable()->toggleable(isToggledHiddenByDefault:true),
              ])
               ->columns([
                  TextColumn::make('created_at')->jalaliDateTime()->sortable()->toggleable(isToggledHiddenByDefault:true),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
