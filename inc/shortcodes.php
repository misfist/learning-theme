<?php
/**
 * Shortcodes Functions
 * @package WordPress
 * @subpackage learning
 */

/**
 * Add Author Bio Shortcode for Term
 *
 * @uses learning_coauthors_box_by_term()
 * @return void
 */
function learning_term_author_bio_shortcode() {

	$term = get_queried_object();

	if( !empty( $term ) && !is_wp_error( $term ) ) {
    ob_start();

    learning_coauthors_box_by_term( $term );

    $output = ob_get_contents();
    return $output;
	}

}
add_shortcode( 'term-author-bio', 'learning_term_author_bio_shortcode' );

/**
 * Add Author Bio Shortcode for Post
 *
 * @uses learning_coauthors_box_by_post()
 * @return void
 */
function learning_post_author_bio_shortcode() {
  ob_start();

  learning_coauthors_box_by_post();

  $output = ob_get_contents();
  return $output;
}
add_shortcode( 'post-author-bio', 'learning_post_author_bio_shortcode' );
