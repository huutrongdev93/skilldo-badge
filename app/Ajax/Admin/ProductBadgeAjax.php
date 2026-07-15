<?php
namespace ProductBadge\Ajax\Admin;

use BadgeManagement;
use ProductBadge\Styles\ProductBadgeStyle;
use SkillDo\Cms\Support\Option;
use SkillDo\Cms\Support\Theme;
use SkillDo\Http\Request;

class ProductBadgeAjax
{
    static function generalSave(Request $request): void
    {
        $data = $request->input();

        if (hasItems($data))
        {
            unset($data['action']);

            unset($data['post_type']);

            unset($data['cate_type']);

            Option::update('product_badge_general_setting', $data);

            response()->success(trans('ajax.save.success'));
        }

        response()->error(trans('ajax.save.error'));
    }

    static function styleLoad(Request $request): void
    {
        $objectKey = $request->input('objectId');

        $style = $request->input('style');

        if (empty($objectKey))
        {
            response()->error(trans('Không có section để lây dữ liệu'));
        }

        if (empty($style))
        {
            response()->error(trans('Bạn chưa chọn Style'));
        }

        $styleObject = ProductBadgeStyle::get($style);

        if (empty($styleObject))
        {
            response()->error(trans('Style bạn chọn không tồn tại'));
        }

        $productBadge = Option::get('product_badge');

        $textDefault = apply_filters('product_badge_text', '', $objectKey, $style);

        $styleConfig = $styleObject->configDefault($textDefault);

        if (!empty($productBadge[$objectKey][$style]))
        {
            $styleConfig = $productBadge[$objectKey][$style];
        }

        $form = form();

        $form->setFormId('badge_form_style_' . $objectKey);

        $form->setIsValid(true);

        $form->setCallbackValidJs('badgeProductStyleSubmit');

        $form = $styleObject->form($form, $styleConfig);

        $result = base64_encode(view('badge-management::admin/style-form', [
            'form' => $form,
            'objectKey' => $objectKey
        ]));

        response()->success(trans('ajax.load.success'), $result);
    }

    static function objectSave(Request $request): void
    {
        $objectKey = $request->input('objectId');

        $style = $request->input('styleId');

        if (empty($objectKey))
        {
            response()->error(trans('Không có section để lây dữ liệu'));
        }

        if (empty($style))
        {
            response()->error(trans('Bạn chưa chọn style'));
        }

        $styleObject = ProductBadgeStyle::get($style);

        if (empty($styleObject))
        {
            response()->error(trans('Style bạn chọn không tồn tại'));
        }

        $productBadge = Option::get('product_badge');

        if (empty($productBadge)) $productBadge = [];

        if (!isset($productBadge[$objectKey]))
        {
            $productBadge[$objectKey]['active'] = $style;
            $productBadge[$objectKey][$style] = $styleObject->configDefault();
        }
        else
        {
            $productBadge[$objectKey]['active'] = $style;
        }

        $form = form();

        $form = $styleObject->form($form, $productBadge[$objectKey][$style] ?? []);

        $validate = $request->validate($form);

        if ($validate->fails())
        {
            response()->error($validate->errors());
        }

        $styleObject->save($request, $productBadge, $objectKey);

        BadgeManagement::buildCss();

        Theme::template()->minifyClear();

        response()->success(trans('ajax.save.success'));
    }
}

