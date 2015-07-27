<?php
if(isset($_POST['wprpw_save_layout']) && $_POST['wprpw_save_layout']=='Save Layout')
{
	global $wpdb;
	
	if( $_POST['wprpw_layout_title']=="" )
	{
	   $error[] = 'Please enter layout title.';
	}
	
	if( $_POST['wprpw_rule_id']=="" )
	{
	   $error[] = 'Please choose a rule.';
	}
	
	if( empty($error) )
	{	
			
		$post_widget_layouts = $wpdb->prefix."post_widget_layouts";
		$post_widget_layouts_data = array(
			'layout_title' 			=> htmlspecialchars(stripslashes($_POST['wprpw_layout_title'])),
			'layout_rule_id' 		=> serialize($_POST['wprpw_rule_id']),
			'layout_type' 			=> htmlspecialchars(stripslashes($_POST['wprpw_choose_layout'])),
			'layout_post_setting' 	=> serialize($_POST['wprpw_post_setting'])
		);

		$wpdb->insert($post_widget_layouts , $post_widget_layouts_data);
		$success = 'Layout created successfully.';
		unset($_POST);
	}
}


global $wpdb;
$rules_data = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_rules where 1 = %d','1'));


$placeholder['layout_1']=array(

'title_html'=>'<h2 itemprop="name">%s</h2>',

'content_html'=>'%s',

'author_html'=>'by <span itemprop="author">%s</span>',

'date_html'=>'Publish on <span itemprop="datePublished">%s</span>',

'readmore_html'=>'%s',

'date_format' => "F,d Y T",

'category_html' => "Categories: %s",
'tags_html' => "Tags: %s"


);

foreach($placeholder['layout_1'] as $key=>$value)
if(isset($_POST['wprpw_post_setting'][$key]))
$default_data[$key]=$_POST['wprpw_post_setting'][$key];
else
$default_data[$key]=$placeholder['layout_1'][$key];
 
