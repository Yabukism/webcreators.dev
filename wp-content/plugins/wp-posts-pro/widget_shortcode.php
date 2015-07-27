<?php
global $wpdb;

$record = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_layouts WHERE layout_id=%d',$atts['id']));

$layout_rule_id = unserialize($record->layout_rule_id);

$layout_setting = unserialize($record->layout_post_setting);

$layout = $record->layout_type;

$current_post_id = get_the_id();

if(!empty($record))
{	
	foreach($layout_rule_id as $key => $all_rule_id)
	{
		$rule_datas[] = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_rules WHERE rule_id=%d',$all_rule_id));
		$remove_empty_array = array_filter($rule_datas);		
	}
	
	
	
	$all_posts = array();
		
	foreach($remove_empty_array as $key => $rule_record)
	{
		$tax_query = array();

		$unserialize_rule_match = unserialize($rule_record->rule_match);

		if( empty($atts['number']) )
		{	
			$display_count = 30;
		}
		else
		{
			$display_count = $atts['number'];
		}

		
	    $args['post_type']			= $unserialize_rule_match['post_type'];
	    
	    if(!empty($unserialize_rule_match['ignoresticky']))
	    {
			$args['ignore_sticky_posts']	=  $unserialize_rule_match['ignoresticky'];
			$args['post__not_in']           =  get_option( 'sticky_posts' );
		}
		
		
		if(!empty($unserialize_rule_match['wprpw_hasthumbnail']) && $unserialize_rule_match['wprpw_hasthumbnail'] == "true")
	    {
			$args['meta_query'] 	=	 array(
											array(
												'key' => '_thumbnail_id'
											)
			); 
		}
         
        if(!empty($unserialize_rule_match['category_term'])) {
	
	if(empty($unserialize_rule_match['category_taxonomy']))
	$unserialize_rule_match['category_taxonomy'] ='category';	
										
		$tax_query[] = array(
						'taxonomy' => $unserialize_rule_match['category_taxonomy'],
						'field' => 'id',
						'terms' => $unserialize_rule_match['category_term'],
						'operator' => 'IN'
						);
		}
		
		if(!empty($unserialize_rule_match['post-formats'])) {
			
		$tax_query[] = array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => $unserialize_rule_match['post-formats'],
						'operator' => 'IN'
						);
		}
	   
		$args['tax_query'] 	= $tax_query;
		
		
		if(!empty($unserialize_rule_match['tags']))
	    {
			$args['tag__in'] 			= $unserialize_rule_match['tags'];
		}
		
		if(!empty($unserialize_rule_match['authorname']))
	    {
			$args['author__in'] 		= $unserialize_rule_match['authorname'];
		}
		
	    
	    //$args['posts_per_page']	= $rule_record->rule_number;
	    $args['posts_per_page']     = $display_count;
		$args['page']       		= 1;
	    $args['orderby'] 			= $rule_record->rule_order_by;
		$args['order'] 				= $rule_record->rule_order;
		$args['post_status']       	= 'publish';
		$the_query =  new WP_Query($args); 
		$all_posts = array_merge($all_posts, $the_query->posts);
}		
	
		$postids = array();
			
			foreach( $all_posts as $item ) {
			
			$postids[]=$item->ID; //create a new query only of the post ids
			
			}

		$uniqueposts = array_unique($postids); //remove duplicate post ids
	

		
		
		unset($new_args);
		
		$post_types = get_post_types('','names');
		
		$new_args['posts_per_page']     = $display_count;
		$new_args['post__in']       	= $uniqueposts;
		$new_args['post_status']       	= 'publish';
		$new_args['post_type'] = $post_types;
		$new_args['orderby'] 			= $args['orderby']; 
		$new_args['order'] 				= $args['order'];
	
		$the_query = new WP_Query($new_args);
    	
		global $post;
		
		$data = load_layout_fields_array();
  
		if($the_query->have_posts())
		{
		   ?>
		     <div id="layout_<?php echo $layout; ?>">
		        
		        <div class="wp-posts-pro">
				  
				   <?php 	
					$num = 0;
					while ( $the_query->have_posts() )
					{
					    $num++;

						$the_query->the_post();
						
						if( !isset($layout_setting['hide_title']) )
						
						$data['title'] = wppro_get_title($layout_setting);
						
						$data['meta_data'] = wppro_get_layout_postmeta( $layout, $layout_setting);
						
						if( !isset($layout_setting['hide_thumbnail']) )
						
						$data['thumbnail'] = wppro_get_layout_post_thumbnail( $layout,$layout_setting );
						
					
						if( !isset($layout_setting['hide_excerpt']) ){
						  
						  if( $layout_setting['content_display'] == 'excerpt' ){
							
							$data['content'] = wppro_apply_wrapper($layout_setting['content_html'],get_the_excerpt());  
						  
						  }else{
							
							$data['content'] = wppro_apply_wrapper($layout_setting['content_html'],get_the_content()); 
							  
						  }
							
						}
						
						if( !isset($layout_setting['hide_post_categories']) )
						$data['categories'] = wppro_apply_wrapper($layout_setting['category_html'],wppro_get_layout_post_categories($layout));
						
						if( !isset($layout_setting['hide_post_tags']) )
						$data['tags'] = wppro_apply_wrapper($layout_setting['tags_html'],wppro_get_layout_post_tags($layout));
						
		
	
					  	if($layout_setting['hide_read_more_link'] != 'true')  
						{
							$data['read_more'] = wppro_apply_wrapper($layout_setting['readmore_html'],'<a class="read-more" href="'.get_permalink().'">'.__("Read More...",'wpp_text').'</a>');					 
						}
    					
						if( ! empty($layout_setting['layout_template']) ){
						  $layout_content =  stripslashes($layout_setting['layout_template']);	
						}else{
						  $layout_content = get_layout_content($layout);	
						}
						
						
						
						foreach( $data as $key => $value){
	
	                       $layout_content =   str_replace("{{$key}}", $value, $layout_content);
					     
					    }
					     
					     $matches = array();
					    
					     preg_match_all('/{\s*taxonomy\s*=\s*(.*?)}/',  $layout_content, $matches);
					     
					     
					     if( isset($matches[0]) ){
						   
						   foreach($matches[0] as $k => $m){
							  $post_meta_key =  $matches[1][$k];
							  $meta_value = wppro_get_layout_post_taxonomy($post_meta_key);
							  $layout_content =   str_replace("{$m}", $meta_value, $layout_content);	 
						   }
						   
						 }
						
					     
					     $matches = array();
					    
					     preg_match_all('/{\s*custom_field\s*=\s*(.*?)}/',  $layout_content, $matches);
					     
					     
					     
					     if( isset($matches[0]) ){
						   
						   foreach($matches[0] as $k => $m){
							  $post_meta_key =  $matches[1][$k];
							  $meta_value = get_post_meta(get_the_ID(), $post_meta_key, true)? get_post_meta(get_the_ID(), $post_meta_key, true) : '';
							  $layout_content =   str_replace("{$m}", $meta_value, $layout_content);	 
						   }
						   
						 }
						
						echo $layout_content;
						
					}

					//previous_posts_link( '<< Previous Posts', $the_query->max_num_pages );
					
					//next_posts_link( 'Next Posts >>', $the_query->max_num_pages );
					
					wp_reset_postdata();
					
				   ?>
		      </div>
		   
		    </div>
		   
		   <?php	
		}
	
}
