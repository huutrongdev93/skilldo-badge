<?php
class ProductBadgeCollections {
    static function tabs($tabs) {
        $collections = Prd::collections();
        foreach ($collections as $collectionKey => $collection) {
            $tabs[$collectionKey] 	= ['label' => $collection['name'], 'callback' => 'ProductBadgeSetting::pageStyle'];
        }
        return $tabs;
    }
    static function tabsGeneralForm( $general ): void {
        $collections = Prd::collections();
        foreach ($collections as $collectionKey => $collection) {
            echo FormBuilder::render([
                'name' => $collectionKey,
                'label' => 'Bật / Tắt nhãn '.$collection['name'],
                'type'  => 'switch',
            ], (isset($general[$collectionKey])) ? $general[$collectionKey] : '');
        }
    }
    static function textDefault($text, $objectKey) {
        $textCollection = Prd::collections($objectKey.'.name');
        if(!empty($textCollection)) {
            $text = $textCollection;
        }
        return $text;
    }
    static function render($object): void
    {
        $productBadge   = Option::get('product_badge');
        $collections    = Prd::collections();
        foreach ($collections as $collectionKey => $collection) {
            if(!empty($object->{$collectionKey}) && !empty($productBadge[$collectionKey]['active'])) {

                $style = $productBadge[$collectionKey]['active'];

                $styleObject = ProductBadgeStyle::list($style);

                if(is_object($styleObject) && isset($productBadge[$collectionKey][$style])) {
                    $styleObject->html($collectionKey, $productBadge[$collectionKey][$style]);
                }
            }
        }
    }
    static function renderCss(): void
    {
        $productBadge   = Option::get('product_badge');
        $collections    = Prd::collections();
        foreach ($collections as $collectionKey => $collection) {
            if(!empty($productBadge[$collectionKey]['active'])) {
                $style = $productBadge[$collectionKey]['active'];
                $styleObject = ProductBadgeStyle::list($style);
                if(is_object($styleObject) && isset($productBadge[$collectionKey][$style])) {
                    $styleObject->css($productBadge[$collectionKey][$style]);
                }
            }
        }
    }
}

add_filter('admin_badge_settings_sub_tabs', 'ProductBadgeCollections::tabs', 20 );
add_filter('product_badge_text', 'ProductBadgeCollections::textDefault', 20, 2);
add_action('admin_badge_settings_tabs_general', 'ProductBadgeCollections::tabsGeneralForm', 10, 1);
add_action('product_object_image', 'ProductBadgeCollections::render', 20);
add_action('theme_custom_css', 'ProductBadgeCollections::renderCss', 20);
