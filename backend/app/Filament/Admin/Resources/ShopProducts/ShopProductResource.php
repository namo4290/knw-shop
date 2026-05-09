<?php

namespace App\Filament\Admin\Resources\ShopProducts;

use App\Filament\Admin\Resources\ShopProducts\Pages\CreateShopProduct;
use App\Filament\Admin\Resources\ShopProducts\Pages\EditShopProduct;
use App\Filament\Admin\Resources\ShopProducts\Pages\ListShopProducts;
use App\Filament\Admin\Resources\ShopProducts\Schemas\ShopProductForm;
use App\Filament\Admin\Resources\ShopProducts\Tables\ShopProductsTable;
use App\Models\ShopProduct;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShopProductResource extends Resource
{
    protected static ?string $model = ShopProduct::class;

    protected static ?string $title = '상품';

    protected static ?string $navigationLabel = '상품';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ShopProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShopProductsTable::configure($table);
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
            'index' => ListShopProducts::route('/'),
            'create' => CreateShopProduct::route('/create'),
            'edit' => EditShopProduct::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
