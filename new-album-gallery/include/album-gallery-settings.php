<?Php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
// js
wp_enqueue_script('awl-ag-bootstrap-js', AG_PLUGIN_URL . 'assets/js/bootstrap.js', array('jquery'), AG_PLUGIN_VER, true);
wp_enqueue_script('awl-ag-go-to-top-js', AG_PLUGIN_URL . 'assets/js/go-to-top.js', array('jquery'), AG_PLUGIN_VER, true);
// css
wp_enqueue_style('awl-styles-css', AG_PLUGIN_URL . 'assets/css/styles.css', array(), AG_PLUGIN_VER);
wp_enqueue_style('awl-animate-css', AG_PLUGIN_URL . 'assets/css/awl-animate.css', array(), AG_PLUGIN_VER);
wp_enqueue_style('awl-bootstrap-css', AG_PLUGIN_URL . 'assets/css/bootstrap.css', array(), AG_PLUGIN_VER);
wp_enqueue_style('awl-go-to-top-css', AG_PLUGIN_URL . 'assets/css/go-to-top.css', array(), AG_PLUGIN_VER);
wp_enqueue_style('awl-toogle-button-css', AG_PLUGIN_URL . 'assets/css/toogle-button.css', array(), AG_PLUGIN_VER);
wp_enqueue_style('awl-font-awesome-min-css', AG_PLUGIN_URL . 'assets/css/font-awesome.min.css', array(), AG_PLUGIN_VER);

