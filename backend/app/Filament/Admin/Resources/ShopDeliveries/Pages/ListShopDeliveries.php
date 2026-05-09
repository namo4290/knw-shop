<?php

namespace App\Filament\Admin\Resources\ShopDeliveries\Pages;

use App\Filament\Admin\Resources\ShopDeliveries\ShopDeliveryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListShopDeliveries extends ListRecords
{
    protected static string $resource = ShopDeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
