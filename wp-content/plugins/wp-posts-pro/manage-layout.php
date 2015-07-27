<?php
class wprpw_manage_layout_table extends WP_List_Table {
    
var $layout_data,$found_data;
function __construct()
{
	global $status, $page,$wpdb;
		parent::__construct( array(
			'singular'  => 'responsive-post-widget',    
			'plural'    => 'responsive-post-widgets',  
			'ajax'      => false       
	) );
	
	$query = "SELECT * FROM ".$wpdb->prefix."post_widget_layouts ORDER BY layout_id DESC";
	$this->layout_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."post_widget_layouts where 1 = %d ORDER BY layout_id DESC",'1'),ARRAY_A );
	add_action( 'admin_head', array( &$this, 'admin_header' ) );            
}

function admin_header() 
{
	$page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
	if( 'location' != $page )
	return;
	echo '<style type="text/css">';
	echo '.wp-list-table .column-layout_title  { width: 20%; }';
	echo '.wp-list-table .column-layout_rule_id  { width: 20%; }';
	echo '.wp-list-table .column-layout_type  { width: 20%;}';
	echo '.wp-list-table .column-layout_shortcode  { width: 20%;}';
	echo '</style>';
}
  
function no_items()
{
	echo 'No Records for Manage Layouts.';
}
	
function column_default( $item, $column_name ) 
{
	switch( $column_name )
	{
		case 'layout_title': 
		case 'layout_rule_id': 
		case 'layout_shortcode':
		return $this->custom_column_value($column_name,$item);
		case 'layout_type':
		return "Layout ".$this->custom_column_value($column_name,$item);

		default:
		return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
	}
}
  
function custom_column_value($column_name,$item)
{
	if($column_name=='post_title ')
	return "<a href='".get_permalink( $item[ 'post_id' ] )."'>".$item[ $column_name ]."</a>";
	elseif($column_name=='user_login')
	return "<a href='".get_author_posts_url($item[ 'user_id' ])."'>".$item[ $column_name ]."</a>";
	else
	return $item[ $column_name ];
}

function get_sortable_columns() 
{
	$sortable_columns = array(
	'layout_title '   		=> array('layout_title ',false),
	'layout_rule_id '   	=> array('layout_rule_id ',false),
	'layout_type '   		=> array('layout_type ',false),
	'layout_shortcode '   	=> array('layout_total_post ',false)
	);
	return $sortable_columns;
}

function get_columns()
{
	$columns = array(
	'cb'        		=> '<input type="checkbox" />',
	'layout_title'  	=> __('Layout Title','wpp_text'),
	'layout_rule_id'  	=> __('Selected Rules','wpp_text'),
	'layout_type'      	=> __('Layout','wpp_text'),
	'layout_shortcode' 	=> __('Shortcodes','wpp_text')
	);
	return $columns;
}

function usort_reorder( $a, $b ) 
{  
	$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : '';
	$order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
	$result = strcmp( $a[$orderby], $b[$orderby] );
	return ( $order === 'asc' ) ? $result : -$result;
}

function column_layout_title($item)
{
	$actions = array(
			'edit'      => sprintf('<a href="?page=%s&action=%s&layout_id=%s">Edit</a>',$_REQUEST['page'],'edit',$item['layout_id']),
			'delete'    => sprintf('<a href="?page=%s&action=%s&layout_id=%s">Delete</a>',$_REQUEST['page'],'delete',$item['layout_id']),
		);
	
	return sprintf('%1$s %2$s', $item['layout_title'], $this->row_actions($actions) );
}

function column_layout_rule_id($item)
{
	global $wpdb;
	$rule_id = $wpdb->get_row($wpdb->prepare('SELECT layout_rule_id FROM '.$wpdb->prefix.'post_widget_layouts WHERE layout_id=%d',$item['layout_id']));
	$layout_rule_id = unserialize($rule_id->layout_rule_id);
	
	foreach($layout_rule_id as $all_rule_id) {
		$rule_name = $wpdb->get_row($wpdb->prepare('SELECT rule_name FROM '.$wpdb->prefix.'post_widget_rules WHERE rule_id=%d',$all_rule_id));
		echo $rule_name->rule_name.'<br />';	
	}
}

