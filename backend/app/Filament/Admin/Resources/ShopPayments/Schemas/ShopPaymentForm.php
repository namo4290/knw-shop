<?php

namespace App\Filament\Admin\Resources\ShopPayments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ShopPaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('결제 상세 내역')
                ->schema([
                    Group::make()->schema([
                        Select::make('method')
                            ->label('결제 수단')
                            ->options([
                                'card' => '신용카드',
                                'transfer' => '계좌이체',
                                'vbank' => '가상계좌',
                                'point' => '포인트',
                            ])->disabled(), // 결제 수단은 임의 수정 방지

                        TextInput::make('amount')
                            ->label('결제 금액')
                            ->numeric()
                            ->prefix('₩')
                            ->disabled(),
                    ])->columns(2),

                    Group::make()->schema([
                        TextInput::make('status')
                            ->label('결제 상태'),

                        TextInput::make('transaction_id')
                            ->label('PG 거래번호')
                            ->copyable(), // 클릭 시 복사 기능
                    ])->columns(2),

                    DateTimePicker::make('paid_at')
                        ->label('결제 완료 일시'),

                    // PG사 원본 데이터를 확인해야 할 때 유용함
                    KeyValue::make('payload')
                        ->label('PG사 응답 데이터(Raw)')
                        ->collapsed(),
                ]),
        ]);
    }
}
