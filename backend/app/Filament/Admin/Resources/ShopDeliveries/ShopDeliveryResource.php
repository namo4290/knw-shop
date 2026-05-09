<?php

namespace App\Filament\Admin\Resources\ShopDeliveries;

use App\Filament\Admin\Resources\ShopDeliveries\Pages\CreateShopDelivery;
use App\Filament\Admin\Resources\ShopDeliveries\Pages\EditShopDelivery;
use App\Filament\Admin\Resources\ShopDeliveries\Pages\ListShopDeliveries;
use App\Filament\Admin\Resources\ShopDeliveries\Schemas\ShopDeliveryForm;
use App\Filament\Admin\Resources\ShopDeliveries\Tables\ShopDeliveriesTable;
use App\Models\ShopDelivery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ShopDeliveryResource extends Resource
{
    protected static ?string $model = ShopDelivery::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ShopDeliveryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShopDeliveriesTable::configure($table);
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
            'index' => ListShopDeliveries::route('/'),
            'create' => CreateShopDelivery::route('/create'),
            'edit' => EditShopDelivery::route('/{record}/edit'),
        ];
    }
}
