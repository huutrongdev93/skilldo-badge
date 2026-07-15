<?php
namespace ProductBadge\Modules\Setting;

use Admin\Supports\Component;
use Admin\Supports\Components\BlockSystem;
use ProductBadge\Styles\ProductBadgeStyle;
use SkillDo\Cms\Support\Option;

class ProductBadgeSystem
{
    static function register($tabs)
    {
        $tabs['badge'] = [
            'label'         => trans('badge-management::system.title'),
            'group'         => 'commerce',
            'description'   => trans('badge-management::system.description'),
            'callback'      => [static::class, 'render'],
            'icon'          => '<i class="fa-duotone fa-ribbon"></i>',
            'form'          => false
        ];

        return $tabs;
    }

    static function render(): void
    {
        $general = Option::get('product_badge_general_setting');

        echo Component::blockSystem(function (BlockSystem $blockSystem) use ($general)
        {
            $form = form();

            $form->setIsValid(true);

            $form->setCallbackValidJs('badgeProductGeneralSubmit');

            $form = apply_filters('admin_badge_settings_form_general', $form, $general);

            $blockSystem->header(trans('badge-management::system.general'))->description(trans('badge-management::system.general.description'));

            $blockSystem->content(view('badge-management::admin/general', [
                'form' => $form
            ]));

        });

        $tabs = apply_filters('admin_badge_settings_sub_tabs', []);

        $styles = ProductBadgeStyle::list();

        $style  = Option::get('product_badge');

        foreach ($tabs as $tabKey => $tab) {

            $active = (!empty($style[$tabKey]['active'])) ? $style[$tabKey]['active']  : null;

            echo view('badge-management::admin/style', [
                'styles' => $styles,
                'active' => $active,
                'tab'    => $tab,
                'tabKey' => $tabKey
            ]);
        }

        echo view('badge-management::admin/script');
    }
}