jQuery(function(jQuery) {
    
    var file_frame,
    awl_album_gallery = {
        ul: '',
        init: function() {
            this.ul = jQuery('.ag-image-slides-list');
            
            // Initialize Sortable
            if (this.ul.length > 0) {
                this.ul.sortable({
                    items: '.ag-image-slide-card',
                    placeholder: 'ag-slide-placeholder',
                    handle: '.ag-drag-handle',
                    revert: 250,
                    tolerance: 'pointer',
                    opacity: 0.8,
                    forcePlaceholderSize: true,
                    cursor: 'grabbing',
                    start: function(e, ui) {
                        ui.placeholder.css({
                            'height': ui.item.outerHeight(),
                            'width': ui.item.outerWidth(),
                            'border-radius': '12px'
                        });
                    }
                });
            }
			
            /**
             * Initialize Media Frame
             */
            this.init_media_frame = function() {
                if (file_frame) return;
                
                if (typeof wp !== 'undefined' && wp.media) {
                    file_frame = wp.media({
                        title: 'Select or Upload Images',
                        button: { text: 'Add to Gallery' },
                        multiple: true
                    });

                    file_frame.on('select', function() {
                        var images = file_frame.state().get('selection').toJSON();
                        for (var i = 0; i < images.length; i++) {
                            awl_album_gallery.get_thumbnail(images[i]['id']);
                        }
                    });
                }
            };

            // Pre-init to warm up the media library
            this.init_media_frame();

            /**
             * Open Uploader Logic
             */
            const openUploader = function(e) {
                if (e) e.preventDefault();
                
                if (!file_frame) {
                    awl_album_gallery.init_media_frame();
                }
                
                if (file_frame) {
                    file_frame.open();
                }
            };

            // Direct event binding for better performance
            jQuery(document).on('click', '.ag-upload-card, #add-new-image-slides', openUploader);

			
			/**
			 * Delete Slide Callback Function
			 */
            this.ul.on('click', '.remove-single-image-slide', function() {
                var $slide = jQuery(this).closest('.ag-image-slide-card');
                if (confirm('Are you sure you want to delete this image?')) {
                    $slide.css('transform', 'scale(0.8)');
                    $slide.fadeOut(400, function() {
                        jQuery(this).remove();
                    });
                }
                return false;
            });
			
			/**
			 * Delete All Slides Callback Function
			 */
			jQuery('#remove-all-image-slides').on('click', function() {
                if (confirm('Are you sure you want to delete ALL images? This cannot be undone.')) {
                    awl_album_gallery.ul.addClass('ag-removing-all');
                    awl_album_gallery.ul.fadeOut(500, function() {
                        jQuery(this).empty().show().removeClass('ag-removing-all');
                    });
                }
                return false;
            });

            /**
             * Video Link Toggle
             */
            this.ul.on('change', '.ag-slide-type-select', function() {
                var $select = jQuery(this);
                var $card = $select.closest('.ag-image-slide-card');
                var $videoField = $card.find('.ag-video-link-field');
                var $badgeIcon = $card.find('.ag-slide-badge .dashicons');
                var $badgeText = $card.find('.ag-slide-badge span:last-child');

                if ($select.val() === 'v') {
                    $badgeIcon.removeClass('dashicons-format-image').addClass('dashicons-video-alt3');
                } else {
                    $badgeIcon.removeClass('dashicons-video-alt3').addClass('dashicons-format-image');
                }
            });
           
        },
        get_thumbnail: function(id, cb) {
            cb = cb || function() {};
            var data = {
                action: 'album_gallery_js',
                slideId: id,
                security: awl_ag_ajax_obj.nonce
            };
            
            jQuery.post(awl_ag_ajax_obj.ajaxurl, data, function(response) {
                var $newSlide = jQuery(response);
                $newSlide.hide().appendTo(awl_album_gallery.ul).fadeIn(500);
                cb();
            }).fail(function(xhr, status, error) {
                // Silently fail or handle gracefully
            });
        }
    };
    awl_album_gallery.init();
});