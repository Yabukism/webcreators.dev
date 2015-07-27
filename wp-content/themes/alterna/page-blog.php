<?php
/**
 * Template Name: Blog Template for Custom Categores
 *
 * @since alterna 8.0
 */
get_header();

global $paged, $blog_show_type;

// get page layout 
$layout 		=	alterna_get_page_layout(); 
$layout_class 	=	alterna_get_page_layout_class();
$per_page_num 	=	penguin_get_post_meta_key('page-posts-num');
$page_cats		=	penguin_get_post_meta_key('page-posts-cats');
$sidebar_name 	=	penguin_get_post_meta_key('sidebar-type');
$blog_show_type =	penguin_get_post_meta_key('blog-show-type');
?>
	<div id="main" class="container">
    	<div class="row">
        	<section class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">
				<?php 
					// blog page show top area custom content
					get_template_part( 'template/blog/top-content' );
					
					if($paged == 0){
						$paged = 1;
					}
					
					$args = array(	'post_type' => 'post',
									'post_status' => 'publish',
									'paged' => $paged,
									'posts_per_page'=> $per_page_num
								 );
					 
					if($page_cats != "") {
						$cats = explode("," , $page_cats);
						if(count($cats) > 0 && $cats[0] != "") {
							$args['category__in'] = $cats;
						}
					}
					// The Query
					query_posts($args);
					
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
					
					wp_reset_postdata();
				?>
			</section>
            <?php if($layout != 1) { ?> 
            <aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php generated_dynamic_sidebar($sidebar_name); ?></aside>
            <?php } ?>
		</div>
    </div>
        
<?php get_footer(); ?>