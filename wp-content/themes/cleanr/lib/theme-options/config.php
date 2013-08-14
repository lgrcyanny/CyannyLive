<?php

/**
 * Config Theme Options class
 * @author Graph Paper Press
 * 
 */

// Require the main plugin class
if( !class_exists( 'ThemeOptions' ) ) {
	require_once( dirname(__FILE__) . '/inc/class-theme-options.php' );
}

// Call new class
$theme_options = new ThemeOptions;

// True for section tabs, false for no tabs
$theme_options->tabbed = true;

// Sections
$theme_options->sections['default'] = __( 'Default', 'cleanr' );


// Options
$theme_options->settings['logo'] = array(
			'section' => 'default',
			'title'   => __( 'Logo', 'Cyanny Live' ),
			'desc'    => __( 'Upload a logo in PNG or JPG format.', 'cleanr' ),
			'type'    => 'upload',
			'std'     => ''
		);

$theme_options->settings['favicon'] = array(
			'section' => 'default',
			'title'   => __( 'Favicon', 'BlogFavicon' ),
			'desc'    => __( 'Upload a favicon in PNG format sized to 16px by 16px.', 'cleanr' ),
			'type'    => 'upload',
			'std'     => ''
		);

$theme_options->settings['font'] = array(
			'section' => 'default',
			'title'   => __( 'Headline Font', 'cleanr' ),
			'desc'    => __( 'Select a font to use for your headlines.', 'cleanr' ),
			'type'    => 'select',
			'std'     => '',
			'choices' => cleanr_font_array()
		);

$theme_options->settings['font_alt'] = array(
			'section' => 'default',
			'title'   => __( 'Body Font', 'cleanr' ),
			'desc'    => __( 'Select a font to use for your paragraphs.', 'cleanr' ),
			'type'    => 'select',
			'std'     => '',
			'choices' => cleanr_font_array()
		);

/*
$theme_options->settings['color'] = array(
			'section' => 'default',
			'title'   => __( 'Color Scheme', 'cleanr' ),
			'desc'    => __( 'Choose a color scheme for your site.', 'cleanr' ),
			'type'    => 'select',
			'std'     => 'light',
			'choices' => array(
				'light' => 'Light',
				'dark' => 'Dark'
				)
		);
*/

$theme_options->settings['css'] = array(
			'section' => 'default',
			'title'   => __( 'Custom CSS', 'cleanr' ),
			'desc'    => __( 'Add some custom CSS to quickly change the design of your site.', 'cleanr' ),
			'type'    => 'textarea',
			'std'     => ''
		);

/**
 * Set theme options above to global theme settings
 * @since cleanr 1.0
 */
global $cleanr_settings;
$cleanr_settings = $theme_options->settings;


/**
 * Items that need to be ran during "theme activation".
 * @since cleanr 1.0
 */
add_action( 'load-themes.php', 'cleanr_theme_activation' );

function cleanr_theme_activation() {

	global $pagenow, $cleanr_settings;

	$cleanr_theme = new ThemeOptions;

	$new_version = $cleanr_theme->theme['version'];
	$version_var = 'cleanr_version';
	$version = get_option( $version_var );
	if ( $pagenow != 'themes.php' || ! isset( $_GET['activated'] ) )
		return;

    if ( $version ) {
		if( version_compare( $version, $new_version ) == 1 ) {
			return;
		}
	}

    update_option( $version_var, $new_version );

    $cleanr_theme->initializeSettings( $cleanr_settings );

}

/**
 * Integrates with the Theme Customizer in WP 3.4
 */
add_action( 'customize_register', 'cleanr_customize_register' );

function cleanr_customize_register( $wp_customize ) {	

	// get our theme options so we can use defaults below
	$options = get_option( 'cleanr_options' );

	// enables live change support
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';
	$wp_customize->get_setting('header_textcolor')->transport='postMessage';

	// add a setting to an existing theme option
	$wp_customize->add_setting( 'cleanr_options[logo]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
		'label'      => __( 'Upload Logo', 'cleanr' ),
		'section'    => 'title_tagline',
		'settings'   => 'cleanr_options[logo]'
	) ) );

	// add a setting to an existing theme option
	$wp_customize->add_setting( 'cleanr_options[color]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'transport'      => 'postMessage'
	) );

