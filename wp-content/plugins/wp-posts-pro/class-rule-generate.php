<?php 

class Rule_Generate{

   
   var $posts_limit;
      
   function __construct(){
	   
	   
	   add_action( 'pre_get_posts', array( $this, 'rule_alter_query' ) );
	   
   }
   
   function rule_alter_query( $query ){
	   
	   global $wpdb;
	   
	   if (! $query->is_main_query() )
       
       return;
       
       if( $query->is_page() || is_page() ) {
		   
		  $this->current_page_id = $query->get_queried_object_id() ? $query->get_queried_object_id() : $query->get('page_id') ;
	   }
	   
	   $rule_id = get_post_meta( $this->current_page_id, '_wprpw_layout_id', true );
  
	   if( ! $rule_id )
	   
	   return;
	   
	   
	   if( $rules = $this->get_layout_rules($rule_id) ){
		  
		  foreach( $rules as $rule ){
			 
			
		    $args = $this->get_wp_rule_args($rule); 
			
			$args['paged'] =  get_query_var('paged') ?  get_query_var('paged') : 0;
								
			if( $args['posts_per_page'] > 0 )
   	   
			add_filter('posts_request', array($this, 'posts_request_limits'));
			
	
			$rule_query = new WP_Query($args);
			
			if( has_filter('posts_request', 'posts_request_limits') )
			
			remove_filter('posts_request', 'posts_request_limits');
			
			foreach( $query as $key => $val){
			
			 $query->$key = $rule_query->$key;	
			
			}
		
		  
		  }
		   
	   }
	
	return $query;

   }
   
   function posts_request_limits($request){
	
 
	 if( strpos($request, 'SQL_CALC_FOUND_ROWS') !== false)
	
	 $request = str_replace("SQL_CALC_FOUND_ROWS", " ", $request);
	 
     return $request;
   }
   
   function get_wp_rule_args($rule_record){
	 
	// $posts_per_page = get_option('posts_per_page');
	
	$unserialize_rule_match = unserialize($rule_record->rule_match);
	
	 $args = array();
	 
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
		
		/*if($unserialize_rule_match['visibility']=="password-protected")
	    {
			$args['has_password']               =  true;
		}*/
		
	    if(!empty($unserialize_rule_match['category_taxonomy']) || !empty($unserialize_rule_match['post-formats']))
	    {
			$args['tax_query'] 			= array(
										  'relation' => 'OR',
											array(
												'taxonomy' => $unserialize_rule_match['category_taxonomy'],
												'field' => 'id',
												'terms' => $unserialize_rule_match['category_term'],
												'operator' => 'IN'
											),
											array(
												'taxonomy' => 'post_format',
												'field' => 'slug',
												'terms' => $unserialize_rule_match['post-formats'],
												'operator' => 'IN'
											)
			);
		}
		
		if(!empty($unserialize_rule_match['tags']))
	    {
			$args['tag__in'] 			= $unserialize_rule_match['tags'];
		}
		
		if(!empty($unserialize_rule_match['authorname']))
	    {
			$args['author__in'] 		= $unserialize_rule_match['authorname'];
		}
		
	    $args['posts_per_page']		= $rule_record->rule_number;
	    $args['orderby'] 			= $rule_record->rule_order_by;
		$args['order'] 				= $rule_record->rule_order;
    
    return $args;				
   
   }	
   
   
   function get_layout_rules( $rule_id ){
		
		global $wpdb;
		   
		   $rule_datas[] = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_rules WHERE rule_id=%d',$rule_id) );
		      
		   $rules = array_filter($rule_datas);		
	    
	  
	  return $rules; 
   }


}
