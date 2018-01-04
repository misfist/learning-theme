<?php
/**
 * Template Name: Series Listing
 * Series Listing Page Template
 * @package WordPress
 * @subpackage learning
 */
 get_header();
?>
<main id="main" class="site-main content-area archives" role="main">
  <?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/content','page-series' ); ?>

	<?php endwhile; ?>

  <div class="clear"></div>

  <?php $terms = get_terms(
    array(
      'taxonomy'  => 'series',
      'orderby'   => 'name'
    )
  ); ?>

  <div class="series-terms">

    <?php if( !empty( $terms ) && !is_wp_error( $terms ) ) : ?>

      <?php foreach( $terms as $series ) : ?>

        <article id="series-<?php echo $series->term_id; ?>" <?php post_class( 'post-content' ); ?> <?php echo esc_html( wordstar_semantics( 'post' ) ); ?>>
          <?php if( $image_id = get_term_meta( $series->term_id, 'image', true ) ) : ?>
            <?php $image_data = wp_get_attachment_image_src( $image_id, 'wordstar-post-big' ); ?>
            <?php $image = $image_data[0]; ?>

            <?php if( !empty( $image ) ) : ?>
              <div class="post-thumbnail entry-media">
                <a class="" href="<?php echo esc_url( get_term_link( $series ) ); ?>" aria-hidden="true">
                  <img src="<?php echo esc_url( $image ); ?>" class="photo u-photo wp-post-image" itemprop="image" srcset="<?php echo esc_url( $image ); ?>">
                </a>
              </div>
            <?php endif; ?>

          <?php endif; ?>

          <header class="entry-header" itemprop="mainEntityOfPage">
            <h2 class="entry-title p-name" itemprop="name headline"><a href="<?php echo esc_url( get_term_link( $series ) ); ?>"><?php esc_html_e( $series->name, 'learning' ); ?></a></h2>
          </header>

          <div class="entry-summary  p-summary" itemprop="description">
            <?php echo apply_filters( 'the_content', $series->description ); ?>
          </div>

          <div class="entry-meta">
            <?php learning_series_meta( $series ); ?>
            <div class="clear"></div>
          </div>
        </article>

      <?php endforeach; ?>

    <?php endif; ?>

  </div>

</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
