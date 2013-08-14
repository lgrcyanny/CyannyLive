<?php

/**
 * Enqueue scripts and styles
 */

function  cleanr_scripts() {

    global $post, $theme_options;
    
    $theme_options = get_option( 'cleanr_options' );

    wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'cleanr_scripts', get_template_directory_uri() .'/js/scripts.js', array( 'jquery' ), '1.0' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
        wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }

    if( isset ( $theme_options['color'] ) && '' != $theme_options['color']) {
        wp_enqueue_style( 'alt-style', get_template_directory_uri() . '/css/' . $theme_options['color'] . '.css', array( 'style' ) );
    }

}
add_action( 'wp_enqueue_scripts', 'cleanr_scripts' );