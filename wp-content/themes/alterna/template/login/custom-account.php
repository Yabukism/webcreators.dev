<?php
/**
 * Login Template > account
 *
 * @since alterna 7.0
 */
 
global $user_ID, $user_identity, $userdata; get_currentuserinfo();
 
?>
<div class="login-account-posts col-md-9 col-sm-9">
	<h3><?php echo __('Welcome, ','alterna').$user_identity; ?></h3>
    <div class="login-description">
    	<?php echo $userdata->description; ?>
    </div>
    <div class="alterna-title">
        <h3 class="post-title"><?php _e('Yours Posts', 'alterna'); ?></h3>
        <div class="line"></div>
    </div>
    <div class="login-posts">
    <?php
	//The Query
	query_posts('author='.$userdata->ID);
	
	//The Loop
	if ( have_posts() ) {	
		while ( have_posts() ) {
			the_post();
			echo '<h4 class="entry-title"> <a href="' . esc_url( get_permalink() ) . '" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h4>'; 
		}
	}else{
		_e("You has not contributed anything!",'alterna');
	}
	
	//Reset Query
	wp_reset_query();
	?>
    </div>
</div>
<div class="login-account-information col-md-3 col-sm-3">
    <div class="usericon">
    <?php echo get_avatar($userdata->ID, 80); ?>
    </div>
    <div class="userinfo">
        <p>
            <a class="btn btn-theme" href="<?php echo esc_url(wp_logout_url(penguin_add_param_for_link(get_permalink(),'action=login'))); ?>"><?php _e('Log out','alterna'); ?></a> 
            <?php if (current_user_can('manage_options')) { 
                echo '<a class="btn btn-theme" href="' . admin_url() . '">' . __('Admin','alterna') . '</a>'; } else { 
                echo '<a class="btn btn-theme" href="' . admin_url() . 'profile.php">' . __('Profile','alterna') . '</a>'; } ?>
    
        </p>
    </div>
</div>