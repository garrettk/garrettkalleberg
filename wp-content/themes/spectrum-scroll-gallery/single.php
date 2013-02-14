<?php get_header(); ?>
		<div id="content" class="posts clearfix">
			<?php while (have_posts()) : the_post(); ?>
			    
			    <div class="post">
						<?php if (!dynamic_sidebar('post_top')) : ?>
                        <?php endif; ?>
						<?php if(has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('tia_oneColumn', array('class' => 'postThumb', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
                        <?php endif; ?>
                        <h1 class="singlePostTitle"><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h1>
						<div class="meta">
							Posted by <?php the_author(); ?>
						</div>
						
                    
<?php the_content(); ?>	
                        <p><?php the_time( 'M j, Y' ) ?> | <?php the_category(', ') ?><?php edit_post_link(' | Edit', ''); ?><br /><?php the_tags('Tagged | ', ', ', '<br />'); ?></p>
			    <?php if (!dynamic_sidebar('post_bottom')) : ?>
                        <?php endif; ?>
			    </div>
				
				<?php comments_template('', true); ?>
			
			<?php endwhile; ?>
		</div>		
<?php get_footer(); ?>
