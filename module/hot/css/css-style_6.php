<?php
	if( $value['position'] == 'top-left' ) 		{ 
		$position = 'top:0px; left: 8px;';
		$border = '
			border-top-left-radius: 0;
		    border-bottom-left-radius: 45px;
		    border-top-right-radius: 45px;
		    border-bottom-right-radius: 45px;
		';
	}

	if( $value['position'] == 'top-right' ) 	{ 
		$position = 'top:0px; right: 8px;';
		$border = '
			border-top-left-radius: 45px;
		    border-bottom-left-radius: 45px;
		    border-top-right-radius: 0px;
		    border-bottom-right-radius: 45px;
		';
	}

	if( $value['position'] == 'bottom-left' ) 	{ 
		$position = 'bottom:0px; left: 8px;';
		$border = '
			border-top-left-radius: 45px;
		    border-bottom-left-radius: 0px;
		    border-top-right-radius: 45px;
		    border-bottom-right-radius: 45px;
		';
	}

	if( $value['position'] == 'bottom-right' ) 	{ 
		$position = 'bottom:0px; right: 8px;';
		$border = '
			border-top-left-radius: 45px;
		    border-bottom-left-radius: 45px;
		    border-top-right-radius: 45px;
		    border-bottom-right-radius: 0px;
		';
	}

?>
<style type="text/css">
	.wcmc-badge__hot_style_6 {

		position: absolute;
		<?php echo $position;?>

	    box-sizing: border-box;
	    text-align: center;
	    z-index: 10;

		color: <?php echo $value['text_color'];?>;;
	    background-color: <?php echo $value['bg_color'];?>;

	    width: 45px;
	    height: 45px;
	    line-height: 45px;

	    <?php echo $border;?>

	    padding-top: 0px;
	    padding-bottom: 0px;
	    padding-left: 0px;
	    padding-right: 0px;
	    font-size: 12px;

	    -ms-transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
	    -webkit-transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
	    transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
	    opacity: 1;
	}
</style>