<?php

use Illuminate\Support\Facades\Storage;
use ProductBadge\Modules\ProductBadgeCollections;
use ProductBadge\Modules\ProductBadgeSales;
use SkillDo\Cms\Support\Theme;
use SkillDo\Support\Path;

class BadgeManagement
{
    static function buildCss(): void
    {
        $storage = Storage::disk('views');

        $file = Theme::name().'/assets/css/badge.main.build.css';

        if($storage->fileExists($file))
        {
            $storage->delete($file);
        }

        $css = file_get_contents(Path::plugin('badge-management/assets/css/style.css'));

        $css .= ProductBadgeCollections::renderCss();

        $css .= ProductBadgeSales::renderCss();

        $css = minifyCss($css);

        $storage->put($file, $css);
    }
}