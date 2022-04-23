<?php
$inputs = array(
	array(
		'field' => 'new_hidden', 'label' => 'Bật / Tắt Badge Mới (New)', 'type'  => 'switch'
	),
);

foreach ($inputs as $input) {
	echo _form( $input, (isset($general[$input['field']])) ? $general[$input['field']] : '' );
}