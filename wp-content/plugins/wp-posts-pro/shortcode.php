<?php
global $wpdb;
if(!empty($atts['id']))
{
$record = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_layouts WHERE layout_id=%d',$atts['id']));

$layout_rule_id = unserialize($record->layout_rule_id);

$layout_setting = unserialize($record->layout_post_setting);

$layout = $record->layout_type;
}
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

		
	    $args['post_type']	= $unserialize_rule_match['post_type'];
	    
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
		
	  
	    if(!empty($rule_record->rule_offset))
	    $args['offset'] = $rule_record->rule_offset;
	    //$args['posts_per_page']	= $rule_record->rule_number;
	    $args['posts_per_page']     = $rule_record->rule_number;
		$args['page']       		= 1;
	    $args['orderby'] 			= $rule_record->rule_order_by;
		$args['order'] 				= $rule_record->rule_order;
		$args['post_status']       	= 'publish';
		$the_query =  new WP_Query($args); 
		$all_posts = array_merge($all_posts, $the_query->posts);
		
		// start custom field filter process  
	
	       $rule_customfields =  unserialize($rule_record->rule_customfield);
	       $wprpw_meta_data[]= array();
	      if(!empty($rule_customfields))
	      {
			  
			
				  if(isset($rule_customfields) &&  is_array($rule_customfields))
				   { 
					  
						 if(!empty($rule_customfields[0][0]['name']) && !empty($rule_customfields[0][0]['operation']) && !empty($rule_customfields[0][0]['value']))
							 {
							 
							   $wprpw_meta_data[$key] =array('relation' => 'OR');
							   foreach($rule_customfields as  $ruleindex=>$rulevalues)
								   {
										$total_relation = count($rulevalues);
										if($total_relation > 0)
										$wprpw_meta_data[$key][$ruleindex] = array( 'relation' => 'AND' );
									   foreach($rulevalues as $cfindex=>$cfvalue)
										   { 
											   if(!empty($cfvalue['name']) && !empty($cfvalue['operation']) && !empty($cfvalue['value']))
											   {
											   if($cfvalue['operation'] == '<' || $cfvalue['operation'] == '<=' || $cfvalue['operation'] == '>' || $cfvalue['operation'] == '>=' || $cfvalue['operation'] == 'BETWEEN' || $cfvalue['operation'] == 'NOT BETWEEN')
											   $wprpw_meta_data[$key][$ruleindex][$cfindex]= array( 'key' => $cfvalue['name'], 'value' => stripcslashes($cfvalue['value']),'compare' => $cfvalue['operation'],'type' => 'NUMERIC');
											   else
											   $wprpw_meta_data[$key][$ruleindex][$cfindex]= array( 'key' => $cfvalue['name'], 'value' => stripcslashes($cfvalue['value']),'compare' => $cfvalue['operation']);
										      }
										   }
									   
								   }
								
						   }
				   }
			  
		  }
// end custom field filter process  

// start time period filter


$wprpw_date_data[]= array();
if(!empty($unserialize_rule_match['timeperiod_rule']['option']))
{
	
	if($unserialize_rule_match['timeperiod_rule']['option'] == "betweendate")
	{
		 $wprpw_rule_startdate = $unserialize_rule_match['timeperiod_rule']['betweendate']['startdate'];
		 $wprpw_rule_enddate = $unserialize_rule_match['timeperiod_rule']['betweendate']['enddate'];
		 $wprpw_rule_startdate = date('F jS, Y',strtotime($wprpw_rule_startdate));
		 $wprpw_rule_enddate = date('F jS, Y',strtotime($wprpw_rule_enddate));
	}
	if($unserialize_rule_match['timeperiod_rule']['option'] == "lastndays")
	{
		 $wprpw_rule_days= $unserialize_rule_match['timeperiod_rule']['lastndays']['days'];
		 $todaydate = date('Y-m-d');
	     $wprpw_rule_startdate = date('Y-m-d',strtotime ( '-'.$wprpw_rule_days.' days' , strtotime ($todaydate )));
		 $wprpw_rule_startdate = date('F jS, Y',strtotime($wprpw_rule_startdate));
		 $wprpw_rule_enddate = date('F jS, Y',strtotime($todaydate));
	}
	$wprpw_date_data[$key] = array('after' => $wprpw_rule_startdate,'before' => $wprpw_rule_enddate );
	
}


