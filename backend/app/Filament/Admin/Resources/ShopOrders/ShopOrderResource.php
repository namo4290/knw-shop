<?php

namespace App\Filament\Admin\Resources\ShopOrders;

use App\Filament\Admin\Resources\ShopOrders\Pages\CreateShopOrder;
use App\Filament\Admin\Resources\ShopOrders\Pages\EditShopOrder;
use App\Filament\Admin\Resources\ShopOrders\Pages\ListShopOrders;
use App\Filament\Admin\Resources\ShopOrders\Schemas\ShopOrderForm;
use App\Filament\Admin\Resources\ShopOrders\Tables\ShopOrdersTable;
use App\Models\ShopOrder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ShopOrderResource extends Resource
{
    protected static ?string $model = ShopOrder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ShopOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShopOrdersTable::configure($table);
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
            'index' => ListShopOrders::route('/'),
            'create' => CreateShopOrder::route('/create'),
            'edit' => EditShopOrder::route('/{record}/edit'),
        ];
    }
}
