<?php

//========================================================
//  	THEME METHODS
//========================================================

if ( ! function_exists( 'alterna_get_post_type_icon' ) ) :
/**
 * get current post type icon
 *
 * @since alterna 7.0
 */
function alterna_get_post_type_icon($post_type,$type = 'blog'){
	$icon_type = '';
	if($type == 'blog'){
		switch($post_type){
			case 'image': $icon_type = 'big-icon-picture'; break;
			case 'gallery': $icon_type = 'big-icon-slideshow'; break;
			case 'video': $icon_type = 'big-icon-video'; break;
			case 'audio': $icon_type = 'big-icon-music'; break;
			case 'quote': $icon_type = 'big-icon-quote'; break;
			default : 
				$icon_type = 'big-icon-file';
		}
	}else{
		switch($post_type){
			case '0':  $icon_type = 'big-icon-picture'; break;
			case '1':  $icon_type = 'big-icon-slideshow'; break;
			case '2':  $icon_type = 'big-icon-video'; break;
			default : $icon_type = 'big-icon-picture';
		}
	}
	
	return $icon_type;
}
endif;

if ( ! function_exists( 'alterna_get_thumbnail_size' ) ) :
/**
 * get current element image show size
 *
 * @since alterna 7.0
 */
function alterna_get_thumbnail_size($column_number, $no_crop = ''){
	if($no_crop == "on"){
		return 'alterna-nocrop-thumbs';
	}
	$thumbnail_size = 'alterna-m-thumbs';
	switch(intval($column_number)){
		case 0:$thumbnail_size = 'alterna-m-thumbs';break;
		case 1:$thumbnail_size = 'alterna-s-thumbs';break;
		case 2:$thumbnail_size = 'alterna-s-thumbs';break;
	}
	return $thumbnail_size;
}
endif;

if ( ! function_exists( 'alterna_get_element_columns' ) ) :
/**
 * get current element columns class
 *
 * @since alterna 7.0
 */
function alterna_get_element_columns($column_number){
	$columns = 'col-md-4 col-sm-6 col-xs-6';
	switch(intval($column_number)){
		case -1:$columns = 'col-md-12 col-sm-12 col-xs-12';break;
		case 0:$columns = 'col-md-6 col-sm-6 col-xs-6';break;
		case 1:$columns = 'col-md-4 col-sm-6 col-xs-6';break;
		case 2:$columns = 'col-md-3 col-sm-4 col-xs-6';break;
	}
	return $columns;;
}
endif;

if ( ! function_exists( 'alterna_posted_on' ) ) :
/**
 * Print HTML with meta information for the current author and category.
 *
 * @since alterna 7.0
 */
function alterna_posted_on(){
	?>
	<div class="cat-links"><i class="fa fa-folder-open"></i><span itemprop="genre"><?php 	
		$categories = get_the_category();
		$seperator = ' , ';
		$output = '';
		if($categories){
			foreach($categories as $category) {
				$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'alterna'), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
			}
		echo trim($output, $seperator);
		}
?></span></div>
	<?php
}
endif;

if ( ! function_exists( 'alterna_content_pagination' ) ) :
/**
 * Display navigation to pagination pages numbers when applicable
 *
 * @since alterna 7.0
 */
function alterna_content_pagination($pagination_id, $pagination_class = '', $max_show_number = 2 , $query = ''){
	global $wp_query;

	if($query == ''){ 
		$query = $wp_query;
	}

	if ( $query->max_num_pages > 1 ) {
		// get the current page
		$paged = 1;
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} else if (get_query_var('page')) {
			$paged = get_query_var('page');
		}
		
		?>
        <div id="<?php echo $pagination_id; ?>" class="<?php echo $pagination_class; ?>">
        	<ul class="pagination">
			<?php
            $max_number = $query->max_num_pages;
            //prev button
            if($paged > 1){
                echo '<li><a href="'. get_pagenum_link($paged-1) .'">'.__('&laquo; Prev','alterna').'</a></li>';
                if($paged - $max_show_number > 1){
					echo '<li><a href="'. get_pagenum_link(1) .'">1</a></li>';
				}
            }

            if($paged - $max_show_number > 2){
				echo  '<li><span>...</span></li>';
			}
            
            for($k= $paged - $max_show_number; $k <= ($paged+$max_show_number) & $k <= $max_number; $k++){
                if($k < 1){
					continue;
				}
                if($k == $paged) {
                    echo '<li><span class="disabled">'.$k.'</span></li>';
				}else{
                    echo '<li><a href="'.get_pagenum_link( $k).'">'.$k.'</a></li>';
				}
            }
            if($paged + $max_show_number < $max_number) {
                 if($paged + $max_show_number < ($max_number-1)){
					 echo  '<li><span>...</span></li>';
				 }
                 echo '<li><a href="'.get_pagenum_link( $max_number ).'">'.$max_number.'</a></li>';
            }
            //next button
            if($paged < $max_number){
				echo '<li><a href="'.get_pagenum_link($paged+1).'">'.__('Next &raquo;','alterna').'</a></li>';
			}
        	?>
        	</ul>
        </div>
        <?php
	}
}
endif;

if ( ! function_exists( 'alterna_show_setting_primary_menu' ) ) :
/**
 * get show have no menu information
 *
 * @since alterna 7.0
 */
function alterna_show_setting_primary_menu(){
	echo '<h5 style="float:left;color: #ffffff;margin-left: 10px;line-height: 20px;">'.__('Please open Admin -&gt; Appearance -&gt; Menus Setting','alterna').'</h5>';
}
endif;

if ( ! function_exists( 'alterna_show_setting_topbar_menu' ) ) :
function alterna_show_setting_topbar_menu(){
	echo __('Please open Admin -&gt; Appearance -&gt; Menus Setting','alterna');
}
endif;


if ( ! function_exists( 'alterna_get_custom_font' ) ) :
/**
 * get Custom Font For google font	
 *
 * @since alterna 7.0
 */
