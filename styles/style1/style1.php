<?php
class BadgeStyle1 {
    private string $style = 'style1';

    public function html($objectKey = null, $config = []): void
    {
        if($config == []) {
            $text   = apply_filters('badge_style_text', 'văn bản', $objectKey);
            $text   = apply_filters('badge_style1_text', $text, $objectKey);
            $config = $this->configDefault($text);
        }
        Plugin::partial(BADGE_NAME, 'styles/'. $this->style .'/html/html', $config);
    }

    public function css(): void {
        echo Template::less(file_get_contents(FCPATH.Path::plugin().BADGE_NAME.'/styles/'. $this->style .'/css/style.less'))->getCss();
    }

    public function form($config): string
    {
        $form = new FormBuilder();
        $form->add('bgColor', 'color', ['label' => 'Màu nền', 'start' => 4], $config['bgColor']);
        $form->add('borderColor', 'color', ['label' => 'Màu viền', 'start' => 4], $config['borderColor']);
        $form->add('textColor', 'color', ['label' => 'Màu chữ', 'start' => 4], $config['textColor']);
        $form->add('text', 'text', ['label' => 'Chữ'], $config['text']);
        $form->add('position', 'select', ['label' => 'Vị Trí', 'options' => [
            'top-left'     => 'Phía trên bên trái',
            'top-right'    => 'Phía trên bên phải',
            'bottom-left'  => 'Phía dưới bên trái',
            'bottom-right' => 'Phía dưới bên phải',
        ]], $config['position']);
        $form->add('borderRadius', 'border_radius', ['label' => 'Bo Tròn'], $config['borderRadius']);

        return $form->html();
    }

    public function configDefault($text = '') : array {
        return [
            'bgColor'       => '#2f5acf',
            'borderColor'   => '#2f5acf',
            'textColor'     => '#fff',
            'text'          => $text,
            'position'      => 'top-right',
            'borderRadius'  => [
                'top-left'      => 4,
                'top-right'     => 4,
                'bottom-left'   => 4,
                'bottom-right'  => 4,
            ]
        ];
    }

    public function save($request, $productBadge, $objectKey): array
    {
        if(!isset($request['bgColor'])) {
            return ['status' => 'error', 'message' => 'Bạn chưa chọn màu nền'];
        }
        if(!isset($request['borderColor'])) {
            return ['status' => 'error', 'message' => 'Bạn chưa chọn màu viền'];
        }
        if(!isset($request['textColor'])) {
            return ['status' => 'error', 'message' => 'Bạn chưa chọn màu chữ'];
        }
        if(empty($request['text'])) {
            return ['status' => 'error', 'message' => 'Bạn chưa điền văn bản'];
        }
        if(empty($request['position'])) {
            return ['status' => 'error', 'message' => 'Bạn chưa chọn vị trí hiển thị'];
        }
        if(!have_posts($request['borderRadius'])) {
            return ['status' => 'error', 'message' => 'Bạn chưa điền bo góc'];
        }
        $productBadge[$objectKey][$this->style]['bgColor'] = Str::clear($request['bgColor']);
        $productBadge[$objectKey][$this->style]['borderColor'] = Str::clear($request['borderColor']);
        $productBadge[$objectKey][$this->style]['textColor'] = Str::clear($request['textColor']);
        $productBadge[$objectKey][$this->style]['text'] = Str::clear($request['text']);
        $productBadge[$objectKey][$this->style]['position'] = Str::clear($request['position']);
        $productBadge[$objectKey][$this->style]['borderRadius'] = $request['borderRadius'];

        Option::update('product_badge', $productBadge);

        return ['status' => 'success', 'message' => 'Lưu dữ liệu thành công'];
    }
}