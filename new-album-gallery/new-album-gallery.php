<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

/*
@package New Album Gallery
Plugin Name: Album Gallery
Plugin URI: http://awplife.com/
Description: A responsive album gallery to display your photos and videos in beautiful grid layouts.
Version: 2.0.0
Author: A WP Life
Author URI: http://awplife.com/
Text Domain: new-album-gallery
Domain Path: /languages
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if (! class_exists('Awl_Album_Gallery')) {

	class Awl_Album_Gallery
	{

		public function __construct()
		{
			$this->_constants();
			$this->_hooks();
		}

		protected function _constants()
		{

			//Plugin Version
			define('AG_PLUGIN_VER', '2.0.0');

			//Plugin Text Domain
			define('AGP_TXTDM', 'new-album-gallery');

			//Plugin Name
			define('AG_PLUGIN_NAME', 'Album Gallery');

			//Plugin Slug
			define('AG_PLUGIN_SLUG', 'album_gallery');

			//Plugin Directory Path
			define('AG_PLUGIN_DIR', plugin_dir_path(__FILE__));

			//Plugin Driectory URL
			define('AG_PLUGIN_URL', plugin_dir_url(__FILE__));

			/**
			 * Create a key for the .htaccess secure download link.
			 * @uses    NONCE_KEY     Defined in the WP root config.php
			 */
			define('AG_SECURE_KEY', md5(NONCE_KEY));
		} // end of constructor function

		/**
		 * Setup the default filters and actions
		 */
		protected function _hooks()
		{

			//add gallery menu item, change menu filter for multisite
			add_action('admin_menu', array($this, 'ag_gallery_menu'), 101);

			//add gallery menu item, change menu filter for multisite
			add_action('admin_menu', array($this, 'ag_gallery_menu_docs'), 101);

			//Create Album Gallery Custom Post
			add_action('init', array($this, '_Album_Gallery'));

			//Add Meta Box To Custom Post
			add_action('add_meta_boxes', array($this, '_ag_admin_add_meta_box'));

			add_action('wp_ajax_album_gallery_js', array(&$this, 'ajax_album_gallery'));

			add_action('save_post', array(&$this, '_ag_save_settings'));

			//Shortcode Compatibility in Text Widegts
			add_filter('widget_text', 'do_shortcode');

			// add pfg cpt shortcode column - manage_{$post_type}_posts_columns
			add_filter('manage_album_gallery_posts_columns', array(&$this, 'set_album_gallery_shortcode_column_name'));

			// add pfg cpt shortcode column data - manage_{$post_type}_posts_custom_column
			add_action('manage_album_gallery_posts_custom_column', array(&$this, 'custom_album_gallery_shodrcode_data'), 10, 2);

			add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts_in_header'));

			// Admin Enqueues for Settings
			add_action('admin_enqueue_scripts', array($this, 'ag_admin_scripts_enqueues'));




			// save global settings ajax callback
			add_action('wp_ajax_ag_save_column_settings', array($this, 'ajax_save_column_settings'));

		}// end of hook function



		public function enqueue_scripts_in_header()
		{
			wp_enqueue_script('jquery');
		}

		public function ag_admin_scripts_enqueues($hook)
		{
			global $post_type;
			
			// Only load on Album Gallery post editing screen or Album Gallery menu pages
			$is_album_page = ($post_type == 'album_gallery') || 
							 (strpos($hook, 'album_gallery') !== false) || 
							 (strpos($hook, 'ag-column') !== false) || 
							 (strpos($hook, 'ag-our-plugins') !== false) || 
							 (strpos($hook, 'ag-our-themes') !== false) || 
							 (isset($_GET['page']) && ($_GET['page'] == 'ag-column-page' || $_GET['page'] == 'ag-our-plugins' || $_GET['page'] == 'ag-our-themes' || $_GET['page'] == 'ag-doc-page'));
			
			if ($is_album_page) {
				wp_enqueue_media();
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_script('wp-color-picker');
				
				// Cache-busting version for production
				$ag_ver = AG_PLUGIN_VER; 

				// CSS
				wp_enqueue_style('awl-ag-modern-admin-css', AG_PLUGIN_URL . 'assets/css/admin-modern.css', array(), AG_PLUGIN_VER);
				wp_enqueue_style('awl-ag-frontend-style-css', AG_PLUGIN_URL . 'assets/css/frontend-style.css', array(), AG_PLUGIN_VER);
				wp_enqueue_style('awl-ag-animate-css', AG_PLUGIN_URL . 'assets/css/awl-animate.css', array(), $ag_ver);
				wp_enqueue_style('awl-ag-uploader-css', AG_PLUGIN_URL . 'assets/css/awl-ag-uploader.css', array(), $ag_ver);
				wp_enqueue_style('awl-ag-our-plugins-style-css', AG_PLUGIN_URL . 'assets/css/our-plugins-style.css', array(), $ag_ver);
				
				// JS
				wp_enqueue_script('awl-ag-admin-tabs-js', AG_PLUGIN_URL . 'assets/js/admin-tabs.js', array('jquery'), AG_PLUGIN_VER, true);
				wp_localize_script('awl-ag-admin-tabs-js', 'agp_i18n', array(
					'enabled'  => esc_html__('Enabled', 'new-album-gallery'),
					'disabled' => esc_html__('Disabled', 'new-album-gallery'),
					'uniform'  => esc_html__('Uniform', 'new-album-gallery'),
					'individual' => esc_html__('Individual', 'new-album-gallery'),
					'active'   => esc_html__('Slideshow Active', 'new-album-gallery'),
					'off'      => esc_html__('Slideshow Off', 'new-album-gallery'),
					'on_txt'   => esc_html__('On', 'new-album-gallery'),
					'off_txt'  => esc_html__('Off', 'new-album-gallery'),
					'title_on' => esc_html__('Title On', 'new-album-gallery'),
					'title_off'=> esc_html__('Title Off', 'new-album-gallery'),
				));

				wp_enqueue_script('awl-ag-uploader-js', AG_PLUGIN_URL . 'assets/js/awl-ag-uploader.js', array('jquery', 'jquery-ui-sortable'), AG_PLUGIN_VER, true);
				wp_localize_script('awl-ag-uploader-js', 'awl_ag_ajax_obj', array(
					'ajaxurl' => admin_url('admin-ajax.php'),
					'nonce'   => wp_create_nonce('album_gallery_js_nonce')
				));

				wp_enqueue_script('awl-ag-go-to-top-js',  AG_PLUGIN_URL . 'assets/js/go-to-top.js', array('jquery'), AG_PLUGIN_VER, true);
				wp_enqueue_script('awl-lg-color-picker-js', AG_PLUGIN_URL . 'assets/js/lg-color-picker.js', array('wp-color-picker'), AG_PLUGIN_VER, true);
				wp_enqueue_script('awl-ag-button-presets-js', AG_PLUGIN_URL . 'assets/js/button-presets.js', array('jquery', 'awl-lg-color-picker-js'), AG_PLUGIN_VER, true);
				wp_enqueue_script('awl-ag-admin-column-settings-js', AG_PLUGIN_URL . 'assets/js/admin-column-settings.js', array('jquery', 'wp-color-picker'), AG_PLUGIN_VER, true);
			}
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
			$post_id = (int) $post_id;
			switch ($column) {
				case 'album_gallery_shortcode':
					echo "<input type='text' class='button button-primary' id='album-gallery-shortcode-" . esc_attr($post_id) . "' value='[AGAL id=" . esc_attr($post_id) . "]' style='font-weight:bold; background-color:#32373C; color:#FFFFFF; text-align:center;' />";
					echo "<input type='button' class='button button-primary' onclick='return ALBUMCopyShortcode" . esc_attr($post_id) . "();' readonly value='" . esc_attr__('Copy', 'new-album-gallery') . "' style='margin-left:4px;' />";
					echo "<span id='copy-msg-" . esc_attr($post_id) . "' class='button button-primary' style='display:none; background-color:#32CD32; color:#FFFFFF; margin-left:4px; border-radius: 4px;'>" . esc_html__('copied', 'new-album-gallery') . "</span>";
?>
					<script>
						function ALBUMCopyShortcode<?php echo (int) $post_id; ?>() {
							var copyText = document.getElementById('album-gallery-shortcode-<?php echo (int) $post_id; ?>');
							copyText.select();
							document.execCommand('copy');

							//fade in and out copied message
							jQuery('#copy-msg-<?php echo (int) $post_id; ?>').fadeIn('1000', 'linear');
							jQuery('#copy-msg-<?php echo (int) $post_id; ?>').fadeOut(2500, 'swing');
						}
					</script>
				<?php
					break;
					break;
			}
		}

		/* Add Gallery menu*/
		public function ag_gallery_menu()
		{
			add_submenu_page(
				'edit.php?post_type=' . AG_PLUGIN_SLUG,
				esc_html__('Global Settings', 'new-album-gallery'),
				esc_html__('Global Settings', 'new-album-gallery'),
				'manage_options',
				'ag-column-page',
				array($this, '_ag_column_page')
			);
		}
		/* Add Gallery menu*/
		public function ag_gallery_menu_docs()
		{
			$help_menu = add_submenu_page('edit.php?post_type=' . AG_PLUGIN_SLUG, __('Docs', 'new-album-gallery'), __('Docs', 'new-album-gallery'), 'manage_options', 'ag-doc-page', array($this, '_ag_doc_page'));
			add_submenu_page('edit.php?post_type=' . AG_PLUGIN_SLUG, __('Our Plugins', 'new-album-gallery'), __('Our Plugins', 'new-album-gallery'), 'manage_options', 'ag-our-plugins', array($this, '_ag_our_plugins_page'));
			add_submenu_page('edit.php?post_type=' . AG_PLUGIN_SLUG, __('Our Themes', 'new-album-gallery'), __('Our Themes', 'new-album-gallery'), 'manage_options', 'ag-our-themes', array($this, '_ag_our_themes_page'));
		}

		/**
		 * Album Gallery Custom Post
		 * Create gallery post type in admin dashboard.
		 */
		public function _Album_Gallery()
		{
			$labels = array(
				'name'                => _x('Album Gallery', 'post type general name', 'new-album-gallery'),
				'singular_name'       => _x('Album Gallery', 'post type singular name', 'new-album-gallery'),
				'menu_name'           => __('Album Gallery', 'new-album-gallery'),
				'name_admin_bar'      => __('Album Gallery', 'new-album-gallery'),
				'parent_item_colon'   => __('Parent Item:', 'new-album-gallery'),
				'all_items'           => __('All Album Gallery', 'new-album-gallery'),
				'add_new_item'        => __('Add Album Gallery', 'new-album-gallery'),
				'add_new'             => __('Add Album Gallery', 'new-album-gallery'),
				'new_item'            => __('Album Gallery', 'new-album-gallery'),
				'edit_item'           => __('Edit Album Gallery', 'new-album-gallery'),
				'update_item'         => __('Update Album Gallery', 'new-album-gallery'),
				'search_items'        => __('Search Album Gallery', 'new-album-gallery'),
				'not_found'           => __('Album Gallery Not found', 'new-album-gallery'),
				'not_found_in_trash'  => __('Album Gallery Not found in Trash', 'new-album-gallery'),
			);

			$args = array(
				'label'               => __('Album Gallery', 'new-album-gallery'),
				'description'         => __('Custom Post Type For Album Gallery', 'new-album-gallery'),
				'labels'              => $labels,
				'supports'            => array('title'),
				'taxonomies'          => array(),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 65,
				'menu_icon'           => 'dashicons-images-alt',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
			);

			register_post_type('album_gallery', $args);
		}//end of post type function

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
			<div class="ag-shortcode-panel">
				<div class="ag-shortcode-item">
					<label for="ALBUMCopyShortcodeID"><?php esc_html_e('Single Album Shortcode', 'new-album-gallery'); ?></label>
					<div class="ag-copy-wrapper">
						<input type="text" id="ALBUMCopyShortcodeID" value="<?php echo esc_attr("[AGAL id=" . $post->ID . "]"); ?>" readonly>
						<button type="button" onclick="copyToClipboard('#ALBUMCopyShortcodeID', '#ag-copy-code-1')" class="ag-copy-btn" title="<?php esc_attr_e('Copy to Clipboard', 'new-album-gallery'); ?>">
							<span class="dashicons dashicons-clipboard"></span>
						</button>
					</div>
					<div id="ag-copy-code-1" class="ag-copy-status"><?php esc_html_e('Copied!', 'new-album-gallery'); ?></div>
					<p class="ag-help-text"><?php esc_html_e('Use this shortcode to display this specific album.', 'new-album-gallery'); ?></p>
				</div>
			</div>

			<script>
				function copyToClipboard(inputSelector, statusSelector) {
					var copyText = jQuery(inputSelector);
					copyText.select();
					document.execCommand("copy");
					
					jQuery(statusSelector).addClass('show');
					setTimeout(function() {
						jQuery(statusSelector).removeClass('show');
					}, 2000);
				}
			</script>
		<?php
		}


		public function ag_upload_multiple_images($post)
		{
			// Fetch existing settings
			$album_gallery_settings = get_post_meta($post->ID, 'awl_ag_settings_' . $post->ID, true);
			$album_gallery_settings = json_decode($album_gallery_settings, true);
		?>
			<div class="ag-upload-header-notices">
				<div class="ag-alert ag-alert-indigo">
					<div class="ag-alert-icon">
						<span class="dashicons dashicons-info-outline"></span>
					</div>
					<div class="ag-alert-content">
						<p><strong><?php esc_html_e('Pro Tip:', 'new-album-gallery'); ?></strong> <?php esc_html_e('The first image in your list will serve as the Album Gallery Cover.', 'new-album-gallery'); ?></p>
					</div>
				</div>
				<div class="ag-alert ag-alert-violet" style="margin-top: 12px;">
					<div class="ag-alert-icon">
						<span class="dashicons dashicons-lightbulb"></span>
					</div>
					<div class="ag-alert-content">
						<p><strong><?php esc_html_e('Best Practice:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Using consistent aspect ratios for all images ensures a professional look.', 'new-album-gallery'); ?></p>
					</div>
				</div>
			</div>

			<div class="ag-settings-tabs-wrapper">

		<?php
			include('include/album-gallery-settings.php');
		}


		public function _ag_ajax_callback_function($id, $type = 'i', $title = '', $link = '')
		{
			$thumbnail = wp_get_attachment_image_src($id, 'medium', true);
			$display_title = !empty($title) ? $title : get_the_title($id);
		?>
			<li class="ag-image-slide-card" id="ag-slide-<?php echo esc_attr($id); ?>">
				<div class="ag-slide-thumbnail">
					<img src="<?php echo esc_url($thumbnail[0]); ?>" alt="<?php echo esc_attr($display_title); ?>">
					<div class="ag-slide-badge">
						<span class="dashicons <?php echo ($type === 'v') ? 'dashicons-video-alt3' : 'dashicons-format-image'; ?>"></span>
					</div>
					<div class="ag-slide-actions-top">
						<div class="ag-remove-slide remove-single-image-slide" title="<?php esc_attr_e('Remove', 'new-album-gallery'); ?>">
							<span class="dashicons dashicons-trash"></span>
						</div>
					</div>
				</div>

				<div class="ag-slide-content">
					<input type="hidden" name="image-slide-ids[]" value="<?php echo esc_attr($id); ?>" />
					
					<div class="ag-slide-field">
						<input type="text" name="image-slide-title[]" placeholder="<?php esc_attr_e('Slide Title', 'new-album-gallery'); ?>" value="<?php echo esc_attr($display_title); ?>">
					</div>

					<div class="ag-slide-type-row">
						<select name="image-slide-type[]" class="ag-slide-type-select">
							<option value="i" <?php selected($type, 'i'); ?>><?php esc_html_e('Image', 'new-album-gallery'); ?></option>
							<option value="v" <?php selected($type, 'v'); ?>><?php esc_html_e('Video', 'new-album-gallery'); ?></option>
						</select>
					</div>

					<div class="ag-slide-field ag-video-link-field">
						<input type="text" name="image-slide-link[]" placeholder="<?php esc_attr_e('Video URL or Redirect Link', 'new-album-gallery'); ?>" value="<?php echo esc_url($link); ?>">
					</div>
				</div>

				<div class="ag-slide-footer">
					<div class="ag-drag-handle" title="<?php esc_attr_e('Drag to Reorder', 'new-album-gallery'); ?>">
						<span class="dashicons dashicons-move"></span>
					</div>
					<div class="ag-slide-id">#<?php echo esc_html($id); ?></div>
				</div>
			</li>
		<?php
		}


		public function ajax_album_gallery()
		{
			// Check nonce
			check_ajax_referer('album_gallery_js_nonce', 'security');

			if (isset($_POST['slideId'])) {
				$slide_id = absint(wp_unslash($_POST['slideId']));
				echo $this->_ag_ajax_callback_function($slide_id); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Output is escaped in _ag_ajax_callback_function
			}
			die;
		}


		/**
		 * Save Global Settings AJAX Callback
		 */
		public function ajax_save_column_settings() {
			check_ajax_referer('ag_column_save_nonce', 'nonce');
			
			if (!current_user_can('manage_options')) {
				wp_send_json_error('Unauthorized');
			}

			if (isset($_POST['data'])) {
				parse_str(wp_unslash($_POST['data']), $form_data);
				
				$settings = array(
					'col_large_desktops' => isset($form_data['col_large_desktops']) ? sanitize_text_field($form_data['col_large_desktops']) : 'col-lg-4',
					'col_desktops'       => isset($form_data['col_desktops']) ? sanitize_text_field($form_data['col_desktops']) : 'col-md-4',
					'col_tablets'        => isset($form_data['col_tablets']) ? sanitize_text_field($form_data['col_tablets']) : 'col-sm-4',
					'col_phones'         => isset($form_data['col_phones']) ? sanitize_text_field($form_data['col_phones']) : 'col-xs-6',
					'skeleton_loading'   => isset($form_data['skeleton_loading']) ? sanitize_text_field($form_data['skeleton_loading']) : 'false',
				);

				update_option('album_gallery_column_settings', $settings);
				wp_send_json_success();
			}
			wp_send_json_error('No data received');
		}


		public function _ag_save_settings($post_id)
		{
			// Check for autosave
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}

			// Check post type
			if (isset($_POST['post_type']) && 'album_gallery' !== wp_unslash($_POST['post_type'])) {
				return;
			}

			// Check permissions
			if (!current_user_can('edit_post', $post_id)) {
				return;
			}

			if (isset($_POST['ag_save_nonce'])) {
				if (!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ag_save_nonce'])), 'ag_save_settings')) {
					wp_die(esc_html__('Sorry, your nonce did not verify.', 'new-album-gallery'));
				}

				// Whitelist and Sanitize all settings
				$album_gallery_settings = array(
					// Main Settings
					'gal_thumb_size'       => isset($_POST['gal_thumb_size']) ? sanitize_text_field(wp_unslash($_POST['gal_thumb_size'])) : 'medium',
					'loop_lightbox'        => isset($_POST['loop_lightbox']) ? sanitize_text_field(wp_unslash($_POST['loop_lightbox'])) : 'true',
					'column_settings'      => isset($_POST['column_settings']) ? sanitize_text_field(wp_unslash($_POST['column_settings'])) : 'true',
					
					// Individual Column Settings
					'col_large_desktops'   => isset($_POST['col_large_desktops']) ? sanitize_text_field(wp_unslash($_POST['col_large_desktops'])) : 'col-lg-6',
					'col_desktops'         => isset($_POST['col_desktops']) ? sanitize_text_field(wp_unslash($_POST['col_desktops'])) : 'col-md-4',
					'col_tablets'          => isset($_POST['col_tablets']) ? sanitize_text_field(wp_unslash($_POST['col_tablets'])) : 'col-sm-4',
					'col_phones'           => isset($_POST['col_phones']) ? sanitize_text_field(wp_unslash($_POST['col_phones'])) : 'col-xs-6',
					
					// Title Settings
					'album_title'          => isset($_POST['album_title']) ? sanitize_text_field(wp_unslash($_POST['album_title'])) : 'yes',
					'title_font_size'      => isset($_POST['title_font_size']) ? absint(wp_unslash($_POST['title_font_size'])) : 20,
					'title_color'          => isset($_POST['title_color']) ? sanitize_hex_color(wp_unslash($_POST['title_color'])) : '#000000',
					
					// Lightbox Settings
					'image_title'          => isset($_POST['image_title']) ? sanitize_text_field(wp_unslash($_POST['image_title'])) : 'no',
					'titlebar_font_size'   => isset($_POST['titlebar_font_size']) ? absint(wp_unslash($_POST['titlebar_font_size'])) : 15,
					'gallery_bottom_thumb' => isset($_POST['gallery_bottom_thumb']) ? sanitize_text_field(wp_unslash($_POST['gallery_bottom_thumb'])) : 'true',
					'ags_auto_play'        => isset($_POST['ags_auto_play']) ? sanitize_text_field(wp_unslash($_POST['ags_auto_play'])) : 'false',
					'ags_delay'            => isset($_POST['ags_delay']) ? absint(wp_unslash($_POST['ags_delay'])) : 3000,
					
					
					// Effects
					'animations'           => isset($_POST['animations']) ? sanitize_text_field(wp_unslash($_POST['animations'])) : 'wobble',
					'hover_effects'        => isset($_POST['hover_effects']) ? sanitize_text_field(wp_unslash($_POST['hover_effects'])) : 'stacks',
					'hover_stack_effect'   => 'twisted',
					'hover_overlay_effect' => 'sixth-effect',
					
					// Images Data (Arrays)
					'image-slide-ids'      => isset($_POST['image-slide-ids']) ? array_map('absint', wp_unslash((array) $_POST['image-slide-ids'])) : array(),
					'image-slide-title'    => isset($_POST['image-slide-title']) ? array_map('sanitize_text_field', wp_unslash((array) $_POST['image-slide-title'])) : array(),
					'image-slide-type'     => isset($_POST['image-slide-type']) ? array_map('sanitize_text_field', wp_unslash((array) $_POST['image-slide-type'])) : array(),
					'image-slide-link'     => isset($_POST['image-slide-link']) ? array_map('esc_url_raw', wp_unslash((array) $_POST['image-slide-link'])) : array(),
				);

				// Save primarily
				$option_key = 'awl_ag_settings_' . $post_id;
				update_post_meta($post_id, $option_key, wp_json_encode($album_gallery_settings));

				// Update attachment titles if changed
				if (!empty($album_gallery_settings['image-slide-ids'])) {
					// Temporalily remove the hook to avoid recursion during attachment updates
					remove_action('save_post', array($this, '_ag_save_settings'));
					
					foreach ($album_gallery_settings['image-slide-ids'] as $index => $attachment_id) {
						if (isset($album_gallery_settings['image-slide-title'][$index])) {
							wp_update_post(array(
								'ID'         => $attachment_id,
								'post_title' => $album_gallery_settings['image-slide-title'][$index],
							));
						}
					}
					
					// Re-add the hook
					add_action('save_post', array($this, '_ag_save_settings'));
				}
			}
		} // end save setting


		public function _ag_column_page()
		{
			require_once('include/album-gallery-column-layout.php');
		}

		public function _ag_doc_page()
		{
			require_once('include/docs.php');
		}
		
		/**
		 * Image Gallery Our Plugins Page
		 * Fetches and displays plugins from WordPress.org author profile
		 */
		public function _ag_our_plugins_page()
		{
			require_once('include/our-plugins.php');
		}

		/**
		 * Image Gallery Our Themes Page
		 * Fetches and displays themes from WordPress.org author profile
		 */
		public function _ag_our_themes_page()
		{
			require_once('include/our-themes.php');
		}
	} // end of class

	// register sf scripts
	function agp_register_scripts()
	{

		wp_enqueue_script('jquery');
		//js

		// Unified Lightbox Initializer
		wp_register_script('nag-lightbox-init', AG_PLUGIN_URL . 'assets/js/nag-lightbox-init.js', array('jquery', 'nag-lightgallery-js'), AG_PLUGIN_VER, true);

		// LightGallery v1.10.0 (Fully GPL Compatible)
		wp_register_style('nag-lightgallery-css', AG_PLUGIN_URL . 'assets/vendor/lightgallery/css/lightgallery.min.css', array(), '1.10.0');
		wp_register_script('nag-lightgallery-js', AG_PLUGIN_URL . 'assets/vendor/lightgallery/js/lightgallery.min.js', array('jquery'), '1.10.0', true);
		wp_register_script('nag-lg-thumbnail', AG_PLUGIN_URL . 'assets/vendor/lightgallery/js/lg-thumbnail.min.js', array('nag-lightgallery-js'), '1.10.0', true);
		wp_register_script('nag-lg-autoplay', AG_PLUGIN_URL . 'assets/vendor/lightgallery/js/lg-autoplay.min.js', array('nag-lightgallery-js'), '1.10.0', true);
		wp_register_script('nag-lg-video', AG_PLUGIN_URL . 'assets/vendor/lightgallery/js/lg-video.min.js', array('nag-lightgallery-js'), '1.10.0', true);


		// css
		wp_register_style('awl-animate-css', AG_PLUGIN_URL . 'assets/css/awl-animate.css', array(), AG_PLUGIN_VER);
		wp_register_style('awl-hover-stack-style-css', AG_PLUGIN_URL . 'assets/css/awl-hover-stack-style.css', array(), AG_PLUGIN_VER);
		wp_register_style('awl-hover-overlay-effects-css', AG_PLUGIN_URL . 'assets/css/awl-hover-overlay-effects.css', array(), AG_PLUGIN_VER);
		wp_register_style('awl-hover-overlay-effects-style-css', AG_PLUGIN_URL . 'assets/css/awl-hover-overlay-effects-style.css', array(), AG_PLUGIN_VER);
		
	}
	add_action('wp_enqueue_scripts', 'agp_register_scripts');

	// Enqueue all front-end assets ONCE per request.
	if (! function_exists('agp_enqueue_frontend_assets_once')) {
		function agp_enqueue_frontend_assets_once()
		{
			static $agp_done = false;

			if (!$agp_done) {
				$agp_done = true;

				// JS
				wp_enqueue_script('nag-lightgallery-js');
				wp_enqueue_script('nag-lg-thumbnail');
				wp_enqueue_script('nag-lg-autoplay');
				wp_enqueue_script('nag-lg-video');
				wp_enqueue_script('nag-lightbox-init');

				// CSS
				wp_enqueue_style('nag-lightgallery-css');
				wp_register_style('awl-ag-frontend-style-css', AG_PLUGIN_URL . 'assets/css/frontend-style.css', array(), AG_PLUGIN_VER);
				wp_enqueue_style('awl-ag-frontend-style-css');
				wp_enqueue_style('awl-animate-css');
				wp_enqueue_style('awl-hover-stack-style-css');
				wp_enqueue_style('awl-hover-overlay-effects-css');
				wp_enqueue_style('awl-hover-overlay-effects-style-css');
			}


			// Conditional Assets (Skeleton)
			$column_opt = get_option('album_gallery_column_settings');
			$skeleton_loading = isset($column_opt['skeleton_loading']) ? $column_opt['skeleton_loading'] : 'true';
			if ($skeleton_loading === 'true') {
				wp_enqueue_script('nag-skeleton-js');
				wp_enqueue_style('nag-skeleton-css');
			}

			do_action('agp/enqueued_frontend');
		}
	}
	// The legacy Photobox binding and Isotope initialization are now handled by:
	// 1. agp_enqueue_frontend_assets_once()
	// 2. nag-lightbox-init.js
	// This removes redundant DOM traversal and improves performance.

	$ag_gallery_object = new Awl_Album_Gallery();
}
require_once('include/shortcode.php');
//output code fuction
require_once plugin_dir_path(__FILE__) . 'include/output-code.php';

?>