function alterna_get_custom_font(){
	global $alterna_options,$google_fonts,$google_load_fonts,$google_custom_fonts;
	
	$google_load_fonts = "";
	$google_custom_fonts = array();
	
 	$general_font 				= 'Open Sans';
	$general_font_size 			= '14px';
	$menu_font					= 'Open Sans';
	$menu_font_size				= '13px';
	$title_font					= 'Open Sans';
	
	$font_names = array();
	
	if(penguin_get_options_key('custom-enable-font') == "on"){

		$array = explode("|",$google_fonts);
		
		if( penguin_get_options_key('custom-general-font') !="0"){
			$font_name = $array[intval($alterna_options['custom-general-font'])-1];
			$general_font = alterna_get_current_font_name($font_name);
			array_push($font_names,$font_name.':'.penguin_get_options_key('custom-general-font-weight'));
		}else{
			array_push($font_names,'Open+Sans:400,400italic,300,300italic,700,700italic');
		}
			
		if( penguin_get_options_key('custom-menu-font') !="0"){
			$font_name = $array[intval($alterna_options['custom-menu-font'])-1];
			$menu_font = alterna_get_current_font_name($font_name);
			array_push($font_names,$font_name.':'.penguin_get_options_key('custom-menu-font-weight'));
		}else{
			array_push($font_names,'Open+Sans:400,400italic,300,300italic,700,700italic');
		}
		
		if( penguin_get_options_key('custom-title-font') !="0"){
			$font_name = $array[intval($alterna_options['custom-title-font'])-1];
			$title_font = alterna_get_current_font_name($font_name);
			array_push($font_names,$font_name.':'.penguin_get_options_key('custom-title-font-weight'));
		}else{
			array_push($font_names,'Open+Sans:400,400italic,300,300italic,700,700italic');
		}
	}else{
		array_push($font_names,'Open+Sans:400,400italic,300,300italic,700,700italic');
	}

	$google_custom_fonts['general_font']				= $general_font;
	$google_custom_fonts['menu_font']				= $menu_font;
	$google_custom_fonts['title_font']				= $title_font;
	
	$google_load_fonts = implode("|",array_unique($font_names));
}
endif;

if ( ! function_exists( 'alterna_get_current_font_name' ) ) :
/**
 * Get current font name
 *
 * @since alterna 7.0
 */
function alterna_get_current_font_name($font_name){
	$arr = explode(":", str_replace("+"," ",$font_name) );
	return $arr[0];
}
endif;

if ( ! function_exists( 'alterna_get_current_font_name' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since alterna 7.0
 */
function alterna_content_nav( $nav_id ,$nav_class = '' ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $nav_id; ?>"  class="posts-nav <?php echo $nav_class; ?>">
			<div class="nav-prev"><?php next_posts_link( __( '&larr; Older posts', 'alterna' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'alterna' ) ); ?>
		</nav>
	<?php endif;
}
endif;


if ( ! function_exists( 'alterna_single_content_nav' ) ) :
/**
 * Display single post navigation to next/previous post when applicable
 *
 * @since alterna 7.0
 */
function alterna_single_content_nav( $nav_id ,$nav_class = '' ) {
?>
	<nav id="<?php echo $nav_id;?>" class="single-pagination <?php echo $nav_class;?>">
		<?php previous_post_link('%link', '<span class="single-pagination-flag">'.__('Previous', 'ROEN').'</span><span><i class="fa fa-angle-double-left"></i>'.__('%title', 'alterna').'</span>'); ?>
		<?php next_post_link('%link ', '<span class="single-pagination-flag">'.__('Next', 'ROEN').'</span><span>'.__('%title', 'alterna').'<i class="fa fa-angle-double-right"></i></span>'); ?>
	</nav>
<?php
}
endif;

if ( ! function_exists( 'alterna_get_current_bool_value' ) ) :
/**
 * Get current bool value
 *
 * @since alterna 7.0
 */
function alterna_get_current_bool_value($value){
	if($value == "on" || ($value != "off" && intval($value) == 0)){
		return true;
	}
	return false;
}
endif;

if ( ! function_exists( 'alterna_get_page_layout' ) ) :
/**
 * Get Page Layout
 *
 * @since alterna 7.0
 */
function alterna_get_page_layout($id = "-1") {
	if($id != 'global'){
		$layout = intval(get_post_meta($id != "-1" ? $id : get_the_ID(), 'layout-type', true));
		if($layout != 0){
			return $layout;
		}
	}
	switch(intval(penguin_get_options_key('global-sidebar-layout'))){
		case 1: return 3;
		case 2: return 1;
	}
	return 2;
}
endif;

if ( ! function_exists( 'alterna_get_page_layout_class' ) ) :
/**
 * Get Page Layout
 *
 * @since alterna 1.0
 */
function alterna_get_page_layout_class($id = "-1") {
	if($id != 'global'){
		$layout = intval(get_post_meta($id != "-1" ? $id : get_the_ID(), 'layout-type', true));
		switch($layout){
			case 1: return '';
			case 2: return 'left';
			case 3: return 'right';
		}
	}
	switch(intval(penguin_get_options_key('global-sidebar-layout'))){
		case 1: return 'right';
		case 2: return '';
	}
	return 'left';
}
endif;

if ( ! function_exists( 'alterna_page_links' ) ) :
/**
 * Get Page Header Links
 *
 * @since alterna 7.0
 */
function alterna_page_links() {
	$output = '';
	// page is not front page show first link with "home" page;
    if( !is_front_page() ) {
       $output .= '<li><a href="'.home_url().'" title="'.__('Home','alterna').'"><i class="fa fa-home"></i></a></li>';
    }
    
	// page is used home page as posts
	if((is_home() || is_category() || is_tag() || is_date() || is_single()) && !is_front_page()){
		
		$single_type = get_post_type(get_the_ID());
		
		if(is_single() && $single_type == "portfolio") {
			global $portfolio_default_page_id;
		
			// show default portfolio page
			$portfolio_default_page_id  = alterna_get_default_portfolio_page();
			$portfolio_page = get_page( $portfolio_default_page_id );
			
			$output .= '<li><i class="fa fa-chevron-right"></i><a href="'.get_permalink($portfolio_default_page_id).'" title="'.$portfolio_page->post_title.'">'.$portfolio_page->post_title.'</a></li>';
		} else {
			if(intval(get_option('page_for_posts')) > 0) {
				$page = get_page( get_option('page_for_posts') );
				$output .= '<li><i class="fa fa-chevron-right"></i><a href="'.get_permalink(get_option('page_for_posts')).'" title="'.$page->post_title.'">'.$page->post_title.'</a></li>';
			}
		}
	}
	
	// page is category
	if(is_category()){
		$cat = get_category( get_query_var( 'cat' ) );
		$output .= '<li><i class="fa fa-chevron-right"></i><span>'.__('Category Archive for "','alterna').$cat->name.'"</span></li>';
	}
	
	// show portfolio category link
	if(taxonomy_exists('portfolio_categories') && is_tax()) {
		global $alterna_options,$term,$portfolio_default_page_id;
		
		// show default portfolio page
		$portfolio_default_page_id  = alterna_get_default_portfolio_page();
		$portfolio_page = get_page( $portfolio_default_page_id );
		
		$output .= '<li><i class="fa fa-chevron-right"></i><a href="'.get_permalink($portfolio_default_page_id).'" title="'.$portfolio_page->post_title.'">'.$portfolio_page->post_title.'</a></li>';
		// show category name
		$output .= '<li><i class="fa fa-chevron-right"></i><span>'.__('Category Archive for "','alterna').$term->name.'"</span></li>';
	}
	
	// show page title
	if(is_page() || is_single()){
		global $post;
		if ( is_page() && $post->post_parent ) {
      		$parent_id  = $post->post_parent;
      		$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<li><i class="fa fa-chevron-right"></i><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				$output .= $breadcrumbs[$i];
			}
    	}
		
		//add category link for post
		if(is_single()){
			if( is_singular('post') && penguin_get_options_key('blog-enable-breadchrumb') == 'on'){
				$categories = get_the_category();
				if($categories){
					$cat_first = true;
					$output .= '<li><i class="fa fa-chevron-right"></i>';
					foreach($categories as $category) {
						if(!$cat_first){ $output .= ' , ';}
						$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'alterna'), $category->name ) ) . '">'.$category->cat_name.'</a>';
						$cat_first = false;
					}
					$output .= '</li>';
				}
			}else if( is_singular('portfolio') && penguin_get_options_key('portfolio-enable-breadchrumb') == 'on'){
				$categories = alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false)  , ' , ');
				if($categories != ""){ $output .= '<li><i class="fa fa-chevron-right"></i>'.$categories.'</li>'; }
			}
		}
		
		$output .= '<li><i class="fa fa-chevron-right"></i><span>'.get_the_title().'</span></li>';
	}
	
	// tag page
	if(is_tag()) {

		$output .= '<li><i class="fa fa-chevron-right"></i><span>'.__('Posts Tagged "','alterna').single_tag_title('', false).'"</span></li>';
	}
	
	// 404 page
	if(is_404()){
		$output .= '<li><i class="fa fa-chevron-right"></i><span>'.__('404 Error' , 'alterna').'</span></li>';
	}
	
	// date page
	if(is_date()){
		$output .= '<li><i class="fa fa-chevron-right"></i><span>'.__('Date Archives for "','alterna').get_the_time('Y-M').'"</span></li>';
	}
	
	// author page
	if(is_author()){
		global $author_name;
		$output .= '<li><i class="fa fa-chevron-right"></i><span>'.__('Author "','alterna').$author_name.'"</span></li>';
	}
	return $output;
}
endif;

