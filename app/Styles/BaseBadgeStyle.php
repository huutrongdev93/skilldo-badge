<?php
namespace ProductBadge\Styles;

use SkillDo\Support\Path;

class BaseBadgeStyle
{
    protected string $style = '';

    public function html($objectKey = null, $config = []): void
    {
        if($config == [])
        {
            $text   = apply_filters('badge_style_text', 'văn bản', $objectKey);
            $text   = apply_filters('badge_'.$this->style.'_text', $text, $objectKey);
            $config = $this->configDefault($text);
        }

        echo view('badge-management::styles/'. $this->style .'/html/html', $config);
    }

    public function css(): string
    {
        return lessToCss(file_get_contents(Path::plugin('badge-management/views/styles/'.$this->style.'/css/style.css')));
    }

    public function configDefault() : array
    {
        return [];
    }
}