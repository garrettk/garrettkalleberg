<?php
define('TIA_DOMAIN', 'showcase');

// Load utility functions
require_once (TEMPLATEPATH . '/admin/utilities.php');
  
// Load main options panel file  
require_once (TEMPLATEPATH . '/admin/options.php');


//////////////////////////////////////////////////////////////
// Post Type Portfolio
/////////////////////////////////////////////////////////////
add_action('init', 'portfolio_register');
 
function portfolio_register() {
 
	$labels = array(
		'name' => _x('My Portfolio', 'post type general name'),
		'singular_name' => _x('Portfolio Item', 'post type singular name'),
		'add_new' => _x('Add New', 'portfolio item'),
		'add_new_item' => __('Add New Portfolio Item'),
		'edit_item' => __('Edit Portfolio Item'),
		'new_item' => __('New Portfolio Item'),
		'view_item' => __('View Portfolio Item'),
		'search_items' => __('Search Portfolio'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'show_in_nav_menus' => true,
		'has_archive' => true,
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'portfolio' , $args );
}

register_taxonomy("skills", array("portfolio"), array("hierarchical" => true, "label" => "Skills", "singular_label" => "Skill", "rewrite" => true));

add_action("admin_init", "admin_init");
 
function admin_init(){
  add_meta_box("credits_meta", "Work Details", "credits_meta", "portfolio", "side", "low");
}

 
function credits_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $year_completed = $custom["year_completed"][0];
  $title = $custom["title"][0];
  $details = $custom["details"][0];
  ?>
  <p><label>Year:</label>
  <input name="year_completed" value="<?php echo $year_completed; ?>" /></p>
  <p><label>Title:</label>
  <input name="title" value="<?php echo $title; ?>" /></p>
  <p><label>Details:</label><br />
  <textarea cols="25" name="details"><?php echo $details; ?></textarea></p>
  <?php
}

add_action('save_post', 'save_details');

function save_details(){
  global $post;
 
  update_post_meta($post->ID, "year_completed", $_POST["year_completed"]);
  update_post_meta($post->ID, "title", $_POST["title"]);
  update_post_meta($post->ID, "details", $_POST["details"]);
}

add_action("manage_posts_custom_column",  "portfolio_custom_columns");
add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");
 
function portfolio_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Portfolio Title",
    "description" => "Description",
    "year" => "Year Completed",
    "skills" => "Skills",
  );
 
  return $columns;
}
function portfolio_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "year":
      $custom = get_post_custom();
      echo $custom["year_completed"][0];
      break;
    case "skills":
      echo get_the_term_list($post->ID, 'skills', '', ', ','');
      break;
  }
}



//////////////////////////////////////////////////////////////
// Get Options
/////////////////////////////////////////////////////////////
	
function tia_get_option($key) {	
	global $tia_options;	
	$tia_options = get_option('tia_options');
	
	$tia_defaults = array(					
		'tia_main_padding_top' => 10,
		'tia_theme_bkg' => 'light',
		'tia_theme_folio' => 'scroll',
		'tia_show_descriptions' => false	,
		'tia_slide_deactivate_links' => false,
		'tia_home_layout' => 'threeColumn',
		'tia_socialicons' => 'black_and_white'
	);
	
		//Array of options not stored in tia_options array
	$not_in_array = array(		
		'tia_logo' => false		
	);
	
	if($not_in_array[$key]){
		if(!get_option($key)){
			$tia_options[$key] = $tia_defaults[$key];
		}
		else{
			$tia_options[$key] = get_option($key);
		}
	}else{			
		if (!$tia_options[$key]){		
			$tia_options[$key] = $tia_defaults[$key];			
		}
	}	
	return $tia_options[$key];
}  

	


//////////////////////////////////////////////////////////////
// Theme Header
/////////////////////////////////////////////////////////////
	
add_action('wp_enqueue_scripts', 'tia_scripts');

function tia_scripts() {

	wp_enqueue_script('jquery');
	
	wp_enqueue_script('superfish', get_bloginfo('template_url').'/scripts/superfish/superfish.js', array('jquery'), '1.4.8', true);
	wp_enqueue_script('supersubs', get_bloginfo('template_url').'/scripts/superfish/supersubs.js', array('jquery'), '1.4.8', true);
	wp_enqueue_style('superfish', get_bloginfo('template_url').'/scripts/superfish/superfish.css', false, '1.4.8', 'all' );	
	
	wp_enqueue_script('uniform', get_bloginfo('template_url').'/scripts/jquery.uniform.js', array('jquery'), '1.7.5', true);
	
	wp_enqueue_script('fancybox', get_bloginfo('template_url').'/scripts/fancybox/jquery.fancybox-1.3.4.pack.js', array('jquery'), '1.3.4', true);
	wp_enqueue_style('fancybox', get_bloginfo('template_url').'/scripts/fancybox/jquery.fancybox-1.3.4.css', false, '1.3.4', 'all' );
	
	wp_enqueue_script('tia', get_bloginfo('template_url').'/scripts/tia.js', array('jquery'), '1.0', true);
	

}

