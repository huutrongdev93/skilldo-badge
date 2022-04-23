<input type="hidden" name="style" value="style_image" id="style">
<?php
$inputs = array(
	array(
		'field' => 'image',
		'label' => 'Ảnh',
		'type'  => 'image'
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