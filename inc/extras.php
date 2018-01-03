<?php
/**
 * Theme Functions
 * @package WordPress
 * @subpackage learning
 */

/**
 * Filter Ordering of Series Posts
 * 
 * @param  obj $query
 * @return void
 */
function learning_pre_get_post_series( $query ) {
  if( $query->is_admin() || ! $query->is_main_query() ) {
    return;
  }

  if( $query->is_tax( 'series' ) ) {
    $query->set( 'orderby', 'title' );
    $query->set( 'order', 'ASC' );
  }
}
add_action( 'pre_get_posts', 'learning_pre_get_post_series' );

foreach ( array( 'pre_term_description' ) as $filter ) {
remove_filter( $filter, 'wp_filter_kses' );
}

foreach ( array( 'term_description' ) as $filter ) {
remove_filter( $filter, 'wp_kses_data' );
}
