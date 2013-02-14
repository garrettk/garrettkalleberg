<?php get_header();  
	$layout = tia_get_option('tia_theme_folio');
	
	if(have_posts()&&get_post_type()!='portfolio') :
	$layout = 'other';
?>
	
<?php endif; ?>
<?php 
if($layout=='scroll') : ?>
	<div id="slideshow" class="table">	
		<div id="homescroll" class="tablerow">          

		<?php if(have_posts()) :?>
		
		<?php $i = 1; while (have_posts()) : the_post(); ?>			
		<?php $style = ""; ?>
		<?php if($i > 1) ?> 
			<?php $deactivate_links = tia_get_option('tia_slide_deactivate_links');
				  $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); 
				  $slideLink = get_permalink(); ?>
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
       
		<?php endif; ?>		
	
	</div>
</div>
<?php get_footer('clean'); ?>

<?php elseif($layout=='grid')   : ?>
		<div id="content" class="full clearfix">
			<div id="pageHead"><h1><?php echo $wp_query->queried_object->name; ?></h1></div>
            <div class="post portfolioList">
            	<?php 
					$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => 10)); 
				?>
				<?php $i = 1; while (have_posts()) : the_post(); ?>			
		<?php $style = ""; ?>
		<?php if($i > 1) ?> 
			<?php $deactivate_links = tia_get_option('tia_slide_deactivate_links');
				  $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); 
				  $slideLink = get_permalink(); ?>
			 		<?php if($deactivate_links) : ?>
			<?php $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); 
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
<?php else : ?>
	<div id="main" class="clearfix">				 
		<div id="content" class="posts clearfix">
				<div id="pageHead">
				<?php global $post; if(is_archive() && have_posts()) :
                
                    if (is_category()) : ?>
                    <h1><?php single_cat_title(); ?></h1>
                    <?php elseif( is_tag() ) : ?>
                    <h1><?php single_tag_title(); ?></h1>
                    <?php elseif (is_day()) : ?>
                    <h1>Archive <?php the_time('M j, Y'); ?></h1>
                    <?php elseif (is_month()) : ?>
                    <h1>Archive <?php the_time('F Y'); ?></h1>
                    <?php elseif (is_year()) : ?>
                    <h1>Archive <?php the_time('Y'); ?></h1>
                    <?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
                    <h1>Archive</h1>
                    <?php endif; ?>
                    
                <?php endif; ?>
            </div>
			
			<?php while (have_posts()) : the_post(); ?>
			    <div class="post clearfix">											
						<?php if(has_post_thumbnail()) : ?>												
					    		<a href="<?php the_permalink() ?>" rel="bookmark" >
								<?php the_post_thumbnail('tia_small', array('class' => 'postThumb blogFeature', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
                                </a>
                        <?php endif; ?>
                        <div class="postContent">
							<h1><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h1>				
							<?php the_content('',TRUE); ?>
							<?php more_link(); ?>
							<?php the_category(', ') ?>
						</div>
			    </div>	
			    
			    
			    			
			
			<?php endwhile; ?>
			
			<?php include( TEMPLATEPATH . '/includes/pagination.php'); ?>
					    	
		</div>
		
					
	</div>	
<?php get_footer(); ?>
<?php endif; ?>
