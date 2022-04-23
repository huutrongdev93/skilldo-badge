<?php
/**
Plugin name     : badge management
Plugin class    : badge_management
Plugin uri      : http://sikido.vn
Description     : Quản lý Huy hiệu WooCommerce cung cấp cho bạn huy hiệu và khả năng quản lý chúng cho các sản phẩm của cửa hàng của bạn.
Author          : Nguyễn Hữu Trọng
Version         : 2.0.0
*/
define( 'BADGE_NAME', 'badge-management' );
define( 'BADGE_PATH', plugin_dir_path( BADGE_NAME ) );
class badge_management {
	private $name = 'badge_management';
	public function active() {}
	public function uninstall() {}
}
include 'badge-admin.php';
include 'badge-input.php';
include 'module/hot.main.php';
include 'module/sale.main.php';
include 'module/new.main.php';
function badge_style() {
	include 'assets/css/wcmc-style.css';
}
add_action('theme_custom_css', 'badge_style');