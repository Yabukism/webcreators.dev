<?php
function load_layout_fields_array(){
 
 $arr = array('title' => '', 'content' => '', 'meta_data' => '', 'categories' => '', 'tags' => '',  'read_more' => '',   'thumbnail' => '' );
 return $arr;
}

function wppro_apply_wrapper($wrapper,$string)
{

if($wrapper=='' or $string=='')
return $string;
else
{

$new_string=str_replace('%s',$string,stripcslashes($wrapper));

return $new_string;
	
}	

}

function wppro_get_title($layout)
{

$title='<a href="'.get_permalink().'">'.get_the_title().'</a>';

return wppro_apply_wrapper($layout['title_html'],$title); 	
	
}



function get_layout_content( $layout_id ){
 
 $filname = 'layout_'.$layout_id.'.php';
 
 $layout_file = dirname(__FILE__).'/layouts/'.$filname;
 
 if( file_exists($layout_file) == false )
 
 return '<div id="messages" class="error">Sorry layout '.$layout_id.' not found.</div>';
 
 ob_start();
 
 include($layout_file);
 
 $content = ob_get_contents();
 
 ob_clean();
  
 return $content;

}

function wppro_get_layout_postmeta( $layout_id, $option, $preview = false){
  
  
  $meta_data = array();
  
  $date = false;
  
  $time = false;
  
  $author = false;
  
  if( !isset($option['hide_publish_date']) )
  $date = true;

  if( !isset($option['hide_author']) )
  $author = true;
  
  if( !isset($option['date_format']) )
  $date_format = 'F,d Y T';
  else
  $date_format = $option['date_format'];
  
  
  switch($layout_id ){
	
	default  : 
	           if($date)   
               $meta_data['date'] = wppro_apply_wrapper($option['date_html'],get_the_date($date_format));	
               
	           if($author)   
               $meta_data['author'] = wppro_apply_wrapper($option['author_html'],get_the_author_link()); 

	           break;
  }
  
  
  	
  
  if($meta_data)
  
  return implode(", ", $meta_data ); 
  
  return '';

}

function wppro_get_layout_post_thumbnail( $layout_id,$option='', $preview = false){
  global $post;  

  $image_data = array( 'src' => '', 'width' => '', 'height' => '');
  
  $thumb_size = $option['thumb_size'];
  $thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "$thumb_size");	
  $thumb_width = $thumbnail_url[1];
  $thumb_height = $thumbnail_url[2];
  
  
  if( !  $thumbnail_url)
  return '';
  
  if( !empty($option['thumb_width']) )
  $thumb_width = $option['thumb_width'];
 
  if( !empty($option['thumb_height']) )
  $thumb_height = $option['thumb_height'];
  

  return '<a href="'.get_permalink().'"><img src="'.$thumbnail_url[0].'" style="width:'.$thumb_width.'px; height:'.$thumb_height.'px;"/></a>';

}

function wppro_get_layout_post_categories($layout, $preview = false ){
  

  $categories =	get_the_category();

  if( $categories ){
      
      $cats = array();
	    
	  foreach($categories as $category){
		  
		  $cats[] = '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>';
	  }  
	  
	  return implode(", ", $cats ) ;
  }  
  
  return '';

}

function wppro_get_layout_post_tags($layout, $preview = false ){
  

  $categories =	get_the_tags();

  if( $categories ){
      
      $cats = array();
	    
	  foreach($categories as $category){
		  
		  $cats[] = '<a href="'.get_tag_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->name.'</a>';
	  }  
	  
	  return implode(", ", $cats ) ;
  }  
  
  return '';

}

/*function wppro_get_layout_post_taxonomy( $layout, $preview = false ){
  
  $tags = get_the_tags();
  
  if($tags){
    
    $tags_links = array(); 
    
    foreach($tags as $tag){
      
     $tags_links[] = '<a href="'.get_tag_link( $tag->term_id ).'" >'.$tag->name.'</a>';
          
    }  
    return implode(", ", $tags_links );
  }
  
 
 return '';
  
}*/


function wppro_get_layout_post_taxonomy( $layout, $preview = false ){
  
  
  $tags = get_terms( trim($layout) );
  
  if($tags){
	  
	  $tags_links = array(); 
	  
	  foreach($tags as $tag){
	    
	   $tags_links[] = '<a href="'.get_tag_link( $tag->term_id ).'" >'.$tag->name.'</a>';
	    	  
	  }  
	  return implode(", ", $tags_links );
  }
  
 
 return '';
	
}

function wprpw_message($message, $errormsg = false)
{
	if( empty($message) )
	return;
	
	if ( $errormsg ) {
		echo '<div id="message" class="error">';
	}
	else {
		echo '<div id="message" class="updated">';
	}
	echo "<p><strong>$message</strong></p></div>";
} 