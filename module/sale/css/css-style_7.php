<?php
	if( $value['position'] == 'top-left' ) 		{
		$position = 'top:0px; left:0px;';
		$position_text ='top: 15px; left: -25px;';
		$rotate = '-45deg'; 
		$border = 'border-left: 65px solid '.$value['bg_color'].';border-bottom: 65px solid transparent;border-right:0;';
	}
	if( $value['position'] == 'top-right' ) 	{ 
		$position = 'top:0px; right:0px;';
		$rotate = '45deg';
		$position_text ='top: 15px; left: 0px;';
		$border = 'border-right: 65px solid '.$value['bg_color'].';border-bottom: 65px solid transparent;';
	}
	if( $value['position'] == 'bottom-left' ) 	{ 
		$position = 'bottom:0px; left:0px; top:auto; right:auto;';
		$rotate = '45deg';
		$position_text ='bottom: 15px; right: 0px; top:auto; left:auto;';
		$border = 'border-bottom: 65px solid '.$value['bg_color'].';border-right: 65px solid transparent;';
	}
	if( $value['position'] == 'bottom-right' ) 	{ 
		$position = 'bottom:0px; right:0px;top:auto; left:auto;';
		$rotate = '-45deg'; 
		$position_text ='bottom: 15px; right: -25px;top:auto; left:auto;';
		$border = 'border-bottom: 65px solid '.$value['bg_color'].';border-left: 65px solid transparent;';
	}
?>
<style type="text/css">
	.badge__sale_style_7 {
	    color: <?php echo $value['text_color'];?>;
	    <?php echo $position;?>
	}
    .badge__sale_style_7 div.wcbm-badge-css-s1 {
	    <?php echo $border;?>
	}
	.badge__sale_style_7 span {
	    -webkit-transform: rotate(<?php echo $rotate;?>);
	    -ms-transform: rotate(<?php echo $rotate;?>);
	    transform: rotate(<?php echo $rotate;?>);
	    <?php echo $position_text;?>
	}
</style>