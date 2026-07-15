<?php
namespace ProductBadge\Services;

use SkillDo\Cms\Template\Assets\AssetPosition;
use SkillDo\Support\Path;

class AssetsService
{
    static function web(AssetPosition $header): void
    {
        if(file_exists(Path::theme('assets/css/badge.main.build.css')))
        {
            $header->add('badge-management', asset('theme::css/badge.main.build.css'))->minify(true);
        }
    }
}