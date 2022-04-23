<input type="hidden" name="style" value="style_5" id="style">
<?php
$inputs = array(
	array(
		'field' => 'bg_color1', 'label' => 'Màu nền trên', 'type'  => 'color'
	),
	array(
		'field' => 'bg_color2', 'label' => 'Màu nền dưới', 'type'  => 'color'
	),
	//text option
	array(
		'field' => 'text', 'label' => 'Chữ', 'type'  => 'text'
	),
	array(
		'field' => 'text_color', 'label' => 'Màu chữ', 'type'  => 'color'
	),
	//position
	array(
		'field' => 'position', 'label' => 'Vị Trí', 'type'  => 'select',
		'options' => array(
			'top-left'     => 'Phía trên bên trái',
			'top-right'    => 'Phía trên bên phải',
		)
	),
);

foreach ($inputs as $input) {
	echo _form( $input, (isset($item[$input['field']])) ? $item[$input['field']] : '' );
}