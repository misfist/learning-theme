<?php
/**
 * Archive file
 *
 * @package WordPress
 * @subpackage learning
 **/
 get_header();
?>
<?php $term = get_queried_object(); ?>
<main id="main" class="site-main content-area archives" role="main">

  <?php if ( have_posts() ) : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry post-content' ); ?> <?php echo esc_html( wordstar_semantics( 'post' ) ); ?> itemref="site-publisher">

    <?php if( $image_id = get_term_meta( $term->term_id, 'image', true ) ) : ?>
      <?php $image_data = wp_get_attachment_image_src( $image_id, 'wordstar-post-big' ); ?>
      <?php $image = $image_data[0]; ?>

      <?php if( !empty( $image ) ) : ?>
        <div class="post-thumbnail entry-media">
          <a class="" href="<?php echo esc_url( get_term_link( $term ) ); ?>" aria-hidden="true">
            <img src="<?php echo esc_url( $image ); ?>" class="photo u-photo wp-post-image" itemprop="image" srcset="<?php echo esc_url( $image ); ?>">
          </a>
        </div>
      <?php endif; ?>

    <?php endif; ?>

    <header class="page-header" itemprop="mainEntityOfPage">

			<?php
				the_archive_title( '<h1 class="page-title p-name" itemprop="name headline">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description p-summary">', '</div>' );
			?>

		</header><!-- .page-header -->

    <div class="clear"></div>

    <div class="author-info author p-author vcard hcard h-card" itemprop="author" itemscope itemtype="http://schema.org/Person">
      <?php learning_coauthors_box_by_term( $term ); ?>
    </div>

  </article>

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