function get_bulk_actions() 
{
  $actions = array(
    'delete' => 'Delete'
  );
  return $actions;
}


function column_layout_shortcode($item)
{

	$layout_post_setting = unserialize($item['layout_post_setting']);
	echo '[wprpw_display_layout id='.$item['layout_id'].']';
}

function column_cb($item) 
{
	return sprintf(
		'<input type="checkbox" name="layout_id[]" value="%s" />', $item['layout_id']
	);
}

function prepare_items() 
{
	$columns  = $this->get_columns();
	$hidden   = array();
	$sortable = $this->get_sortable_columns();
	$this->_column_headers = array( $columns, $hidden, $sortable );
	usort( $this->layout_data, array( &$this, 'usort_reorder' ) );

	$per_page = 10;
	$current_page = $this->get_pagenum();
	$total_items = count( $this->layout_data );
	$this->found_data = array_slice( $this->layout_data,( ( $current_page-1 )* $per_page ), $per_page );
	$this->set_pagination_args( array(
	'total_items' => $total_items,                  //WE have to calculate the total number of items
	'per_page'    => $per_page                     //WE have to determine how many items to show on a page
	) );
	$this->items = $this->found_data;
}
}
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : "" ;
$_POST['action'] = isset($_POST['action']) ? $_POST['action'] : "" ;
if((isset($_GET['action']) && $_GET['action']=='delete' ) && $_GET['layout_id']!='')
{
	global $wpdb;
	$id = (int)$_GET['layout_id'];
	$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."post_widget_layouts WHERE layout_id=%d",$id));
	$success= 'Selected record deleted successfully.';
}

if( $_POST['action'] == 'delete' && $_POST['layout_id']!='' )
{
	global $wpdb;
	foreach($_POST['layout_id'] as $id)
	{
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."post_widget_layouts WHERE layout_id=%d",$id));
	}
	$success= 'Selected record deleted successfully.';
}

