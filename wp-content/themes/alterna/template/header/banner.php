<?php
/**
 * Header Banner
 * 
 * @since alterna 7.0
 */

if(penguin_get_options_key('header-banner-enable') == "on") { ?>
<div id="header-banner" data-id="<?php echo penguin_get_options_key('header-banner-id'); ?>">
    <div class="container">
        <div class="header-banner-content">
        	<?php echo do_shortcode(penguin_get_options_key('header-banner-content')); ?>
        	<a href="#" class="close-btn"><i class="fa fa-times"></i></a>
        </div>
    </div>
</div>
<?php } ?>