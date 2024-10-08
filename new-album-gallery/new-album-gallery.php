<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/*
@package New Album Gallery
Plugin Name: New Album Gallery
Plugin URI: https://awplife.com/
Description: A Newly Amazing Different Most Powerful Responsive Easy To Use Album Gallery Plugin For WordPress
Version: 1.6.0
Author: A WP Life
Author URI: https://awplife.com/
Text Domain: new-album-gallery
Domain Path: /languages
License: GPL2

New Album Gallery is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

New Album Gallery is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with New Album Gallery. If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html.
*/

if (!class_exists('Awl_Album_Gallery')) {

	class Awl_Album_Gallery
	{

		public function __construct()
		{
			$this->_constants();
			$this->_hooks();
		}

		protected function _constants()
		{

			// Plugin Version
			define('AG_PLUGIN_VER', '1.6.0');

			// Plugin Text Domain
			define('AGP_TXTDM', 'new-album-gallery');

			// Plugin Name
			define('AG_PLUGIN_NAME', __('Album Gallery', AGP_TXTDM));

			// Plugin Slug
			define('AG_PLUGIN_SLUG', 'album_gallery');

			// Plugin Directory Path
			define('AG_PLUGIN_DIR', plugin_dir_path(__FILE__));

			// Plugin Directory URL
			define('AG_PLUGIN_URL', plugin_dir_url(__FILE__));

		} // end of constructor function

		/**
		 * Setup the default filters and actions
		 */
		protected function _hooks()
		{

			// Load Text Domain
			add_action('plugins_loaded', array($this, '_load_textdomain'));

			// add gallery menu item, change menu filter for multisite
			add_action('admin_menu', array($this, 'ag_gallery_menu'), 101);

			// Create Album Gallery Custom Post
			add_action('init', array($this, '_Album_Gallery'));

			// Add Meta Box To Custom Post
			add_action('add_meta_boxes', array($this, '_ag_admin_add_meta_box'));

			add_action('wp_ajax_album_gallery_js', array(&$this, 'ajax_album_gallery'));

			add_action('save_post', array(&$this, '_ag_save_settings'));

			// Shortcode Compatibility in Text Widegts
			add_filter('widget_text', 'do_shortcode');

			// add pfg cpt shortcode column - manage_{$post_type}_posts_columns
			add_filter('manage_album_gallery_posts_columns', array(&$this, 'set_album_gallery_shortcode_column_name'));

			// add pfg cpt shortcode column data - manage_{$post_type}_posts_custom_column
			add_action('manage_album_gallery_posts_custom_column', array(&$this, 'custom_album_gallery_shodrcode_data'), 10, 2);

			add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts_in_header'));

		}//end _hooks()

		public function enqueue_scripts_in_header()
		{
			wp_enqueue_script('jquery');
		}

		// Album Gallery cpt shortcode column before date columns
		public function set_album_gallery_shortcode_column_name($defaults)
		{
			$new = array();
			$shortcode = $columns['album_gallery_shortcode'];  // save the tags column
			unset($defaults['tags']);   // remove it from the columns list

			foreach ($defaults as $key => $value) {
				if ($key == 'date') {  // when we find the date column
					$new['album_gallery_shortcode'] = __('Shortcode', 'new-album-gallery');  // put the tags column before it
				}
				$new[$key] = $value;
			}
			return $new;
		}

		// Albym Gallery cpt shortcode column data
		public function custom_album_gallery_shodrcode_data($column, $post_id)
		{
			switch ($column) {
				case 'album_gallery_shortcode':
					echo "<input type='text' class='button button-primary' id='album-gallery-shortcode-" . esc_attr($post_id) . "' value='[AGAL id=" . esc_attr($post_id) . "]' style='font-weight:bold; background-color:#32373C; color:#FFFFFF; text-align:center;' />";
					echo "<input type='button' class='button button-primary' onclick='return ALBUMCopyShortcode" . esc_attr($post_id) . "();' readonly value='Copy' style='margin-left:4px;' />";
					echo "<span id='copy-msg-" . esc_attr($post_id) . "' class='button button-primary' style='display:none; background-color:#32CD32; color:#FFFFFF; margin-left:4px; border-radius: 4px;'>copied</span>";
					echo "<script>
						function ALBUMCopyShortcode$post_id() {
							var copyText = document.getElementById('album-gallery-shortcode-" . esc_attr($post_id) . "');
							copyText.select();
							document.execCommand('copy');
							
							//fade in and out copied message
							jQuery('#copy-msg-" . esc_attr($post_id) . "').fadeIn('1000', 'linear');
							jQuery('#copy-msg-" . esc_attr($post_id) . "').fadeOut(2500,'swing');
						}
						</script>
					";
					break;
			}
		}


		public function _load_textdomain()
		{
			load_plugin_textdomain('new-album-gallery', false, dirname(plugin_basename(__FILE__)) . '/languages');
		}

		/* Add Gallery menu*/
		public function ag_gallery_menu()
		{
			$help_menu = add_submenu_page('edit.php?post_type=' . AG_PLUGIN_SLUG, __('Column Settings', 'new-album-gallery'), __('Column Settings', 'new-album-gallery'), 'administrator', 'ag-column-page', array($this, '_ag_column_page'));
			$docs_menu = add_submenu_page('edit.php?post_type=' . AG_PLUGIN_SLUG, __('Docs', 'new-album-gallery'), __('Docs', 'new-album-gallery'), 'administrator', 'ag-doc-page', array($this, '_ag_doc_page'));
			$theme_menu = add_submenu_page('edit.php?post_type=' . AG_PLUGIN_SLUG, __('Our Theme', 'new-album-gallery'), __('Our Theme', 'new-album-gallery'), 'administrator', 'sr-theme-page', array($this, '_ag_theme_page'));
		}

		/**
		 * Album Gallery Custom Post
		 * Create gallery post type in admin dashboard.
		 */
		public function _Album_Gallery()
		{
			$labels = array(
				'name' => __('Album Gallery', 'new-album-gallery'),
				'singular_name' => __('Album Gallery', 'new-album-gallery'),
				'menu_name' => __('Album Gallery', 'new-album-gallery'),
				'name_admin_bar' => __('Album Gallery', 'new-album-gallery'),
				'parent_item_colon' => __('Parent Item:', 'new-album-gallery'),
				'all_items' => __('All Album Gallery', 'new-album-gallery'),
				'add_new_item' => __('Add Album Gallery', 'new-album-gallery'),
				'add_new' => __('Add Album Gallery', 'new-album-gallery'),
				'new_item' => __('Album Gallery', 'new-album-gallery'),
				'edit_item' => __('Edit Album Gallery', 'new-album-gallery'),
				'update_item' => __('Update Album Gallery', 'new-album-gallery'),
				'search_items' => __('Search Album Gallery', 'new-album-gallery'),
				'not_found' => __('Album Gallery Not found', 'new-album-gallery'),
				'not_found_in_trash' => __('Album Gallery Not found in Trash', 'new-album-gallery'),
			);

			$args = array(
				'label' => __('Album Gallery', 'new-album-gallery'),
				'description' => __('Custom Post Type For Album Gallery', 'new-album-gallery'),
				'labels' => $labels,
				'supports' => array('title'),
				'taxonomies' => array(),
				'hierarchical' => false,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'menu_position' => 65,
				'menu_icon' => 'dashicons-images-alt',
				'show_in_admin_bar' => true,
				'show_in_nav_menus' => true,
				'can_export' => true,
				'has_archive' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'capability_type' => 'page',
			);

			register_post_type('album_gallery', $args);
		}//end _Album_Gallery()

		/**
		 * Adds Meta Boxes
		 */
		public function _ag_admin_add_meta_box()
		{
			// Syntax: add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
			add_meta_box('1', __('Copy Album Gallery Shortcode', 'new-album-gallery'), array(&$this, '_ag_shortcode_left_metabox'), 'album_gallery', 'side', 'default');
			add_meta_box('', __('Add Images', 'new-album-gallery'), array(&$this, 'ag_upload_multiple_images'), 'album_gallery', 'normal', 'default');
		}
		// album gallery copy shortcode meta box under publish button
		public function _ag_shortcode_left_metabox($post)
		{ ?>
			<p class="input-text-wrap">
				<input type="text" name="ALBUMCopyShortcode" id="ALBUMCopyShortcode"
					value="<?php echo '[AGAL id=' . esc_attr($post->ID) . ']'; ?>" readonly
					style="height: 60px; text-align: center; width:100%;  font-size: 24px; border: 2px dashed;">
			<p id="ag-copy-code">
				<?php esc_html_e('Shortcode copied to clipboard!', 'new-album-gallery'); ?>
			</p>
			<p style="margin-top: 10px">
				<?php esc_html_e('Copy & Embed shotcode into any Page/ Post to display gallery.', 'new-album-gallery'); ?>
			</p>
			</p>
			<span onclick="copyToClipboard('#ALBUMCopyShortcode')" class="ag-copy dashicons dashicons-clipboard"></span>
			<style>
				.ag-copy {
					position: absolute;
					top: 9px;
					right: 24px;
					font-size: 26px;
					cursor: pointer;
				}
			</style>
			<script>
				jQuery("#ag-copy-code").hide();
				function copyToClipboard(element) {
					var $temp = jQuery("<input>");
					jQuery("body").append($temp);
					$temp.val(jQuery(element).val()).select();
					document.execCommand("copy");
					$temp.remove();
					jQuery("#ALBUMCopyShortcode").select();
					jQuery("#ag-copy-code").fadeIn();
				}
			</script>
			<?php
		}

		public function ag_upload_multiple_images($post)
		{
			wp_enqueue_script('jquery');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('awl-ag-uploader.js', AG_PLUGIN_URL . 'assets/js/awl-ag-uploader.js', array('jquery'));
			wp_enqueue_style('awl-ag-uploader-css', AG_PLUGIN_URL . 'assets/css/awl-ag-uploader.css');
			wp_enqueue_style('awl-metabox-css', AG_PLUGIN_URL . 'assets/css/metabox.css');

			wp_enqueue_media();

			?>
			<div id="album-gallery-note">
				<p><strong>
						<?php echo esc_html_e('Tips 1'); ?>:
					</strong>
					<?php echo esc_html_e('The First Image Will Be Album Gallery Cover.', 'new-album-gallery'); ?>
				</p>
				<p><strong>
						<?php echo esc_html_e('Tips 2'); ?>:
					</strong>
					<?php echo esc_html_e(': Always Use Same Size Image (Height & Width Same) Album Cover For Each Gallery.', 'new-album-gallery'); ?>
				</p>
			</div>
			<div class="row">
				<!--Add New Image Button-->
				<div class="file-upload">
					<div class="image-upload-wrap">
						<input class="add-new-image-slides file-upload-input" id="add-new-image-slides" name="add-new-image-slides"
							value="Upload Image" />
						<div class="drag-text">
							<h3>
								<?php esc_html_e('ADD IMAGES', 'new-album-gallery'); ?>
								<?php wp_nonce_field('ag_add_images', 'ag_add_images_nonce'); ?>
							</h3>
						</div>
					</div>
				</div>
			</div>
			<br><br>
			<div style="clear:left;"></div>
			<br>
			<style>
				.selectbox_position_newslide {
					border-width: 1px 1px 1px 6px !important;
					border-color: #32CC24 !important;
					width: 100% !important;
					margin-bottom: 3px;
					margin-left: 4px;
					margin-top: 3px;
				}

				.input_box_newslide {
					border-width: 2px 2px 2px 2px !important;
					border-color: #32CC24 !important;
					width: 100% !important;
					border-radius: 5px;
					margin-bottom: 3px;
					margin-left: 4px;
				}
			</style>
			<h1 class="text-center" style="font-family:Geneva;">
				<?php esc_html_e('ALBUM &nbsp; GALLERY &nbsp; SETTINGS', 'new-album-gallery'); ?>
			</h1>
			<hr>
			<?php
			require_once 'include/album-gallery-settings.php';
		}

		public function _ag_ajax_callback_function($id)
		{
			$thumbnail = wp_get_attachment_image_src($id, 'medium', true);
			$attachment = get_post($id); // $id = attachment id
			$description = $attachment->post_content; // desc
			?>
			<li class="image-slide">
				<img class="new-image-slide" src="<?php echo esc_url($thumbnail[0]); ?>"
					alt="<?php echo esc_html(get_the_title($id)); ?>" style="height: 150px; width: 98%; border-radius: 8px;">
				<input type="hidden" id="image-slide-ids[]" name="image-slide-ids[]" value="<?php echo esc_attr($id); ?>" />
				<select id="image-slide-type[]" name="image-slide-type[]" class="form-control" style="width: 100%;"
					value="<?php echo esc_attr($slide_type); ?>">
					<option value="i" <?php
					if ($slide_type == 'i') {
						echo 'selected=selected';
					}
					?>>Image</option>
					<option value="v" <?php
					if ($slide_type == 'v') {
						echo 'selected=selected';
					}
					?>>Video</option>
				</select>
				<!-- Image Title-->
				<input type="text" name="image-slide-title[]" id="image-slide-title[]" style="width: 100%;" placeholder="Title Here"
					value="<?php echo esc_html(get_the_title($id)); ?>">
				<input type="text" name="image-slide-link[]" id="image-slide-link[]" style="width: 100%;" placeholder="Enter URL"
					value="<?php echo esc_url($slide_link); ?>">
				<input type="button" name="remove-image-slide" id="remove-image-slide" style="width: 100%;" class="button"
					value="Delete">
			</li>
			<?php
		}

		public function ajax_album_gallery()
		{
			if (current_user_can('manage_options')) {
				if (isset($_POST['ag_add_images_nonce']) && wp_verify_nonce($_POST['ag_add_images_nonce'], 'ag_add_images')) {
					echo esc_attr($this->_ag_ajax_callback_function($_POST['slideId']));
				} else {
					print 'Sorry, your nonce did not verify.';
					exit;
				}
			}
		}

		public function _ag_save_settings($post_id)
		{
			if (current_user_can('manage_options')) {
				if (isset($_POST['ag_save_nonce'])) {
					if (isset($_POST['ag_save_nonce']) && wp_verify_nonce($_POST['ag_save_nonce'], 'ag_save_settings')) {

						$loop_lightbox = sanitize_text_field($_POST['loop_lightbox']);
						$hide_close_btn_mobile = sanitize_text_field($_POST['hide_close_btn_mobile']);
						$remove_bars_mobile = sanitize_text_field($_POST['remove_bars_mobile']);
						$hide_bars_delay = sanitize_text_field($_POST['hide_bars_delay']);
						$hover_effects = sanitize_text_field($_POST['hover_effects']);
						$animations = sanitize_text_field($_POST['animations']);

						$i = 0;
						$image_ids = array();
						$image_titles = array();
						$image_type = array();
						$slide_link = array();
						$image_ids_val = isset($_POST['image-slide-ids']) ? (array) $_POST['image-slide-ids'] : array();
						$image_ids_val = array_map('sanitize_text_field', $image_ids_val);

						foreach ($image_ids_val as $image_id) {
							$image_ids[] = sanitize_text_field($_POST['image-slide-ids'][$i]);
							$image_titles[] = sanitize_text_field($_POST['image-slide-title'][$i]);
							$image_type[] = sanitize_text_field($_POST['image-slide-type'][$i]);
							$slide_link[] = sanitize_text_field($_POST['image-slide-link'][$i]);

							$single_image_update = array(
								'ID' => $image_id,
								'post_title' => $image_titles[$i],
							);
							wp_update_post($single_image_update);
							$i++;
						}

						$album_gallery_settings = array(
							'image-slide-ids' => $image_ids,
							'image-slide-title' => $image_titles,
							'image-slide-type' => $image_type,
							'image-slide-link' => $slide_link,
							'loop_lightbox' => $loop_lightbox,
							'hide_close_btn_mobile' => $hide_close_btn_mobile,
							'remove_bars_mobile' => $remove_bars_mobile,
							'hide_bars_delay' => $hide_bars_delay,
							'hover_effects' => $hover_effects,
							'animations' => $animations,
						);


						$awl_album_gallery_shortcode_setting = 'awl_ag_settings_' . $post_id;
						update_post_meta($post_id, $awl_album_gallery_shortcode_setting, json_encode($album_gallery_settings));
					} else {
						print 'Sorry, your nonce did not verify.';
						exit;
					}
				}
			}//end _ag_save_settings()
		}

		public function _ag_column_page()
		{
			require 'include/album-gallery-column-settings.php';
		}

		public function _ag_doc_page()
		{
			require 'include/docs.php';
		}

		// theme page
		public function _ag_theme_page()
		{
			require 'our-theme/awp-theme.php';
		}

	}//end class

	// Plugin Recommend
	add_action('tgmpa_register', 'AGP_TXTDM_plugin_recommend');
	function AGP_TXTDM_plugin_recommend()
	{
		$plugins = array(
			array(
				'name' => 'Animated Live Wall',
				'slug' => 'animated-live-wall',
				'required' => false,
			),
			array(
				'name' => 'Contact Form Widget',
				'slug' => 'new-contact-form-widget/',
				'required' => false,
			),
			array(
				'name' => 'Grid Gallery - Photo Image Grid Gallery',
				'slug' => 'new-grid-gallery',
				'required' => false,
			),
		);
		tgmpa($plugins);
	}

	// register sf scripts
	function awp_sf_register_scripts()
	{

		wp_enqueue_script('jquery');
		// js
		wp_register_script('nag-isotope-js', AG_PLUGIN_URL . 'assets/js/isotope.pkgd.js', array('jquery'), '', true);
		wp_register_script('nag-imagesloaded-js', AG_PLUGIN_URL . 'assets/js/imagesloaded.pkgd.js', array('jquery'), '', true);

		// PhotoBox Lightbox
		// layout 1 CSS and JS start
		wp_register_style('nag-photobox-css', AG_PLUGIN_URL . 'assets/lightbox/photobox/photobox.css'); // v2.2.1
		wp_register_script('nag-photobox-js', AG_PLUGIN_URL . 'assets/lightbox/photobox/jquery.photobox.js', array('jquery'), '2.2.1', true);

		// css
		wp_register_style('nag-bootstrap-css', AG_PLUGIN_URL . 'assets/css/bootstrap-front.css');
		wp_register_style('nag-animate-css', AG_PLUGIN_URL . 'assets/css/awl-animate.css');
		wp_register_style('nag-hover-stack-style-css', AG_PLUGIN_URL . 'assets/css/awl-hover-stack-style.css');
		wp_register_style('nag-hover-overlay-effects-css', AG_PLUGIN_URL . 'assets/css/awl-hover-overlay-effects.css');
		wp_register_style('nag-hover-overlay-effects-style-css', AG_PLUGIN_URL . 'assets/css/awl-hover-overlay-effects-style.css');

	}
	add_action('wp_enqueue_scripts', 'awp_sf_register_scripts');

	$ag_gallery_object = new Awl_Album_Gallery();
	require_once 'shortcode.php';
	require_once 'class-tgm-plugin-activation.php';
}
?>