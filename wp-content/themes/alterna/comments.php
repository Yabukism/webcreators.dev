<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to alterna_comment() which is
 * located in the inc/alterna-functions.php file.
 *
 * @since alterna 7.0
 */
if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' )  && penguin_get_options_key('blog-comment-hide') == 'on'){
	return;
}
?>
<div id="comments">
	<div class="alterna-title">
    	<h3><?php comments_number(__('No Comment','alterna'), __('One Response Comment','alterna'),__('% Response Comments','alterna')); ?></h3>
        <div class="line"></div>
	</div>
        
	<?php if ( have_comments() ) : ?>
    <ul class="comment-list">
        <?php
            /* Loop through and list the comments. Tell wp_list_comments()
             * to use twentyeleven_comment() to format the comments.
             * If you want to overload this in a child theme then you can
             * define alterna_comment() and that will be used instead.
             * See alterna_comment() in alterna/functions.php for more.
             */
            wp_list_comments('type=comment&avatar_size=40&callback=alterna_comment'); 
        ?>
    </ul>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comment-nav-above">
        <div class="next-post"><?php next_comments_link( __( 'Newer Comments &rarr;', 'alterna' ) ); ?></div>
        <div class="pre-post"><?php previous_comments_link( __( '&larr; Older Comments', 'alterna' ) ); ?></div>
    </nav>
    <?php endif; // check for comment navigation ?>
    <?php
    /* If there are no comments and comments are closed, let's leave a little note, shall we?
     * But we don't want the note on pages or post types that do not support comments.
     */
    elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
    <p class="nocomments"><?php _e( 'Comments are closed.', 'alterna' ); ?></p>
    <?php else : ?>
    <div class="comments-first">
        <p><?php _e( 'You can post first response comment.', 'alterna' ); ?></p>
    </div><!-- .entry-content -->
    <?php endif; ?>
    
    <?php alterna_comment_form();?>
</div>
