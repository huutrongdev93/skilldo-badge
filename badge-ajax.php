<?php

use JetBrains\PhpStorm\NoReturn;

class ProductBadgeAjax {

    #[NoReturn]
    static function generalSave(\SkillDo\Http\Request $request, $model): void
    {
        if($request->isMethod('post')) {

            $data =  $request->input();

            if( have_posts($data) ) {

                unset($data['action']);

                unset($data['post_type']);

                unset($data['cate_type']);

                Option::update('product_badge_general_setting', $data );

                response()->success(trans('ajax.save.success'));
            }
        }

        response()->error(trans('ajax.save.error'));
    }

    #[NoReturn]
    static function styleLoad(\SkillDo\Http\Request $request, $model): void
    {
        if($request->isMethod('post')) {

            $objectKey = $request->input('objectId');

            $style = $request->input('style');

            if(empty($objectKey)) {
                response()->error(trans('Không có section để lây dữ liệu'));
            }

            if(empty($style)) {
                response()->error(trans('Bạn chưa chọn Style'));
            }

            $styleObject = ProductBadgeStyle::list($style);

            if(empty($styleObject)) {

                response()->error(trans('Style bạn chọn không tồn tại'));
            }

            $productBadge = Option::get('product_badge');

            $textDefault  = apply_filters('product_badge_text', '', $objectKey, $style);

            $styleConfig = $styleObject->configDefault($textDefault);

            if(!empty($productBadge[$objectKey][$style])) {
                $styleConfig = $productBadge[$objectKey][$style];
            }

            $form = form();

            $form->setFormId('badge_form_style_'.$objectKey);

            $form->setIsValid(true);

            $form->setCallbackValidJs('badgeProductStyleSubmit');

            $form = $styleObject->form($form, $styleConfig);

            $result = Plugin::partial(BADGE_NAME, 'admin/views/style-form', [
                'form' => $form,
                'objectKey' => $objectKey
            ]);

            $result = base64_encode($result);

            response()->success(trans('ajax.load.success'), $result);
        }

        response()->error(trans('ajax.load.error'));
    }

    #[NoReturn]
    static function objectSave(\SkillDo\Http\Request $request, $model ): void
    {
        if($request->isMethod('post')) {

            $objectKey = $request->input('objectId');

            $style = $request->input('styleId');

            if(empty($objectKey)) {
                response()->error(trans('Không có section để lây dữ liệu'));
            }

            if(empty($style)) {
                response()->error(trans('Bạn chưa chọn style'));
            }

            $styleObject = ProductBadgeStyle::list($style);

            if(empty($styleObject)) {
                response()->error(trans('Style bạn chọn không tồn tại'));
            }

            $productBadge = Option::get('product_badge');

            if(empty($productBadge)) $productBadge = [];

            if(!isset($productBadge[$objectKey])) {
                $productBadge[$objectKey]['active'] = $style;
                $productBadge[$objectKey][$style]   = $styleObject->configDefault();
            }

            $form = form();

            $form = $styleObject->form($form, $productBadge[$objectKey][$style] ?? []);

            $validate = $request->validate($form);

            if ($validate->fails()) {
                response()->error($validate->errors());
            }

            $styleObject->save($request, $productBadge, $objectKey);

            Badge_Management::buildCss();

            response()->success(trans('ajax.save.success'));
        }

        response()->error(trans('ajax.save.error'));
    }
}

Ajax::admin('ProductBadgeAjax::generalSave');

Ajax::admin('ProductBadgeAjax::styleLoad');

Ajax::admin('ProductBadgeAjax::objectSave');