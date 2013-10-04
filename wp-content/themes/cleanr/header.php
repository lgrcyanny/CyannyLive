<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'cleanr' ), max( $paged, $page ) );

	?></title>

<!--[if IE]><link type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" rel="stylesheet" media="all" /><![endif]-->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript">
	// Cyanny fix the bug for read more link
	$j = jQuery.noConflict();
	$j(document).ready(function() {
	    var brchildren = $j("div.entry a[title='Read more...']").siblings(':nth-last-child(2)').children();
	    for (var i = brchildren.length - 1; i >= 5; i--) {
	    	brchildren[i].remove();
	    }
	});
</script>
<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<?php $theme_options = get_option( 'cleanr_options' ); ?>


<div class="container_16">

	<div id="header" class="grid_16">
		<h1 class="site-title">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php if( isset( $theme_options['logo'] ) && '' != $theme_options['logo'] ) : ?>
			  	<img class="sitetitle" src="<?php echo esc_url( $theme_options['logo'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
			<?php else : ?><?php bloginfo( 'name' ); ?><?php endif; ?></a>
		<span class="site-description"><?php bloginfo('description'); ?></span></h1>	
	
		<nav id="access">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav>
	</div>	
	
	<?php $header_image = get_header_image();
		if($header_image != ''): ?>
		
		<a href="<?php echo home_url(); ?>" class="headerimage grid_16">
			<img src ="<?php echo $header_image; ?>" width="<?php ?>" height="<?php ?>" />
		</a>
		
	<?php else : ?>
	
		<hr class="grid_16" />
		
	<?php endif; ?>			

	