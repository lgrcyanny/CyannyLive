<?php

if ( ! isset( $content_width ) ) $content_width = 580;

add_action( 'after_setup_theme', 'cleanr_setup' );

if ( ! function_exists( 'cleanr_setup' ) ):

function cleanr_setup() {
	
	// Load up our theme options page and related code.
	require( get_template_directory() . '/lib/theme-options/config.php' );
	require( get_template_directory() . '/lib/theme-options/inc/actions.php' );
	require( get_template_directory() . '/lib/scripts.php' );
	
	// Custom Header
	$args = array(
		'width' => apply_filters( 'twentyeleven_header_image_width', 940 ),
		'height' => apply_filters( 'twentyeleven_header_image_height', 250 ),
		'flex-height' => true,
		'header-text'            => false,
	);
	add_theme_support( 'custom-header', $args );
	
	
	// Custom Background
	add_theme_support( 'custom-background' );
	
	// Feed
	add_theme_support( 'automatic-feed-links' );
	
	// Thumbs
	add_theme_support( 'post-thumbnails' );
	
	add_editor_style();
	
	//set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'featured', 580, 200, true );

	// updating thumbnail and image sizes
	update_option( 'thumbnail_size_w', 150, true );
	update_option( 'thumbnail_size_h', 150, true );
	update_option( 'medium_size_w', 580, true );
	update_option( 'medium_size_h', '', true );
	update_option( 'large_size_w', 940, true );
	update_option( 'large_size_h', '', true ); 
	
	// WP 3.0 nav menu
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cleanr' ),
	) );	
	
} // end cleanr_setup

endif;

// no title fallback
add_filter( 'the_title', 'cleanr_title' );

function cleanr_title( $title ) {
	if ( $title == '' ) {
		return 'Untitled';
	} else {
		return $title;
	}
}

if (function_exists('register_sidebar'))
    register_sidebar();


function cleanr_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    
     <div id="comment-<?php comment_ID(); ?>">
     <div class="commenthead">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='36',$default='<path_to_url>' ); ?>

         <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
      </div>
      

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'cleanr'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'cleanr'),'  ','') ?>
     
     <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('...awaiting moderation', 'cleanr') ?></em>
         <br />
      <?php endif; ?>
      </div>
      <div class="clear"></div>
     
     </div>
     

	<div class="commentbody">
      <?php comment_text(); ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
      </div>
     </div>
     </div>
<?php }