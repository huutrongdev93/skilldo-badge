<?php
class ProductBadgeAjax {
    static function generalSave($ci, $model): bool
    {
        $result['status'] 	= 'error';

        $result['message'] 	= 'Lưu dữ liệu không thành công!';

        $data =  Request::post();

        if( have_posts($data) ) {

            unset($data['action']);

            unset($data['post_type']);

            unset($data['cate_type']);

            Option::update( 'product_badge_general_setting', $data );

            $result['status'] 	= 'success';

            $result['message'] 	= 'Lưu dữ liệu thành công!';
        }

        echo json_encode($result);

        return true;
    }
    static function styleLoad($ci, $model): bool
    {
        $result['status'] 	= 'error';

        $result['message'] 	= 'Lưu dữ liệu không thành công!';

        if(Request::post()) {

            $objectKey = Request::post('objectId');

            $style = Request::post('style');

            if(empty($objectKey)) {
                $result['message'] 	= 'Không có section để lây dữ liệu';
                echo json_encode($result);
                return true;
            }

            if(empty($style)) {
                $result['message'] 	= 'Bạn chưa chọn Style';
                echo json_encode($result);
                return true;
            }

            $styleObject = ProductBadgeStyle::list($style);

            if(empty($styleObject)) {
                $result['message'] 	= 'Style bạn chọn không tồn tại';
                echo json_encode($result);
                return true;
            }

            $productBadge = Option::get('product_badge');

            $textDefault  = apply_filters('product_badge_text', '', $objectKey, $style);

            $styleConfig = $styleObject->configDefault($textDefault);

            if(!empty($productBadge[$objectKey][$style])) {
                $styleConfig = $productBadge[$objectKey][$style];
            }

            $result['form'] 	= base64_encode($styleObject->form($styleConfig));

            $result['status'] 	= 'success';

            $result['message'] 	= 'Lưu dữ liệu thành công!';
        }

        echo json_encode($result);

        return true;
    }
    static function objectSave( $ci, $model ): bool
    {

        $result['status'] 	= 'error';

        $result['message'] 	= 'Lưu dữ liệu không thành công!';

        if(Request::post()) {

            $objectKey = Request::post('objectId');

            $style = Request::post('styleId');

            if(empty($objectKey)) {
                $result['message'] 	= 'Không có section để lây dữ liệu';
                echo json_encode($result);
                return true;
            }

            if(empty($style)) {
                $result['message'] 	= 'Bạn chưa chọn Style';
                echo json_encode($result);
                return true;
            }

            $styleObject = ProductBadgeStyle::list($style);

            if(empty($styleObject)) {
                $result['message'] 	= 'Style bạn chọn không tồn tại';
                echo json_encode($result);
                return true;
            }

            $productBadge = Option::get('product_badge');

            if(empty($productBadge)) $productBadge = [];

            if(isset($productBadge[$objectKey])) {
                $productBadge[$objectKey]['active'] = $style;
                $productBadge[$objectKey][$style]   = $styleObject->configDefault();
            }

            $result = $styleObject->save(Request::post(), $productBadge, $objectKey);
        }

        echo json_encode($result);

        return true;
    }
}
Ajax::admin('ProductBadgeAjax::generalSave');
Ajax::admin('ProductBadgeAjax::styleLoad');
Ajax::admin('ProductBadgeAjax::objectSave');