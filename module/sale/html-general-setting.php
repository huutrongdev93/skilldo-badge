<?php
$inputs = array(
	array(
		'field' => 'sale_hidden', 'label' => 'Bật / Tắt Badge Khuyến Mãi (Sale)', 'type'  => 'switch'
	),
);

foreach ($inputs as $input) {
	echo FormBuilder::render( $input, (isset($general[$input['field']])) ? $general[$input['field']] : '' );
}