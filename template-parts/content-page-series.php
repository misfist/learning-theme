<?php
/**
 * Series Listing Content Template
 * @package WordPress
 * @subpackage learning
 */
?>
<header class="page-header">
  <?php the_title('<h1 class="entry-title p-name" itemprop="name headline">', '</h1>');?>
</header>

<div class="entry-content e-content" itemprop="description text">
  <?php
      /* translators: %s: Name of current post */
      the_content( sprintf( __( 'Continue reading %s', 'learning' ), the_title( '<span class="screen-reader-text">', '</span>', false ) ) );

      wp_link_pages(
          array(
          'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'learning' ) . '</span>',
          'after'       => '</div>',
          'link_before' => '<span>',
          'link_after'  => '</span>',
          'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'learning' ) . ' </span>%',
          'separator'   => '<span class="screen-reader-text">, </span>',
          )
      );
  ?>
  <div class="clear"></div>
</div>
