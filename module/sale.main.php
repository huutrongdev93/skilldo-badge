<?php
if(!function_exists('admin_badge_sale_tab')) {
	function admin_badge_sale_tab( $tabs ) {
		$tabs['sale'] 	= array( 'label' => 'Khuyễn Mãi', 	'callback' => 'admin_page_badge_sale_callback');
		return $tabs;
	}
	add_filter( 'admin_badge_settings_sub_tabs', 'admin_badge_sale_tab', 8 );
}
if(!function_exists('admin_badge_sale_tab_general')) {
    function admin_badge_sale_tab_general( $general ) {
        include 'sale/html-general-setting.php';
    }
    add_action( 'admin_badge_settings_tabs_general', 'admin_badge_sale_tab_general', 10, 1 );
}
class Badge_Sale {
    function __construct() {
        $general = Option::get('wcmc_general_setting');
        if(!empty($general['sale_hidden'])) {
            add_action('theme_custom_css', array($this, 'css'));
            add_action('cle_header', array($this, 'cssCustom'), 1000);
            add_action('product_object_image', array($this, 'render'));
        }
    }
    static public function style($key = '') {
        $sale_main_active    = Option::get('wcmc_sale_style');
        $sale_main_setting   = Option::get('wcmc_sale_setting');
        $sale_style = array(
            'style_1' => array(
                'bg_color'      => 'rgb(0, 173, 239)',
                'border_color'  => 'rgb(0, 173, 239)',
                'text'          => 'Sale',
                'text_color'    => 'rgb(255, 255, 255)',
                'text_hidden'   => 1,
                'text_position' => 'percent-text',
                'position'      => 'top-left',
                'border_radius' => array( 'top-left' => 100, 'top-right' => 100, 'bottom-right' => 100, 'bottom-left' => 100 )
            ),
            'style_2' => array( 'bg_color'   => 'rgb(0, 173, 239)', 'text_color' => 'rgb(255, 255, 255)', 'position'   => 'top-left' ),
            'style_3' => array( 'bg_color'   => 'rgb(255, 220, 0)', 'text_color' => 'rgb(0, 0, 0)', 'position'   => 'top-left' ),
            'style_4' => array( 'bg_color'   => '#6C2D66', 'text_color' => '#fff', 'position'   => 'top-left' ),
            'style_5' => array( 'bg_color1'  => '#d3362d', 'bg_color2'   => '#e57368', 'text_color' => '#fff', 'position'   => 'top-left' ),
            'style_6' => array( 'bg_color'   => '#CC1C82', 'text_color' => '#fff', 'position'   => 'bottom-left' ),
            'style_7' => array( 'bg_color'   => '#11A509', 'text_color' => '#fff', 'position'   => 'top-left' ),
            'style_image' => array()
        );
        if(isset($sale_style[$sale_main_active]) && have_posts($sale_main_setting)) {
            $sale_style[$sale_main_active] = $sale_main_setting;
            $sale_style[$sale_main_active]['active'] = 1;
            if($key == 'active') return $sale_style[$sale_main_active];
        }
        if(isset($sale_style[$key])) return $sale_style[$key];
        return apply_filters('badge_sale_style', $sale_style );
    }
    static public function tab() {
        Plugin::partial( BADGE_NAME, 'module/sale/html-badge-sale');
    }
    static public function save($result, $data) {
        Option::update( 'wcmc_sale_style', Str::clear($data['style']) );
        unset($data['style']);
        Option::update( 'wcmc_sale_setting', $data);
        $result['status'] = 'success';
        $result['message'] = 'Lưu dữ liệu thành công';
        return $result;
    }
    public function render($item) {
        if($item->price_sale != 0) {
            $general = Option::get('wcmc_general_setting');
            if(!empty($general['sale_hidden'])) {
                $key    = option::get('wcmc_sale_style','style_1');
                $value  = static::style($key);
                $percent = '-'.ceil(100 - ($item->price_sale/$item->price)*100);
                include 'sale/items/html-item-'.$key.'.php';
            }
        }
    }
    public function css() {
        include 'sale/style.sale.php';
    }
    public function cssCustom() {
        $key    = Option::get('wcmc_sale_style','style_1');
        $value  = static::style($key);
        include 'sale/css/css-'.$key.'.php';
    }
}
new Badge_Sale();

