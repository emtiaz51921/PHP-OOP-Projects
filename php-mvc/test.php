<?php
/* Child theme generated with WPS Child Theme Generator */

if ( !function_exists( 'b7ectg_theme_enqueue_styles' ) ) {
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );

    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.min.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );

        wp_register_style( 'child-Bootstrap-grid', get_stylesheet_directory_uri() . '/css/bootstrap-grid.css' );
        wp_enqueue_style( 'child-Bootstrap-grid' );

        wp_register_style( 'jquery.beefup', get_stylesheet_directory_uri() . '/css/jquery.beefup.css' );
        wp_enqueue_style( 'jquery.beefup' );

        wp_register_style( 'drawer', 'https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css' );
        wp_enqueue_style( 'drawer' );

        wp_register_style( 'childstyle-responsive', get_stylesheet_directory_uri() . '/css/responsive.css', array( 'child-style' ) );
        wp_enqueue_style( 'childstyle-responsive' );

        wp_enqueue_script( 'modernizr-jquery.beefup', get_stylesheet_directory_uri() . '/js/jquery.beefup.min.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'modernizr-custom', get_stylesheet_directory_uri() . '/js/modernizr-custom.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'iscroll', 'https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'drawer.min', 'https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'fontsize', get_stylesheet_directory_uri() . '/js/fontsize.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'childstyle-js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'skip-link-focus-fix', get_stylesheet_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );

        //wp_enqueue_script('isotope-layout', 'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', array('jquery'));
    }

}

// ******************** Clean up WordPress Header ********************** //
function helementor_remove_wp_scripts() {

    if ( !is_single() ) {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
    }

    //magnific-popup.
    wp_deregister_style( 'magnific-popup' );
    wp_dequeue_style( 'magnific-popup' );

//dashicons.
    if ( !is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
        wp_dequeue_style( 'dashicons' );
    }

    /** Disable this while switching off the theme */
    if ( is_child_theme() ) {
        wp_deregister_style( 'hello-elementor' );
        wp_dequeue_style( 'hello-elementor' );
    }

}

add_action( 'wp_enqueue_scripts', 'helementor_remove_wp_scripts', 100 );

/*
 * Include files
 */
require_once get_stylesheet_directory() . '/inc/elementor-functions.php';
require_once get_stylesheet_directory() . '/inc/template-tags.php';

require_once get_stylesheet_directory() . '/inc/event-shortcode-template.php';
require_once get_stylesheet_directory() . '/inc/class-event-shortcode.php';

/*
 * Get all terms by term name
 */

function get_all_terms( $termName ) {
    $types = get_terms( $termName, array(
        'hide_empty' => 0,
    ) );
    $return_types = array();

    foreach ( $types as $type ) {
        $return_types[$type->slug] = $type->name;
    }

    return $return_types;
}

/*
 * Get category slug list
 */

function get_category_slug_list( $ID ) {

    $categories = get_the_category( $ID );

    foreach ( $categories as $categorie ) {
        echo $categorie->slug . " ";
    }

}

/**
 * Get post reading time
 */
function reading_time() {
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil( $word_count / 200 );

    if ( $readingtime == 1 ) {
        $timer = "MIN";
    } else {
        $timer = "MINS";
    }

    $totalreadingtime = $readingtime . $timer;

    return $totalreadingtime;
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 15;
}

add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elementor_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'elementor' ),
            'id'            => 'default-sidebar',
            'description'   => esc_html__( 'Add widgets here.', 'elementor' ),
            'before_widget' => '<div id="%1$s" class="widget_area %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget_title"><span>',
            'after_title'   => '</span></h3>',
        )
    );

}

add_action( 'widgets_init', 'elementor_widgets_init' );

/**
 * Add excerpt on job listing
 */function awsm_jobs_listing_excerpt() {

    $excerpt = sprintf( '<div class="job_content">%s</div>', get_the_excerpt() );
    $more_dtls_link = sprintf( '<div class="awsm-job-more-container"><span class="awsm-job-more">%s<span></span></span></div>', esc_html__( 'More Details', 'wp-job-openings' ) );
    echo $excerpt . $more_dtls_link;
}

add_action( 'awsm_jobs_listing_details_link', 'awsm_jobs_listing_excerpt' );

/**
 * Add image role to all images
 */
add_filter( 'the_content', 'add_role_attr_to_svg' );
function add_role_attr_to_svg( $content ) {
    $content = str_replace( '<svg', '<svg role="img" Aria-labelledby="lightbulb" title="lightbulb" focusable="false" ', $content );

    return $content;
}

/**
 * Add Screen Reader skip links
 */
add_action( 'wp_body_open', 'wpdoc_add_custom_body_open_code' );

function wpdoc_add_custom_body_open_code() {
    $content = <<<EOF
    <a class="skip-link screen-reader-text" href="#content">Skip to content</a>


    <div class="drawer drawer--left">
    <div role="banner">
      <button type="button" class="drawer-toggle drawer-hamburger">
        <span class="sr-only">toggle navigation</span>
        <span class="tog-icon"><i class="fab fa-accessible-icon"></i></span>
      </button>
      <nav class="drawer-nav" role="navigation">
        <ul class="drawer-menu">
          <li><a class="drawer-menu-item zoomin" href="#"><i class="fas fa-plus-circle"></i> Font Size</a></li>
          <li><a class="drawer-menu-item zoomout" href="#"><i class="fas fa-minus-circle"></i> Font Size</a></li>
        </ul>
      </nav>
    </div>
    <main role="main">
      <!-- Page content -->
    </main>
  </div>



EOF;

    echo $content;

}