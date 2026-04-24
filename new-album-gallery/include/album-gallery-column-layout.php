<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Retrieve existing settings
$column_opt = get_option('album_gallery_column_settings');

$col_lg = isset($column_opt['col_large_desktops']) ? $column_opt['col_large_desktops'] : 'col-lg-4';
$col_md = isset($column_opt['col_desktops'])       ? $column_opt['col_desktops']       : 'col-md-4';
$col_sm = isset($column_opt['col_tablets'])        ? $column_opt['col_tablets']        : 'col-sm-4';
$col_xs = isset($column_opt['col_phones'])         ? $column_opt['col_phones']         : 'col-xs-6';

// Enqueue Modern Admin CSS
wp_enqueue_style('awl-ag-modern-admin-css', AG_PLUGIN_URL . 'assets/css/admin-modern.css', array(), '5.3.5');
?>

<div class="awl-ag-settings-wrapper">
    <div class="ag-settings-card main-card">
        <div class="ag-card-header">
            <div class="header-title">
                <span class="dashicons dashicons-layout"></span>
                <h2><?php esc_html_e('Global Settings', 'new-album-gallery'); ?></h2>
            </div>
            <p class="ag-header-desc ag-header-margin"><?php esc_html_e('Configure how your album galleries appear across different devices and screen sizes.', 'new-album-gallery'); ?></p>
        </div>

        <div class="ag-card-body">
            <form id="agp-column-settings">
                
                <!-- SECTION: Grid Layout -->
                <div class="ag-settings-section ag-p-30 ag-border-bottom">
                    <div class="ag-section-header ag-flex-center ag-gap-10 ag-mb-25">
                        <span class="dashicons dashicons-screenoptions ag-indigo-icon"></span>
                        <h3 class="ag-section-title"><?php esc_html_e('Grid Layout', 'new-album-gallery'); ?></h3>
                    </div>

                    <div class="ag-settings-grid">
                        
                        <!-- Unified Grid Layout Card -->
                        <div class="awl-ag-setting-row">
                            <div class="awl-ag-setting-label">
                                <h5><i class="dashicons dashicons-visibility"></i> <?php esc_html_e('Responsive Columns', 'new-album-gallery'); ?></h5>
                                <p><?php esc_html_e('Set the number of columns for different device widths.', 'new-album-gallery'); ?></p>
                            </div>
                            <div class="awl-ag-setting-field ag-flex-column-large">
                                <div class="ag-grid-2-col">
                                    <div class="awl-ag-color-item" style="display: flex; align-items: center; justify-content: space-between;">
                                        <label><?php esc_html_e('Large Desktops', 'new-album-gallery'); ?></label>
                                        <select name="col_large_desktops" class="ag-modern-select">
                                            <option value="col-lg-12" <?php selected($col_lg, 'col-lg-12'); ?>>1 Column</option>
                                            <option value="col-lg-6" <?php selected($col_lg, 'col-lg-6'); ?>>2 Columns</option>
                                            <option value="col-lg-4" <?php selected($col_lg, 'col-lg-4'); ?>>3 Columns</option>
                                            <option value="col-lg-3" <?php selected($col_lg, 'col-lg-3'); ?>>4 Columns</option>
                                            <option value="col-lg-2" <?php selected($col_lg, 'col-lg-2'); ?>>6 Columns</option>
                                        </select>
                                    </div>
                                    <div class="awl-ag-color-item" style="display: flex; align-items: center; justify-content: space-between;">
                                        <label><?php esc_html_e('Standard Desktops', 'new-album-gallery'); ?></label>
                                        <select name="col_desktops" class="ag-modern-select">
                                            <option value="col-md-12" <?php selected($col_md, 'col-md-12'); ?>>1 Column</option>
                                            <option value="col-md-6" <?php selected($col_md, 'col-md-6'); ?>>2 Columns</option>
                                            <option value="col-md-4" <?php selected($col_md, 'col-md-4'); ?>>3 Columns</option>
                                            <option value="col-md-3" <?php selected($col_md, 'col-md-3'); ?>>4 Columns</option>
                                            <option value="col-md-2" <?php selected($col_md, 'col-md-2'); ?>>6 Columns</option>
                                        </select>
                                    </div>
                                    <div class="awl-ag-color-item" style="display: flex; align-items: center; justify-content: space-between;">
                                        <label><?php esc_html_e('Tablets', 'new-album-gallery'); ?></label>
                                        <select name="col_tablets" class="ag-modern-select">
                                            <option value="col-sm-12" <?php selected($col_sm, 'col-sm-12'); ?>>1 Column</option>
                                            <option value="col-sm-6" <?php selected($col_sm, 'col-sm-6'); ?>>2 Columns</option>
                                            <option value="col-sm-4" <?php selected($col_sm, 'col-sm-4'); ?>>3 Columns</option>
                                            <option value="col-sm-3" <?php selected($col_sm, 'col-sm-3'); ?>>4 Columns</option>
                                        </select>
                                    </div>
                                    <div class="awl-ag-color-item" style="display: flex; align-items: center; justify-content: space-between;">
                                        <label><?php esc_html_e('Mobile Phones', 'new-album-gallery'); ?></label>
                                        <select name="col_phones" class="ag-modern-select">
                                            <option value="col-xs-12" <?php selected($col_xs, 'col-xs-12'); ?>>1 Column</option>
                                            <option value="col-xs-6" <?php selected($col_xs, 'col-xs-6'); ?>>2 Columns</option>
                                            <option value="col-xs-4" <?php selected($col_xs, 'col-xs-4'); ?>>3 Columns</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SECTION: Performance -->
                        <?php $skeleton_loading = isset($column_opt['skeleton_loading']) ? $column_opt['skeleton_loading'] : 'true'; ?>
                        <div class="awl-ag-setting-row">
                            <div class="awl-ag-setting-label">
                                <h5><i class="dashicons dashicons-performance"></i> <?php esc_html_e('Skeleton Loading', 'new-album-gallery'); ?></h5>
                                <p><?php esc_html_e('Shows shimmering placeholders while images load.', 'new-album-gallery'); ?></p>
                            </div>
                            <div class="awl-ag-setting-field">
                                <div class="ag-segmented-control">
                                    <input type="radio" id="skeleton-on" name="skeleton_loading" value="true" <?php checked($skeleton_loading, 'true'); ?>>
                                    <label for="skeleton-on"><?php esc_html_e('On', 'new-album-gallery'); ?></label>
                                    <input type="radio" id="skeleton-off" name="skeleton_loading" value="false" <?php checked($skeleton_loading, 'false'); ?>>
                                    <label for="skeleton-off"><?php esc_html_e('Off', 'new-album-gallery'); ?></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="ag-form-actions ag-p-30 ag-flex-between ag-border-top ag-bg-slate">
                    <button class="ag-btn-primary-lg ag-flex-center ag-gap-10" type="button">
                        <span class="dashicons dashicons-saved"></span>
                        <?php esc_html_e('Update Gallery Configuration', 'new-album-gallery'); ?>
                    </button>
                    
                    <div class="ag-flex-center ag-gap-15">
                        <div id="ag-save-loader" class="ag-save-status">
                            <span class="dashicons dashicons-update ag-spin"></span>
                            <span class="ag-status-txt"><?php esc_html_e('Syncing...', 'new-album-gallery'); ?></span>
                        </div>
                        <div id="ag-save-success" class="ag-save-status ag-success-txt">
                            <span class="dashicons dashicons-yes-alt"></span>
                            <span><?php esc_html_e('Layout Updated!', 'new-album-gallery'); ?></span>
                        </div>
                    </div>
                </div>
                <?php wp_nonce_field('ag_column_save_nonce', 'ag_column_nonce_field'); ?>
            </form>
        </div>
    </div>
</div>