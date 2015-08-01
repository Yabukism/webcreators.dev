<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @since alterna 9.3
 */
global $page, $paged, $post, $post_id, $deviceType, $alterna_show_mode, $current_tax;

// get the current page
$paged = 1;
if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} else if (get_query_var('page')) {
	$paged = get_query_var('page');
}

// current post, page id
$post_id = ($post) ? $post->ID : '-1';
if(is_home() && !is_front_page()){
	$post_id = get_option('page_for_posts');
}

// global layout
$global_layout = 'boxed-layout'; 
if(intval(penguin_get_options_key('global-layout')) != 0){
	$global_layout = 'wide-layout';
}

// current tax
$current_tax = get_query_var('taxonomy');
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="<?php echo (penguin_get_options_key('favicon') != "") ? penguin_get_options_key('favicon') : get_template_directory_uri()."/img/favicon.png";?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/ie10-viewport-bug-workaround.js"></script>
	
	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
<?php wp_head();?>
</head>
<body <?php body_class($global_layout); ?>>
	<div class="wrapper">
		<div class="header-wrap">
        	<?php get_template_part( 'template/header/banner' );?>
        	<?php get_template_part( 'template/header/topbar' );?>
            <?php get_template_part( 'template/header/style', intval(penguin_get_options_key('header-style-type')) + 1);?>
    	</div><!-- end header-wrap -->
        <?php 
		get_template_part( 'template/page/header-slider' );
		//page title
		if( class_exists( 'woocommerce') && ( ( is_tax() && taxonomy_exists('product_cat') && $current_tax == "product_cat" ) || ( is_tax() && taxonomy_exists('product_tag') && $current_tax == "product_tag" ) || is_singular('product') || is_shop() ) ) {
			// will use woocommerce title & content wrap
		}else{
			if(is_404()){
			// 404 page don't show header title
			}else{
		?>
            <div class="page-header-wrap">
                <?php get_template_part( 'template/page/header-title' );?> 
            </div><!-- end page-header-wrap -->
        <?php } ?>
		<div class="content-wrap">
        <?php } ?>