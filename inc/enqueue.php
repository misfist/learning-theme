<?php
/**
 * Enqueue Child Theme Styles
 * @package WordPress
 * @subpackage learning
 */

add_action( 'wp_enqueue_scripts', 'learning_theme_enqueue_styles' );

function learning_theme_enqueue_styles() {
    wp_enqueue_style( 'wordstar-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    wp_enqueue_style( 'learning-style',
        trailingslashit( get_stylesheet_directory_uri() ) . 'style.css',
        array( 'wordstar-style' )
    );

}