/*
	// intercept the theme option and control it
	$wp_customize->add_control( 'cleanr_color_customizer', array(
		'settings'		=> 'cleanr_options[color]',
		'label'			=> __( 'Select a color', 'cleanr' ),
		'section'		=> 'colors',
		'type'			=> 'select',
		'choices' => array(
				'light' => 'Light',
				'dark' => 'Dark'
				),
		'priority'		=> 5
	) );
*/

	// add customizer section
	$wp_customize->add_section( 'cleanr_fonts', array(
		'title'			=> __( 'Fonts', 'cleanr' ),
		'priority'		=> 45
	) );

	// add a setting to an existing theme option
	$wp_customize->add_setting( 'cleanr_options[font]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( 'cleanr_font_customizer', array(
		'settings'		=> 'cleanr_options[font]',
		'label'			=> __( 'Headline Font', 'cleanr' ),
		'section'		=> 'cleanr_fonts',
		'type'			=> 'select',
		'choices'		=> cleanr_font_array() // don't call all fonts on public themes. Choose a few.
	) );

	// add a setting to an existing theme option
	$wp_customize->add_setting( 'cleanr_options[font_alt]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( 'cleanr_font_alt_customizer', array(
		'settings'		=> 'cleanr_options[font_alt]',
		'label'			=> __( 'Body Font', 'cleanr' ),
		'section'		=> 'cleanr_fonts',
		'type'			=> 'select',
		'choices'		=> cleanr_font_array() // don't call all fonts on public themes. Choose a few.
	) );
	
	
	// extending the field type to textarea
	class cleanr_CSS_Control extends WP_Customize_Control {
		public $type = 'customarea';

		public function render_content() {
			$options = get_option( 'cleanr_options' );
			$stored = "";
			if( isset( $options['css'] ) ) { $stored = $options['css']; }
			echo '<textarea style="width:100%;height:200px;">' . $stored . '</textarea>';
		}
		public function enqueue() {
			wp_enqueue_script( 'customarea', get_template_directory_uri() . '/lib/theme-options/js/customarea.js', array( 'customize-controls' ), '20120607', true );
		}
	}


	// add customizer section
	$wp_customize->add_section( 'cleanr_css', array(
		'title'			=> __( 'Custom CSS', 'cleanr' ),
		'priority'		=> 60
	) );

	// add a setting to an existing theme option
	$wp_customize->add_setting( 'cleanr_options[css]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new cleanr_CSS_Control( $wp_customize, 'css', array(
		'settings'		=> 'cleanr_options[css]',
		'label'			=> __( 'Custom CSS', 'cleanr' ),
		'section'		=> 'cleanr_css'
	) ) );
	
	
	
	if ( $wp_customize->is_preview() && ! is_admin() )
		add_action( 'wp_footer', 'cleanr_customize_preview_js', 21 );
}


/**
	 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
	 * Used with fonts
	 *
	 */
	function cleanr_customize_preview_js() { ?>
		<?php
		$doc_ready_script = '
		<script type="text/javascript">
			(function($){
				$(document).ready(function() {

					wp.customize("blogname", function(value) {
						value.bind(function(to) {
							$(".site-title a").html(to);
						});
					});

					wp.customize("blogdescription", function(value) {
						value.bind(function(to) {
							$(".site-description").html(to);
						});
					});

					wp.customize( "header_textcolor", function( value ) {
						value.bind( function( to ) {
							$(".site-title a, .site-description").css("color", to ? to : "" );
						});
					});


					wp.customize("cleanr_options[logo]", function(value) {
						value.bind(function(to) {
							$(".site-title a").html("<img class=\"sitetitle\" alt=\"' . get_bloginfo( 'name' ) . '\" src=\"" + to + "\">" );
						});
					});

					wp.customize("cleanr_options[font]",function(value) {
						value.bind(function(to) {
							$("#fontdiv").remove();
							var googlefont = to.split(",");
							$("body").append("<div id=\"fontdiv\"><link href=\"http://fonts.googleapis.com/css?family="+googlefont[0]+"\" rel=\"stylesheet\" type=\"text/css\" /><style type=\"text/css\">	h1, h2, h3, h4, h5, h6, small, .postmetadata, .small, #header span, #access ul {font-family: "+googlefont[1]+"}</style></div>");

						});
					});

					wp.customize("cleanr_options[font_alt]",function(value) {
						value.bind(function(to) {
							$("#fontaltdiv").remove();
							var googlefont = to.split(",");
							$("body").append("<div id=\"fontaltdiv\"><link href=\"http://fonts.googleapis.com/css?family="+googlefont[0]+"\" rel=\"stylesheet\" type=\"text/css\" /><style type=\"text/css\">	body, p, input, textarea, #searchform #s {font-family: "+googlefont[1]+";}</style></div>");

						});
					});

					wp.customize("cleanr_options[color]",function(value) {
						value.bind(function(to) {
							$("#alt-style-css").attr("href", "'. get_template_directory_uri() .'/css/"+to+".css");
						});
					});

					wp.customize("cleanr_options[css]",function(value) {
						value.bind(function(to) {
							$("#tempcss").remove();
							var googlefont = to.split(",");
							$("body").append("<div id=\"tempcss\"><style type=\"text/css\">"+to+"</style></div>");
						});
					});
			});
		})(jQuery);
		</script>';

		echo $doc_ready_script;
	}
	