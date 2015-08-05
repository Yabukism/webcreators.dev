<?php
/**
 * alterna functions and definitions
 *
 * @since alterna 7.0
 */
 
/**
 * All alterna common functions.
 * Don't remove it.
 *
 * @since alterna 1.0
 */
require_once("inc/alterna-functions.php");

/**
 * Get all alterna options value
 */
global $alterna_options;
$alterna_options = get_option("alterna_options");

/**
 * Sets up theme custom options, post, update notifier.
 * Don't remove it.
 *
 * @since alterna 8.0
 */
require_once("inc/penguin-init.php");
if (class_exists( 'woocommerce' )) {
	require_once('woocommerce/woocommerce-config.php');
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 788;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since alterna 1.0
 */
function alterna_setup() {

	// Load the Themes' Translations through domain
	load_theme_textdomain( 'alterna', get_template_directory() . '/languages' );
	
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'alterna_menu', __( 'Alterna Main Menus', 'alterna' ) );
	register_nav_menu( 'alterna_topbar_menu', __( 'Alterna Topbar Menus', 'alterna' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'image', 'quote' ) );
	
	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
	
	// Add woocommerce support
	add_theme_support( 'woocommerce' );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( 788, 445, true );
	
	add_image_size( 'alterna-l-thumbs' , 750 , 423 , true);
	add_image_size( 'alterna-m-thumbs' , 555 , 313 , true);
	add_image_size( 'alterna-s-thumbs' , 450 , 254 , true);
	add_image_size( 'alterna-square-thumbs' , 750 , 750 , true);
	add_image_size( 'alterna-nocrop-thumbs' , 750 , 1500 , false);
	
}
add_action( 'after_setup_theme', 'alterna_setup' );

/**
 * Sets up theme defaults styles and scripts.
 *
 * @since alterna 1.0
 */
function alterna_init_styles_scripts() {
	global $google_load_fonts,$alterna_options, $deviceType , $alterna_show_mode;
	
	//get template directory url
	$dir = get_template_directory_uri();
	
	//get theme version
	$theme_data = wp_get_theme();
	if($theme_data->Template != ''){
		$theme_data = wp_get_theme($theme_data->Template);
	}
	$ver = $theme_data['Version'];
	
	//Stylesheets
	/* bootstrap & fontawesome css files */
	if(penguin_get_options_key('bootstrap-fontawesome-cdn') == "on"){
		wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' , array() , $ver );
		wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' , array() , $ver );
	}else{
		wp_enqueue_style( 'bootstrap', $dir . '/bootstrap/css/bootstrap.min.css' , array() , $ver );
		wp_enqueue_style( 'fontawesome', $dir . '/fontawesome/css/font-awesome.min.css' , array() , $ver );	
	}
	
	wp_enqueue_style( 'animate', $dir . '/css/animate.min.css' , array() , $ver );
	
	wp_enqueue_style( 'flexslider_style', $dir . '/js/flexslider/flexslider.css' , array() , $ver );
	wp_enqueue_style( 'fancyBox_style', $dir . '/js/fancyBox/jquery.fancybox.css' , array() , $ver );
	wp_enqueue_style( 'fancyBox_helper_style', $dir . '/js/fancyBox/helpers/jquery.fancybox-thumbs.css' , array() , $ver );
	
	//Theme Style
	$alterna_options_update = get_option('alterna_options_update');
	$style_ver = isset($alterna_options_update['version']) ? $alterna_options_update['version'] : $ver;
	
	wp_enqueue_style( 'alterna_style', alterna_get_styles()  , array() , $style_ver );
	if (class_exists( 'woocommerce' )) { 
		wp_enqueue_style( 'woocommerce', alterna_get_styles('woocommerce')  , array() , $style_ver );
	}
	
	wp_enqueue_style( 'style', get_stylesheet_uri()  , array() , $ver );
	
	//Font
	alterna_get_custom_font();
	if($google_load_fonts != null && $google_load_fonts != ""){
		$subsets = penguin_get_options_key('google-font-subset') != "" ? '&amp;subset='.penguin_get_options_key('google-font-subset') : "";
		wp_enqueue_style( 'custom-theme-font', '//fonts.googleapis.com/css?family='.$google_load_fonts.$subsets);
	}
	
	//Javascripts
	wp_enqueue_script('jquery');
	if ( is_singular() && comments_open() ) { wp_enqueue_script( 'comment-reply' );	}
	if(penguin_get_options_key('bootstrap-fontawesome-cdn') == "on"){
		wp_enqueue_script( 'bootstrap' , '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js' , array('jquery') , $ver , true);
	}else{
		wp_enqueue_script( 'bootstrap' , $dir . '/bootstrap/js/bootstrap.min.js' , array('jquery') , $ver , true);
	}
	wp_enqueue_script( 'isotope' , $dir . '/js/isotope.pkgd.min.js' , array('jquery') , $ver , true);
	wp_enqueue_script( 'fancyBox_mousewheel' , $dir . '/js/fancyBox/jquery.mousewheel-3.0.6.pack.js' , array('jquery') , $ver , true);
	wp_enqueue_script( 'fancyBox_js' , $dir . '/js/fancyBox/jquery.fancybox.pack.js' , array('jquery') , $ver , true);
	wp_enqueue_script( 'fancyBox_helpers_js' , $dir . '/js/fancyBox/helpers/jquery.fancybox-thumbs.js' , array('jquery') , $ver , true);
	wp_enqueue_script( 'flexslider_js' , $dir . '/js/flexslider/jquery.flexslider-min.js' , array('jquery') , $ver , true);
	wp_enqueue_script( 'csstransforms3d' , $dir . '/js/csstransforms3d.js' , array('jquery') , $ver , true);
	wp_enqueue_script( 'alterna' , $dir . '/js/jquery.theme.js' , array('jquery') , $ver , true);
}
add_action('wp_enqueue_scripts', 'alterna_init_styles_scripts');

