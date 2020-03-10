<?php
show_admin_bar(false);
if ( ! function_exists( 'jobbrschildtheme_setup' ) ) :
	function jobbrschildtheme_setup() {
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'jobbrschildtheme' ),
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
add_action( 'after_setup_theme', 'jobbrschildtheme_setup' );

/**
  *	Add styles and scripts
**/
add_action( 'wp_enqueue_scripts', 'jobbrschildtheme_scripts' );
function jobbrschildtheme_scripts() {
    // Load our main stylesheet.
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get('Version') );
    wp_enqueue_style('jobbrschildtheme-fonts', 'https://fonts.googleapis.com/css?family=Karla|Roboto:300,400,700&display=swap');
    wp_enqueue_style('style-grid-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap-grid.min.css');
    wp_enqueue_style('style-reboot-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap-reboot.min.css');
    wp_enqueue_style('style-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('main-style', get_stylesheet_directory_uri() . '/css/main.css');
    // Load our main script.
    wp_enqueue_script( 'jquery-my',  get_stylesheet_directory_uri() . '/js/jquery-3.4.1.min.js', array(),'3.4.1', true);
    wp_enqueue_script('bundle-js', get_stylesheet_directory_uri() . '/js/bootstrap.bundle.min.js', array(), false, true);
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array(), false, true);
}

/**
  *	Add custom post type "News"
**/
add_action( 'init', 'jobbrschildtheme_post_type' );
function jobbrschildtheme_post_type() {
	register_taxonomy('newscat', array('news'), array(
		'label'                 => 'News category',
		'labels'                => array(
			'name'              => 'News categories',
			'singular_name'     => 'News category',
			'search_items'      => 'Search news category',
			'all_items'         => 'All news categories',
			'parent_item'       => 'Parent news category',
			'parent_item_colon' => 'Parent news category:',
			'edit_item'         => 'Edit news category',
			'update_item'       => 'Update news category',
			'add_new_item'      => 'Add news category',
			'new_item_name'     => 'New news category',
			'menu_name'         => 'News category',
		),
		'description'           => 'News category headings',
		'public'                => true,
		'show_in_nav_menus'     => false,
		'show_ui'               => true,
		'show_tagcloud'         => false,
		'hierarchical'          => true,
		'rewrite'               => array('slug'=>'news', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
		'show_admin_column'     => true,
	) );
	register_post_type('news', array(
		'label'               => 'News',
		'labels'              => array(
			'name'          => 'News',
			'singular_name' => 'News',
			'menu_name'     => 'News',
			'all_items'     => 'All news',
			'add_new'       => 'Add news',
			'add_new_item'  => 'Add new news',
			'edit'          => 'Edit',
			'edit_item'     => 'Edit news',
			'new_item'      => 'New news',
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'show_in_menu'        => true,
    'menu_position'       => 9,
    'menu_icon'           => 'dashicons-format-chat',
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug'=>'news/%newscat%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
		'has_archive'         => 'news',
		'query_var'           => true,
		'supports'            => array( 'title','editor','author','thumbnail','comments', 'page-attributes', 'post-formats' ),
		'taxonomies'          => array( 'newscat' ),
	) );
}
add_filter('post_type_link', 'news_permalink', 1, 2);
function news_permalink( $permalink, $post ){
	if( strpos($permalink, '%newscat%') === false )
		return $permalink;
	$terms = get_the_terms($post, 'newscat');
	if( ! is_wp_error($terms) && !empty($terms) && is_object($terms[0]) )
		$term_slug = array_pop($terms)->slug;
		else
		$term_slug = 'no-newscat';
	return str_replace('%newscat%', $term_slug, $permalink );
}

/**
 * Bootstrap Walker Nav menu
**/
class Bootstrap_Menu_Walker extends Walker_Nav_Menu {

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

      if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
        $t = '';
        $n = '';
      } else {
        $t = "\t";
        $n = "\n";
      }
      $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
      $classes[] = 'menu-item-' . $item->ID;

      // Filters the arguments for a single nav menu item
      $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

      // Filters the CSS class(es) applied to a menu item's list item element
      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
      $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

      // Filters the ID applied to a menu item's list item element
      $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
      $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

      $output .= $indent . '<li' . $id . $class_names .'>';

      // it would be better to enter the class in Appearance -> Menus -> Screen Options -> CSS classes
      // $output .= $indent . '<li' . $id . $class_names .'>';
      $output .= $indent . '<li class="nav-item">';

      $atts = array();
      $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
      $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
      $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
      $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

      // Filters the HTML attributes applied to a menu item's anchor element
      $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

      $attributes = '';
      foreach ( $atts as $attr => $value ) {
        if ( ! empty( $value ) ) {
          $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
          $attributes .= ' ' . $attr . '="' . $value . '"';
        }
      }
      $title = apply_filters( 'the_title', $item->title, $item->ID );

      // Filters a menu item's title
      $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

      $item_output = $args->before;
      $item_output .= '<a class="nav-link js-scroll-trigger"'. $attributes .'>';
      $item_output .= $args->link_before . $title . $args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;

	  $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
/**
 * Delete menu item class
**/
add_filter('nav_menu_item_id', 'filter_menu_id');
add_filter( 'nav_menu_css_class', 'filter_menu_li' );
function filter_menu_li(){
    return array('');
}
function filter_menu_id(){
    return;
}
/**
 * Delete the site name at the end of the title
**/
add_filter( 'document_title_parts', function( $parts ){

	if( isset($parts['site']) ) unset($parts['site']);

	return $parts;
});

/**
 * Custom link 'Read More'
**/
add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $more ){
	global $post;
	return '<br/><a class="read-more" href="'. get_permalink($post) . '">Read More</a>';
}

/**
 *  Pagination
**/
function jobbrschildtheme_pagination( $args = array() ) {

    $defaults = array(
        'range'           => 4,
        'custom_query'    => false,
        'previous_string' => __( 'PREVIOUS', 'jobbrschildtheme' ),
        'next_string'     => __( 'NEXT', 'jobbrschildtheme' ),
        'before_output'   => '<div class="text-center"><ul class="pagination">',
        'after_output'    => '</ul></div>'
    );

    $args = wp_parse_args(
        $args,
        apply_filters( 'jobbrschildtheme_pagination_defaults', $defaults )
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
        $echo .= '<li><a href="' . $previous . '" title="' . __( 'previous', 'jobbrschildtheme') . '">' . $args['previous_string'] . '</a></li>';

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
        $echo .= '<li><a href="' . $next . '" title="' . __( 'next', 'jobbrschildtheme') . '">' . $args['next_string'] . '</a></li>';

    if ( isset($echo) )
        echo $args['before_output'] . $echo . $args['after_output'];
}

/**
 *  Widget area
**/
function jobbrschildtheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'jobbrschildtheme' ),
		'id'            => 'sidebar-area',
		'description'   => esc_html__( 'Add widgets here.', 'jobbrschildtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'jobbrschildtheme_widgets_init' );
