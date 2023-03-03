<?php 

function beautyPrint($el) {
  echo '<pre>';
    print_r($el);
  echo '</pre>';
}

function parseValue ($amount) {
  $value = getFormattedAmount($amount);
  $parsed_value = str_replace('-', '', $value);

  if ($value == 0 ) {
    return $value;
  }

  return ($value > 0 ? '' : '<span class="absolute -left-2">-</span>') . '$' . $parsed_value;
}

function getFormattedAmount ($amount) {
  return str_replace([',', '$'], '', $amount);
}