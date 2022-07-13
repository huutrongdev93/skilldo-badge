<?php 
if( $value['text_hidden'] == 1 )
	$text = ( $value['text_position'] == 'percent-text' ) ? $percent.'% '.$value['text'] : $value['text'].' '.$percent.'%';
else
	$text = $value['text'];
?>
<div class="badge__item badge__sale_style_1">
	<span title="<?php echo $text;?>"><?php echo $text;?></span>
</div>