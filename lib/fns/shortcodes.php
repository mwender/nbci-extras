<?php

namespace nbci\shortcodes;
use function nbci\utilities\{build_table,message};

/**
 * Returns an HTML table built from a Custom Post Type (CPT).
 *
 * @param      array  $atts {
 *   Optional. An array of arguments.
 *
 *   @type  string  $posttype    The Custom Post Type we're displaying.
 *   @type  string  $orderby     The field we are ordering the results by (default: `title`).
 *   @type  string  $order       Order by which we're returning the results (default: ASC).
 *   @type  string  $columns     Comma seperated list of the table column headings.
 *   @type  string  $field_map   The name of the database fields we're retrieving.
 *   @type  string  $data_map    The type of data we're retrieving for each field (e.g. `text`, `image`, etc).
 *   @type  bool    $alert_empty Whether or not we're displaying an alert for empty fields, useful for debugging your `field_map` and `data_map`.
 * }
 * @return     string  HTML for our CPT table.
 */
function cpt_table( $atts ){
  $args = shortcode_atts([
    'posttype'    => null,
    'orderby'     => 'title',
    'order'       => 'ASC',
    'columns'     => 'Title,Image,Description',
    'field_map'   => 'post_title,post_thumbnail,post_content',
    'data_map'    => 'text,image,text',
    'alert_empty' => false,
  ], $atts );

  if( is_null( $args['posttype'] ) )
    return message( ['message' => 'No `posttype` specified.'] );

  if( ! post_type_exists( $args['posttype'] ) )
    return message( ['message' => 'No `' . $args['posttype'] . '` post_type exists.' ] );

  $columns = explode( ',', $args['columns'] );
  $field_map = explode( ',', $args['field_map'] );
  $data_map = explode( ',', $args['data_map'] );

  $query_args = [
    'post_type'       => $args['posttype'],
    'posts_per_page'  => -1,
    'orderby'         => $args['orderby'],
    'order'           => $args['order'],
  ];
  $posts = get_posts( $query_args );

  $x = 0;
  foreach ( $posts as $post ) {
    foreach( $columns as $key => $col_name ){
      $field = $field_map[$key];
      switch( $field ){
        case 'post_title':
        case 'post_content':
          $value = $post->$field;
          break;

        case 'post_thumbnail':
          $value = get_the_post_thumbnail( $post->ID, 'full' );
          break;

        default:
          $meta = get_post_meta( $post->ID, $field, true );
          if( empty( $meta ) ){
            $value = ( $args['alert_empty'] )? 'I couldn\'t find a <code>' . $field . '</code> field.' : '' ;
          } else {
            // Since we don't have any specific fields in the previous switch,
            // we have generic cases setup to try to pull the field data in
            // the correct format.
            $data_type = $data_map[$key];
            switch( $data_type ){
              case 'image':
                if( is_numeric( $meta ) ){
                  $fullsize_url = wp_get_attachment_url( $meta );
                  $value = '<a href="' . $fullsize_url . '" target="_blank">' . wp_get_attachment_image( $meta, 'medium', false, [ 'class' => $field ] ) . '</a>';
                }
                break;

              default:
                $value = $meta;
            }
          }
      }
      $rows[$x][$columns[$key]] = $value;
    }
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