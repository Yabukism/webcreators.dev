<script type='text/javascript'>
jQuery(document).ready(function($){
	
	var rule_type 	= jQuery('#wprpw_rule_type').val();

	var rule_id 	=  '<?php echo $_GET['rule_id'] = isset($_GET['rule_id']) ? $_GET['rule_id'] : "" ; ?>';
	
	wprpw_display_all_taxnomy_post_type($("input[name='rule_options[post_type]']:checked" ).val());
	
	jQuery('.show_all_tax').click(function() {
			wprpw_display_all_taxnomy_post_type($(this).val());
	});

	function wprpw_display_all_taxnomy_post_type(current_post_type){
		var selected_current_post_type = current_post_type;
		
		var rule_id = '<?php echo $_GET['rule_id']; ?>';
	   
		   if(rule_id!='')
		   { 
			  $.ajax({	 		 
					 type : "post",
					 url  : '<?php echo admin_url('admin-ajax.php'); ?>',
					 data : { action: "get_all_taxonomy_post_type", selected_current_post_type : selected_current_post_type, wprpw_rule_id:rule_id },
					 success : function(data) {
						  $('#all_taxonomy').html(data);
						  $("fieldset").find('.display_all_category_terms').click(function() {
						   		wprpw_display_all_category_terms($(this).val());
						  });
						  $.ajax({	 		 
							 type : "post",
							 url  : '<?php echo admin_url('admin-ajax.php'); ?>',
							 data : { action: "get_category_all_terms", selected_taxonomy : $("input[name='rule_options[category_taxonomy]']:checked" ).val(), wprpw_rule_id:rule_id },
							 success : function(data) {
								  $('#all_cats').html(data);								  
							 }
						  });
					 }
				});
			}
			else
			{
				$.ajax({	 		 
					 type : "post",
					 url  : '<?php echo admin_url('admin-ajax.php'); ?>',
					 data : { action: "get_all_taxonomy_post_type", selected_current_post_type : selected_current_post_type },
					 success : function(data) {
					 	   $('#all_taxonomy').html(data);
					 	   $('#all_cats').html('');
						   $("fieldset").find('.display_all_category_terms').click(function() {
						   		wprpw_display_all_category_terms($(this).val());
						   }); 
					 }
				});
			}
	}

	function wprpw_display_all_category_terms(tval){
		  
	   		var selected_taxonomy = tval;
	   
			$.ajax({	 		 
				 type : "post",
				 url  : '<?php echo admin_url('admin-ajax.php'); ?>',
				 data : { action: "get_category_all_terms", selected_taxonomy : selected_taxonomy },
				 success : function(data) {
					  $('#all_cats').html(data);
				 }
			});
	}

	jQuery.ajax({	 		 
			 type : "post",
			 url  : '<?php echo admin_url('admin-ajax.php'); ?>',
			 data : { action: "get_rule_match_options", r_type : rule_type, r_id : rule_id },
			 success : function(data) {
				   jQuery('#wprpw_rule_value').html(data);
			 }
	});
		
	jQuery("#wprpw_rule_type").change(function(){
		jQuery.ajax({	 		 
			 type : "post",
			 url  : '<?php echo admin_url('admin-ajax.php'); ?>',
			 data : { action: "get_rule_match_options", r_type : this.value },
			 success : function(data) {
				   jQuery('#wprpw_rule_value').html(data);
			 }
		});
	});
	
	
	
     
	 $('#layout_form select').not('#wprpw_color').change(select_layout_display);
	 
	// $('#change_thumbnail_size').change(layout_display);
	 
	 $('#layout_form input').change(layout_display);
     
	 layout_display();
	

	 function select_layout_display(){
		 
	     if(! $('#layout_form').length )
		 
		 return;
		
		 var layout_data = {};
		
		 $('input, select').each(function(){
		   
		   if($(this).attr('id')){
			   
			   
			  if( $(this).attr('type') == 'checkbox' ){
				  
				layout_data[$(this).attr('id')] =  $(this).is(':checked');
				
			  }else{
				layout_data[$(this).attr('id')] = $(this).val();  
			  } 
			  if($(this).attr('id')=='wprpw_choose_layout')
			  {
				 
				 layout_id=$(this).attr('id');
				 
				 if(layout_data[$(this).attr('id')]==2)
				 {
					 
					 $('#wprpw_hide_publish_date').attr('checked',true);
					 $('#wprpw_hide_author').attr('checked',true);
					 
					 $('#wprpw_hide_thumbnail').attr('checked',false);
					 $('#wprpw_hide_read_more_link').attr('checked',false);
					 $('#wprpw_hide_excerpt').attr('checked',false);
					 
					 $('#wprpw_hide_post_categories').attr('checked',true);
					 $('#wprpw_hide_post_tags').attr('checked',true);
					 
					 
				 } 
				 else if(layout_data[$(this).attr('id')]==3)
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
				 else if(layout_data[$(this).attr('id')]==4)
				 {
					 $('#wprpw_hide_publish_date').attr('checked',true);
					 $('#wprpw_hide_author').attr('checked',true);
					 
					 $('#wprpw_hide_thumbnail').attr('checked',false);
					 $('#wprpw_hide_read_more_link').attr('checked',false);
					 $('#wprpw_hide_excerpt').attr('checked',false);
				
					 $('#wprpw_hide_post_categories').attr('checked',true);
					 $('#wprpw_hide_post_tags').attr('checked',true);
				
				 }
				 else if(layout_data[$(this).attr('id')]==5)
				 {
					 $('#wprpw_hide_publish_date').attr('checked',true);
					 $('#wprpw_hide_author').attr('checked',true);
					 
					 $('#wprpw_hide_thumbnail').attr('checked',false);
					 $('#wprpw_hide_read_more_link').attr('checked',false);
					 $('#wprpw_hide_excerpt').attr('checked',false);
				
					 $('#wprpw_hide_post_categories').attr('checked',true);
					 $('#wprpw_hide_post_tags').attr('checked',true);
				
				 }
				 else if(layout_data[$(this).attr('id')]==6)
				 {
					 $('#wprpw_hide_thumbnail').attr('checked',false);
					 $('#wprpw_hide_read_more_link').attr('checked',true);
					 $('#wprpw_hide_excerpt').attr('checked',true);
					 $('#wprpw_hide_publish_date').attr('checked',true);
					 $('#wprpw_hide_author').attr('checked',true); 
				
					 $('#wprpw_hide_post_categories').attr('checked',true);
					 $('#wprpw_hide_post_tags').attr('checked',true);
				
				 }
				 else if(layout_data[$(this).attr('id')]==7)
				 {
					 $('#wprpw_hide_thumbnail').attr('checked',false);
					 $('#wprpw_hide_excerpt').attr('checked',true);
					 $('#wprpw_hide_read_more_link').attr('checked',true);
					 $('#wprpw_hide_publish_date').attr('checked',true);
					 $('#wprpw_hide_author').attr('checked',true);
				
					 $('#wprpw_hide_post_categories').attr('checked',true);
					 $('#wprpw_hide_post_tags').attr('checked',true);
				
				 }
			  }
			  
			  
			  
		   }	 
		})
				  
	     $.ajax({
			
			url: ajaxurl,
			
			data: { action: 'wppro_load_layout', layout: layout_data },
			
			type: 'POST',
			
			dataType: 'json',
			
			success: function(resp){
			 
			  $('.layout_preview').html(resp.html);
			  
			  $('#layout_template').val(resp.template);
				
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
			 
			  $('.layout_preview').html(resp.html);
			  
			  $('#layout_template').val(resp.template);
				
			}
			 
		 });
	  
	  }
	  
	  $('#source_html').toggle(function(){
		
		$(this).next().slideDown();	 
	  
	    $(this).val("Hide Source");
	  
	  },function(){
	
	     $(this).next().slideUp();   
	     
	     $(this).val("View Source");
		  
	  })
	  
	  $('.layout_update').click(function(){
		  
		  if( $(this).attr('name') == 'layout_reset' )
		  
		  $('#layout_template').val(" ");
		  
		  layout_display();
		  
	  })
	  
	  
	  
	  
	  
	  $('.display_all_posttype').click(function() {
		 
			if($(this).val() == "page")
			{
				$('#page_disply_none').hide();
			}
			else
			{
				$('#page_disply_none').show();
			}
	});
$(document).on("click",".wprpw_addrule",function(e){
    wprpw_addTableRow($("#wprpw_addmore"));
 });
 
 
$(document).on("click",".wprpw_newgroup",function(e){
wprpw_addTableRowRule($("#wprpw_addmorerule"));
});


$(document).on("click",".wprpw_addgroup",function(e){
wprpw_addNewRowRule($(this).closest('table'));
});

// time layout setting
     var wprpw_timeperiod_value;
     wprpw_timeperiod_value= $('.wprpw_timeperiod_option option:selected').val();

	 if(wprpw_timeperiod_value == "lastndays")
	 $( "#wprpw_lastndays_setting" ).show();
	 if(wprpw_timeperiod_value == "betweendate")
	 $( "#wprpw_betweendate_setting" ).show();

	 $('.wprpw_timeperiod_option').change(function() {
		wprpw_timeperiod_value = $(this).val();
		if(wprpw_timeperiod_value == "lastndays")
		{
			$( "#wprpw_betweendate_setting" ).hide();
			$( "#wprpw_lastndays_setting" ).show();
			
		}
		else if(wprpw_timeperiod_value == "betweendate")
		{
			$( "#wprpw_lastndays_setting" ).hide();
			$( "#wprpw_betweendate_setting" ).show();
		}
		else
		{
			$( "#wprpw_betweendate_setting" ).hide();
			$( "#wprpw_lastndays_setting" ).hide();
		}
		
	  
	 });

	
    $('#wprpw_timeperiod_startdate').datepicker({
        dateFormat : 'yy-mm-dd'
    });
     $('#wprpw_timeperiod_enddate').datepicker({
        dateFormat : 'yy-mm-dd'
    });

});
// default rule 
function wprpw_removeRow(ele)
{
n=ele;

jQuery('#wprpw_row'+ele).remove();

}

