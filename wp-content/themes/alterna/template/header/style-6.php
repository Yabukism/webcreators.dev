<?php
/**
 * Header Style 6
 * 
 * @since alterna 6.0
 */
?>
<header class="header-style-6">
	<div id="alterna-header" class="<?php echo penguin_get_options_key('fixed-enable') == "on" ? "header-fixed-enabled" : "";?>">
		<div class="container">
			<div class="logo">
			    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php 
						    if(penguin_get_options_key('logo-txt-enable')  == "on"){
							    echo '<h2>'.get_bloginfo( 'name' ).'</h2>';
						    }else{
						    ?>
							    <img class="logo-default" src="<?php echo esc_url( penguin_get_options_key('logo-image') ); ?>" width="<?php echo penguin_get_options_key('logo-image-width'); ?>" height="<?php echo penguin_get_options_key('logo-image-height'); ?>" alt="logo">
							    <?php if(penguin_get_options_key('logo-retina-image') != ""){?>
				    <img class="logo-retina" src="<?php echo esc_url( penguin_get_options_key('logo-retina-image')); ?>" width="<?php echo penguin_get_options_key('logo-image-width'); ?>" height="<?php echo penguin_get_options_key('logo-image-height'); ?>" alt="logo">
				    <?php } ?>
				<?php
						    }?></a>
			</div>
            
			<div class="menu">
				<nav >
					<?php 
					    $alterna_main_menu = array(
						'theme_location'  	=> 'alterna_menu',
						'container_class'	=> 'alterna-nav-menu-container',
						'menu_class'    	=> 'alterna-nav-menu',
						'fallback_cb'	  	=> 'alterna_show_setting_primary_menu'
					    ); 
					    wp_nav_menu($alterna_main_menu);
					?>
				</nav>
			</div>
				    
			
			<div class="right-content">
				<?php
				if(penguin_get_options_key('header-style-6-login-btn') == "on"){
					if ( !is_user_logged_in() ) { ?>
						<a class="login-btn btn btn-theme no-margin" href="<?php echo esc_url( penguin_add_param_for_link(penguin_get_options_key('topbar-login-page'),'action=register') ); ?>" target="_self">Sign Up</a>
						<a class="login-btn-custom" href="<?php echo penguin_get_options_key('topbar-login-page'); ?>" target="_self">Log In</a>
				<?php }else{ ?>
                    <a class="login-btn-custom" href="<?php echo esc_url(wp_logout_url(penguin_add_param_for_link(get_permalink(),'action=login'))); ?>" target="_self">Log Out</a>
                <?php } 
				}
				?>
				
				<?php if(penguin_get_options_key('header-search-enable') == "on") { ?>
				<div class="alterna-nav-form-container">
				    <div class="alterna-nav-form-icon"><i class="fa fa-search"></i></div>
				    <div class="alterna-nav-form-content">
					<form role="search" class="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					    <?php if (class_exists( 'woocommerce' ) && penguin_get_options_key('shop-product-search') == "on") { ?>
						<input class="sf-type" name="post_type" type="hidden" value="product" />
					    <?php } ?>
					    <input class="sf-s" name="s" type="text" placeholder="<?php _e('Search','alterna'); ?>" />
					    <input class="sf-searchsubmit" type="submit" value="" />
					</form>
				    </div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>

    <?php get_template_part( 'template/header/menu/mobile' );?>
</header>