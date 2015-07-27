<?php
/**
 * Template Name: Login / Register Template
 *
 * @since alterna 7.0
 */
global $user_ID, $user_identity; get_currentuserinfo();
$action = isset($_GET['action']) ? $_GET['action'] : "";

get_header();

?>
<div id="main" class="container">
    <div class="row">
        <section class="col-md-12 col-sm-12">
            <div class="row">
            <?php 
				if(!$user_ID) { 
					if($action == "lostpassword"){
						get_template_part( 'template/login/custom', 'lostpass');
					}else if($action == "register"){
						get_template_part( 'template/login/custom', 'register');
					}else {
						get_template_part( 'template/login/custom', 'login');
					}
				}else{
					get_template_part( 'template/login/custom', 'account');
				}
			?>
            </div>
        </section>
    </div>
</div>
<?php get_footer(); ?>