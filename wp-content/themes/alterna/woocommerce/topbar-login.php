<?php
/**
 * The template for displaying header menu
 */
global $woocommerce;
?>
<li>
<?php
if ( is_user_logged_in() ) { 
?><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e( 'View your account', 'alterna' ); ?>"><?php 
	global $current_user;
	get_currentuserinfo();
	if($current_user->user_firstname){
		echo __('Welcome, ','alterna') . $current_user->user_firstname;
	}elseif($current_user->display_name){
		echo __('Welcome, ','alterna') . $current_user->display_name;
	}
?></a><span class="alterna-separat"><?php _e('|','alterna'); ?></span><a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php _e('Log out','alterna'); ?></a>
<?php 
}else { 
?><a class="wc-login-in" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e( 'Login', 'alterna' ); ?>"><?php _e( 'Login', 'alterna' ); ?></a><?php
}
?>
</li>