if ( ! function_exists( 'alterna_page_title' ) ) :
/**
 * Get Page Title
 *
 * @since alterna 7.0
 */
function alterna_page_title(){
	$output = '';
	
	// category page
	if(is_category()) $output = single_cat_title('', false);
	
	// tag page
	if(is_tag()) $output = single_tag_title('', false);
	
	// search page
	if(is_search()) $output = __('Search' , 'alterna');
	
	// 404 page
	if(is_404()) $output = __('Page Not Found' , 'alterna');
	
	// date page
	if(is_date())  $output = get_the_time('Y-M');
	
	// author page
	if(is_author()) $output = __('Author' , 'alterna');
	
	if(taxonomy_exists('portfolio_categories') && is_tax()) {
		global $term;
		$output = $term->name;
	}
	
	return $output;
}
endif;

if ( ! function_exists( 'alterna_get_topbar_content' ) ) :
/**
 * Show topbar left, right content
 *
 * @since alterna 8.0
 */
function alterna_get_topbar_content($position = 0){
	$topbar_custom_style = penguin_get_options_key('topbar-elements');

	if($topbar_custom_style && $topbar_custom_style != ""){
		$topbars 	= explode("|", $topbar_custom_style); 
		foreach($topbars as $topbar){
			$option = explode("-", $topbar);
			if(count($option) > 1 && intval($option[1]) != 2){
				if(intval($option[1]) == $position){
					switch($option[0]){
						case '0':
								$alterna_topbar_menu = array(
									'theme_location'  	=> 'alterna_topbar_menu',
									'container_class'	=> 'topbar-element',
									'menu_class'    	=> 'alterna-topbar-menu',
									'fallback_cb'	  	=> 'alterna_show_setting_topbar_menu'
								); 
								wp_nav_menu($alterna_topbar_menu);
								break;
						case '1':
								echo '<div class="topbar-element"><ul class="topbar-socials">';
								echo alterna_get_social_list('',true);
								 if(penguin_get_options_key('rss-feed') != ""){
									echo '<li class="social"><a href="'.penguin_get_options_key('rss-feed').'"><i class="fa fa-rss"></i></a></li>';
								}
								echo '</ul></div>';
								break;
						case '2':
								echo '<div class="topbar-element"><ul class="topbar-wmpl">';
                				echo penguin_get_wpml_switcher();
								echo '</ul></div>';
								break;
						case '3':
								echo '<div class="topbar-element custom-content"><p>'.do_shortcode(penguin_get_options_key('topbar-custom-content')).'</p></div>';
								break;
						case '4':
								echo '<div class="topbar-element"><ul class="topbar-login">';
								if (class_exists( 'woocommerce' )) {
									get_template_part('woocommerce/topbar-login');
								}else{
									get_template_part('template/header/topbar/login');
								}
								echo '</ul></div>';
								break;
						case '5':
								if (class_exists( 'woocommerce' )) {
									echo '<div class="topbar-element"><ul class="topbar-cart">';
									get_template_part('woocommerce/topbar-cart');
									echo '</ul></div>';
								}
								break;
						
					}
				}
			}
		}
	}
}
endif;

if ( ! function_exists( 'alterna_get_page_custom_options_css' ) ) :
/**
 * Get Page Custom Options CSS
 *
 * @since alterna 8.0
 */
