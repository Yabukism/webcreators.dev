
<?php

if(isset($_POST['wprpw_save_rule']) && $_POST['wprpw_save_rule']=='Save Rule')
{
	
	global $wpdb;
	
	if( $_POST['wprpw_rule_name']=="" )
	{
	   $error[] = 'Please enter rule name.';
	}
	if(isset($_POST['wprpw_timeperiod_option']) && $_POST['wprpw_timeperiod_option'] == "betweendate")	
	{
		if($_POST['wprpw_timeperiod']['startdate'] == "" || $_POST['wprpw_timeperiod']['enddate'] == "")
		$error[] = 'Please enter time period start date or end date.';
	}
	if(isset($_POST['wprpw_timeperiod_option']) && $_POST['wprpw_timeperiod_option'] == "lastndays")	
	{
		if($_POST['wprpw_timeperiod']['lastndays'] == "" || $_POST['wprpw_timeperiod']['lastndays'] == "")
		$error[] = 'Please enter Number of Days.';
	}
	if( empty($error) )
	{		
		$post_widget_rules = $wpdb->prefix."post_widget_rules";
		
		if($_POST['rule_options']['post_type']=="page")
		{
			$_POST['rule_options']['category_taxonomy'] = '';
			$_POST['rule_options']['category_term'] = '';
		}
		if(isset($_POST['wprpw_timeperiod_option']) && $_POST['wprpw_timeperiod_option'] !="")
		{
			$_POST['rule_options']['timeperiod_rule']['option'] = $_POST['wprpw_timeperiod_option'];
			if($_POST['wprpw_timeperiod_option'] == "lastndays")
			   $_POST['rule_options']['timeperiod_rule']['lastndays']['days'] =$_POST['wprpw_timeperiod']['lastndays'];
			if($_POST['wprpw_timeperiod_option'] == "betweendate")
			{
			  $_POST['rule_options']['timeperiod_rule']['betweendate']['startdate'] =$_POST['wprpw_timeperiod']['startdate'];
			  $_POST['rule_options']['timeperiod_rule']['betweendate']['enddate'] =$_POST['wprpw_timeperiod']['enddate'];
		    }
		}
	
        
		$rulearray=$_POST['rule_options'];
		
		$rules=serialize($rulearray);

		$customfilter_rules = serialize($_POST['wprpw_customfield']);
		
		$post_widget_rules_data = array(
			'rule_name' 	=> htmlspecialchars(stripslashes($_POST['wprpw_rule_name'])),
			'rule_match' 	=> $rules,
			'rule_number' => htmlspecialchars(stripslashes($_POST['wprpw_number'])),
			'rule_offset' => htmlspecialchars(stripslashes($_POST['wprpw_offset'])),
			'rule_order_by' => htmlspecialchars(stripslashes($_POST['wprpw_order_by'])),
			'rule_order' 	=> htmlspecialchars(stripslashes($_POST['wprpw_order'])),
			'rule_customfield' 	=> $customfilter_rules
		);
	
		$wpdb->insert($post_widget_rules , $post_widget_rules_data);
		
		$success = 'Rule added successfully.';
		unset($_POST);
	}
}

$args = array(
		'public' 	=> true,
		'_builtin' 	=> false
);
$custom_post_types = get_post_types($args, 'names');

//$output = 'names'; // or objects
//$operator = 'and'; // 'and' or 'or'
//$taxonomies = get_taxonomies( $args, $output, $operator ); 
?>
<div class='wpgmp-wrap' id="wrap">
	
<div class="col-md-11">	

