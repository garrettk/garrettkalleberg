<div id="socialNetworks" class="<?php echo(tia_get_option('tia_socialicons')); ?>">
	<span class="headerBarText">Connect</span>
	<?php if(tia_get_option('tia_facebook')) : ?>
            <a href="<?php echo tia_get_option('tia_facebook'); ?>" title="on facebook" id="facebook"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_twitter')) : ?>
            <a href="<?php echo tia_get_option('tia_twitter'); ?>" title="on twitter" id="twitter"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_flickr')) : ?>
            <a href="<?php echo tia_get_option('tia_flickr'); ?>" title="on flickr" id="flickr"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_tumblr')) : ?>
            <a href="<?php echo tia_get_option('tia_tumblr'); ?>" title="on tumblr" id="tumblr"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_behance')) : ?>
            <a href="<?php echo tia_get_option('tia_behance'); ?>" title="on Behance" id="behance"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_deviantart')) : ?>
            <a href="<?php echo tia_get_option('tia_deviantart'); ?>" title="on Deviant Art" id="deviantart"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_linkedin')) : ?>
            <a href="<?php echo tia_get_option('tia_linkedin'); ?>" title="on linkedin" id="linkedin"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_reddit')) : ?>
            <a href="<?php echo tia_get_option('tia_reddit'); ?>" title="on reddit" id="reddit"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_delicious')) : ?>
            <a href="<?php echo tia_get_option('tia_delicious'); ?>" title="on delicious" id="delicious"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_digg')) : ?>
            <a href="<?php echo tia_get_option('tia_digg'); ?>" title="on digg" id="digg"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_friendfeed')) : ?>
            <a href="<?php echo tia_get_option('tia_friendfeed'); ?>" title="on friendfeed" id="friendfeed"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_stumbleupon')) : ?>
            <a href="<?php echo tia_get_option('tia_stumbleupon'); ?>" title="on stumbleupon" id="stumbleupon"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_vimeo')) : ?>
            <a href="<?php echo tia_get_option('tia_vimeo'); ?>" title="on vimeo" id="vimeo"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_designfloat')) : ?>
            <a href="<?php echo tia_get_option('tia_designfloat'); ?>" title="on designfloat" id="designfloat"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_blogger')) : ?>
            <a href="<?php echo tia_get_option('tia_blogger'); ?>" title="on blogger" id="blogger"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_google')) : ?>
            <a href="<?php echo tia_get_option('tia_google'); ?>" title="on Google" id="google"></a>
    <?php endif; ?>
    <?php if(tia_get_option('tia_youtube')) : ?>
            <a href="<?php echo tia_get_option('tia_youtube'); ?>" title="on youtube" id="youtube"></a>
    <?php endif; ?>
	<?php $tia_rss = tia_get_option('tia_rss'); ?>
    <?php if($tia_rss) : ?>
        <a href="<?php echo $tia_rss; ?>" class="subscribe" id="rss"></a>
    <?php else : ?>
        <a href="<?php echo get_bloginfo('rss2_url') ?>" class="subscribe" id="rss"></a>
    <?php  endif; ?>
</div>