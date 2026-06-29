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

    // Register all frontend styles/scripts on init so they're available for editor_style
    wp_register_style('awl-ag-frontend-style-css', AG_PLUGIN_URL . 'assets/css/frontend-style.css', array(), AG_PLUGIN_VER);
    wp_register_style('nag-lightgallery-css', AG_PLUGIN_URL . 'assets/vendor/lightgallery/css/lightgallery.min.css', array(), '1.10.0');
    wp_register_style('awl-animate-css', AG_PLUGIN_URL . 'assets/css/awl-animate.css', array(), AG_PLUGIN_VER);
    wp_register_style('awl-hover-stack-style-css', AG_PLUGIN_URL . 'assets/css/awl-hover-stack-style.css', array(), AG_PLUGIN_VER);
    wp_register_style('awl-hover-overlay-effects-css', AG_PLUGIN_URL . 'assets/css/awl-hover-overlay-effects.css', array(), AG_PLUGIN_VER);
    wp_register_style('awl-hover-overlay-effects-style-css', AG_PLUGIN_URL . 'assets/css/awl-hover-overlay-effects-style.css', array(), AG_PLUGIN_VER);
    wp_register_style('nag-skeleton-css', AG_PLUGIN_URL . 'assets/css/frontend-modern.css', array(), AG_PLUGIN_VER);

    // Register editor-only override styles (force visibility in editor preview)
    wp_register_style('awl-ag-block-editor-css', false);
    wp_add_inline_style('awl-ag-block-editor-css', '
        .nag-skeleton img { opacity: 1 !important; }
        .nag-skeleton.nag-loading::after { display: none !important; }
    ');
    
    wp_register_script(
        'awl-ag-gutenberg-block-js',
        AG_PLUGIN_URL . 'assets/js/gutenberg-block.js',
        array('wp-blocks', 'wp-element', 'wp-components', 'wp-block-editor', 'wp-server-side-render', 'jquery'),
        AG_PLUGIN_VER,
        true
    );

    register_block_type('new-album-gallery/album-gallery-block', array(
        'api_version'     => 3,
        'editor_script'   => 'awl-ag-gutenberg-block-js',
        'editor_style'    => array(
            'nag-lightgallery-css',
            'awl-ag-frontend-style-css',
            'awl-animate-css',
            'awl-hover-stack-style-css',
            'awl-hover-overlay-effects-css',
            'awl-hover-overlay-effects-style-css',
            'nag-skeleton-css',
            'awl-ag-block-editor-css'
        ),
        'render_callback' => 'awl_album_gallery_block_render',
        'attributes'      => array(
            'galleryId' => array(
                'type'    => 'string',
                'default' => '',
            ),
        ),
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
    $gallery_id = isset($attributes['galleryId']) ? (int)$attributes['galleryId'] : 0;
    if ($gallery_id) {
        return awl_album_gallery_shortcode(array('id' => $gallery_id));
    }
    return '';
}
