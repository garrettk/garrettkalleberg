<?php

/* ///////////////////////////////////////////////////////////////////// 
//  Define Widgetized Areas
/////////////////////////////////////////////////////////////////////*/


register_sidebar(array(
	'name' => 'Footer',
	'id' => 'footer_default',
	'description' => 'Default Footer Widget.',
	'before_widget' => '<div id="%1$s" class="oneThird %2$s footerBox widgetBox">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));


register_sidebar(array(
	'name' => 'Single Post Top',
	'id' => 'post_top',
	'description' => 'Use this widget to include ads, widgets, etc. in the top of your posts, just below your feature pic, headline and author info.',
	'before_widget' => '<div id="%1$s" class="">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));

register_sidebar(array(
	'name' => 'Single Post Bottom',
	'id' => 'post_bottom',
	'description' => 'Use this widget to include ads, widgets, etc. in the bottom of your posts, above the comments area.',
	'before_widget' => '<div id="%1$s" class="">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));



/* Allow widgets to use shortcodes */
add_filter('widget_text', 'do_shortcode');


/*///////////////////////////////////////////////////////////////////// 
//  Recent Work
/////////////////////////////////////////////////////////////////////*/

class tia_Recent_Work extends WP_Widget {

	function tia_Recent_Work() {
		global $tia_theme_name, $tia_version, $options;
		$widget_ops = array('classname' => 'tia_Recent_Work', 'description' => 'Display recent items from your portfolio.' );
		$this->WP_Widget('tia_Recent_Work', $tia_theme_name.' '.' Latest Work', $widget_ops);
	}

	function widget($args, $instance) {
	
		global $tia_theme_name, $options;
	
		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 12;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 12 )
			$number = 12;
			
		$show_post = $instance['show_post'];		 

		$r = new WP_Query(array('post_type' => 'portfolio', 'showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
		if ($r->have_posts()) :
?>	

		<?php if(tia_get_option('tia_rss')) :
			$tia_feed = tia_get_option('tia_rss');		
		else :
			$tia_feed = $rp_cat ? get_category_feed_link($rp_cat, '') : get_bloginfo('rss2_url'); 
		endif;
		?>
	
		<?php if($show_post == "true") :?>
			
			
			<?php echo $before_title . $title . $after_title; ?>
			
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
				
				<div class="recentSidebarPost">
					<span class="meta"><?php the_time(get_option('date_format')); ?></span>
                    <h2><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a></h2>
				</div>
				
				<?php $i++; endwhile; ?>
				<div class="feedLink"><a  href="<?php echo $tia_feed; ?>">Subscribe</a></div>
			<?php echo $after_widget; ?>
			
		<?php else : ?>
			<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
		
			<ul class="recentPostsSidebar">
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
				<li>
					<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
					<?php if (has_post_thumbnail()) : ?>
					<?php the_post_thumbnail('tia_xsmall', array('class' => 'postThumb', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
					<?php else :?>
                    <img src="<?php bloginfo('template_directory') ?>/images/no_thumb_xsmall.jpg" />
                    <?php endif; ?>
                    </a>
				</li>
				<?php endwhile; ?>
			</ul>
			
			<?php echo $after_widget; ?>
		
		<?php endif; ?>
<?php
			wp_reset_query();  
		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_post'] = $new_instance['show_post'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Latest Work';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 9;
			
		$show_post = $instance['show_post'];

		$pn_categories_obj = get_categories('hide_empty=0');
		$pn_categories = array(); ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		

		<p><label for="<?php echo $this->get_field_id('number'); ?>">Number of posts:</label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small>12 is the maximum</small></p>
<?php
	}
}

register_widget('tia_Recent_Work');


/*///////////////////////////////////////////////////////////////////// 
//  Recent Posts
/////////////////////////////////////////////////////////////////////*/

class tia_Recent_Posts extends WP_Widget {

	function tia_Recent_Posts() {
		global $tia_theme_name, $tia_version, $options;
		$widget_ops = array('classname' => 'tia_recent_posts', 'description' => 'Display recent posts from any category.' );
		$this->WP_Widget('tia_recent_posts', $tia_theme_name.' '.' Recent Posts', $widget_ops);
	}

	function widget($args, $instance) {
	
		global $tia_theme_name, $options;
	
		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 12;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 12 )
			$number = 12;
			
		$rp_cat = $instance['rp_cat'];
		$show_post = $instance['show_post'];		 

		$r = new WP_Query(array('cat' => $rp_cat, 'showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
		if ($r->have_posts()) :
?>	

		<?php if(tia_get_option('tia_rss')) :
			$tia_feed = tia_get_option('tia_rss');		
		else :
			$tia_feed = $rp_cat ? get_category_feed_link($rp_cat, '') : get_bloginfo('rss2_url'); 
		endif;
		?>
	
		<?php if($show_post == "true") :?>
			
			
			<?php echo $before_title . $title . $after_title; ?>
			
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
				
				<div class="recentSidebarPost">
					<span class="meta"><?php the_time(get_option('date_format')); ?></span>
                    <h2><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a></h2>
				</div>
				
				<?php $i++; endwhile; ?>
				<div class="feedLink"><a  href="<?php echo $tia_feed; ?>">Subscribe</a></div>
			<?php echo $after_widget; ?>
			
		<?php else : ?>
			<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
		
			<ul class="recentPostsSidebar">
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
				<li>
					<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
					<?php if (has_post_thumbnail()) : ?>
					<?php the_post_thumbnail('tia_xsmall', array('class' => 'postThumb', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
					<?php else :?>
                    <img src="<?php bloginfo('template_directory') ?>/images/no_thumb_xsmall.jpg" />
                    <?php endif; ?>
                    </a>
				</li>
				<?php endwhile; ?>
			</ul>
			
			<?php echo $after_widget; ?>
		
		<?php endif; ?>
<?php
			wp_reset_query();  
		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['rp_cat'] = $new_instance['rp_cat'];
		$instance['show_post'] = $new_instance['show_post'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Posts';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 9;
			
		$rp_cat = $instance['rp_cat'];
		$show_post = $instance['show_post'];

		$pn_categories_obj = get_categories('hide_empty=0');
		$pn_categories = array(); ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('rp_cat'); ?>">Category</label>
		<select class="widefat" id="<?php echo $this->get_field_id('rp_cat'); ?>" name="<?php echo $this->get_field_name('rp_cat'); ?>">
			<option value="">All</option>
			<?php foreach ($pn_categories_obj as $pn_cat) {				
				echo '<option value="'.$pn_cat->cat_ID.'" '.selected($pn_cat->cat_ID, $rp_cat).'>'.$pn_cat->cat_name.'</option>';
			} ?>
		</select></p>
		

		<p><label for="<?php echo $this->get_field_id('number'); ?>">Number of posts:</label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small>12 is the maximum</small></p>
<?php
	}
}

register_widget('tia_Recent_Posts');





/*///////////////////////////////////////////////////////////////////// 
//  Twitter
/////////////////////////////////////////////////////////////////////*/

class tia_Twitter extends WP_Widget {
 
	function tia_Twitter() {
	
		global $tia_theme_name, $tia_version, $options;
		
        $widget_ops = array('classname' => 'widget_tia_twitter', 'description' => 'Display latest tweets.');
		$this->WP_Widget('tia_twitter', $tia_theme_name.' '.'Twitter', $widget_ops);
    
    }
 
    function widget($args, $instance) {
    
    	global $tia_theme_name, $tia_version, $options;
       
        extract( $args );
        
        $title	= empty($instance['title']) ? 'Latest Tweets' : $instance['title'];
        $user	= empty($instance['user']) ? tia_get_option('tia_twitter') : $instance['user'];
        $link	= $instance['twitter_link'] ? '1' : '0';
        $label	= $instance['twitter_label'];
        if ( !$nr = (int) $instance['twitter_count'] )
			$nr = 5;
		else if ( $nr < 1 )
			$nr = 1;
		else if ( $nr > 15 )
			$nr = 15;
 
        ?>
			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
				
				<div id="twitter_div">
    				<ul id="twitter_update_list" class="list1"><li></li></ul>
    			</div>
                  
                <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
    			<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $user; ?>.json?callback=twitterCallback2&amp;count=<?php echo $nr; ?>"></script>
                  
                <?php if($label) : ?>
                <p class="twitterLink"><a href="http://twitter.com/<?php echo $user; ?>"><span><?php echo $label; ?></span></a></p>
                <?php endif; ?>
 
			<?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {  
    
    	$instance['title'] = strip_tags($new_instance['title']);
    	$instance['user'] = strip_tags($new_instance['user']);
    	$instance['twitter_link'] = $new_instance['twitter_link'] ? 1 : 0;
    	$instance['twitter_label'] = strip_tags($new_instance['twitter_label']);
    	$instance['twitter_count'] = (int) $new_instance['twitter_count'];
                  
        return $new_instance;
    }
 
    function form($instance) {
    
    	global $tia_theme_name, $tia_version, $options;
        
		$instance	= wp_parse_args( (array) $instance, array( 'title' => '', 'user' => '', 'twitter_link' => '', 'twitter_label' => '', 'twitter_count' => '') );
		$title		= empty($instance['title']) ? 'Latest Tweets' : $instance['title'];
		$user		= $instance['user'];		
		$label		= $instance['twitter_label'];
		if (!$count = (int) $instance['twitter_count']) $count = 5;
?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('user'); ?>">Username:
			<input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo attribute_escape($user); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_count'); ?>">Number of tweets:</label>
			<input id="<?php echo $this->get_field_id('twitter_count'); ?>" name="<?php echo $this->get_field_name('twitter_count'); ?>" type="text" value="<?php echo $count; ?>" size="3" /><br />
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_label'); ?>">Follow Link label:
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_label'); ?>" name="<?php echo $this->get_field_name('twitter_label'); ?>" type="text" value="<?php echo attribute_escape($label); ?>" />
			</label>
		</p>
		
<?php
	}

}
 
register_widget('tia_Twitter');



/*///////////////////////////////////////////////////////////////////// 
//  Facebook
/////////////////////////////////////////////////////////////////////*/

class tia_Facebook extends WP_Widget {
 
	function tia_Facebook() {
	
		global $tia_theme_name, $tia_version, $options;
		
        $widget_ops = array('classname' => 'widget_tia_facebook', 'description' => 'Display Facebook fanbox.');
		$this->WP_Widget('tia_facebook', $tia_theme_name.' '.'Facebook', $widget_ops);
    
    }
 
    function widget($args, $instance) {
    
    	global $tia_theme_name, $tia_version, $options;
       
        extract( $args );
        
        $title	= empty($instance['title']) ? 'On Facebook' : $instance['title'];
        $user	= empty($instance['url']) ? tia_get_option('tia_facebook') : $instance['url'];        
 
        ?>
			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
                <iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo $user; ?>&amp;width=265&amp;colorscheme=light&amp;connections=8&amp;stream=false&amp;header=false&amp;height=255" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:265px; height:255px;" allowTransparency="true"></iframe>
 
			<?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {  
    
    	$instance['title'] = strip_tags($new_instance['title']);
    	$instance['user'] = strip_tags($new_instance['user']);
                  
        return $new_instance;
    }
 
    function form($instance) {
    
    	global $tia_theme_name, $tia_version, $options;
        
		$instance	= wp_parse_args( (array) $instance, array( 'title' => '', 'user' => '') );
		$title		= empty($instance['title']) ? 'On Facebook' : $instance['title'];
		$user		= $instance['user'];		
?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('user'); ?>">Facebook Fan Page URL:
			<input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo attribute_escape($user); ?>" />
			</label>
		</p>		
		
		
<?php
	}

}
 
register_widget('tia_Facebook');


