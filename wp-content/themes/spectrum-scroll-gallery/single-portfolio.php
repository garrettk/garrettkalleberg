<?php get_header(); ?>
		<div id="content" class="full galview clearfix">
            <div class="post portfolioSingle">
            	<?php if(has_post_thumbnail()) {
					$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');

					echo '<div class="gallery right"><a rel="gallery" href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '">';
				   the_post_thumbnail('tia_oneColumn', array('class' => 'galimglrg','style' => ''.$style.'','alt' => ''.get_the_title().'', 'title' => ''.get_the_title().''));
				   echo '</a></div>';	
 }
				 ?>
            	<?php if(!is_front_page()):?>
                        <h1><?php the_title(); ?></h1>
            	<?php endif; ?>
					
					<?php while (have_posts()) : the_post(); 
                    $custom = get_post_custom();
					if (strlen($custom["year_completed"][0]) > 0){
						echo '<p class="portfolioDetails">Completed: ';
						echo $custom["year_completed"][0].'</p>';
					}
					if (strlen($custom["details"][0]) > 0){
						echo '<p class="portfolioDetails">Details: ';
						echo $custom["details"][0].'</p>';
					}
					echo '<p>';
					echo get_the_term_list($post->ID, 'skills', '', ', ','');
					echo '</p>';
					the_content(); ?>				
					<?php edit_post_link(' - Edit Page', ''); ?>			
				<?php comments_template('', true); ?>			
			<?php endwhile; ?>
            </div>					    	
		</div>		
<?php get_footer(); ?>

