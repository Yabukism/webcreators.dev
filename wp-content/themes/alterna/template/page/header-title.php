<?php
/**
 * Page Header Title & Breadcrumbs
 * 
 * @since alterna 7.0
 */
 
global $post_id, $current_tax;

if ( ( ( (is_home() && !is_front_page()) || is_page() || is_single()) && alterna_get_current_bool_value(penguin_get_post_meta_key('title-show', $post_id))) || (is_home() && is_front_page()) ) { 
?>
    <div id="page-header">
        <div class="top-shadow"></div>
        <div class="container">
            <div class="page-header-content">
            	<?php
					$title	= penguin_get_post_meta_key('title-content', $post_id);
					$desc	= penguin_get_post_meta_key('title-desc', $post_id);
					$breadcrumb = penguin_get_post_meta_key('title-breadcrumb', $post_id);
					
					if($title == ''){
						echo '<h1 class="title">'.get_the_title($post_id).'</h1>';
					}else{
						echo $title;
					}
					if($desc != ''){
						echo '<div class="page-desc">'.$desc.'</div>';
					}
				?>
            </div>
        </div>
    </div>
    
    <?php if(alterna_get_current_bool_value($breadcrumb)){ ?>
    <div id="page-breadcrumb">
        <div class="container">
            <?php if ( penguin_get_options_key('global-breakcrumbs-enable') == 'on' &&  function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p class="yoast_breadcrumbs">','</p>');
            }else{ ?>
            <ul><?php echo alterna_page_links(); ?></ul>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
<?php
} elseif ( (is_tax() && taxonomy_exists('portfolio_categories') && $current_tax == "portfolio_categories") || is_category() || is_tag() || is_404() || is_search() || is_date() || is_author()) {
?>
	<div id="page-header">
    	<div class="top-shadow"></div>
        <div  class="container">
        	<div class="page-header-content">
                <h1 class="title"><?php echo alterna_page_title();?></h1>
            </div>
		</div>
	</div>
	<div id="page-breadcrumb">
    	<div class="container">
             <?php if ( penguin_get_options_key('global-breakcrumbs-enable') == 'on' &&  function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p class="yoast_breadcrumbs">','</p>');
			}else{ ?>
            <ul>
            <?php echo alterna_page_links(); ?>
            <?php if(is_search()) { ?>
                <li><i class="fa fa-chevron-right"></i><span><?php printf( __( 'Search Results for "%s"', 'alterna' ), get_search_query() ); ?></span></li>
            <?php } ?>
            </ul>
            <?php } ?>
		</div>
	</div>
<?php } ?>