<?php

use SkillDo\Form\Form;

class ProductBadgeCollections {

    static function tabs($tabs) {
        $collections = Prd::collections();
        foreach ($collections as $collectionKey => $collection) {
            $tabs[$collectionKey] 	= [
                'label' => $collection['name'],
                'description' => trans('badge.system.collection.description', [
                    'name' => $collection['name']
                ])
            ];
        }
        return $tabs;
    }

    static function generalForm(Form $form, $general): Form {

        $collections = Prd::collections();

        foreach ($collections as $collectionKey => $collection) {
            $form->switch($collectionKey, [
                'label' => trans('badge.system.collection.field.general', [
                    'name' => $collection['name']
                ]),
            ], (isset($general[$collectionKey])) ? $general[$collectionKey] : '');
        }

        return $form;
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

    static function renderCss(): string
    {
        $productBadge   = Option::get('product_badge');

        $collections    = Prd::collections();

        $css = '';

        foreach ($collections as $collectionKey => $collection) {

            if(!empty($productBadge[$collectionKey]['active'])) {

                $style = $productBadge[$collectionKey]['active'];

                $styleObject = ProductBadgeStyle::list($style);

                if(is_object($styleObject) && isset($productBadge[$collectionKey][$style])) {

                    $css .= $styleObject->css($productBadge[$collectionKey][$style]);
                }
            }
        }

        return $css;
    }
}

add_filter('admin_badge_settings_sub_tabs', 'ProductBadgeCollections::tabs', 20);

add_filter('product_badge_text', 'ProductBadgeCollections::textDefault', 20, 2);

add_filter('admin_badge_settings_form_general', 'ProductBadgeCollections::generalForm', 10, 2);

add_action('product_object_image', 'ProductBadgeCollections::render', 20);

add_action('theme_custom_css', 'ProductBadgeCollections::renderCss', 20);
