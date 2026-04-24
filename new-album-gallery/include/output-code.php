<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

// Helper function to render a single album gallery
function agp_render_album_gallery($post_id)
{
	ob_start();
	agp_enqueue_frontend_assets_once();

	$album_gallery_id = (int) $post_id;
	$all_albums = array('p' => $album_gallery_id, 'post_type' => 'album_gallery', 'orderby' => 'ASC');
	$loop = new WP_Query($all_albums);

	while ($loop->have_posts()) : $loop->the_post();
		$current_id = get_the_ID();

		// Robust data decoding: handle both JSON strings and legacy serialized arrays
		$jsonData = get_post_meta($current_id, 'awl_ag_settings_' . $current_id, true);
		if (is_string($jsonData)) {
			$album_gallery_settings = json_decode($jsonData, true);
		} else {
			$album_gallery_settings = $jsonData;
		}

		if (!isset($album_gallery_settings['image-slide-ids']) || count($album_gallery_settings['image-slide-ids']) === 0) {
			continue;
		}

		// Settings extraction with defaults
		$image_title = isset($album_gallery_settings['image_title']) ? $album_gallery_settings['image_title'] : "no";
		$column_settings = isset($album_gallery_settings['column_settings']) ? $album_gallery_settings['column_settings'] : "true";
		$gal_thumb_size = isset($album_gallery_settings['gal_thumb_size']) ? $album_gallery_settings['gal_thumb_size'] : "medium";
		$loop_lightbox = isset($album_gallery_settings['loop_lightbox']) ? $album_gallery_settings['loop_lightbox'] : "true";
		$ags_auto_play = isset($album_gallery_settings['ags_auto_play']) ? $album_gallery_settings['ags_auto_play'] : "false";
		$ags_delay = isset($album_gallery_settings['ags_delay']) ? (int)$album_gallery_settings['ags_delay'] : 3000;
		$animations = isset($album_gallery_settings['animations']) ? $album_gallery_settings['animations'] : "wobble";
		$hover_effects = isset($album_gallery_settings['hover_effects']) ? $album_gallery_settings['hover_effects'] : "stacks";
		$hover_stack_effect = isset($album_gallery_settings['hover_stack_effect']) ? $album_gallery_settings['hover_stack_effect'] : "twisted";
		$hover_overlay_effect = isset($album_gallery_settings['hover_overlay_effect']) ? $album_gallery_settings['hover_overlay_effect'] : "sixth-effect";
		
		$gallery_bottom_thumb = isset($album_gallery_settings['gallery_bottom_thumb']) ? $album_gallery_settings['gallery_bottom_thumb'] : "true";
		$titlebar_font_size = isset($album_gallery_settings['titlebar_font_size']) ? (int)$album_gallery_settings['titlebar_font_size'] : 16;
		$album_title_display = isset($album_gallery_settings['album_title']) ? $album_gallery_settings['album_title'] : "yes";
		$title_color = isset($album_gallery_settings['title_color']) ? $album_gallery_settings['title_color'] : "#000000";
		$title_font_size = isset($album_gallery_settings['title_font_size']) ? (int)$album_gallery_settings['title_font_size'] : 20;

		// Album Gallery features


		// Column logic
		$column_opt = get_option('album_gallery_column_settings');
		$skeleton_loading = isset($column_opt['skeleton_loading']) ? $column_opt['skeleton_loading'] : 'true';
		$skeleton_class = ($skeleton_loading === 'true') ? 'nag-skeleton nag-loading' : '';
		if ($column_settings == "false") {
			$col_lg = isset($album_gallery_settings['col_large_desktops']) ? $album_gallery_settings['col_large_desktops'] : "col-lg-6";
			$col_md = isset($album_gallery_settings['col_desktops']) ? $album_gallery_settings['col_desktops'] : "col-md-4";
			$col_sm = isset($album_gallery_settings['col_tablets']) ? $album_gallery_settings['col_tablets'] : "col-sm-4";
			$col_xs = isset($album_gallery_settings['col_phones']) ? $album_gallery_settings['col_phones'] : "col-xs-6";
		} else {
			$col_lg = isset($column_opt['col_large_desktops']) ? $column_opt['col_large_desktops'] : "col-lg-4";
			$col_md = isset($column_opt['col_desktops']) ? $column_opt['col_desktops'] : "col-md-4";
			$col_sm = isset($column_opt['col_tablets']) ? $column_opt['col_tablets'] : "col-sm-4";
			$col_xs = isset($column_opt['col_phones']) ? $column_opt['col_phones'] : "col-xs-6";
		}

		// Prepare JSON Gallery Data for LightGallery v2
		$gallery_data = array();
		$count = 0;
		foreach ($album_gallery_settings['image-slide-ids'] as $attachment_id) {
			$full = wp_get_attachment_image_src($attachment_id, 'full', true);
			$thumb = wp_get_attachment_image_src($attachment_id, 'thumbnail', true);
			$details = get_post($attachment_id);
			$stype = isset($album_gallery_settings['image-slide-type'][$count]) ? $album_gallery_settings['image-slide-type'][$count] : 'i';
			$slink = isset($album_gallery_settings['image-slide-link'][$count]) ? $album_gallery_settings['image-slide-link'][$count] : '';
			
			$link_url = $full[0];
			if ($stype == 'v') {
				if (strpos($slink, 'youtube') !== false) {
					if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $slink, $match)) {
						$link_url = 'https://www.youtube.com/watch?v=' . $match[1];
					}
				} elseif (strpos($slink, 'vimeo') !== false) {
					if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $slink, $regs)) {
						$link_url = 'https://vimeo.com/' . $regs[3];
					}
				}
			}

			// LightGallery expected structure for dynamic mode
			$caption = ($image_title === "yes" && !empty($details->post_title)) ? '<h4>' . esc_html($details->post_title) . '</h4>' : '';
			

			$gallery_item = array(
				'src'     => esc_url($link_url),
				'thumb'   => esc_url($thumb[0]),
				'subHtml' => !empty($caption) ? $caption : ' ',
			);
			if ($stype == 'v') {
				$gallery_item['video'] = true;
			}
			$gallery_data[] = $gallery_item;
			$count++;
		}

		// Output HTML
		?>
