<?php
namespace ProductBadge\Styles\Style7;

use ProductBadge\Styles\BaseBadgeStyle;
use SkillDo\Cms\Form\Form;
use SkillDo\Cms\Support\Option;
use SkillDo\Http\Request;
use Illuminate\Support\Str;
use SkillDo\Validate\Rule;

class BadgeStyle7 extends BaseBadgeStyle
{
    protected string $style = 'style7';

    public function form(Form $form, $config): Form
    {
        $form->color('bgColor', [
            'label' => trans('badge-management::style.field.bgColor'),
            'start' => 4,
            'validations' => Rule::make()->notEmpty()->color()
        ], $config['bgColor'] ?? '');

        $form->color('textColor', [
            'label' => trans('badge-management::style.field.textColor'),
            'start' => 4,
            'validations' => Rule::make()->notEmpty()->color()
        ], $config['textColor'] ?? '');

        $form->text('text', [
            'label' => 'Dòng chữ 1',
            'start' => 6,
            'validations' => Rule::make()->notEmpty()
        ], $config['text']);
        $form->text('text2', [
            'label' => 'Dòng chữ 2',
            'start' => 6,
            'validations' => Rule::make()->notEmpty()
        ], (isset($config['text2'])) ? $config['text2'] : '');

        $form->select2('position', [
            'label' => trans('badge-management::style.field.position'),
            'start' => 6,
            'validations' => Rule::make()->notEmpty()
        ], $config['position'] ?? '')->options([
            'top'    => trans('badge-management::style.field.position.top'),
            'bottom' => trans('badge-management::style.field.position.bottom'),
        ]);

        $form->select2('effect', [
            'label' => trans('badge-management::style.field.effect'),
            'start' => 6,
            'validations' => Rule::make()->notEmpty()
        ], $config['effect'] ?? '')->options([
            'marquee'    => trans('badge-management::style.field.effect.marquee'),
            'marqueeTop' => trans('badge-management::style.field.effect.marqueeTop'),
        ]);

        return $form;
    }

    public function configDefault($text = '') : array {
        return [
            'bgColor'       => '#2f5acf',
            'textColor'     => '#fff',
            'text'          => $text,
            'text2'         => $text,
            'position'      => 'bottom',
            'effect'        => 'marquee',
        ];
    }

    public function save(Request $request, $productBadge, $objectKey): void
    {
        $productBadge[$objectKey][$this->style]['bgColor'] = Str::clear($request->input('bgColor'));
        $productBadge[$objectKey][$this->style]['textColor'] = Str::clear($request->input('textColor'));
        $productBadge[$objectKey][$this->style]['text'] = Str::clear($request->input('text'));
        $productBadge[$objectKey][$this->style]['text2'] = Str::clear($request->input('text2'));
        $productBadge[$objectKey][$this->style]['position'] = Str::clear($request->input('position'));
        $productBadge[$objectKey][$this->style]['effect'] = Str::clear($request->input('effect'));

        Option::update('product_badge', $productBadge);
    }
}