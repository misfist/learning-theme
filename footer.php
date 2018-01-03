<?php
 /**
  * Content footer file
  * @package WordPress
  * @subpackage learning
  */
?>

<div class="clear"></div>
</div>
<footer id="colophon" class="site-footer" role="contentinfo">
  <div id="site-publisher" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
    <meta itemprop="name" content="<?php bloginfo( 'name' );?>" />
    <meta itemprop="url" content="<?php echo esc_url( home_url( '/' )) ; ?>" />

    <?php if ( has_custom_logo() ) : ?>
			<?php $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) ); ?>
      <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
        <meta itemprop="url" content="<?php echo esc_url( $image[0] ); ?>" />
        <meta itemprop="width" content="<?php echo esc_attr( $image[1] ); ?>" />
        <meta itemprop="height" content="<?php echo esc_attr( $image[2] ); ?>" />
      </div>
    <?php endif; ?>

  </div>
  <div class="site-info wrapper">
    <?php
    if ( has_nav_menu( 'footer' ) ) {
         wp_nav_menu(
             array(
             'theme_location' => 'footer',
             'container' => false,
             'menu_id' => 'footer-nav',
             'menu_name' => 'footer_nav',
             'menu_class' => 'footer-nav ',
             'link_before' => '<span>',
             'link_after' => '</span>',
             'fallback_cb'=>false,
             'depth'=>1
             )
         );
    }?>
    <p id="site-generator" class="site-info centertext footer-copy">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">&copy; <?php echo esc_html( date( 'Y' ) );?>&nbsp;<?php bloginfo( 'name' ); ?>.</a>
    <a href="<?php echo esc_url( 'https://wordpress.org' ); ?>" rel="generator"><?php esc_html_e( 'Proudly powered by WordPress', 'learning' ); ?>.</a>
    </p>
  </div>
</footer>
</div>
<?php wp_footer(); ?>
</body></html>
