<?php
/**
 * The Template for displaying portfolio categories archive.
 *
 * @since alterna 8.0
 */

global $term,$portfolio_default_page_id, $paged, $thumbnail_size, $page_columns;

// get the taxonomy slug
$slug = get_query_var('term');
// get the current taxonomy_id
$term = get_term_by('slug',$slug,'portfolio_categories');

get_header(); 

// get page layout
$layout 			=	alterna_get_page_layout($portfolio_default_page_id); 
$layout_class 		=	alterna_get_page_layout_class($portfolio_default_page_id);
$sidebar_name 		=	penguin_get_post_meta_key('sidebar-type', $portfolio_default_page_id);
$page_columns		=	intval(penguin_get_post_meta_key('page-posts-cols', $portfolio_default_page_id));
$page_item_style	=	intval(penguin_get_post_meta_key('portfolio-show-style', $portfolio_default_page_id)) + 1;
$page_image_no_crop	=	penguin_get_post_meta_key('page-posts-img-no-crop', $portfolio_default_page_id);
$page_columns_class = 	alterna_get_element_columns(intval($page_columns));
$thumbnail_size 	= 	alterna_get_thumbnail_size(intval($page_columns), $page_image_no_crop);
?>
<div id="main" class="container">
	<div class="row">
        <div class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">
            <div class="portfolio-main-area">
            	<section class="portfolio-container row portfolio-isotope">
				<?php
                    if (have_posts() ) {
                        while (have_posts() ) { 
							the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-element '.$page_columns_class.' portfolio-style-'.$page_item_style);?> itemscope itemtype="http://schema.org/CreativeWork">
                    <?php
                        	get_template_part( 'template/portfolio/content-style', $page_item_style );
                        }
                    }
                    ?>
                </section>
                <?php alterna_content_pagination('nav-bottom' , 'pagination-centered'); ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
        <?php if($layout != 1) { ?> 
        <aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php generated_dynamic_sidebar($sidebar_name); ?></aside>
        <?php } ?>
    </div>
</div>
<?php get_footer(); ?>