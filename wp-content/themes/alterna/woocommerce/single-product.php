<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); 

// get page layout
$layout = alterna_get_page_layout(); 
$layout_class = alterna_get_page_layout_class();

?>

<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>
    
<div class="content-wrap"> 
	<div id="main" class="container">
		<div class="row">
        <section class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">
	
		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	</section>
	<?php if($layout != 1) { ?>
        	<aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php
			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action('woocommerce_sidebar');
		?></aside>
    <?php } ?>
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

<?php get_footer('shop'); ?>