function alterna_get_page_custom_options_css(){
	if((class_exists( 'woocommerce') && is_shop()) || is_page() || is_single() || is_home() || is_front_page()){
		if(class_exists( 'woocommerce') && is_shop()){
			$post_id = woocommerce_get_page_id( 'shop');
		}else if(is_home() && !is_front_page() && intval(get_option('page_for_posts')) > 0){
			$post_id = get_option('page_for_posts');
		}else{
			$post_id = get_the_ID();
		}
		$options = get_post_custom($post_id);
		?>
<style id="alterna-custom-page-css" type="text/css">
<?php

$align = penguin_get_post_meta_key('title-align',$post_id, 0);
if(intval($align) == 1){
	?>
	#page-header .page-header-content {text-align:center;}
	<?php
}else if(intval($align) == 2){
	?>
	#page-header .page-header-content {text-align:right;}
	<?php
}


alterna_add_background_style('page', 'body.boxed-layout', 1, false, $options); 
alterna_add_background_style('page-header','#alterna-header',1, false, $options); 
alterna_add_background_style('page-title','#page-header',1, false, $options); 
alterna_add_background_style('page-content','.content-wrap',1, false, $options); 
alterna_add_background_style('page-footer','.footer-content',1, false, $options); 
if(penguin_get_post_meta_key('post-css-style',$post_id) != ""){
	echo penguin_get_post_meta_key('post-css-style',$post_id);
}
?>
@media only screen and (-Webkit-min-device-pixel-ratio: 1.5),
only screen and (-moz-min-device-pixel-ratio: 1.5),
only screen and (-o-min-device-pixel-ratio: 3/2),
only screen and (min-device-pixel-ratio: 1.5) {
<?php 
alterna_add_background_style('page', 'body.boxed-layout', 1, true, $options); 
alterna_add_background_style('page-header','#alterna-header',1, true, $options); 
alterna_add_background_style('page-title','#page-header',1, true, $options); 
alterna_add_background_style('page-content','.content-wrap',1, true, $options); 
alterna_add_background_style('page-footer','.footer-content',1, true, $options);
if(penguin_get_post_meta_key('post-css-retina-style',$post_id) != ""){
	echo penguin_get_post_meta_key('post-css-retina-style',$post_id);
}
?>	
}
</style>
        <?php 
	}
}
endif;

if ( ! function_exists( 'alterna_get_page_custom_options_scripts' ) ) :
/**
 * Get Page Custom Scripts
 *
 * @since alterna 7.0
 */
function alterna_get_page_custom_options_scripts(){
	if((class_exists( 'woocommerce') && is_shop()) || is_page() || is_single() || is_home() || is_front_page()){
		if(class_exists( 'woocommerce') && is_shop()){
			$post_id = woocommerce_get_page_id( 'shop');
		}else if(is_home() && !is_front_page() && intval(get_option('page_for_posts')) > 0){
			$post_id = get_option('page_for_posts');
		}else{
			$post_id = get_the_ID();
		}
		if(penguin_get_post_meta_key('post-custom-scripts',$post_id) != ""){
			return penguin_get_post_meta_key('post-custom-scripts',$post_id);
		}
	}
	return '';
}
endif;

if ( ! function_exists( 'alterna_get_all_template_type_pages' ) ) :
/**
 * Get All Type Pages
 *
 * @since alterna 7.0
 */
function alterna_get_all_template_type_pages($template = array(), $re_id = false) {
	$template_pages = array();
	$p_types = $template;
	if(count($p_types) > 0){
		foreach($p_types as $p_type){
			$args = array(
				'meta_key' => '_wp_page_template',
				'meta_value' => $p_type,
				'post_type' => 'page',
				'post_status' => 'publish',
				'sort_column' => 'ID',
				'sort_order' => 'asc'
			); 
			$pages = get_pages($args); 
			if(!empty($pages)) {
				foreach($pages as $page){
					if($re_id){
						$template_pages[] = $page->ID;
					}else {
						$template_pages[$page->ID] = $page->post_title;
					}
				}
			}
		}
		if($re_id){
			sort($template_pages, SORT_NUMERIC);
		}else{
			ksort($template_pages, SORT_NUMERIC);
		}
	}
	return $template_pages;
}
endif;

if ( ! function_exists( 'alterna_get_default_portfolio_page' ) ) :
/**
 * Get Default Portfolio Page
 *
 * @since alterna 7.0
 */
function alterna_get_default_portfolio_page() {
	global $portfolio_default_page_id;
	$default_page_id = intval( penguin_get_options_key('portfolio-default-page') );
	$pages = alterna_get_all_template_type_pages(array('page-portfolio.php', 'page-portfolio-ajax.php'), true);
	if(isset($pages[$default_page_id])) {
		$default_page_id = $pages[$default_page_id];
		$template = get_post_meta( $default_page_id , '_wp_page_template', true );
		if($template == 'page-portfolio.php' || $template == 'page-portfolio-ajax.php' ) {
			$portfolio_default_page_id = $default_page_id;
			return $portfolio_default_page_id;
		}
	}
	foreach($pages as $key=>$value){
		$portfolio_default_page_id = $key;
		break;
	}
	return $portfolio_default_page_id;
}
endif;

if ( ! function_exists( 'alterna_get_default_blog_waterfall_page' ) ) :
/**
 * Get Default Blog Waterfall Flux Page
 *
 * @since alterna 7.0
 */
function alterna_get_default_blog_waterfall_page() {
	$default_page_id = intval( penguin_get_options_key('blog-waterfall-page') );
	$b_pages = alterna_get_all_template_type_pages(array('page-blog-ajax.php'), true);
	if(isset($b_pages[$default_page_id])) {
		return $b_pages[$default_page_id];
	}
	if(count($b_pages)> 0){
		return $b_pages[0];
	}
	return 0;
}
endif;

if ( ! function_exists( 'alterna_get_custom_all_categories' ) ) :
/**
 * Get all categories
 *
 * @since alterna 7.0
 */
function alterna_get_custom_all_categories($taxonomies,$bool = false){
	$categories = get_terms($taxonomies);
	$output = "";
	// return <li> html code
	if($bool){ 
		foreach($categories as $category){
			$output .= '<li>'.strtoupper($category->name).'</li>';
		}
	} else {
		return $categories;
	}
	return $output;
}
endif;

if ( ! function_exists( 'alterna_get_portfolio_categories' ) ) :
/**
 * Get Portfolio categories
 *
 * @since alterna 7.0
 */
function alterna_get_portfolio_categories(){
	$output = '<ul>';
	$categories = alterna_get_custom_all_categories('portfolio_categories');
	if(count($categories) > 0){
		foreach($categories as $category){
			if(intval($category->parent) != 0) continue;
			$subcategories = get_terms('portfolio_categories',array('child_of' => $category->term_id));

			$output .='<li><a href="'.esc_attr(get_term_link($category, 'portfolio_categories')).'">'.$category->name.' ( '.alterna_get_portfolio_list_by_categories(array($category->term_id),true).' ) '.'</a>';
			if(count($subcategories)>0){
				$output .='<ul>';
				foreach($subcategories as $subcategory){
					$output .='<li><a href="'.esc_attr(get_term_link($subcategory, 'portfolio_categories')).'">'.$subcategory->name.' ( '.alterna_get_portfolio_list_by_categories(array($subcategory->term_id),true).' ) '.'</a></li>';
				}
				$output .='</ul>';
			}
			$output .= '</li>';
		}
	}
    $output .='</ul>';
	return $output;
}
endif;

