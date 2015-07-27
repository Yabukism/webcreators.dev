<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $wp_query, $author;

$prepend      = '';
$permalinks   = get_option( 'woocommerce_permalinks' );
$shop_page_id = wc_get_page_id( 'shop' );
$shop_page    = get_post( $shop_page_id );

if(is_shop()){
	$p_ID = $shop_page_id;
}else if(is_single()){
	$p_ID = $post->ID;
}else {
	$p_ID = -1;
}

?>
<div class="page-header-wrap">
<?php if(alterna_get_current_bool_value(penguin_get_post_meta_key('title-show', $p_ID))) { ?>
    <div id="page-header">
        <div class="top-shadow"></div>
        <div  class="container">
            <div class="page-header-content">
                <?php 
					$title 	= 	penguin_get_post_meta_key('title-content', $p_ID);
					$desc	=	penguin_get_post_meta_key('title-desc', $p_ID);
					$enable_breadcrumb	=	penguin_get_post_meta_key('title-breadcrumb', $p_ID);
					if($title == ''){ 
						echo '<h1 class="title">';
						if(is_single()){
							echo get_the_title();
						}else {
							woocommerce_page_title();
						}
						echo '</h1>'; 
					}else{
						echo $title;
					}
				?>
				<?php if($desc != "") { ?>
				<div class="page-desc"><?php echo $desc; ?></div>
				<?php } ?>
            </div>
        </div>
    </div>
    <?php if($enable_breadcrumb != "off") { ?>
    <div id="page-breadcrumb">
        <div class="container">
             <?php if ( penguin_get_options_key('global-breakcrumbs-enable') == 'on' &&  function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p class="yoast_breadcrumbs">','</p>');
            }else{ ?>
            <ul>
            <?php
if( ! $home ) {
	$home = _x( 'HOME', 'breadcrumb', 'alterna' );
}

$home_link = home_url();



if ( get_option('woocommerce_prepend_shop_page_to_urls') == "yes" && wc_get_page_id( 'shop' ) && get_option( 'page_on_front' ) !== wc_get_page_id( 'shop' )  || is_tax() || is_singular('product')){
	$prepend =  $before . '<li><i class="fa fa-chevron-right"></i><a href="' . get_permalink( wc_get_page_id('shop') ) . '">' . get_the_title( wc_get_page_id('shop') ) . '</a></li>' . $after;
}else{
	$prepend = '';
}
if(is_front_page() && is_shop()){
	$prepend =  $before . '<li><a href="' . get_permalink( wc_get_page_id('shop') ) . '"><i class="fa fa-home"></i></a></li>' . $after;
	
	echo $prepend;
	if ( get_query_var( 'paged' ) ){
		echo '<li><i class="fa fa-chevron-right"></i><span>' . '(' . __( 'Page', 'woocommerce' ) . ' ' . get_query_var( 'paged' ) . ')' . '</span></li>';
	}
} else if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) ) || is_paged() ) {

	echo $before  . '<li><a class="home" href="' . $home_link . '"><i class="fa fa-home"></i></a></li>'  . $after ;

	if ( is_category() ) {

		$cat_obj = $wp_query->get_queried_object();
		$this_category = get_category( $cat_obj->term_id );
		
		if ( $this_category->parent != 0 ) {
			$parent_category = get_category( $this_category->parent );
			echo '<li><i class="fa fa-chevron-right"></i><span>'.get_category_parents($parent_category, TRUE, $delimiter ).'</span></li>';
		}
		
		echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . single_cat_title( '', false ) .'</span></li>' . $after;

	} elseif ( is_tax('product_cat') ) {

		echo $prepend;
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		$parents = array();
		$parent = $term->parent;
		while ( $parent ) {
			$parents[] = $parent;
			$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
			$parent = $new_parent->parent;
		}

		if ( ! empty( $parents ) ) {
			$parents = array_reverse( $parents );
			foreach ( $parents as $parent ) {
				$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
				echo $before .  '<li><i class="fa fa-chevron-right"></i><a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a></li>' . $after;
			}
		}

		$queried_object = $wp_query->get_queried_object();
		echo $before . '<li><i class="fa fa-chevron-right"></i><span>'.$queried_object->name.'</span></li>' . $after;

	} elseif ( is_tax('product_tag') ) {

		$queried_object = $wp_query->get_queried_object();
		echo $prepend . $before . '<li><i class="fa fa-chevron-right"></i><span>' . __('Products tagged &ldquo;', 'woocommerce') . $queried_object->name . '&rdquo;' . '</span></li>' . $after;

	} elseif ( is_day() ) {

		echo $before . '<li><i class="fa fa-chevron-right"></i><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>' . $after;
		echo $before . '<li><i class="fa fa-chevron-right"></i><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li>' . $after;
		echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . get_the_time('d') . '</span></li>' . $after;

	} elseif ( is_month() ) {

		echo $before . '<li><i class="fa fa-chevron-right"></i><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>' . $after;
		echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . get_the_time('F') . '</span></li>' . $after;

	} elseif ( is_year() ) {

		echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . get_the_time('Y') . '</span></li>' . $after;

	} elseif ( is_post_type_archive('product') && get_option('page_on_front') !== wc_get_page_id('shop') ) {

		$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : ucwords( get_option( 'woocommerce_shop_slug' ) );

		if ( is_search() ) {

			echo $before . '<li><i class="fa fa-chevron-right"></i><a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a></li><li><i class="fa fa-chevron-right"></i><span>' . __('Search results for &ldquo;', 'woocommerce') . get_search_query() . '&rdquo;' . '</span></li>'. $after;

		} elseif ( is_paged() ) {

			echo $before . '<li><i class="fa fa-chevron-right"></i><a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a></li>' . $after;

		} else {
		
			echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . $_name . '</span></li>' . $after;

		}

	} elseif ( is_single() && !is_attachment() ) {

		if ( get_post_type() == 'product' ) {

			echo $prepend;

			if ( $terms = wp_get_object_terms( $post->ID, 'product_cat' ) ) {
				$term = current( $terms );
				$parents = array();
				$parent = $term->parent;
				
				while ( $parent ) {
					$parents[] = $parent;
					$new_parent = get_term_by( 'id', $parent, 'product_cat' );
					$parent = $new_parent->parent;
				}
				
				if ( ! empty( $parents ) ) {
					$parents = array_reverse($parents);
					foreach ( $parents as $parent ) {
						$item = get_term_by( 'id', $parent, 'product_cat');
						echo $before . '<li><i class="fa fa-chevron-right"></i><a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a></li>' . $after;
					}
				}
				
				echo $before . '<li><i class="fa fa-chevron-right"></i><a href="' . get_term_link( $term->slug, 'product_cat' ) . '">' . $term->name . '</a></li>' . $after;
			
			}

			echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . get_the_title() . '</span></li>' . $after;

		} elseif ( get_post_type() != 'post' ) {
			
			$post_type = get_post_type_object( get_post_type() );
			$slug = $post_type->rewrite;
				echo $before . '<li><i class="fa fa-chevron-right"></i><a href="' . get_post_type_archive_link( get_post_type() ) . '">' . $post_type->labels->singular_name . '</a></li>' . $after;
			echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . get_the_title() . '</span></li>' . $after;
		
		} else {
			
			$cat = current( get_the_category() );
			echo '<li><i class="fa fa-chevron-right"></i>' . get_category_parents( $cat, true, $delimiter ) . '</li>';
			echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . get_the_title() . '</span></li>' . $after;
		
		}

	} elseif ( is_404() ) {

		echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . __( 'Error 404', 'woocommerce' ) . '</span></li>' . $after;

	} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

		$post_type = get_post_type_object( get_post_type() );
		
		if ( $post_type )
			echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . $post_type->labels->singular_name . '</span></li>' . $after;

	} elseif ( is_attachment() ) {

		$parent = get_post( $post->post_parent );
		$cat = get_the_category( $parent->ID ); 
		$cat = $cat[0];
		echo '<li><i class="fa fa-chevron-right"></i>' . get_category_parents( $cat, true, '' . $delimiter ) . '</li>';
		echo $before . '<li><i class="fa fa-chevron-right"></i><a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a></li>' . $after;
		echo $before . '<li><i class="fa fa-chevron-right"></i><span>' .get_the_title() . '</span></li>' . $after;

	} elseif ( is_page() && !$post->post_parent ) {

		echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . get_the_title() . '</span></li>' . $after;

	} elseif ( is_page() && $post->post_parent ) {

		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		
		while ( $parent_id ) {
			$page = get_page( $parent_id );
			$breadcrumbs[] = '<li><i class="fa fa-chevron-right"></i><a href="' . get_permalink($page->ID) . '">' . get_the_title( $page->ID ) . '</a></li>';
			$parent_id  = $page->post_parent;
		}
		
		$breadcrumbs = array_reverse( $breadcrumbs );
		
		foreach ( $breadcrumbs as $crumb )
			echo $crumb;

		echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . get_the_title() . '</span></li>' . $after;

	} elseif ( is_search() ) {

		echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . __( 'Search results for &ldquo;', 'woocommerce' ) . get_search_query() . '&rdquo;' . '</span></li>' . $after;

	} elseif ( is_tag() ) {

			echo $before .'<li><i class="fa fa-chevron-right"></i><span>' . __( 'Posts tagged &ldquo;', 'woocommerce' ) . single_tag_title('', false) . '&rdquo;' . '</span></li>' . $after;

	} elseif ( is_author() ) {

		$userdata = get_userdata($author);
		echo $before . '<li><i class="fa fa-chevron-right"></i><span>' . __( 'Author:', 'woocommerce' ) . ' ' . $userdata->display_name . '</span></li>' . $after;

	}

	if ( get_query_var( 'paged' ) ){
		echo '<li><i class="fa fa-chevron-right"></i><span>' . '(' . __( 'Page', 'woocommerce' ) . ' ' . get_query_var( 'paged' ) . ')' . '</span></li>';
	}
}
?>
            </ul>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
<?php } ?>
</div><!-- end page-header-wrap -->