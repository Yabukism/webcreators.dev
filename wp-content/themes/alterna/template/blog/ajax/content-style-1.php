<?php
/**
 * Blog Ajax Item Content Style 1
 *
 * @since alterna 7.0
 */
global $page_columns_class, $thumbnail_size;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-ajax-element blog-ajax-style-1 '.$page_columns_class); ?> itemscope itemtype="http://schema.org/Article">
	 <div class="post-ajax-border">
		<?php if(get_post_format() == "image"){ ?>
        	<div class="post-ajax-content">
                <div class="post-img">
                    <?php echo get_the_post_thumbnail(get_the_ID(), $thumbnail_size , array('alt' => get_the_title(),'title' => '')); ?>
                    <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                    <div class="post-tip">
                        <div class="bg"></div>
                        <a href="<?php echo esc_url(get_permalink()); ?>"><div class="link left-link"><i class="big-icon-link"></i></div></a>
                        <a href="<?php echo esc_url($full_image[0]); ?>" class="fancyBox"><div class="link right-link"><i class="big-icon-preview"></i></div></a>
                    </div>
                </div>
           	</div>
		<?php }else if(get_post_format() == "gallery") { ?>
        	<div class="post-ajax-content">
                <div class="flexslider alterna-fl post-gallery">
                    <ul class="slides">
                        <?php
                            $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbnail_size);
                            $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                         ?>
                        <li><a href="<?php echo esc_url($full_image[0]); ?>" class="fancybox-thumb" rel="fb-blog-ajax-thumb[<?php echo get_the_ID(); ?>]"><img src="<?php echo esc_url($attachment_image[0]); ?>" alt=""></a></li>
                        <?php echo alterna_get_gallery_list(get_the_ID() , $thumbnail_size); ?>
                    </ul>
                </div>
            </div>
		<?php 
		}else if(get_post_format() == "video") {
			$video_type 	= penguin_get_post_meta_key('video-type');
			$video_content 	= penguin_get_post_meta_key('video-content');
			if($video_content && $video_content != ''){
				?>
                <div class="post-ajax-content">
                <?php
				if(intval($video_type) == 0){
					echo do_shortcode('[youtube id="'.$video_content.'" width="100%" height="300"]');
				}else if(intval($video_type) == 1){
					echo do_shortcode('[vimeo id="'.$video_content.'" width="100%" height="300"]');
				}else{
					echo $video_content;
				}
				?>
                </div>
                <?php
			}
         } else if(get_post_format() == "audio") { 
		   $audio_type 		= penguin_get_post_meta_key('audio-type');
		   $audio_content 	= penguin_get_post_meta_key('audio-content');
		   if($audio_content && $audio_content != ''){
			   ?>
               <div class="post-ajax-content">
               <?php
			   if(intval($audio_type) == 0){
				 echo do_shortcode('[soundcloud url="'.$audio_content.'"]');
			   }else{
				   echo $audio_content;
			   }
			   ?>
               </div>
               <?php
		   }
		} else if(get_post_format() == "quote"){ ?>
        	<div class="post-ajax-content">
        		<div class="post-quote-entry"><div class="post-quote-icon"></div><?php echo get_the_content(); ?></div>
            </div>
        <?php } ?>
        
        <div class="post-ajax-information">
        	<div class="post-date"><i class="fa fa-calendar"></i><span entry-date updated" itemprop="datePublished"><?php echo esc_attr(get_the_date()); ?></span></div>
            <div class="post-link"><a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-link"></i></a></div>
            <div class="post-mata-container">
            	<div class="post-type"><span class="<?php echo esc_attr(alterna_get_post_type_icon( get_post_format())); ?>"></span></div>
                <div class="post-meta-content">
                	<h4 class="entry-title" itemprop="name"><a href="<?php echo esc_url( get_permalink() ); ?>" itemprop="url"><?php the_title(); ?></a></h4>
                    <div class="post-meta">
                    	<div class="cat-links"><i class="fa fa-folder-open"></i><span itemprop="genre"><?php 	
												$categories = get_the_category();
                                            	$seperator = ' , ';
                                           		$output = '';
												if($categories){
													foreach($categories as $category) {
														$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'alterna'), $category->name ) ) . '">'.$category->cat_name.'</a>'.$seperator;
													}
												echo trim($output, $seperator);
                                            }
                                            ?></span></div>
                                            <div class="post-comments"><i class="fa fa-comments"></i><a href="<?php echo get_permalink(get_the_ID()).'#comments'; ?>" itemprop="interactionCount"><?php comments_number(__('No Comment','alterna'),__('1 Comment','alterna'),__('% Comments','alterna')); ?></a></div>
					</div>
				</div>
			</div>
		</div>
        
        <?php if(get_post_format() != "quote") { ?>
        <div class="entry-summary" itemprop="articleSection">
            <?php echo get_the_excerpt(); ?>
        </div>
        <?php echo '<a class="more-link" href="'.esc_url( get_permalink() ).'">'.__('Read More','alterna').'</a>'; ?>
        <?php } ?>
	</div>
</article>