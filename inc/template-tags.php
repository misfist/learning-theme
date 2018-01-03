<?php
/**
 * Template Tag Functions
 * @package WordPress
 * @subpackage learning
 */

/**
 * Content Authors
 *
 * @return void
 */
function learning_get_authors() {
 if ( function_exists( 'coauthors_posts_links' ) ) {
     coauthors_posts_links();
 } else {
     the_author_posts_link();
 }
}

/**
 * Meta Content
 *
 * @return void
 */
function learning_entry_meta() {

  echo '<ul>';
  // sticky post ------------->
  if ( is_sticky() && is_home() && ! is_paged() ) {
      echo '<li class="sticky-post"><i class="fa fa-bookmark"></i>' . esc_html__( 'Featured', 'learning' ) . '</li>';
  }

  // post format ------------->
  $format = get_post_format();
  $formats_class = array(
    'aside'=>'file-text',
    'image'=>'image',
    'video'=>'video-camera',
    'quote'=>'quote-left',
    'link'=>'link',
    'gallery'=>'image',
    'status'=>'thumb-tack',
    'audio'=>'music',
    'chat'=>'commenting-o',
  );

  if ( current_theme_supports( 'post-formats', $format ) ) {
      echo '<li class="entry-format '.esc_attr( $format ).'">
		<i class="fa fa-'.esc_attr( $formats_class[$format] ).'"></i>
		<span class="screen-reader-text">'.esc_html__( 'Format:', 'learning' ) .'</span>
		<a href="'.esc_url( get_post_format_link( $format ) ).'" title="'.esc_attr( $format ).' post">' . esc_html( get_post_format_string( $format ) ).'</a></li>';
  }

  // Time ------------->
  // echo '<li class="posted-on">
	// 		<i class="fa fa-calendar"></i>
	// 		<span class="screen-reader-text">'.esc_html__('Posted on:', 'learning').'</span>
	// 		<a href="'.esc_url(get_permalink()).'" rel="bookmark">
	// 			<time class="entry-date published dt-published" itemprop="datePublished" datetime="'.esc_attr( get_the_date( 'c' ) ).'">'.get_the_date().'</time>
	// 			<time class="entry-date updated dt-updated screen-reader-text" itemprop="dateModified" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'. esc_html( get_the_modified_date() ).'</time>
	// 		</a>
	// 	</li>';

if( !is_single() ) {

  if( function_exists( 'coauthors_posts_links' ) ) {

    echo '<li class="byline author p-author vcard hcard h-card" itemprop="author " itemscope itemtype="http://schema.org/Person">
  			<i class="fa fa-user"></i> ' .
  			coauthors_posts_links( null, null, null, null, false )
  		. '</li>';

  } else {

    echo '<li class="byline author p-author vcard hcard h-card" itemprop="author " itemscope itemtype="http://schema.org/Person">
  			<i class="fa fa-user"></i>
  			<span class="screen-reader-text">'. esc_html__( 'Author:', 'learning' ).'</span>
  			<span class="screen-reader-text">'.get_avatar( get_the_author_meta( 'ID' ), 40 ).'</span>
  			<a class="url u-url" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author" itemprop="url" ><span  class=" fn p-name" itemprop="name">'.esc_html( get_the_author() ).'</span></a>
  		</li>';
    }

  }

  // series ---->
  if ( $series_list = get_the_term_list( get_the_id(), 'series', '', ', ' ) ) {
      echo '<li class="tag-links">
      <i class="fa fa-video-camera"></i>
      <span class="screen-reader-text">'. esc_html__( 'Series:', 'learning' ).'</span>
      '.ent2ncr( $series_list ).'
    </li>';
  }

  // categories ---->
  if ( ( $categories_list = get_the_category_list( ', ') ) && wordstar_categorized_blog() ) {
      echo '<li class="cat-links">
			<i class="fa fa-folder-open"></i>
			<span class="screen-reader-text">'. esc_html__( 'Categories:', 'learning' ).'</span>
			'.ent2ncr($categories_list).'
		</li>';
  }

  // tags ---->
  if ( $tags_list = get_the_tag_list( '', ', ' ) ) {
      echo '<li class="tag-links">
			<i class="fa fa-tags"></i>
			<span class="screen-reader-text">'. esc_html__( 'Tags:', 'learning' ).'</span>
			'.ent2ncr( $tags_list ).'
		</li>';
  }

  // attachemnt ---->
  if ( is_attachment() && wp_attachment_is_image() ) {
      // Retrieve attachment metadata.
      $metadata = wp_get_attachment_metadata();
      echo '<li class="full-size-link">
			<i class="fa fa-link"></i>
			<span class="screen-reader-text">'.esc_html__( 'Full size link:', 'learning' ).'</span>
			<a href="'.esc_url( wp_get_attachment_url() ).'">'.esc_html( $metadata['width'] ).' &times; '.esc_html( $metadata['height'] ).'</a>
		</li>';
  }

  // Comments ---->
  if (! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
      echo '<li class="comment">
			<i class="fa fa-comments"></i>';
      comments_popup_link( __( 'Leave a comment', 'learning' ).'<span class="screen-reader-text">:&nbsp;'. get_the_title() .'</span>' );
      echo '</li>';
  }

  // Edit Link ---->
  edit_post_link( __( 'Edit', 'learning' ), '<li class="edit-link"><i class="fa fa-pencil"></i>', '</li>' );
  echo '<div class="clear"></div></ul>';
}

