<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Register all AG frontend assets early so they're available in any context.
 */
add_action('wp_enqueue_scripts', 'awl_ag_elementor_register_assets', 5);
function awl_ag_elementor_register_assets() {
    wp_register_style('awl-ag-frontend-style-css', AG_PLUGIN_URL . 'assets/css/frontend-style.css', array(), AG_PLUGIN_VER);
    wp_register_style('nag-lightgallery-css', AG_PLUGIN_URL . 'assets/vendor/lightgallery/css/lightgallery.min.css', array(), '1.10.0');
    wp_register_style('awl-animate-css', AG_PLUGIN_URL . 'assets/css/awl-animate.css', array(), AG_PLUGIN_VER);
    wp_register_style('awl-hover-stack-style-css', AG_PLUGIN_URL . 'assets/css/awl-hover-stack-style.css', array(), AG_PLUGIN_VER);
    wp_register_style('awl-hover-overlay-effects-css', AG_PLUGIN_URL . 'assets/css/awl-hover-overlay-effects.css', array(), AG_PLUGIN_VER);
    wp_register_style('awl-hover-overlay-effects-style-css', AG_PLUGIN_URL . 'assets/css/awl-hover-overlay-effects-style.css', array(), AG_PLUGIN_VER);
    wp_register_style('nag-skeleton-css', AG_PLUGIN_URL . 'assets/css/frontend-modern.css', array(), AG_PLUGIN_VER);

    wp_register_script('nag-lightgallery-js', AG_PLUGIN_URL . 'assets/vendor/lightgallery/js/lightgallery.min.js', array('jquery'), '1.10.0', true);
    wp_register_script('nag-lg-thumbnail', AG_PLUGIN_URL . 'assets/vendor/lightgallery/js/lg-thumbnail.min.js', array('nag-lightgallery-js'), '1.10.0', true);
    wp_register_script('nag-lg-autoplay', AG_PLUGIN_URL . 'assets/vendor/lightgallery/js/lg-autoplay.min.js', array('nag-lightgallery-js'), '1.10.0', true);
    wp_register_script('nag-lg-video', AG_PLUGIN_URL . 'assets/vendor/lightgallery/js/lg-video.min.js', array('nag-lightgallery-js'), '1.10.0', true);
    wp_register_script('nag-lightbox-init', AG_PLUGIN_URL . 'assets/js/nag-lightbox-init.js', array('jquery', 'nag-lightgallery-js'), AG_PLUGIN_VER, true);
    wp_register_script('nag-skeleton-js', AG_PLUGIN_URL . 'assets/js/frontend-skeleton.js', array('jquery'), AG_PLUGIN_VER, true);
}

/**
 * Force-enqueue gallery assets on Elementor preview pages.
 */
