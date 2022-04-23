<?php
if(!function_exists('admin_badge_new_tab')) {
	function admin_badge_new_tab( $tabs ) {
		$tabs['new'] 	= array('label' => 'Mới (new)', 'callback' => 'woocommerce_badge_new_callback');
		return $tabs;
	}
	add_filter( 'admin_badge_settings_sub_tabs', 'admin_badge_new_tab', 20 );
}
if(!function_exists('admin_badge_new_tab_general')) {
    function admin_badge_new_tab_general($general) {
        include 'new/html-general-setting.php';
    }
    add_action( 'admin_badge_settings_tabs_general', 'admin_badge_new_tab_general', 10, 1 );
}
class Badge_new {
    function __construct() {
        $general = Option::get('wcmc_general_setting');
        if(!empty($general['new_hidden'])) {
            add_action('theme_custom_css', array($this, 'css'));
            add_action('cle_header', array($this, 'cssCustom'), 1000);
            add_action('product_object_image', array($this, 'render'));
        }
    }
    static public function style($key = '') {
        $new_main_active    = option::get('wcmc_new_style');
        $new_main_setting   = option::get('wcmc_new_setting');
        $new_style = array(
            'style_1' => array(
                'bg_color'      => 'rgb(0, 173, 239)',
                'border_color'  => 'rgb(0, 173, 239)',
                'text'          => 'new',
                'text_color'    => 'rgb(255, 255, 255)',
                'position'      => 'top-left',
                'border_radius' => array( 'top-left' => 100, 'top-right' => 100, 'bottom-right' => 100, 'bottom-left' => 100 )
            ),
            'style_2' => array(
                'bg_color'   => '#FF0000',
                'text_color' => '#fff',
                'text'       => 'new',
                'position'   => 'top-left'
            ),
            'style_3' => array(
                'bg_color'   => 'rgb(255, 220, 0)',
                'text_color' => 'rgb(0, 0, 0)',
                'text'       => 'new',
                'position'   => 'top-left'
            ),
            'style_4' => array(
                'bg_color'   => '#6C2D66',
                'text_color' => '#fff',
                'text'       => 'new',
                'position'   => 'top-left'
            ),
            'style_5' => array(
                'bg_color1'   => '#d3362d',
                'bg_color2'   => '#e57368',
                'text_color' => '#fff',
                'text'       => 'new',
                'position'   => 'top-left'
            ),
            'style_6' => array(
                'bg_color'   => '#CC1C82',
                'text_color' => '#fff',
                'text'       => 'new',
                'position'   => 'bottom-left'
            ),
            'style_7' => array(
                'bg_color'   => '#11A509',
                'text_color' => '#fff',
                'text'       => 'new',
                'position'   => 'top-left'
            ),
            'style_image' => array()
        );
        if(isset($new_style[$new_main_active]) && have_posts($new_main_setting)) {
            $new_style[$new_main_active] = $new_main_setting;
            $new_style[$new_main_active]['active'] = 1;
            if($key == 'active') return $new_style[$new_main_active];
        }
        if(isset($new_style[$key])) return $new_style[$key];
        return apply_filters( 'badge_new_style', $new_style );
    }
    static public function tab() {
        plugin_get_include( BADGE_NAME, 'module/new/html-badge-new');
    }
    static public function save($result, $data) {
        option::update( 'wcmc_new_style', Str::clear($data['style']) );
        unset($data['style']);
        option::update( 'wcmc_new_setting', $data);
        $result['status'] = 'success';
        $result['message'] = 'Lưu dữ liệu thành công';
        return $result;
    }
    public function render($item) {
        if($item->status1 != 0) {
            $general = Option::get('wcmc_general_setting');
            if(!empty($general['new_hidden'])) {
                $key    = option::get('wcmc_new_style','style_1');
                $value  = static::style($key);
                include 'new/items/html-item-'.$key.'.php';
            }
        }
    }
    public function css() {
        include 'new/style.new.php';
    }
    public function cssCustom() {
        $key    = option::get('wcmc_new_style','style_1');
        $value  = static::style($key);
        include 'new/css/css-'.$key.'.php';
    }
}
new Badge_new();