/**
 * Display Coauthor with Link
 *
 * @uses get_coauthor_by()
 *
 * @param mixed (int | string) $term
 * @return void
 */
function learning_get_series_coauthors( $term ) {

  if ( class_exists( 'CoAuthors_Plus' ) ) {

    global $coauthors_plus;

    $authors = get_term_meta( $term->term_id, 'authors', true );

    if( !empty( $authors ) && !is_wp_error( $authors ) ) {

      $max = count( $authors );
      $count = 1;

      foreach( $authors as $author ) {

        $author = (int) $author;

        $coauthor = $coauthors_plus->get_coauthor_by( 'id', $author );

        echo coauthors_posts_links_single( $coauthor );

        if( $max === $count + 1 ) {
          echo ' and ';
        } elseif( $max > $count ) {
          echo ', ';
        }

        $count++;

      }

    }

  }

}

/**
 * Display Coauthors Box by Post
 *
 * @uses $coauthors_plus->get_coauthor_by()
 *
 * @param  obj $post
 * @return void
 */
function learning_coauthors_box_by_post( $post = null ) {
  if( !function_exists( 'get_coauthors' ) ) {
    return;
  }

  $post = ( !empty( $post ) ) ? $post->ID : get_the_id();

  $authors = get_coauthors( $post );

  foreach( $authors as $author ) :

    ob_start(); ?>

    <div class="author-info">
      <div class="author-avatar">
          <?php echo coauthors_get_avatar( $author, 'thumbnail' ); ?>
      </div>
      <div class="author-description">
        <h1 class="author-title">
          <?php echo coauthors_posts_links_single( $author ); ?>
        </h1>
        <?php if( $author->description ) : ?>
          <div class="author-bio">
            <?php echo apply_filters( 'the_content', $author->description ); ?>
          </div>
        <?php endif; ?>

        <div class = "author-metas">
          <?php if( $term = wp_get_post_terms( $author->ID, 'author' ) ) : ?>

            <a href="<?php echo esc_url( get_author_posts_url( $author->ID, $author->user_nicename ) ); ?>" title="<?php esc_attr_e( $term[0]->count ); ?> <?php esc_attr_e( 'Posts', 'learning' ) ?>" class="posts"><i class="fa fa-thumb-tack"></i> <span><?php esc_html_e( $term[0]->count ); ?></span></a>

            <a href="<?php echo esc_url( trailingslashit( get_author_posts_url( $author->ID, $author->user_nicename ) . 'feed/' ) ); ?>" rel="noopener"  title="<?php esc_attr_e( 'Subscribe RSS Feed', 'learning' ) ?>" target="_blank" class="social rss"><i class = "fa fa-rss"></i> <span><?php esc_html_e( 'RSS Feed', 'learning' ) ?></span></a>

            <?php if( $website = $author->website ) : ?>
                <a href="<?php echo esc_url( $website ); ?>" rel="noopener" target="_blank" class="social web" title="<?php esc_attr_e( 'Author\'s Website', 'learning' ); ?>"><i class = "fa fa-globe"></i> <span><?php esc_html_e( 'Website', 'learning' ); ?></span></a>
            <?php endif; ?>

          <?php endif; ?>
        </div>

      </div>

      <div class="clear"></div>

    </div>
    <h3 class="page-title screen-reader-text"><?php echo esc_html( $author->display_name );?>
      <?php esc_html_e( '\'s Series', 'learning' );?>
    </h3>

    <?php
    $content = ob_get_clean();

    echo $content;

  endforeach;

}

