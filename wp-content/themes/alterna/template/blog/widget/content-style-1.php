<?php
/**
 * Blog Widget Recent Style 1
 *
 * @since alterna 7.0
 */
global $posts_recent_post_content;
$output = '';

$output .= '<div class="sidebar-blog-recent icon-style">
				<div class="post-type"><span class="'.esc_attr(alterna_get_post_type_icon( get_post_format())).'"></span></div>
				<div class="post-content">
					<h5 class="entry-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h5>
					<div class="entry-meta">
						<span class="entry-date"><a href="'.esc_url( get_permalink() ).'">'.esc_html( get_the_date() ).'</a></span>';

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
