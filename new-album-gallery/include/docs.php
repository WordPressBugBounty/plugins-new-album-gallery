<?php
if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>
<style>
	.nag-docs-wrap {
		max-width: 900px;
		margin: 20px auto;
		font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
	}

	.nag-docs-wrap .nag-docs-header {
		background: linear-gradient(135deg, #2271b1 0%, #135e96 100%);
		color: #fff;
		padding: 30px 35px;
		border-radius: 8px 8px 0 0;
		margin-bottom: 0;
	}

	.nag-docs-wrap .nag-docs-header h1 {
		margin: 0 0 8px 0;
		font-size: 26px;
		font-weight: 600;
		color: #fff;
	}

	.nag-docs-wrap .nag-docs-header p {
		margin: 0;
		font-size: 15px;
		opacity: 0.9;
		color: #fff;
	}

	.nag-docs-section {
		background: #fff;
		border: 1px solid #dcdcde;
		border-top: none;
		padding: 28px 35px;
	}

	.nag-docs-section:last-of-type {
		border-radius: 0 0 8px 8px;
	}

	.nag-docs-section h2 {
		font-size: 20px;
		font-weight: 600;
		color: #1d2327;
		margin: 0 0 15px 0;
		padding-bottom: 10px;
		border-bottom: 2px solid #2271b1;
	}

	.nag-docs-section h3 {
		font-size: 16px;
		font-weight: 600;
		color: #2c3338;
		margin: 20px 0 8px 0;
	}

	.nag-docs-section p {
		font-size: 14px;
		line-height: 1.7;
		color: #50575e;
		margin: 0 0 12px 0;
	}

	.nag-docs-section ol,
	.nag-docs-section ul {
		margin: 8px 0 16px 20px;
		font-size: 14px;
		line-height: 1.8;
		color: #50575e;
	}

	.nag-docs-section ol li,
	.nag-docs-section ul li {
		margin-bottom: 6px;
	}

	.nag-docs-section code,
	.nag-docs-section .nag-shortcode {
		background: #f0f0f1;
		padding: 3px 8px;
		border-radius: 3px;
		font-family: Consolas, Monaco, monospace;
		font-size: 13px;
		color: #2c3338;
		border: 1px solid #dcdcde;
	}

	.nag-docs-section .nag-shortcode-block {
		background: #f6f7f7;
		border: 1px solid #dcdcde;
		border-radius: 4px;
		padding: 14px 20px;
		margin: 12px 0 16px 0;
		font-family: Consolas, Monaco, monospace;
		font-size: 14px;
		color: #1d2327;
		letter-spacing: 0.3px;
	}

	.nag-docs-section .nag-tip {
		background: #fcf9e8;
		border-left: 4px solid #dba617;
		padding: 12px 16px;
		margin: 12px 0 16px 0;
		border-radius: 0 4px 4px 0;
		font-size: 13px;
		color: #50575e;
	}

	.nag-docs-section .nag-tip strong {
		color: #9b6e00;
	}

	.nag-docs-section .nag-info {
		background: #f0f6fc;
		border-left: 4px solid #2271b1;
		padding: 12px 16px;
		margin: 12px 0 16px 0;
		border-radius: 0 4px 4px 0;
		font-size: 13px;
		color: #50575e;
	}

	.nag-docs-section .nag-info strong {
		color: #135e96;
	}

	.nag-step-number {
		display: inline-block;
		background: #2271b1;
		color: #fff;
		width: 28px;
		height: 28px;
		line-height: 28px;
		text-align: center;
		border-radius: 50%;
		font-size: 14px;
		font-weight: 600;
		margin-right: 8px;
	}

	.nag-docs-table {
		width: 100%;
		border-collapse: collapse;
		margin: 12px 0 20px 0;
		font-size: 14px;
	}

	.nag-docs-table th {
		background: #f6f7f7;
		text-align: left;
		padding: 10px 14px;
		border: 1px solid #dcdcde;
		font-weight: 600;
		color: #1d2327;
	}

	.nag-docs-table td {
		padding: 10px 14px;
		border: 1px solid #dcdcde;
		color: #50575e;
	}

	.nag-docs-cta {
		background: #f6f7f7;
		border: 1px solid #dcdcde;
		border-top: none;
		padding: 25px 35px;
		display: flex;
		gap: 12px;
		flex-wrap: wrap;
		align-items: center;
	}

	.nag-docs-section hr {
		border: none;
		border-top: 1px solid #f0f0f1;
		margin: 24px 0;
	}
</style>

<div class="nag-docs-wrap">

	<!-- Header -->
	<div class="nag-docs-header">
		<h1><?php esc_html_e('New Album Gallery — Documentation', 'new-album-gallery'); ?></h1>
		<p><?php esc_html_e('Complete guide to creating, configuring, and displaying beautiful image and video album galleries on your WordPress site.', 'new-album-gallery'); ?></p>
	</div>

	<!-- Table of Contents -->
	<div class="nag-docs-section">
		<h2><?php esc_html_e('Table of Contents', 'new-album-gallery'); ?></h2>
		<ol>
			<li><a href="#nag-install"><?php esc_html_e('Installation & Activation', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-create"><?php esc_html_e('Creating Your First Album Gallery', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-images"><?php esc_html_e('Adding & Managing Images', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-videos"><?php esc_html_e('Adding Videos', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-settings"><?php esc_html_e('Gallery Settings & Configuration', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-columns"><?php esc_html_e('Column & Responsive Layout', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-effects"><?php esc_html_e('Hover Effects & Animations', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-lightbox"><?php esc_html_e('Lightbox Configuration', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-shortcode"><?php esc_html_e('Using the Shortcode', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-widget"><?php esc_html_e('Widget & Sidebar Usage', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-import-export"><?php esc_html_e('Import & Export Galleries', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-faq"><?php esc_html_e('Frequently Asked Questions', 'new-album-gallery'); ?></a></li>
		</ol>
	</div>

	<!-- 1. Installation -->
	<div class="nag-docs-section" id="nag-install">
		<h2><span class="nag-step-number">1</span> <?php esc_html_e('Installation & Activation', 'new-album-gallery'); ?></h2>

		<h3><?php esc_html_e('Method A — Install from WordPress Dashboard', 'new-album-gallery'); ?></h3>
		<ol>
			<li><?php esc_html_e('Log in to your WordPress admin dashboard.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Navigate to Plugins → Add New.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Search for "New Album Gallery" in the search bar.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Click "Install Now" and then "Activate" once installation is complete.', 'new-album-gallery'); ?></li>
		</ol>

		<h3><?php esc_html_e('Method B — Upload ZIP File', 'new-album-gallery'); ?></h3>
		<ol>
			<li><?php esc_html_e('Download the plugin ZIP file from WordPress.org.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Go to Plugins → Add New → Upload Plugin.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Choose the ZIP file and click "Install Now".', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('After installation, click "Activate Plugin".', 'new-album-gallery'); ?></li>
		</ol>

		<div class="nag-info">
			<strong><?php esc_html_e('Note:', 'new-album-gallery'); ?></strong>
			<?php esc_html_e('After activation, a new "Album Gallery" menu item will appear in your WordPress admin sidebar.', 'new-album-gallery'); ?>
		</div>
	</div>

	<!-- 2. Creating Your First Album Gallery -->
	<div class="nag-docs-section" id="nag-create">
		<h2><span class="nag-step-number">2</span> <?php esc_html_e('Creating Your First Album Gallery', 'new-album-gallery'); ?></h2>
		<ol>
			<li><?php esc_html_e('In your WordPress admin, click on "Album Gallery" in the sidebar menu.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Click the "Add New Album Gallery" button at the top of the page.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Give your gallery a descriptive title (e.g., "Summer Vacation 2025" or "Product Photos").', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Click the "Add Images" button to open the WordPress Media Library.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Select the images you want to include, or upload new ones from your computer.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Configure your gallery settings (columns, effects, lightbox) — see sections below for details.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Click "Publish" to save and create your album gallery.', 'new-album-gallery'); ?></li>
		</ol>

		<div class="nag-tip">
			<strong><?php esc_html_e('Tip:', 'new-album-gallery'); ?></strong>
			<?php esc_html_e('The very first image in your gallery will be used as the album cover. Choose your best image for the first position!', 'new-album-gallery'); ?>
		</div>

		<div class="nag-tip">
			<strong><?php esc_html_e('Tip:', 'new-album-gallery'); ?></strong>
			<?php esc_html_e('For the best visual results, use images with the same height and width (square aspect ratio) for all album covers.', 'new-album-gallery'); ?>
		</div>
	</div>

	<!-- 3. Adding & Managing Images -->
	<div class="nag-docs-section" id="nag-images">
		<h2><span class="nag-step-number">3</span> <?php esc_html_e('Adding & Managing Images', 'new-album-gallery'); ?></h2>

		<h3><?php esc_html_e('Adding Images', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Click the "Add Images" button in the gallery editor. You can select multiple images at once from the Media Library or upload new files. All selected images will be added to the gallery.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Reordering Images', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Drag and drop the image thumbnails in the gallery editor to rearrange the display order. Remember, the first image serves as the album cover.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Image Titles', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Each image has a title field. This title is displayed as an overlay on hover and inside the lightbox. Edit the title directly below each thumbnail in the gallery editor.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Removing Images', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('To remove an image from the gallery, click the "×" (remove) button on the image thumbnail. This only removes it from the gallery — it will not delete the file from your Media Library.', 'new-album-gallery'); ?></p>
	</div>

	<!-- 4. Adding Videos -->
	<div class="nag-docs-section" id="nag-videos">
		<h2><span class="nag-step-number">4</span> <?php esc_html_e('Adding Videos', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('New Album Gallery supports video content through embedded YouTube and Vimeo links.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('How to Add a Video', 'new-album-gallery'); ?></h3>
		<ol>
			<li><?php esc_html_e('Add an image to your gallery as a thumbnail/cover for the video.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Set the slide type dropdown to "Video" for that image.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Paste the full YouTube or Vimeo video URL in the link field.', 'new-album-gallery'); ?></li>
		</ol>
		<p><?php esc_html_e('When visitors click on the video thumbnail, the video will open and play in the lightbox viewer.', 'new-album-gallery'); ?></p>

		<div class="nag-info">
			<strong><?php esc_html_e('Supported video formats:', 'new-album-gallery'); ?></strong>
			<?php esc_html_e('YouTube links (youtube.com/watch?v=...) and Vimeo links (vimeo.com/...).', 'new-album-gallery'); ?>
		</div>
	</div>

	<!-- 5. Gallery Settings -->
	<div class="nag-docs-section" id="nag-settings">
		<h2><span class="nag-step-number">5</span> <?php esc_html_e('Gallery Settings & Configuration', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('Each gallery has its own settings panel located below the image editor. Here is a summary of all available options:', 'new-album-gallery'); ?></p>

		<table class="nag-docs-table">
			<thead>
				<tr>
					<th><?php esc_html_e('Setting', 'new-album-gallery'); ?></th>
					<th><?php esc_html_e('Description', 'new-album-gallery'); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><strong><?php esc_html_e('Hover Effect', 'new-album-gallery'); ?></strong></td>
					<td><?php esc_html_e('Choose the visual effect when hovering over gallery images (e.g., Stacks, Overlay).', 'new-album-gallery'); ?></td>
				</tr>
				<tr>
					<td><strong><?php esc_html_e('Animation', 'new-album-gallery'); ?></strong></td>
					<td><?php esc_html_e('Select the entry animation when the gallery loads (e.g., Wobble, Fade In, Bounce).', 'new-album-gallery'); ?></td>
				</tr>
				<tr>
					<td><strong><?php esc_html_e('Lightbox Loop', 'new-album-gallery'); ?></strong></td>
					<td><?php esc_html_e('Enable/disable continuous looping in the lightbox viewer.', 'new-album-gallery'); ?></td>
				</tr>
				<tr>
					<td><strong><?php esc_html_e('Hide Bars Delay', 'new-album-gallery'); ?></strong></td>
					<td><?php esc_html_e('Time in milliseconds before the lightbox navigation bars auto-hide (default: 3000ms).', 'new-album-gallery'); ?></td>
				</tr>
				<tr>
					<td><strong><?php esc_html_e('Remove Bars on Mobile', 'new-album-gallery'); ?></strong></td>
					<td><?php esc_html_e('Toggle to remove lightbox navigation bars on mobile devices for a cleaner viewing experience.', 'new-album-gallery'); ?></td>
				</tr>
				<tr>
					<td><strong><?php esc_html_e('Hide Close Button on Mobile', 'new-album-gallery'); ?></strong></td>
					<td><?php esc_html_e('Toggle to auto-hide the lightbox close button on mobile screens.', 'new-album-gallery'); ?></td>
				</tr>
			</tbody>
		</table>
	</div>

	<!-- 6. Column & Responsive Layout -->
	<div class="nag-docs-section" id="nag-columns">
		<h2><span class="nag-step-number">6</span> <?php esc_html_e('Column & Responsive Layout', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('Column settings are managed globally from the "Column Settings" page under the Album Gallery menu. These settings control how many columns display on each device size:', 'new-album-gallery'); ?></p>

		<table class="nag-docs-table">
			<thead>
				<tr>
					<th><?php esc_html_e('Device', 'new-album-gallery'); ?></th>
					<th><?php esc_html_e('Screen Size', 'new-album-gallery'); ?></th>
					<th><?php esc_html_e('Column Options', 'new-album-gallery'); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php esc_html_e('Large Desktops', 'new-album-gallery'); ?></td>
					<td><?php esc_html_e('≥1200px', 'new-album-gallery'); ?></td>
					<td><?php esc_html_e('1 to 6 columns', 'new-album-gallery'); ?></td>
				</tr>
				<tr>
					<td><?php esc_html_e('Desktops', 'new-album-gallery'); ?></td>
					<td><?php esc_html_e('≥992px', 'new-album-gallery'); ?></td>
					<td><?php esc_html_e('1 to 6 columns', 'new-album-gallery'); ?></td>
				</tr>
				<tr>
					<td><?php esc_html_e('Tablets', 'new-album-gallery'); ?></td>
					<td><?php esc_html_e('≥768px', 'new-album-gallery'); ?></td>
					<td><?php esc_html_e('1 to 6 columns', 'new-album-gallery'); ?></td>
				</tr>
				<tr>
					<td><?php esc_html_e('Phones', 'new-album-gallery'); ?></td>
					<td><?php esc_html_e('<768px', 'new-album-gallery'); ?></td>
					<td><?php esc_html_e('1 to 6 columns', 'new-album-gallery'); ?></td>
				</tr>
			</tbody>
		</table>

		<div class="nag-tip">
			<strong><?php esc_html_e('Recommendation:', 'new-album-gallery'); ?></strong>
			<?php esc_html_e('Use 3-4 columns on desktops, 2-3 on tablets, and 1-2 on phones for the best visual balance.', 'new-album-gallery'); ?>
		</div>
	</div>

	<!-- 7. Hover Effects & Animations -->
	<div class="nag-docs-section" id="nag-effects">
		<h2><span class="nag-step-number">7</span> <?php esc_html_e('Hover Effects & Animations', 'new-album-gallery'); ?></h2>

		<h3><?php esc_html_e('Hover Effects', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Hover effects determine what happens visually when a visitor moves their mouse over a gallery image. Available effects include:', 'new-album-gallery'); ?></p>
		<ul>
			<li><strong><?php esc_html_e('Stacks', 'new-album-gallery'); ?></strong> — <?php esc_html_e('A stacked card effect with depth.', 'new-album-gallery'); ?></li>
			<li><strong><?php esc_html_e('Overlay', 'new-album-gallery'); ?></strong> — <?php esc_html_e('A color overlay appears with the image title.', 'new-album-gallery'); ?></li>
		</ul>

		<h3><?php esc_html_e('Load Animations', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Animations play when the gallery first appears on screen. Choose from effects like:', 'new-album-gallery'); ?></p>
		<ul>
			<li><?php esc_html_e('Wobble, Bounce, Flash, Pulse, Shake, Swing, Tada', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Fade In, Fade In Down, Fade In Left, Fade In Right, Fade In Up', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Flip In X, Flip In Y', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Rotate In, Roll In, Zoom In', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Light Speed In, Bounce In, Slide In', 'new-album-gallery'); ?></li>
		</ul>
	</div>

	<!-- 8. Lightbox Configuration -->
	<div class="nag-docs-section" id="nag-lightbox">
		<h2><span class="nag-step-number">8</span> <?php esc_html_e('Lightbox Configuration', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('The lightbox is the full-screen viewer that opens when a visitor clicks on a gallery image. You can configure the following lightbox settings per gallery:', 'new-album-gallery'); ?></p>

		<ul>
			<li><strong><?php esc_html_e('Loop', 'new-album-gallery'); ?></strong> — <?php esc_html_e('When enabled, after the last image, navigating forward goes back to the first image.', 'new-album-gallery'); ?></li>
			<li><strong><?php esc_html_e('Hide Bars Delay', 'new-album-gallery'); ?></strong> — <?php esc_html_e('Controls how quickly the navigation arrows and close button fade out during inactivity (in milliseconds).', 'new-album-gallery'); ?></li>
			<li><strong><?php esc_html_e('Remove Bars on Mobile', 'new-album-gallery'); ?></strong> — <?php esc_html_e('Removes the top and bottom navigation bars on mobile for a clean full-screen experience.', 'new-album-gallery'); ?></li>
			<li><strong><?php esc_html_e('Hide Close Button on Mobile', 'new-album-gallery'); ?></strong> — <?php esc_html_e('Hides the close button on mobile. Visitors can close the lightbox by tapping outside the image.', 'new-album-gallery'); ?></li>
		</ul>
	</div>

	<!-- 9. Using the Shortcode -->
	<div class="nag-docs-section" id="nag-shortcode">
		<h2><span class="nag-step-number">9</span> <?php esc_html_e('Using the Shortcode', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('After publishing a gallery, a unique shortcode is generated. Copy this shortcode and paste it into any page, post, or text widget to display the gallery.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Shortcode Format', 'new-album-gallery'); ?></h3>
		<div class="nag-shortcode-block">
			[AGAL id=YOUR_GALLERY_ID]
		</div>
		<p><?php esc_html_e('Replace YOUR_GALLERY_ID with the actual post ID of your gallery. You can find the shortcode with the correct ID on the gallery edit screen, or in the Gallery list table under the "Shortcode" column.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Example', 'new-album-gallery'); ?></h3>
		<div class="nag-shortcode-block">
			[AGAL id=42]
		</div>
		<p><?php esc_html_e('This would display the album gallery with post ID 42.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Where You Can Use Shortcodes', 'new-album-gallery'); ?></h3>
		<ul>
			<li><?php esc_html_e('Pages — Paste the shortcode into any page content area.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Posts — Embed galleries within blog posts.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Text/HTML Widgets — Add galleries to sidebars and footer widget areas.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Page Builders — Use a Shortcode block in Elementor, Gutenberg, Beaver Builder, etc.', 'new-album-gallery'); ?></li>
		</ul>

		<div class="nag-tip">
			<strong><?php esc_html_e('Quick Copy:', 'new-album-gallery'); ?></strong>
			<?php esc_html_e('Use the "Copy" button next to each shortcode in the gallery list for one-click copying.', 'new-album-gallery'); ?>
		</div>
	</div>

	<!-- 10. Widget & Sidebar Usage -->
	<div class="nag-docs-section" id="nag-widget">
		<h2><span class="nag-step-number">10</span> <?php esc_html_e('Widget & Sidebar Usage', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('You can display album galleries in your website sidebars, footers, or any other widget area:', 'new-album-gallery'); ?></p>
		<ol>
			<li><?php esc_html_e('Go to Appearance → Widgets in your WordPress admin.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Add a "Text" or "Custom HTML" widget to your desired widget area (sidebar, footer, etc.).', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Paste the gallery shortcode [AGAL id=YOUR_ID] into the widget content.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Save the widget. Your gallery will now appear in that widget area.', 'new-album-gallery'); ?></li>
		</ol>

		<div class="nag-info">
			<strong><?php esc_html_e('Note:', 'new-album-gallery'); ?></strong>
			<?php esc_html_e('For sidebar galleries, consider using 1-2 columns in Column Settings to keep the layout compact and visually appealing.', 'new-album-gallery'); ?>
		</div>
	</div>

	<!-- 11. Import & Export -->
	<div class="nag-docs-section" id="nag-import-export">
		<h2><span class="nag-step-number">11</span> <?php esc_html_e('Import & Export Galleries', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('New Album Gallery supports importing and exporting gallery data, allowing you to backup your galleries or migrate them between sites.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Exporting', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Gallery data is stored as custom post types and post meta. You can export galleries using the WordPress built-in export tool (Tools → Export) by selecting the "Album Gallery" post type.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Importing', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('To import galleries on another site, install the WordPress Importer plugin (Tools → Import → WordPress) and upload the exported XML file. Make sure to check "Download and import file attachments" to include images.', 'new-album-gallery'); ?></p>
	</div>

	<!-- 12. FAQ -->
	<div class="nag-docs-section" id="nag-faq">
		<h2><span class="nag-step-number">12</span> <?php esc_html_e('Frequently Asked Questions', 'new-album-gallery'); ?></h2>

		<h3><?php esc_html_e('Q: How many galleries can I create?', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('There is no limit. You can create as many album galleries as you need — each with its own images, videos, and settings.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Q: How many images can I add per gallery?', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('There is no built-in limit on the number of images per gallery. However, for best performance, we recommend keeping each gallery under 100 images.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Q: Is the gallery responsive/mobile-friendly?', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Yes! The gallery automatically adapts to all screen sizes. You can customize the number of columns displayed on each device type via the Column Settings page.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Q: Can I use the same gallery on multiple pages?', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Yes. Simply paste the same shortcode [AGAL id=...] on as many pages or posts as you want. Any changes to the gallery will automatically reflect everywhere it is displayed.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Q: Does the gallery work with page builders?', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Yes. New Album Gallery works with Gutenberg, Elementor, Beaver Builder, Divi, and any builder that supports shortcodes. Use a Shortcode or HTML block to embed your gallery.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Q: Will removing a gallery delete my images?', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('No. Deleting a gallery only removes the gallery post. All images remain safely in your WordPress Media Library.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Q: My gallery is not displaying — what should I check?', 'new-album-gallery'); ?></h3>
		<ul>
			<li><?php esc_html_e('Make sure the gallery status is "Published" (not Draft).', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Verify the shortcode ID matches the gallery post ID.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Check for JavaScript errors in the browser console (F12) that might indicate a theme or plugin conflict.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Try deactivating other plugins temporarily to rule out conflicts.', 'new-album-gallery'); ?></li>
		</ul>
	</div>

	<!-- Call to Action -->
	<div class="nag-docs-cta">
		<a class="button button-primary button-hero" href="https://awplife.com/wordpress-plugins/album-gallery-premium/" target="_blank" rel="noopener noreferrer">
			<?php esc_html_e('Upgrade to Pro', 'new-album-gallery'); ?>
		</a>
		<a class="button button-secondary button-hero" href="https://wordpress.org/support/view/plugin-reviews/new-album-gallery/" target="_blank" rel="noopener noreferrer">
			<?php esc_html_e('Leave a Review', 'new-album-gallery'); ?>
		</a>
	</div>

</div>