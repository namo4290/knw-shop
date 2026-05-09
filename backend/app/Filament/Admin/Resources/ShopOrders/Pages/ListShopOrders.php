<?php

namespace App\Filament\Admin\Resources\ShopOrders\Pages;

use App\Filament\Admin\Resources\ShopOrders\ShopOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListShopOrders extends ListRecords
{
    protected static string $resource = ShopOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
