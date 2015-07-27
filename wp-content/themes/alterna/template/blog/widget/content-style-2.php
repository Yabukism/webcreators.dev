<?php
/**
 * Blog Widget Recent Style 2
 *
 * @since alterna 7.0
 */
global $posts_recent_post_content;
$output = '';

$thumbnail_size = 'thumbnail';

$output .= '<div class="sidebar-blog-recent thumbs-style">';

if(has_post_thumbnail(get_the_ID())) { 
$output .= '<aside class="post-thumbs"><a href="'.esc_url(get_permalink()).'"><div class="post-img">
				'.get_the_post_thumbnail(get_the_ID(), $thumbnail_size , array('alt' => get_the_title(),'title' => '')).'
			</div></a></aside>';
}
$output .= '<div class="post-content">
					<h5 class="entry-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h5>
					<div class="entry-meta">
						<span class="entry-date"><a href="'.esc_url( get_permalink() ).'"><i class="fa fa-clock-o"></i>'.esc_html( get_the_date() ).'</a></span>
						 <span class="author vcard"><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'"><i class="fa fa-user"></i>'.get_the_author().'</a></span>';
						 
if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
	$num_comments = get_comments_number(get_the_ID());
	$output .= '<span class="comments-link"><a href="'.esc_url(get_permalink()).'#comments"><i class="fa fa-comments-o"></i>';
	if(intval($num_comments) == 0){
		$output .= '0';
	}else if(intval($num_comments) == 1){
		$output .= '1';
	}else{
		$output .= esc_attr($num_comments);
	}
	$output .= '</a></span>';
}
$output .= '		</div>
				</div>
			</div>';
			
$posts_recent_post_content = $output;
?>
