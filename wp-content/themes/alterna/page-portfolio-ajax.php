<?php
/**
 * Template Name: Portfolio Template Waterfall Flux with AJAX
 *
 * @since alterna 8.0
 */

get_header(); 

global $paged, $page_nums, $page_cats, $page_columns, $page_item_style, $page_auto_load, $page_image_no_crop, $page_show_filter;

// get page layout 
$layout 			=	alterna_get_page_layout(); 
$layout_class 		=	alterna_get_page_layout_class();
$page_nums			=	penguin_get_post_meta_key('page-posts-num');
$page_columns		=	penguin_get_post_meta_key('page-posts-cols');
$page_cats			=	penguin_get_post_meta_key('page-posts-cat-slugs');
$page_item_style	=	penguin_get_post_meta_key('portfolio-show-style');
$page_auto_load		=	penguin_get_post_meta_key('page-posts-ajax-auto');
$page_image_no_crop	=	penguin_get_post_meta_key('page-posts-img-no-crop');
$page_show_filter	=	penguin_get_post_meta_key('portfolio-show-filter');
?>
<div id="main" class="container">
	<div class="row">
        <section class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">
		<?php
        if (have_posts() ) {
            while ( have_posts() ) { the_post();
        ?>
            <div class="post-content">
                  <?php the_content(); ?>
                  <?php wp_link_pages(); ?>
            </div>
		<?php
            }
        }
			get_template_part( 'template/portfolio/ajax-content');
        ?>
		</section>
		<?php if($layout != 1) { ?> 
        <aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php generated_dynamic_sidebar(); ?></aside>
        <?php } ?>
    </div>
</div>
<?php get_footer(); ?>