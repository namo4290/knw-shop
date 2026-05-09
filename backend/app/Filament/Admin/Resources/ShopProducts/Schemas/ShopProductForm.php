<?php

namespace App\Filament\Admin\Resources\ShopProducts\Schemas;

use App\Models\ShopProduct;
// 1. 레이아웃 컴포넌트
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
// 2. 폼 입력 필드
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
// 3. 상태 관리 (★ 핵심 수정 부분: Schemas의 Set을 사용합니다)
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ShopProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('기본 정보')
                            ->schema([
                                TextInput::make('name')
                                    ->label('상품명')
                                    ->required()
                                    ->live(onBlur: true)
                                    // ★ 수정됨: ?string $operation 추가 및 올바른 Set 클래스 주입
                                    ->afterStateUpdated(function (?string $operation, $state, Set $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }
                                        $set('slug', Str::slug($state));
                                    }),

                                TextInput::make('slug')
                                    ->label('슬러그')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(ShopProduct::class, 'slug', ignoreRecord: true),

                                RichEditor::make('description')
                                    ->label('상품 설명')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Section::make('가격 및 재고')
                            ->schema([
                                TextInput::make('price')
                                    ->label('판매가')
                                    ->numeric()
                                    ->prefix('₩')
                                    ->required(),

                                TextInput::make('stock')
                                    ->label('재고 수량')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('분류 및 상태')
                            ->schema([
                                Select::make('categories')
                                    ->label('카테고리 (최대 3개)')
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->maxItems(3)
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Toggle::make('is_visible')
                                    ->label('판매 여부')
                                    ->default(true)
                                    ->helperText('체크 해제 시 상점에 노출되지 않습니다.'),
                            ]),
                    ])->columnSpan(['lg' => 1]),

            ]);
    }
}