add_action('elementor/preview/enqueue_styles', 'awl_ag_elementor_enqueue_preview_assets');
function awl_ag_elementor_enqueue_preview_assets() {
    wp_enqueue_style('nag-lightgallery-css');
    wp_enqueue_style('awl-ag-frontend-style-css');
    wp_enqueue_style('awl-animate-css');
    wp_enqueue_style('awl-hover-stack-style-css');
    wp_enqueue_style('awl-hover-overlay-effects-css');
    wp_enqueue_style('awl-hover-overlay-effects-style-css');
    wp_enqueue_style('nag-skeleton-css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('nag-lightgallery-js');
    wp_enqueue_script('nag-lg-thumbnail');
    wp_enqueue_script('nag-lg-autoplay');
    wp_enqueue_script('nag-lg-video');
    wp_enqueue_script('nag-lightbox-init');
    wp_enqueue_script('nag-skeleton-js');
}

/**
 * Register Elementor Widget for Album Gallery
 */
add_action('elementor/widgets/register', 'awl_album_gallery_register_elementor_widget');
function awl_album_gallery_register_elementor_widget($widgets_manager) {
    if (class_exists('\Elementor\Widget_Base')) {

        class Elementor_Album_Gallery_Widget extends \Elementor\Widget_Base {

            public function get_name() {
                return 'album_gallery_widget';
            }

            public function get_title() {
                return esc_html__('Album Gallery', 'new-album-gallery');
            }

            public function get_icon() {
                return 'eicon-gallery-grid';
            }

            public function get_categories() {
                return array('general');
            }

            public function get_keywords() {
                return array('album', 'gallery', 'photo', 'video', 'grid');
            }

            public function get_style_depends() {
                return array(
                    'nag-lightgallery-css',
                    'awl-ag-frontend-style-css',
                    'awl-animate-css',
                    'awl-hover-stack-style-css',
                    'awl-hover-overlay-effects-css',
                    'awl-hover-overlay-effects-style-css',
                    'nag-skeleton-css'
                );
            }

            public function get_script_depends() {
                return array(
                    'nag-lightgallery-js',
                    'nag-lg-thumbnail',
                    'nag-lg-autoplay',
                    'nag-lg-video',
                    'nag-lightbox-init',
                    'nag-skeleton-js'
                );
            }

            protected function register_controls() {
                $this->start_controls_section(
                    'section_content',
                    array(
                        'label' => esc_html__('Gallery Settings', 'new-album-gallery'),
                        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    )
                );

                // Fetch Galleries List
                $all_galleries = get_posts(array(
                    'post_type'      => 'album_gallery',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ));

                $gallery_options = array('' => esc_html__('-- Select Gallery --', 'new-album-gallery'));
                if (!empty($all_galleries)) {
                    foreach ($all_galleries as $g) {
                        $gallery_options[$g->ID] = $g->post_title . ' (ID: ' . $g->ID . ')';
                    }
                }

                $this->add_control(
                    'gallery_id',
                    array(
                        'label'   => esc_html__('Select Gallery', 'new-album-gallery'),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'options' => $gallery_options,
                        'default' => '',
                    )
                );

                $this->end_controls_section();
            }

            protected function render() {
                $settings = $this->get_settings_for_display();
                
                if (empty($settings['gallery_id'])) {
                    echo '<div style="padding:20px; border:1px dashed #ccc; text-align:center;">' . esc_html__('Please select an Album Gallery.', 'new-album-gallery') . '</div>';
                    return;
                }

                $gallery_id = (int)$settings['gallery_id'];

                // Detect Elementor editor/preview context
                $is_elementor_editor = false;
                if (class_exists('\Elementor\Plugin')) {
                    if (\Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode()) {
                        $is_elementor_editor = true;
                    }
                }

                if ($is_elementor_editor) {
                    // In Elementor editor: inject CSS <link> tags directly into the HTML output
                    // because wp_enqueue_style() calls are ignored during AJAX widget re-renders.
                    $css_files = array(
                        AG_PLUGIN_URL . 'assets/vendor/lightgallery/css/lightgallery.min.css',
                        AG_PLUGIN_URL . 'assets/css/frontend-style.css',
                        AG_PLUGIN_URL . 'assets/css/awl-animate.css',
                        AG_PLUGIN_URL . 'assets/css/awl-hover-stack-style.css',
                        AG_PLUGIN_URL . 'assets/css/awl-hover-overlay-effects.css',
                        AG_PLUGIN_URL . 'assets/css/awl-hover-overlay-effects-style.css',
                        AG_PLUGIN_URL . 'assets/css/frontend-modern.css',
                    );
                    $ver = AG_PLUGIN_VER;
                    foreach ($css_files as $css_url) {
                        $css_url_versioned = esc_url($css_url) . '?ver=' . esc_attr($ver);
                        echo '<link rel="stylesheet" href="' . $css_url_versioned . '" type="text/css" media="all" />' . "\n";
                    }
                }

                // Render the gallery shortcode
                $atts = array('id' => $gallery_id);
                echo awl_album_gallery_shortcode($atts); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output is escaped in awl_album_gallery_shortcode

                if ($is_elementor_editor) {
                    // In Elementor editor: inject inline JS to initialize skeleton loader state.
                    ?>
                    <script type="text/javascript">
                    (function() {
                        function nagInitGallery() {
                            if (typeof jQuery === 'undefined') return;
                            var $ = jQuery;
                            var $gallery = $('#album_gallery_<?php echo esc_js($gallery_id); ?>');
                            if (!$gallery.length) return;

                            // Force skeleton items to load/show in the editor preview immediately
                            $gallery.find('.nag-skeleton').removeClass('nag-loading').addClass('nag-loaded');
                        }

                        // Try immediately and also after a short delay
                        nagInitGallery();
                        setTimeout(nagInitGallery, 500);
                        setTimeout(nagInitGallery, 1500);
                    })();
                    </script>
                    <?php
                }
            }
        }

        // Register widget instance
        $widgets_manager->register(new \Elementor_Album_Gallery_Widget());
    }
}
