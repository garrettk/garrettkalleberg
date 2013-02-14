<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
    
	<?php wp_head(); ?>
<script type="text/javascript">
jQuery(function($){
	$(document).ready(function(){
//responsive drop-down
		$("<select />").appendTo("#mainNav");
		$("<option />", {
		   "selected": "selected",
		   "value"   : "",
		   "text"    : "Go to:"
		}).appendTo("#mainNav select");
		$("#mainNav a").each(function() {
		 var el = $(this);
		 $("<option />", {
			 "value"   : el.attr("href"),
			 "text"    : el.text()
		 }).appendTo("#mainNav select");
		});
//remove options with # symbol for value
		$("#mainNav option").each(function() {
			var navOption = $(this);
			
			if( navOption.val() == '#' ) {
				navOption.remove();
			}
		});
		
		$("#mainNav select").change(function() {
		  window.location = $(this).find("option:selected").val();
		});
		
//uniform
		$(function(){
       		 $("#mainNav select").uniform();
      	});
	}); // END doc ready
}); // END function
</script>

    
</head>

<?php if(!tia_get_option('tia_disable_background')) { ?>
<body <?php body_class(tia_get_option('tia_theme_color')." ".tia_get_option('tia_theme_bkg')." ".tia_get_option('tia_theme_font')); ?>>
<?php } else { ?>
<body <?php body_class(tia_get_option('tia_theme_color')." ".tia_get_option('tia_theme_font')); ?>>
<?php } ?>

<div id="header" class="clearfix">
            <?php $tia_logo = tia_get_option('tia_logo'); ?>
            <div id="logo">
            <?php if($tia_logo) : ?>
                <a name="top" href="<?php bloginfo('url'); ?>"><img src="<?php echo $tia_logo; ?>" alt="<?php bloginfo('name'); ?>" /></a>
            <?php else : ?>
                <h1><a name="top" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
            <?php endif; ?>
            </div>
            <div id="mainNav">
                <?php wp_nav_menu( array('menu_class' => 'sf-menu', 'theme_location' => 'main', 'fallback_cb' => 'default_nav' )); ?>
   
				
			</div>
            <?php include( TEMPLATEPATH . '/includes/socialNetworks.php'); ?>
         </div>
         
<div id="container">
<div id="main" class="clearfix">
		