if ( ! function_exists( 'alterna_get_portfolio_list_by_categories' ) ) :
/**
 * Get Portfolio categories
 *
 * @since alterna 7.0
 */
function alterna_get_portfolio_list_by_categories($slugs = array(),$re_count = false){
	$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => -1, 
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio_categories',
					'field' => 'term',
					'terms' => $slugs)
				)
			);
	$the_query = new WP_Query($args);
	
	if($re_count){
		if($the_query->have_posts()) return $the_query->post_count;
		return 0;
	}
	return $the_query;
}
endif;

if ( ! function_exists( 'alterna_get_custom_post_categories' ) ) :
/**
 * Get current post categories
 * @bool = true return "," string name
 *
 * @since alterna 7.0
 */
function alterna_get_custom_post_categories($id,$taxonomies,$bool = false,$sep=' , ' , $type = 'name' , $exter = ''){
	$categories = get_the_terms($id,$taxonomies);
	$output = "";
	// return <li> html code
	if($bool && !empty($categories)){
		$first = true;
		foreach($categories as $category){
			if(!$first){
				$output .=$sep;
			}else{
				$first = false;
			}
			$output .= $exter.$category->$type;
		}
	} else {
		return $categories;
	}
	return $output;
}
endif;

if ( ! function_exists( 'alterna_get_custom_portfolio_category_links' ) ) :
/**
 * Get custom portfolio category links
 *
 * @since alterna 7.0
 */
function alterna_get_custom_portfolio_category_links($categories , $sep ='' , $taxonomies = "portfolio_categories"){
	
	$output = '';
	if( !empty($categories) ){
		$bool = false;
		foreach($categories as $category){
			if($bool) $output .= $sep;
			$output .= '<a href="'.get_term_link($category->slug, $taxonomies ).'">'.$category->name.'</a>';
			$bool = true;
		}
	}
	if($output == '') $output = __('No Category','alterna');
	return $output;
}
endif;


if ( ! function_exists( 'alterna_get_social_list' ) ) :
/**
 * Get social account from alterna setting
 *
 * @since alterna 9.0
 */
function alterna_get_social_list($extra_name='',$topbar = false, $data = null, $target = '_blank'){
	global $alterna_options;
	$str = "";
	$social_list = array(	array('twitter','Twitter') ,
				array('facebook', 'Facebook') ,
				array('google', 'Google Plus','google-plus') ,
				array('dribbble', 'Dribbble') ,
				array('pinterest', 'Pinterest') ,
				array('flickr', 'Flickr') ,
				array('skype', 'Skype') ,
				array('youtube', 'Youtube') ,
				array('vimeo', 'Vimeo','vimeo-square') ,
				array('linkedin', 'Linkedin'),
				array('digg', 'Digg') ,
				array('deviantart', 'Deviantart') ,
				array('behance', 'Behance') ,
				//array('forrst', 'Forrst') ,
				array('lastfm', 'Lastfm') ,
				array('xing', 'XING'),
				array('instagram', 'instagram'),
				array('stumbleupon', 'StumbleUpon'),
				array('github','Github','github-square'),
				array('soundcloud','SoundCloud'),
				array('vine','Vine'),
				array('whatsapp','Whatsapp'),
				array('yelp','Yelp'),
				array('twitch','Twitch'),
				array('codepen', 'Codepen'),
				//array('picasa', 'Picasa'),
				array('email','Email','envelope'),
				array('rss','Rss')
			);
	
	if($data != null){
		foreach($social_list as $social_item){
			if(isset($data['type']) && $data['type'] == $social_item[0]) {
				if(!isset($data['url'])) {
					$data['url'] = '#';
				}
				if(!isset($data['target'])) {
					$data['target'] = '_blank';
				}
				$str .= '<li class="social"><a  href="'.esc_attr($data['url']).'" target="'.esc_attr($data['target']).'"';
				
				if(isset($data['tooltip']) && $data['tooltip'] == "yes"){
					$str .= ' title="'.esc_attr($social_item[1]).'" class="show-tooltip"';
					if(isset($data['placement']) && $data['placement'] != ""){
						$str .= ' data-placement="'.esc_attr($data['placement']).'"';
					}
				}
				
				$str .= '><span class="alterna-icon-'.esc_attr($social_item[0]).'"';
				
				if($data['bg_color'] != "" || $data['color'] != ""){
					$str .= ' style="';
					if($data['bg_color'] != ""){
						$str .= 'background:'.esc_attr($data['bg_color']).';';
					}
					if($data['color'] != ""){
						$str .= 'color:'.esc_attr($data['color']).';';
					}
					$str .= '"';
				}
				
				$str .= '><i class="fa fa-'.(isset($social_item[2]) ? esc_attr($social_item[2]) : esc_attr($social_item[0])).'"></i></span></a></li>';
			}
		}
	}else{
		foreach($social_list as $social_item){
			if(penguin_get_options_key('social-'.$social_item[0]) != '') {
				if(!$topbar) {
					$str .=  '<li class="social"><a title="'.esc_attr($social_item[1]).'" href="'.esc_attr(penguin_get_options_key('social-'.$social_item[0])).'" target="'.esc_attr($target).'" ><span class="alterna-icon-'.esc_attr($social_item[0]).'"><i class="fa fa-'.(isset($social_item[2]) ? esc_attr($social_item[2]) : esc_attr($social_item[0])).'"></i></span></a></li>';
				}else{
					$str .=  '<li class="social"><a href="'.esc_attr(penguin_get_options_key('social-'.$social_item[0])).'" target="'.esc_attr($target).'" ><i class="fa fa-'.(isset($social_item[2]) ? esc_attr($social_item[2]) : esc_attr($social_item[0])).'"></i></a></li>';
				}
			}
		}
	}
	
	return $str;
}
endif;

if ( ! function_exists( 'alterna_get_color_list' ) ) :
/**
 * Get color list
 *
 * @since alterna 7.0
 */
function alterna_get_color_list($string){
	$output = '';
	$colors = explode(",",$string);
	if(count($colors) > 0){
		foreach($colors as $color){
			if($color != '') $output .= '<div class="circle-color show-tooltip" title="'.$color.'" style="background-color:'.$color.'"></div>';
		}
	}
	return $output;
}
endif;

