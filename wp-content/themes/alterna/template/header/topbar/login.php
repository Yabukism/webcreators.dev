<?php
/**
 * Header Topbar Login
 * 
 * @since alterna 8.0
 */
?>
<li>
<?php
if ( is_user_logged_in() ) { ?>
<a href="<?php echo penguin_get_options_key('topbar-login-page'); ?>" title="<?php _e( 'View your account', 'alterna' ); ?>"><?php
    global $current_user;
    get_currentuserinfo();
    if($current_user->user_firstname){
        echo __('Welcome, ','alterna') . $current_user->user_firstname;
    }elseif($current_user->display_name){
        echo __('Welcome, ','alterna') . $current_user->display_name;
    }
    ?></a>&nbsp;&nbsp;<?php _e('|','alterna'); ?>&nbsp;&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php _e('Log out','alterna'); ?></a>
<?php }else{ ?>
<a class="wc-login-in" href="<?php echo penguin_get_options_key('topbar-login-page'); ?>" title="<?php _e( 'Login / Register', 'alterna' ); ?>"><?php _e( 'Login / Register', 'alterna' ); ?></a>
<?php } ?>
</li>