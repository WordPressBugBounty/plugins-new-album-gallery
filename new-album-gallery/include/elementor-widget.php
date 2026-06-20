<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Register Elementor Widget for Album Gallery
 */
add_action('elementor/widgets/register', 'awl_album_gallery_register_elementor_widget');
function awl_album_gallery_register_elementor_widget($widgets_manager) {
    // Register widget instance
    if (class_exists('Elementor_Album_Gallery_Widget')) {
        $widgets_manager->register(new \Elementor_Album_Gallery_Widget());
    }
}

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
            $atts = array();
            if (!empty($settings['gallery_id'])) {
                $atts['id'] = (int)$settings['gallery_id'];
                // Call the main shortcode rendering logic directly
                echo awl_album_gallery_shortcode($atts); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output is escaped in awl_album_gallery_shortcode
            } else {
                echo '<div style="background:#f3f4f6; padding:15px; text-align:center; border:1px dashed #ccc;">' . esc_html__('Please select an Album Gallery.', 'new-album-gallery') . '</div>';
            }
        }
    }
}
