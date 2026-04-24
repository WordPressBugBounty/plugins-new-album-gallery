<?php
if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>
<style>
	:root {
		--ag-pro-gold: #f59e0b;
		--ag-pro-indigo: #6366f1;
		--ag-pro-violet: #8b5cf6;
		--ag-pro-bg: #f8fafc;
		--ag-pro-card: #ffffff;
		--ag-pro-text: #334155;
		--ag-pro-heading: #1e293b;
	}

	.nag-pro-wrap {
		font-family: 'Inter', -apple-system, sans-serif;
		color: var(--ag-pro-text);
	}

	/* Hero Section */
	.nag-pro-hero {
		background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
		color: #fff;
		padding: 70px 40px;
		border-radius: 20px;
		text-align: center;
		margin-bottom: 40px;
		box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
		position: relative;
		overflow: hidden;
	}

	.nag-pro-hero::before {
		content: '';
		position: absolute;
		top: -50%;
		left: -50%;
		width: 200%;
		height: 200%;
		background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
		pointer-events: none;
	}

	.nag-pro-hero h1 {
		font-size: 42px;
		font-weight: 900;
		margin: 0 0 20px 0;
		color: #fff;
		letter-spacing: -0.025em;
	}

	.nag-pro-hero h1 span {
		color: var(--ag-pro-gold);
	}

	.nag-pro-hero p {
		font-size: 20px;
		opacity: 0.8;
		max-width: 700px;
		margin: 0 auto 35px auto;
		line-height: 1.6;
	}

	.nag-pro-hero-btns {
		display: flex;
		gap: 20px;
		justify-content: center;
	}

	.nag-pro-btn {
		padding: 16px 32px;
		border-radius: 12px;
		font-size: 16px;
		font-weight: 700;
		text-decoration: none !important;
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		display: inline-flex;
		align-items: center;
		gap: 10px;
	}

	.nag-pro-btn-primary {
		background: var(--ag-pro-gold);
		color: #000 !important;
		box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.4);
	}

	.nag-pro-btn-primary:hover {
		background: #d97706;
		transform: translateY(-2px);
		box-shadow: 0 20px 25px -5px rgba(245, 158, 11, 0.5);
	}

	.nag-pro-btn-secondary {
		background: rgba(255,255,255,0.1);
		color: #fff !important;
		border: 1px solid rgba(255,255,255,0.2);
		backdrop-filter: blur(10px);
	}

	.nag-pro-btn-secondary:hover {
		background: rgba(255,255,255,0.2);
		transform: translateY(-2px);
	}

	/* Features Grid */
	.nag-pro-features {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
		gap: 30px;
		margin-bottom: 60px;
	}

	.nag-pro-feature-card {
		background: var(--ag-pro-card);
		padding: 40px;
		border-radius: 16px;
		box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
		border: 1px solid rgba(0,0,0,0.05);
		transition: all 0.3s ease;
		position: relative;
		overflow: hidden;
	}

	.nag-pro-feature-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
	}

	.nag-pro-feature-icon {
		width: 60px;
		height: 60px;
		background: #eff6ff;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		margin-bottom: 24px;
		color: var(--ag-pro-indigo);
	}

	.nag-pro-feature-card h3 {
		font-size: 20px;
		font-weight: 800;
		color: var(--ag-pro-heading);
		margin: 0 0 12px 0;
	}

	.nag-pro-feature-card p {
		font-size: 15px;
		line-height: 1.6;
		margin: 0;
		color: var(--ag-pro-text);
	}

	/* Comparison Table */
	.nag-pro-comparison {
		background: var(--ag-pro-card);
		border-radius: 20px;
		padding: 50px;
		box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
		border: 1px solid rgba(0,0,0,0.05);
	}

	.nag-pro-comparison h2 {
		font-size: 32px;
		font-weight: 900;
		text-align: center;
		margin-bottom: 40px;
		color: var(--ag-pro-heading);
	}

	.nag-comp-table {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
	}

	.nag-comp-table th {
		padding: 20px;
		text-align: center;
		font-size: 18px;
		font-weight: 800;
		border-bottom: 2px solid #f1f5f9;
	}

	.nag-comp-table td {
		padding: 20px;
		border-bottom: 1px solid #f1f5f9;
		font-size: 15px;
	}

	.nag-comp-feature {
		font-weight: 600;
		color: var(--ag-pro-heading);
		text-align: left !important;
	}

	.nag-comp-check {
		color: #10b981;
		font-weight: 900;
		text-align: center;
	}

	.nag-comp-cross {
		color: #ef4444;
		opacity: 0.5;
		text-align: center;
	}

	.nag-pro-label {
		background: #fef3c7;
		color: #92400e;
		padding: 4px 10px;
		border-radius: 6px;
		font-size: 12px;
		font-weight: 700;
		text-transform: uppercase;
		margin-left: 8px;
	}

	.nag-comp-table tr:hover td {
		background: #f8fafc;
	}

	.nag-comp-table tr:last-child td {
		border-bottom: none;
	}

	.nag-pro-badge {
		position: absolute;
		top: 20px;
		right: -35px;
		background: var(--ag-pro-gold);
		color: #000;
		padding: 8px 40px;
		font-size: 12px;
		font-weight: 800;
		transform: rotate(45deg);
		box-shadow: 0 4px 6px rgba(0,0,0,0.1);
	}
