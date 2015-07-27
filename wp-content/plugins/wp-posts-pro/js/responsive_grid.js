jQuery(document).ready(function($){
	
$('#layout_form').css('display','none');	
	
$('#wprpw_choose_layout').remove();	
	
$('.grid_table tr #dynamicselectbox').html('<select id="wprpw_choose_layout" ><option value="1">Layout 1</option><option value="2">Layout 2</option><option value="3">Layout 3</option><option value="4">Layout 4</option><option value="5">Layout 5</option><option value="6">Layout 6</option><option value="7">Layout 7</option>');	

$('#wprpw_choose_layout').change(select_layout_display);

layout_display();

function select_layout_display()
{
     
	 if(! $('#layout_form').length )
		
	 return;
			
     layout_id=$('#wprpw_choose_layout').val();
     
	 if(layout_id==2)
	 {
		 $('#wprpw_hide_publish_date').attr('checked',true);
		 $('#wprpw_hide_author').attr('checked',true);
		 
		 $('#wprpw_hide_thumbnail').attr('checked',false);
		 $('#wprpw_hide_read_more_link').attr('checked',false);
		 $('#wprpw_hide_excerpt').attr('checked',false);
		 
		 $('#wprpw_hide_post_categories').attr('checked',true);
		 $('#wprpw_hide_post_tags').attr('checked',true);
		 
	 } 
	 else if(layout_id==3)
	 {
		 
		 $('#wprpw_hide_thumbnail').attr('checked',true);
		 $('#wprpw_hide_read_more_link').attr('checked',true);
		 
		 $('#wprpw_hide_publish_date').attr('checked',false);
		 $('#wprpw_hide_author').attr('checked',false);
		 
		 $('#wprpw_hide_excerpt').attr('checked',false);
		 $('#wprpw_hide_publish_date').attr('checked',false);
		 $('#wprpw_hide_author').attr('checked',false); 
	
		 $('#wprpw_hide_post_categories').attr('checked',true);
		 $('#wprpw_hide_post_tags').attr('checked',true);
	
	
	 }
	 else if(layout_id==4)
	 {
		 $('#wprpw_hide_publish_date').attr('checked',true);
		 $('#wprpw_hide_author').attr('checked',true);
		 
		 $('#wprpw_hide_thumbnail').attr('checked',false);
		 $('#wprpw_hide_read_more_link').attr('checked',false);
		 $('#wprpw_hide_excerpt').attr('checked',false);
	
		 $('#wprpw_hide_post_categories').attr('checked',true);
		 $('#wprpw_hide_post_tags').attr('checked',true);
	
	 }
	 else if(layout_id==5)
	 {
		 
		 $('#wprpw_hide_publish_date').attr('checked',true);
		 $('#wprpw_hide_author').attr('checked',true);
		 
		 $('#wprpw_hide_thumbnail').attr('checked',false);
		 $('#wprpw_hide_read_more_link').attr('checked',false);
		 $('#wprpw_hide_excerpt').attr('checked',false);
	
		 $('#wprpw_hide_post_categories').attr('checked',true);
		 $('#wprpw_hide_post_tags').attr('checked',true);
	
	 }
	 else if(layout_id==6)
	 {
		 $('#wprpw_hide_thumbnail').attr('checked',false);
		 $('#wprpw_hide_read_more_link').attr('checked',true);
		 $('#wprpw_hide_excerpt').attr('checked',true);
		 $('#wprpw_hide_publish_date').attr('checked',true);
		 $('#wprpw_hide_author').attr('checked',true); 
	
		 $('#wprpw_hide_post_categories').attr('checked',true);
		 $('#wprpw_hide_post_tags').attr('checked',true);
	
	 }
	 else if(layout_id==7)
	 {
		 $('#wprpw_hide_thumbnail').attr('checked',false);
		 $('#wprpw_hide_excerpt').attr('checked',true);
		 $('#wprpw_hide_read_more_link').attr('checked',true);
		 $('#wprpw_hide_publish_date').attr('checked',true);
		 $('#wprpw_hide_author').attr('checked',true);
	
		 $('#wprpw_hide_post_categories').attr('checked',true);
		 $('#wprpw_hide_post_tags').attr('checked',true);
	
	 }
			  
		
	 var layout_data = {};
		 
		
		 $('input, select').each(function(){
		   
		   if($(this).attr('id')){
			   
			  
			  if( $(this).attr('type') == 'checkbox' ){
				  
				layout_data[$(this).attr('id')] =  $(this).is(':checked');
				
			  }else{
				layout_data[$(this).attr('id')] = $(this).val();  
			  } 
			  
			  
			  
			  
		   }	 
		})
				  
	     $.ajax({
			
			url: ajaxurl,
			
			data: { action: 'wppro_load_layout', layout: layout_data },
			
			type: 'POST',
			
			dataType: 'json',
			
			success: function(resp){
				
			$('.col').each(function(){
				
			   $(this).html(resp.html);
			   
			});	
			 
			}
			 
		 });	
	
}



function layout_display(){
	 
	     if(! $('#layout_form').length )
		 
		 return;
		
		 var layout_data = {};
		
		 $('input, select, textarea').each(function(){
		   
		   if($(this).attr('id')){
			   
			   
			  if( $(this).attr('type') == 'checkbox' ){
				layout_data[$(this).attr('id')] =  $(this).is(':checked');
			  }else{
				layout_data[$(this).attr('id')] = $(this).val();  
			  } 
		  
		   }	 
		})
				  
	     $.ajax({
			
			url: ajaxurl,
			
			data: { action: 'wppro_load_layout', layout: layout_data },
			
			type: 'POST',
			
			dataType: 'json',
			
			success: function(resp){
			 
			  $('.col').each(function(){
				
			   $(this).html(resp.html);
			   
			});
				
			}
			 
		 });
	  
	  }
	  
	  

});
