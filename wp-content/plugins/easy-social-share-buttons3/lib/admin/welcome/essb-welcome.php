<?php

$tabs = array ("essb-welcome" => "What's New", "essb-promote" => "Promote & Earn Money" );
$active_tab = isset ( $_REQUEST ['tab'] ) ? $_REQUEST ['tab'] : "essb-welcome";
$slug = "essb_about";

?>

<div class="wrap essb-page-welcome about-wrap">
	<h1><?php echo sprintf( __( 'Welcome to Easy Social Share Buttons for WordPress %s', ESSB3_TEXT_DOMAIN ), preg_replace( '/^(\d+)(\.\d+)?(\.\d)?/', '$1$2', ESSB3_VERSION ) ) ?></h1>

	<div class="about-text">
		<?php _e( 'Easy Social Share Buttons for WordPress is all-in-one social share solution that allows you share, monitor and increase your social popularity by AppsCreo', ESSB3_TEXT_DOMAIN )?>
	</div>
	<div class="wp-badge essb-page-logo">
		<?php echo sprintf( __( 'Version %s', ESSB3_TEXT_DOMAIN ), ESSB3_VERSION )?>
	</div>
	<div class="essb-page-actions">


		<div class="essb-welcome-button-container">
			<a
				href="<?php echo esc_attr( admin_url( 'admin.php?page=essb_options' ) ) ?>"
				class="button button-primary"><?php _e( 'Settings', ESSB3_TEXT_DOMAIN ) ?></a>
			<a href="http://codecanyon.net/downloads" target="_blank" class="button">Rate <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> Easy Social Share Buttons for WordPress</a>
		</div>
		<div class="essb-welcome-button-container">
			<a href="https://twitter.com/share" class="twitter-share-button"
				data-text="Take full control over social sharing in WordPress with Easy Social Share Buttons by @appscreo"
				data-url="http://bit.ly/socialsharewp" data-size="large"
				data-counturl="http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476">Tweet</a>
			<script>! function ( d, s, id ) {
				var js, fjs = d.getElementsByTagName( s )[ 0 ], p = /^http:/.test( d.location ) ? 'http' : 'https';
				if ( ! d.getElementById( id ) ) {
					js = d.createElement( s );
					js.id = id;
					js.src = p + '://platform.twitter.com/widgets.js';
					fjs.parentNode.insertBefore( js, fjs );
				}
			}( document, 'script', 'twitter-wjs' );</script>
		</div>
		<div
			class="essb-welcome-button-container essb-welcome-button-container-google">

			<!-- Place this tag where you want the +1 button to render. -->
			<div class="g-plusone"
				data-href="http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476"></div>
		</div>
	</div>

	<!-- tabs -->
	<h2 class="nav-tab-wrapper">
	<?php foreach ( $tabs as $tab_slug => $title ): ?>
		<?php $url = 'admin.php?page=' . rawurlencode( $slug ) . '&tab=' . rawurlencode( $tab_slug ); ?>
		<a
			href="<?php echo esc_attr( is_network_admin() ? network_admin_url( $url ) : admin_url( $url ) ) ?>"
			class="nav-tab<?php echo $active_tab === $tab_slug ? esc_attr( ' nav-tab-active' ) : '' ?>">
			<?php echo $title?>
		</a>
	<?php endforeach; ?>
	</h2>

	<?php
	if ($active_tab == "essb-welcome") {
		?>
	<!-- welcome content -->
	<div class="essb_welcome-tab changelog">
		<div class="feature-section col">
			<div>
				<img class="essb-featured-img"
					src="<?php echo ESSB3_PLUGIN_URL ?>/assets/images/welcome/focus-screenshot.png" />

				<h3>Focus on Design, Speed and User Attraction</h3>

				<p>Latest version of Easy Social Share Buttons for WordPress 3.0
					focuses on visual part of your social share - we add new hand
					crafted templates, new automated display positions and mobile
					optimized display methods. Easy Social Share Buttons for WordPress
					3.0 is made from the ground up to be faster, ligher and smoother.</p>
			</div>
		</div>

		<div class="essb_welcome-feature feature-section col three-col">
			<div>
				<img class="essb-img-center" title=""
					src="<?php echo ESSB3_PLUGIN_URL ?>/assets/images/welcome/welcome-features-01.png" />
				<h4>Big Social Networks Update</h4>

				<p>In Easy Social Share Buttons for WordPress 3.0 we add the biggest
					social network update with 15 new social networks including:
					Evernote, Flipboard, Yummly, HackerNews, Blogger and etc.</p>
			</div>
			<div>
				<img class="essb-img-center" title=""
					src="<?php echo ESSB3_PLUGIN_URL ?>/assets/images/welcome/welcome-features-02.png" />
				<h4>Focus on Design</h4>

				<p>In the new version we include 3 new templates: Dimmed (Retina),
					Grey (Retina) and Default 3 (Retina). We improve the work of
					existing templates and display effects for smooth and fast work.</p>
			</div>
			<div class="last-feature">
				<img class="essb-img-center" title=""
					src="<?php echo ESSB3_PLUGIN_URL ?>/assets/images/welcome/welcome-features-03.png" />
				<h4>Special Mobile Display Methods</h4>

				<p>With the new version you get access to 3 new mobile optimized
					display methods: Buttons bar, Share bar and Share button.</p>
			</div>
		</div>

		<div class="essb_welcome-feature feature-section col three-col">
			<div>
				<img class="essb-img-center" title=""
					src="<?php echo ESSB3_PLUGIN_URL ?>/assets/images/welcome/welcome-features-04.png" />
				<h4>Social Media Share</h4>

				<p>A brand new Social Media Share module with extended network
					support and design. The new Social Media Share module allows you to
					share the selected image to social networks.</p>
			</div>
			<div>
				<img class="essb-img-center" title=""
					src="<?php echo ESSB3_PLUGIN_URL ?>/assets/images/welcome/welcome-features-05.png" />
				<h4>Social Profiles</h4>

				<p>We add the long waited module social profiles that allows you
					easy to link to your social network profiles.</p>
			</div>
			<div class="last-feature">
				<img class="essb-img-center" title=""
					src="<?php echo ESSB3_PLUGIN_URL ?>/assets/images/welcome/welcome-features-06.png" />
				<h4>Top & Bottom bar</h4>

				<p>Encourage users to share your site with the brand new top and
					bottom bar display methods.</p>
			</div>
		</div>
		<p class="essb-thank-you">
			Thank you for choosing <b>Easy Social Share Buttons for WordPress</b>.
			If you like our work please <a href="http://codecanyon.net/downloads"
				target="_blank">rate Easy Social Share Buttons for WordPress <i
				class="fa fa-star"></i><i class="fa fa-star"></i><i
				class="fa fa-star"></i><i class="fa fa-star"></i><i
				class="fa fa-star"></i></a>
		</p>

	</div>
	<?php
	}
	
	if ($active_tab == "essb-promote") {
		?>
	<div class="essb-page-promote changelog">
		<div class="feature-section col">
			<div>
				<h4>
					Promote <b>Easy Social Share Buttons for WordPress</b> and earn
					money from the Envato Affiliate Program.
				</h4>
				Send traffic to any page on Envato Market while adding your account
				username to the end of the URL. When a new user clicks your referral
				link, signs up for an account and purchases an item (or deposits
				money) via any of the Envato Market sites, you will receive 30% of
				that person's first cash deposit or purchase price. If they deposit
				$20 into their account, you get $6. If they buy a $200 item, you get
				$60.
				<p>
				<a href="http://themeforest.net/make_money/affiliate_program" target="_blank">Read more about how Envato affiliate program works on its official site.</a>
				</p>
			</div>
			<p>&nbsp;</p>
			<p>
				Your Envato Username: <input type="text" class="input-element"
					name="envato-user" id="envato-user" /><a href="#"
					class="button button-primary" id="generate-my-code">Get my code</a>
			</p>

			<p id="usercode" style="display: none;">
			Example affilaite links that you can use:<br/>
				<textarea id="user-generated-code" class="input-element"
					style="width: 100%; height: 300px"></textarea>
			</p>
		</div>
	</div>
	<script type="text/javascript">

	jQuery(document).ready(function($){
		$('#generate-my-code').click(function(e) {
			e.preventDefault();

			var envatoUsername = $('#envato-user').val();

			var myCode = "";
			myCode += "<!-- Example code 1 -->\r\n";
			myCode += '<a href="http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref='+envatoUsername+'" target="_blank" title="Easy Social Share Buttons for WordPress - Social sharing plugin that will amplify your social reach">Easy Social Share Buttons for WordPress - Social sharing plugin that will amplify your social reach</a>';
			myCode += "\r\n\r\n";

			myCode += "<!-- Example code 2 -->\r\n";
			myCode += '<a href="http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref='+envatoUsername+'" target="_blank" title="Easy Social Share Buttons for WordPress">Easy Social Share Buttons for WordPress</a>';
			myCode += "\r\n\r\n";

			myCode += "<!-- Example code 3 -->\r\n";
			myCode += '<a href="http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref='+envatoUsername+'" target="_blank" title="Easy Social Share Buttons for WordPress">This site uses Easy Social Share Buttons for WordPress</a>';
			myCode += "\r\n\r\n";
			
			myCode += "<!-- Example code 4 -->\r\n";
			myCode += '<a href="http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref='+envatoUsername+'" target="_blank" title="Social Sharing Plugin for WordPress">Social Sharing Plugin for WordPress that will help increase your social presentation</a>';
			myCode += "\r\n\r\n";
			
			
			$('#user-generated-code').val(myCode);
			
			$('#usercode').show();
		});
	});

	</script>
	<?php
	}
	?>
</div>

<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