?>
<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
<div class="row">
	<div class="col-lg-12 bhoechie-tab-container">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
			<div class="list-group">
				<a href="#" class="list-group-item active text-center">
					<span class="dashicons dashicons-format-image"></span><br />
					<?php esc_html_e('Add Images', 'new-album-gallery'); ?>
				</a>
				<a href="#" class="list-group-item text-center">
					<span class="dashicons dashicons-admin-generic"></span><br />
					<?php esc_html_e('Config', 'new-album-gallery'); ?>
				</a>
				<a href="#" class="list-group-item text-center">
					<span class="dashicons dashicons-admin-appearance"></span><br />
					<?php esc_html_e('Animation & Hover Effect', 'new-album-gallery'); ?>
				</a>
				<a href="#" class="list-group-item text-center">
					<span class="dashicons dashicons-cart"></span><br />
					<?php esc_html_e('Upgrade To Pro', 'new-album-gallery'); ?>
				</a>
			</div>
		</div>
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 bhoechie-tab">
			<div class="bhoechie-tab-content active">
				<h1>
					<?php esc_html_e('Add Images', 'new-album-gallery'); ?>
				</h1>
				<hr>
				<div id="album-gallery">
					<input type="button" id="remove-all-image-slides" name="remove-all-image-slides"
						class="button button-large remove-all-image-slides" rel=""
						value="<?php esc_html_e('Delete All Images', 'new-album-gallery'); ?>">
					<ul id="remove-image-slides" class="imagebox">
						<?php
						$post_id = esc_attr($post->ID);

						// Assume the data is in JSON format
						$jsonData = get_post_meta($post_id, 'awl_ag_settings_' . $post_id, true);
						// Decode the JSON string into an associative array
						$album_gallery_settings = json_decode($jsonData, true); // Ensure true is passed to get an associative array

						if (isset($album_gallery_settings['image-slide-ids'])) {
							$count = 0;
							foreach ($album_gallery_settings['image-slide-ids'] as $id) {
								$thumbnail = wp_get_attachment_image_src($id, 'medium', true);
								$attachment = get_post($id);
								$slide_link = $album_gallery_settings['image-slide-link'][$count];
								$slide_type = $album_gallery_settings['image-slide-type'][$count];
						?>
								<li class="image-slide">
									<img class="new-image-slide" src="<?php echo esc_url($thumbnail[0]); ?>"
										alt="<?php echo esc_html(get_the_title($id)); ?>"
										style="height: 150px; width: 98%; border-radius: 8px;">
									<input type="hidden" id="image-slide-ids[]" name="image-slide-ids[]"
										value="<?php echo esc_attr($id); ?>" />
									<select id="image-slide-type[]" name="image-slide-type[]"
										class="form-control selectbox_position_newslide"
										value="<?php echo esc_attr($slide_type); ?>">
										<option value="i" <?php
															if ($slide_type == 'i') {
																echo 'selected=selected';
															}
															?>>Image
										</option>
										<option value="v" <?php
															if ($slide_type == 'v') {
																echo 'selected=selected';
															}
															?>>Video
										</option>
									</select>
									<!-- Image Title-->
									<input type="text" name="image-slide-title[]" id="image-slide-title[]"
										class="input_box_newslide" placeholder="Title Here"
										value="<?php echo esc_html(get_the_title($id)); ?>">
									<input type="text" name="image-slide-link[]" id="image-slide-link[]"
										class="input_box_newslide" placeholder="Enter URL"
										value="<?php echo esc_url($slide_link); ?>">
									<input type="button" name="remove-image-slide" id="remove-image-slide"
										class="button remove-single-image-slide button-danger" style="width: 100%;"
										value="Delete">
								</li>
						<?php
								$count++;
							} // end of foreach
						} //end of if
						?>
					</ul>
				</div>
			</div>
			<div class="bhoechie-tab-content">
				<h1>
					<?php esc_html_e('Configuration', 'new-album-gallery'); ?>
				</h1>
				<hr>
				<!--Grid-->
				<div class="col-md-4">
					<div class="ma_field_discription">
						<h5>
							<?php esc_html_e('Loop', 'new-album-gallery'); ?>
						</h5>
						<p>
							<?php esc_html_e('Select if the album gallery is loopable', 'new-album-gallery'); ?>
						</p>
					</div>
				</div>
				<div class="col-md-8">
					<div class="ma_field p-4">
						<p class="switch-field em_size_field">
							<?php
							if (isset($album_gallery_settings['loop_lightbox'])) {
								$loop_lightbox = $album_gallery_settings['loop_lightbox'];
							} else {
								$loop_lightbox = 'false';
							}
							?>
							<input type="radio" class="form-control" id="loop_lightbox1" name="loop_lightbox"
								value="true" <?php
												if ($loop_lightbox == 'true') {
													echo 'checked';
												}
												?>>
							<label for="loop_lightbox1">
								<?php esc_html_e('Yes', 'new-album-gallery'); ?>
							</label>
							<input type="radio" class="form-control" id="loop_lightbox2" name="loop_lightbox"
								value="false" <?php
												if ($loop_lightbox == 'false') {
													echo 'checked';
												}
												?>>
							<label for="loop_lightbox2">
								<?php esc_html_e('No', 'new-album-gallery'); ?>
							</label>
						</p>
					</div>
				</div>

				<div class="col-md-4">
					<div class="ma_field_discription">
						<h5>
							<?php esc_html_e('Hide Close Button On Mobile', 'new-album-gallery'); ?>
						</h5>
						<p>
							<?php esc_html_e('Select if the Close Button is displayed on mobile', 'new-album-gallery'); ?>
						</p>
					</div>
				</div>
				<div class="col-md-8">
					<div class="ma_field p-4">
						<p class="switch-field em_size_field">
							<?php
							if (isset($album_gallery_settings['hide_close_btn_mobile'])) {
								$hide_close_btn_mobile = $album_gallery_settings['hide_close_btn_mobile'];
							} else {
								$hide_close_btn_mobile = 'false';
							}
							?>
							<input type="radio" class="form-control" id="hide_close_btn_mobile1"
								name="hide_close_btn_mobile" value="true" <?php
																			if ($hide_close_btn_mobile == 'true') {
																				echo 'checked';
																			}
																			?>>
							<label for="hide_close_btn_mobile1">
								<?php esc_html_e('Hide', 'new-album-gallery'); ?>
							</label>
							<input type="radio" class="form-control" id="hide_close_btn_mobile2"
								name="hide_close_btn_mobile" value="false" <?php
																			if ($hide_close_btn_mobile == 'false') {
																				echo 'checked';
																			}
																			?>>
							<label for="hide_close_btn_mobile2">
								<?php esc_html_e('Show', 'new-album-gallery'); ?>
							</label>
						</p>
					</div>
				</div>

				<div class="col-md-4">
					<div class="ma_field_discription">
						<h5>
							<?php esc_html_e('Remove Bars On Mobile', 'new-album-gallery'); ?>
						</h5>
						<p>
							<?php esc_html_e('Select if the gallery bars are displayed on mobile', 'new-album-gallery'); ?>
						</p>
					</div>
				</div>
				<div class="col-md-8">
					<div class="ma_field p-4">
						<p class="switch-field em_size_field">
							<?php
							if (isset($album_gallery_settings['remove_bars_mobile'])) {
								$remove_bars_mobile = $album_gallery_settings['remove_bars_mobile'];
							} else {
								$remove_bars_mobile = 'true';
							}
							?>
							<input type="radio" class="form-control" id="remove_bars_mobile1" name="remove_bars_mobile"
								value="true" <?php
												if ($remove_bars_mobile == 'true') {
													echo 'checked';
												}
												?>>
							<label for="remove_bars_mobile1">
								<?php esc_html_e('Yes', 'new-album-gallery'); ?>
							</label>
							<input type="radio" class="form-control" id="remove_bars_mobile2" name="remove_bars_mobile"
								value="false" <?php
												if ($remove_bars_mobile == 'false') {
													echo 'checked';
												}
												?>>
							<label for="remove_bars_mobile2">
								<?php esc_html_e('No', 'new-album-gallery'); ?>
							</label>
						</p>
					</div>
				</div>

				<div class="col-md-4">
					<div class="ma_field_discription">
						<h5>
							<?php esc_html_e('Hide Bars Delay', 'new-album-gallery'); ?>
						</h5>
						<p>
							<?php esc_html_e('Sets the hide bars Delay time in seconds', 'new-album-gallery'); ?>
						</p>
					</div>
				</div>
				<div class="col-md-8">
					<div class="ma_field p-4 range-slider">
						<?php
						if (isset($album_gallery_settings['hide_bars_delay'])) {
							$hide_bars_delay = $album_gallery_settings['hide_bars_delay'];
						} else {
							$hide_bars_delay = 3000;
						}
						?>

						<input type="range" class="range-slider__range" id="hide_bars_delay" name="hide_bars_delay"
							value="<?php echo esc_attr($hide_bars_delay); ?>" min="500" max="10000" step="100">
						<span class="range-slider__value">3000</span>
					</div>
				</div>
			</div>

			<div class="bhoechie-tab-content">
				<h1>
					<?php esc_html_e('Animation & Hover Effect', 'new-album-gallery'); ?>
				</h1>
				<hr>
				<div class="col-md-4">
					<div class="ma_field_discription">
						<h5>
							<?php esc_html_e('Hover Effects', 'new-album-gallery'); ?>
						</h5>
						<p>
							<?php esc_html_e('Select the hover effect to apply', 'new-album-gallery'); ?>
						</p>
					</div>
				</div>
				<div class="col-md-8">
					<div class="ma_field p-4">
						<p class="switch-field em_size_field">
							<?php
							if (isset($album_gallery_settings['hover_effects'])) {
								$hover_effects = $album_gallery_settings['hover_effects'];
							} else {
								$hover_effects = 'stacks';
							}
							?>
							<input type="radio" class="form-control" id="hover_effects1" name="hover_effects"
								value="stacks" <?php
												if ($hover_effects == 'stacks') {
													echo 'checked';
												}
												?>>
							<label for="hover_effects1">
								<?php esc_html_e('Stacks', 'new-album-gallery'); ?>
							</label>
							<input type="radio" class="form-control" id="hover_effects2" name="hover_effects"
								value="none" <?php
												if ($hover_effects == 'none') {
													echo 'checked';
												}
												?>>
							<label for="hover_effects2">
								<?php esc_html_e('None', 'new-album-gallery'); ?>
							</label>
							<input type="radio" class="form-control" id="hover_effects3" name="hover_effects"
								value="overlay" <?php
												if ($hover_effects == 'overlay') {
													echo 'checked';
												}
												?>>
							<label for="hover_effects3">
								<?php esc_html_e('Overlay', 'new-album-gallery'); ?>
							</label>
						</p>
					</div>
				</div>

				<!--Grid-->
				<div class="col-md-4">
					<div class="ma_field_discription">
						<h5>
							<?php esc_html_e('Animation', 'new-album-gallery'); ?>
						</h5>
						<p>
							<?php esc_html_e('Select to apply animation on gallery', 'new-album-gallery'); ?>
						</p>
					</div>
				</div>
				<div class="col-md-8">
					<div class="ma_field p-4">
						<?php
						if (isset($album_gallery_settings['animations'])) {
							$animations = $album_gallery_settings['animations'];
						} else {
							$animations = 'wobble';
						}
						?>
						<select id="animations" name="animations" class="selectbox_position">
							<option value="none" <?php
													if ($animations == 'none') {
														echo 'selected=selected';
													}
													?>>
								<?php esc_html_e('None', 'new-album-gallery'); ?>
							</option>
							<option value="wobble" <?php
													if ($animations == 'wobble') {
														echo 'selected=selected';
													}
													?>>
								<?php esc_html_e('Wobble', 'new-album-gallery'); ?>
							</option>
							<option value="bounce" <?php
													if ($animations == 'bounce') {
														echo 'selected=selected';
													}
													?>>
								<?php esc_html_e('Bounce', 'new-album-gallery'); ?>
							</option>
							<option value="flash" <?php
													if ($animations == 'flash') {
														echo 'selected=selected';
													}
													?>>
								<?php esc_html_e('Flash', 'new-album-gallery'); ?>
							</option>
							<option value="jello" <?php
													if ($animations == 'jello') {
														echo 'selected=selected';
													}
													?>>
								<?php esc_html_e('Jello', 'new-album-gallery'); ?>
							</option>
							<option value="pulse" <?php
													if ($animations == 'pulse') {
														echo 'selected=selected';
													}
													?>>
								<?php esc_html_e('Pulse', 'new-album-gallery'); ?>
							</option>
							<option value="rubberBand" <?php
														if ($animations == 'rubberBand') {
															echo 'selected=selected';
														}
														?>>
								<?php esc_html_e('Rubber Band', 'new-album-gallery'); ?>
							</option>
							<option value="shake" <?php
													if ($animations == 'shake') {
														echo 'selected=selected';
													}
													?>>
								<?php esc_html_e('Shake', 'new-album-gallery'); ?>
							</option>
							<option value="tada" <?php
													if ($animations == 'tada') {
														echo 'selected=selected';
													}
													?>>
								<?php esc_html_e('Tada', 'new-album-gallery'); ?>
							</option>
							<option value="swing" <?php
													if ($animations == 'swing') {
														echo 'selected=selected';
													}
													?>>
								<?php esc_html_e('Swing', 'new-album-gallery'); ?>
							</option>
							<option value="rollIn" <?php
													if ($animations == 'rollIn') {
														echo 'selected=selected';
													}
													?>>
								<?php esc_html_e('Roll In', 'new-album-gallery'); ?>
							</option>
						</select>
					</div>
				</div>

			</div>

			<div class="bhoechie-tab-content">
				<style>
					.nag-pro-wrap {
						max-width: 100%;
						font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
					}

					.nag-pro-hero {
						background: linear-gradient(135deg, #1e3a5f 0%, #2271b1 50%, #3582c4 100%);
						color: #fff;
						padding: 35px 30px;
						border-radius: 10px;
						text-align: center;
						position: relative;
						overflow: hidden;
						margin-bottom: 25px;
					}

					.nag-pro-hero::before {
						content: '';
						position: absolute;
						top: -50%;
						left: -50%;
						width: 200%;
						height: 200%;
						background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
						pointer-events: none;
					}

					.nag-pro-hero h2 {
						margin: 0 0 6px 0;
						font-size: 26px;
						font-weight: 700;
						color: #fff;
						position: relative;
					}

					.nag-pro-hero .nag-pro-badge {
						display: inline-block;
						background: linear-gradient(135deg, #f0b849 0%, #e09e18 100%);
						color: #1e3a5f;
						padding: 3px 12px;
						border-radius: 20px;
						font-size: 12px;
						font-weight: 700;
						letter-spacing: 0.5px;
						text-transform: uppercase;
						margin-bottom: 14px;
						position: relative;
					}

					.nag-pro-hero p {
						font-size: 14px;
						opacity: 0.9;
						margin: 0 0 20px 0;
						max-width: 560px;
						margin-left: auto;
						margin-right: auto;
						color: #fff;
						line-height: 1.6;
						position: relative;
					}

					.nag-pro-hero .nag-pro-buttons {
						display: flex;
						gap: 10px;
						justify-content: center;
						flex-wrap: wrap;
						position: relative;
					}

					.nag-pro-hero .nag-pro-buttons a.button {
						background: linear-gradient(135deg, #f0b849 0%, #e09e18 100%) !important;
						color: #1e3a5f !important;
						border: none !important;
						padding: 10px 24px !important;
						border-radius: 6px !important;
						font-weight: 700 !important;
						font-size: 13px !important;
						text-shadow: none !important;
						box-shadow: 0 3px 12px rgba(0, 0, 0, 0.2) !important;
						transition: all 0.3s ease !important;
						height: auto !important;
						line-height: 1.4 !important;
					}

					.nag-pro-hero .nag-pro-buttons a.button:hover {
						transform: translateY(-2px) !important;
						box-shadow: 0 5px 16px rgba(0, 0, 0, 0.3) !important;
					}

					.nag-pro-section {
						margin-bottom: 25px;
					}

					.nag-pro-section h3 {
						font-size: 20px;
						font-weight: 700;
						color: #1d2327;
						margin: 0 0 5px 0;
						text-align: center;
					}

					.nag-pro-section .nag-pro-subtitle {
						text-align: center;
						font-size: 13px;
						color: #787c82;
						margin: 0 0 20px 0;
					}

					.nag-pro-grid {
						display: grid;
						grid-template-columns: repeat(3, 1fr);
						gap: 14px;
					}

					@media (max-width: 1100px) {
						.nag-pro-grid {
							grid-template-columns: repeat(2, 1fr);
						}
					}

					@media (max-width: 700px) {
						.nag-pro-grid {
							grid-template-columns: 1fr;
						}
					}

					.nag-pro-card {
						background: #f8f9fa;
						border: 1px solid #e8eaed;
						border-radius: 8px;
						padding: 18px;
						transition: all 0.3s ease;
					}

					.nag-pro-card:hover {
						border-color: #2271b1;
						box-shadow: 0 3px 10px rgba(34, 113, 177, 0.1);
						transform: translateY(-2px);
					}

					.nag-pro-card .nag-pro-icon {
						width: 38px;
						height: 38px;
						background: linear-gradient(135deg, #2271b1 0%, #3582c4 100%);
						border-radius: 8px;
						display: flex;
						align-items: center;
						justify-content: center;
						margin-bottom: 10px;
					}

					.nag-pro-card .nag-pro-icon .dashicons {
						color: #fff;
						font-size: 20px;
						width: 20px;
						height: 20px;
					}

					.nag-pro-card h4 {
						font-size: 14px;
						font-weight: 600;
						color: #1d2327;
						margin: 0 0 4px 0;
					}

					.nag-pro-card p {
						font-size: 12px;
						color: #646970;
						line-height: 1.5;
						margin: 0;
					}

					.nag-compare-table {
						width: 100%;
						border-collapse: separate;
						border-spacing: 0;
						border-radius: 8px;
						overflow: hidden;
						border: 1px solid #dcdcde;
					}

					.nag-compare-table thead th {
						padding: 14px 16px;
						font-size: 14px;
						font-weight: 700;
						text-align: center;
						border-bottom: 2px solid #dcdcde;
					}

					.nag-compare-table thead th:first-child {
						text-align: left;
						background: #f6f7f7;
						color: #1d2327;
						width: 50%;
					}

					.nag-compare-table thead th:nth-child(2) {
						background: #f6f7f7;
						color: #50575e;
					}

					.nag-compare-table thead th:nth-child(3) {
						background: linear-gradient(135deg, #1e3a5f 0%, #2271b1 100%);
						color: #fff;
					}

					.nag-compare-table tbody td {
						padding: 10px 16px;
						font-size: 13px;
						color: #50575e;
						border-bottom: 1px solid #f0f0f1;
						text-align: center;
					}

					.nag-compare-table tbody td:first-child {
						text-align: left;
						font-weight: 500;
						color: #2c3338;
					}

					.nag-compare-table tbody tr:last-child td {
						border-bottom: none;
					}

					.nag-compare-table tbody tr:hover {
						background: #f9fbfd;
					}

					.nag-check {
						color: #00a32a;
						font-size: 18px;
						font-weight: 700;
					}

					.nag-cross {
						color: #cc1818;
						font-size: 15px;
					}

					.nag-limited {
						color: #dba617;
						font-size: 12px;
						font-weight: 500;
					}
				</style>

				<div class="nag-pro-wrap">

					<!-- Hero -->
					<div class="nag-pro-hero">
						<span class="nag-pro-badge"><?php esc_html_e('Pro Version', 'new-album-gallery'); ?></span>
						<h2><?php esc_html_e('Unlock the Full Power of Album Gallery', 'new-album-gallery'); ?></h2>
						<p><?php esc_html_e('Get advanced customization, more effects, per-gallery controls, and premium features to build stunning album galleries.', 'new-album-gallery'); ?></p>
						<div class="nag-pro-buttons">
							<a href="https://awplife.com/wordpress-plugins/album-gallery-wordpress-plugin/" target="_blank" class="button button-primary button-hero"><?php esc_html_e('Premium Version Details', 'new-album-gallery'); ?></a>
							<a href="https://awplife.com/demo/album-gallery-premium/" target="_blank" class="button button-primary button-hero"><?php esc_html_e('Check Live Demo', 'new-album-gallery'); ?></a>
							<a href="https://awplife.com/demo/album-gallery-premium/how-to-test-premium-plugin/" target="_blank" class="button button-primary button-hero"><?php esc_html_e('Try Pro Version', 'new-album-gallery'); ?></a>
						</div>
					</div>

					<!-- Pro Features -->
					<div class="nag-pro-section">
						<h3><?php esc_html_e('Pro-Only Features', 'new-album-gallery'); ?></h3>
						<p class="nag-pro-subtitle"><?php esc_html_e('Everything in the Free version, plus these powerful additions.', 'new-album-gallery'); ?></p>
						<div class="nag-pro-grid">
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-admin-page"></span></div>
								<h4><?php esc_html_e('Clone / Duplicate Gallery', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Duplicate any gallery with one click — settings, images, and all.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-columns"></span></div>
								<h4><?php esc_html_e('Per-Gallery Column Settings', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Set individual column layouts for each gallery instead of one global setting.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-format-image"></span></div>
								<h4><?php esc_html_e('Gallery Thumbnail Size', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Choose Thumbnail, Medium, Large, or Full Size per gallery.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-editor-textcolor"></span></div>
								<h4><?php esc_html_e('Album Title Customization', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Show/hide titles, customize font size (8–32px) and pick any color.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-admin-appearance"></span></div>
								<h4><?php esc_html_e('Lightbox Title & Icon Styling', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Customize lightbox title color, font size, and navigation icon colors.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-images-alt"></span></div>
								<h4><?php esc_html_e('Lightbox Thumbnails Strip', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Show thumbnail strip below the lightbox image for quick navigation.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-controls-play"></span></div>
								<h4><?php esc_html_e('Lightbox Auto Play', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Enable automatic slideshow playback in the lightbox viewer.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-admin-customizer"></span></div>
								<h4><?php esc_html_e('8 Overlay Hover Effects', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Box In, Box Out, Blur, Curtains, Double, Fade Out, Shade In, Shade Out.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-image-flip-horizontal"></span></div>
								<h4><?php esc_html_e('5 Stack Hover Effects', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Stack, Rotated, Twisted, Rotated-Left, Rotated-Right.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-editor-code"></span></div>
								<h4><?php esc_html_e('Custom CSS Per Gallery', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Add custom CSS for each gallery without editing theme files.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-art"></span></div>
								<h4><?php esc_html_e('Color Picker Integration', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('WordPress color picker for album title, lightbox title, and icon colors.', 'new-album-gallery'); ?></p>
							</div>
							<div class="nag-pro-card">
								<div class="nag-pro-icon"><span class="dashicons dashicons-trash"></span></div>
								<h4><?php esc_html_e('Bulk Delete Images', 'new-album-gallery'); ?></h4>
								<p><?php esc_html_e('Remove all images from a gallery in one click.', 'new-album-gallery'); ?></p>
							</div>
						</div>
					</div>

					<!-- Comparison Table -->
					<div class="nag-pro-section">
						<h3><?php esc_html_e('Free vs Pro Comparison', 'new-album-gallery'); ?></h3>
						<p class="nag-pro-subtitle"><?php esc_html_e('See exactly what you get with each version.', 'new-album-gallery'); ?></p>
						<table class="nag-compare-table">
							<thead>
								<tr>
									<th><?php esc_html_e('Feature', 'new-album-gallery'); ?></th>
									<th><?php esc_html_e('Free', 'new-album-gallery'); ?></th>
									<th><?php esc_html_e('Pro', 'new-album-gallery'); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php esc_html_e('Unlimited Galleries', 'new-album-gallery'); ?></td>
									<td><span class="nag-check">✓</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Unlimited Images Per Gallery', 'new-album-gallery'); ?></td>
									<td><span class="nag-check">✓</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Responsive Design', 'new-album-gallery'); ?></td>
									<td><span class="nag-check">✓</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Lightbox Viewer', 'new-album-gallery'); ?></td>
									<td><span class="nag-check">✓</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Video Support (YouTube / Vimeo)', 'new-album-gallery'); ?></td>
									<td><span class="nag-check">✓</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Shortcode Support', 'new-album-gallery'); ?></td>
									<td><span class="nag-check">✓</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Lightbox Loop', 'new-album-gallery'); ?></td>
									<td><span class="nag-check">✓</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Load Animations', 'new-album-gallery'); ?></td>
									<td><span class="nag-limited"><?php esc_html_e('Basic', 'new-album-gallery'); ?></span></td>
									<td><span class="nag-check"><?php esc_html_e('10+ Effects', 'new-album-gallery'); ?></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Hover Effects', 'new-album-gallery'); ?></td>
									<td><span class="nag-limited"><?php esc_html_e('2 Effects', 'new-album-gallery'); ?></span></td>
									<td><span class="nag-check"><?php esc_html_e('15+ Effects', 'new-album-gallery'); ?></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Stack Effect Variants', 'new-album-gallery'); ?></td>
									<td><span class="nag-limited"><?php esc_html_e('Basic', 'new-album-gallery'); ?></span></td>
									<td><span class="nag-check"><?php esc_html_e('5 Variants', 'new-album-gallery'); ?></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Overlay Effect Variants', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check"><?php esc_html_e('8 Variants', 'new-album-gallery'); ?></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Column Settings', 'new-album-gallery'); ?></td>
									<td><span class="nag-limited"><?php esc_html_e('Global Only', 'new-album-gallery'); ?></span></td>
									<td><span class="nag-check"><?php esc_html_e('Per Gallery', 'new-album-gallery'); ?></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Gallery Thumbnail Size Control', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Clone / Duplicate Gallery', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Album Title Show / Hide', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Album Title Font Size & Color', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Lightbox Image Title Display', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Lightbox Title Color & Font Size', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Lightbox Icon Color', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Lightbox Thumbnails Strip', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Lightbox Auto Play', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Custom CSS Per Gallery', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Color Picker (Title & Icons)', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Bulk Delete All Images', 'new-album-gallery'); ?></td>
									<td><span class="nag-cross">✕</span></td>
									<td><span class="nag-check">✓</span></td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>
<?php
// syntax: wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' );
wp_nonce_field('ag_save_settings', 'ag_save_nonce');
?>

<script>
	// start pulse on page load
	function pulseEff() {
		jQuery('#shortcode').fadeOut(600).fadeIn(600);
	};
	var Interval;
	Interval = setInterval(pulseEff, 1500);

	// stop pulse
	function pulseOff() {
		clearInterval(Interval);
	}
	// start pulse
	function pulseStart() {
		Interval = setInterval(pulseEff, 2000);
	}

	//range slider
	var rangeSlider = function() {
		var slider = jQuery('.range-slider'),
			range = jQuery('.range-slider__range'),
			value = jQuery('.range-slider__value');

		slider.each(function() {
			value.each(function() {
				var value = jQuery(this).prev().attr('value');
				jQuery(this).html(value);
			});

			range.on('input', function() {
				jQuery(this).next(value).html(this.value);
			});
		});
	};
	rangeSlider();

	//on load 
	var hover_effects = jQuery('input[name="hover_effects"]:checked').val();

	if (hover_effects == "stacks") {
		jQuery('.hover_stack_effect_settings').show();
		jQuery('.hover_overlay_effect_settings').hide();
		jQuery('.effect_show_hide').show();
	}
	if (hover_effects == "none") {
		jQuery('.hover_stack_effect_settings').hide();
		jQuery('.hover_overlay_effect_settings').hide();
		jQuery('.effect_show_hide').hide();
	}
	if (hover_effects == "overlay") {
		jQuery('.hover_overlay_effect_settings').show();
		jQuery('.hover_stack_effect_settings').hide();
		jQuery('.effect_show_hide').show();
	}

	//on change
	jQuery('input[name="hover_effects"]').change(function() {
		var hover_effects = jQuery('input[name="hover_effects"]:checked').val();
		if (hover_effects == "stacks") {
			jQuery('.hover_stack_effect_settings').show();
			jQuery('.hover_overlay_effect_settings').hide();
			jQuery('.effect_show_hide').show();
		}
		if (hover_effects == "none") {
			jQuery('.hover_stack_effect_settings').hide();
			jQuery('.hover_overlay_effect_settings').hide();
			jQuery('.effect_show_hide').hide();
		}
		if (hover_effects == "overlay") {
			jQuery('.hover_overlay_effect_settings').show();
			jQuery('.hover_stack_effect_settings').hide();
			jQuery('.effect_show_hide').show();
		}
	});

	// tab
	jQuery("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
		e.preventDefault();
		jQuery(this).siblings('a.active').removeClass("active");
		jQuery(this).addClass("active");
		var index = jQuery(this).index();
		jQuery("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
		jQuery("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
	});
</script>