if ( ! function_exists( 'alterna_get_gallery_list' ) ) :
/**
 * Get Page,Post custom gallery ids
 *
 * @since alterna 7.0
 */
function alterna_get_gallery_list($post_id, $thumbs_size, $fancybox_name = 'fancybox-thumb'){
	$gallery_images = penguin_get_post_meta_key('gallery-images', $post_id);
	$img_list = alterna_get_post_gallery_ids($gallery_images);
	$out_html = '';
	if(count($img_list) > 0){
		foreach($img_list as $item_id){
			$attachment_image = wp_get_attachment_image_src($item_id, $thumbs_size); 
			$full_image = wp_get_attachment_image_src($item_id, 'full'); 
			$out_html .= '<li><a href="'.esc_url($full_image[0]).'" class="fancybox-thumb" rel="'.$fancybox_name.'['.$post_id.']"><img src="'.esc_url($attachment_image[0]).'" alt=""></a></li>';
		}
	}
	
	return $out_html;
}
endif;

if ( ! function_exists( 'alterna_get_post_gallery_ids' ) ) :
/**
 * Get Page,Post custom gallery ids
 *
 * @since alterna 7.0
 */
function alterna_get_post_gallery_ids($gallery_images){
	$ids = array();
	$list = explode("{|}",$gallery_images);
	foreach($list as $item){
		$img_data = explode("<|>",$item);
		if(count($img_data) > 1 && isset($img_data[1])){
			$ids[] = $img_data[1];
		}
	}
	return $ids;
}
endif;

if ( ! function_exists( 'alterna_get_portfolio_custom_fields' ) ) :
/**
 * Get Portfolio custom gallery ids
 *
 * @since alterna 7.0
 */
function alterna_get_portfolio_custom_fields($current_data){
	$lists = explode("{|}",$current_data);
	if(count($lists) > 0){
		foreach($lists as $list_item){
			if($list_item == "") {continue;}
			$fileds = explode("[|]",$list_item);
			if(count($fileds) > 2){
				echo '<li><div class="type"><i class="fa '.esc_attr($fileds[1]).'"></i>'.esc_html($fileds[0]).'</div><div class="value">'.esc_html($fileds[2]).'</div></li>';
			}
		}
	}
}
endif;

if ( ! function_exists( 'alterna_comment_form' ) ) :
/**
 * Get comment form
 *
 * @since alterna 7.0
 */
function alterna_comment_form(){
	global $user_identity;
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	if ( comments_open() ) { ?>
		<div id="respond">
        	<div id="reply-title">
            	<h3><?php comment_form_title(__('Leave A Comment', 'alterna'), __('Leave A Comment', 'alterna')); ?></h3>
        	</div>
            <div class="row"><div class="col-md-12"><?php cancel_comment_reply_link(); ?></div></div>
			<form id="comment-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
        	
            <?php if ( is_user_logged_in() ) : ?>

            <p><?php _e('Logged in as', 'alterna'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out &raquo;', 'alterna'); ?></a></p>
    		<div class="row">
            	<div id="comment-textarea" class="col-md-12 col-sm-12">
                	<div class="placeholding-input">
                	<textarea placeholder="<?php _e('Comment...', 'alterna'); ?>" name="comment" id="comment" cols="60" rows="5" tabindex="4" class="textarea-comment logged-in"></textarea>
                    </div>
            	</div>
            </div>
            <div id="comment-alert-error" class="alert alert-danger">
                <span class="comment-alert-error-message"><?php _e('Please enter a message.', 'alterna'); ?></span>
            </div>
            <div class="form-submit">
                <button name="submit" type="submit" id="submit" class="btn btn-theme no-margin"><i class="fa fa-comment-o"></i><?php _e('Post Comment', 'alterna'); ?></button>
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', get_the_ID()); ?>
            </div>
		
		<?php else : ?>
        	<div class="row">
            	<div id="comment-input" class="col-md-6 col-sm-12">
                	<div class="placeholding-input">
                		<input type="text" name="author" id="author" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> class="input-name" />
                        <label for="author" class="placeholder"><?php _e('Name (required)', 'alterna'); ?></label>
                    </div>
                    <div class="placeholding-input">
                		<input type="text" name="email" id="email" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> class="input-email"  />
                        <label for="email" class="placeholder"><?php _e('Email (required)', 'alterna'); ?></label>
                    </div>
                    <div class="placeholding-input">
                		<input type="text" name="url" id="url" tabindex="3" class="input-website" />
                        <label for="url" class="placeholder"><?php _e('Website', 'alterna'); ?></label>
                    </div>
            	</div>
            
            	<div id="comment-textarea" class="col-md-6 col-sm-12">
                	<div class="placeholding-input">
                		<textarea name="comment" id="comment" cols="60" rows="5" tabindex="4" class="textarea-comment"></textarea>
                    	<label for="comment" class="comment-placeholder placeholder"><?php _e('Comment...', 'alterna'); ?></label>
                    </div>
            	</div>
            </div>
            <div id="comment-alert-error" class="alert alert-danger">
            	<span class="comment-alert-error-name"><?php _e('Please enter your name.', 'alterna'); ?></span>
                <span class="comment-alert-error-email"><?php _e('Please enter an valid email address.', 'alterna'); ?></span>
                <span class="comment-alert-error-message"><?php _e('Please enter a message.', 'alterna'); ?></span>
            </div>
            <div id="comment-submit">
                <button name="submit" type="submit" id="submit" class="btn btn-theme no-margin"><i class="fa fa-comment-o"></i><?php _e('Post Comment', 'alterna'); ?></button>
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', get_the_ID()); ?>
            </div>
    
            <?php endif; ?>
        </form>
    </div>
	<?php
	}
}
endif;

if ( ! function_exists( 'alterna_comment' ) ) :
/**
 * Get comments list
 *
 * @since alterna 7.0
 */
function alterna_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
		
	if ( 'div' == $args['style'] ) {
		//$tag = 'div';
		$add_below = 'comment';
	} else {
		//$tag = 'li';
		$add_below = 'div-comment';
	}
	?>
    
    <li id="comment-<?php comment_ID() ?>">
    	<article id="div-comment-<?php comment_ID() ?>" class="comment-item">
        	<div class="gravatar"><?php if ($args['avatar_size'] != 0) echo  get_avatar( $comment, $args['avatar_size']); ?></div>
        	
        	<div class="comment-content">
            	<div class="comment-meta"><span class="author-name"><?php echo comment_author_link($comment->comment_ID);?></span><span>&nbsp;&nbsp;</span><span class="comment-date"><?php echo get_comment_date(); ?> <?php _e('at', 'alterna'); ?> <?php echo get_comment_time(); ?></span></div>
            	<?php comment_text(); ?>
                <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				<?php if ($comment->comment_approved == '0') : ?>
                      <em class="comment-wait-approved"><?php _e('Your comment is awaiting approved.' , 'alterna') ?></em>
            	<?php endif; ?>
            
        	</div>
    	</article>
    <?php 
}
endif;

