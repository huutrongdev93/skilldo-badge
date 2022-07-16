<?php
if(!function_exists('admin_badge_settings_tabs')) {
	function admin_badge_settings_tabs( $tabs ) {
		$tabs['badge'] 	= array( 'label' => 'Nhãn Hiệu', 	'callback' => 'admin_page_badge_settings');
		return $tabs;
	}
	add_filter( 'admin_product_settings_tabs', 'admin_badge_settings_tabs' );
}
if(!function_exists('admin_badge_settings_sub_tabs')) {
    function admin_badge_settings_sub_tabs() {
        $tabs['general'] 	= ['label' => 'Cấu hình chung', 'callback' => 'admin_page_badge_settings_tabs_general'];
        return apply_filters('admin_badge_settings_sub_tabs', $tabs);
    }
}
if(!function_exists('admin_page_badge_settings')) {
	function admin_page_badge_settings($ci, $tab) {
		plugin_get_include(BADGE_NAME, 'admin/views/html-settings-tab-badge');
	}
}
if(!function_exists('admin_page_badge_settings_tabs_general')) {
	function admin_page_badge_settings_tabs_general( ) {
		$general = option::get( 'wcmc_general_setting');
		plugin_get_include( BADGE_NAME, 'admin/views/html-settings-tab-general', array('general' => $general));
	}
}
if(!function_exists('admin_badge_ajax_general_save')) {

	function admin_badge_ajax_general_save( $ci, $model ) {

		$result['status'] 	= 'error';

		$result['message'] 	= 'Lưu dữ liệu không thành công!';

		$data =  Request::post();

		if( have_posts($data) ) {
			unset($data['action']);
			unset($data['post_type']);
			unset($data['cate_type']);
			option::update( 'wcmc_general_setting', $data );
			$result['status'] 	= 'success';
			$result['message'] 	= 'Lưu dữ liệu thành công!';
		}

		echo json_encode($result);
	}
	Ajax::admin('admin_badge_ajax_general_save');
}
if(!function_exists('admin_badge_ajax_object_save')) {

    function admin_badge_ajax_object_save( $ci, $model ) {

        $result['status'] 	= 'error';

        $result['message'] 	= 'Lưu dữ liệu không thành công!';

        if(Request::post()) {

            $object_key = Request::Post('object_key');
            $data       =  Request::post();
            if(method_exists($object_key, 'save')) {
                unset($data['action']);
                unset($data['post_type']);
                unset($data['cate_type']);
                unset($data['object_key']);
                $result = $object_key::save($result, $data);
            }
        }

        echo json_encode($result);
    }
    Ajax::admin('admin_badge_ajax_object_save');
}