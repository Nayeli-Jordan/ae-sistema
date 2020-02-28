jQuery(document).ready(function ($) {
	/*Image gallery*/	
	var meta_image_frame; // Instantiates the variable that holds the media library frame.
	$('.image-upload').click(function (e) {
		var forButtonUpload = $(this).attr('for'); 
		var meta_image_preview = $(this).parent().parent().children('.image-preview');
		e.preventDefault();
		var meta_image = $(this).parent().children('.meta-image');		
		meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: meta_image.title,
			button: {
				text: meta_image.button
			}
		});
		// Runs when an image is selected.
		meta_image_frame.on('select', function () {
			var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
			// Sends the attachment URL to our custom image input field.
			meta_image.val(media_attachment.url);
			meta_image_preview.children('img').attr('src', media_attachment.url);
		});
		// Opens the media library frame.
		meta_image_frame.open();
	});

});

