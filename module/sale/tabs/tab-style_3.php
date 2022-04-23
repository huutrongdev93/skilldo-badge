<input type="hidden" name="style" value="style_3" id="style">
<?php
$inputs = array(
	array(
		'field' => 'bg_color',
		'label' => 'Màu nền',
		'type'  => 'color'
	),
	array(
		'field' => 'text_color',
		'label' => 'Màu chữ',
		'type'  => 'color'
	),
	array(
		'field' => 'position',
		'label' => 'Vị Trí',
		'type'  => 'select',
		'options' => array(
			'top-left'     => 'Phía trên bên trái',
			'top-right'    => 'Phía trên bên phải',
			'bottom-left'  => 'Phía dưới bên trái',
			'bottom-right' => 'Phía dưới bên phải',
		)
	),
);

foreach ($inputs as $input) {
	echo _form( $input, (isset($item[$input['field']])) ? $item[$input['field']] : '' );
}