<?php
class BadgeStyle7 {
    private string $style = 'style7';

    public function html($objectKey = null, $config = []): void
    {
        if($config == []) {
            $text   = apply_filters('badge_style_text', 'văn bản', $objectKey);
            $text   = apply_filters('badge_style7_text', $text, $objectKey);
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
        $form->add('textColor', 'color', ['label' => 'Màu chữ', 'start' => 4], $config['textColor']);
        $form->add('text', 'text', ['label' => 'Dòng chữ 1', 'start' => 6], $config['text']);
        $form->add('text2', 'text', ['label' => 'Dòng chữ 2', 'start' => 6], (isset($config['text2'])) ? $config['text2'] : '');
        $form->add('position', 'select', ['label' => 'Vị Trí', 'options' => [
            'top'    => 'Phía trên',
            'bottom' => 'Phía dưới',
        ], 'start' => 6], $config['position']);
        $form->add('effect', 'select', ['label' => 'Hiệu ứng', 'options' => [
            'marquee'    => 'Chữ chạy từ trái qua phải',
            'marqueeTop' => 'Chữ chạy từ trên xuống',
        ], 'start' => 6], $config['effect']);
        return $form->html();
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

    public function save($request, $productBadge, $objectKey): array
    {
        if(!isset($request['bgColor'])) {
            return ['status' => 'error', 'message' => 'Bạn chưa chọn màu nền'];
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
        if(empty($request['effect'])) {
            return ['status' => 'error', 'message' => 'Bạn chưa chọn hiệu ứng hiển thị'];
        }
        $productBadge[$objectKey][$this->style]['bgColor'] = Str::clear($request['bgColor']);
        $productBadge[$objectKey][$this->style]['textColor'] = Str::clear($request['textColor']);
        $productBadge[$objectKey][$this->style]['text'] = Str::clear($request['text']);
        $productBadge[$objectKey][$this->style]['text2'] = Str::clear($request['text2']);
        $productBadge[$objectKey][$this->style]['position'] = Str::clear($request['position']);
        $productBadge[$objectKey][$this->style]['effect'] = Str::clear($request['effect']);

        Option::update('product_badge', $productBadge);

        return ['status' => 'success', 'message' => 'Lưu dữ liệu thành công'];
    }
}