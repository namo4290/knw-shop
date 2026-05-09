<?php

namespace App\Filament\Admin\Resources\ShopDeliveries\Pages;

use App\Filament\Admin\Resources\ShopDeliveries\ShopDeliveryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditShopDelivery extends EditRecord
{
    protected static string $resource = ShopDeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
