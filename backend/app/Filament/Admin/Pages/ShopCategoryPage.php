<?php

/*
------- 아래 플러그인 확인요 -----
https://filamentphp.com/plugins/wsmallnews-nestedset#screenshots

*/

namespace App\Filament\Admin\Pages;

use App\Models\ShopCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Wsmallnews\FilamentNestedset\Pages\NestedsetPage;

class ShopCategoryPage extends NestedsetPage
{
    protected static ?string $model = ShopCategory::class;

    protected static ?string $modelLabel = '상품분류';

    protected static ?string $title = '상품분류';

    protected static ?string $navigationLabel = '상품분류';

    // protected static ?string $navigationGroup = 'Test Group';

    protected static ?string $slug = 'shop-categories';

    protected static string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = '상품분류';

    protected static ?int $navigationSort = 1;

    protected function schema(array $arguments): array
    {
        return [
            TextInput::make('name')
                ->label('분류명')
                ->required()
                ->maxLength(255),

            TextInput::make('slug')
                ->label('슬러그')
                ->required()
                ->unique(ignoreRecord: true), // 수정 시 본인 제외 중복 체크

            Select::make('parent_id')
                ->label('상위 분류')
                ->relationship('parent', 'name')
                ->placeholder('최상위 카테고리')
                ->searchable(),
        ];
    }
}
