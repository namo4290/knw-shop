<?php

namespace App\Filament\Admin\Resources\ShopOrders\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ShopOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        // 1. 주문 기본 정보 섹션
                        Section::make('주문 정보')
                            ->schema([
                                TextInput::make('order_number')
                                    ->label('주문번호')
                                    ->disabled()
                                    ->dehydrated(),

                                Select::make('status')
                                    ->label('주문 상태')
                                    ->options([
                                        'pending' => '결제대기',
                                        'processing' => '배송준비',
                                        'shipped' => '배송중',
                                        'completed' => '배송완료',
                                        'cancelled' => '주문취소',
                                        'refunded' => '환불완료',
                                    ])
                                    ->required()
                                    ->native(false),

                                Select::make('user_id')
                                    ->label('주문자')
                                    ->relationship('user', 'name')
                                    ->disabled(),
                            ])->columns(3),

                        // 2. 주문 상품 내역 (Repeater 활용)
                        Section::make('주문 상품 내역')
                            ->schema([
                                Repeater::make('items') // ShopOrder 모델의 items 관계
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('product_name')
                                            ->label('상품명')
                                            ->disabled()
                                            ->columnSpan(2),
                                        TextInput::make('unit_price')
                                            ->label('단가')
                                            ->numeric()
                                            ->prefix('₩')
                                            ->disabled(),
                                        TextInput::make('quantity')
                                            ->label('수량')
                                            ->numeric()
                                            ->disabled(),
                                    ])
                                    ->columns(4)
                                    ->addable(false) // 관리자가 임의로 상품 추가 방지
                                    ->deletable(false) // 관리자가 임의로 상품 삭제 방지
                                    ->reorderable(false),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        // 3. 결제 금액 요약 섹션
                        Section::make('결제 금액 요약')
                            ->schema([
                                Placeholder::make('total_price')
                                    ->label('총 주문 금액')
                                    ->content(fn (ShopOrder $record): string => '₩ '.number_format($record->total_price)),

                                TextInput::make('shipping_price')
                                    ->label('배송비')
                                    ->numeric()
                                    ->prefix('₩')
                                    ->required(),
                            ]),

                        // 4. 배송지 정보 섹션
                        Section::make('배송 정보')
                            ->schema([
                                TextInput::make('shipping_name')->label('수령인')->required(),
                                TextInput::make('shipping_phone')->label('연락처')->required(),
                                TextInput::make('shipping_zipcode')->label('우편번호')->required(),
                                TextInput::make('shipping_address')->label('배송지 주소')->required(),
                                Textarea::make('notes')->label('배송 요청사항')->rows(3),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ]);
    }
}
