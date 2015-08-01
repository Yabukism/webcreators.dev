<?php
/**
 * Mobile Menu
 * 
 * @since alterna 9.0
 */
?>
<nav id="alterna-drop-nav" class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#alterna-mobile-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="alterna-mobile-navbar-collapse">
	<?php
	    $alterna_mobile_menu = array(
		'theme_location'  	=> 'alterna_menu',
		'container'		=> 'false',
		'menu_class'    	=> 'nav navbar-nav'
	    ); 
	    wp_nav_menu($alterna_mobile_menu);
	?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  
      <?php if(penguin_get_options_key('header-search-enable') == "on") : ?>
    <div class="alterna-nav-form-container container">
	<div class="alterna-nav-form">
	    <form role="search" class="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	       <div>
		    <?php if (class_exists( 'woocommerce' ) && penguin_get_options_key('shop-product-search') == "on") { ?>
			<input class="sf-type" name="post_type" type="hidden" value="product" />
		    <?php } ?>
		    <input class="sf-s" name="s" type="text" placeholder="<?php _e('Search','alterna'); ?>" />
		    <input class="sf-searchsubmit" type="submit" value="" />
	       </div>
	    </form>
	</div>
    </div>
    <?php endif; ?>
</nav>