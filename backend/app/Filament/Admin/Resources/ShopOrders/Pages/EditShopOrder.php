<?php

namespace App\Filament\Admin\Resources\ShopOrders\Pages;

use App\Filament\Admin\Resources\ShopOrders\ShopOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditShopOrder extends EditRecord
{
    protected static string $resource = ShopOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
