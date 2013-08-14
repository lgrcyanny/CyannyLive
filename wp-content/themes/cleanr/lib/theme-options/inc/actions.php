<?php
/**
 * cleanr Actions
 * @package cleanr
 * @author Graph Paper Press
 */

/**
 * cleanr Custom CSS
 */
function cleanr_css() {

    $theme_options = get_option( 'cleanr_options' );

    if ( isset( $theme_options['css'] ) && '' != $theme_options['css'] ) {

        echo '<style type="text/css">';
        echo sanitize_text_field( $theme_options['css'] );
        echo '</style>';

    }
}

add_action( 'wp_head', 'cleanr_css' );

/**
 * cleanr Google Font Integration
 */
function cleanr_include_font() {

    $theme_options = get_option( 'cleanr_options' );

    if ( ( isset ( $theme_options['font'] ) && '' != $theme_options['font'] ) || ( isset ( $theme_options['font_alt'] ) && '' != $theme_options['font_alt'] ) ) {

        list( $font_parameter, $font_name ) = explode( ',', $theme_options['font'] );
        list( $font_alt_parameter, $font_alt_name ) = explode( ',', $theme_options['font_alt'] );

         if ( 'None' != $font_name || 'None' != $font_alt_name ) {

			if ( isset ( $font_alt_name ) && '' != $font_alt_name && 'None' != $font_alt_name && isset ( $font_name ) && '' != $font_name && 'None' != $font_name ) {
				$sep = '|';
			} else {
				$sep = '';
			}
			if( $font_parameter == 'None' ) {
				$font_parameter = '';
				$font_name = '';
			}                
			if( $font_alt_parameter == 'None' ) {
				$font_alt_parameter = '';
				$font_alt_name = '';
			}        
			echo '<link href="http://fonts.googleapis.com/css?family=' . $font_parameter . $sep . $font_alt_parameter . '" rel="stylesheet" type="text/css" />',"\n";
			echo '<style type="text/css">';
			if ( isset ( $font_alt_name ) && '' != $font_alt_name && 'None' != $font_alt_name ) {
				echo 'body, p, input, textarea, #searchform #s { font-family: "' . $font_alt_name . '"; }';
			}

			if ( isset ( $font_name ) && '' != $font_name && 'None' != $font_name ) {
				echo 'h1, h2, h3, h4, h5, h6, small, .postmetadata, .small, #header span, #access ul { font-family: "' . $font_name . '"; }';
			}
                       
          echo '</style>',"\n";

       }
    }
}

add_action( 'wp_head', 'cleanr_include_font' );

/**
 * cleanr alternative styles
 */

function  cleanr_alt_styles() {
	$theme_options = get_option( 'cleanr_options' );
	
	if( isset ( $theme_options['color'] ) && '' != $theme_options['color']) {
        wp_enqueue_style( 'alt-style', get_template_directory_uri() . '/css/' . $theme_options['color'] . '.css', array( 'style' ) );
    }
}
add_action( 'wp_enqueue_scripts', 'cleanr_alt_styles' );