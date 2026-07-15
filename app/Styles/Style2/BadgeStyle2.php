<?php
namespace ProductBadge\Styles\Style2;

use ProductBadge\Styles\BaseBadgeStyle;
use SkillDo\Cms\Form\Form;
use SkillDo\Cms\Support\Option;
use SkillDo\Http\Request;
use Illuminate\Support\Str;
use SkillDo\Validate\Rule;

class BadgeStyle2 extends BaseBadgeStyle
{
    protected string $style = 'style2';

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
            'label' => trans('badge-management::style.field.text'),
            'validations' => Rule::make()->notEmpty()
        ], $config['text'] ?? '');

        $form->select2('position', [
            'label' => trans('badge-management::style.field.position'),
            'validations' => Rule::make()->notEmpty()
        ], $config['position'] ?? '')->options([
            'top-left'     => trans('badge-management::style.field.position.topLeft'),
            'top-right'    => trans('badge-management::style.field.position.topRight'),
            'bottom-left'  => trans('badge-management::style.field.position.bottomLeft'),
            'bottom-right' => trans('badge-management::style.field.position.bottomRight'),
        ]);

        $form->inputDimension('borderRadius', [
            'label' => trans('badge-management::style.field.radius'),
            'validations' => Rule::make()->notEmpty()
        ], $config['borderRadius'] ?? '');

        return $form;
    }

    public function configDefault($text = '') : array
    {
        return [
            'bgColor'       => '#2f5acf',
            'textColor'     => '#fff',
            'text'          => $text,
            'position'      => 'top-right',
            'borderRadius'  => [
                'top'    => 4,
                'right'  => 4,
                'left'   => 4,
                'bottom' => 4,
            ]
        ];
    }

    public function save(Request $request, $productBadge, $objectKey): void
    {
        $productBadge[$objectKey][$this->style]['bgColor'] = Str::clear($request->input('bgColor'));
        $productBadge[$objectKey][$this->style]['textColor'] = Str::clear($request->input('textColor'));
        $productBadge[$objectKey][$this->style]['text'] = Str::clear($request->input('text'));
        $productBadge[$objectKey][$this->style]['position'] = Str::clear($request->input('position'));
        $productBadge[$objectKey][$this->style]['borderRadius'] = $request->input('borderRadius');

        Option::update('product_badge', $productBadge);
    }
}