<?php
/**
 * Footer Banner
 * 
 * @since alterna 7.0
 */

if(penguin_get_options_key('footer-banner-enable') == "on") { ?>
<!-- footer banner -->
<div id="footer-banner" data-id="<?php echo penguin_get_options_key('footer-banner-id'); ?>">
    <div class="container">
    	<div class="footer-banner-content">
        	<?php echo do_shortcode(penguin_get_options_key('footer-banner-content')); ?>
        	<a href="#" class="close-btn"><i class="fa fa-times"></i></a>
        </div>
    </div>
</div>
<?php } ?>