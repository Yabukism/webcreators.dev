<?php
/**
 * Portfolio Ajax Main Content
 *
 * @since alterna 7.0
 */
 
global $paged, $page_nums, $page_cats, $page_columns, $page_columns_class, $thumbnail_size, $page_auto_load, $page_item_style, $page_image_no_crop, $page_ajax_link, $page_show_filter;

// get show columns
$page_columns = isset($page_columns) ? intval($page_columns) : 1;
// get show item number
$page_nums = isset($page_nums) ? intval($page_nums) : 10;
// get item categories
$page_cats = isset($page_cats) ? esc_attr($page_cats) : "";
// get ajax style
$page_item_style = isset($page_item_style) ? (intval($page_item_style) + 1) : 1;
$page_columns_class = alterna_get_element_columns(intval($page_columns));
$thumbnail_size = alterna_get_thumbnail_size(intval($page_columns), $page_image_no_crop);

if($paged == 0){$paged = 1;}
                        
$tax_query		=	array();
// category
if($page_cats != "") {
	$slugs = explode("," , $page_cats);
	$tax_query[] = array('taxonomy' => 'portfolio_categories','field' => 'slug','terms' => $slugs);
}

 // get portfolio
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
if ( $portfolios->have_posts() ) {
?>
<div class="ajax-main-area <?php 
	if($page_show_filter == "on"){
		echo 'portfolio-main-area';
	}
?>">
	
    <?php if($page_show_filter == "on"){ ?>
    <section class="portfolio-filters">
        <div class="portfolio-filters-cate">
            <ul class="inline">
                <li><a data-filters="*" class="active"><?php _e('All', 'alterna'); ?></a></li>
                <?php 
                    $categories 		=	alterna_get_custom_all_categories('portfolio_categories'); 
                    if($page_cats != "") {
                        $slugs = explode("," , $page_cats);
                        $tax_query[] = array('taxonomy' => 'portfolio_categories','field' => 'slug','terms' => $slugs);
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
                
    <section class="ajax-isotope row portfolio-ajax-type" <?php echo $page_image_no_crop == "on" ? 'data-layoutmode="masonry"' : ''; ?>>
    <?php 
        while ( $portfolios->have_posts() ) {
            $portfolios->the_post();
			$portfolio_cats = alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',true,' ','slug','cat-');
			?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-ajax-element portfolio-element '.$page_columns_class.' '.$portfolio_cats.' portfolio-style-'.intval($page_item_style));?> itemscope itemtype="http://schema.org/CreativeWork">
            <?php
			get_template_part( 'template/portfolio/content-style', $page_item_style);
     	} 
	?>
    </section>
    <?php 
		if($portfolios->max_num_pages > $paged) {
	?>
    <div class="ajax-load-content" data-link="<?php echo esc_url(get_pagenum_link($paged+1)) ;?>" data-page="<?php echo esc_attr($paged+1); ?>" data-max="<?php echo esc_attr($portfolios->max_num_pages); ?>"></div>
    <div class="ajax-load-btn-container row">
    	<?php if($page_auto_load != "on"){ ?>
    	<a class="post-ajax-load-btn btn btn-theme float-btn btn-lg"><span><i class="fa fa-refresh"></i></span><?php echo __('Click Load More ...','alterna'); ?></a>
        <?php }else{ ?>
        <span class="post-ajax-scroll-load"><i class="fa fa-arrow-down"></i></span>
        <?php } ?>
        <span class="post-ajax-loading"><i class="fa fa-spinner fa-spin"></i><?php echo __('Load ...','alterna'); ?></span>
   	</div>
    <?php } ?>
</div>
<?php }?>
<?php wp_reset_postdata(); ?>