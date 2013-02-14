<?php

//////////////////////////////////////////////////////////////
// TIA Theme - Options
/////////////////////////////////////////////////////////////

$tia_theme_name = "Spectrum Scroll";
$tia_theme_version = "2.3.1";
$tia_suggested_img_size = "At least 1024px x 768px";


require_once( TEMPLATEPATH . '/admin/admin-setup.php');
require_once( TEMPLATEPATH . '/admin/admin-functions.php');

add_action( 'admin_init', 'tia_register_options' );

function tia_register_options() {
	register_setting( 'tia_options_group', 'tia_options' );
}


function tia_options_page() {
	
global $tia_theme_name, $tia_theme_version, $tia_default_slideshow_speed, $tia_options, $tia_suggested_img_size;
	
?>

	<div id="adminOptions">		
		
		<div id="adminHeader" class="clearfix">
			<a id="tiaThemesLogo" href="#"><img src="<?php echo ADMIN_PATH . '/images/tia-themes-logo.png'; ?>" alt="Theme Spectrum" /></a>
			<div id="themeVersion">
				<a href="http://themespectrum.com" target="_blank"><?php echo("<strong>".$tia_theme_name . "</strong> v" . $tia_theme_version ); ?> | Support</a>	
			</div>
			<ul id="adminNav" class="tabs">
				<li id="tab1"><a href="#option1">General</a></li>
				<li id="tab2"><a href="#option2">Integration</a></li>				
				<li id="tab3"><a href="#option3">Social Media</a></li>		
				<li id="tab4"><a href="#option4">More Themes</a></li>		
			</ul>
		</div>		
		
		<form id="optionsForm" method="post" action="options.php">			
		
		    <?php
			settings_fields( 'tia_options_group' ); 
		    $tia_options = get_option('tia_options'); 
			$tia_logo = tia_get_option('tia_logo'); 
			$tia_main_padding_top = tia_get_option('tia_main_padding_top');
			$tia_theme_color = tia_get_option('tia_theme_color');
			$tia_theme_folio = tia_get_option('tia_theme_folio');
			$tia_theme_bkg = tia_get_option('tia_theme_bkg');
			$tia_rss = tia_get_option('tia_rss'); 
			?>
		    
		    <div class="optionsContainer clearfix">	
			
				<div id="saveBar" class="clearfix">
					<?php if($_REQUEST['updated'] || $_REQUEST['reset']) echo '<div id="message">'.$tia_theme_name.' '. 'Settings updated'.'</div>'; ?>
					<input type="submit" class="button" value="Save Changes" />
				</div>
				
				<div id="option1" class="optionContent">
					<!-- Logo -->					
					<div class="adminModule">
						<h3 class="logoTitle">Logo</h3>	    			
				    	
						<div class="logoContainer smallBottomMargin">
							<div id="status_tia_logo"></div>
							<?php if($tia_logo){ ?>	
								<img id="img_tia_logo" src="<?php echo($tia_logo); ?>" />
							<?php } ?>
						</div>	    											
						
						<div class="smallBottomMargin clearfix">		
							<textarea name="tia_options[tia_logo]" cols=70 rows=1><?php echo $tia_options['tia_logo']; ?></textarea>	
						</div>
						
						<p class="instructions">Enter a URL of your custom logo. You can use the <a href="<?php bloginfo('url'); ?>/wp-admin/media-new.php">media uploader</a> to get your image. Make sure you copy the URL of the logo before returning here.</p>					
		 										
					</div> 
                      			
                    <!-- Portfolio -->
                    <div class="adminModule">
                    <h3 class="settingsTitle">Portfolio Page Layout</h3>
                    	<div class="itemRow clearfix divided">						
							<label class="sliderLabel singleLine">Deactivate Links:</label>
							<input id="deactivateLinks" name="tia_options[tia_slide_deactivate_links]" type="checkbox" <?php if($tia_options['tia_slide_deactivate_links']) echo("checked"); ?>/>
						
							<p class="instructions clear">Check this box to prevent images from linking to corresponding pages.</p>
						</div>
						<div class="smallBottomMargin clearfix">		
                            <label class="singleLine">Layout:</label> 
                            <select name="tia_options[tia_theme_folio]" id="themefolio" class="tiaSelect inlineItem">
                                <option<?php if($tia_theme_folio=='grid') echo ' selected'; ?> value="grid">grid</option>
                                <option<?php if($tia_theme_folio=='scroll') echo ' selected'; ?> value="scroll">scroll</option>
                            </select>
                           
						</div>						
                    </div>
                    
                    <!-- Background -->
                    <div class="adminModule">
                    <h3 class="settingsTitle">Background</h3>
                    	<div class="smallBottomMargin clearfix">		
                            <label class="singleLine">Background:</label> 
                            <select name="tia_options[tia_theme_bkg]" id="themeBkg" class="tiaSelect inlineItem">
                                <option<?php if($tia_theme_bkg=='light') echo ' selected'; ?> value="light">light</option>
                                <option<?php if($tia_theme_bkg=='dark') echo ' selected'; ?> value="dark">dark</option>
                                <option<?php if($tia_theme_bkg=='lightLinen') echo ' selected'; ?> value="lightLinen">light linen</option>
                                <option<?php if($tia_theme_bkg=='darkLinen') echo ' selected'; ?> value="darkLinen">dark linen</option>
                            </select>
                            <span class="inlineItem"><input name="tia_options[tia_disable_background]" id="disable_background" class="" type="checkbox" value=true <?php if($tia_options['tia_disable_background']) echo("checked"); ?>/>&nbsp;Disable Background</span>
						</div>						
						<div class="smallBottomMargin clearfix divided">							
						 	<p class="instructions">If you check "Disable Background" you can use the built-in WordPress custom background feature.</p> 
						</div>
                    </div>
                    
                    
					<!-- CSS -->
					<div class="adminModule">
						<h3 class="settingsTitle">Custom CSS</h3>
						<textarea name="tia_options[tia_custom_css]" cols=70 rows=6><?php echo $tia_options['tia_custom_css']; ?></textarea>
						<p class="instructions">Enter custom CSS here. </p>
					</div>
					
					<!-- Footer Text -->
					<div class="adminModule">
						<h3 class="editTitle">Footer Text</h3>
						
						<h4>Top:</h4>
						<textarea name="tia_options[tia_footer_left]" cols=70 rows=6><?php echo $tia_options['tia_footer_left']; ?></textarea>
						<p class="instructions">This will appear on the top half of the footer.</p>
						
						<h4>Bottom:</h4>
						<textarea name="tia_options[tia_footer_right]" cols=70 rows=6><?php echo $tia_options['tia_footer_right']; ?></textarea>
						<p class="instructions">This will appear on the bottom half of the footer.</p>
					</div>					
					
				</div>		
			
		    	<div id="option2" class="optionContent">					
					
					<!-- Feed -->
					<div class="adminModule">
						<h3 class="rssTitle">RSS Feed</h3>
						<input name="tia_options[tia_rss]" id="rss" class="" type="text" size=40 value="<?php echo $tia_options['tia_rss']; ?>" />
						<p class="instructions">Enter your custom RSS URL (e.g. Feedburner).</p>
					</div>
					
					<!-- Analytics -->
					<div class="adminModule">
						<h3 class="analyticsTitle">Site Analytics</h3>
						<textarea name="tia_options[tia_analytics]" cols=40 rows=5><?php echo $tia_options['tia_analytics']; ?></textarea>
						<p class="instructions">Enter your custom analytics code. (e.g. Google Analytics).</p>
					</div>					
				</div>
				
				
			
			
			<div id="option3" class="optionContent">
				<div class="adminModule">
						<h3 class="socialTitle">Social Media</h3>
                        <div class="itemRow clearfix">	
							<label class="singleLine"><?php _e('Color-scheme:', 'tia'); ?></label>
							<select name="tia_options[tia_socialicons]" id="socialicons" class="tiaSelect inlineItem">							
								<option<?php if($tia_options['tia_socialicons']=='black_and_white') echo ' selected'; ?> value="black_and_white"><?php _e('Grayscale Icons', 'tia'); ?></option>
								<option<?php if($tia_options['tia_socialicons']=='color') echo ' selected'; ?> value="color"><?php _e('Full Color Icons', 'tia'); ?></option>
														
							</select>							
				</div>
                        <p class="instructions">Enter full URLs below including http://</p>
                        <p>LinkedIn:<br />
						<textarea name="tia_options[tia_linkedin]" cols=70 rows=1><?php echo $tia_options['tia_linkedin']; ?></textarea></p>
                        
                        <p>Twitter:<br />
						<textarea name="tia_options[tia_twitter]" cols=70 rows=1><?php echo $tia_options['tia_twitter']; ?></textarea></p>
                        
                        <p>Reddit:<br />
						<textarea name="tia_options[tia_reddit]" cols=70 rows=1><?php echo $tia_options['tia_reddit']; ?></textarea></p>
                        
                        <p>Facebook:<br />
						<textarea name="tia_options[tia_facebook]" cols=70 rows=1><?php echo $tia_options['tia_facebook']; ?></textarea></p>
                        
                         <p>Behance:<br />
						<textarea name="tia_options[tia_behance]" cols=70 rows=1><?php echo $tia_options['tia_behance']; ?></textarea></p>
                        
                         <p>Deviant Art:<br />
						<textarea name="tia_options[tia_deviantart]" cols=70 rows=1><?php echo $tia_options['tia_deviantart']; ?></textarea></p>
                        
                        <p>Delicious:<br />
						<textarea name="tia_options[tia_delicious]" cols=70 rows=1><?php echo $tia_options['tia_delicious']; ?></textarea></p>
                        
                        <p>Flickr:<br />
						<textarea name="tia_options[tia_flickr]" cols=70 rows=1><?php echo $tia_options['tia_flickr']; ?></textarea></p>
                        
                        <p>tumblr:<br />
						<textarea name="tia_options[tia_tumblr]" cols=70 rows=1><?php echo $tia_options['tia_tumblr']; ?></textarea></p>
                        
                        <p>digg:<br />
						<textarea name="tia_options[tia_digg]" cols=70 rows=1><?php echo $tia_options['tia_digg']; ?></textarea></p>
                        
                        <p>friendfeed:<br />
						<textarea name="tia_options[tia_friendfeed]" cols=70 rows=1><?php echo $tia_options['tia_friendfeed']; ?></textarea></p>
                        
                        <p>stumbleupon:<br />
						<textarea name="tia_options[tia_stumbleupon]" cols=70 rows=1><?php echo $tia_options['tia_stumbleupon']; ?></textarea></p>
                        
                        <p>design float:<br />
						<textarea name="tia_options[tia_designfloat]" cols=70 rows=1><?php echo $tia_options['tia_designfloat']; ?></textarea></p>
                        
                        <p>vimeo:<br />
						<textarea name="tia_options[tia_vimeo]" cols=70 rows=1><?php echo $tia_options['tia_vimeo']; ?></textarea></p>
                        
                        <p>Google:<br />
						<textarea name="tia_options[tia_google]" cols=70 rows=1><?php echo $tia_options['tia_google']; ?></textarea></p>
                        
                        <p>Blogger:<br />
						<textarea name="tia_options[tia_blogger]" cols=70 rows=1><?php echo $tia_options['tia_blogger']; ?></textarea></p>
                        
                        <p>YouTube:<br />
						<textarea name="tia_options[tia_youtube]" cols=70 rows=1><?php echo $tia_options['tia_youtube']; ?></textarea></p>
						
					</div>
	
			</div>
            
            <div id="option4" class="optionContent">					

					
					<!-- Feed -->
					
						<?php
            include_once(ABSPATH . WPINC . '/feed.php');
            $rss = fetch_feed('http://themespectrum.com/blog/category/wordpress-themes/feed/');
            $maxitems = $rss->get_item_quantity(10); 
            $items = $rss->get_items(0, $maxitems);
            global $post;
            ?>
            <?php $i=1; foreach ( $items as $item ) : ?>
		
                <div class="adminModule moreThemes">
                    
                    <h3 class="pageTitle"><span><?php echo $item->get_title();?></span></h3>
    
					<?php echo $item->get_description(); ?>
                    
                    <p style="padding-bottom:20px"><a href="<?php echo $item->get_permalink(); ?>" class="button" target="_blank"><?php _e('Theme Info', TIA_DOMAIN); ?></a></p>
                        
                </div><!-- end  -->
		    
		    <?php $i++; endforeach; ?>
		
			</div>										

		<input type="submit" class="button right" value="Save Changes" />
		
	</div>
<?php } ?>