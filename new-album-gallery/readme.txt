=== Album Gallery for Photo & Video ===
Contributors: awordpresslife, razipathhan, hanif0991, muhammadshahid, fkfaisalkhan007, sharikkhan007, zishlife, FARAZFRANK
Donate link: https://paypal.me/awplife
Tags: album gallery, photo gallery, image gallery, video gallery, lightbox
Requires at least: 4.0
Tested up to: 7.0
Requires PHP: 5.6
Stable tag: 2.1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An easy-to-use album gallery for Photo & Video display. Works seamlessly with Gutenberg Blocks and Elementor Page Builder.

== Album Gallery for Photo & Video ==

Need a clean way to show your media? Our album gallery for Photo & Video makes it simple. It is fully compatible with Gutenberg Blocks and Elementor Page Builder, allowing you to insert and design your collections visually. 

You can group your images into organized collections. Visitors can browse your grid easily. When they click a cover, a beautiful lightbox opens up. It is fast, fully responsive, and works on all devices. 

**Free Version Demo:** **[Album Gallery](https://awplife.com/demo/album-gallery-free-wordpress-plugin/)**
**Pro Version Demo:** **[Album Gallery Premium](https://awplife.com/demo/album-gallery-premium/)**
**Where to Buy:** **[Buy Album Gallery Premium](https://awplife.com/account/signup/album-gallery-premium/)**

= Video Tutoreal =

https://www.youtube.com/watch?v=g6HC2r4QAOI

= Why Choose Our Album Gallery? =
* **Organized Grid:** Group your related pictures together. Keep your website neat and professional.
* **Photo & Video Support:** Add high-quality images. You can also embed YouTube or Vimeo videos easily.
* **Responsive Layout:** The grid adapts to desktops, tablets, and phones automatically. 
* **Local Assets:** All styles and scripts load from your server. No external tracking is used.

= What You Can Create =
* **Photo Albums** - Display vacation shots, events, or product catalogs.
* **Video Playlists** - Share video content with responsive thumbnail previews.
* **Mixed Media** - Combine images and clips inside the same collection.

= Free Features in the Album Gallery =
* **Responsive Grid:** Adaptable column layouts for any screen size.
* **Photo & Video:** Beautiful image display and smooth video streaming.
* **Local Lightbox:** Fast pop-up viewer with touch navigation.
* **Animations:** Subtle entrance effects like pulse or fade on page load.
* **Hover Effects:** Creative stack and overlay designs for cover images.
* **Perceived Speed:** Skeleton loaders keep visitors engaged during load.
* **Page Builders:** Built-in Gutenberg Block and Elementor Page Builder widget for easy visual layouts.
* **Easy Setup:** Copy and paste shortcodes into any page or post.

= Pro Features for Advanced Layouts =
* **Global Shortcode:** Display all your albums on one page with pagination.
* **AJAX Load More:** Infinite scroll or button triggers for larger galleries.
* **Pro Lightbox:** Zoom, full-screen, and social share buttons.
* **Deep Linking:** Give each image a unique direct link.
* **Categories:** Organize your media into separate filterable groups.
* **Category Shortcodes:** Display only specific album categories on any page with a single custom shortcode.

= More Pro Version Demos =

* [Image Albums](https://awplife.com/demo/album-gallery-premium/)
* [Video Albums](https://awplife.com/demo/album-gallery-premium/video-album-gallery/)
* [Stack Effects](https://awplife.com/demo/album-gallery-premium/hover-stacks-effects/)
* [Load More](https://awplife.com/demo/album-gallery-premium/load-more/)

= How It Works =
1. Create a new collection from the admin panel.
2. Upload images or paste video URLs.
3. Choose your preferred column layout and hover styles.
4. Copy the custom shortcode.
5. Paste it on any WordPress page or post.

== Installation of Album Gallery for Photo & Video ==

1. Go to **Plugins** > **Add New** in your admin dashboard.
2. Search for **Album Gallery**.
3. Install and activate the plugin.
4. Click **Add New** to build your first collection.
5. Paste the shortcode on your site.

== Installation ==

1. Go to Plugins > Add New in your WordPress admin
2. Search for "Album Gallery"
3. Click Install Now and then Activate
4. Navigate to Album Gallery in the admin menu
5. Click Add New to create your first album
6. Upload images and configure settings
7. Copy the shortcode and add it to any page or post

== Screenshots ==
1. Add Image Section
2. Layout Tab
3. Lightbox Controls Tab
4. Visual Effects Tab
5. Global Sttings Page
6. Docs Page
7. Albums Frontend
8. Photo In Lightbox
9. Youtube Video In Lightbox

== Frequently Asked Questions ==

= How do I create my first album gallery? =
Go to the admin menu. Click "Add New" to build an album. Give it a title. Upload your Photo & Video files. Publish the collection. Copy the shortcode and paste it on any page.

= Can I display both Photo & Video files together? =
Yes. You can add images and videos to the same album gallery. Simply paste your YouTube or Vimeo links.

= Is the album gallery responsive on mobile? =
Yes. The grid scales down automatically. Your Photo & Video content will look perfect on any screen.

= How many albums can I make? =
There is no limit. You can create as many album gallery grids as you want.

= What comes with the Pro version? =
The Pro version adds category filters, custom image sizes, deeper lightbox features, and priority support.

== Changelog ==

= 2.1.5 =
* 2026-06-29
* Fix: Resolved Elementor widget AJAX re-rendering display issues by force-injecting link tags in the preview mode and added a self-executing script to initialize the skeleton loader state immediately.
* Fix: Upgraded Gutenberg block implementation to apiVersion 3 with ServerSideRender to support dynamic live editor previews.
* Layout: Standardized CSS layout grid and copied custom aspect ratio/shape properties from the premium plugin version.
* Fix: Transferred stack hover effect borders from image to wrapper div to prevent clipping in skeleton loading state.
* New: Implemented high-performance batch image uploading with a premium animated gradient loading spinner.

= 2.1.4 =
* 2026-06-27
* Fix: Added concurrent activation compatibility checks to allow Free and Premium plugins to be active at the same time, with priority on the Premium version.

= 2.1.3 =
* 2026-06-27
* Fix: Updated lightbox thumbnails to load medium size images for enhanced clarity and resolution.
* Layout: Increased grid spacing and padding between album containers for improved visual separation.

= 2.1.2 =
* 2026-06-25
* New: Added Right-Click Protection integration block in Layout Settings tab.
* Docs: Documented Right-Click Protection option in Docs page and readme.txt.

= 2.1.1 =
* 2026-06-20
* Security: Gated the `ajax_album_gallery` AJAX handler with explicit capability checks (`edit_posts`/`edit_pages`) and added strict attachment post-type validation to prevent unauthorized metadata disclosure.
* Security: Tightened the nonce-leaking script enqueue gating in `ag_admin_scripts_enqueues` by verifying capabilities and removing raw `$_GET['page']` access.
* Fix: Addressed output escaping PHPCS warnings by refactoring shortcode output rendering logic and adding escaping ignore statements for safe widgets.

= 2.1.0 =
* 2026-06-20
* New: Added YouTube video support for video slides.
* New: Added dynamic YouTube poster image fetching and reverting functionality.
* New: Added Gutenberg block editor integration for inserting specific album galleries visually.
* New: Added Elementor widget integration for inserting specific album galleries visually.
* UI/UX: Added backend settings page loading spinner overlay during tab switching.
* Docs: Completely modernized and updated the documentation page and pro comparison charts.

= 2.0.2 =
* 2026-05-08
* New: Added "Album Title Alignment" option to the Global Settings page with support for Default, Even Height, Single Line, or Position Below Images formats.
* Layout: Standardized CSS classes for layout alignment directly inside external stylesheets.
* UI/UX: Updated the "Upgrade to Pro" admin dashboard page and comparison lists.

= 2.0.1 =
* 2026-04-27
* Fix: Optimized shortcode flow to allow multiple independent galleries to sit side-by-side in a single row.
* Layout: Updated grid CSS to prevent horizontal overflow and improved responsive column widths.
* Layout: Added clearfix to the main grid container to prevent overlapping with theme content.

= 2.0.0 =
* 2026-04-20
* Major: Complete rebranding to "Album Gallery" with standardized internal prefixing (ag-, nag-).
* Architecture: Purged legacy "Premium" code for full WordPress.org repository compliance.
* Lightbox: Integrated GPL-compliant LightGallery v1.10.0 for improved stability.
* Lightbox: Removed Zoom and Fullscreen modules to streamline performance.
* UI/UX: Modernized admin interface with a new tabbed layout and improved responsive controls.
* Security: Implemented comprehensive data sanitization, unslashing, and nonce verification.
* Performance: Optimized asset enqueuing and reduced DOM footprint.
* Compatibility: Added support for PHP 8.1+ and WordPress 6.5+.

= 1.7.1 =
* Fix: Resolved invalid PHP function name in TGM Plugin Activation library.
* Fix: Renamed invalid $GLOBALS key with hyphens to safe underscore-based key.
* Fix: Removed @ error suppression operator on is_readable().
* Security: Sanitized all $_REQUEST, $_GET superglobal access with sanitize_text_field() and wp_unslash().
* Improvement: Added translators comments to all _n_noop() calls for WordPress i18n standards.
* Compatibility: Added #[\ReturnTypeWillChange] attributes for PHP 8.1+ compatibility.
* Tested with WordPress 6.9.

= 1.7.0 =
* Security: Escaped all output with esc_html_e(), esc_attr(), esc_js(), and esc_url().
* Security: Added wp_unslash() before sanitize_text_field() for all POST data.
* Security: Added isset() checks for optional POST fields.
* Security: Added direct file access protection to docs.php and awp-theme.php.
* Improvement: Added version parameters to all wp_enqueue_script and wp_enqueue_style calls.
* Improvement: Prefixed global functions and variables with nag_ for WordPress coding standards.
* Improvement: Replaced wp_reset_query() with wp_reset_postdata() in shortcode.php.
* Improvement: Fixed plugin name mismatch between header and readme.txt.
* New: Completely redesigned documentation page with 12-section tutorial.
* New: Redesigned Upgrade to Pro tab with feature cards and comparison table.
* Tested with WordPress 6.9.

== Upgrade Notice ==
This is an initial release. Start with version 2.0.2 and share your feedback <a href="https://wordpress.org/support/view/plugin-reviews/new-album-gallery//">here</a>.