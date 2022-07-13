<?php
/**
Plugin name     : badge management
Plugin class    : badge_management
Plugin uri      : http://sikido.vn
Description     : Quản lý Huy hiệu WooCommerce cung cấp cho bạn huy hiệu và khả năng quản lý chúng cho các sản phẩm của cửa hàng của bạn.
Author          : Nguyễn Hữu Trọng
Version         : 2.1.0
*/
const BADGE_NAME = 'badge-management';
define('BADGE_PATH', Path::plugin(BADGE_NAME));
class Badge_Management {
	private $name = 'Badge_Management';
    static function style() {
        include 'assets/css/style.css';
    }
	public function active() {}
	public function uninstall() {}
}
include 'badge-admin.php';
include 'badge-input.php';
include 'module/hot.main.php';
include 'module/sale.main.php';
add_action('theme_custom_css', 'Badge_Management::style');