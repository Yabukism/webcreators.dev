<?php
/**
 * Template Name: Portfolio Template
 *
 * @since alterna 8.0
 */
get_header();

global $paged, $thumbnail_size, $page_columns;
		
// get page layout 
$layout 			=	alterna_get_page_layout();
$layout_class 		=	alterna_get_page_layout_class();
$page_nums			=	penguin_get_post_meta_key('page-posts-num');
$page_columns		=	intval(penguin_get_post_meta_key('page-posts-cols'));
$page_item_style	=	intval(penguin_get_post_meta_key('portfolio-show-style')) + 1;
$page_show_filter	=	penguin_get_post_meta_key('portfolio-show-filter');
$page_auto_load		=	penguin_get_post_meta_key('page-posts-ajax-auto');
$page_image_no_crop	=	penguin_get_post_meta_key('page-posts-img-no-crop');
$page_cats			=	penguin_get_post_meta_key('page-posts-cat-slugs');
$page_columns_class =	alterna_get_element_columns(intval($page_columns));
$thumbnail_size 	=	alterna_get_thumbnail_size(intval($page_columns), $page_image_no_crop);

?>
<div id="main" class="container">
	<div class="row">
        <div class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">
			<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
            <div class="post-content">
                  <?php the_content(); ?>
                  <?php wp_link_pages(); ?>
            </div>
            <?php }} ?>
            <?php 
			$tax_query =	array();	
			if($page_cats != "") {
				$slugs = explode("," , $page_cats);
				$tax_query[] = array('taxonomy' => 'portfolio_categories','field' => 'slug','terms' => $slugs);
			}
			?>
            <div class="portfolio-main-area">
            	<?php if($page_show_filter == "on"){ ?>
                <section class="portfolio-filters">
                    <div class="portfolio-filters-cate">
                        <ul class="inline">
                            <li><a data-filters="*" class="active"><?php _e('All', 'alterna'); ?></a></li>
                            <?php 
								$categories 		=	alterna_get_custom_all_categories('portfolio_categories'); 
								if($page_cats != "" && count($slugs) > 0) {
									foreach($categories as $category){
										foreach($slugs as $slug){
											if( $slug == $category->slug){
												echo '<li><a data-filters=".cat-'.$category->slug.'" >'.$category->name.'</a></li>';
												break;
											}
										}
									}
								}else{
									 foreach($categories as $category){
										echo '<li><a data-filters=".cat-'.$category->slug.'" >'.$category->name.'</a></li>';
									}
								}
                            ?>
                        </ul>
                    </div>
                </section>
                <?php } ?>
                <section class="portfolio-container row portfolio-isotope" <?php echo $page_image_no_crop == "on" ? 'data-layoutmode="masonry"' : ''; ?>>
                    <?php 
                    if($paged == 0){ $paged = 1;}
                    
                    $args = array(	'post_type' => 'portfolio',
                                    'post_status' => 'publish',
                                    'paged' => $paged,
                                    'posts_per_page'=> $page_nums
                                 );
                    
                    // show category,tags portfolio
                    if(count($tax_query) > 0) {
						$args['tax_query'] = $tax_query;
                    }
                    
                    // The Query
                    $portfolios = new WP_Query($args);
                    if ($portfolios -> have_posts() ) {
                        while ($portfolios -> have_posts() ) {
                            $portfolios-> the_post();
							$portfolio_cats = alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',true,' ','slug','cat-');
							?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-element '.$page_columns_class.' '.$portfolio_cats.' portfolio-style-'.$page_item_style);?> itemscope itemtype="http://schema.org/CreativeWork">
                            <?php
							get_template_part( 'template/portfolio/content-style', $page_item_style);
                        }
                    }
                    ?>
                </section>
                <?php alterna_content_pagination('nav-bottom' , 'pagination-centered' , 2 , $portfolios); ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
        <?php if($layout != 1) { ?> 
        <aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php generated_dynamic_sidebar(); ?></aside>
        <?php } ?>
    </div>
</div>

<?php get_footer(); ?>