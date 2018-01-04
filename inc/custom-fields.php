<?php
/**
 * Custom Field Functions
 *
 * @todo Move to a core functionality plugin.
 *
 * @package WordPress
 * @subpackage learning
 */

/**
 * Register Custom Fields
 *
 * @since 0.1.0
 *
 * @uses acf_add_local_field_group()
 *
 * @return void
 */
if( function_exists( 'acf_add_local_field_group' ) ) {

  acf_add_local_field_group( array(
   'key' => 'group_series',
   'title' => __( 'Series', 'learning' ),
   'fields' => array(
     array(
       'key' => 'field_authors',
       'label' => __( 'Authors', 'learning' ),
       'name' => 'authors',
       'type' => 'post_object',
       'instructions' => '',
       'required' => 0,
       'conditional_logic' => 0,
       'wrapper' => array(
         'width' => '',
         'class' => '',
         'id' => '',
       ),
       'post_type' => array(
         0 => 'guest-author',
       ),
       'taxonomy' => array(
       ),
       'allow_null' => 0,
       'multiple' => 1,
       'return_format' => 'id',
       'ui' => 1,
     ),
     array(
       'key' => 'field_category',
       'label' => __( 'Category', 'learning' ),
       'name' => 'category',
       'type' => 'taxonomy',
       'instructions' => '',
       'required' => 0,
       'conditional_logic' => 0,
       'wrapper' => array(
         'width' => '',
         'class' => '',
         'id' => '',
       ),
       'taxonomy' => 'category',
       'field_type' => 'select',
       'allow_null' => 0,
       'add_term' => 1,
       'save_terms' => 1,
       'load_terms' => 1,
       'return_format' => 'object',
       'multiple' => 0,
     ),
     array(
       'key' => 'field_tags',
       'label' => __( 'Tags', 'learning' ),
       'name' => 'tags',
       'type' => 'taxonomy',
       'instructions' => '',
       'required' => 0,
       'conditional_logic' => 0,
       'wrapper' => array(
         'width' => '',
         'class' => '',
         'id' => '',
       ),
       'taxonomy' => 'post_tag',
       'field_type' => 'multi_select',
       'allow_null' => 0,
       'add_term' => 1,
       'save_terms' => 1,
       'load_terms' => 1,
       'return_format' => 'object',
       'multiple' => 0,
     ),
   ),
   'location' => array(
     array(
       array(
         'param' => 'taxonomy',
         'operator' => '==',
         'value' => 'series',
       ),
     ),
   ),
   'menu_order' => 0,
   'position' => 'normal',
   'style' => 'default',
   'label_placement' => 'top',
   'instruction_placement' => 'label',
   'hide_on_screen' => '',
   'active' => 1,
   'description' => '',
  ));

}
