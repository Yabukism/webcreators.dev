<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @since alterna 7.0
 */
get_header();
?>
<div id="main" class="container">
	<div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <div class="error-404">
            	<span class="error-icon"><i class="fa fa-exclamation-triangle"></i></span>
                <h1 class="entry-title"><?php _e( '404 - Page not found', 'alterna' ); ?></h1>
                <h5><?php _e( "OOPS!Looks like the page you are looking for isn't there.You may have mistyped the address or the page may have moved.", 'alterna' ); ?></h5>
                <div class="widget_search"><?php get_search_form(); ?></div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>