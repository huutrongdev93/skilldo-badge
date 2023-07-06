<?php
function _form_border_radius($param, $value = array()): string
{

    $value_default = array( 'top-left' => 0, 'top-right' => 0, 'bottom-right' => 0, 'bottom-left' => 0 );

    $output = '';

    if(!isset($value) || !is_array($value)) $value = array();

    $value = array_merge($value_default, $value);

    $output .= '<div class="stote_wg_item row m-1">';

    $output .= '<div class="col-md-3">';
    $input = array('field' => $param->field.'[top-left]', 'label' =>'Top left', 'type' => 'number');
    $output .= _form($input, $value['top-left']);
    $output .= '</div>';

    $output .= '<div class="col-md-3">';
    $input = array('field' => $param->field.'[top-right]', 'label' =>'Top right', 'type' => 'number');
    $output .= _form($input, $value['top-right']);
    $output .= '</div>';

    $output .= '<div class="col-md-3">';
    $input = array('field' => $param->field.'[bottom-right]', 'label' =>'Bottom right', 'type' => 'number');
    $output .= _form($input, $value['bottom-right']);
    $output .= '</div>';

    $output .= '<div class="col-md-3">';
    $input = array('field' => $param->field.'[bottom-left]', 'label' =>'Bottom left', 'type' => 'number');
    $output .= _form($input, $value['bottom-left']);
    $output .= '</div>';

    $output .= '</div>';


    return $output;
}