if ( ! function_exists( 'alterna_get_blog_widget_post' ) ) :		
/**
 * Get blog posts for sidebar widget
 *
 * @since alterna 7.0
 */
function alterna_get_blog_widget_post($type = "", $per_page = "", $orderby = "", $cat_in = "", $tag_in = "", $post__in = "", $post__not_in = "", $order = "") {
	
	if($per_page == ""){
		$per_page = 4;
	}
	
	$args = array('post_type' => 'post', 'post_status' => 'publish' , 'posts_per_page' => $per_page);
	
	if($orderby != ""){
		$args['orderby']  = $orderby;
	}
	
	if($order != ""){
		$args['order']  = $order;
	}
	
	switch($type){
		case 'featured':
				$post_ids = explode("," , $post__in);
				if(count($post_ids) == 0){
					return "";
				}
				$args['post__in']= $post_ids;
				$args['posts_per_page']= count($post_ids);
				break;
		case 'popular':
				$args['orderby']= 'comment_count';
				break;
		case 'related':
				$post_cats = explode("," , $cat_in);
				$post_tags = explode("," , $tag_in);
				
				if(count($post_cats) == 0 && count($post_tags) == 0){
					return "";
				}
				if(count($post_cats) > 0 && $post_cats[0] != ""){
					$args['category__in'] = $post_cats;
				}
				if(count($post_tags) > 0 && $post_tags[0] != ""){
					$args['tag__in'] = $post_tags;
				}
				break;
	}
	if($post__not_in != ""){
		$post__not_in = explode("," , $post__not_in);
		$args['post__not_in'] = $post__not_in;
	}

	$blog_posts = new WP_Query($args);
	
	return $blog_posts;
}
endif;

if ( ! function_exists( 'alterna_get_portfolio_widget_post' ) ) :		
/**
 * Get portfolio posts for sidebar widget
 *
 * @since alterna 7.0
 */
function alterna_get_portfolio_widget_post($type = "", $per_page = "", $orderby = "", $cat_in = "", $tag_in = "", $post__in = "", $post__not_in = "", $order = "") {
	if($per_page == ""){
		$per_page = 4;
	}
	
	$args=array( 'post_type' => 'portfolio', 'post_status' => 'publish', 'posts_per_page' => $per_page );
	
	if($orderby != ""){
		$args['orderby']  = $orderby;
	}
	
	if($order != ""){
		$args['order']  = $order;
	}
			 
	switch($type){
		case 'featured':
				$post_ids = explode("," , $post__in);
				if(count($post_ids) == 0){
					return "";
				}
				$args['post__in']= $post_ids;
				$args['posts_per_page']= count($post_ids);
			break;
		case 'related':
				$cat_slugs = explode("," , $cat_in);
				$tag_slugs = explode("," , $tag_in);
				if(count($cat_slugs) == 0 && count($tag_slugs) == 0){
					return "";
				}
				
				$args['tax_query'] = array();
				if(count($cat_slugs) > 0 && $cat_slugs[0] != ""){
					$args['tax_query'][] = array('taxonomy' => 'portfolio_categories', 'field' => 'slug', 'terms' => $cat_slugs);
				}
				
				if(count($tag_slugs) > 0  && $tag_slugs[0] != ""){
					$args['tax_query'][] = array('taxonomy' => 'portfolio-tags', 'field' => 'slug', 'terms' => $tag_slugs);
				}
			break;
	}
	
	if($post__not_in != ""){
		$post__not_in = explode("," , $post__not_in);
		$args['post__not_in'] = $post__not_in;
	}

	$portfolios = new WP_Query($args);
	
	return $portfolios;
}
endif;


if ( ! function_exists( 'alterna_get_blog_recent_post' ) ) :
/**
 * Get blog post for widget
 *
 * @since alterna 7.0
 */
function alterna_get_blog_recent_post($type, $num, $style = 1, $ids = '',$rand = ""){
	global $posts_recent_post_content;
	if($type == "recent"){
		if($rand == "yes"){
			$rand = "rand";
		}else{
			$rand = "";
		}
		$posts = alterna_get_blog_widget_post('recent',$num, $rand);
	}else if($type == "featured"){
		$posts = alterna_get_blog_widget_post('featured',$num, '','','',$ids);
	}else if($type == "popular"){
		$posts = alterna_get_blog_widget_post('popular',$num);
	}
	$output = "";
	if($posts != "" && $posts->have_posts()){
		$output .= '<ul class="widget-blog-recent mline">';
		while($posts->have_posts()) {
			$posts->the_post();
			$posts_recent_post_content = "";
			$output .= '<li>';
			get_template_part( 'template/blog/widget/content-style', esc_attr($style));
			$output .= $posts_recent_post_content;
			$output .= '</li>';
		}
		$output .= '</ul>';
	}
	wp_reset_postdata();
	return $output;
}
endif;

if ( ! function_exists( 'alterna_get_portfolio_recent_post' ) ) :
/**
 * Get portfolio post for widget
 *
 * @since alterna 7.0
 */
function alterna_get_portfolio_recent_post($type, $num, $style = 1, $ids = '',$rand = ""){
	global $portfolio_recent_post_content;
	if($type == "recent"){
		if($rand == "yes"){
			$rand = "rand";
		}else{
			$rand = "";
		}
		$portfolios = alterna_get_portfolio_widget_post('recent',$num, $rand);
	}else if($type == "featured"){
		$portfolios = alterna_get_portfolio_widget_post('featured',$num, '','','',$ids);
	}
	$output = "";
	if($portfolios != "" && $portfolios->have_posts()){
		$output .= '<ul class="widget-portfolio-recent mline">';
		while($portfolios->have_posts()) {
			$portfolios->the_post();
			$portfolio_recent_post_content = "";
			$output .= '<li>';
			get_template_part( 'template/portfolio/widget/content-style', esc_attr($style));
			$output .= $portfolio_recent_post_content;
			$output .= '</li>';
		}
		$output .= '</ul>';
	}
	wp_reset_postdata();
	return $output;
}
endif;

