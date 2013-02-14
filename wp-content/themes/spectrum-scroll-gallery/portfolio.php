<?php /*
Template Name: Portfolio
*/ ?>
<?php get_header(); 
	$layout = tia_get_option('tia_theme_folio');
?>
<?php if($layout=='scroll') : ?>
	<div id="slideshow" class="table">	
		<div id="homescroll" class="tablerow">          
		<?php query_posts('post_type=portfolio&posts_per_page=20'); ?>
		
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
       
		<?php endif; ?>		
	
	</div>
</div>
<?php get_footer('clean'); ?>		
<?php else : ?>
		<div id="content" class="full clearfix">
            <div id="portfolioHead">
                <h1><?php the_title(); ?></h1>
            </div>
            <div class="post portfolioList">
            	<?php 
					$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => 10)); 
				?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<?php	
					$custom = get_post_custom($post->ID);
					$screenshot_url = $custom["screenshot_url"][0];
					$website_url = $custom["website_url"][0];
					$deactivate_links = tia_get_option('tia_slide_deactivate_links');
					$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
				?>
				<?php if($deactivate_links) :
				echo '<div class="portfolio-item left gallery"><a rel="gallery" href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '">'; the_post_thumbnail('tia_threeColumn', array('style' => ''.$style.'','alt' => ''.get_the_title().'','title' => ''.get_the_title().'')); ?>
                   </a>
                    </div>
             	
				<?php else :?>	
				<div class="portfolio-item left">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('tia_threeColumn', array('class' => 'portfolioThumb', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>	
				</div>
				<?php endif; ?>
					<?php endwhile; ?>
             </div>
		</div>
<?php get_footer(); ?>		
		<?php endif; ?>

