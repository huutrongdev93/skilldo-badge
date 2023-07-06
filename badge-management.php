<?php
/**
Plugin name     : Nhãn hiệu sản phẩm
Plugin class    : badge_management
Plugin uri      : http://sikido.vn
Description     : Quản lý Huy hiệu cung cấp cho bạn huy hiệu và khả năng quản lý chúng cho các sản phẩm của cửa hàng của bạn.
Author          : Nguyễn Hữu Trọng
Version         : 3.0.1
*/
const BADGE_NAME = 'badge-management';
define('BADGE_PATH', Path::plugin(BADGE_NAME));
class Badge_Management {
	private string $name = 'Badge_Management';
    static function style(): void
    {
        include 'assets/css/style.css';
    }
}
include 'badge-ajax.php';
include 'badge-admin.php';
include 'badge-input.php';
include 'module/collections.php';
include 'module/sales.php';
include 'styles/styles.php';
add_action('theme_custom_css', 'Badge_Management::style');