//========================================================
//  	COMMON METHODS
//========================================================

if ( ! function_exists( 'alterna_get_footer_widget_active_items' ) ) :
/**
 * Get footer widget items
 *
 * @since Alterna 7.0
 */
function alterna_get_footer_widget_active_items(){
	$widgets = array();
	$footer_widget_style = intval(penguin_get_options_key('footer-widget-style'));
	$count = 0;
	if (function_exists('dynamic_sidebar')){
		
		for($i = 1;$i<5;$i++){
			if(is_active_sidebar('sidebar-footer-'.$i)){
				//1-1-1
				if($footer_widget_style == 8){
					$widgets[] = array('col-md-4 col-sm-4','sidebar-footer-'.$i);
					$count++;
					if($count >= 3){
						break;
					}
					continue;
				}else if($footer_widget_style == 9 || $footer_widget_style == 10){
					if(($footer_widget_style == 9 && $count == 0) || ($footer_widget_style == 10 && $count == 1)){
						$widgets[] = array('col-md-4 col-sm-4','sidebar-footer-'.$i);
					}else{
						$widgets[] = array('col-md-8 col-sm-8','sidebar-footer-'.$i);
					}
					$count++;
					if($count >= 2){
						break;
					}
					continue;
				}
				
				// full width
				if($footer_widget_style == 7){
					$widgets[] = array('col-md-12 col-sm-12','sidebar-footer-'.$i);
					break;
				}
				
				//'1-1-1-1','1-2-1','2-1-1','1-1-2','2-2','1-3','3-1'
				if($footer_widget_style == 0 || ($footer_widget_style == 1 && $count != 1) || ($footer_widget_style == 2 && $count != 0) || ($footer_widget_style == 3 && $count != 2) || ($footer_widget_style == 5 && $count == 0) || ($footer_widget_style == 6 && $count == 1)){
					$widgets[] = array('col-md-3 col-sm-3','sidebar-footer-'.$i);
				}else if($footer_widget_style >0 && $footer_widget_style < 5){
					$widgets[] = array('col-md-6 col-sm-6','sidebar-footer-'.$i);
				}else {
					$widgets[] = array('col-md-9 col-sm-9','sidebar-footer-'.$i);
				}
				$count++;
				if(($footer_widget_style > 0 && $footer_widget_style < 4  && $count >= 3) || ($footer_widget_style > 4 && $count >= 2)){
					break;
				}
			}
		}
	}
	return $widgets;
}
endif;

if ( ! function_exists( 'alterna_add_background_style' ) ) :
/**
 * show background css
 *
 * @since alterna 8.0
 */
function alterna_add_background_style($key, $target, $type_key = 0, $retina = false, $options = ''){
	if(!$retina){
		if(intval(penguin_get_options_key($key.'-bg-type',$options,false,'',true)) == $type_key && intval(penguin_get_options_key($key.'-bg-pattern-width',$options,false,'',true)) != 0 && intval(penguin_get_options_key($key.'-bg-pattern-width',$options,false,'',true)) != 0 && penguin_get_options_key($key.'-bg-pattern-image',$options,false,'',true) != ""){
		?>
<?php echo $target; ?> {
	background-size:<?php echo penguin_get_options_key($key.'-bg-pattern-width',$options,false,'',true);?>px <?php echo penguin_get_options_key($key.'-bg-pattern-height',$options,false,'',true);?>px;
	background-repeat: repeat;
	background-image:url(<?php echo penguin_get_options_key($key.'-bg-pattern-image',$options,false,'',true);?>);
}
		<?php
		}else if(intval(penguin_get_options_key($key.'-bg-type',$options,false,'',true)) == ($type_key + 1) && penguin_get_options_key($key.'-bg-image',$options,false,'',true) != ""){
		?>
<?php echo $target; ?> { 
	background: url(<?php echo penguin_get_options_key($key.'-bg-image',$options,false,'',true); ?>) no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
		<?php
		}else if(intval(penguin_get_options_key($key.'-bg-type',$options,false,'',true)) == ($type_key + 2) && penguin_get_options_key($key.'-bg-color',$options,false,'',true) != ""){
		?>
<?php echo $target; ?>{
	background:#<?php echo penguin_get_options_key($key.'-bg-color',$options,false,'',true); ?>;
}
		<?php	
		}
		if(intval(penguin_get_options_key($key.'-bg-type',$options,false,'',true)) >= $type_key){
			//footer copyright area color
			if(($key == "global-footer" || $key == "page-footer") && penguin_get_options_key($key.'-bottom-bg-color',$options,false,'',true) != "" && penguin_get_options_key($key.'-bottom-border-color',$options,false,'',true) != "" && penguin_get_options_key($key.'-border-color',$options,false,'',true) != ""){
			?>
.footer-content {border-top: 6px #<?php echo penguin_get_options_key($key.'-border-color',$options,false,'',true); ?> solid;}
.footer-content .footer-bottom-content {border-top: 1px #<?php echo penguin_get_options_key($key.'-bottom-border-color',$options,false,'',true); ?> solid;background: #<?php echo penguin_get_options_key($key.'-bottom-bg-color',$options,false,'',true); ?>;}
			<?php
			}
		}
	}else if(intval(penguin_get_options_key($key.'-bg-type',$options,false,'',true)) == $type_key && penguin_get_options_key($key.'-bg-pattern-retina',$options,false,'',true) != ""){
	?>
<?php echo $target; ?> {
	background-image:url(<?php echo penguin_get_options_key($key.'-bg-pattern-retina',$options,false,'',true);?>);
}
    <?php
	}
}
endif;

if ( ! function_exists( 'alterna_get_styles' ) ) :
/**
 * Get theme style path
 */
function alterna_get_styles($type = 'theme'){
	$default_css;
	$uploads = wp_upload_dir();
	if($type == 'theme'){
		$default_css = get_template_directory_uri().'/css/alterna.css';
		if (file_exists($uploads['basedir'] . '/alterna/alterna-styles.css')) {
			$default_css = $uploads['baseurl'] . '/alterna/alterna-styles.css';
		}
	}else if($type == 'woocommerce'){
		$default_css = get_template_directory_uri().'/woocommerce/assets/css/woocommerce.css';
		if (file_exists($uploads['basedir'] . '/alterna/alterna-woocommerce.css')) {
			$default_css = $uploads['baseurl'] . '/alterna/alterna-woocommerce.css';
		}
	}
	return $default_css;
}
endif;
