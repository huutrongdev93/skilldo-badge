<?php
	if( $value['position'] == 'top-left' ) 		$position = 'top:0px; left: 0px;';
	if( $value['position'] == 'top-right' ) 	$position = 'top:0px; right: 0px;';
	if( $value['position'] == 'bottom-left' ) 	$position = 'bottom:0px; left: 0px;';
	if( $value['position'] == 'bottom-right' ) 	$position = 'bottom:0px; right: 0px;';
?>
<style type="text/css">
	.wcmc-badge__new_style_1 {
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