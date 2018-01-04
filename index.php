<?php
/**
 * Main index file
 *
 * @package WordPress
 * @subpackage learning
 **/
 get_header();
?>
<main id="main" class="site-main content-area archives" role="main">
  <?php if ( have_posts() ) : ?>

    <?php if( !is_home() && !is_front_page() ) : ?>

      <header class="page-header">

      <?php if( is_search() ) : ?>

        <h1 class="page-title">
          <?php
    			 /* translators: %s: Search query */
    			 printf( esc_html__( 'Searching for: "%s"', 'learning' ), get_search_query() );?>
        </h1>

      <?php else : ?>

        <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
        <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

      <?php endif; ?>

      </header>

    <?php else : ?>

      <?php $terms = get_terms(
        array(
          'taxonomy' => 'series',
          'orderby' => 'name'
        )
      ); ?>

      <?php if( !empty( $terms ) && !is_wp_error( $terms ) ) : ?>

        <?php foreach( $terms as $series ) : ?>

          <article id="series-<?php esc_attr_e( $series->term_id ); ?>" <?php post_class( 'post-content' ); ?> <?php echo esc_html( wordstar_semantics( 'post' ) ); ?>>

            <?php if( $image_id = get_term_meta( $series->term_id, 'image', true ) ) : ?>

              <?php $image_data = wp_get_attachment_image_src( $image_id, 'thumbnail' ); ?>
              <?php $image = $image_data[0]; ?>

              <?php if( !empty( $image ) ) : ?>
                <div class="post-thumbnail entry-media">
                  <a class="" href="<?php echo esc_url( get_term_link( $series ) ); ?>" aria-hidden="true">
                    <img src="<?php echo esc_url( $image ); ?>" class="photo u-photo wp-post-image" itemprop="image" srcset="<?php echo esc_url( $image ); ?>" />
                  </a>
                </div>
              <?php endif; ?>

            <?php endif; ?>

            <header class="entry-header" itemprop="mainEntityOfPage">

              <h2 class="entry-title p-name" itemprop="name headline"><a href="<?php echo esc_url( get_term_link( $series ) ); ?>" rel="bookmark" class="u-url url" itemprop="url"><?php esc_attr_e( $series->name, 'learning' ) ?></a></h2>

            </header>

            <div class="entry-summary  p-summary" itemprop="description">
              <?php echo apply_filters( 'the_content', $series->description ); ?>
            </div>

            <div class="entry-meta">
              <ul>
                <li class="byline author p-author vcard hcard h-card" itemprop="author " itemscope="" itemtype="http://schema.org/Person">
            			<i class="fa fa-user"></i>
                  <?php learning_get_series_coauthors( $series ); ?>
                </li>
                <div class="clear"></div>
              </ul>
            </div>

          </article>

        <?php endforeach; ?>

      <?php endif; ?>

      <?php //not home ?>
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

  <?php else : ?>

    <?php //no content ?>
    <?php get_template_part( 'content', 'none' ); ?>

  <?php endif; ?>

  <div class="clear"></div>
</main>
<?php get_sidebar();?>
<?php get_footer(); ?>
