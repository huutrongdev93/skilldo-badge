<?php
if(!function_exists('admin_badge_hot_tab')) {
    function admin_badge_hot_tab($tabs) {
        $tabs['hot'] 	= ['label' => 'Nổi Bật (Hot)', 'callback' => 'admin_page_badge_hot_tab'];
        return $tabs;
    }
    add_filter( 'admin_badge_settings_sub_tabs', 'admin_badge_hot_tab', 20 );
}
if(!function_exists('badge_hot_inner_tabs_general')) {
    function badge_hot_inner_tabs_general( $general ) {
        include 'hot/html-general-setting.php';
    }
    add_action( 'admin_badge_settings_tabs_general', 'badge_hot_inner_tabs_general', 10, 1 );
}
class Badge_hot {
    function __construct() {
        $general = Option::get('wcmc_general_setting');
        if(!empty($general['hot_hidden'])) {
            add_action('theme_custom_css', array($this, 'css'));
            add_action('cle_header', array($this, 'cssCustom'), 1000);
            add_action('product_object_image', array($this, 'render'));
        }
    }
    static public function style($key = '') {
        $hot_main_active    = option::get('wcmc_hot_style');
        $hot_main_setting   = option::get('wcmc_hot_setting');
        $hot_style = [
            'style_1' => array(
                'bg_color'      => 'rgb(0, 173, 239)',
                'border_color'  => 'rgb(0, 173, 239)',
                'text'          => 'HOT',
                'text_color'    => 'rgb(255, 255, 255)',
                'position'      => 'top-left',
                'border_radius' => array( 'top-left' => 100, 'top-right' => 100, 'bottom-right' => 100, 'bottom-left' => 100 )
            ),
            'style_2' => array(
                'bg_color'   => '#FF0000',
                'text_color' => '#fff',
                'text'       => 'HOT',
                'position'   => 'top-left'
            ),
            'style_3' => array(
                'bg_color'   => 'rgb(255, 220, 0)',
                'text_color' => 'rgb(0, 0, 0)',
                'text'       => 'HOT',
                'position'   => 'top-left'
            ),
            'style_4' => array(
                'bg_color'   => '#6C2D66',
                'text_color' => '#fff',
                'text'       => 'HOT',
                'position'   => 'top-left'
            ),
            'style_5' => array(
                'bg_color1'   => '#d3362d',
                'bg_color2'   => '#e57368',
                'text_color' => '#fff',
                'text'       => 'HOT',
                'position'   => 'top-left'
            ),
            'style_6' => array(
                'bg_color'   => '#CC1C82',
                'text_color' => '#fff',
                'text'       => 'HOT',
                'position'   => 'bottom-left'
            ),
            'style_7' => array(
                'bg_color'   => '#11A509',
                'text_color' => '#fff',
                'text'       => 'HOT',
                'position'   => 'top-left'
            ),
            'style_image' => array()
        ];
        if(isset($hot_style[$hot_main_active]) && have_posts($hot_main_setting)) {
            $hot_style[$hot_main_active] = $hot_main_setting;
            $hot_style[$hot_main_active]['active'] = 1;
            if($key == 'active') return $hot_style[$hot_main_active];
        }
        if(isset($hot_style[$key])) return $hot_style[$key];
        return apply_filters( 'badge_hot_style', $hot_style );
    }
    static public function tab() {
        plugin_get_include( BADGE_NAME, 'module/hot/html-badge-hot');
    }
    static public function save($result, $data) {
        option::update( 'wcmc_hot_style', Str::clear($data['style']) );
        unset($data['style']);
        option::update( 'wcmc_hot_setting', $data);
        $result['status'] = 'success';
        $result['message'] = 'Lưu dữ liệu thành công';
        return $result;
    }
    public function render($item) {
        if($item->status3 == 1) {
            $general = Option::get('wcmc_general_setting');
            if(!empty($general['hot_hidden'])) {
                $key = option::get('wcmc_hot_style','style_1');
                $value = static::style($key);
                include 'hot/items/html-item-'.$key.'.php';
            }
        }
    }
    public function css() {
        include 'hot/style.hot.php';
    }
    public function cssCustom() {
        $key    = option::get('wcmc_hot_style','style_1');
        $value  = static::style($key);
        include 'hot/css/css-'.$key.'.php';
    }
}
new Badge_hot();