add_action('wp_head','tia_theme_head');

function tia_theme_head() { ?>
<meta name="generator" content="<?php global $tia_theme, $tia_version; echo $tia_theme.' '.$tia_version; ?>" />

<style type="text/css" media="screen">
<?php if(tia_get_option('tia_css')) : echo tia_get_option('tia_css'); endif; ?>
<?php if(tia_get_option('tia_color_menu_active')) : ?>
	#mainNav li:hover, #mainNav li.current , #mainNav li.current-cat , #mainNav li.current-cat, #mainNav li.current_page_item, #mainNav li.current_page_parent {background-color: #<?php echo(tia_get_option('tia_color_menu_active')); ?>;} 
	#mainNav .sf-menu li li a:hover {color: #<?php echo(tia_get_option('tia_color_menu_active')); ?>;}
<?php endif; ?>
<?php if(tia_get_option('tia_color_content_btn')) : ?>.button, #searchsubmit {background-color: #<?php echo(tia_get_option('tia_color_content_btn')); ?> !important;}<?php endif; ?>
<?php if(tia_get_option('tia_color_content_btn_hover')) : ?>.button:hover, #searchsubmit:hover {background-color: #<?php echo(tia_get_option('tia_color_content_btn_hover')); ?> !important;}<?php endif; ?>


<?php if(tia_get_option('tia_color_body_link')) : ?>#content a, #sidebar p a {color: #<?php echo(tia_get_option('tia_color_body_link')); ?>;}<?php endif; ?>
<?php if(tia_get_option('tia_color_body_link_hover')) : ?>#content a:hover, #sidebar p a:hover {color: #<?php echo(tia_get_option('tia_color_body_link_hover')); ?>;}<?php endif; ?>
</style>

<!--[if IE]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie7.css" type="text/css" media="screen" />
<![endif]-->

<style type="text/css" media="screen">
	<?php echo(tia_get_option('tia_custom_css')); ?>
</style>

<?php echo "\n".tia_get_option('tia_analytics')."\n"; ?>

<?php }

//////////////////////////////////////////////////////////////
// Custom Background Support
/////////////////////////////////////////////////////////////

if(function_exists('add_custom_background')) add_custom_background();



//////////////////////////////////////////////////////////////
// Theme Footer
/////////////////////////////////////////////////////////////

add_action('wp_footer','tia_footer');

function tia_footer() {
	
	
}




//////////////////////////////////////////////////////////////
// Remove
/////////////////////////////////////////////////////////////

// #more from more-link
function tia_remove($content) {
	global $id;
	return str_replace('#more-'.$id.'"', '"', $content);
}
add_filter('the_content', 'tia_remove');



// remove inline dimensions
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

//////////////////////////////////////////////////////////////
// Pagination Styles
/////////////////////////////////////////////////////////////

add_action( 'wp_print_styles', 'tia_deregister_styles', 100 );
function tia_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}
remove_action('wp_head', 'pagenavi_css');
remove_action('wp_print_styles', 'pagenavi_stylesheets');


//////////////////////////////////////////////////////////////
// Navigation Menus
/////////////////////////////////////////////////////////////

add_theme_support('menus');
register_nav_menu('main', 'Main Navigation Menu');

function default_nav() {
	require_once (TEMPLATEPATH . '/includes/default_nav.php');
}



//////////////////////////////////////////////////////////////
// Feature Images (Post Thumbnails)
/////////////////////////////////////////////////////////////

add_theme_support('post-thumbnails');

set_post_thumbnail_size(100, 100, true);
add_image_size('tia_xsmall', 78, 78, true);
add_image_size('tia_small', 175, 175, true);
add_image_size('tia_oneColumn', 685, 900);
add_image_size('tia_threeColumn', 255, 250, true);
add_image_size('tia_portfolioFront', 2000, 500);
add_image_size('tia_main_feature_full', 450, 900);


require_once (TEMPLATEPATH . '/admin/widgets.php');


//////////////////////////////////////////////////////////////
// Button Shortcode
/////////////////////////////////////////////////////////////

function tia_button($a) {
	extract(shortcode_atts(array(
		'label' 	=> 'Button Text',
		'url'	=> '',
		'id' 	=> '1',		
		'target' => '',		
		'size'	=> ''
	), $a));
	
	$link = $url ? $url : get_permalink($id);	
	
	return '<a href="'.$link.'"target="'.$target.'" class="button '.$size.'">'.$label.'</a>';
	
}

add_shortcode('button', 'tia_button');


//////////////////////////////////////////////////////////////
// Enable Shortcodes
/////////////////////////////////////////////////////////////
add_filter( 'slideshow_text', 'do_shortcode', 11 );
add_filter( 'the_content', 'do_shortcode', 11 );



//////////////////////////////////////////////////////////////
// Custom More Link
/////////////////////////////////////////////////////////////

