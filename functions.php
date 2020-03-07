<?php
	show_admin_bar(false);

if ( ! function_exists( 'jobbrs_setup' ) ) :
	function jobbrs_setup() {
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'jobbrs' ),
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
	wp_enqueue_style('jobbrs-fonts', 'https://fonts.googleapis.com/css?family=Karla|Roboto:300,400,700&display=swap');
    wp_enqueue_style('style-grid-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap-grid.min.css');
    wp_enqueue_style('style-reboot-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap-reboot.min.css');
 	wp_enqueue_style('style-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
 	wp_enqueue_style('main-style', get_stylesheet_directory_uri() . '/css/main.css');
// Load our main script.
    wp_enqueue_script( 'jquery-my',  get_template_directory_uri() . '/js/jquery-3.4.1.min.js', array(),'3.4.1', true);
    wp_enqueue_script('bundle-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), false, true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'jobbrs_scripts');

/**
 *  Pagination
 **/

function jobbrs_pagination( $args = array() ) {
    
    $defaults = array(
        'range'           => 4,
        'custom_query'    => false,
        'previous_string' => __( '«', 'jobbrs' ),
        'next_string'     => __( '»', 'jobbrs' ),
        'before_output'   => '<div class="text-center"><ul class="pagination">',
        'after_output'    => '</ul></div>'
    );
    
    $args = wp_parse_args( 
        $args, 
        apply_filters( 'jobbrs_pagination_defaults', $defaults )
    );
    
    $args['range'] = (int) $args['range'] - 1;
    if ( !$args['custom_query'] )
        $args['custom_query'] = @$GLOBALS['wp_query'];
    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval( get_query_var( 'paged' ) );
    $ceil  = ceil( $args['range'] / 2 );
    
    if ( $count <= 1 )
        return FALSE;
    
    if ( !$page )
        $page = 1;
    
    if ( $count > $args['range'] ) {
        if ( $page <= $args['range'] ) {
            $min = 1;
            $max = $args['range'] + 1;
        } elseif ( $page >= ($count - $ceil) ) {
            $min = $count - $args['range'];
            $max = $count;
        } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }
    
    $echo = '';
    $previous = intval($page) - 1;
    $previous = esc_attr( get_pagenum_link($previous) );
    
    if ( $previous && (1 != $page) )
        $echo .= '<li><a href="' . $previous . '" title="' . __( 'previous', 'jobbrs') . '">' . $args['previous_string'] . '</a></li>';
    
    if ( !empty($min) && !empty($max) ) {
        for( $i = $min; $i <= $max; $i++ ) {
            if ($page == $i) {
                $echo .= '<li class="active"><span class="active">' . str_pad( (int)$i, 1, '0', STR_PAD_LEFT ) . '</span></li>';
            } else {
                $echo .= sprintf( '<li><a href="%s">%2d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
            }
        }
    }
    
    $next = intval($page) + 1;
    $next = esc_attr( get_pagenum_link($next) );
    if ($next && ($count != $page) )
        $echo .= '<li><a href="' . $next . '" title="' . __( 'next', 'jobbrs') . '">' . $args['next_string'] . '</a></li>';
    
    if ( isset($echo) )
        echo $args['before_output'] . $echo . $args['after_output'];
}