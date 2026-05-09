<?php

namespace App\Filament\Admin\Resources\ShopPayments;

use App\Filament\Admin\Resources\ShopPayments\Pages\CreateShopPayment;
use App\Filament\Admin\Resources\ShopPayments\Pages\EditShopPayment;
use App\Filament\Admin\Resources\ShopPayments\Pages\ListShopPayments;
use App\Filament\Admin\Resources\ShopPayments\Schemas\ShopPaymentForm;
use App\Filament\Admin\Resources\ShopPayments\Tables\ShopPaymentsTable;
use App\Models\ShopPayment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ShopPaymentResource extends Resource
{
    protected static ?string $model = ShopPayment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ShopPaymentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShopPaymentsTable::configure($table);
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
            'index' => ListShopPayments::route('/'),
            'create' => CreateShopPayment::route('/create'),
            'edit' => EditShopPayment::route('/{record}/edit'),
        ];
    }
}
