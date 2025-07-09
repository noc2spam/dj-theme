<?php 

function ttfc_register_blocks() {
    register_block_type( __DIR__ . '/blocks/custom-logo' );
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
 * Register a custom taxonomy for existing CPT named projects.
 */


function project_types_taxonomy() {
    register_taxonomy(
        'projects',
        'Projects',
        array(
            'hierarchical' => true,
            'label' => 'Project types',
            'query_var' => true
        )
    );
}
add_action( 'init', 'project_types_taxonomy' );

