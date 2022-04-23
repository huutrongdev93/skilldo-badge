<?php
$inputs = [
	array('field' => 'hot_hidden', 'label' => 'Bật / Tắt Badge Nổi Bật (HOT)', 'type'  => 'switch'),
];
foreach ($inputs as $input) {
	echo _form( $input, (isset($general[$input['field']])) ? $general[$input['field']] : '' );
}