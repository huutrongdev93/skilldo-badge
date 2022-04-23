<?php
	if( $value['position'] == 'top-left' ) 		{ 
		$position = 'top:0px; left:0px;';
		$position_text ='top: 15px; left: -25px;';
		$rotate = '-45deg'; 
		$border = 'border-left: 65px solid '.$value['bg_color'].';border-bottom: 65px solid transparent;';
	}
	if( $value['position'] == 'top-right' ) 	{ 
		$position = 'top:0px; right:0px;';
		$rotate = '45deg';
		$position_text ='top: 15px; left: 0px;';
		$border = 'border-right: 65px solid '.$value['bg_color'].';border-bottom: 65px solid transparent;';
	}
	if( $value['position'] == 'bottom-left' ) 	{ 
		$position = 'bottom:0px; left:0px;'; 
		$rotate = '45deg';
		$position_text ='bottom: 15px; right: 0px;';
		$border = 'border-bottom: 65px solid '.$value['bg_color'].';border-right: 65px solid transparent;';
	}

	if( $value['position'] == 'bottom-right' ) 	{ 
		$position = 'bottom:0px; right:0px;'; 
		$rotate = '-45deg'; 
		$position_text ='bottom: 15px; right: -25px;';
		$border = 'border-bottom: 65px solid '.$value['bg_color'].';border-left: 65px solid transparent;';
	}
?>
<style type="text/css">
	.wcmc-badge__new_style_7 {
	    color: <?php echo $value['text_color'];?>;
	    position: relative;
	    box-sizing: border-box;
	    position: absolute;
	    background-color: transparent;
	    width: 65px;
	    height: 65px;

	    <?php echo $position;?>

	    -ms-transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
	    -webkit-transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
	    transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
	    opacity: 1;
	}

	.wcmc-badge__new_style_7 div.wcbm-badge-css-s1 {
	    width: 0;
	    height: 0;
	    <?php echo $border;?>
	    z-index: 12;
	}

	.wcmc-badge__new_style_7 span {
	    font-size: 13px;
	    font-weight: bold;
	    line-height: 13px;
	    position: absolute;
	    z-index: 14;
	    -webkit-transform: rotate(<?php echo $rotate;?>);
	    -ms-transform: rotate(<?php echo $rotate;?>);
	    transform: rotate(<?php echo $rotate;?>);
	    <?php echo $position_text;?>
	    width: 91px;
	    text-align: center;
	}
</style>