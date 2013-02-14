<?php get_header(); ?>
		<div id="content" class="posts clearfix">
            <div class="post">
            	<?php if(!is_front_page()):?>
                        <h1><?php the_title(); ?></h1>
            	<?php endif; ?>
					<?php while (have_posts()) : the_post(); ?>				
					<?php if(has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('tia_threeColumn', array('class' => 'postThumb pageImg', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
                        <?php endif; ?>
					<?php the_content(); ?>				
					<?php edit_post_link(' - Edit Page', ''); ?>			
				<?php comments_template('', true); ?>			
			<?php endwhile; ?>
            </div>					    	
		</div>		
<?php get_footer(); ?>