function more_link() {
	global $post;	
	if (strpos($post->post_content, '<!--more-->')) :
		$more_link = '<p><a href="'.get_permalink().'"  class="'.$size.'" title="'.get_the_title().'">';
		$more_link .= '<span>Read More</span>';
		$more_link .= '</a></p>';
		echo $more_link;
	endif;
}


//////////////////////////////////////////////////////////////
// Meta Box
/////////////////////////////////////////////////////////////

$prefix = "_tia_";
$new_meta_boxes = array(
	
		"in_slideshow" => array(
    	"type" => "checkbox",
		"name" => $prefix."in_slideshow",
    	"std" => "",
    	"title" => __('Include on Front Page','tia'),
    	"description" => __('Check this box to display on the home page. <br /> <i>Featured images should be at least 1000 x 800 pixels for the best user experience.</i>','tia'))

/*		"on_homepage" => array(
		"type" => "checkbox",
		"name" => $prefix."on_frontpage",
		"std" => "",
		"title" => __('Include in Home Page Gallery','tia'),
		"description" => __('Check this box to display in home page gallery.','tia')),
		
		"show_descriptions" => array(
		"type" => "checkbox",
		"name" => $prefix."show_descriptions",
		"std" => "",
		"title" => __('Show Subpage Descriptions','tia'),
		"description" => __("Check this box if you're using one of the gallery templates for this page and want descriptions to be shown for each subpage.",'tia')),
		
		"description_text" => array(
    	"type" => "textarea",
		"name" => $prefix."description_text",
    	"std" => "",
    	"title" => __('Description','tia'),
    	"description" => __('This text will be shown below the thumbnail in galleries.','tia')) */
   		
);

function new_meta_boxes() {
global $post, $new_meta_boxes;

	foreach($new_meta_boxes as $meta_box) {
	
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
		if($meta_box_value == "") $meta_box_value = $meta_box['std'];
		
		echo'<div class="meta-field">';
		
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		
		echo'<p><strong>'.$meta_box['title'].'</strong></p>';
		
		if(isset($meta_box['type']) && $meta_box['type'] == 'checkbox') {
		
			if($meta_box_value == 'true') {
				$checked = "checked=\"checked\"";
			} elseif($meta_box['std'] == "true") {	
					$checked = "checked=\"checked\"";	
			} else {
					$checked = "";
			}
		
			echo'<p class="clearfix"><input type="checkbox" class="meta-radio" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="true" '.$checked.' /> ';		
			echo'<label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';		
		
		} elseif(isset($meta_box['type']) &&  $meta_box['type'] == 'textarea')  {			
			
			echo'<textarea rows="4" style="width:98%" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';			
			echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
		
		} else {
			
			echo'<input style="width:70%"type="text" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" /><br />';		
			echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
		
		}
		
		echo'</div>';
		
	} // end foreach
		
	echo'<br style="clear:both" />';
	
} // end meta boxes

function create_meta_box() {

	global $tia_theme_name;
	
	if ( function_exists('add_meta_box') ) {		
		add_meta_box( 'new-meta-boxes', $tia_theme_name. ' ' .__('Options','tia'), 'new_meta_boxes', 'portfolio', 'normal', 'high' );
	}
}

function save_postdata( $post_id ) {
global $post, $new_meta_boxes;

if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}

foreach($new_meta_boxes as $meta_box) {

	// Verify
	if(isset($_POST[$meta_box['name'].'_noncename'])){
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
	}

	if ( isset($_POST['post_type']) && 'portfolio' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
	} else {
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = "";
	if(isset($_POST[$meta_box['name'].'_value'])){
		$data = $_POST[$meta_box['name'].'_value'];
	}

if(get_post_meta($post_id, $meta_box['name'].'_value') == "") 
	add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
	update_post_meta($post_id, $meta_box['name'].'_value', $data);
elseif($data == "" || $data == $meta_box['std'] )
	delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
	
	} // end foreach
} // end save_postdata

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');






//////////////////////////////////////////////////////////////
// Comments
/////////////////////////////////////////////////////////////

function tia_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>		
	<li id="li-comment-<?php comment_ID() ?>">
		<div class="comment" id="comment-<?php comment_ID() ?>">			
			
			<?php echo get_avatar($comment,'80',get_bloginfo('template_url').'/images/default_avatar.png'); ?>			
   	   			
   	   		<h5><?php comment_author_link(); ?></h5>
			<span class="date"><?php comment_date(); ?></span>
				
			<?php if ($comment->comment_approved == '0') : ?>
				<p><span class="message">Your comment is awaiting moderation.</span></p>
			<?php endif; ?>
				
			<?php comment_text() ?>				
				
			<?php comment_reply_link(array_merge( $args, array('add_below' => 'comment','reply_text' => '<span>Reply</span>', 'login_text' => '<span>Log in to Reply</span>', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				
		</div><!-- end comment -->
			
<?php
}

function tia_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
<?php
}
?>