<?php
/**
 * Login Template > lost password form
 *
 * @since alterna 7.0
 */
?>
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
	<header>
        <h1 class="login-title"><?php _e('Reset Your Password','alterna'); ?></h1>
   	</header>
    <div class="login-form-wrap">
        <form class="login-form-wrap" name="loginform" id="loginform" action="<?php echo home_url(); ?>/wp-login.php?action=lostpassword" method="post">
            <div class="alterna-login-form-element">
                <label class="control-label" for="user_login"><?php _e('Username or Email','alterna'); ?></label>
                <input type="text" name="user_login" id="user_login" class="input" value="" size="20" tabindex="10" />
            </div>
            <div class="alterna-login-form-element">
                <p class="submit">
                    <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-theme" value="<?php _e('Reset my password','alterna'); ?> " tabindex="100" />
                    <input type="hidden" name="redirect_to" value="<?php echo esc_url( penguin_add_param_for_link(get_permalink(),'action=login&amp;register=true') ); ?>" />
                    <input type="hidden" name="user-cookie" value="1" />
                </p>
            </div>
        </form>
    </div>
</div>