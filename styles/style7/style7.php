<?php

use SkillDo\Validate\Rule;

class BadgeStyle7 {
    private string $style = 'style7';

    public function html($objectKey = null, $config = []): void
    {
        if($config == []) {
            $text   = apply_filters('badge_style_text', 'văn bản', $objectKey);
            $text   = apply_filters('badge_style7_text', $text, $objectKey);
            $config = $this->configDefault($text);
        }
        Plugin::view(BADGE_NAME, 'styles/'. $this->style .'/html/html', $config);
    }

    /**
     * @throws Less_Exception_Parser
     * @throws Exception
     */
    public function css(): string {
        return Template::less(file_get_contents(FCPATH.BADGE_PATH.'/styles/'. $this->style .'/css/style.less'))->getCss();
    }

    public function form(\SkillDo\Form\Form $form, $config): \SkillDo\Form\Form
    {
        $form->color('bgColor', [
            'label' => trans('badge.style.field.bgColor'),
            'start' => 4,
            'validations' => Rule::make()->notEmpty()->color()
        ], $config['bgColor']);

        $form->color('textColor', [
            'label' => trans('badge.style.field.textColor'),
            'start' => 4,
            'validations' => Rule::make()->notEmpty()->color()
        ], $config['textColor']);

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
            'top'    => trans('badge.style.field.position.top'),
            'bottom' => trans('badge.style.field.position.bottom'),
        ], [
            'label' => trans('badge.style.field.position'),
            'start' => 6,
            'validations' => Rule::make()->notEmpty()
        ], $config['position']);

        $form->select2('effect', [
            'marquee'    => trans('badge.style.field.effect.marquee'),
            'marqueeTop' => trans('badge.style.field.effect.marqueeTop'),
        ], [
            'label' => trans('badge.style.field.effect'),
            'start' => 6,
            'validations' => Rule::make()->notEmpty()
        ], $config['effect']);

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

    public function save(\SkillDo\Http\Request $request, $productBadge, $objectKey): void
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