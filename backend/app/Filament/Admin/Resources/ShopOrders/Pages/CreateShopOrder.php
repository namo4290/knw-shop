<?php

namespace App\Filament\Admin\Resources\ShopOrders\Pages;

use App\Filament\Admin\Resources\ShopOrders\ShopOrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateShopOrder extends CreateRecord
{
    protected static string $resource = ShopOrderResource::class;
}
