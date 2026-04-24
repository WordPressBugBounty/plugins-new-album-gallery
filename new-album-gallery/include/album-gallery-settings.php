<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly
?>
<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="dashicons dashicons-arrow-up-alt2"></i></a>

<div class="awl-ag-settings-wrapper">
    <div class="awl-ag-tabs-nav">
        <div class="awl-ag-tab-nav-item active" data-tab="0">
            <i class="dashicons dashicons-format-image"></i>
            <?php esc_html_e('Gallery Content', 'new-album-gallery'); ?>
        </div>
        <div class="awl-ag-tab-nav-item" data-tab="1">
            <i class="dashicons dashicons-layout"></i>
            <?php esc_html_e('Layout Settings', 'new-album-gallery'); ?>
        </div>
        <div class="awl-ag-tab-nav-item" data-tab="2">
            <i class="dashicons dashicons-visibility"></i>
            <?php esc_html_e('Lightbox Controls', 'new-album-gallery'); ?>
        </div>
        <div class="awl-ag-tab-nav-item" data-tab="3">
            <i class="dashicons dashicons-admin-appearance"></i>
            <?php esc_html_e('Visual Effects', 'new-album-gallery'); ?>
        </div>
        <div class="awl-ag-tab-nav-item nag-pro-tab-nav" data-tab="4" style="color:#f59e0b; font-weight:700;">
            <i class="dashicons dashicons-star-filled"></i>
            <?php esc_html_e('Upgrade to Pro', 'new-album-gallery'); ?>
        </div>
    </div>

    <div class="awl-ag-tabs-content-wrapper">
        <!-- Tab 1: Gallery Content -->
        <div class="awl-ag-tab-content active" id="tab-0">
            <h1><?php esc_html_e('Gallery Content', 'new-album-gallery'); ?></h1>
            <div id="album-gallery" class="ag-upload-section">
                <div class="ag-upload-card">
                    <div class="ag-upload-inner">
                        <div class="ag-upload-icon-circle">
                            <span class="dashicons dashicons-images-alt2"></span>
                        </div>
                        <h3><?php esc_html_e('Add New Images', 'new-album-gallery'); ?></h3>
                        <p><?php esc_html_e('Click here to upload or select from Media Library', 'new-album-gallery'); ?></p>
                    </div>
                    <input class="add-new-image-slides" id="add-new-image-slides" name="add-new-image-slides" type="hidden" value="Upload Image" />
                </div>

                <div class="ag-manage-controls">
                    <button type="button" id="remove-all-image-slides" class="button button-danger">
                        <span class="dashicons dashicons-trash"></span>
                        <?php esc_html_e('Remove All Items', 'new-album-gallery'); ?>
                    </button>
                </div>

                <ul class="ag-image-slides-list sortable-list">
                    <?php
                    $post_id = $post->ID;
                    $option_key = 'awl_ag_settings_' . $post_id;
                    $jsonData = get_post_meta($post_id, $option_key, true);
                    
                    if (is_string($jsonData) && strpos($jsonData, '{') === 0) {
                        $settings = json_decode($jsonData, true);
                    } else {
                        $settings = maybe_unserialize($jsonData);
                    }
                    
                    if (isset($settings['image-slide-ids']) && is_array($settings['image-slide-ids'])) {
                        $count = 0;
                        foreach ($settings['image-slide-ids'] as $id) {
                            $type = isset($settings['image-slide-type'][$count]) ? $settings['image-slide-type'][$count] : 'i';
                            $title = isset($settings['image-slide-title'][$count]) ? $settings['image-slide-title'][$count] : '';
                            $link = isset($settings['image-slide-link'][$count]) ? $settings['image-slide-link'][$count] : '';
                            
                            // Get main class instance to call the callback
                            // In this context, we might need a reference to the class or just call it if it's available global/passed
                            // Since this file is required inside a class method, $this SHOULD refer to the class instance.
                            $this->_ag_ajax_callback_function($id, $type, $title, $link);
                            $count++;
                        }
                    }
                    ?>
                </ul>
            </div>

        </div>

        <!-- Tab 2: Layout Settings -->
        <div class="awl-ag-tab-content" id="tab-1">
            <h1><?php esc_html_e('Layout Settings', 'new-album-gallery'); ?></h1>

            <div class="awl-ag-setting-row">
                <div class="awl-ag-setting-label">
                    <h5><i class="dashicons dashicons-editor-expand"></i> <?php esc_html_e('Gallery Thumb Size', 'new-album-gallery'); ?></h5>
                    <p><?php esc_html_e('Select size of thumbnails to display in the grid.', 'new-album-gallery'); ?></p>
                </div>
                <div class="awl-ag-setting-field">
                    <?php $gal_thumb_size = isset($album_gallery_settings['gal_thumb_size']) ? $album_gallery_settings['gal_thumb_size'] : "medium"; ?>
                    <select id="gal_thumb_size" name="gal_thumb_size">
                        <option value="thumbnail" <?php selected($gal_thumb_size, "thumbnail"); ?>><?php esc_html_e('Thumbnail – 150 × 150', 'new-album-gallery'); ?></option>
                        <option value="medium" <?php selected($gal_thumb_size, "medium"); ?>><?php esc_html_e('Medium – 300 × 169', 'new-album-gallery'); ?></option>
                        <option value="large" <?php selected($gal_thumb_size, "large"); ?>><?php esc_html_e('Large – 1280 × 720', 'new-album-gallery'); ?></option>
                        <option value="full" <?php selected($gal_thumb_size, "full"); ?>><?php esc_html_e('Full Size', 'new-album-gallery'); ?></option>
                    </select>
                </div>
            </div>




            <div class="awl-ag-setting-row">
                <div class="awl-ag-setting-label">
                    <h5><i class="dashicons dashicons-columns"></i> <?php esc_html_e('Column Logic', 'new-album-gallery'); ?></h5>
                    <p><?php esc_html_e('Uniform columns or device-specific control.', 'new-album-gallery'); ?></p>
                </div>
                <div class="awl-ag-setting-field">
                    <div class="ag-switch-wrapper">
                        <?php $column_settings = isset($album_gallery_settings['column_settings']) ? $album_gallery_settings['column_settings'] : "true"; ?>
                        <input type="hidden" name="column_settings" value="false">
                        <label class="ag-toggle-switch">
                            <input type="checkbox" id="column_settings_switch" name="column_settings" value="true" <?php checked($column_settings, "true"); ?>>
                            <span class="ag-toggle-slider"></span>
                        </label>
                        <span class="ag-toggle-status"><?php echo $column_settings === "true" ? esc_html__('Uniform', 'new-album-gallery') : esc_html__('Individual', 'new-album-gallery'); ?></span>
                    </div>
                </div>
            </div>

            <div class="column_individual_settings">
                <div class="awl-ag-setting-row">
                    <div class="awl-ag-setting-label">
                        <h5><?php esc_html_e('Large Desktops', 'new-album-gallery'); ?></h5>
                    </div>
                    <div class="awl-ag-setting-field">
                        <?php $col_large_desktops = isset($album_gallery_settings['col_large_desktops']) ? $album_gallery_settings['col_large_desktops'] : "col-lg-6"; ?>
                        <select id="col_large_desktops" name="col_large_desktops">
                            <option value="col-lg-12" <?php selected($col_large_desktops, "col-lg-12"); ?>><?php esc_html_e('1 Column', 'new-album-gallery'); ?></option>
                            <option value="col-lg-6" <?php selected($col_large_desktops, "col-lg-6"); ?>><?php esc_html_e('2 Columns', 'new-album-gallery'); ?></option>
                            <option value="col-lg-4" <?php selected($col_large_desktops, "col-lg-4"); ?>><?php esc_html_e('3 Columns', 'new-album-gallery'); ?></option>
                            <option value="col-lg-3" <?php selected($col_large_desktops, "col-lg-3"); ?>><?php esc_html_e('4 Columns', 'new-album-gallery'); ?></option>
                            <option value="col-lg-2" <?php selected($col_large_desktops, "col-lg-2"); ?>><?php esc_html_e('6 Columns', 'new-album-gallery'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="awl-ag-setting-row">
                    <div class="awl-ag-setting-label">
                        <h5><?php esc_html_e('Desktops', 'new-album-gallery'); ?></h5>
                    </div>
                    <div class="awl-ag-setting-field">
                        <?php $col_desktops = isset($album_gallery_settings['col_desktops']) ? $album_gallery_settings['col_desktops'] : "col-md-4"; ?>
                        <select id="col_desktops" name="col_desktops">
                            <option value="col-md-12" <?php selected($col_desktops, "col-md-12"); ?>><?php esc_html_e('1 Column', 'new-album-gallery'); ?></option>
                            <option value="col-md-6" <?php selected($col_desktops, "col-md-6"); ?>><?php esc_html_e('2 Columns', 'new-album-gallery'); ?></option>
                            <option value="col-md-4" <?php selected($col_desktops, "col-md-4"); ?>><?php esc_html_e('3 Columns', 'new-album-gallery'); ?></option>
                            <option value="col-md-3" <?php selected($col_desktops, "col-md-3"); ?>><?php esc_html_e('4 Columns', 'new-album-gallery'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="awl-ag-setting-row">
                    <div class="awl-ag-setting-label">
                        <h5><?php esc_html_e('Tablets', 'new-album-gallery'); ?></h5>
                    </div>
                    <div class="awl-ag-setting-field">
                        <?php $col_tablets = isset($album_gallery_settings['col_tablets']) ? $album_gallery_settings['col_tablets'] : "col-sm-4"; ?>
                        <select id="col_tablets" name="col_tablets">
                            <option value="col-sm-12" <?php selected($col_tablets, "col-sm-12"); ?>><?php esc_html_e('1 Column', 'new-album-gallery'); ?></option>
                            <option value="col-sm-6" <?php selected($col_tablets, "col-sm-6"); ?>><?php esc_html_e('2 Columns', 'new-album-gallery'); ?></option>
                            <option value="col-sm-4" <?php selected($col_tablets, "col-sm-4"); ?>><?php esc_html_e('3 Columns', 'new-album-gallery'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="awl-ag-setting-row">
                    <div class="awl-ag-setting-label">
                        <h5><?php esc_html_e('Phones', 'new-album-gallery'); ?></h5>
                    </div>
                    <div class="awl-ag-setting-field">
                        <?php $col_phones = isset($album_gallery_settings['col_phones']) ? $album_gallery_settings['col_phones'] : "col-xs-6"; ?>
                        <select id="col_phones" name="col_phones">
                            <option value="col-xs-12" <?php selected($col_phones, "col-xs-12"); ?>><?php esc_html_e('1 Column', 'new-album-gallery'); ?></option>
                            <option value="col-xs-6" <?php selected($col_phones, "col-xs-6"); ?>><?php esc_html_e('2 Columns', 'new-album-gallery'); ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab 3: Lightbox Controls -->
        <div class="awl-ag-tab-content" id="tab-2">
            <h1><?php esc_html_e('Lightbox Controls', 'new-album-gallery'); ?></h1>

            <div class="awl-ag-setting-row">
                <div class="awl-ag-setting-label">
                    <h5><i class="dashicons dashicons-tag"></i> <?php esc_html_e('Image Title', 'new-album-gallery'); ?></h5>
                    <p><?php esc_html_e('Show image titles in the lightbox.', 'new-album-gallery'); ?></p>
                </div>
                <div class="awl-ag-setting-field">
                    <div class="ag-switch-wrapper">
                        <?php $image_title = isset($album_gallery_settings['image_title']) ? $album_gallery_settings['image_title'] : "no"; ?>
                        <input type="hidden" name="image_title" value="no">
                        <label class="ag-toggle-switch">
                            <input type="checkbox" id="image_title_switch" name="image_title" value="yes" <?php checked($image_title, "yes"); ?>>
                            <span class="ag-toggle-slider"></span>
                        </label>
                        <span class="ag-toggle-status"><?php echo $image_title === "yes" ? esc_html__('On', 'new-album-gallery') : esc_html__('Off', 'new-album-gallery'); ?></span>
                    </div>
                </div>
            </div>

            <div class="awl-ag-setting-row">
                <div class="awl-ag-setting-label">
                    <h5><i class="dashicons dashicons-update"></i> <?php esc_html_e('Loop Gallery', 'new-album-gallery'); ?></h5>
                    <p><?php esc_html_e('If enabled, the gallery will loop back to the first item after the last.', 'new-album-gallery'); ?></p>
                </div>
                <div class="awl-ag-setting-field">
                    <div class="ag-switch-wrapper">
                        <?php $loop_lightbox = isset($album_gallery_settings['loop_lightbox']) ? $album_gallery_settings['loop_lightbox'] : "true"; ?>
                        <input type="hidden" name="loop_lightbox" value="false">
                        <label class="ag-toggle-switch">
                            <input type="checkbox" id="loop_lightbox_switch" name="loop_lightbox" value="true" <?php checked($loop_lightbox, "true"); ?>>
                            <span class="ag-toggle-slider"></span>
                        </label>
                        <span class="ag-toggle-status"><?php echo $loop_lightbox === "true" ? esc_html__('Enabled', 'new-album-gallery') : esc_html__('Disabled', 'new-album-gallery'); ?></span>
                    </div>
                </div>
            </div>


            <div class="awl-ag-setting-row">
                <div class="awl-ag-setting-label">
                    <h5><i class="dashicons dashicons-controls-play"></i> <?php esc_html_e('Auto Play & Delay', 'new-album-gallery'); ?></h5>
                    <p><?php esc_html_e('Configure slideshow behavior.', 'new-album-gallery'); ?></p>
                </div>
                <div class="awl-ag-setting-field ag-flex-column">
                    <div class="ag-switch-wrapper">
                        <?php $ags_auto_play = isset($album_gallery_settings['ags_auto_play']) ? $album_gallery_settings['ags_auto_play'] : "false"; ?>
                        <input type="hidden" name="ags_auto_play" value="false">
                        <label class="ag-toggle-switch">
                            <input type="checkbox" id="ags_auto_play_switch" name="ags_auto_play" value="true" <?php checked($ags_auto_play, "true"); ?>>
                            <span class="ag-toggle-slider"></span>
                        </label>
                        <span class="ag-toggle-status"><?php echo $ags_auto_play === "true" ? esc_html__('Slideshow Active', 'new-album-gallery') : esc_html__('Slideshow Off', 'new-album-gallery'); ?></span>
                    </div>
                    <div class="autoplay_delay_settings">
                        <?php $ags_delay = isset($album_gallery_settings['ags_delay']) ? $album_gallery_settings['ags_delay'] : '3000'; ?>
                        <div class="range-slider">
                            <input type="range" class="range-slider__range" id="ags_delay" name="ags_delay" value="<?php echo (int) $ags_delay; ?>" min="500" max="10000" step="100">
                            <span class="range-slider__value"><?php echo (int) $ags_delay; ?></span> ms
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>

        <!-- Tab 4: Visual Effects -->
        <div class="awl-ag-tab-content" id="tab-3">
            <h1><?php esc_html_e('Visual Effects', 'new-album-gallery'); ?></h1>

            <div class="awl-ag-setting-row">
                <div class="awl-ag-setting-label">
                    <h5><i class="dashicons dashicons-controls-forward"></i> <?php esc_html_e('Entrance Animation', 'new-album-gallery'); ?></h5>
                    <p><?php esc_html_e('Choose how the gallery items appear on load.', 'new-album-gallery'); ?></p>
                </div>
                <div class="awl-ag-setting-field">
                    <?php $animations = isset($album_gallery_settings['animations']) ? $album_gallery_settings['animations'] : "wobble"; ?>
                    <select id="animations" name="animations">
                        <option value="none" <?php selected($animations, "none"); ?>><?php esc_html_e('None', 'new-album-gallery'); ?></option>
                        <option value="wobble" <?php selected($animations, "wobble"); ?>><?php esc_html_e('Wobble', 'new-album-gallery'); ?></option>
                        <option value="bounce" <?php selected($animations, "bounce"); ?>><?php esc_html_e('Bounce', 'new-album-gallery'); ?></option>
                        <option value="flash" <?php selected($animations, "flash"); ?>><?php esc_html_e('Flash', 'new-album-gallery'); ?></option>
                        <option value="jello" <?php selected($animations, "jello"); ?>><?php esc_html_e('Jello', 'new-album-gallery'); ?></option>
                        <option value="pulse" <?php selected($animations, "pulse"); ?>><?php esc_html_e('Pulse', 'new-album-gallery'); ?></option>
                        <option value="rubberBand" <?php selected($animations, "rubberBand"); ?>><?php esc_html_e('Rubber Band', 'new-album-gallery'); ?></option>
                        <option value="shake" <?php selected($animations, "shake"); ?>><?php esc_html_e('Shake', 'new-album-gallery'); ?></option>
                        <option value="tada" <?php selected($animations, "tada"); ?>><?php esc_html_e('Tada', 'new-album-gallery'); ?></option>
                        <option value="swing" <?php selected($animations, "swing"); ?>><?php esc_html_e('Swing', 'new-album-gallery'); ?></option>
                        <option value="rollIn" <?php selected($animations, "rollIn"); ?>><?php esc_html_e('Roll In', 'new-album-gallery'); ?></option>
                    </select>
                </div>
            </div>

            <div class="awl-ag-setting-row">
                <div class="awl-ag-setting-label">
                    <h5><i class="dashicons dashicons-welcome-view-site"></i> <?php esc_html_e('Hover Effect', 'new-album-gallery'); ?></h5>
                    <p><?php esc_html_e('Choose the style for item mouseover.', 'new-album-gallery'); ?></p>
                </div>
                <div class="awl-ag-setting-field">
                    <div class="ag-segmented-control">
                        <?php $hover_effects = isset($album_gallery_settings['hover_effects']) ? $album_gallery_settings['hover_effects'] : "stacks"; ?>
                        <input type="radio" id="hover_effects1" name="hover_effects" value="stacks" <?php checked($hover_effects, "stacks"); ?>>
                        <label for="hover_effects1"><?php esc_html_e('Stacks', 'new-album-gallery'); ?></label>
                        <input type="radio" id="hover_effects3" name="hover_effects" value="overlay" <?php checked($hover_effects, "overlay"); ?>>
                        <label for="hover_effects3"><?php esc_html_e('Overlay', 'new-album-gallery'); ?></label>
                        <input type="radio" id="hover_effects2" name="hover_effects" value="none" <?php checked($hover_effects, "none"); ?>>
                        <label for="hover_effects2"><?php esc_html_e('None', 'new-album-gallery'); ?></label>
                    </div>

                </div>
            </div>

            <div class="awl-ag-setting-row">
                <div class="awl-ag-setting-label">
                    <h5><i class="dashicons dashicons-text-page"></i> <?php esc_html_e('Album Title Styling', 'new-album-gallery'); ?></h5>
                    <p><?php esc_html_e('Customize font size and title color.', 'new-album-gallery'); ?></p>
                </div>
                <div class="awl-ag-setting-field ag-flex-column-large">
                    <div class="ag-switch-wrapper">
                        <?php $album_title = isset($album_gallery_settings['album_title']) ? $album_gallery_settings['album_title'] : "yes"; ?>
                        <input type="hidden" name="album_title" value="no">
                        <label class="ag-toggle-switch">
                            <input type="checkbox" id="album_title_switch" name="album_title" value="yes" <?php checked($album_title, "yes"); ?>>
                            <span class="ag-toggle-slider"></span>
                        </label>
                        <span class="ag-toggle-status"><?php echo $album_title === "yes" ? esc_html__('Title On', 'new-album-gallery') : esc_html__('Title Off', 'new-album-gallery'); ?></span>
                    </div>
                    <div class="range-slider" style="margin-bottom: 5px;">
                        <label><?php esc_html_e('Font Size', 'new-album-gallery'); ?></label>
                        <?php $title_font_size = isset($album_gallery_settings['title_font_size']) ? $album_gallery_settings['title_font_size'] : 20; ?>
                        <input type="range" class="range-slider__range" id="title_font_size" name="title_font_size" value="<?php echo (int) $title_font_size; ?>" min="8" max="32" step="1">
                        <span class="range-slider__value"><?php echo (int) $title_font_size; ?></span> px
                    </div>
                    <div>
                        <label><?php esc_html_e('Title Color', 'new-album-gallery'); ?></label>
                        <?php $title_color = isset($album_gallery_settings['title_color']) ? $album_gallery_settings['title_color'] : "#000000"; ?>
                        <input type="text" class="awl-ag-color-picker" name="title_color" value="<?php echo esc_attr($title_color); ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 5: Upgrade to Pro -->
        <div class="awl-ag-tab-content" id="tab-4">
            <?php require_once('upgrade-pro.php'); ?>
        </div>
    </div>
</div>
<?php
wp_nonce_field('ag_save_settings', 'ag_save_nonce');
?>