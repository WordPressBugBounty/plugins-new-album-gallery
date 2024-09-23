<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$album_gallery_id = esc_attr($post_id['id']);

if (!function_exists('is_ag_serialized')) {
    function is_ag_serialized($str) {
        return ($str == serialize(false) || @unserialize($str) !== false);
    }
}
$all_albums = array(
	'p' => $album_gallery_id,
	'post_type' => 'album_gallery',
	'orderby' => 'ASC',
);
$loop = new WP_Query($all_albums);

while ($loop->have_posts()):
	$loop->the_post();

	$post_id = esc_attr(get_the_ID());
	
	// Retrieve the base64 encoded data
	$encodedData = get_post_meta($post_id, 'awl_ag_settings_' . $post_id, true);

	// Decode the base64 encoded data
	$decodedData = base64_decode($encodedData);

	// Check if the data is serialized
	if (is_ag_serialized($decodedData)) {

		// The data is serialized, so unserialize it
		$album_gallery_settings = unserialize($decodedData);
		// Optionally, convert the unserialized data to JSON and save it back in base64 encoding for future access
		// This step is optional but recommended to transition your data format

		$jsonEncodedData = json_encode($album_gallery_settings);
		update_post_meta($post_id, 'awl_ag_settings_' . $post_id, $jsonEncodedData);

		// Now, to use the newly saved format, fetch and decode again
		$encodedData = get_post_meta($post_id, 'awl_ag_settings_' . $post_id, true);
		$album_gallery_settings = json_decode(($encodedData), true);

	} else {
		// Assume the data is in JSON format
		$jsonData = get_post_meta($post_id, 'awl_ag_settings_' . $post_id, true);
		// Decode the JSON string into an associative array
		$album_gallery_settings = json_decode($jsonData, true); // Ensure true is passed to get an associative array
	}

	// main settings
	$loop_lightbox = $album_gallery_settings['loop_lightbox'];
	$hide_bars_delay = $album_gallery_settings['hide_bars_delay'];
	$hide_close_btn_mobile = $album_gallery_settings['hide_close_btn_mobile'];
	$remove_bars_mobile = $album_gallery_settings['remove_bars_mobile'];
	$animations = $album_gallery_settings['animations'];
	$hover_effects = $album_gallery_settings['hover_effects'];

	// columns settings
	$album_gallery_column_settings = get_option('album_gallery_column_settings');
	if (isset($album_gallery_column_settings['col_large_desktops'])) {
		$col_large_desktops = $album_gallery_column_settings['col_large_desktops'];
	} else {
		$col_large_desktops = 'col-lg-4';
	}
	if (isset($album_gallery_column_settings['col_desktops'])) {
		$col_desktops = $album_gallery_column_settings['col_desktops'];
	} else {
		$col_desktops = 'col-md-4';
	}
	if (isset($album_gallery_column_settings['col_tablets'])) {
		$col_tablets = $album_gallery_column_settings['col_tablets'];
	} else {
		$col_tablets = 'col-sm-4';
	}
	if (isset($album_gallery_column_settings['col_phones'])) {
		$col_phones = $album_gallery_column_settings['col_phones'];
	} else {
		$col_phones = 'col-xs-6';
	}

	if (isset($album_gallery_settings['image-slide-ids']) && count($album_gallery_settings['image-slide-ids']) > 0) {
		$count = 0; ?>
		<div id="album_gallery_<?php echo esc_attr($album_gallery_id); ?>"
			class="awp_center">
			<?php

			foreach ($album_gallery_settings['image-slide-ids'] as $attachment_id) {
				$thumb = wp_get_attachment_image_src($attachment_id, 'thumb', true);
				$thumbnail = wp_get_attachment_image_src($attachment_id, 'thumbnail', true);
				$medium = wp_get_attachment_image_src($attachment_id, 'medium', true);
				$large = wp_get_attachment_image_src($attachment_id, 'large', true);
				$full = wp_get_attachment_image_src($attachment_id, 'full', true);
				$attachment_details = get_post($attachment_id);
				$title = $attachment_details->post_title;
				$slide_type = $album_gallery_settings['image-slide-type'][$count];
				$slide_link = $album_gallery_settings['image-slide-link'][$count];
				$album_image_title = get_the_title($attachment_id);
				if (strpos($slide_link, 'youtube') !== false) {
					$lightboxop = 'pw-lightbox';
					$vedio_class = 'youtube';
					$video_icon = 'fab fa-youtube';
					if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $slide_link, $match)) {
						$vedio_id = $match[1];
						$link_url = 'https://www.youtube.com/embed/' . $vedio_id;
					}
				} elseif (strpos($slide_link, 'vimeo') !== false) {
					$lightboxop = 'pw-lightbox';
					$vedio_class = 'vemio';
					$video_icon = 'fab fa-vimeo';
					if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $slide_link, $regs)) {
						$vedio_id = $regs[3];
						$link_url = 'https://player.vimeo.com/video/' . $vedio_id;
					}
				}
				?>
				<div class=" <?php echo esc_attr($col_desktops); ?> <?php echo esc_attr($col_large_desktops); ?> <?php echo esc_attr($col_tablets); ?> <?php echo esc_attr($col_phones); ?> 
			<?php
			if ($count > 0) {
				echo 'hidden';
			}
			?>
			">
					<?php if ($hover_effects == 'none') { ?>
						<!-- None Effect -->
						<a href="
					<?php
					if ($slide_type == 'i') {
						echo esc_attr($full[0]);
					} else if ($slide_type == 'v') {
						echo esc_url($link_url);
					}
					?>
					" <?php
					if ($slide_type == 'v') {
						echo 'rel="video"';
					}
					?>
							class="swipebox-<?php echo esc_attr($album_gallery_id); ?>" title="<?php echo esc_html($title); ?>">
							<img src="<?php echo esc_url($medium[0]); ?>" class="animated <?php echo esc_attr($animations); ?>"
								alt="<?php echo esc_html($album_image_title); ?>">
						</a>
					<?php } else if ($hover_effects == 'stacks') { ?>

							<!-- Stacks Hover Effect -->
							<a href="<?php if ($slide_type == 'i') {
								echo esc_attr($full[0]);
							} else if ($slide_type == 'v') {
								echo esc_url($link_url);
							}
							?>
					" <?php
					if ($slide_type == 'v') {
						echo 'rel="video"';
					}
					?>
								class="swipebox-<?php echo esc_attr($album_gallery_id); ?>" title="<?php echo esc_html($title); ?>">
								<div class="group">
									<div class="stack twisted animated <?php echo esc_attr($animations); ?>">
										<img src="<?php echo esc_url($medium[0]); ?>" alt="<?php echo esc_html($album_image_title); ?>">
									</div>
								</div>
							</a>
					<?php } elseif ($hover_effects == 'overlay') { ?>
							<!-- Overlay Hover Effect -->
							<a class="swipebox-<?php echo esc_attr($album_gallery_id); ?>" href="
													<?php
													if ($slide_type == 'i') {
														echo esc_attr($full[0]);
													} elseif ($slide_type == 'v') {
														echo esc_url($link_url);
													}
													?>
					" <?php
					if ($slide_type == 'v') {
						echo 'rel="video"';
					}
					?> title="<?php echo esc_html($title); ?>">
								<div class="view fifth-effect animated <?php echo esc_attr($animations); ?>">
									<img src="<?php echo esc_url($medium[0]); ?>" alt="<?php echo esc_html($album_image_title); ?>">
									<div class="mask"></div>
								</div>
							</a>
					<?php } ?>
				</div>
				<?php
				$count++;
			}// end of attachment foreach  ?>
		</div>
		<?php
	} else {
		_e('Sorry! No Images Found In Album Gallery', AGP_TXTDM);
		echo ": [AGAL id=$post_id]";
	} // end of if else of slides available check into slider

