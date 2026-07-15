<?php

use ProductBadge\Modules\ProductBadgeCollections;
use ProductBadge\Modules\ProductBadgeSales;
use ProductBadge\Modules\Setting\ProductBadgeSystem;
use ProductBadge\Services\AssetsService;

add_filter('admin_system_tabs', [ProductBadgeSystem::class, 'register'], 50);

add_filter('admin_badge_settings_sub_tabs', [ProductBadgeCollections::class, 'tabs'], 20);
add_filter('product_badge_text', [ProductBadgeCollections::class, 'textDefault'], 20, 2);
add_filter('admin_badge_settings_form_general', [ProductBadgeCollections::class, 'generalForm'], 10, 2);
add_action('product_object_image', [ProductBadgeCollections::class, 'render'], 20);
add_action('theme_custom_css', [ProductBadgeCollections::class, 'renderCss'], 20);

add_filter('admin_badge_settings_sub_tabs', [ProductBadgeSales::class, 'tabs'], 20);
add_filter('badge_style_text', [ProductBadgeSales::class, 'textDefault'], 20, 2);
add_filter('product_badge_text', [ProductBadgeSales::class, 'textValueDefault'], 20, 3);
add_filter('admin_badge_settings_form_general', [ProductBadgeSales::class, 'generalForm'], 10, 2);
add_action('product_object_image', [ProductBadgeSales::class, 'render'], 20);
add_action('theme_custom_css', [ProductBadgeSales::class, 'renderCss'], 20);

add_action('theme_custom_assets', [AssetsService::class, 'web'], 20, 2);