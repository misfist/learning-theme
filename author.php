<?php
/**
 * Content loop file
 * @package WordPress
 * @subpackage learning
 */

 get_header();
?>
<main id="main" class="site-main content-area archives" role="main">
  <?php if ( have_posts() ) : ?>

    <header class="page-header">

      <?php get_template_part( 'template-parts/content', 'author' ); ?>

    </header>

    <?php while( have_posts() ) : the_post();?>

      <?php get_template_part( 'content' ); ?>

    <?php endwhile; ?>

    <?php // Pagination
  	the_posts_pagination( array(
  		'mid_size' => 5,
  		'prev_text'          => esc_html__( 'Previous page', 'learning' ),
  		'next_text'          => esc_html__( 'Next page', 'learning' ),
  		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page:', 'learning' ) . ' </span>',
  		'screen_reader_text' =>  esc_html__( 'Pagination', 'learning' )
  	) ); ?>

  <?php else : ?>

    <?php get_template_part( 'content', 'none' ); ?>

  <?php endif; ?>

  <div class="clear"></div>
</main>
<?php get_sidebar();?>
<?php get_footer(); ?>