/**
 * Display Coauthors Box by Term
 *
 * @uses $coauthors_plus->get_coauthor_by()
 *
 * @param obj $term
 * @return void
 */
function learning_coauthors_box_by_term( $term ) {

  if ( !class_exists( 'CoAuthors_Plus' ) ) {
    return;
  }

  global $coauthors_plus;

  $authors = get_term_meta( $term->term_id, 'authors', true );

  if( !empty( $authors ) && !is_wp_error( $authors ) ) {

    foreach( $authors as $author ) {

      $author = (int) $author;
      $author = $coauthors_plus->get_coauthor_by( 'id', $author );

      ob_start(); ?>

      <div class="author-info">
        <div class="author-avatar">
          <?php if( has_post_thumbnail( $author->ID ) ) : ?>
            <?php $image_id = get_post_thumbnail_id( $author->ID ); ?>
            <?php $image_source = wp_get_attachment_image_src( $image_id ); ?>
            <img src="<?php echo esc_url( $image_source[0] ); ?>" alt="<?php esc_attr_e( $author->display_name ); ?>" />
          <?php endif; ?>
        </div>
        <div class="author-description">
          <h1 class="author-title">
            <?php echo coauthors_posts_links_single( $author ); ?>
          </h1>
          <?php if( $author->description ) : ?>
            <div class="author-bio">
              <?php echo apply_filters( 'the_excerpt', $author->description ); ?>
            </div>
          <?php endif; ?>

          <div class = "author-metas">
            <?php if( $term = wp_get_post_terms( $author->ID, 'author' ) ) : ?>

              <a href="<?php echo esc_url( get_author_posts_url( $author->ID, $author->user_nicename ) ); ?>" title="<?php esc_attr_e( $term[0]->count ); ?> <?php esc_attr_e( 'Posts', 'learning' ) ?>" class="posts"><i class="fa fa-thumb-tack"></i> <span><?php esc_html_e( $term[0]->count ); ?></span></a>

              <a href="<?php echo esc_url( trailingslashit( get_author_posts_url( $author->ID, $author->user_nicename ) . 'feed/' ) ); ?>" rel="noopener"  title="<?php esc_attr_e( 'Subscribe RSS Feed', 'learning' ) ?>" target="_blank" class="social rss"><i class = "fa fa-rss"></i> <span><?php esc_html_e( 'RSS Feed', 'learning' ) ?></span></a>

              <?php if( $website = $author->website ) : ?>
                  <a href="<?php echo esc_url( $website ); ?>" rel="noopener" target="_blank" class="social web" title="<?php esc_attr_e( 'Author\'s Website', 'learning' ); ?>"><i class = "fa fa-globe"></i> <span><?php esc_html_e( 'Website', 'learning' ); ?></span></a>
              <?php endif; ?>

            <?php endif; ?>
          </div>

        </div>

        <div class="clear"></div>

      </div>
      <h3 class="page-title screen-reader-text"><?php echo esc_html( $author->display_name );?>
        <?php esc_html_e( '\'s Series', 'learning' );?>
      </h3>

      <?php
      $content = ob_get_clean();

      echo $content;


    }

  }

}
