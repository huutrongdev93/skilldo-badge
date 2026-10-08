<?php
namespace ProductBadge\Styles;

use ProductBadge\Styles\Style1\BadgeStyle1;
use ProductBadge\Styles\Style2\BadgeStyle2;
use ProductBadge\Styles\Style3\BadgeStyle3;
use ProductBadge\Styles\Style4\BadgeStyle4;
use ProductBadge\Styles\Style5\BadgeStyle5;
use ProductBadge\Styles\Style6\BadgeStyle6;
use ProductBadge\Styles\Style7\BadgeStyle7;

class ProductBadgeStyle
{
    static array $styles = [
        'style1' => BadgeStyle1::class,
        'style2' => BadgeStyle2::class,
        'style3' => BadgeStyle3::class,
        'style4' => BadgeStyle4::class,
        'style5' => BadgeStyle5::class,
        'style6' => BadgeStyle6::class,
        'style7' => BadgeStyle7::class,
    ];

    static function list(): array
    {
        return static::$styles;
    }

    /**
     * Công tắc Bật / Tắt ở "Cấu hình chung". Chưa lưu lần nào (chưa có khóa) thì coi là bật.
     */
    static function enabled(string $key): bool
    {
        $general = \SkillDo\Cms\Support\Option::get('product_badge_general_setting');

        if(!is_array($general) || !array_key_exists($key, $general)) return true;

        return !empty($general[$key]) && $general[$key] !== 'off';
    }

    static function get($key)
    {
        if(empty(static::$styles[$key])) return null;

        $style = static::$styles[$key];

        if(is_string($style))
        {
            $style = new $style();

            static::$styles[$key] = $style;
        }

        return $style;
    }
}