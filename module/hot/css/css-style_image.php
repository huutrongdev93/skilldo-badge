<?php
	if( $value['position'] == 'top-left' ) 		$position = 'top:0px; left: 0px;';
	if( $value['position'] == 'top-right' ) 	$position = 'top:0px; right: 0px;';
	if( $value['position'] == 'bottom-left' ) 	$position = 'bottom:0px; left: 0px;';
	if( $value['position'] == 'bottom-right' ) 	$position = 'bottom:0px; right: 0px;';
?>
<style type="text/css">
	.badge__hot_style_image {
		position: absolute; <?php echo $position;?>
	}
	.badge__hot_style_image img {
		width: 50px;
	}
</style>