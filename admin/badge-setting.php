<?php
class ProductBadgeSetting {

    static function tabs($tabs) {
        $tabs['badge'] 	= ['label' => 'Nhãn Hiệu', 	'callback' => 'ProductBadgeSetting::page'];
        return $tabs;
    }

    static function tabsChild() {

        $tabs['general'] 	= ['label' => 'Cấu hình chung', 'callback' => 'ProductBadgeSetting::pageGeneral'];

        $collections = Prd::collections();

        foreach ($collections as $collectionKey => $collection) {
            $tabs[$collectionKey] 	= ['label' => $collection['name'], 'callback' => 'admin_page_badge_settings_tabs_general'];
        }

        return apply_filters('admin_badge_settings_sub_tabs', $tabs);
    }

    static function page($ci, $tab): void
    {
        Plugin::partial(BADGE_NAME, 'admin/views/html-settings-tab-badge');
    }

    static function pageGeneral($ci, $tab): void
    {
        $general = Option::get('product_badge_general_setting');
        Plugin::partial( BADGE_NAME, 'admin/views/html-settings-tab-general', ['general' => $general]);
    }

    static function pageStyle($ci, $tab): void
    {
        $styles = ProductBadgeStyle::list();
        $style  = Option::get('product_badge');
        $active = (!empty($style[$tab]['active'])) ? $style[$tab]['active']  : null;
        Plugin::partial( BADGE_NAME, 'admin/views/html-settings-tab-style', ['styles' => $styles, 'active' => $active, 'tab' => $tab]);
    }
}

add_filter('admin_product_settings_tabs', 'ProductBadgeSetting::tabs');