<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Register Gutenberg Block for Album Gallery
 */
add_action('init', 'awl_album_gallery_register_gutenberg_block');
function awl_album_gallery_register_gutenberg_block() {
    if (!function_exists('register_block_type')) {
        return;
    }
    
    wp_register_script(
        'awl-ag-gutenberg-block-js',
        AG_PLUGIN_URL . 'assets/js/gutenberg-block.js',
        array('wp-blocks', 'wp-element', 'wp-components', 'wp-block-editor', 'wp-editor', 'jquery'),
        AG_PLUGIN_VER,
        true
    );

    register_block_type('new-album-gallery/album-gallery-block', array(
        'editor_script'   => 'awl-ag-gutenberg-block-js',
        'render_callback' => 'awl_album_gallery_block_render',
    ));
}

add_action('enqueue_block_editor_assets', 'awl_album_gallery_gutenberg_localize');
function awl_album_gallery_gutenberg_localize() {
    $all_galleries = get_posts(array(
        'post_type'      => 'album_gallery',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
    ));
    
    $galleries_data = array();
    if (!empty($all_galleries)) {
        foreach ($all_galleries as $g) {
            $galleries_data[] = array(
                'id'    => $g->ID,
                'title' => $g->post_title ? $g->post_title : __('(no title)', 'new-album-gallery'),
            );
        }
    }
    
    wp_localize_script('awl-ag-gutenberg-block-js', 'ag_gutenberg_data', array(
        'galleries'  => $galleries_data,
    ));
}

/**
 * Gutenberg Block Render Callback
 */
function awl_album_gallery_block_render($attributes) {
    $atts = array();
    if (isset($attributes['galleryId'])) {
        $atts['id'] = (int)$attributes['galleryId'];
    }
    return awl_album_gallery_shortcode($atts);
}