function wprpw_addTableRow(jQtable){
jQtable.each(function(){
var $table = jQuery(this);
var n = jQuery('tr', this).length;
if(n=='')
n=0;
// Number of td's in the last table row
var tds = '<tr id="wprpw_row'+n+'">';
tds += '<td><label for="wprpw_customfield"><?php _e('Custom Field','wpp_text');?></label></td> ';
tds+='<td><input type="text" name="wprpw_customfield[0]['+n+'][name]"  placeholder="<?php _e('Enter Custom Field Name','wpp_text');?>" /> </td>';
tds+='<td><select name="wprpw_customfield[0]['+n+'][operation]"><option value="="><?php _e('is equal to','wpp_text');?></option><option value="!="><?php _e('is not equal to','wpp_text');?></option> <option value=">"><?php _e('greater than','wpp_text');?></option><option value=">="><?php _e('greater than or equal to','wpp_text');?></option><option value="<"><?php _e('less than','wpp_text');?></option><option value="<="><?php _e('less than or equal to','wpp_text');?></option><option value="LIKE"><?php _e('LIKE','wpp_text');?></option><option value="NOT LIKE"><?php _e('NOT LIKE','wpp_text');?></option><option value="IN"><?php _e('IN','wpp_text');?></option><option value="NOT IN"><?php _e('NOT IN','wpp_text');?></option><option value="BETWEEN"><?php _e('BETWEEN','wpp_text');?></option><option value="NOT BETWEEN"><?php _e('NOT BETWEEN','wpp_text');?></option></select></td>';
tds+='<td><input type="text"  name="wprpw_customfield[0]['+n+'][value]"  placeholder="<?php _e('Enter Custom Field Value','wpp_text');?>" /></td>';
tds+=' <td class="wprpw_addrule" style="cursor:pointer;"><input type ="button" value="<?php _e('Add More','wpp_text');?>" ></td>';
tds+='<td><input type="button" name="deleteca'+n+'" value="<?php _e('Remove','wpp_text');?>" onclick="wprpw_removeRow('+n+')"></td>';


tds += '</tr>';
if(jQuery('tbody', this).length > 0){
jQuery('tbody', this).append(tds);
}else {
jQuery(this).append(tds);
}
var n = jQuery('tr', this).length;


});

return;
}



