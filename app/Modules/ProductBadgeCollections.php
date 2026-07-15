<?php
namespace ProductBadge\Modules;

use Ecommerce\Supports\Prd;
use ProductBadge\Styles\ProductBadgeStyle;
use SkillDo\Cms\Support\Option;
use SkillDo\Cms\Form\Form;

class ProductBadgeCollections {

    static function tabs($tabs)
    {
        $collections = Prd::collections();

        foreach ($collections as $collectionKey => $collection)
        {
            $tabs[$collectionKey] 	= [
                'label' => $collection['name'],
                'description' => trans('badge-management::system.collection.description', [
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
                'label' => trans('badge-management::system.collection.field.general', [
                    'name' => $collection['name']
                ]),
            ], (isset($general[$collectionKey])) ? $general[$collectionKey] : '');
        }

        return $form;
    }

    static function textDefault($text, $objectKey)
    {
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

        foreach ($collections as $collectionKey => $collection)
        {
            if(!empty($object->{$collectionKey}) && !empty($productBadge[$collectionKey]['active']))
            {
                $style = $productBadge[$collectionKey]['active'];

                $styleObject = ProductBadgeStyle::get($style);

                if(is_object($styleObject) && isset($productBadge[$collectionKey][$style]))
                {
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

                $styleObject = ProductBadgeStyle::get($style);

                if(is_object($styleObject) && isset($productBadge[$collectionKey][$style])) {

                    $css .= $styleObject->css($productBadge[$collectionKey][$style]);
                }
            }
        }

        return $css;
    }
}
