<?php
	if( $value['position'] == 'top-left' ) 		$position = 'top:10px; left: 10px;';
	if( $value['position'] == 'top-right' ) 	$position = 'top:10px; right: 10px;';
	if( $value['position'] == 'bottom-left' ) 	$position = 'bottom:10px; left: 10px;';
	if( $value['position'] == 'bottom-right' ) 	$position = 'bottom:10px; right: 10px;';
?>
<style type="text/css">
	.badge__sale_style_1 {
		position: absolute; <?php echo $position;?>
	    line-height: 16px;
	    background: <?php echo $value['bg_color'];?>;
	    color: <?php echo $value['text_color'];?>;
	    font-size: 12px;
	    font-weight: 700;
	    padding: 6px 12px;
	    border:1px solid <?php echo $value['border_color'];?>;
	    border-radius: <?php echo $value['border_radius']['top-left'];?>px <?php echo $value['border_radius']['top-right'];?>px <?php echo $value['border_radius']['bottom-right'];?>px <?php echo $value['border_radius']['bottom-left'];?>px;
	}
</style>