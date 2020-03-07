<?php
if ( ! function_exists( 'jobbrs_setup' ) ) :
	function jobbrs_setup() {
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'primary' => 'Primary',
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}		
endif;
add_action( 'after_setup_theme', 'jobbrs_setup' );

function jobbrs_scripts() {

// Load our main stylesheet.
	wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('style-grid-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap-grid.min.css');
    wp_enqueue_style('style-reboot-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap-reboot.min.css');
 	wp_enqueue_style('style-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
 	wp_enqueue_style('main-style', get_stylesheet_directory_uri() . '/css/main.css');
// Load our main script.
    wp_enqueue_script('jquery');
    wp_enqueue_script('bundle-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), false, true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'jobbrs_scripts');