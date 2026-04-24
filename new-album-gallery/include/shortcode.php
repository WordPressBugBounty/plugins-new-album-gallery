<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Album Gallery Shortcode
 */
// Register shortcode
add_shortcode('AGAL', 'awl_album_gallery_shortcode');

// Main shortcode function
function awl_album_gallery_shortcode($atts)
{
    agp_enqueue_frontend_assets_once();
    ob_start();

    // Check if ID is provided
    $post_id = isset($atts['id']) ? (int) $atts['id'] : null;

    if ($post_id) {
        // Individual Gallery
        $output = agp_render_album_gallery($post_id);
        if (!empty($output)) {
            echo '<div class="awp_center awl-ag-row"><div class="awl-ag-col" style="flex:0 0 100%;max-width:100%;">' . $output . '</div></div>';
        }
    }

    return ob_get_clean();
}