// for add new rule group
function wprpw_removeRowRule(ele,tbID)
{
n=ele;

jQuery('#more_rule'+tbID+' #wprpw_row'+ele+'').remove();


var rowCount = jQuery('#more_rule'+tbID+' tr').length;

if(rowCount == 1)
jQuery('#more_rule'+tbID).remove();
}
function wprpw_addTableRowRule(jQtable){
jQtable.each(function(){
var $table = jQuery(this);
var n = jQuery('tr', this).length;
if(n=='')
n=0;

var tablelenght = jQuery('#wprpw_addmorerule').find('table').length;
no_of_table = tablelenght+1;



// Number of td's in the last table row
var tds = '<table border="0" width="100%" cellspacing="0" cellpadding="0" class="more_rule" id="more_rule'+no_of_table+'" data-index="'+no_of_table+'"><tr id="wprpw_rowruleor'+no_of_table+'"><td colspan="6">OR</td></tr>';
tds += '<tr id="wprpw_row'+no_of_table+''+n+'">';
tds += '<td><label for="wprpw_customfield"><?php _e('Custom Field','wpp_text');?></label></td> ';
tds+='<td><input type="text" name="wprpw_customfield['+no_of_table+'][0][name]"  placeholder="<?php _e('Enter Custom Field Name','wpp_text');?>" /> </td>';
tds+='<td><select name="wprpw_customfield['+no_of_table+'][0][operation]"><option value="="><?php _e('is equal to','wpp_text');?></option><option value="!="><?php _e('is not equal to','wpp_text');?></option> <option value=">"><?php _e('greater than','wpp_text');?></option><option value=">="><?php _e('greater than or equal to','wpp_text');?></option><option value="<"><?php _e('less than','wpp_text');?></option><option value="<="><?php _e('less than or equal to','wpp_text');?></option><option value="LIKE"><?php _e('LIKE','wpp_text');?></option><option value="NOT LIKE"><?php _e('NOT LIKE','wpp_text');?></option><option value="IN"><?php _e('IN','wpp_text');?></option><option value="NOT IN"><?php _e('NOT IN','wpp_text');?></option><option value="BETWEEN"><?php _e('BETWEEN','wpp_text');?></option><option value="NOT BETWEEN"><?php _e('NOT BETWEEN','wpp_text');?></option></select></td>';
tds+='<td><input type="text"  name="wprpw_customfield['+no_of_table+'][0][value]"  placeholder="<?php _e('Enter Custom Field Value','wpp_text');?>" /></td>';
tds+=' <td class="wprpw_addgroup" style="cursor:pointer;"><input type ="button" value="<?php _e('Add More','wpp_text');?>" ></td>';
tds+='<td><input type="button" name="deleteca'+no_of_table+''+n+'" value="<?php _e('Remove','wpp_text');?>" onclick="wprpw_removeRowRule('+no_of_table+''+n+','+no_of_table+')"></td>';


tds += '</tr></table>';

jQuery(this).append(tds);

var n = jQuery('tr', this).length;
});

return;
}