/**
 * Sets up title old v4.1
 *
 * @since alterna 9.3
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function alterna_theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'alterna_theme_slug_render_title' );
}

/**
 * Sets up custom theme styles
 *
 * @since alterna 1.0
 */
function alterna_custom_styles(){
	global $alterna_options, $alterna_page_custom_scripts;

	alterna_get_page_custom_options_css();
	
	if(penguin_get_options_key('custom-enable-css') == "on" && penguin_get_options_key('custom-css-content') != ""){
		?>
        <style id="alterna-custom-css" type="text/css">
			<?php echo $alterna_options['custom-css-content']; ?>
			
			@media only screen and (-Webkit-min-device-pixel-ratio: 1.5),
			only screen and (-moz-min-device-pixel-ratio: 1.5),
			only screen and (-o-min-device-pixel-ratio: 3/2),
			only screen and (min-device-pixel-ratio: 1.5) {
			<?php echo $alterna_options['custom-css-retina-content']; ?>
			}
			
		</style>
        <?php 
	}
	
	// get page custom scripts
	$alterna_page_custom_scripts = alterna_get_page_custom_options_scripts();
	
	echo (intval(penguin_get_options_key('google_analytics-position')) == 0) ? penguin_get_options_key('google_analytics-text') : "";
	
}
add_action( 'wp_head', 'alterna_custom_styles' );

/**
 * Sets up footer custom theme styles
 *
 * @since alterna 1.0
 */
function alterna_wp_footer_scripts(){
	global $alterna_options, $alterna_page_custom_scripts, $alterna_map_id;
	//get template directory url
	$dir = get_template_directory_uri();
	
	if(isset($alterna_map_id) && $alterna_map_id > 0){
		/* google map */
		wp_enqueue_script( 'googleapis', '//maps.googleapis.com/maps/api/js?v=3&amp;sensor=false');
		wp_enqueue_script( 'map-infobox', $dir . '/js/infobox.js');
	}
	
	if((penguin_get_options_key('custom-enable-scripts') == "on" && penguin_get_options_key('custom-scripts-content') != "") || (isset($alterna_page_custom_scripts) && $alterna_page_custom_scripts != '')){
		?>
        <script type="text/javascript">
			<?php 
				if(penguin_get_options_key('custom-enable-scripts') == "on" && penguin_get_options_key('custom-scripts-content') != ""){
					echo $alterna_options['custom-scripts-content']; 
				}
				
				if(isset($alterna_page_custom_scripts) && $alterna_page_custom_scripts != ''){
					echo $alterna_page_custom_scripts;
				}
			?>
		</script>
        <?php 
	}
	
	echo (intval(penguin_get_options_key('google_analytics-position')) == 1) ? penguin_get_options_key('google_analytics-text') : "";
}
add_action( 'wp_footer', 'alterna_wp_footer_scripts' );

/**
 * Add shortcode
 *
 * @since alterna 7.0
 */
 
// Use shortcodes in text widgets.
add_filter('widget_text', 'do_shortcode');
include("inc/shortcodes.php");

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since alterna 7.0
 */
function alterna_widgets_init() {
	
	register_sidebar( array(
		'id' => 'sidebar-1',
		'name' => __( 'Global Sidebar', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="line"></div><div class="clear"></div>'
	));
	
	register_sidebar( array(
		'id'	=>'sidebar-footer-1',
		'name' => __( 'Footer 1', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));
	
	register_sidebar( array(
		'id'	=>'sidebar-footer-2',
		'name' => __( 'Footer 2', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));
	
	register_sidebar( array(
		'id'	=>'sidebar-footer-3',
		'name' => __( 'Footer 3', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));
	
	register_sidebar( array(
		'id'	=>'sidebar-footer-4',
		'name' => __( 'Footer 4', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));
	
	register_sidebar( array(
		'id'	=>'shop',
		'name' => __( 'Woocommerce Shop', 'alterna' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
	));

}
add_action( 'widgets_init', 'alterna_widgets_init' );
include_once("inc/custom-widgets.php");

/**
 * Redesign login page
 */
function alterna_login_logo() { 
	global $alterna_options;
?>
    <style type="text/css">
        body.login div#login h1 a {
			width:<?php echo penguin_get_options_key('logo-image-width'); ?>px;
			height:<?php echo penguin_get_options_key('logo-image-height'); ?>px;
			background-image:url(<?php echo penguin_get_options_key('logo-image') == "" ?  get_template_directory_uri()."/img/logo.png" : penguin_get_options_key('logo-image'); ?>);
    		background-size: <?php echo penguin_get_options_key('logo-image-width'); ?>px <?php echo penguin_get_options_key('logo-image-height'); ?>px;
        }
		@media only screen and (-Webkit-min-device-pixel-ratio: 1.5),
		only screen and (-moz-min-device-pixel-ratio: 1.5),
		only screen and (-o-min-device-pixel-ratio: 3/2),
		only screen and (min-device-pixel-ratio: 1.5) {
			body.login div#login h1 a {
				background-image: url(<?php echo penguin_get_options_key('logo-retina-image') == "" ?  get_template_directory_uri()."/img/logo@2x.png" : penguin_get_options_key('logo-retina-image'); ?>);
			}
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'alterna_login_logo' );

function alterna_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'alterna_login_logo_url' );

function alterna_login_logo_url_title() {
    return get_bloginfo('title');
}
add_filter( 'login_headertitle', 'alterna_login_logo_url_title' );

?>