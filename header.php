<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js jquery-loading lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

<!--[if IE 7]>         <html class="no-js jquery-loading lt-ie9 lt-ie8"> <![endif]-->

<!--[if IE 8]>         <html class="no-js jquery-loading lt-ie9"> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js jquery-loading"> <!--<![endif]-->
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name = "format-detection" content = "telephone=no">
        <title><?php bloginfo( 'name' ); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
            <!--[if lt IE 9]>
            <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
            <![endif]-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header class="header" role="banner">
            <nav class="navbar navbar-expand-lg sticky-top" id="nav">
                <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav"  aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                </button> 
                <div id="my-nav" class="collapse navbar-collapse">
                    <?php 
                        wp_nav_menu( [
                              'theme_location' => 'primary',
                              'container' => false,
                              'menu_class' => 'menu',
                              'menu_id' => '',
                              'fallback_cb' => '__return_false',
                              'items_wrap' => '<ul id="%1$s" class="navbar-nav mr-auto">%3$s</ul>',
                              'depth' => 0,
                              'walker' => new Bootstrap_Menu_Walker(),
                        ] );
                    ?>
                </div>
            </nav>
            <div class="hero">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/hero.png" alt="header background">
                <div class="page-title position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center">
                    <div class="col-md-5 p-lg-5 mx-auto my-5">
                        <h1 class="font-weight-normal"><?php echo wp_get_document_title(); ?></h1>
                        <p class="lead font-weight-normal"><?php the_field('page-description'); ?></p>        
                    </div>
                </div>      
            </div>
        </header>
        <main  class="main" role="main">
            <div class="container">  
                <div class="row">



      