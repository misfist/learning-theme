<?php
/**
 * Archive file
 *
 * @package WordPress
 * @subpackage learning
 **/
 get_header();
?>
<main id="main" class="site-main content-area archives" role="main">

  <?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>

      <div class="clear"></div>

      <?php $term = get_queried_object(); ?>

      <div class="author-info author p-author vcard hcard h-card" itemprop="author" itemscope itemtype="http://schema.org/Person">
        <?php learning_coauthors_box_by_term( $term ); ?>
      </div>





		</header><!-- .page-header -->

    <?php while( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content'); ?>

    <?php endwhile; ?>

    <?php the_posts_pagination( array(
          'mid_size' => 5,
          'prev_text'          => esc_html__( 'Previous page', 'learning' ),
          'next_text'          => esc_html__( 'Next page', 'learning' ),
          'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page:', 'learning' ) . ' </span>',
          'screen_reader_text' =>  esc_html__( 'Pagination', 'learning' )
    ) ); ?>

	<?php endif; ?>

  <div class="clear"></div>

</main>
<?php get_sidebar();?>
<?php get_footer(); ?>