?>
<div class="wrap"> 
	<style>
	.hide_wrap{ display:none;}
	</style>
	<form method="post" action="" id="layout_form">
    <table>
		<tr><td> <h2>Create New Layout</h2></td><td style="padding-left:20px;"> <h2>Layout Preview</h2></td></tr>
		<tr><td valign="top">
    
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
    <table style="width:468px;border-right:1px dashed #999;" class="wprpw_post_pro">
			<tbody>
				<tr valign="top">
					<th scope="row">
							<label for="display_title"><?php _e('Layout Title','wpp_text');?> <span style="color:red;">*</span> </label>
					</th>
					<td>
							<input type="text" value="<?php if(!empty($_POST['wprpw_layout_title'])) { echo $_POST['wprpw_layout_title']; } ?>" id="wprpw_layout_title" name="wprpw_layout_title" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="wprpw_choose_layout"><?php _e('Select Layout','wpp_text');?> : </label>
					</th>
					<td>
						<select class="postform" name="wprpw_choose_layout"  id="wprpw_choose_layout">
							<option value="1"<?php if(!empty($_POST['wprpw_choose_layout'])) { selected($_POST['wprpw_choose_layout'],1); } ?>><?php _e('Layout','wpp_text');?> 1</option>
							<option value="2"<?php if(!empty($_POST['wprpw_choose_layout'])) {  selected($_POST['wprpw_choose_layout'],2); }?>><?php _e('Layout','wpp_text');?> 2</option>
							<option value="3"<?php if(!empty($_POST['wprpw_choose_layout'])) {  selected($_POST['wprpw_choose_layout'],3); } ?>><?php _e('Layout','wpp_text');?> 3</option>
							<option value="4"<?php if(!empty($_POST['wprpw_choose_layout'])) {  selected($_POST['wprpw_choose_layout'],4); } ?>><?php _e('Layout','wpp_text');?> 4</option>
							<option value="5"<?php if(!empty($_POST['wprpw_choose_layout'])) {  selected($_POST['wprpw_choose_layout'],5); } ?>><?php _e('Layout','wpp_text');?> 5</option>
							<option value="6"<?php if(!empty($_POST['wprpw_choose_layout'])) {  selected($_POST['wprpw_choose_layout'],6); } ?>><?php _e('Layout','wpp_text');?> 6</option>
							<option value="7"<?php if(!empty($_POST['wprpw_choose_layout'])) {  selected($_POST['wprpw_choose_layout'],7); } ?>><?php _e('Layout','wpp_text');?> 7</option>
						</select>
						
					</td>
				</tr>
				
				<tr valign="top">
					
					<th scope="row">
						<label for="wprpw_rule_id"><?php _e('Apply Rules','wpp_text');?>  <span style="color:red;">*</span> </label>
					</th>
					<td>
						<?php if(empty($rules_data)) { ?>
						
						Seems you don't have any rule right now.&nbsp;<a href="<?php echo admin_url('admin.php?page=wprpw-add-rule') ?>">Click here </a> &nbsp;to add a rule.          
						
						<?php } else { ?>
							
						<ul>					
							<?php 
							foreach( $rules_data as $data_rule ) { 
							
							if(!empty($_POST['wprpw_rule_id']))
							{
								if(in_array($data_rule->rule_id,$_POST['wprpw_rule_id']))
								{
							?>
							<li>
								<input type="checkbox" value="<?php echo $data_rule->rule_id; ?>" checked="checked" name="wprpw_rule_id[]">&nbsp;&nbsp;<?php echo $data_rule->rule_name; ?>
							</li>
							<?php 
								}
								else
								{
							?>	
							<li>
								<input type="checkbox" value="<?php echo $data_rule->rule_id; ?>" name="wprpw_rule_id[]">&nbsp;&nbsp;<?php echo $data_rule->rule_name; ?>
							</li>	
							<?php		
								}
							}
							else
							{
							?>
							<li>
								<input type="checkbox" value="<?php echo $data_rule->rule_id; ?>" name="wprpw_rule_id[]">&nbsp;&nbsp;<?php echo $data_rule->rule_name; ?>
							</li>
							<?php	
							}	 
							}
							?>
						
						</ul>
						<?php } ?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
							<label for="display_title"><?php _e('Hide Title','wpp_text');?>  : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_title" name="wprpw_post_setting[hide_title]" <?php if(!empty($_POST['wprpw_post_setting']['display_title'])) { checked($_POST['wprpw_post_setting']['display_title'],'true'); } ?>>
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
							<label for="display_title"><?php _e('Title Wrapper','wpp_text'); ?> : </label>
					</th>
					<td>
							<input type="text" id="title_html" name="wprpw_post_setting[title_html]" value="<?php if(!empty($default_data['title_html'])) { echo stripslashes(esc_html($default_data['title_html'])); }?>">
					</td>
				</tr>
				

				<tr valign="top">
					<th scope="row">
							<label for="display_excerpt"><?php _e('Hide Content','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_excerpt" name="wprpw_post_setting[hide_excerpt]" <?php if(!empty($_POST['wprpw_post_setting']['display_excerpt'])) { checked($_POST['wprpw_post_setting']['display_excerpt'],'true'); } ?>>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
							<label for="display_title"><?php _e('Content Wrapper','wpp_text');?>: </label>
					</th>
					<td>
							<input type="text" id="content_html" name="wprpw_post_setting[content_html]" value="<?php echo stripslashes(esc_html($default_data['content_html'])); ?>">
					</td>
				</tr>
				

                <tr valign="top">
					<th scope="row">
						<label for="display_excerpt"><?php _e('Content Show','wpp_text');?> : </label>
					</th>
					<td>
					   <select name="wprpw_post_setting[content_display]" id="content_display">
					     <option value="excerpt" <?php if(!empty($_POST['wprpw_post_setting']['content_display'])) { selected($_POST['wprpw_post_setting']['content_display'],'excerpt'); } ?>><?php _e('Excerpt','wpp_text');?></option>
					     <option value="full" <?php if(!empty($_POST['wprpw_post_setting']['content_display'])) { checked($_POST['wprpw_post_setting']['content_display'],'full'); } ?>><?php _e('Full','wpp_text');?></option>
					   </select>	
					</td>
				</tr>	
				<tr valign="top">
					<th scope="row">
							<label for="category_html"><?php _e('Post content limit','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="post_content_limit" name="wprpw_post_setting[post_content_limit]" value="<?php if(!empty($_POST['wprpw_post_setting']['post_content_limit'])) { echo stripslashes(esc_html($_POST['wprpw_post_setting']['post_content_limit'])); } ?>">
					</td>
				</tr>			
				<tr valign="top">
					<th scope="row">
							<label for="display_thumbnail"><?php _e('Hide Thumbnail','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_thumbnail" name="wprpw_post_setting[hide_thumbnail]" <?php if(!empty($_POST['wprpw_post_setting']['display_thumbnail'])) { checked($_POST['wprpw_post_setting']['display_thumbnail'],'true'); } ?>>
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
							<label for="display_publish_time"><?php _e('Thumbnail Width','wpp_text');?> : </label>
					</th>
					<td>
						
					 <input type="text" id="thumb_width" value="<?php if(!empty($_POST['wprpw_post_setting']['thumb_width'])) { echo $_POST['wprpw_post_setting']['thumb_width']; } ?>" name="wprpw_post_setting[thumb_width]" >
					
					</td>
				</tr>
	
				<tr valign="top">
					<th scope="row">
							<label for="display_publish_time"><?php _e('Thumbnail Height','wpp_text');?> : </label>
					</th>
					<td>
				
					<input type="text" id="thumb_height" value="<?php if(!empty($_POST['wprpw_post_setting']['thumb_height'])) { echo $_POST['wprpw_post_setting']['thumb_height']; } ?>" name="wprpw_post_setting[thumb_height]" >
					
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
						<label for="display_excerpt"><?php _e('Thumbnail Size','wpp_text');?> : </label>
					</th>
					<td>
					   <select name="wprpw_post_setting[thumb_size]" id="change_thumbnail_size">
					     <option value="thumbnail" <?php if(!empty($_POST['wprpw_post_setting']['thumb_size'])) { selected($_POST['wprpw_post_setting']['thumb_size'],'thumbnail'); } ?>><?php _e('thumbnail','wpp_text');?></option>
					     <option value="medium" <?php if(!empty($_POST['wprpw_post_setting']['thumb_size'])) {  selected($_POST['wprpw_post_setting']['thumb_size'],'medium'); } ?>><?php _e('medium','wpp_text');?></option>
					     <option value="large" <?php if(!empty($_POST['wprpw_post_setting']['thumb_size'])) {  selected($_POST['wprpw_post_setting']['thumb_size'],'large'); } ?>><?php _e('large','wpp_text');?></option>
					     <option value="full" <?php if(!empty($_POST['wprpw_post_setting']['thumb_size'])) {  selected($_POST['wprpw_post_setting']['thumb_size'],'full'); } ?>><?php _e('full','wpp_text');?></option>
					   </select>	
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
							<label for="display_read_more_link"><?php _e('Hide Read More','wpp_text');?>: </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_read_more_link" name="wprpw_post_setting[hide_read_more_link]" <?php if(!empty($_POST['wprpw_post_setting']['display_read_more_link'])) { checked($_POST['wprpw_post_setting']['display_read_more_link'],'true'); } ?>>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
							<label for="display_title">'<?php _e('Read More','wpp_text');?>'  <?php _e('Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="readmore_html" name="wprpw_post_setting[readmore_html]" value="<?php  if(!empty($default_data['readmore_html'])) { echo  stripslashes(esc_html($default_data['readmore_html'])); } ?>">
					</td>
				</tr>


				<tr valign="top">
					<th scope="row">
							<label for="display_publish_date"><?php _e('Hide Publish Date','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_publish_date" name="wprpw_post_setting[hide_publish_date]" <?php if(!empty($_POST['wprpw_post_setting']['display_publish_date'])) { checked($_POST['wprpw_post_setting']['display_publish_date'],'true'); } ?>>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
							<label for="date_format"><?php _e('Date Format','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="date_format" name="wprpw_post_setting[date_format]" value="<?php if(!empty($default_data['date_format'])) { echo stripslashes(esc_html($default_data['date_format'])); } ?>">
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
							<label for="display_title">'<?php _e('Date','wpp_text');?>' <?php _e('Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="date_html" name="wprpw_post_setting[date_html]" value="<?php if(!empty($default_data['date_html'])) { echo stripslashes(esc_html($default_data['date_html'])); }?>">
					</td>
				</tr>
				

				
				<tr valign="top">
					<th scope="row">
							<label for="display_author"><?php _e('Hide Author','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_author" name="wprpw_post_setting[hide_author]" <?php if(!empty($_POST['wprpw_post_setting']['display_author'])) { checked($_POST['wprpw_post_setting']['display_author'],'true'); } ?>>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
							<label for="display_title">'<?php _e('Author','wpp_text');?>' <?php _e('Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="author_html" name="wprpw_post_setting[author_html]" value="<?php if(!empty($default_data['author_html'])) { echo stripslashes(esc_html($default_data['author_html'])); } ?>">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
							<label for="display_post_categories"><?php _e('Hide Post Categories','wpp_text');?> : </label>
					</th>
					
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_post_categories" name="wprpw_post_setting[hide_post_categories]" <?php if(!empty($_POST['wprpw_post_setting']['display_post_categories'])) { checked($_POST['wprpw_post_setting']['display_post_categories'],'true'); } ?>>
					</td>
				</tr>
				
						<tr valign="top">
					<th scope="row">
							<label for="category_html"><?php echo _e('Categories Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="category_html" name="wprpw_post_setting[category_html]" value="<?php if(!empty($default_data['category_html'])) { echo stripslashes(esc_html($default_data['category_html'])); } ?>">
					</td>
				</tr>
					
				<tr valign="top">
					<th scope="row">
							<label for="display_post_tags"><?php _e('Hide Post Tags','wpp_text');?> : </label>
					</th>
					
				<td>
							<input type="checkbox" value="true" id="wprpw_hide_post_tags" name="wprpw_post_setting[hide_post_tags]" <?php if(!empty($_POST['wprpw_post_setting']['display_post_tags'])) { checked($_POST['wprpw_post_setting']['display_post_tags'],'true'); } ?>>
					</td>
				</tr>
					<tr valign="top">
					<th scope="row">
							<label for="tags_html"><?php echo _e('Tags Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="tags_html" name="wprpw_post_setting[tags_html]" value="<?php if(!empty($default_data['tags_html'])) { echo stripslashes(esc_html($default_data['tags_html'])); } ?>">
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
						<label for="columns_in_row"><?php _e('Responsive Column Layout','wpp_text');?> :</label>
					</th>
					<td>
					   <select name="wprpw_post_setting[columns_in_row]" id="columns_in_row">
					     <option value="1" <?php if(!empty($_POST['wprpw_post_setting']['columns_in_row'])) { selected($_POST['wprpw_post_setting']['columns_in_row'],'1'); } ?>>1 <?php _e('Column','wpp_text');?></option>
					     <option value="2" <?php if(!empty($_POST['wprpw_post_setting']['columns_in_row'])) { selected($_POST['wprpw_post_setting']['columns_in_row'],'2'); } ?>>2 <?php _e('Column','wpp_text');?></option>
					     <option value="3" <?php if(!empty($_POST['wprpw_post_setting']['columns_in_row'])) { selected($_POST['wprpw_post_setting']['columns_in_row'],'3'); } ?>>3 <?php _e('Column','wpp_text');?></option>
					     <option value="4" <?php if(!empty($_POST['wprpw_post_setting']['columns_in_row'])) { selected($_POST['wprpw_post_setting']['columns_in_row'],'4'); } ?>>4 <?php _e('Column','wpp_text');?></option>
					     <option value="5" <?php if(!empty($_POST['wprpw_post_setting']['columns_in_row'])) { selected($_POST['wprpw_post_setting']['columns_in_row'],'5'); } ?>>5 <?php _e('Column','wpp_text');?></option>
					     <option value="6" <?php if(!empty($_POST['wprpw_post_setting']['columns_in_row'])) { selected($_POST['wprpw_post_setting']['columns_in_row'],'6'); } ?>>6 <?php _e('Column','wpp_text');?></option>
					    </select> &nbsp;&nbsp;<a href="<?php echo admin_url('admin.php?page=wprpw-select-grid'); ?>" target="_blank"><?php _e('See Example','wpp_text');?></a>	
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
						<label for="display_excerpt"><?php _e('Pagination','wpp_text');?>: </label>
					</th>
					<td>
					   <select name="wprpw_post_setting[pagination]" >
					     <option value="true" <?php if(!empty($_POST['wprpw_post_setting']['pagination'])) { selected($_POST['wprpw_post_setting']['pagination'],'true'); } ?>><?php _e('True','wpp_text');?></option>
					     <option value="false" <?php if(!empty($_POST['wprpw_post_setting']['pagination'])) { selected($_POST['wprpw_post_setting']['pagination'],'false'); } ?>><?php _e('False','wpp_text');?></option>
					    
					   </select>	
					</td>
				</tr>
					
					<tr>
					<td colspan="2">
						<input type="submit" name="wprpw_save_layout" value="<?php _e('Save Layout','wpp_text');?>" class="button button-primary" />
					</td>
				</tr>

			</tbody>
		
	</table>
	
	</td>
	
   
    <td valign="top">
	   <div id="sourc-html" style="margin-bottom:20px;">
		  <input type="button" name="source_html" id="source_html" value="<?php _e('View Source','wpp_text');?>" class="button-primary" style="float:right;" />
		  <div style="width:450px; padding-left:20px;clear:both;display:none;">
		    <textarea name="wprpw_post_setting[layout_template]"  id="layout_template" rows="10" style="margin: 10px 0;width: 466px;"></textarea>
		    <p class="description"><?php  _e('Templates tags','wpp_text'); ?> : {title}, {content}, {thumbnail}, {meta_data}, {categories}, {tags} and {read_more}.</p>
		    <p class="description"><?php  _e('Custom Fields','wpp_text'); ?>  : {custom_field=your_meta_post_meta_key_here} eg. {custom_field=price} - <?php  _e("To display 'price' custom field.",'wpp_text'); ?></p>
		    <p class="description"><?php  _e('Shortcodes','wpp_text'); ?> - <?php  _e('You can use your shortcodes here as well.','wpp_text'); ?></p>		
		    <button name="layout_update" class="button-secondary layout_update" type="button"><?php _e('Update','wpp_text');?></button>&nbsp;&nbsp;<button name="layout_reset" class="button-secondary layout_update" type="button"><?php _e('Reset','wpp_text');?></button>
		  </div>
		</div> 	
     <div style="width:450px; padding-left:20px;">
		<div class="layout_default" id="wprpw_change_class">
				<article class="layout_preview"></article>	
				<article class="layout_preview"></article>	
				<article class="layout_preview"></article>	
	   </div>	
	</div>

    
    </td>
	</tr></table>
	</form>
</div>
