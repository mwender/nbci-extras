<?php

namespace nbci\enqueues;

function enqueue_scripts(){
  // Our custom styles
  wp_enqueue_style( 'nbci-extras', NBCI_URL . 'lib/' . NBCI_CSS_DIR . '/main.css', null, filemtime( NBCI_DIR . 'lib/' . NBCI_CSS_DIR . '/main.css' ) );

  // DataTables
  wp_register_style( 'datatables', 'https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css', null, '1.10.22' );
  wp_register_script( 'datatables', 'https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js', ['jquery'], '1.10.22', true );
  wp_register_script( 'cpttable', NBCI_URL . 'lib/js/cpttable.js', ['datatables'], filemtime( NBCI_DIR . 'lib/js/cpttable.js' ), true );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts' );