if($_GET['action']=='edit' && $_GET['layout_id']!='')
{

global $wpdb;	
if(isset($_POST['wprpw_update_layout']) && $_POST['wprpw_update_layout']=='Update Layout')
{
		
if( $_POST['wprpw_rule_id']=="" )
{
   $error[] = 'Please choose a rule.';
}

if( empty($error) )
{	
	
	$post_widget_layouts = $wpdb->prefix."post_widget_layouts";
	$wpdb->update( 
	$post_widget_layouts, 
	array( 
		'layout_title' 			=> htmlspecialchars(stripslashes($_POST['wprpw_layout_title'])),
		'layout_rule_id' 	=> serialize($_POST['wprpw_rule_id']),
		'layout_type' 		=> htmlspecialchars(stripslashes($_POST['wprpw_choose_layout'])),
		'layout_post_setting' 	=> serialize($_POST['wprpw_post_setting'])
	), 
	array( 'layout_id' => $_GET['layout_id'] ) 
	);

	$success = 'Layout updated successfully.';
}
	
}
	
$layout_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_layouts WHERE layout_id=%d',$_GET['layout_id']));	

$layout_post_setting = unserialize($layout_data->layout_post_setting);

$layout_rule_id = unserialize($layout_data->layout_rule_id);

$rules_data = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_rules where 1 = %d','1'));
?>

<div class="wrap">
	 <form method="post" action="" id="layout_form">
    <table>
	<tr><td> <h2><?php _e('Manage New Layout','wpp_text'); ?></h2></td><td style="padding-left:20px;"> <h2><?php _e('Layout Preview','wpp_text');?></h2></td></tr>

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
    <table style="width:500px;border-right:1px dashed #999;" class="wprpw_post_pro">
			<tbody>
				
				<tr valign="top">
					<th scope="row">
							<label for="display_title"><?php _e('Layout Title','wpp_text');?> <span style="color:red;">*</span> </label>
					</th>
					<td>
							<input type="text" value="<?php echo $layout_data->layout_title; ?>" id="wprpw_layout_title" name="wprpw_layout_title" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="wprpw_choose_layout"><?php _e('Select Layout','wpp_text');?> : </label>
					</th>
					<td>
						<select class="postform" name="wprpw_choose_layout"  id="wprpw_choose_layout">
							<option value="1"<?php selected($layout_data->layout_type,1); ?>><?php _e('Layout','wpp_text');?> 1</option>
							<option value="2"<?php selected($layout_data->layout_type,2); ?>><?php _e('Layout','wpp_text');?> 2</option>
							<option value="3"<?php selected($layout_data->layout_type,3); ?>><?php _e('Layout','wpp_text');?> 3</option>
							<option value="4"<?php selected($layout_data->layout_type,4); ?>><?php _e('Layout','wpp_text');?> 4</option>
							<option value="5"<?php selected($layout_data->layout_type,5); ?>><?php _e('Layout','wpp_text');?> 5</option>
							<option value="6"<?php selected($layout_data->layout_type,6); ?>><?php _e('Layout','wpp_text');?> 6</option>
							<option value="7"<?php selected($layout_data->layout_type,7); ?>><?php _e('Layout','wpp_text');?> 7</option>
						</select>
						
					</td>
				</tr>
				
				<tr valign="top">
					
					<th scope="row">
						<label for="wprpw_rule_id"><?php _e('Apply Rules','wpp_text');?> <span style="color:red;">*</span> </label>
					</th>
					<td>
						<?php if(empty($rules_data)) { ?>
						
						Seems you don't have any rule right now.&nbsp;<a href="<?php echo admin_url('admin.php?page=wprpw-add-rule') ?>">Click here </a> &nbsp;to add a rule.          
						
						<?php } else { ?>
							
						<ul>					
							<?php 
							foreach( $rules_data as $data_rule ) { 
							
							if(!empty($layout_rule_id))
							{
								if(in_array($data_rule->rule_id,$layout_rule_id))
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
							<label for="display_title"><?php _e('Hide Title','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_title" name="wprpw_post_setting[hide_title]" <?php if(!empty($layout_post_setting['hide_title'])) { checked($layout_post_setting['hide_title'],'true'); } ?>>
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
							<label for="display_title"><?php _e('Title Wrapper','wpp_text'); ?>: </label>
					</th>
					<td>
							<input type="text" id="title_html" name="wprpw_post_setting[title_html]" value="<?php echo stripslashes(esc_html($layout_post_setting['title_html'])); ?>">
					</td>
				</tr>
				
				
				
				
				<tr valign="top">
					<th scope="row">
							<label for="display_excerpt"><?php _e('Hide Content','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_excerpt" name="wprpw_post_setting[hide_excerpt]" <?php if(!empty($layout_post_setting['hide_excerpt'])) { checked($layout_post_setting['hide_excerpt'],'true'); } ?>>
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
							<label for="display_title"><?php _e('Content Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="content_html" name="wprpw_post_setting[content_html]" value="<?php echo stripslashes(esc_html($layout_post_setting['content_html'])); ?>">
					</td>
				</tr>
				
				
				<tr valign="top">
					<th scope="row">
						<label for="display_excerpt"><?php _e('Content Show','wpp_text');?> : </label>
					</th>
					<td>
					   <select name="wprpw_post_setting[content_display]" id="content_display">
					     <option value="excerpt" <?php selected($layout_post_setting['content_display'],'excerpt') ?>><?php _e('Excerpt','wpp_text');?></option>
					     <option value="full" <?php selected($layout_post_setting['content_display'],'full') ?>><?php _e('Full','wpp_text');?></option>
					   </select>	
					</td>
				</tr>
					<tr valign="top">
					<th scope="row">
							<label for="category_html"><?php _e('Post content limit','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="post_content_limit" name="wprpw_post_setting[post_content_limit]" value="<?php echo stripslashes(esc_html($layout_post_setting['post_content_limit'])); ?>">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
							<label for="display_thumbnail"><?php _e('Hide Thumbnail','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_thumbnail" name="wprpw_post_setting[hide_thumbnail]" <?php checked($layout_post_setting['hide_thumbnail'],'true') ?>>
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
							<label for="display_publish_time"><?php _e('Thumbnail Width','wpp_text');?> : </label>
					</th>
					<td>
						
					 <input type="text" id="thumb_width" value="<?php echo $layout_post_setting['thumb_width']; ?>" name="wprpw_post_setting[thumb_width]" >
					
					</td>
				</tr>
	
				<tr valign="top">
					<th scope="row">
							<label for="display_publish_time"><?php _e('Thumbnail Height','wpp_text');?> : </label>
					</th>
					<td>
				
					<input type="text" id="thumb_height" value="<?php echo $layout_post_setting['thumb_height']; ?>" name="wprpw_post_setting[thumb_height]" >
					
					</td>
				</tr>
	
				<tr valign="top">
					<th scope="row">
						<label for="display_excerpt"><?php _e('Thumbnail Size','wpp_text');?> : </label>
					</th>
					<td>
					   <select name="wprpw_post_setting[thumb_size]" id="change_thumbnail_size">
					     <option value="thumbnail" <?php selected($layout_post_setting['thumb_size'],'thumbnail') ?>><?php _e('thumbnail','wpp_text');?></option>
					     <option value="medium" <?php selected($layout_post_setting['thumb_size'],'medium') ?>><?php _e('medium','wpp_text');?></option>
					     <option value="large" <?php selected($layout_post_setting['thumb_size'],'large') ?>><?php _e('large','wpp_text');?></option>
					     <option value="full" <?php selected($layout_post_setting['thumb_size'],'full') ?>><?php _e('full','wpp_text');?></option>
					   </select>	
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
							<label for="display_read_more_link"><?php _e('Hide Read More','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_read_more_link" name="wprpw_post_setting[hide_read_more_link]" <?php checked($layout_post_setting['hide_read_more_link'],'true') ?>>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
							<label for="display_title">'<?php _e('Read More','wpp_text');?>' <?php _e('Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="readmore_html" name="wprpw_post_setting[readmore_html]" value="<?php echo stripslashes(esc_html($layout_post_setting['readmore_html'])); ?>">
					</td>
				</tr>
				
				
				<tr valign="top">
					<th scope="row">
							<label for="display_publish_date"><?php _e('Hide Publish Date','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_publish_date" name="wprpw_post_setting[hide_publish_date]" <?php if(!empty($layout_post_setting['hide_publish_date'])) { checked($layout_post_setting['hide_publish_date'],'true'); } ?>>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
							<label for="date_format"><?php _e('Date Format','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="date_format" name="wprpw_post_setting[date_format]" value="<?php if(!empty($layout_post_setting['date_format'])) { echo stripslashes(esc_html($layout_post_setting['date_format'])); } ?>">
					</td>
				</tr>
				
				
			<tr valign="top">
					<th scope="row">
							<label for="display_title">'<?php _e('Date','wpp_text');?>' <?php _e('Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="date_html" name="wprpw_post_setting[date_html]" value="<?php echo stripslashes(esc_html($layout_post_setting['date_html'])); ?>">
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
							<label for="display_publish_time"><?php _e('Date Format','wpp_text');?> : </label>
					</th>
					<td>
					<input type="text" value="<?php echo $layout_post_setting['date_format']; ?>" name="wprpw_post_setting[date_format]" >
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
							<label for="display_author"><?php _e('Hide Author','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_author" name="wprpw_post_setting[hide_author]" <?php if(!empty($layout_post_setting['hide_author'])) { checked($layout_post_setting['hide_author'],'true'); } ?>>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
							<label for="display_title">'<?php _e('Author','wpp_text');?>' <?php _e('Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="author_html" name="wprpw_post_setting[author_html]" value="<?php echo stripslashes(esc_html($layout_post_setting['author_html'])); ?>">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
							<label for="display_post_categories"><?php _e('Hide Post Categories','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_post_categories" name="wprpw_post_setting[hide_post_categories]" <?php checked($layout_post_setting['hide_post_categories'],'true') ?>>
					</td>
				</tr>
				
					<tr valign="top">
					<th scope="row">
							<label for="category_html"><?php echo _e('Categories Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="category_html" name="wprpw_post_setting[category_html]" value="<?php echo stripslashes(esc_html($layout_post_setting['category_html'])); ?>">
					</td>
				</tr>
				
				
				<tr valign="top">
					<th scope="row">
							<label for="display_post_tags"><?php _e('Hide Post Tags','wpp_text');?> : </label>
					</th>
					<td>
							<input type="checkbox" value="true" id="wprpw_hide_post_tags" name="wprpw_post_setting[hide_post_tags]" <?php checked($layout_post_setting['hide_post_tags'],'true') ?>>
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row">
							<label for="tags_html"><?php echo _e('Tags Wrapper','wpp_text');?> : </label>
					</th>
					<td>
							<input type="text" id="tags_html" name="wprpw_post_setting[tags_html]" value="<?php echo stripslashes(esc_html($layout_post_setting['tags_html'])); ?>">
					</td>
				</tr>
			
				<tr valign="top">
					<th scope="row">
						<label for="columns_in_row"><?php _e('Responsive Column Layout','wpp_text');?> :</label>
					</th>
					<td>
						<select name="wprpw_post_setting[columns_in_row]"  id="columns_in_row">
							<option value="1"<?php selected($layout_post_setting['columns_in_row'],1); ?>>1 <?php _e('Column','wpp_text');?></option>
							<option value="2"<?php selected($layout_post_setting['columns_in_row'],2); ?>>2 <?php _e('Column','wpp_text');?></option>
							<option value="3"<?php selected($layout_post_setting['columns_in_row'],3); ?>>3 <?php _e('Column','wpp_text');?></option>
							<option value="4"<?php selected($layout_post_setting['columns_in_row'],4); ?>>4 <?php _e('Column','wpp_text');?></option>
							<option value="5"<?php selected($layout_post_setting['columns_in_row'],5); ?>>5 <?php _e('Column','wpp_text');?></option>
							<option value="6"<?php selected($layout_post_setting['columns_in_row'],6); ?>>6 <?php _e('Column','wpp_text');?></option>
						</select>
						
					</td>
				</tr>
				
				
				<tr valign="top">
					<th scope="row">
						<label for="display_excerpt"><?php _e('Pagination','wpp_text');?>: </label>
					</th>
					
					<td>
					   <select name="wprpw_post_setting[pagination]" >
					     <option value="true" <?php selected($layout_post_setting['pagination'],'true') ?>><?php _e('True','wpp_text');?></option>
					     <option value="false" <?php selected($layout_post_setting['pagination'],'false') ?>><?php _e('False','wpp_text');?></option>
					    
					   </select>	
					</td>
				</tr>
				
				
				
				<tr>
					<td colspan="2">
						<input type="submit" name="wprpw_update_layout" value="<?php _e('Update Layout','wpp_text');?>" class="button button-primary" />
					</td>
				</tr>
			</tbody>
		
	</table>
	
	</td>
	
    <td valign="top">
	 <div id="sourc-html"  style="margin-bottom:20px;">
		  <input type="button" name="source_html" id="source_html" value="<?php _e('View Source','wpp_text');?>" class="button-primary" style="float:right;" />
		  <div style="width:450px; padding-left:20px;clear:both;display:none;">
		    <textarea name="wprpw_post_setting[layout_template]"  id="layout_template"  rows="10" style="margin: 10px 0;width: 466px;"><?php echo stripslashes($layout_post_setting['layout_template']); ?></textarea>

			<p class="description"><?php  _e('Templates tags','wpp_text'); ?> : {title}, {content}, {thumbnail}, {meta_data}, {categories}, {tags} and {read_more}.</p>
		    <p class="description"><?php  _e('Custom Fields','wpp_text'); ?> : {custom_field=your_meta_post_meta_key_here} eg. {custom_field=price} - <?php  _e("To display 'price' custom field.",'wpp_text'); ?>.</p>
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
<?php	
}
else
{
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>	
<h2><?php  _e('Manage Layouts','wpp_text');?></h2>
<?php
$manage_layout_list_table = new wprpw_manage_layout_table();
$manage_layout_list_table->prepare_items();
?>
<form method="post">
<?php
$manage_layout_list_table->display();
?> 
</form> 
</div> 
<?php
}
