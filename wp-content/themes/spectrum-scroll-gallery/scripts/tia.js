jQuery.noConflict();
jQuery(document).ready(function(){
	
	jQuery("#gallery a img").hover(
		function() {
			jQuery(this).fadeTo("fast", .5);
		},
		function() {
			jQuery(this).fadeTo("fast", 1);
	});
	
	jQuery("a.lightbox").attr('rel', 'gallery').fancybox({			
			'overlayColor'	:	'#000',
			'titleShow'	:	false,
			'titlePosition'	:	'inside'
		});
		
	jQuery(".gallery a").attr('rel', 'gallery').fancybox({
			'overlayColor'	:	'#000',
			'titleShow'	:	false,
			'titlePosition'	:	'inside'
		});		
	
});