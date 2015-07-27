<?php
/**
 * Footer Copyright & Link Custom Content
 * 
 * @since alterna 7.0
 */
?>
<div class="container">
    <div class="footer-copyright"><?php echo do_shortcode(penguin_get_options_key('footer-copyright-message')); ?></div>
    <div class="footer-link"><?php echo do_shortcode(penguin_get_options_key('footer-link-text')); ?></div>
</div>