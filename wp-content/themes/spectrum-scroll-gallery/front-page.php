<?php get_header(); ?>
<?php if(is_front_page()) : ?>
	<div id="slideshow" class="table">	
		<div id="homescroll" class="tablerow">          
		<?php query_posts('post_type=portfolio&meta_key=_tia_in_slideshow_value&meta_value=true&posts_per_page=20'); ?>
		
		<?php if(have_posts()) :?>
		
		<?php $i = 1; while (have_posts()) : the_post(); ?>		
		<?php $style = ""; ?>
		<?php if($i > 1) ?> 
			<?php $deactivate_links = tia_get_option('tia_slide_deactivate_links'); ?>
			<?php $slideLink = get_permalink(); ?>	
			
			<?php if($deactivate_links) : ?>
			<?php $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); 										
		    		
		    echo '<div class="tablecell scrollslide gallery"><a rel="gallery" href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '">'; the_post_thumbnail('tia_portfolioFront', array('style' => ''.$style.'','alt' => ''.get_the_title().'','title' => ''.get_the_title().'')); ?><h2><?php the_title(); ?></h2>
                   </a>
                    </div>
				<?php else :?>		
													
		    		<div class="tablecell scrollslide"><a href="<?php echo $slideLink ?>"><?php the_post_thumbnail('tia_portfolioFront', array('style' => ''.$style.'','alt' => ''.get_the_title().'','title' => ''.get_the_title().'')); ?></a>	<h2><?php the_title(); ?></h2>
                   
                    </div>  		
                
			<?php endif; ?>	
							
		<?php $i++; endwhile; ?>
		<!--[if lt IE 8]>
		<style type="text/css">
			#slideshow{width:<?php echo ($i-1)*900; ?>px;}
		</style>
		<![endif]-->
		<?php wp_reset_query();?>
       
		<?php else: ?>

			<div class="slide noContent">
				<h1>Thank You for Purchasing Scroll Gallery by Theme Spectrum</h1>
				<p><a href="<?php bloginfo('url'); ?>/wp-admin/post-new.php?post_type=portfolio" class="button">Start Adding Content</a></p>
			</div>
		<?php endif; ?>		
	
	</div>
</div>	
<?php get_footer('clean'); ?>		
<?php else : ?>
			
            <div id="content" class="posts clearfix">
        	<?php while (have_posts()) : the_post(); ?>
			    
			    			
			
			<?php endwhile; ?>
			<?php include( TEMPLATEPATH . '/includes/pagination.php'); ?>
		</div> <!-- end content -->
		<?php get_footer(); ?>	
<?php endif; ?>

					

		
		