	</div>
	<div id="footer" class="footerClean">
		<div class="main clearfix">
					
		</div><!-- end footer main -->
		
		<div class="secondary clearfix">
			<?php $footer_left = tia_get_option('tia_footer_left'); ?>
			<?php $footer_right = tia_get_option('tia_footer_right'); ?>
			<p><?php if($footer_left){echo($footer_left);} else{ ?>&copy; <?php echo date('Y');?> <a href="<?php bloginfo('url'); ?>"><strong><?php bloginfo('name'); ?></strong></a> All Rights Reserved.<br /><?php }; ?>
			<?php if($footer_right){echo($footer_right);} else{ ?><a href="http://themespectrum.com" title="Theme Spectrum">Premium Wordpress Theme by Theme Spectrum</a></p><?php }; ?>
		</div><!-- end footer secondary-->
		
	</div><!-- end footer -->	
</div>
<?php wp_footer(); ?>
<!--media queries support for ie-->
<script type="text/css" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.mediaqueries.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/scrolltopcontrol.js">

	/* Scroll To Top Control script- © Dynamic Drive DHTML code library (www.dynamicdrive.com) This notice MUST stay intact for legal use Visit Project Page at http://www.dynamicdrive.com for full source code */

	</script>
   
   <script type='text/javascript'>
	function onScroll(event) {
  		var delta = event.detail ? event.detail * (-120) : event.wheelDelta
  		var scrollOffset = 10 * (delta / -120);
  		window.scrollBy(scrollOffset, 0);
  		event.preventDefault;
  		event.stopPropagation;
	}

	var mousewheelevt=(/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel";
	if (document.attachEvent) 
	  document.attachEvent("on"+mousewheelevt, onScroll);  
	else if (document.addEventListener)
	  document.addEventListener(mousewheelevt, onScroll, false);
	</script>

</body>
</html>