</style>

<div class="nag-pro-wrap">

	<!-- Hero Section -->
	<div class="nag-pro-hero">
		<div class="nag-pro-badge">HOT</div>
		<h1>Unlock the Full Power of <span>Album Gallery</span></h1>
		<p>Take your photo and video galleries to the next level with advanced layouts, pro lightbox modules, and premium performance optimizations.</p>
		
		<div class="nag-pro-hero-btns">
			<a href="https://awplife.com/account/signup/album-gallery-premium/" target="_blank" class="nag-pro-btn nag-pro-btn-primary">
				<span class="dashicons dashicons-cart"></span>
				<?php esc_html_e('Get Album Gallery Pro', 'new-album-gallery'); ?>
			</a>
			<a href="https://awplife.com/demo/album-gallery-premium/" target="_blank" class="nag-pro-btn nag-pro-btn-secondary">
				<span class="dashicons dashicons-visibility"></span>
				<?php esc_html_e('View Live Demo', 'new-album-gallery'); ?>
			</a>
		</div>
	</div>

	<!-- Main Features Detail -->
	<div class="nag-pro-features">
		
		<!-- Feature 1 -->
		<div class="nag-pro-feature-card">
			<div class="nag-pro-feature-icon">
				<span class="dashicons dashicons-layout" style="font-size: 32px; width: 32px; height: 32px;"></span>
			</div>
			<h3><?php esc_html_e('Advance Shortcode [AGAL]', 'new-album-gallery'); ?></h3>
			<p><?php esc_html_e('Use the premium global [AGAL] shortcode to display all your albums on a single page with advanced pagination.', 'new-album-gallery'); ?></p>
		</div>

		<!-- Feature 2 -->
		<div class="nag-pro-feature-card">
			<div class="nag-pro-feature-icon">
				<span class="dashicons dashicons-performance" style="font-size: 32px; width: 32px; height: 32px;"></span>
			</div>
			<h3><?php esc_html_e('Load More & AJAX', 'new-album-gallery'); ?></h3>
			<p><?php esc_html_e('Display hundreds of albums with ease using Load More or Scroll loading. AJAX-powered for seamless browsing.', 'new-album-gallery'); ?></p>
		</div>

		<!-- Feature 3 -->
		<div class="nag-pro-feature-card">
			<div class="nag-pro-feature-icon">
				<span class="dashicons dashicons-format-gallery" style="font-size: 32px; width: 32px; height: 32px;"></span>
			</div>
			<h3><?php esc_html_e('Pro Lightbox Modules', 'new-album-gallery'); ?></h3>
			<p><?php esc_html_e('Unlock Zoom, Fullscreen, Social Sharing, and Direct Download features inside a premium LightGallery v2 experience.', 'new-album-gallery'); ?></p>
		</div>
		
		<!-- Feature 4 -->
		<div class="nag-pro-feature-card">
			<div class="nag-pro-feature-icon">
				<span class="dashicons dashicons-admin-appearance" style="font-size: 32px; width: 32px; height: 32px;"></span>
			</div>
			<h3><?php esc_html_e('Premium Hover Effects', 'new-album-gallery'); ?></h3>
			<p><?php esc_html_e('Get access to exclusive "twisted" stack effects and advanced overlay interactions that make your albums pop.', 'new-album-gallery'); ?></p>
		</div>

	</div>

	<!-- Comparison Table -->
	<div class="nag-pro-comparison">
		<h2><?php esc_html_e('Free vs. Premium Comparison', 'new-album-gallery'); ?></h2>
		
		<table class="nag-comp-table">
			<thead>
				<tr>
					<th class="nag-comp-feature" style="width: 50%;"><?php esc_html_e('Feature', 'new-album-gallery'); ?></th>
					<th style="width: 25%;"><?php esc_html_e('Free', 'new-album-gallery'); ?></th>
					<th style="width: 25%; color: var(--ag-pro-gold);"><?php esc_html_e('Premium', 'new-album-gallery'); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Responsive Grid Layout', 'new-album-gallery'); ?></td>
					<td class="nag-comp-check">✔</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Album Title', 'new-album-gallery'); ?></td>
					<td class="nag-comp-check">✔</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('YouTube/Vimeo Video Support', 'new-album-gallery'); ?></td>
					<td class="nag-comp-check">✔</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Skeleton Loading', 'new-album-gallery'); ?></td>
					<td class="nag-comp-check">✔</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Image Title', 'new-album-gallery'); ?></td>
					<td class="nag-comp-check">✔</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Image Loop', 'new-album-gallery'); ?></td>
					<td class="nag-comp-check">✔</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e(' Auto Play & Delay', 'new-album-gallery'); ?></td>
					<td class="nag-comp-check">✔</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Entrance Animation', 'new-album-gallery'); ?></td>
					<td class="nag-comp-check">✔</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Link Redirection Button', 'new-album-gallery'); ?></td>
					<td class="nag-comp-cross">✖</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Lightbox Modules (Zoom, Fullscreen, Share)', 'new-album-gallery'); ?></td>
					<td class="nag-comp-cross">✖</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Global [AGAL] Shortcode Support', 'new-album-gallery'); ?></td>
					<td class="nag-comp-cross">✖</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Load More & AJAX', 'new-album-gallery'); ?></td>
					<td class="nag-comp-cross">✖</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Premium Hover & Stack Styles', 'new-album-gallery'); ?></td>
					<td class="nag-comp-cross">✖</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Custom CSS per Gallery', 'new-album-gallery'); ?></td>
					<td class="nag-comp-cross">✖</td>
					<td class="nag-comp-check">✔</td>
				</tr>
				<tr>
					<td class="nag-comp-feature"><?php esc_html_e('Priority Ticket Support', 'new-album-gallery'); ?></td>
					<td class="nag-comp-cross">✖</td>
					<td class="nag-comp-check">✔</td>
				</tr>
			</tbody>
		</table>
		
		<div style="text-align: center; margin-top: 50px;">
			<a href="https://awplife.com/account/signup/album-gallery-premium/" target="_blank" class="nag-pro-btn nag-pro-btn-primary" style="padding: 20px 50px; font-size: 18px;">
				<?php esc_html_e('Upgrade to Pro Version Now', 'new-album-gallery'); ?>
			</a>
		</div>
	</div>

</div>
