<?php
/**
 * @since alterna 8.4
 */
global $blog_page_id;

$blog_cat_type	=	intval(penguin_get_options_key('blog-cat-tags-style'));
$blog_page_id	=	intval(alterna_get_default_blog_waterfall_page());

if($blog_cat_type == 0 || ($blog_cat_type != 0 && $blog_page_id <= 0)){
	get_template_part( 'index' );
	return;
}

get_template_part( 'template/blog/cat-ajax-content'); 

?>

