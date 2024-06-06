<?php

use SkillDo\Validate\Rule;

class BadgeStyle6 {
    private string $style = 'style6';

    public function html($objectKey = null, $config = []): void
    {
        if($config == []) {
            $text   = apply_filters('badge_style_text', 'văn bản', $objectKey);
            $text   = apply_filters('badge_style6_text', $text, $objectKey);
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
            'label' => trans('badge.style.field.text'),
            'validations' => Rule::make()->notEmpty()
        ], $config['text']);
        
        $form->select2('position', [
            'top-left'     => trans('badge.style.field.position.topLeft'),
            'top-right'    => trans('badge.style.field.position.topRight'),
            'bottom-left'  => trans('badge.style.field.position.bottomLeft'),
            'bottom-right' => trans('badge.style.field.position.bottomRight'),
        ], [
            'label' => trans('badge.style.field.position'),
            'validations' => Rule::make()->notEmpty()
        ], $config['position']);

        return $form;
    }

    public function configDefault($text = '') : array {
        return [
            'bgColor'       => '#2f5acf',
            'textColor'     => '#fff',
            'text'          => $text,
            'position'      => 'top-right',
        ];
    }

    public function save(\SkillDo\Http\Request $request, $productBadge, $objectKey): void
    {
        $productBadge[$objectKey][$this->style]['bgColor'] = Str::clear($request->input('bgColor'));
        $productBadge[$objectKey][$this->style]['textColor'] = Str::clear($request->input('textColor'));
        $productBadge[$objectKey][$this->style]['text'] = Str::clear($request->input('text'));
        $productBadge[$objectKey][$this->style]['position'] = Str::clear($request->input('position'));

        Option::update('product_badge', $productBadge);
    }
}