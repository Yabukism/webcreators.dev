<?php
/**
 * Single Portfolio 
 *
 * @since alterna 8.0
 */

get_header(); 

// get page layout 
$layout 				= intval(penguin_get_post_meta_key('layout-type'));
$layout_class 			= '';
$portfolio_single_style = intval(penguin_get_post_meta_key('portfolio-post-style'));

if(intval($layout) == 0){
	$layout = intval(penguin_get_options_key('portfolio-post-layout')) + 1;
}

switch(intval($layout)){
	case 1: $layout_class = '';break;
	case 2: $layout_class = 'left';break;
	case 3: $layout_class = 'right';break;
}

if($portfolio_single_style == 0){
	$portfolio_single_style = intval(penguin_get_options_key('portfolio-post-style')) + 1;
}
$sidebar_name = penguin_get_post_meta_key('sidebar-type');
if($sidebar_name == ''|| $sidebar_name == "Global Sidebar"){
	$portfolio_default_page_id  = alterna_get_default_portfolio_page();
	if(intval($portfolio_default_page_id) != 0){
		$sidebar_name = penguin_get_post_meta_key('sidebar-type', $portfolio_default_page_id);
	}
}
?>
<div id="main" class="container">
    <div class="row">
        <section class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">
            <?php 
			if ( have_posts() ) {
				while ( have_posts() ){
					the_post();
					get_template_part( 'template/portfolio/single/content-style', $portfolio_single_style );
				}
			}else{ ?>
                <p><?php _e('Sorry, this page does not exist.' , 'alterna' ); ?></p>
            <?php } 
			alterna_single_content_nav('single-nav-bottom');
			?>
        </section>
        <?php if($layout != 1) { ?> 
        <aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php generated_dynamic_sidebar($sidebar_name); ?></aside>
        <?php } ?>
    </div>
</div>
<?php get_footer(); ?>