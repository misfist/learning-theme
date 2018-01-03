<?php
/**
 * Content Loop file
 *
 * @package WordPress
 * @subpackage learning
 **/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(' post-content'); ?> <?php echo esc_html( wordstar_semantics( 'post' ) ); ?>>

  <?php if( in_array( get_post_format(), array( 'aside','standard','' ) ) ) : ?>
    <?php wordstar_post_thumbnail( 'wordstar-post-big' ); ?>
  <?php endif; ?>

  <header class="entry-header" itemprop="mainEntityOfPage">
    <?php the_title( sprintf( '<h2 class="entry-title p-name" itemprop="name headline"><a href="%s" rel="bookmark" class="u-url url" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' );?>
  </header>

  <?php if( in_array( get_post_format(), array( 'aside','standard','' ) ) ) : ?>

    <div class="entry-summary  p-summary" itemprop="description">
      <?php the_excerpt(); ?>
    </div>

  <?php else : ?>

    <div class="entry-content e-content" itemprop="description articleBody">
      <?php
      /* translators: %s: Name of current post */
      the_content( sprintf( __( 'Continue Reading %s', 'learning' ), the_title( '<span class="screen-reader-text">', '</span>', false ) ) );
      wp_link_pages(
        array(
            'before'      => '<div class="page-links"><span class="page-links-title">'.__('Pages:', 'learning') . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">'. __('Page:', 'learning') . ' </span>%',
            'separator'   => '<span class="screen-reader-text">, </span>',
        )
      );
      ?>
      <div class="clear"></div>
    </div>

  <?php endif; ?>

  <div class="entry-meta">
    <?php learning_entry_meta(); ?>
  </div>
</article>
