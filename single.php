<?php
/**
 * Single Post file
 *
 * @package WordPress
 * @subpackage learning
 **/
?>
<?php get_header(); ?>
<main id="main" class="site-main  single-post" role="main">
  <?php while ( have_posts() ) : the_post();?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?> <?php echo esc_html( wordstar_semantics( 'post' ) ); ?> itemref="site-publisher">
    <header class="entry-header">
      <?php the_title( sprintf( '<h1 class="entry-title p-name" itemprop="name headline"><a href="%s" rel="bookmark" class="u-url url" itemprop="url">', esc_url( get_permalink() ) ), '</a></h1>' );?>
    </header>

    <?php if( in_array( get_post_format(), array( 'aside','standard','' ) ) ) : ?>
      <?php  wordstar_post_thumbnail( 'wordstar-post-big' ); ?>
    <?php endif; ?>

    <div class="entry-meta">
      <?php learning_entry_meta(); ?>
    </div>
    <div class="entry-content e-content" itemprop="description articleBody">
      <?php
          /* translators: %s: Name of current post */
          the_content(sprintf(__('Continue reading %s', 'learning'), the_title('<span class="screen-reader-text">', '</span>', false)));
          wp_link_pages(
              array(
              'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'learning') . '</span>',
              'after'       => '</div>',
              'link_before' => '<span>',
              'link_after'  => '</span>',
              'pagelink'    => '<span class="screen-reader-text">' . __('Page:', 'learning') . ' </span>%',
              'separator'   => '<span class="screen-reader-text">, </span>',
              )
          );
      ?>
      <div class="clear"></div>
    </div>
    <?php if( is_singular('attachment') ) : ?>
      <?php // Parent post navigation.
      the_post_navigation(
          array(
          'prev_text' =>'<span class="meta-nav">'.__('Published in', 'learning').'</span><span class="post-title">%title</span>',
          )
      ); ?>
    <?php elseif( is_singular('post') ) : ?>
      <?php // Previous/next post navigation.
      the_post_navigation(
          array(
          'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next', 'learning') . '</span> ' .
          '<span class="screen-reader-text">' . __('Next post:', 'learning') . '</span> ' .
          '<span class="post-title">%title</span>',
          'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous', 'learning') . '</span> ' .
          '<span class="screen-reader-text">' . __('Previous post:', 'learning') . '</span> ' .
          '<span class="post-title">%title</span>',
          )
      ); ?>
    <?php endif; ?>

    <div class="clear"></div>

    <div class="author-info byline author p-author vcard hcard h-card" itemprop="author " itemscope itemtype="http://schema.org/Person">

      <?php learning_coauthors_box_by_post(); ?>

      <div class="clear"></div>
    </div>
  </article>
  <?php	endwhile; ?>
   <?php if (comments_open() || get_comments_number() ) {comments_template();}?>

</main>
<?php get_sidebar();?>
<?php get_footer(); ?>
