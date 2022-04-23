<?php
$inputs = array(
	array(
		'field' => 'sale_hidden', 'label' => 'Bật / Tắt Badge Khuyến Mãi (Sale)', 'type'  => 'switch'
	),
);

foreach ($inputs as $input) {
	echo _form( $input, (isset($general[$input['field']])) ? $general[$input['field']] : '' );
}