<?php
/**
 * Search Header
 * @package WordPress
 * @subpackage learning
 */
?>
<div class="author-info">
  <div class="author-avatar"> <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'linesh_author_bio_avatar_size',100 ) );?> </div>
  <div class="author-description">
    <h1 class="author-title entry-title"><?php echo esc_html( get_the_author_meta( 'display_name' ) );?></h1>
    <?php if( $description = get_the_author_meta( 'description' ) ) : ?>
      <div class="author-bio">
        <?php echo apply_filters( 'the_excerpt', $description ); ?>
      </div>
    <?php endif; ?>
    <?php wordstar_author_metas( get_the_author_meta('ID') ); ?>
  </div>
  <div class="clear"></div>
</div>
<h3 class="page-title screen-reader-text"><?php echo esc_html( get_the_author_meta( 'display_name' ) );?>
  <?php esc_html_e( '\'s Series', 'learning' );?>
</h3>
