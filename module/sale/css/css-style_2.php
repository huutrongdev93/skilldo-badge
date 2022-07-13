<?php
	if( $value['position'] == 'top-left' ) 		$position = 'top:10px; left: 10px;';
	if( $value['position'] == 'top-right' ) 	$position = 'top:10px; right: 10px;';
	if( $value['position'] == 'bottom-left' ) 	$position = 'bottom:10px; left: 10px;';
	if( $value['position'] == 'bottom-right' ) 	$position = 'bottom:10px; right: 10px;';
?>
<style type="text/css">
	.badge__sale_style_2 {
		border-radius: 5px;
		font-size: 12px;
		padding: 0px 10px;
		color:<?php echo $value['text_color'];?>;
	}
	.badge__sale_style_2 {
		position: absolute; <?php echo $position;?>
		display: inline-block;
		background-color: <?php echo $value['bg_color'];?>;
		width: auto;
		margin-left: 20px;
		height: 36px;
		line-height: 36px;
	}
	.badge__sale_style_2::before {
		position: absolute;
		left: -15px;
		top: 2px;
		content: '';
		display: block;
		width: 0;
		height: 0;
		border-top: 16px solid transparent;
		border-right: 16px solid <?php echo $value['bg_color'];?>;
		border-bottom: 16px solid transparent;
	}
	.badge__sale_style_2::after {
		display: block;
		content: '';
		position: absolute;
		background: #fff;
		width: 10px;
		height: 10px;
		border-radius: 10px;
		left: -5px;
		top: calc(100% / 2 - 5px);
	}
</style>