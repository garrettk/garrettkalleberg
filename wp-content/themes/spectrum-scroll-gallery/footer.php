	</div>
	<div id="footer">
		<div class="main clearfix">
		<?php	
			if(is_front_page()) : echo(' '); 			
		else : ?>
		
			<?php if (!dynamic_sidebar('footer_default')) : ?>	
		
			<div class = "miniFeature32 oneThird widget_tia_mini_feature footerBox">				
				<?php include( TEMPLATEPATH . '/includes/no_widgets.php'); ?>	
			</div><!-- end footer box -->
					
			<?php endif; ?>	
			
		<?php endif; ?>				
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
<script language="javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.mediaqueries.js"></script>

</body>
</html>