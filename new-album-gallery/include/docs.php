<?php
if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>
<style>
	:root {
		--ag-docs-bg: #f8fafc;
		--ag-docs-card: #ffffff;
		--ag-docs-text: #334155;
		--ag-docs-heading: #1e293b;
	}

	.nag-docs-wrap {
		max-width: 1000px;
		margin: 30px auto;
		font-family: 'Inter', -apple-system, sans-serif;
		color: var(--ag-docs-text);
		background: var(--ag-docs-bg);
		padding: 20px;
		border-radius: var(--ag-radius);
	}

	.nag-docs-wrap .nag-docs-header {
		background: linear-gradient(135deg, var(--ag-primary) 0%, var(--ag-secondary) 100%);
		color: #fff;
		padding: 50px 40px;
		border-radius: var(--ag-radius) var(--ag-radius) 0 0;
		margin-bottom: 0;
		box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.3);
		position: relative;
		overflow: hidden;
	}

	.nag-docs-wrap .nag-docs-header h1 {
		margin: 0 0 12px 0;
		font-size: 32px;
		font-weight: 800;
		color: #fff;
		letter-spacing: -0.025em;
		position: relative;
	}

	.nag-docs-wrap .nag-docs-header p {
		margin: 0;
		font-size: 17px;
		opacity: 0.9;
		color: #fff;
		max-width: 600px;
		line-height: 1.6;
		position: relative;
	}

	.nag-docs-wrap .nag-docs-header p {
		margin: 0;
		font-size: 17px;
		opacity: 0.9;
		color: #fff;
		max-width: 600px;
		line-height: 1.6;
		position: relative;
	}

	.nag-docs-section {
		background: var(--ag-docs-card);
		border: 1px solid rgba(0,0,0,0.05);
		padding: 40px;
		margin-bottom: 0;
		border-top: none;
		box-shadow: 0 1px 3px rgba(0,0,0,0.05);
	}

	.nag-docs-section:last-of-type {
		border-radius: 0 0 var(--ag-radius) var(--ag-radius);
		box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
	}

	.nag-docs-section h2 {
		font-size: 24px;
		font-weight: 800;
		color: var(--ag-primary);
		margin: 0 0 25px 0;
		padding-bottom: 15px;
		border-bottom: 2px solid #e2e8f0;
		display: flex;
		align-items: center;
		gap: 15px;
	}

	.nag-docs-section h3 {
		font-size: 18px;
		font-weight: 700;
		color: var(--ag-docs-heading);
		margin: 30px 0 12px 0;
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.nag-docs-section h3::before {
		content: '';
		width: 4px;
		height: 18px;
		background: var(--ag-primary);
		border-radius: 2px;
	}

	.nag-docs-section p {
		font-size: 15px;
		line-height: 1.8;
		color: var(--ag-docs-text);
		margin: 0 0 16px 0;
	}

	.nag-docs-section ol,
	.nag-docs-section ul {
		margin: 15px 0 25px 25px;
		font-size: 15px;
		line-height: 1.8;
	}

	.nag-docs-section ol li,
	.nag-docs-section ul li {
		margin-bottom: 10px;
		padding-left: 5px;
	}

	.nag-docs-section code,
	.nag-docs-section .nag-shortcode {
		background: #f1f5f9;
		padding: 4px 10px;
		border-radius: 6px;
		font-family: 'JetBrains Mono', 'Fira Code', monospace;
		font-size: 13px;
		color: var(--ag-primary);
		border: 1px solid #e2e8f0;
		font-weight: 600;
	}

	.nag-docs-section .nag-shortcode-block {
		background: #0f172a;
		border-radius: 12px;
		padding: 24px;
		margin: 20px 0;
		font-family: 'JetBrains Mono', monospace;
		font-size: 15px;
		color: #38bdf8;
		letter-spacing: 0.025em;
		box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
		border: 1px solid rgba(255,255,255,0.1);
	}

	.nag-docs-section .nag-tip {
		background: #fffbeb;
		border-left: 4px solid #f59e0b;
		padding: 20px;
		margin: 25px 0;
		border-radius: 0 8px 8px 0;
		font-size: 14px;
		color: #92400e;
	}

	.nag-docs-section .nag-info {
		background: #eff6ff;
		border-left: 4px solid #3b82f6;
		padding: 20px;
		margin: 25px 0;
		border-radius: 0 8px 8px 0;
		font-size: 14px;
		color: #1e40af;
	}

	.nag-step-number {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		background: var(--ag-primary);
		color: #fff;
		width: 32px;
		height: 32px;
		border-radius: 50%;
		font-size: 14px;
		font-weight: 800;
		flex-shrink: 0;
		box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
	}

	.nag-docs-table {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
		margin: 25px 0;
		font-size: 14px;
		border: 1px solid #e2e8f0;
		border-radius: 8px;
		overflow: hidden;
	}

	.nag-docs-table th {
		background: #f8fafc;
		text-align: left;
		padding: 15px;
		font-weight: 700;
		color: var(--ag-docs-heading);
		border-bottom: 1px solid #e2e8f0;
	}

	.nag-docs-table td {
		padding: 15px;
		border-bottom: 1px solid #f1f5f9;
		color: var(--ag-docs-text);
	}

	.nag-docs-table tr:last-child td {
		border-bottom: none;
	}

	.nag-video-btn {
		display: inline-flex;
		align-items: center;
		gap: 10px;
		background: #ef4444;
		color: #fff !important;
		padding: 14px 28px;
		border-radius: 10px;
		font-size: 16px;
		font-weight: 700;
		text-decoration: none !important;
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
	}

	.nag-video-btn:hover {
		background: #dc2626;
		box-shadow: 0 8px 25px rgba(239, 68, 68, 0.5);
		transform: translateY(-2px);
		color: #fff !important;
	}

	.nag-video-section {
		background: #0f172a;
		padding: 50px 40px;
		text-align: center;
		border: 1px solid rgba(255,255,255,0.05);
		border-top: none;
		position: relative;
	}

	.nag-video-section h2 {
		color: #fff !important;
		border-bottom-color: rgba(255,255,255,0.1) !important;
		justify-content: center;
		margin-bottom: 20px !important;
	}

	.nag-video-section p {
		color: #94a3b8 !important;
		font-size: 16px !important;
		max-width: 600px;
		margin: 0 auto 30px auto !important;
	}

	.nag-docs-cta {
		background: #f8fafc;
		border: 1px solid #e2e8f0;
		border-top: none;
		padding: 40px;
		display: flex;
		gap: 20px;
		justify-content: center;
		align-items: center;
	}
</style>

<div class="nag-docs-wrap">

	<!-- Header -->
	<div class="nag-docs-header">
		<h1><?php esc_html_e('Album Gallery — Documentation', 'new-album-gallery'); ?></h1>
		<p><?php esc_html_e('Complete guide to creating, configuring, and displaying beautiful image and video album galleries.', 'new-album-gallery'); ?></p>
	</div>

	<!-- Video Tutorial -->
	<div class="nag-video-section">
		<h2><span class="nag-step-number" style="background:#ff0000;">▶</span> <?php esc_html_e('Video Tutorial', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('Watch our step-by-step video tutorial to learn how to set up and use Album Gallery on your WordPress site.', 'new-album-gallery'); ?></p>
		<a href="https://www.youtube.com/watch?v=rUB-1FkBW48" target="_blank" rel="noopener noreferrer" class="nag-video-btn">
			<span class="dashicons dashicons-video-alt3"></span>
			<?php esc_html_e('Watch Video Tutorial on YouTube', 'new-album-gallery'); ?>
		</a>
	</div>

	<!-- Table of Contents -->
	<div class="nag-docs-section">
		<h2><?php esc_html_e('Table of Contents', 'new-album-gallery'); ?></h2>
		<ol>
			<li><a href="#nag-create"><?php esc_html_e('Creating Your First Album Gallery', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-content"><?php esc_html_e('Adding & Managing Content', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-layout"><?php esc_html_e('Layout Settings & Responsive Grid', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-lightbox"><?php esc_html_e('Lightbox Controls & Experience', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-effects"><?php esc_html_e('Visual Effects & Animations', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-shortcode"><?php esc_html_e('Using the Shortcode', 'new-album-gallery'); ?></a></li>
			<li><a href="#nag-faq"><?php esc_html_e('Frequently Asked Questions', 'new-album-gallery'); ?></a></li>
		</ol>
	</div>

	<!-- 1. Creating Your First Album Gallery -->
	<div class="nag-docs-section" id="nag-create">
		<h2><span class="nag-step-number">1</span> <?php esc_html_e('Creating Your First Album Gallery', 'new-album-gallery'); ?></h2>
		<ol>
			<li><?php esc_html_e('In your WordPress admin, click on "Album Gallery" in the sidebar menu.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Click the "Add Album Gallery" button at the top of the page.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Give your gallery a descriptive title (e.g., "Summer Vacation" or "Portfolio").', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Click the "Add New Images" card to open the WordPress Media Library.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Select your images and click "Select". You can reorder them by dragging the cards.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Configure your settings in the tabs below and click "Publish".', 'new-album-gallery'); ?></li>
		</ol>

		<div class="nag-tip">
			<strong><?php esc_html_e('Tip:', 'new-album-gallery'); ?></strong>
			<?php esc_html_e('The first image in your list serves as the "Album Cover" that visitors see on your site.', 'new-album-gallery'); ?>
		</div>
	</div>

	<!-- 2. Adding & Managing Content -->
	<div class="nag-docs-section" id="nag-content">
		<h2><span class="nag-step-number">2</span> <?php esc_html_e('Adding & Managing Content', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('The "Gallery Content" tab allows you to manage the media inside your album.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Adding Videos', 'new-album-gallery'); ?></h3>
		<ol>
			<li><?php esc_html_e('Add an image to serve as the video thumbnail.', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('In the item card, change the "Type" dropdown from "Image" to "Video".', 'new-album-gallery'); ?></li>
			<li><?php esc_html_e('Paste the full YouTube or Vimeo URL into the "Video Link" field.', 'new-album-gallery'); ?></li>
		</ol>

		<h3><?php esc_html_e('Managing Items', 'new-album-gallery'); ?></h3>
		<ul>
			<li><strong><?php esc_html_e('Reordering:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Drag and drop cards to change the display order.', 'new-album-gallery'); ?></li>
			<li><strong><?php esc_html_e('Captions:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Edit the title directly on the card to update the lightbox caption.', 'new-album-gallery'); ?></li>
			<li><strong><?php esc_html_e('Removing:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Click the trash icon to remove an item from the album.', 'new-album-gallery'); ?></li>
		</ul>
	</div>

	<!-- 3. Layout Settings -->
	<div class="nag-docs-section" id="nag-layout">
		<h2><span class="nag-step-number">3</span> <?php esc_html_e('Layout Settings & Responsive Grid', 'new-album-gallery'); ?></h2>
		
		<h3><?php esc_html_e('Gallery Thumb Size', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Choose the resolution for the grid thumbnails. Smaller sizes (150x150) load faster, while larger sizes (300px+) look sharper on high-resolution screens.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Column Logic', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('You can choose between two modes:', 'new-album-gallery'); ?></p>
		<ul>
			<li><strong><?php esc_html_e('Uniform:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Uses the global settings defined in the Album Gallery > Column Settings menu.', 'new-album-gallery'); ?></li>
			<li><strong><?php esc_html_e('Individual:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Allows you to set specific column counts for this gallery across Desktops, Tablets, and Phones.', 'new-album-gallery'); ?></li>
		</ul>
	</div>

	<!-- 4. Lightbox Controls -->
	<div class="nag-docs-section" id="nag-lightbox">
		<h2><span class="nag-step-number">4</span> <?php esc_html_e('Lightbox Controls & Experience', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('Control how the lightbox behaves when a user clicks on your album.', 'new-album-gallery'); ?></p>

		<ul>
			<li><strong><?php esc_html_e('Image Title:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Toggle the display of the image title as a caption at the bottom of the lightbox.', 'new-album-gallery'); ?></li>
			<li><strong><?php esc_html_e('Loop Gallery:', 'new-album-gallery'); ?></strong> <?php esc_html_e('When enabled, navigating past the last image will loop back to the first one.', 'new-album-gallery'); ?></li>
			<li><strong><?php esc_html_e('Auto Play:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Automatically advance to the next image after a specified delay (in milliseconds).', 'new-album-gallery'); ?></li>
		</ul>
	</div>

	<!-- 5. Visual Effects -->
	<div class="nag-docs-section" id="nag-effects">
		<h2><span class="nag-step-number">5</span> <?php esc_html_e('Visual Effects & Animations', 'new-album-gallery'); ?></h2>
		
		<h3><?php esc_html_e('Entrance Animation', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Choose how the gallery items animate into view when the page loads (e.g., Wobble, Bounce, Fade In).', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Hover Effects', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Select the interaction style when a user hovers over the album cover:', 'new-album-gallery'); ?></p>
		<ul>
			<li><strong><?php esc_html_e('Stacks:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Creates a "photo stack" depth effect.', 'new-album-gallery'); ?></li>
			<li><strong><?php esc_html_e('Overlay:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Displays a smooth color overlay with an icon.', 'new-album-gallery'); ?></li>
		</ul>

		<h3><?php esc_html_e('Album Title Styling', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Customize the font size and color of the main album title that appears over the cover image.', 'new-album-gallery'); ?></p>
	</div>

	<!-- 6. Using the Shortcode -->
	<div class="nag-docs-section" id="nag-shortcode">
		<h2><span class="nag-step-number">6</span> <?php esc_html_e('Using the Shortcode', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('To display your gallery, copy the shortcode from the "Album Gallery" list and paste it into any page or post.', 'new-album-gallery'); ?></p>

		<div class="nag-shortcode-block">
			[AGAL id=YOUR_ID]
		</div>
		
		<div class="nag-info">
			<?php esc_html_e('You can also use the shortcode in Sidebar Widgets by using a "Shortcode" or "Text" widget.', 'new-album-gallery'); ?>
		</div>
	</div>

	<!-- 7. FAQ -->
	<div class="nag-docs-section" id="nag-faq">
		<h2><span class="nag-step-number">7</span> <?php esc_html_e('Frequently Asked Questions', 'new-album-gallery'); ?></h2>

		<h3><?php esc_html_e('Q: Why are my videos not playing?', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Ensure you have pasted the full URL (e.g., https://www.youtube.com/watch?v=...) and selected the "Video" type in the item settings.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Q: Can I change the cover image?', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Yes, the first image in your "Gallery Content" list is automatically used as the cover. Simply drag your preferred image to the top position.', 'new-album-gallery'); ?></p>

		<h3><?php esc_html_e('Q: Is it mobile friendly?', 'new-album-gallery'); ?></h3>
		<p><?php esc_html_e('Yes, the gallery uses a responsive grid system that adapts to all screen sizes.', 'new-album-gallery'); ?></p>
	</div>

	<!-- Call to Action -->
	<div class="nag-docs-cta">
		<a class="button button-primary button-hero" href="https://awplife.com/demo/album-gallery-premium/" target="_blank" rel="noopener noreferrer">
			<span class="dashicons dashicons-visibility" style="vertical-align: middle; margin-right: 5px;"></span>
			<?php esc_html_e('Live Demo', 'new-album-gallery'); ?>
		</a>
		<a class="button button-secondary button-hero" href="https://awplife.com/account/signup/album-gallery-premium/" target="_blank" rel="noopener noreferrer">
			<span class="dashicons dashicons-cart" style="vertical-align: middle; margin-right: 5px;"></span>
			<?php esc_html_e('Buy Pro Version', 'new-album-gallery'); ?>
		</a>
		<a class="button button-hero" href="https://wordpress.org/support/plugin/new-album-gallery/reviews/" target="_blank" rel="noopener noreferrer">
			<span class="dashicons dashicons-star-filled" style="vertical-align: middle; margin-right: 5px;"></span>
			<?php esc_html_e('Leave a Review', 'new-album-gallery'); ?>
		</a>
	</div>

</div>