endwhile;
?>
<style>
	.awp_center {
		text-align: center !important;
	}

	<?php
	if ($col_large_desktops == 'col-lg-3') {
		?>
		.stack {
			height: 100px;
		}

	<?php } ?>
	<?php
	if ($col_large_desktops == 'col-lg-2') {
		?>
		.fifth-effect .mask {
			border: 45px solid rgba(0, 0, 0, 0.7);
		}

		<?php
	} elseif ($col_large_desktops == 'col-lg-3') {
		?>
		.fifth-effect .mask {
			border: 85px solid rgba(0, 0, 0, 0.7);
		}

		<?php
	} else {
		?>
		.fifth-effect .mask {
			border: 100px solid rgba(0, 0, 0, 0.7);
		}

	<?php } ?>
	.col-lg-12 .stack {
		margin: 3% 36%;
	}

	.col-lg-12 .view {
		margin: 5% 37%;
	}

	.col-lg-6 .stack {
		margin: 6% 22%;
	}

	.col-lg-6 .view {
		margin: 5% 22%;
	}

	.col-lg-4 .stack {
		margin: 10% 7%;
	}

	.col-lg-4 .view {
		margin: 5% 6%;
	}

	.col-lg-3 .stack {
		margin: 15% 3%;
	}

	.col-lg-3 .view {
		margin: 5% 1%;
	}


	<?php
	if ($col_desktops == 'col-md-2') {
		?>
		.fifth-effect .mask {
			border: 45px solid rgba(0, 0, 0, 0.7);
		}

		<?php
	} elseif ($col_desktops == 'col-md-3') {
		?>
		.fifth-effect .mask {
			border: 85px solid rgba(0, 0, 0, 0.7);
		}

		<?php
	} else {
		?>
		.fifth-effect .mask {
			border: 100px solid rgba(0, 0, 0, 0.7);
		}

	<?php } ?>
	<?php
	if ($col_desktops == 'col-xs-12') {
		?>
		.fifth-effect .mask {
			border: 45px solid rgba(0, 0, 0, 0.7);
		}

		<?php
	} elseif ($col_desktops == 'col-xs-12') {
		?>
		.fifth-effect .mask {
			border: 85px solid rgba(0, 0, 0, 0.7);
		}

		<?php
	} else {
		?>
		.fifth-effect .mask {
			border: 100px solid rgba(0, 0, 0, 0.7);
		}

	<?php } ?>
	.view {
		<?php
		if ($col_desktops == 'col-md-12') {
			?>
			margin: 0 0 5% 0%;
			<?php
		} elseif ($col_desktops == 'col-md-6') {

			?>
			margin: 0 0 5% 10%;
			<?php
		} elseif ($col_desktops == 'col-md-4') {

			?>
			margin: 0 0 5% 0%;
			<?php
		} elseif ($col_desktops == 'col-md-3') {

			?>
			margin: 0 0 5% 0%;
		<?php } ?>

		<?php
		if ($col_tablets == 'col-sm-12') {
			?>
			margin: 5% 33%;
			<?php
		} elseif ($col_tablets == 'col-sm-6') {

			?>
			margin: 5% 15%;
			<?php
		} elseif ($col_tablets == 'col-sm-4') {

			?>
			margin: 5% 0%;
			<?php
		} elseif ($col_tablets == 'col-sm-3') {

			?>
			margin: 5% 0%;
		<?php } ?>
	}

	.mask {
		cursor: pointer;
	}
</style>
<script type="application/javascript">
	jQuery(document).ready(function () {
		// PhotoBox
		jQuery('#album_gallery_<?php echo esc_js($album_gallery_id); ?>').photobox('a');
		// or with a fancier selector and some settings, and a callback:
		jQuery('#album_gallery_<?php echo esc_js($album_gallery_id); ?>').photobox('a:first', { thumbs: false, time: 0 }, imageLoaded);
		function imageLoaded() {
			console.log('image has been loaded...');
		}


		//Isotope function for masonary
		var $grid = jQuery('.album_gallery_main').isotope({
			// options...
			itemSelector: '.album_gallery_single',
		});
		// layout Isotope after each image loads
		$grid.imagesLoaded().progress(function () {
			$grid.isotope('layout');
		});
	});
</script>