<?php

namespace App\Filament\Admin\Resources\ShopPayments\Pages;

use App\Filament\Admin\Resources\ShopPayments\ShopPaymentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditShopPayment extends EditRecord
{
    protected static string $resource = ShopPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
