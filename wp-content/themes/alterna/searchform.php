<?php
/**
 * The template for displaying search forms in alterna
 *
 * @since alterna 7.0
 */
?>

<form role="search" class="sidebar-searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
   <div>
       <input id="sidebar-s" name="s" type="text" placeholder="<?php _e('Search','alterna'); ?>" />
       <input id="sidebar-searchsubmit" type="submit" value="" />
   </div>
</form>