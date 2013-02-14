<?php get_header(); ?>
	<div id="pageHead">
		<h1>Links</h1>
	</div>
	<div id="main" class="clearfix">				 
		<div id="content" class="posts clearfix">			    
			<div class="post">					
				<ul>
				<?php get_links_list(); ?>
				</ul>				
			</div>				    	
		</div>		
		<?php get_sidebar(); ?>					
	</div>	
<?php get_footer(); ?>
