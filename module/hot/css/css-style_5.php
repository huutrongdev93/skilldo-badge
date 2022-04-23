<?php
	if( $value['position'] == 'top-left' ) 		$position = 'top:0px; left: 0px;';
	if( $value['position'] == 'top-right' ) 	$position = 'top:0px; right: 0px;';
?>
<style type="text/css">
	.wcmc-badge__hot_style_5 {
		position: absolute;
		<?php echo $position;?>
		line-height: 18px;
		font-size: 18px;
		text-transform: uppercase;
		text-align: center;
		font-weight: bold;
		text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);
		letter-spacing: -2px;
		display: block;
		width: 6rem;
		height: 5rem;
		color: <?php echo $value['text_color'];?>;
		margin: 0 0.5em 0;
		float: left;
		padding-top: 1rem;
		-webkit-filter: drop-shadow(0 0.5rem 0.3em rgba(0, 0, 0, 0.5));
		transform: translate3d(0, 0, 0);
	}

	.wcmc-badge__hot_style_5:after {
		content: "";
		width: 0;
		height: 0;
		border-right: 3rem solid transparent;
		border-left: 3rem solid transparent;
		border-top: 1.5rem solid #CCCCCC;
		position: absolute;
		top: 5rem;
		left: 0;
	}

	.wcmc-badge__hot_style_5 {
		background: -webkit-linear-gradient(<?php echo $value['bg_color1'];?> 0%, <?php echo $value['bg_color2'];?> 100%);
		background: -o-linear-gradient(<?php echo $value['bg_color1'];?> 0%, <?php echo $value['bg_color2'];?> 100%);
		background: linear-gradient(<?php echo $value['bg_color1'];?> 0%, <?php echo $value['bg_color2'];?> 100%);
	}
	.wcmc-badge__hot_style_5:after {
		border-top: 1.5rem solid <?php echo $value['bg_color2'];?>;
	}
</style>