<?php
			// Calculate CSS variables for dynamic styling
			$ag_vars = array(
				'--ag-title-color'    => esc_attr($title_color),
				'--ag-title-size'     => (int)$title_font_size . 'px',
				'--ag-lb-title-size'  => (int)$titlebar_font_size . 'px',
			);

			$style_attr = '';
			foreach ($ag_vars as $key => $val) {
				$style_attr .= "$key: $val; ";
			}
			?>
		<div id="album_gallery_<?php echo (int) $album_gallery_id; ?>"
			class="awl-ag-col <?php echo esc_attr("$col_lg $col_md $col_sm $col_xs"); ?> album-gallery nag-gallery-container lg-id-<?php echo (int)$album_gallery_id; ?>"
			style="<?php echo esc_attr($style_attr); ?>"
			data-gallery-json="<?php echo esc_attr(wp_json_encode($gallery_data)); ?>"
			data-lg-config='<?php echo esc_attr(wp_json_encode(array(
				"loop" => ($loop_lightbox === "true"),
				"thumbnail" => ($gallery_bottom_thumb === "true"),
				"autoplay" => ($ags_auto_play === "true"),
				"pause" => (int)$ags_delay,
				"addClass" => "lg-id-" . (int)$album_gallery_id // Tag the lightbox container
			))); ?>'>

			<div class="album_wrapper nag-album-cover">
				
				<?php if ($album_title_display == "yes") {
					$ag_title = get_the_title($current_id); ?>
					<div class="album_title_div">
						<p class="album_title-dynamic"><?php echo esc_html($ag_title); ?></p>
					</div>
				<?php } ?>

				<?php 
				$first_id = isset($album_gallery_settings['image-slide-ids'][0]) ? (int)$album_gallery_settings['image-slide-ids'][0] : 0;
				if (!$first_id) {
					continue;
				}
				$full_img = wp_get_attachment_image_src($first_id, 'full', true);
				$medium_img = wp_get_attachment_image_src($first_id, 'medium', true);
				$attach_details = get_post($first_id);
				
				// Determine thumbnail URL based on settings
				$thumbnail_url = $medium_img[0];
				if ($gal_thumb_size == "thumbnail") $thumbnail_url = wp_get_attachment_image_src($first_id, 'thumbnail', true)[0];
				if ($gal_thumb_size == "large") $thumbnail_url = wp_get_attachment_image_src($first_id, 'large', true)[0];
				if ($gal_thumb_size == "full") $thumbnail_url = $full_img[0];

				$cover_href = $gallery_data[0]['src'];
				$cover_type = (isset($gallery_data[0]['video']) && $gallery_data[0]['video']) ? 'video' : 'image';
				$cover_title = esc_attr($attach_details->post_title);
				?>

				<?php if ($hover_effects == "none") { ?>
					<a href="<?php echo esc_url($cover_href); ?>" data-type="<?php echo esc_attr($cover_type); ?>" class="nag-trigger" title="<?php echo esc_attr($cover_title); ?>">
						<div class="<?php echo esc_attr($skeleton_class); ?>">
							<img src="<?php echo esc_url($thumbnail_url); ?>" class="animated <?php echo esc_attr($animations); ?>" alt="<?php echo esc_attr($cover_title); ?>">
						</div>
					</a>
				<?php } else if ($hover_effects == "stacks") { ?>
					<a href="<?php echo esc_url($cover_href); ?>" data-type="<?php echo esc_attr($cover_type); ?>" class="nag-trigger" title="<?php echo esc_attr($cover_title); ?>">
						<div class="group">
							<div class="stack <?php echo ($hover_stack_effect != 'stack') ? esc_attr($hover_stack_effect) : ''; ?> animated <?php echo esc_attr($animations); ?>">
								<div class="<?php echo esc_attr($skeleton_class); ?>">
									<img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($cover_title); ?>">
								</div>
							</div>
						</div>
					</a>
				<?php } else if ($hover_effects == "overlay") { ?>
					<a href="<?php echo esc_url($cover_href); ?>" data-type="<?php echo esc_attr($cover_type); ?>" class="nag-trigger" title="<?php echo esc_attr($cover_title); ?>">
						<div class="view <?php echo esc_attr($hover_overlay_effect); ?> animated <?php echo esc_attr($animations); ?>">
							<div class="<?php echo esc_attr($skeleton_class); ?>">
								<img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($cover_title); ?>">
							</div>
							<div class="mask"></div>
						</div>
					</a>
				<?php } ?>
		</div>
		</div>
<?php
	endwhile;
	wp_reset_postdata();
	return ob_get_clean();
}
?>