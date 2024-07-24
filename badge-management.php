<?php
const BADGE_NAME = 'badge-management';

define('BADGE_PATH', Path::plugin(BADGE_NAME));

class Badge_Management {

	private string $name = 'Badge_Management';

    static function style(AssetPosition $header): void
    {
        if(file_exists(BADGE_PATH.'/assets/css/badge.main.build.css')) {
            $header->add('badge-management', BADGE_PATH.'/assets/css/badge.main.build.css', ['minify' => true]);
        }
    }

    static function buildCss(): void
    {
        $storage = Storage::make(BADGE_PATH.'/assets');

        if($storage->fileExists('css/badge.main.build.css')) {
            $storage->delete('css/badge.main.build.css');
        }

        $css = $storage->get('css/style.css');

        $css .= ProductBadgeCollections::renderCss();

        $css .= ProductBadgeSales::renderCss();

        $storage->put('css/badge.main.build.css', $css);
    }
}

include 'module/collections.php';

include 'module/sales.php';

include 'styles/styles.php';

if(Admin::is()) {

    include 'badge-ajax.php';

    include 'badge-admin.php';
}

add_action('theme_custom_assets', 'Badge_Management::style', 20, 2);