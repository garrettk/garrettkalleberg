<?php get_header(); ?>
	<div id="main" class="clearfix">				 
		<div id="content" class="posts clearfix">		
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
						</div>
			    </div>			
			
			<?php endwhile; ?>
			<?php include( TEMPLATEPATH . '/includes/pagination.php'); ?>
		</div></div> <!-- end content -->
		<?php get_footer(); ?>



					

		
		