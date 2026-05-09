<?php

namespace App\Filament\Admin\Resources\ShopDeliveries\Schemas;

use App\Models\ShopOrderProduct;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ShopDeliveryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('배송 정보')
                    ->schema([
                        TextInput::make('tracking_number')->label('운송장 번호'),
                        Select::make('carrier')->label('택배사')->options(['cj' => 'CJ대한통운', 'post' => '우체국']),
                    ])->columns(2),

                Section::make('포함된 상품 내역 (합배송/분할배송)')
                    ->schema([
                        Repeater::make('deliveryItems')
                            ->relationship()
                            ->schema([
                                // 특정 주문을 선택
                                Select::make('order_id')
                                    ->relationship('order', 'order_number')
                                    ->live(),
                                // 해당 주문 내의 상품 중 배송 가능한 상품만 선택
                                Select::make('order_product_id')
                                    ->label('대상 상품')
                                    ->options(fn ($get) => ShopOrderProduct::where('order_id', $get('order_id'))
                                        ->pluck('product_name', 'id')
                                    ),
                                TextInput::make('quantity')->numeric()->label('배송 수량'),
                            ])->columns(3),
                    ]),
            ]);
    }
}
