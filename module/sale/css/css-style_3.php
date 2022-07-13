<?php
	if( $value['position'] == 'top-left' ) 		{ $position = 'top:20px; left:-70px;'; $rotate = '-45deg'; }
	if( $value['position'] == 'top-right' ) 	{ $position = 'top:20px; right:-70px;'; $rotate = '45deg'; }
	if( $value['position'] == 'bottom-left' ) 	{ $position = 'bottom:20px; left: -70px;'; $rotate = '45deg'; }
	if( $value['position'] == 'bottom-right' ) 	{ $position = 'bottom:20px; right: -70px;'; $rotate = '-45deg'; }
?>
<style type="text/css">
	.badge__sale_style_3 {
		position: absolute;
		<?php echo $position;?>
		width: 200px;
		height: 24px;
		text-align: center;
		transform: rotate(<?php echo $rotate;?>);
		background-color: <?php echo $value['bg_color'];?>;
	}

	.badge__sale_style_3 span {
		vertical-align: middle;
		font-weight: bold;
		text-transform: uppercase;
		font-size: 13px;
		color: <?php echo $value['text_color'];?>;
	}
</style>