<h3 id="wraphead"><?php echo _e('Add New Rule','wpp_text');?></h3>
<div class="wpgmp-overview">

					
<form method="post" action="" id="makerule">
<div class="form-horizontal">	
	
		
	<?php
	if( !empty($error) )
	{
		$error_msg=implode('<br>',$error);
		
		wprpw_message($error_msg,true);
	}
	if( !empty($success) )
	{
		wprpw_message($success);
	}
	
	
	?>	 
       <table class="form-table">
			<tbody>
									
		<tr valign="top">
		<td scope="row" colspan="2">
		
		<fieldset><legend><?php _e('General Settings','wpp_text');?> </legend>
		
			<label for="wprpw_rule_name" ><?php _e('Set Rule Name','wpp_text');?> <span style="color:#F00;">*</span></label>
			<input type="text" class="regular-text" value="<?php if(!empty($_POST['wprpw_rule_name'])) { echo $_POST['wprpw_rule_name']; } ?>" name="wprpw_rule_name" id="wprpw_rule_name" placeholder="<?php _e('Enter Rule Name Here','wpp_text');?>" style="margin-left: 6.8%;"> 
					
		</fieldset>
		
		
		 <fieldset><legend><?php _e('Filter by Post Types','wpp_text');?></legend>
		 
		 <input type="radio" name="rule_options[post_type]" class="display_all_posttype show_all_tax" value="post" checked="checked" /> <span class="value"><?php _e('Post', 'wpp_text'); ?></span>
		 <input type="radio" name="rule_options[post_type]" class="display_all_posttype" value="page" <?php if(!empty($_POST['rule_options']['post_type'])) { checked($_POST['rule_options']['post_type'],'page'); }?> /> <span class="value"><?php _e('Page', 'wpp_text'); ?></span>		
		 <?php foreach ( $custom_post_types  as $post_type ) { ?>
			<input type="radio" name="rule_options[post_type]" class="display_all_posttype show_all_tax" value="<?php echo $post_type; ?>" <?php if(!empty($_POST['rule_options']['post_type']))  { checked($_POST['rule_options']['post_type'],$post_type); } ?> /> <span class="value"><?php echo ucwords($post_type); ?></span>		
		<?php } ?>
		 </fieldset>
		 
		 <div id="page_disply_none">	
		 	
			<div id="all_taxonomy"></div>		
			
			<div id="all_cats"></div>
		
		</div>		
	
		
		<fieldset><legend><?php _e('Filter by Post Thumbnail Availiability','wpp_text');?></legend>
		<input type="checkbox" name="rule_options[wprpw_hasthumbnail]" value="true" <?php if(!empty($_POST['rule_options']['wprpw_hasthumbnail'])) { checked($_POST['rule_options']['wprpw_hasthumbnail'],'true'); } ?>/> <span class="value"><?php _e('Display Posts by Thumbnail','wpp_text');?></span>
	  
			
		</fieldset>
		
		
		<fieldset><legend><?php _e('Filter by Sticky Posts','wpp_text');?></legend>
			<input type="checkbox" name="rule_options[ignoresticky]" value="1" <?php if(!empty($_POST['rule_options']['ignoresticky'])) { checked($_POST['rule_options']['ignoresticky'],'1'); } ?>/> <span class="value"><?php _e('Ignore Sticky Posts','wpp_text');?></span>
		</fieldset>
		
		
						
				<fieldset><legend><?php _e('Filter by Post Tags');?></legend>
				<?php
				$tags = get_tags();
				
				if($tags) {
				foreach ( $tags as $tag ) {

				if($_POST['rule_options']['tags']!='') {
					if(in_array($tag->term_id,$_POST['rule_options']['tags'])) {
					 ?>
						<input type="checkbox" name="rule_options[tags][]" value="<?php echo $tag->term_id; ?>" checked="checked" /> <span class="value"> <?php echo ucfirst($tag->name); ?></span>
					 <?php
					 } else
					 {
						 ?>
						<input type="checkbox" name="rule_options[tags][]" value="<?php echo $tag->term_id; ?>"  /> <span class="value"> <?php echo ucfirst($tag->name); ?></span>
						 <?php
						}
					} else {	
						?>
						<input type="checkbox" name="rule_options[tags][]" value="<?php echo $tag->term_id; ?>" /> <span class="value"> <?php echo ucfirst($tag->name); ?></span>
					<?php } 
					 } 
					} else {
						  _e('No tags founds.','wpp_text');	
					}
					 ?>
				
				
				
				</fieldset>
				
				<fieldset><legend><?php _e('Filter by Authors','wpp_text');?></legend>
				
				<?php
				global $wpdb;
				$order = 'user_nicename';
				$user_ids = $wpdb->get_col("SELECT ID FROM $wpdb->users ORDER BY $order");
			    foreach($user_ids as $user_id) :
				$user = get_userdata($user_id);
		
				?>
				<?php 
				if($user->roles[0] != "subscriber")
				{
				if(isset( $_POST['rule_options']['authorname']) && $_POST['rule_options']['authorname']!='') {
					if(in_array($user->ID,$_POST['rule_options']['authorname'])) {
					 ?>
						<input type="checkbox" name="rule_options[authorname][]" value="<?php echo $user->ID; ?>" checked="checked" /><span class="value"><?php echo ucfirst($user->display_name); ?></span>		
					 <?php
					 } else
					 {
						 ?>
						 <input type="checkbox" name="rule_options[authorname][]" value="<?php echo $user->ID; ?>" /><span class="value"><?php echo ucfirst($user->display_name); ?></span>		
						 <?php
						}
					} else {	
						?>
						<input type="checkbox" name="rule_options[authorname][]" value="<?php echo $user->ID; ?>" /><span class="value"><?php echo ucfirst($user->display_name); ?></span>		
					<?php } 
				 }
					?>	
						
			   <?php  endforeach; ?>
				
				
				</fieldset>
				
				<fieldset><legend><?php _e('Filter by Post Formats','wpp_text');?></legend>
				<?php
				if ( current_theme_supports( 'post-formats' ) ) {
					$post_formats = get_theme_support( 'post-formats' );
					
					if ( is_array( $post_formats[0] ) ) {
					foreach ( $post_formats[0] as $format ) { ?>
					
		<?php 
				if(isset($_POST['rule_options']['post-formats']) && $_POST['rule_options']['post-formats']!='') {
					if(in_array('post-format-'.$format,$_POST['rule_options']['post-formats'])) {
					 ?>
						<input type="checkbox" name="rule_options[post-formats][]" value="post-format-<?php echo $format; ?>" checked="checked" /><span class="value"><?php echo ucfirst($format); ?>	</span>
					 <?php
					 } else
					 {
						 ?>
						 <input type="checkbox" name="rule_options[post-formats][]" value="post-format-<?php echo $format; ?>"/>	<span class="value"><?php echo ucfirst($format); ?>	</span>
						 <?php
						}
					} else {	
						?>
						<input type="checkbox" name="rule_options[post-formats][]" value="post-format-<?php echo $format; ?>"/>	<span class="value"><?php echo ucfirst($format); ?>	</span>
					<?php }  }	} } ?>
				
				
				</fieldset>
				
				<fieldset><legend><?php _e('Posts Number & Offset','wpp_text');?></legend>
		
					<label for="wprpw_number" ><?php _e('# of Post to Display','wpp_text');?></label>
					<select name='wprpw_number' style="margin-left: 3%;" >
						<option value="-1" <?php if(!empty($_POST['wprpw_number'])) { selected($_POST['wprpw_number'],'-1');} ?>><?php _e('All','wpp_text');?></option>
						<?php for($i=1;$i<21;$i++) echo "<option value='$i' ".selected($_POST['wprpw_number'],$i).">$i</option>"; ?>
					</select>
				
				<br/><br/>
		
					<label for="wprpw_" ><?php _e('# of Post to Skip','wpp_text');?> </label>
					<select name='wprpw_offset' style="margin-left: 3%;" >
						<option value = ""><?php _e('Please Select','wpp_text');?></option>
						<?php for($i=1;$i<21;$i++) echo "<option value='$i' ".selected($_POST['wprpw_number'],$i).">$i</option>"; ?>
					</select>
				
				</fieldset>
								
				<fieldset> <legend><?php _e('Filter Order By','wpp_text');?></legend>
					<label for="wprpw_order_by" ><?php _e('Order By','wpp_text');?></label>
					<select name='wprpw_order_by'>
						<option value='ID'<?php if(!empty($_POST['rule_order_by'])) { selected($_POST['rule_order_by'],'ID'); } ?>><?php _e('ID','wpp_text');?></option>
						<option value='name'<?php if(!empty($_POST['rule_order_by'])) { selected($_POST['rule_order_by'],'name'); } ?>><?php _e('Post Title','wpp_text');?></option>
						<option value='date'<?php if(!empty($_POST['rule_order_by'])) { selected($_POST['rule_order_by'],'date'); } ?>><?php _e('Post Date');?></option>
						<option value='rand'<?php if(!empty($_POST['rule_order_by'])) { selected($_POST['rule_order_by'],'rand'); } ?>><?php _e('Random');?></option>
					</select>
						
				</fieldset>
				
				<fieldset> <legend><?php _e('Filter By Order','wpp_text');?></legend>
					<label for="wprpw_order"><?php _e('Order','wpp_text');?></label>
					<select name='wprpw_order'>
						<option value='ASC'<?php if(!empty($_POST['rule_order'])) { selected($_POST['rule_order'],'ASC'); } ?>><?php _e('Ascending','wpp_text');?></option>
						<option value='DESC'<?php if(!empty($_POST['rule_order'])) {  selected($_POST['rule_order'],'DESC'); } ?>><?php _e('Decending','wpp_text');?></option>
					</select> 
				
				</fieldset>	
				
				<fieldset> <legend><?php _e('Filter by Custom Fields','wpp_text');?></legend>
			
				<table id="wprpw_addmore" border="0" width="100%" cellspacing="0" cellpadding="0">
						
					<?php  
		
					 if(isset($_POST['wprpw_customfield'][0]) && is_array($_POST['wprpw_customfield']))
					 {
						 
						 
						  foreach($_POST['wprpw_customfield'][0] as $customkey=>$customvalues)
						  {  
							  echo   $this->wprpw_customerules_data($customkey,$customvalues,$indexkey = 0,$wprpw_crgroup = false);
			
						 }
					 }
					 else
					 {  
						 $customvalues = array('name'=>'','operation'=>'','value'=>'');
						  $customkey = 0;
						  echo   $this->wprpw_customerules_data($customkey,$customvalues,$indexkey = 0,$wprpw_crgroup = false);
					   } ?>
					</table>
					<div id="wprpw_addmorerule">
						<?php 
						
						 if(isset($_POST['wprpw_customfield']) && is_array($_POST['wprpw_customfield']))
					     {
								  foreach($_POST['wprpw_customfield'] as $indexkey=>$customvaluesdata)
								  {  
									    if($indexkey == 0 )
									     continue;
									    ?>
									    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="more_rule" id="more_rule<?php echo $customkey ?>" data-index="<?php echo $customkey ?>">
									      <tr id="wprpw_rowruleor<?php echo $customkey ?>">
						                 <td colspan="6"><?php _e('OR','wpp_text'); ?></td>
						               </tr>
									    <?php
									   
									 foreach($customvaluesdata as $customkey=>$customvalue)
									 {
										    echo   $this->wprpw_customerules_data($customkey,$customvalue,$indexkey,$wprpw_crgroup = true);

						      
								     }  
									?>
									</table>
									<?php  
								  }
					   } 
						  ?>
						
					</div>
    <input class="wprpw_newgroup" type= "button" value ="<?php _e('New Group Conditions','wpp_text');?>" />
				</fieldset>	
				
				
				<fieldset> <legend><?php _e('Filter by Time Period','wpp_text');?></legend>
				<label for="wprpw_timeperiod_option" ><?php _e('Set Time Period','wpp_text');?></label>
				<select name="wprpw_timeperiod_option" class="wprpw_timeperiod_option"  style="margin-left: 3%;">
					<option value="" >Please Select</option>
					<option value="lastndays" <?php if(!empty($_POST['wprpw_timeperiod_option'])) { selected($_POST['wprpw_timeperiod_option'],'lastndays'); }?>><?php _e('Last N days', 'wpp_text'); ?></option>
				    <option value="betweendate" <?php if(!empty($_POST['wprpw_timeperiod_option'])) { selected($_POST['wprpw_timeperiod_option'],'betweendate'); }?>><?php _e('Bewteen Dates', 'wpp_text'); ?></option>
				</select>

		         <br/><br/>
	             <div style="display:none" id="wprpw_lastndays_setting">
					 <label for="wprpw_lastndays_days" ><?php _e('Enter Number of Days','wpp_text');?></label>
					 <input type="text" name="wprpw_timeperiod[lastndays]" style="margin-left: 3%;" value="<?php if(!empty($_POST['wprpw_timeperiod']['lastndays'])) { echo $_POST['wprpw_timeperiod']['lastndays'];  }?>"  >
					
					 </div>
				    <div style="display:none" id="wprpw_betweendate_setting">
						<label for="wprpw_timeperiod_startdate" ><?php _e('Start Date','wpp_text');?> <span style="color:#F00;">*</span></label>
						<input type="text" class="regular-text" value="<?php if(!empty($_POST['wprpw_timeperiod']['startdate'])) { echo $_POST['wprpw_timeperiod']['startdate']; } ?>" name="wprpw_timeperiod[startdate]" id="wprpw_timeperiod_startdate" placeholder="<?php _e('Choose Start Date','wpp_text');?>" > 
						<label for="wprpw_timeperiod_enddate" ><?php _e('End Date','wpp_text');?> <span style="color:#F00;">*</span></label>
						<input type="text" class="regular-text" value="<?php if(!empty($_POST['wprpw_timeperiod']['enddate'])) { echo $_POST['wprpw_timeperiod']['enddate']; } ?>" name="wprpw_timeperiod[enddate]" id="wprpw_timeperiod_enddate" placeholder="<?php _e('Choose End Date','wpp_text');?>" > 
					</div>
				</fieldset>	
				
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="wprpw_save_rule" value="<?php _e('Save Rule','wpp_text');?>" class="button button-primary" />
					</td>
				</tr>
		</table>		
</form>
</div>
</div>
</div>
</div>
