<?Php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$album_gallery_column_settings = get_option( 'album_gallery_column_settings' );

if ( isset( $album_gallery_column_settings['col_large_desktops'] ) ) {
	$col_large_desktops = $album_gallery_column_settings['col_large_desktops'];
} else {
	$col_large_desktops = 'col-lg-4';
}
if ( isset( $album_gallery_column_settings['col_desktops'] ) ) {
	$col_desktops = $album_gallery_column_settings['col_desktops'];
} else {
	$col_desktops = 'col-md-4';
}
if ( isset( $album_gallery_column_settings['col_tablets'] ) ) {
	$col_tablets = $album_gallery_column_settings['col_tablets'];
} else {
	$col_tablets = 'col-sm-4';
}
if ( isset( $album_gallery_column_settings['col_phones'] ) ) {
	$col_phones = $album_gallery_column_settings['col_phones'];
} else {
	$col_phones = 'col-xs-6';
}


// js
wp_enqueue_script( 'awl-ag-bootstrap-js', AG_PLUGIN_URL . 'assets/js/bootstrap.js', array( 'jquery' ), '', true );
// css
wp_enqueue_style( 'awl-styles-css', AG_PLUGIN_URL . 'assets/css/styles.css' );
wp_enqueue_style( 'awl-bootstrap-css', AG_PLUGIN_URL . 'assets/css/bootstrap.css' );
wp_enqueue_style( 'awl-toogle-button-css', AG_PLUGIN_URL . 'assets/css/toogle-button.css' );
wp_enqueue_style( 'awl-font-awesome-min-css', AG_PLUGIN_URL . 'assets/css/font-awesome.min.css' );
?>
<style>
.setting-toggle-div {
	background-color: #FFFFFF;
	padding: 10px;
	margin-bottom: 15px;
	border: 2px solid #CCCCCC;
	border-radius: 3px;
}
.selectbox_position {
	max-width: 100% !important;
}

.gallery-settings, .hover_stack_effect_settings, .hover_overlay_effect_settings {
	padding: 8px 0px 8px 8px !important;
	margin: 10px 10px 5px 0px !important;
}

.gallery-settings label {
	font-size: 13px !important;
	font-weight: bold;
}

.ag_comment_settings {
	font-size: 16px !important;
	font-family:Geneva;
	padding-left: 4px;
	font: initial;
	margin-top: 5px;
	padding-left:14px;
}

.lower-title {
	background-color: #F0F0EF;
	color: #23282d;
	text-align : center;
	font-family: Geneva;
	font-size: 20px;
	font-weight: 500;
	margin-left: 10px;
	padding-left: 10px;
}

.box {
	background:lightgreen;
	margin-top:30px;
	padding: 20px;
	border-radius: 25px;
	box-shadow: 0px 0px 20px lightgreen;
	}
</style>

