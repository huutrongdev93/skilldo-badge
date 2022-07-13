<?php
	if( $value['position'] == 'top-left' ) 		$position = 'top:0px; left: 8px;';
	if( $value['position'] == 'top-right' ) 	$position = 'top:0px; right: 8px;';
	if( $value['position'] == 'bottom-left' ) 	$position = 'bottom:0px; left: 8px;';
	if( $value['position'] == 'bottom-right' ) 	$position = 'bottom:0px; right: 8px;';
?>
<style type="text/css">
	.badge__sale_style_4 {
		position: absolute;
		<?php echo $position;?>
		font-size: 18px;
		transform: rotate(45deg);
		margin: 20px auto;
		background-color: <?php echo $value['bg_color'];?>;
		width: 50px;
		height: 50px;
		line-height: 50px;
		text-align: center;
		text-transform: uppercase;
		border-radius: 8px;
		color: <?php echo $value['text_color'];?>;
		text-shadow: 0 1px 1px rgba(0,0,0,.3);
	}
	.badge__sale_style_4 span {
		display: block;
		transform: rotate(-45deg);
		opacity: .9;
        font-size: 20px;
        text-align: center;
        margin-left: -5px;
        margin-top: 13px;
	}
</style>