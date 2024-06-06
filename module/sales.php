<?php

use SkillDo\Form\Form;

class ProductBadgeSales {

    static function tabs($tabs) {
        $tabs['sales'] 	= ['label' => 'Khuyến mãi', 'description' => 'cấu hình nhãn hiệu cho sản phẩm khuyến mãi'];
        return $tabs;
    }

    static function generalForm(Form $form, $general): Form {

        $form->switch('sales', [
            'label' => 'Bật / Tắt nhãn khuyến mãi',
        ], (isset($general['sales'])) ? $general['sales'] : '');

        return $form;
    }

    static function textDefault($text, $objectKey) {
        if($objectKey == 'sales') {
            $text = 'Sale 30%';
        }
        return $text;
    }

    static function textValueDefault($text, $objectKey, $style) {
        if($objectKey == 'sales') {
            $text = 'Sale -{percent}';
        }
        return $text;
    }

    static function render($object): void
    {
        $productBadge   = Option::get('product_badge');

        if(!empty($object->price_sale) && !empty($productBadge['sales']['active'])) {

            $style = $productBadge['sales']['active'];

            $styleObject = ProductBadgeStyle::list($style);

            if(is_object($styleObject) && isset($productBadge['sales'][$style])) {

                $percent = ceil(($object->price != 0) ? ($object->price - $object->price_sale)*100/$object->price : 0);

                if(!empty($productBadge['sales'][$style]['text'])) {
                    $productBadge['sales'][$style]['text'] = str_replace('{percent}', $percent.'%',$productBadge['sales'][$style]['text']);
                }
                if(!empty($productBadge['sales'][$style]['text1'])) {
                    $productBadge['sales'][$style]['text1'] = str_replace('{percent}', $percent.'%',$productBadge['sales'][$style]['text1']);
                }
                if(!empty($productBadge['sales'][$style]['text2'])) {
                    $productBadge['sales'][$style]['text2'] = str_replace('{percent}', $percent.'%',$productBadge['sales'][$style]['text2']);
                }
                $styleObject->html('sales', $productBadge['sales'][$style]);
            }
        }
    }

    static function renderCss(): string
    {
        $productBadge = Option::get('product_badge');

        $css = '';

        if(!empty($productBadge['sales']['active'])) {

            $style = $productBadge['sales']['active'];

            $styleObject = ProductBadgeStyle::list($style);

            if(is_object($styleObject) && isset($productBadge['sales'][$style])) {

                $css .= $styleObject->css($productBadge['sales'][$style]);
            }
        }

        return $css;
    }
}

add_filter('admin_badge_settings_sub_tabs', 'ProductBadgeSales::tabs', 20);
add_filter('badge_style_text', 'ProductBadgeSales::textDefault', 20, 2);
add_filter('product_badge_text', 'ProductBadgeSales::textValueDefault', 20, 3);
add_filter('admin_badge_settings_form_general', 'ProductBadgeSales::generalForm', 10, 2);
add_action('product_object_image', 'ProductBadgeSales::render', 20);
add_action('theme_custom_css', 'ProductBadgeSales::renderCss', 20);
