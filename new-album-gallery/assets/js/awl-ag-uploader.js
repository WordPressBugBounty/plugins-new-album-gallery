jQuery(function(jQuery) {
    
    var file_frame,
    awl_album_gallery = {
        ul: '',
        init: function() {
            this.ul = jQuery('.imagebox');
            this.ul.sortable({
                placeholder: '',
				revert: true,
            });			
			
            /**
			 * Add Slide Callback Funtion
			 */
            jQuery('#add-new-image-slides').on('click', function(event) {
				var ag_add_images_nonce = jQuery("#ag_add_images_nonce").val();
                event.preventDefault();
                if (file_frame) {
                    file_frame.open();
                    return;
                }
                file_frame = wp.media.frames.file_frame = wp.media({
                    multiple: true
                });

                file_frame.on('select', function() {
                    var images = file_frame.state().get('selection').toJSON(),
                            length = images.length;
                    for (var i = 0; i < length; i++) {
                        awl_album_gallery.get_thumbnail(images[i]['id'], '', ag_add_images_nonce);
                    }
                });
                file_frame.open();
            });
			
			/**
			 * Delete Slide Callback Function
			 */
            this.ul.on('click', '#remove-image-slide', function() {
                if (confirm('Are sure to delete this images?')) {
                    jQuery(this).parent().fadeOut(700, function() {
                        jQuery(this).remove();
                    });
                }
                return false;
            });
			
			/**
			 * Delete All Slides Callback Function
			 */
			jQuery('#remove-all-image-slides').on('click', function() {
                if (confirm('Are sure to delete all images?')) {
                    awl_album_gallery.ul.empty();
                }
                return false;
            });
           
        },
        get_thumbnail: function(id, cb, ag_add_images_nonce) {
            cb = cb || function() {
            };
            var data = {
                action: 'album_gallery_js',
                slideId: id,
				ag_add_images_nonce: ag_add_images_nonce,
            };
            jQuery.post(ajaxurl, data, function(response) {
                awl_album_gallery.ul.append(response);
                cb();
            });
        }
    };
    awl_album_gallery.init();
});