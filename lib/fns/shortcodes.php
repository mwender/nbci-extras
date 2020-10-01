<?php

namespace nbci\shortcodes;
use function nbci\utilities\{build_table,message};

function cpt_table( $atts ){
  $args = shortcode_atts([
    'posttype'  => null,
    'orderby'   => 'title',
    'order'     => 'ASC',
    'columns'   => 'Title,Image,Description',
  ], $atts );

  if( is_null( $args['posttype'] ) )
    return message( ['message' => 'No `posttype` specified.'] );

  if( ! post_type_exists( $args['posttype'] ) )
    return message( ['message' => 'No `' . $args['posttype'] . '` post_type exists.' ] );

  $columns = explode( ',', $args['columns'] );

  $query_args = [
    'post_type'       => $args['posttype'],
    'posts_per_page'  => -1,
    'orderby'         => $args['orderby'],
    'order'           => $args['order'],
  ];
  $posts = get_posts( $query_args );

  $x = 0;
  foreach ( $posts as $post ) {
    $rows[$x] = [
      $columns[0] => $post->post_title,
      $columns[1] => get_the_post_thumbnail( $post->ID, 'full' ),
      $columns[2] => $post->post_content,
    ];
    $x++;
  }

  wp_enqueue_style( 'datatables' );
  wp_enqueue_script( 'cpttable' );
  wp_localize_script( 'cpttable', 'wpvars', [
    'tableId' => $args['posttype'],
  ]);

  $html = build_table( $rows, $args['posttype'] );
  return $html;
}
add_shortcode( 'cpttable', __NAMESPACE__ . '\\cpt_table' );