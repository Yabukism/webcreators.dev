<?php
/**
 * Blog Page Top Area Content
 * 
 * @since alterna 7.0
 */

if(( (is_home() && !is_front_page()) || ((is_category()|| is_tag() || is_date()) && penguin_get_options_key('blog-enable-top-content') == 'on') )  && (intval(get_option('page_for_posts')) > 0)) { 
?>
<div class="row">
    <div class="col-md-12 col-sm-12">
    <?php 
        $post = get_page(get_option('page_for_posts'));
        $content = apply_filters('the_content', $post->post_content);
        $content = str_replace(']]>', ']]>', $content);
        echo $content;
    ?>
    </div>
</div>
<?php } ?>