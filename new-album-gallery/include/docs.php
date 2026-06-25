<?php
if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>
<style>
	:root {
		--ag-docs-bg: #f8fafc;
		--ag-docs-card: #ffffff;
		--ag-docs-text: #475569;
		--ag-docs-text-muted: #64748b;
		--ag-docs-heading: #0f172a;
		--ag-primary: #4f46e5;
		--ag-primary-hover: #4338ca;
		--ag-secondary: #7c3aed;
		--ag-accent: #0ea5e9;
		--ag-border: #e2e8f0;
		--ag-radius: 16px;
		--ag-radius-sm: 8px;
		--ag-shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03);
		--ag-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
		--ag-shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
		--ag-transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
	}

	.nag-docs-wrap {
		max-width: 1280px;
		margin: 20px auto;
		font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		color: var(--ag-docs-text);
		padding: 0 15px;
		box-sizing: border-box;
	}

	.nag-docs-wrap * {
		box-sizing: border-box;
	}

	/* Header Styling */
	.nag-docs-header {
		background: linear-gradient(135deg, var(--ag-primary) 0%, var(--ag-secondary) 100%);
		color: #fff;
		padding: 45px 40px;
		border-radius: var(--ag-radius);
		margin-bottom: 30px;
		box-shadow: var(--ag-shadow-lg);
		position: relative;
		overflow: hidden;
	}

	.nag-docs-header::before {
		content: '';
		position: absolute;
		top: -50%;
		left: -50%;
		width: 200%;
		height: 200%;
		background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 60%);
		transform: rotate(30deg);
		pointer-events: none;
	}

	.nag-docs-header h1 {
		margin: 0 0 12px 0;
		font-size: 32px;
		font-weight: 800;
		color: #fff;
		letter-spacing: -0.025em;
	}

	.nag-docs-header p {
		margin: 0;
		font-size: 16px;
		color: rgba(255, 255, 255, 0.9);
		max-width: 650px;
		line-height: 1.6;
	}

	.nag-docs-header .nag-badge {
		display: inline-flex;
		align-items: center;
		background: rgba(255, 255, 255, 0.18);
		backdrop-filter: blur(4px);
		color: #fff;
		padding: 6px 14px;
		border-radius: 30px;
		font-size: 11px;
		font-weight: 700;
		letter-spacing: 0.05em;
		margin-bottom: 16px;
		text-transform: uppercase;
		border: 1px solid rgba(255, 255, 255, 0.25);
	}

	/* Two-Column Layout */
	.nag-docs-layout {
		display: grid;
		grid-template-columns: 280px 1fr;
		gap: 30px;
		align-items: start;
	}

	@media (max-width: 991px) {
		.nag-docs-layout {
			grid-template-columns: 1fr;
		}
	}

	/* Sidebar Styling */
	.nag-docs-sidebar {
		position: sticky;
		top: 50px;
		background: var(--ag-docs-card);
		border: 1px solid var(--ag-border);
		border-radius: var(--ag-radius);
		padding: 24px;
		box-shadow: var(--ag-shadow-sm);
		max-height: calc(100vh - 90px);
		overflow-y: auto;
	}

	@media (max-width: 991px) {
		.nag-docs-sidebar {
			position: relative;
			top: 0;
			max-height: none;
			margin-bottom: 20px;
		}
	}

	/* Custom Sidebar Scrollbar */
	.nag-docs-sidebar::-webkit-scrollbar {
		width: 6px;
	}
	.nag-docs-sidebar::-webkit-scrollbar-track {
		background: transparent;
	}
	.nag-docs-sidebar::-webkit-scrollbar-thumb {
		background: #cbd5e1;
		border-radius: 3px;
	}
	.nag-docs-sidebar::-webkit-scrollbar-thumb:hover {
		background: #94a3b8;
	}

	/* Sidebar Search Box */
	.nag-search-wrapper {
		position: relative;
		margin-bottom: 20px;
	}

	.nag-search-wrapper .dashicons {
		position: absolute;
		left: 12px;
		top: 50%;
		transform: translateY(-50%);
		color: var(--ag-docs-text-muted);
		font-size: 18px;
		width: 18px;
		height: 18px;
	}

	#nag-docs-search {
		width: 100%;
		padding: 10px 12px 10px 38px;
		border: 1px solid var(--ag-border);
		border-radius: var(--ag-radius-sm);
		font-size: 13.5px;
		background: #f8fafc;
		color: var(--ag-docs-heading);
		transition: var(--ag-transition);
	}

	#nag-docs-search:focus {
		background: #fff;
		border-color: var(--ag-primary);
		box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
		outline: none;
	}

	.nag-sidebar-menu {
		list-style: none;
		padding: 0;
		margin: 0;
	}

	.nag-sidebar-item {
		margin: 0 0 6px 0;
	}

	.nag-sidebar-link {
		display: flex;
		align-items: center;
		gap: 12px;
		padding: 10px 14px;
		color: var(--ag-docs-text);
		text-decoration: none !important;
		border-radius: var(--ag-radius-sm);
		font-size: 13.5px;
		font-weight: 600;
		transition: var(--ag-transition);
	}

	.nag-sidebar-link:hover {
		background: #f1f5f9;
		color: var(--ag-primary);
	}

	.nag-sidebar-link.active {
		background: linear-gradient(135deg, var(--ag-primary) 0%, var(--ag-secondary) 100%);
		color: #ffffff !important;
		box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
	}

	.nag-sidebar-link .dashicons {
		font-size: 18px;
		width: 18px;
		height: 18px;
		color: var(--ag-docs-text-muted);
		transition: var(--ag-transition);
	}

	.nag-sidebar-link.active .dashicons {
		color: #ffffff;
	}

	/* Content Area Styling */
	.nag-docs-content {
		min-width: 0;
	}

	.nag-docs-section {
		background: var(--ag-docs-card);
		border: 1px solid var(--ag-border);
		padding: 40px;
		margin-bottom: 30px;
		border-radius: var(--ag-radius);
		box-shadow: var(--ag-shadow-sm);
		transition: var(--ag-transition);
		scroll-margin-top: 80px;
	}

	.nag-docs-section:hover {
		box-shadow: var(--ag-shadow);
		border-color: rgba(79, 70, 229, 0.3);
	}

	.nag-docs-section h2 {
		font-size: 22px;
		font-weight: 800;
		color: var(--ag-docs-heading);
		margin: 0 0 25px 0;
		padding-bottom: 16px;
		border-bottom: 2px solid var(--ag-border);
		display: flex;
		align-items: center;
		gap: 12px;
	}

	.nag-docs-section h2 .dashicons {
		font-size: 22px;
		width: 22px;
		height: 22px;
		color: var(--ag-primary);
	}

	.nag-docs-section h3 {
		font-size: 16px;
		font-weight: 700;
		color: var(--ag-docs-heading);
		margin: 32px 0 16px 0;
		display: flex;
		align-items: center;
		gap: 10px;
	}

	.nag-docs-section h3::before {
		content: '';
		width: 4px;
		height: 16px;
		background: var(--ag-secondary);
		border-radius: 2px;
	}

	.nag-docs-section p {
		font-size: 14.5px;
		line-height: 1.75;
		color: var(--ag-docs-text);
		margin: 0 0 16px 0;
	}

	.nag-docs-section ol,
	.nag-docs-section ul {
		margin: 15px 0 25px 20px;
		font-size: 14px;
		line-height: 1.75;
	}

	.nag-docs-section ol li,
	.nag-docs-section ul li {
		margin-bottom: 8px;
	}

	/* Code & Shortcode elements */
	.nag-docs-section code {
		background: #f1f5f9;
		padding: 3px 8px;
		border-radius: 6px;
		font-family: 'Consolas', 'Courier New', monospace;
		font-size: 13px;
		color: var(--ag-secondary);
		border: 1px solid var(--ag-border);
		font-weight: 600;
	}

	.nag-code-block-wrapper {
		position: relative;
		background: #0f172a;
		border-radius: 10px;
		padding: 16px 20px;
		margin: 15px 0;
		border: 1px solid rgba(255,255,255,0.08);
		box-shadow: inset 0 2px 4px rgba(0,0,0,0.15);
		display: flex;
		justify-content: space-between;
		align-items: center;
		gap: 15px;
	}

	.nag-code-block {
		font-family: 'Consolas', 'Courier New', monospace;
		font-size: 14.5px;
		color: #38bdf8;
		margin: 0;
		padding: 0;
		overflow-x: auto;
		white-space: pre-wrap;
		word-break: break-all;
		font-weight: 600;
		flex: 1;
	}

	.nag-copy-btn {
		background: rgba(255, 255, 255, 0.08);
		border: 1px solid rgba(255, 255, 255, 0.15);
		color: #e2e8f0;
		padding: 6px 12px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 600;
		cursor: pointer;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		transition: var(--ag-transition);
		flex-shrink: 0;
	}

	.nag-copy-btn:hover {
		background: rgba(255, 255, 255, 0.15);
		color: #fff;
		border-color: rgba(255, 255, 255, 0.3);
	}

	.nag-copy-btn.copied {
		background: #10b981;
		border-color: #10b981;
		color: #fff;
	}

	.nag-copy-btn .dashicons {
		font-size: 14px;
		width: 14px;
		height: 14px;
	}

	/* Alerts styling */
	.nag-info, .nag-tip, .nag-pro-note {
		padding: 18px 24px;
		margin: 24px 0;
		border-radius: var(--ag-radius-sm);
		font-size: 14px;
		line-height: 1.75;
	}

	.nag-info {
		background: #eff6ff;
		border-left: 4px solid #3b82f6;
		color: #1e40af;
	}

	.nag-tip {
		background: #fffbeb;
		border-left: 4px solid #f59e0b;
		color: #78350f;
	}

	.nag-pro-note {
		background: #faf5ff;
		border-left: 4px solid #8b5cf6;
		color: #581c87;
	}

	.nag-info strong, .nag-tip strong, .nag-pro-note strong {
		display: block;
		font-size: 13px;
		font-weight: 700;
		letter-spacing: 0.05em;
		text-transform: uppercase;
		margin-bottom: 6px;
	}

	.nag-info strong { color: #2563eb; }
	.nag-tip strong { color: #d97706; }
	.nag-pro-note strong { color: #7c3aed; }

	/* Tables Styling */
	.nag-docs-table {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
		margin: 25px 0;
		font-size: 13.5px;
		border: 1px solid var(--ag-border);
		border-radius: var(--ag-radius-sm);
		overflow: hidden;
	}

	.nag-docs-table th {
		background: #f8fafc;
		text-align: left;
		padding: 14px 18px;
		font-weight: 700;
		color: var(--ag-docs-heading);
		border-bottom: 1px solid var(--ag-border);
	}

	.nag-docs-table td {
		padding: 14px 18px;
		border-bottom: 1px solid #f1f5f9;
		color: var(--ag-docs-text);
	}

	.nag-docs-table tr:last-child td {
		border-bottom: none;
	}

	/* Gutenberg & Elementor Shortcode Guide Cards */
	.nag-builders-grid {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 20px;
		margin: 24px 0;
	}

	@media (max-width: 768px) {
		.nag-builders-grid {
			grid-template-columns: 1fr;
		}
	}

	.nag-builder-card {
		background: #f8fafc;
		border: 1px solid var(--ag-border);
		border-radius: var(--ag-radius-sm);
		padding: 24px;
		transition: var(--ag-transition);
	}

	.nag-builder-card:hover {
		border-color: var(--ag-primary);
		background: #fff;
		box-shadow: var(--ag-shadow);
	}

	.nag-builder-card h4 {
		margin: 0 0 12px 0;
		font-size: 15px;
		font-weight: 700;
		color: var(--ag-docs-heading);
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.nag-builder-card h4 .dashicons {
		color: var(--ag-primary);
	}

	/* Video Tutorial Buttons */

	.nag-sidebar-actions {
		margin-top: 25px;
		display: flex;
		flex-direction: column;
		gap: 10px;
		padding-top: 20px;
		border-top: 1px solid var(--ag-border);
	}

	.nag-sidebar-actions .button {
		display: inline-flex !important;
		align-items: center !important;
		justify-content: center !important;
		gap: 8px !important;
		height: 42px !important;
		line-height: 40px !important;
		border-radius: 8px !important;
		font-weight: 700 !important;
		font-size: 13px !important;
		width: 100% !important;
		transition: var(--ag-transition) !important;
		text-decoration: none !important;
		box-sizing: border-box !important;
	}

	.nag-sidebar-actions .button-primary {
		background: linear-gradient(135deg, var(--ag-primary) 0%, var(--ag-secondary) 100%) !important;
		border: none !important;
		color: #ffffff !important;
		box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
	}

	.nag-sidebar-actions .button-primary:hover {
		transform: translateY(-1px) !important;
		box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3) !important;
	}

	.nag-sidebar-actions .button-secondary {
		background: #ffffff !important;
		border: 1px solid var(--ag-border) !important;
		color: var(--ag-docs-text) !important;
	}

	.nag-sidebar-actions .button-secondary:hover {
		border-color: var(--ag-primary) !important;
		color: var(--ag-primary) !important;
		background: #f8fafc !important;
	}

	.nag-sidebar-actions .button-review {
		background: #0f172a !important;
		color: #38bdf8 !important;
		border: 1px solid #334155 !important;
	}

	.nag-sidebar-actions .button-review:hover {
		background: #1e293b !important;
		color: #38bdf8 !important;
		border-color: #38bdf8 !important;
	}

	.nag-sidebar-actions .button .dashicons {
		font-size: 16px !important;
		width: 16px !important;
		height: 16px !important;
		display: inline-flex !important;
		align-items: center !important;
		justify-content: center !important;
		margin: 0 !important;
	}

	.nag-video-btn {
		display: inline-flex;
		align-items: center;
		gap: 10px;
		background: #ef4444;
		color: #fff !important;
		padding: 14px 28px;
		border-radius: 10px;
		font-size: 15px;
		font-weight: 700;
		text-decoration: none !important;
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
	}

	.nag-video-btn:hover {
		background: #dc2626;
		box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
		transform: translateY(-2px);
		color: #fff !important;
	}

	.nag-video-section {
		background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
		padding: 50px 40px;
		text-align: center;
		border: 1px solid rgba(255,255,255,0.1);
		border-radius: var(--ag-radius);
		margin-bottom: 30px;
		box-shadow: var(--ag-shadow);
		position: relative;
		overflow: hidden;
	}

	.nag-video-section h2 {
		color: #fff !important;
		border-bottom: 1px solid rgba(255,255,255,0.1) !important;
		justify-content: center;
		margin-bottom: 20px !important;
		padding-bottom: 15px;
	}

	.nag-video-section p {
		color: #94a3b8 !important;
		font-size: 15px !important;
		max-width: 600px;
		margin: 0 auto 30px auto !important;
	}
</style>

<div class="nag-docs-wrap">

	<!-- Header -->
	<div class="nag-docs-header">
		<span class="nag-badge">★ <?php esc_html_e('Documentation', 'new-album-gallery'); ?></span>
		<h1><?php esc_html_e('Album Gallery — Documentation', 'new-album-gallery'); ?></h1>
		<p><?php esc_html_e('Complete guide to creating, configuring, and displaying beautiful image and video album galleries.', 'new-album-gallery'); ?></p>
	</div>

	<!-- Video Tutorial -->
	<div class="nag-video-section">
		<h2><span class="dashicons dashicons-video-alt3" style="color:#ff0000; font-size:26px; width:26px; height:26px;"></span> <?php esc_html_e('Video Tutorial', 'new-album-gallery'); ?></h2>
		<p><?php esc_html_e('Watch our step-by-step video tutorial to learn how to set up and use Album Gallery on your WordPress site.', 'new-album-gallery'); ?></p>
		<a href="https://www.youtube.com/watch?v=g6HC2r4QAOI" target="_blank" rel="noopener noreferrer" class="nag-video-btn">
			<span class="dashicons dashicons-video-alt3"></span>
			<?php esc_html_e('Watch Video Tutorial on YouTube', 'new-album-gallery'); ?>
		</a>
	</div>

	<!-- Main Sidebar and Content Layout -->
	<div class="nag-docs-layout">

		<!-- Sidebar Navigation -->
		<aside class="nag-docs-sidebar">
			<div class="nag-search-wrapper">
				<span class="dashicons dashicons-search"></span>
				<input type="text" id="nag-docs-search" placeholder="<?php esc_attr_e('Search docs...', 'new-album-gallery'); ?>">
			</div>
			<ul class="nag-sidebar-menu">
				<li class="nag-sidebar-item">
					<a class="nag-sidebar-link active" href="#nag-create">
						<span class="dashicons dashicons-images-alt2"></span>
						<?php esc_html_e('1. Creating Galleries', 'new-album-gallery'); ?>
					</a>
				</li>
				<li class="nag-sidebar-item">
					<a class="nag-sidebar-link" href="#nag-content">
						<span class="dashicons dashicons-format-image"></span>
						<?php esc_html_e('2. Content & YouTube', 'new-album-gallery'); ?>
					</a>
				</li>
				<li class="nag-sidebar-item">
					<a class="nag-sidebar-link" href="#nag-layout">
						<span class="dashicons dashicons-layout"></span>
						<?php esc_html_e('3. Columns Layout', 'new-album-gallery'); ?>
					</a>
				</li>
				<li class="nag-sidebar-item">
					<a class="nag-sidebar-link" href="#nag-lightbox">
						<span class="dashicons dashicons-visibility"></span>
						<?php esc_html_e('4. Lightbox Controls', 'new-album-gallery'); ?>
					</a>
				</li>
				<li class="nag-sidebar-item">
					<a class="nag-sidebar-link" href="#nag-effects">
						<span class="dashicons dashicons-admin-appearance"></span>
						<?php esc_html_e('5. Visual Effects', 'new-album-gallery'); ?>
					</a>
				</li>
				<li class="nag-sidebar-item">
					<a class="nag-sidebar-link" href="#nag-shortcode">
						<span class="dashicons dashicons-shortcode"></span>
						<?php esc_html_e('6. Shortcode Guide', 'new-album-gallery'); ?>
					</a>
				</li>
				<li class="nag-sidebar-item">
					<a class="nag-sidebar-link" href="#nag-builders">
						<span class="dashicons dashicons-admin-customizer"></span>
						<?php esc_html_e('7. Page Builders', 'new-album-gallery'); ?>
					</a>
				</li>
				<li class="nag-sidebar-item">
					<a class="nag-sidebar-link" href="#nag-faq">
						<span class="dashicons dashicons-editor-help"></span>
						<?php esc_html_e('8. FAQ & Help', 'new-album-gallery'); ?>
					</a>
				</li>
			</ul>
			<!-- Sidebar Action Buttons -->
			<div class="nag-sidebar-actions">
				<a class="button button-primary" href="https://awplife.com/account/signup/album-gallery-premium/" target="_blank" rel="noopener noreferrer">
					<span class="dashicons dashicons-cart"></span>
					<?php esc_html_e('Buy Pro Version', 'new-album-gallery'); ?>
				</a>
				<a class="button button-secondary" href="https://awplife.com/demo/album-gallery-premium/" target="_blank" rel="noopener noreferrer">
					<span class="dashicons dashicons-visibility"></span>
					<?php esc_html_e('Live Demo', 'new-album-gallery'); ?>
				</a>
				<a class="button button-review" href="https://wordpress.org/support/plugin/new-album-gallery/reviews/" target="_blank" rel="noopener noreferrer">
					<span class="dashicons dashicons-star-filled"></span>
					<?php esc_html_e('Leave a Review', 'new-album-gallery'); ?>
				</a>
			</div>
		</aside>

		<!-- Main Content Sections -->
		<main class="nag-docs-content">

			<!-- 1. Creating Your First Album Gallery -->
			<div class="nag-docs-section" id="nag-create">
				<h2><span class="dashicons dashicons-images-alt2"></span> <?php esc_html_e('1. Creating Your First Album Gallery', 'new-album-gallery'); ?></h2>
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
				<h2><span class="dashicons dashicons-format-image"></span> <?php esc_html_e('2. Adding & Managing Content', 'new-album-gallery'); ?></h2>
				<p><?php esc_html_e('The "Gallery Content" tab allows you to manage the media inside your album.', 'new-album-gallery'); ?></p>

				<h3><?php esc_html_e('Adding YouTube Videos', 'new-album-gallery'); ?></h3>
				<ol>
					<li><?php esc_html_e('Add an image/slide to serve as the base thumbnail.', 'new-album-gallery'); ?></li>
					<li><?php esc_html_e('In the item card, change the "Type" dropdown from "Image" to "Youtube video".', 'new-album-gallery'); ?></li>
					<li><?php esc_html_e('Paste the full YouTube video URL into the "Youtube video URL" field.', 'new-album-gallery'); ?></li>
					<li><?php esc_html_e('Click "Fetch Poster" to automatically fetch and display the YouTube video thumbnail as the cover for that slide. If you want to revert back to your original uploaded image, click "Revert Thumbnail".', 'new-album-gallery'); ?></li>
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
				<h2><span class="dashicons dashicons-layout"></span> <?php esc_html_e('3. Layout Settings & Responsive Grid', 'new-album-gallery'); ?></h2>
				
				<h3><?php esc_html_e('Gallery Thumb Size', 'new-album-gallery'); ?></h3>
				<p><?php esc_html_e('Choose the resolution for the grid thumbnails. Smaller sizes (150x150) load faster, while larger sizes (300px+) look sharper on high-resolution screens.', 'new-album-gallery'); ?></p>

				<h3><?php esc_html_e('Column Logic', 'new-album-gallery'); ?></h3>
				<p><?php esc_html_e('You can choose between two modes:', 'new-album-gallery'); ?></p>
				<ul>
					<li><strong><?php esc_html_e('Uniform:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Uses the global settings defined in the Album Gallery > Column Settings menu.', 'new-album-gallery'); ?></li>
					<li><strong><?php esc_html_e('Individual:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Allows you to set specific column counts for this gallery across Desktops, Tablets, and Phones.', 'new-album-gallery'); ?></li>
				</ul>

				<h3><?php esc_html_e('Right Click Protection', 'new-album-gallery'); ?></h3>
				<p><?php esc_html_e('Enforce security against image downloading by utilizing our recommended integration:', 'new-album-gallery'); ?></p>
				<ul>
					<li><strong><?php esc_html_e('Right Click Protection Card:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Uses real-time system file checks to look for the "Right Click Disable OR Ban" plugin. Click to install, activate, or directly configure right-click rules to restrict users from downloading your graphics.', 'new-album-gallery'); ?></li>
				</ul>
			</div>

			<!-- 4. Lightbox Controls -->
			<div class="nag-docs-section" id="nag-lightbox">
				<h2><span class="dashicons dashicons-visibility"></span> <?php esc_html_e('4. Lightbox Controls & Experience', 'new-album-gallery'); ?></h2>
				<p><?php esc_html_e('Control how the lightbox behaves when a user clicks on your album.', 'new-album-gallery'); ?></p>

				<ul>
					<li><strong><?php esc_html_e('Image Title:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Toggle the display of the image title as a caption at the bottom of the lightbox.', 'new-album-gallery'); ?></li>
					<li><strong><?php esc_html_e('Loop Gallery:', 'new-album-gallery'); ?></strong> <?php esc_html_e('When enabled, navigating past the last image will loop back to the first one.', 'new-album-gallery'); ?></li>
					<li><strong><?php esc_html_e('Auto Play:', 'new-album-gallery'); ?></strong> <?php esc_html_e('Automatically advance to the next image after a specified delay (in milliseconds).', 'new-album-gallery'); ?></li>
				</ul>
			</div>

			<!-- 5. Visual Effects -->
			<div class="nag-docs-section" id="nag-effects">
				<h2><span class="dashicons dashicons-admin-appearance"></span> <?php esc_html_e('5. Visual Effects & Animations', 'new-album-gallery'); ?></h2>
				
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
				<h2><span class="dashicons dashicons-shortcode"></span> <?php esc_html_e('6. Using the Shortcode', 'new-album-gallery'); ?></h2>
				<p><?php esc_html_e('To display your gallery, copy the shortcode and paste it into any page or post.', 'new-album-gallery'); ?></p>

				<div class="nag-code-block-wrapper">
					<pre class="nag-code-block">[AGAL id=YOUR_ID]</pre>
					<button class="nag-copy-btn" onclick="nagCopyCode(this, '[AGAL id=YOUR_ID]')">
						<span class="dashicons dashicons-clipboard"></span>
						<?php esc_html_e('Copy Code', 'new-album-gallery'); ?>
					</button>
				</div>
				
				<div class="nag-info">
					<strong><?php esc_html_e('Widget Support:', 'new-album-gallery'); ?></strong>
					<?php esc_html_e('You can also use the shortcode in Sidebar Widgets by using a "Shortcode" or "Text" widget.', 'new-album-gallery'); ?>
				</div>
			</div>

			<!-- 7. Page Builder Integrations -->
			<div class="nag-docs-section" id="nag-builders">
				<h2><span class="dashicons dashicons-admin-customizer"></span> <?php esc_html_e('7. Page Builder Integrations (Gutenberg & Elementor)', 'new-album-gallery'); ?></h2>
				<p><?php esc_html_e('Album Gallery is fully compatible with Gutenberg (WordPress Block Editor) and Elementor Page Builder, allowing you to visually add galleries to your pages without copying shortcodes.', 'new-album-gallery'); ?></p>

				<div class="nag-builders-grid">
					<!-- Gutenberg Card -->
					<div class="nag-builder-card">
						<h4><span class="dashicons dashicons-edit"></span> <?php esc_html_e('Gutenberg Block Editor', 'new-album-gallery'); ?></h4>
						<ol style="margin: 10px 0; padding-left: 15px;">
							<li><?php esc_html_e('Open or edit any Page or Post.', 'new-album-gallery'); ?></li>
							<li><?php esc_html_e('Click the "+" icon, search for "Album Gallery", and select it.', 'new-album-gallery'); ?></li>
							<li><?php esc_html_e('Look at the right sidebar "Gallery Settings" panel.', 'new-album-gallery'); ?></li>
							<li><?php esc_html_e('Select your desired album gallery from the dropdown list.', 'new-album-gallery'); ?></li>
						</ol>
					</div>

					<!-- Elementor Card -->
					<div class="nag-builder-card">
						<h4><span class="dashicons dashicons-grid-view"></span> <?php esc_html_e('Elementor Page Builder', 'new-album-gallery'); ?></h4>
						<ol style="margin: 10px 0; padding-left: 15px;">
							<li><?php esc_html_e('Edit any page or post using Elementor.', 'new-album-gallery'); ?></li>
							<li><?php esc_html_e('Search for the "Album Gallery" widget in the panel.', 'new-album-gallery'); ?></li>
							<li><?php esc_html_e('Drag and drop the widget into your section.', 'new-album-gallery'); ?></li>
							<li><?php esc_html_e('Choose your album gallery from the "Select Gallery" dropdown.', 'new-album-gallery'); ?></li>
						</ol>
					</div>
				</div>
			</div>

			<!-- 8. FAQ -->
			<div class="nag-docs-section" id="nag-faq">
				<h2><span class="dashicons dashicons-editor-help"></span> <?php esc_html_e('8. Frequently Asked Questions', 'new-album-gallery'); ?></h2>

				<h3><?php esc_html_e('Q: Why are my videos not playing?', 'new-album-gallery'); ?></h3>
				<p><?php esc_html_e('Ensure you have pasted the full YouTube URL (e.g., https://www.youtube.com/watch?v=...) and selected the "Youtube video" type in the item settings.', 'new-album-gallery'); ?></p>

				<h3><?php esc_html_e('Q: Can I change the cover image?', 'new-album-gallery'); ?></h3>
				<p><?php esc_html_e('Yes, the first image in your "Gallery Content" list is automatically used as the cover. Simply drag your preferred image to the top position.', 'new-album-gallery'); ?></p>

				<h3><?php esc_html_e('Q: Is it mobile friendly?', 'new-album-gallery'); ?></h3>
				<p><?php esc_html_e('Yes, the gallery uses a responsive grid system that adapts to all screen sizes.', 'new-album-gallery'); ?></p>
			</div>

		</main>

	</div>

</div>

<script>
	// Copy to clipboard with fallback for non-SSL/local environments
	function nagCopyCode(btn, codeText) {
		if (navigator.clipboard && navigator.clipboard.writeText) {
			navigator.clipboard.writeText(codeText).then(showSuccess, fallbackCopy);
		} else {
			fallbackCopy();
		}

		function showSuccess() {
			var origHTML = btn.innerHTML;
			btn.innerHTML = '<span class="dashicons dashicons-yes"></span> ' + <?php echo json_encode(__('Copied!', 'new-album-gallery')); ?>;
			btn.classList.add('copied');
			setTimeout(function() {
				btn.innerHTML = origHTML;
				btn.classList.remove('copied');
			}, 2000);
		}

		function fallbackCopy() {
			var textArea = document.createElement("textarea");
			textArea.value = codeText;
			textArea.style.position = "fixed";
			document.body.appendChild(textArea);
			textArea.focus();
			textArea.select();
			try {
				document.execCommand('copy');
				showSuccess();
			} catch (err) {
				console.error('Fallback copy failed', err);
			}
			document.body.removeChild(textArea);
		}
	}

	// Real-time documentation search filtering both sidebar and content cards
	document.getElementById('nag-docs-search').addEventListener('input', function(e) {
		var query = e.target.value.toLowerCase().trim();
		var sections = document.querySelectorAll('.nag-docs-section');
		var sidebarItems = document.querySelectorAll('.nag-sidebar-item');

		sections.forEach(function(section) {
			var headingText = section.querySelector('h2').innerText.toLowerCase();
			var bodyText = section.innerText.toLowerCase();
			if (headingText.indexOf(query) > -1 || bodyText.indexOf(query) > -1) {
				section.style.display = 'block';
			} else {
				section.style.display = 'none';
			}
		});

		sidebarItems.forEach(function(item) {
			var link = item.querySelector('.nag-sidebar-link');
			var targetId = link.getAttribute('href');
			var targetSection = document.querySelector(targetId);
			var linkText = link.innerText.toLowerCase();
			
			// Show menu item if the link text matches OR the target content section matches the search query
			if (linkText.indexOf(query) > -1 || (targetSection && targetSection.style.display !== 'none')) {
				item.style.display = 'block';
			} else {
				item.style.display = 'none';
			}
		});
	});

	// Sticky sidebar scrollspy highlight active section on scroll
	window.addEventListener('DOMContentLoaded', function() {
		var sections = document.querySelectorAll('.nag-docs-section');
		var navLinks = document.querySelectorAll('.nag-sidebar-link');

		function updateScrollspy() {
			var scrollPos = window.scrollY || window.pageYOffset || document.documentElement.scrollTop;
			var currentId = '';

			sections.forEach(function(section) {
				var sectionTop = section.offsetTop;
				var sectionHeight = section.clientHeight;
				
				// Active scroll position hits roughly the upper middle part of screen
				if (scrollPos >= (sectionTop - 130)) {
					currentId = section.getAttribute('id');
				}
			});

			if (currentId) {
				navLinks.forEach(function(link) {
					if (link.getAttribute('href') === '#' + currentId) {
						link.classList.add('active');
					} else {
						link.classList.remove('active');
					}
				});
			}
		}

		window.addEventListener('scroll', updateScrollspy);
		updateScrollspy(); // Run once on load
	});
</script>