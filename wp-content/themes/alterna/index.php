<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme
 *
 * @since alterna 8.0
 */
get_header();

global $blog_show_type;

if(((is_home() && !is_front_page()) || is_category()|| is_tag() || is_date()) && (intval(get_option('page_for_posts')) > 0) ) {
	//when you use custom page for blog will use the page layout
	$layout = alterna_get_page_layout(get_option('page_for_posts'));
	$layout_class = alterna_get_page_layout_class(get_option('page_for_posts'));
	$sidebar_name = get_post_meta(get_option('page_for_posts'), 'sidebar-type', true);
}else{
	// index default will use global layout 
	$layout = alterna_get_page_layout('global'); 
	$layout_class = alterna_get_page_layout_class('global');
	$sidebar_name = '0';
}

$blog_show_type = penguin_get_options_key('blog-show-type');
?>
	<div id="main" class="container">
    	<div class="row">
        	<section class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">
				<?php 
					// blog page show top area custom content
					get_template_part( 'template/blog/top-content' );
					
					// blog posts
					if ( have_posts() ) {
						while ( have_posts() ) { 
							the_post();
							get_template_part( 'template/blog/content', get_post_format() );
						}
						alterna_content_pagination('nav-bottom' , 'pagination-centered');
					}else{
						 get_template_part( 'template/blog/content', 'none' );
					}
				?>
			</section>
            <?php if($layout != 1) { ?> 
            <aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php generated_dynamic_sidebar($sidebar_name); ?></aside>
            <?php } ?>
		</div>
    </div>
        
<?php get_footer(); ?>