<div class="container">
	<div class="box row">
		<h1 class="col-md-12" align="center" style="font-family:Geneva;"><?php esc_html_e( 'Gallery Column Settings', 'new-album-gallery' ); ?></h1>
		<form id="agp-column-settings" class="col-md-12">
			<p class="gallery-settings">
				<p class="lower-title"><?php esc_html_e( 'Colums On Large Desktops', 'new-album-gallery' ); ?></p>
				<div class="p-4">
					<?php
					if ( isset( $album_gallery_column_settings['col_large_desktops'] ) ) {
						$col_large_desktops = $album_gallery_column_settings['col_large_desktops'];
					} else {
						$col_large_desktops = 'col-lg-4';
					}
					?>
					<select id="col_large_desktops" name="col_large_desktops" class="selectbox_position">
						<option value="col-lg-12" 
						<?php
						if ( $col_large_desktops == 'col-lg-12' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '1 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-lg-6" 
						<?php
						if ( $col_large_desktops == 'col-lg-6' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '2 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-lg-4" 
						<?php
						if ( $col_large_desktops == 'col-lg-4' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '3 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-lg-3" 
						<?php
						if ( $col_large_desktops == 'col-lg-3' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '4 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-lg-2" 
						<?php
						if ( $col_large_desktops == 'col-lg-2' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '6 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-lg-1" 
						<?php
						if ( $col_large_desktops == 'col-lg-1' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '12 Column Layout.', 'new-album-gallery' ); ?></option>
					</select>
				</div>
			</p>

			<p class="gallery-settings">
				<p class="lower-title"><?php esc_html_e( 'Colums On Desktops', 'new-album-gallery' ); ?></p>
				<div class="p-4">
					<?php
					if ( isset( $album_gallery_column_settings['col_desktops'] ) ) {
						$col_desktops = $album_gallery_column_settings['col_desktops'];
					} else {
						$col_desktops = 'col-md-4';
					}
					?>
					<select id="col_desktops" name="col_desktops" class="selectbox_position">
						<option value="col-md-12" 
						<?php
						if ( $col_desktops == 'col-md-12' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '1 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-md-6" 
						<?php
						if ( $col_desktops == 'col-md-6' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '2 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-md-4" 
						<?php
						if ( $col_desktops == 'col-md-4' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '3 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-md-3" 
						<?php
						if ( $col_desktops == 'col-md-3' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '4 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-md-2" 
						<?php
						if ( $col_desktops == 'col-md-2' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '6 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-md-1" 
						<?php
						if ( $col_desktops == 'col-md-1' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '12 Column Layout.', 'new-album-gallery' ); ?></option>
					</select>
				</div>
			</p>

			<p class="gallery-settings">
				<p class="lower-title"><?php esc_html_e( 'Colums On Tablets', 'new-album-gallery' ); ?></p>
				<div class="p-4">
					<?php
					if ( isset( $album_gallery_column_settings['col_tablets'] ) ) {
						$col_tablets = $album_gallery_column_settings['col_tablets'];
					} else {
						$col_tablets = 'col-sm-4';
					}
					?>
					<select id="col_tablets" name="col_tablets" class="selectbox_position">
						<option value="col-sm-12" 
						<?php
						if ( $col_tablets == 'col-sm-12' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '1 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-sm-6" 
						<?php
						if ( $col_tablets == 'col-sm-6' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '2 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-sm-4" 
						<?php
						if ( $col_tablets == 'col-sm-4' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '3 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-sm-3" 
						<?php
						if ( $col_tablets == 'col-sm-3' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '4 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-sm-2" 
						<?php
						if ( $col_tablets == 'col-sm-2' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '6 Column Layout.', 'new-album-gallery' ); ?></option>
					</select>
				</div>
			</p>

			<p class="gallery-settings">
				<p class="lower-title"><?php esc_html_e( 'Colums On Phones', 'new-album-gallery' ); ?></p>
				<div class="p-4">
					<?php
					if ( isset( $album_gallery_column_settings['col_phones'] ) ) {
						$col_phones = $album_gallery_column_settings['col_phones'];
					} else {
						$col_phones = 'col-xs-6';
					}
					?>
					<select id="col_phones" name="col_phones" class="selectbox_position form-control">
						<option value="col-xs-12" 
						<?php
						if ( $col_phones == 'col-xs-12' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '1 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-xs-6" 
						<?php
						if ( $col_phones == 'col-xs-6' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '2 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-xs-4" 
						<?php
						if ( $col_phones == 'col-xs-4' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '3 Column Layout.', 'new-album-gallery' ); ?></option>
						<option value="col-xs-3" 
						<?php
						if ( $col_phones == 'col-xs-3' ) {
							echo 'selected=selected';}
						?>
						><?php esc_html_e( '4 Column Layout.', 'new-album-gallery' ); ?></option>
					</select>
				</div>
			</p>

			<!--Loading Icon-->
			<div id="ag_setting_load" class="loader-wrapper loader-wrapper-4" style="display:none;">
				<div class="em_spinner"></div>
			</div>
			
			<div class="text-center">
				<button class="btn btn-primary" type="button" onclick="AgSaveSettings();"><i class="fa fa-save fa"></i><?php esc_html_e( 'Save Changes.', 'new-album-gallery' ); ?></button>
			</div>
		</form>
	</div>
</div>
<?php
// Default settings
register_activation_hook( __FILE__, 'agp_column_defaultsettings' );
function agp_column_defaultsettings() {
	$agpdefaultsettings = array(
		// column settings
		'col_large_desktops' => 'col-lg-4',
		'col_desktops'       => 'col-md-4',
		'col_tablets'        => 'col-sm-4',
		'col_phones'         => 'col-xs-6',
	);
	add_option( 'album_gallery_column_settings', $agpdefaultsettings );
}

	// save settings
if ( isset( $_POST['agp_column_setting_action'] ) ) {
	if ( isset( $_POST['security'] ) ) {
			$ag_save_nonce_value = sanitize_text_field( $_POST['security'] );
		} else {
			$ag_save_nonce_value = '';
		}
	if ( wp_verify_nonce( $ag_save_nonce_value, 'ag_save_nonce' ) ) {
	
		update_option( 'album_gallery_column_settings', $_POST );
	}
} // end of save if
// end of setting page fuction
?>
<script>
	function AgSaveSettings() {
		jQuery("#ag_setting_load").show();
		jQuery.ajax({
			dataType : 'html',
			type: 'POST',
			url : location.href,
			cache: false,
			data : jQuery('#agp-column-settings').serialize() + '&agp_column_setting_action=save_agsetting' + '&security=' + '<?php echo wp_create_nonce( 'ag_save_nonce' ); ?>' ,
			complete : function() {  },
			success: function(data) {
				jQuery("#ag_setting_load").hide();
			}
		});
	}
</script>
