<?php

namespace App\Filament\Admin\Resources\ShopPayments\Pages;

use App\Filament\Admin\Resources\ShopPayments\ShopPaymentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListShopPayments extends ListRecords
{
    protected static string $resource = ShopPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
