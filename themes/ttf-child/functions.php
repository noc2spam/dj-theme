<?php 

function ttfc_register_blocks() {
    register_block_type( __DIR__ . '/blocks/custom-logo' );
}
add_action( 'init', 'ttfc_register_blocks' );

function ttfc_enqueue_styles() {
    wp_enqueue_style( 'ttfc-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'ttfc_enqueue_styles' );