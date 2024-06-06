<?php
class ProductBadgeSystem
{
    static function register($tabs)
    {
        $tabs['badge'] = [
            'label'         => trans('badge.title'),
            'group'         => 'commerce',
            'description'   => trans('badge.system.description'),
            'callback'      => 'ProductBadgeSystem::render',
            'icon'          => '<i class="fa-duotone fa-ribbon"></i>',
            'form'          => false
        ];

        return $tabs;
    }

    static function render(): void
    {
        $general = Option::get('product_badge_general_setting');

        $form = form();

        $form->setIsValid(true);

        $form->setCallbackValidJs('badgeProductGeneralSubmit');

        $form = apply_filters('admin_badge_settings_form_general', $form, $general);

        Plugin::view(BADGE_NAME, 'admin/views/general', [
            'title' => trans('badge.system.general'),
            'description' => trans('badge.system.general.description'),
            'form' => $form
        ]);

        $tabs = apply_filters('admin_badge_settings_sub_tabs', []);

        $styles = ProductBadgeStyle::list();

        $style  = Option::get('product_badge');

        foreach ($tabs as $tabKey => $tab) {

            $active = (!empty($style[$tabKey]['active'])) ? $style[$tabKey]['active']  : null;

            Plugin::view(BADGE_NAME, 'admin/views/style', [
                'styles' => $styles,
                'active' => $active,
                'tab'    => $tab,
                'tabKey'    => $tabKey
            ]);
        }

        Plugin::view(BADGE_NAME, 'admin/views/script');
    }
}

add_filter('skd_system_tab', 'ProductBadgeSystem::register', 50);