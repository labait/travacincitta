<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );

    wp_enqueue_style( 'jquery.loading-style', get_stylesheet_directory_uri() . '/jquery.loading/jquery.loading.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'slick-style', get_stylesheet_directory_uri() . '/slick/slick.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'slick-style-theme', get_stylesheet_directory_uri() . '/slick/slick-theme.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'styles1', get_stylesheet_directory_uri() . '/css/style.css', array(), $the_theme->get( 'Version' ) );

    wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.12/css/all.css', array(), $the_theme->get( 'Version' ) );



    wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'jquery.loading-scripts', get_stylesheet_directory_uri() . '/jquery.loading/jquery.loading.min.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'slick-scripts', get_stylesheet_directory_uri() . '/slick/slick.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'trovacincitta', get_stylesheet_directory_uri() . '/js/trovacincitta.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDz4CZQG52QtmpoawNGxJInRWeOYRw-Gcc', array(), $the_theme->get( 'Version' ), true );

    //js 360
    wp_enqueue_script( 'threejs', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/92/three.min.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'common', get_stylesheet_directory_uri() . '/jquery-gyroviewer-plugin/js/common.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'fulltilt', get_stylesheet_directory_uri() . '/jquery-gyroviewer-plugin/lib/fulltilt.js', array(), $the_theme->get( 'Version' ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}



function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyDz4CZQG52QtmpoawNGxJInRWeOYRw-Gcc');
}
add_action('acf/init', 'my_acf_init');



function dbg($obj){
  print("<pre>".print_r($obj, TRUE)."</pre>");
}
