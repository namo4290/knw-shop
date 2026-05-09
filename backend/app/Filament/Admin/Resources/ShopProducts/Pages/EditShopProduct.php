<?php

namespace App\Filament\Admin\Resources\ShopProducts\Pages;

use App\Filament\Admin\Resources\ShopProducts\ShopProductResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditShopProduct extends EditRecord
{
    protected static string $resource = ShopProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
