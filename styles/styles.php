<?php
include 'style1/style1.php';
include 'style2/style2.php';
include 'style3/style3.php';
include 'style4/style4.php';
include 'style5/style5.php';
include 'style6/style6.php';
include 'style7/style7.php';

class ProductBadgeStyle {

    static function list($key = null) {

        $style = [
            'style1' => new BadgeStyle1(),
            'style2' => new BadgeStyle2(),
            'style3' => new BadgeStyle3(),
            'style4' => new BadgeStyle4(),
            'style5' => new BadgeStyle5(),
            'style6' => new BadgeStyle6(),
            'style7' => new BadgeStyle7(),
        ];

        if($key != null) return (isset($style[$key])) ? $style[$key] : [];

        return $style;
    }
}