// for multi rule in new rule group
function wprpw_addNewRowRule(jQtable){
jQtable.each(function(){
var $table = jQuery(this);
var n = jQuery('tr', this).length;
if(n=='')
n=0;
table_index = jQtable.attr('data-index');


// Number of td's in the last table row
var tds = '<tr id="wprpw_row'+table_index+''+n+'">';
tds += '<td><label for="wprpw_customfield"><?php _e('Custom Field','wpp_text');?></label></td> ';
tds+='<td><input type="text" name="wprpw_customfield['+table_index+']['+n+'][name]"  placeholder="<?php _e('Enter Custom Field Name','wpp_text');?>" /> </td>';
tds+='<td><select name="wprpw_customfield['+table_index+']['+n+'][operation]"><option value="="><?php _e('is equal to','wpp_text');?></option><option value="!="><?php _e('is not equal to','wpp_text');?></option> <option value=">"><?php _e('greater than','wpp_text');?></option><option value=">="><?php _e('greater than or equal to','wpp_text');?></option><option value="<"><?php _e('less than','wpp_text');?></option><option value="<="><?php _e('less than or equal to','wpp_text');?></option><option value="LIKE"><?php _e('LIKE','wpp_text');?></option><option value="NOT LIKE"><?php _e('NOT LIKE','wpp_text');?></option><option value="IN"><?php _e('IN','wpp_text');?></option><option value="NOT IN"><?php _e('NOT IN','wpp_text');?></option><option value="BETWEEN"><?php _e('BETWEEN','wpp_text');?></option><option value="NOT BETWEEN"><?php _e('NOT BETWEEN','wpp_text');?></option></select></td>';
tds+='<td><input type="text"  name="wprpw_customfield['+table_index+']['+n+'][value]"  placeholder="<?php _e('Enter Custom Field Value','wpp_text');?>" /></td>';
tds+=' <td class="wprpw_addgroup" style="cursor:pointer;"><input type ="button" value="<?php _e('Add More','wpp_text');?>" ></td>';
tds+='<td><input type="button" name="deleteca'+table_index+''+n+'" value="<?php _e('Remove','wpp_text');?>" onclick="wprpw_removeRowRule('+table_index+''+n+','+table_index+')"></td>';


tds += '</tr>';
if(jQuery('tbody', this).length > 0){
jQuery('tbody', this).append(tds);
}else {
jQuery(this).append(tds);
}
var n = jQuery('tr', this).length;


});

return;
}

</script>
