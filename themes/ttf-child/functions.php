<?php 

function ttfc_register_blocks() {
    register_block_type( __DIR__ . '/blocks/custom-logo' );
    register_block_type( __DIR__ . '/blocks/archive-filter' );
}
add_action( 'init', 'ttfc_register_blocks' );

function ttfc_enqueue_styles() {
    wp_enqueue_style( 'ttfc-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'ttfc_enqueue_styles' );

//Enqueue a custom JavaScript file that logs a message in the browser console.
function ttfc_enqueue_console_log_js() {
    wp_enqueue_script( 'ttfc-console_log-js', get_stylesheet_directory_uri() . '/js/console-log.js', array(), wp_get_theme()->get('Version'), true );
}
add_action( 'wp_enqueue_scripts', 'ttfc_enqueue_console_log_js' );


/**
 * Register a custom post type named Projects.
 */

function projects_post_type() {
    register_post_type( 'projects',
        array(
            'labels' => array(
                'name' => __( 'Projects' ),
                'singular_name' => __( 'Project' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'editor', 'thumbnail'),
            'rewrite' => array( 'slug' => 'projects' ),
        )
    );
}
add_action( 'init', 'projects_post_type' );

/**
 * Register a custom taxonomy for existing CPT named projects.
 */


function project_types_taxonomy() {
    register_taxonomy(
        'projects',
        'projects',
        array(
            'hierarchical' => true,
            'label' => 'Project types',
            'query_var' => true
        )
    );
}
add_action( 'init', 'project_types_taxonomy' );

/**
 * End registering custom post type and taxonomy.
 */

 /**
  * Start filter project archives by project type.
  */
function ttfc_filter_projects_by_type( $query ) {
    if ( ! is_admin() && $query->is_post_type_archive( 'projects' ) && $query->is_main_query() ) {
        if ( ! empty( $_GET['project_type'] ) ) {
            $query->set( 'tax_query', array(
                array(
                    'taxonomy' => 'projects',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field( $_GET['project_type'] ),
                ),
            ) );
        }
    }
}
add_action( 'pre_get_posts', 'ttfc_filter_projects_by_type' );