// end time period filter
}		

		$postids = array();
			
			foreach( $all_posts as $item ) {
			
			$postids[]=$item->ID; //create a new query only of the post ids
			
			}

		$uniqueposts = array_unique($postids); //remove duplicate post ids
	
	  
	    
	    if(isset($atts['pagination']) && $atts['pagination']!='')
	    $atts['pagination'] = $atts['pagination'];
	    else
	    $atts['pagination'] = $layout_setting['pagination'];
	   
	   
	   
		if($atts['pagination']!='false')
		{
			
		$page = 1;
		if(get_query_var('paged')) {
		  $page = get_query_var('paged');
		} elseif(get_query_var('page')) {
		  $page = get_query_var('page');
		}
		}
		unset($new_args);
		
		$post_types = get_post_types('','names');
		
		
		
		
		if($atts['pagination']!='false')
		{
			$new_args['posts_per_page']     = get_option('posts_per_page ');
			$new_args['paged'] = $page;
		}
		else
		{
			
			$new_args['posts_per_page'] = 200;
			$new_args['paged'] = 1;
		}
		if(!empty($uniqueposts)){
			
			  
	      if ($layout_setting['post_content_limit'] > 0) {
			 
			   $length = $layout_setting['post_content_limit'];
		       $this->wprpw_post_lenght = $length;
				add_filter('excerpt_length', array($this,'wprpw_post_excerpt_length'),999);
			    add_filter('excerpt_more', array($this,'wprpw_new_excerpt_more'));
			 
	     }


	   
	    $new_args['meta_query']       	= $wprpw_meta_data;
        $new_args['date_query']       	= $wprpw_date_data;
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
			
		   $total_cols=$layout_setting['columns_in_row'];	
		   
		   if($total_cols=='')
		   $total_cols=1;
		   	
		   ?>
		     <div id="layout_<?php echo $layout; ?>">
		        
		        <div class="wp-posts-pro">
				  
				   <?php 	
				   
					$num = 0;
					$count=1;
					
					echo '<div class="section group divider">';
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
						 
						// give priority to shortcode cols
						if(isset($atts["cols"]) && $atts["cols"]>0)
						$total_cols= $atts["cols"];
						
						$start='';
						$end='';
					    $start.='<div class="col span_1_of_'.$total_cols.'">';
						$end.='</div>';
						
						echo $start.$layout_content.$end;
						
						if($count % $total_cols==0 ) 
						{ 
							echo '</div>';
							echo '<div class="section group divider">';
						}
						
						$count++;
						
					}
					 echo '</div>'; 

					if( empty($atts['number']) )
					{	
						$total_pages = $the_query->max_num_pages;
						 
						if ($total_pages > 1){
						 
						  $current_page = max(1, get_query_var('paged'));
						   
						  echo '<div class="posts-pro-pagination">';
			
							$big = 999999999; // need an unlikely integer
							$translated = __( 'Page', 'mytextdomain' ); // Supply translatable string

							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $the_query->max_num_pages
								) );

						 
						  echo '</div>';
						   
						}
					}
                 
	    
					//previous_posts_link( '<< Previous Posts', $the_query->max_num_pages );
					
					//next_posts_link( 'Next Posts >>', $the_query->max_num_pages );
					
					wp_reset_postdata();
					
					
				   ?>
		      </div>
		   
		    </div>
		   
		   <?php	
		}
		else
		{
			 _e('Posts are unavailable','wpp_text');
		}
		remove_filter('excerpt_length', array($this,'wprpw_post_excerpt_length'));
	    remove_filter('excerpt_more', array($this,'wprpw_new_excerpt_more'));
		
	}
	else
	{
		 _e('Posts are unavailable','wpp_text');
	}
      
}

