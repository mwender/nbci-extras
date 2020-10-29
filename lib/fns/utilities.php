<?php

namespace nbci\utilities;

function build_table( $array, $id = 'table' ){
  // start table
  $html = '<table class="table" id="' . $id . '">';
  // header row
  $html .= '<thead><tr>';
  foreach( $array[0] as $key => $value ){
    $html .= '<th>' . htmlspecialchars( $key ) . '</th>';
  }
  $html .= '</tr></thead>';

  // data rows
  $html.= '<tbody>';
  foreach( $array as $key => $value ){
      $html .= '<tr>';
      foreach( $value as $key2 => $value2 ){
          $html .= '<td>' . $value2 . '</td>';
      }
      $html .= '</tr>';
  }
  $html .= '</tbody>';

  // finish table and return it

  $html .= '</table>';
  return $html;
}

function message( $atts ){
  $args = shortcode_atts([
    'message' => null,
    'type' => 'alert'
  ], $atts );

  if( is_null( $args['message'] ) )
    $args['message'] = '<code>No $message specified.</code>';

  $format = '<div class="%1$s message">%2$s</div>';
  $message = sprintf( $format, $args['type'], $args['message'] );
  return $message;
}