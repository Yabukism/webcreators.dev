
<?php
class wprpw_manage_rule_table extends WP_List_Table {
    
var $rule_data,$found_data;
function __construct()
{
	global $status, $page,$wpdb;
		parent::__construct( array(
			'singular'  => 'responsive-post-widget',    
			'plural'    => 'responsive-post-widgets',  
			'ajax'      => false       
	) );
	

	$this->rule_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."post_widget_rules where 1 =%d ORDER BY rule_id DESC","1"),ARRAY_A );
	
	add_action( 'admin_head', array( &$this, 'admin_header' ) );            
}

function admin_header() 
{
	$page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
	if( 'location' != $page )
	return;
	echo '<style type="text/css">';
	echo '.wp-list-table .column-rule_name  { width: 20%; }';
	echo '.wp-list-table .column-rule_number  { width: 20%;}';
	echo '.wp-list-table .column-rule_order_by  { width: 20%;}';
	echo '.wp-list-table .column-rule_order  { width: 20%;}';
	echo '</style>';
}
  
function no_items()
{
	echo 'No Records for Manage Rules.';
}
	
function column_default( $item, $column_name ) 
{
	switch( $column_name )
	{
		case 'rule_name': 
		case 'rule_number':
		case 'rule_order_by':
		case 'rule_order':
		default:
		return $item[$column_name]; //Show the whole array for troubleshooting purposes
	}
}
  
function custom_column_value($column_name,$item)
{
	$unserialized_data=unserialize($item['rule_match']);
	if($column_name=='post_title ')
	return "<a href='".get_permalink( $item[ 'post_id' ] )."'>".$item[ $column_name ]."</a>";
	elseif($column_name=='user_login')
	return "<a href='".get_author_posts_url($item[ 'user_id' ])."'>".$item[ $column_name ]."</a>";
	elseif($column_name=='rule_number')
	{
	  return $unserialized_data['total_post_todisplay'];
	}
	elseif($column_name=='rule_order_by')
	{
	  return $unserialized_data['rule_order_by'];
    }
	elseif($column_name=='rule_order')
	{
	 return $unserialized_data['rule_order'];
	}
	else
	return $item[ $column_name ];
}

function get_sortable_columns() 
{
	$sortable_columns = array(
	'rule_name'   		=> array('rule_name',false),
	'rule_number'   	=> array('rule_number',false),
	'rule_order_by'   	=> array('rule_order_by',false),
	'rule_order'   	=> array('rule_order',false)
	
	);
	return $sortable_columns;
}

function get_columns()
{
	$columns = array(
	'cb'        		=> '<input type="checkbox" />',
	'rule_name'  		=> __('Rule Name','wpp_text'),
	'rule_number'  		=> __('# of Posts','wpp_text'),
	'rule_order_by'     => __('Order by','wpp_text'),
	'rule_order'      	=> __('Order','wpp_text')
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

function column_rule_name($item)
{
	$actions = array(
			'edit'      => sprintf('<a href="?page=%s&action=%s&rule_id=%s">Edit</a>',$_REQUEST['page'],'edit',$item['rule_id']),
			'delete'    => sprintf('<a href="?page=%s&action=%s&rule_id=%s">Delete</a>',$_REQUEST['page'],'delete',$item['rule_id']),
		);
	return sprintf('%1$s %2$s', $item['rule_name'], $this->row_actions($actions) );
}

function get_bulk_actions() 
{
  $actions = array(
    'delete' => __('Delete','wpp_text')
  );
  return $actions;
}

function column_cb($item) 
{
	return sprintf(
		'<input type="checkbox" name="rule_id[]" value="%s" />', $item['rule_id']
	);
}

function column_rule_number($item) 
{
	global $wpdb;
	
	$rule_number = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."post_widget_rules WHERE rule_id = %d",$item['rule_id']));
	if($rule_number) {
		foreach($rule_number as $number) {
			if($number->rule_number=="-1") {
				echo "ALL";
			} else {
				echo $number->rule_number;
			}
		} 
	}
}

function column_rule_order_by($item) 
{
	global $wpdb;
	$order_by = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."post_widget_rules WHERE rule_id= %d",$item['rule_id']));
	if($order_by) {
		foreach($order_by as $order_byy) {
			if($order_byy->rule_order_by=="rand") {
				echo "RANDAM";
			} else {
			echo strtoupper( $order_byy->rule_order_by );
			}
		} 
	}
}

function column_rule_order($item) 
{
	global $wpdb;
	$rule_order = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."post_widget_rules WHERE rule_id=%d",$item['rule_id']));
	if($rule_order) {
		foreach($rule_order as $order) {
			
			echo strtoupper( $order->rule_order );
			
		} 
	}
}

function prepare_items() 
{
	$columns  = $this->get_columns();
	$hidden   = array();
	$sortable = $this->get_sortable_columns();
	$this->_column_headers = array( $columns, $hidden, $sortable );
	usort( $this->rule_data, array( &$this, 'usort_reorder' ) );

	$per_page = 10;
	$current_page = $this->get_pagenum();
	$total_items = count( $this->rule_data );
	$this->found_data = array_slice( $this->rule_data,( ( $current_page-1 )* $per_page ), $per_page );
	$this->set_pagination_args( array(
	'total_items' => $total_items,                  //WE have to calculate the total number of items
	'per_page'    => $per_page                     //WE have to determine how many items to show on a page
	) );
	$this->items = $this->found_data;
}
}


if((isset($_GET['action']) && $_GET['action']=='delete') && $_GET['rule_id']!='')
{
	global $wpdb;
	$id = (int)$_GET['rule_id'];
	$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."post_widget_rules WHERE rule_id=%d",$id));
	$success= 'Selected record deleted successfully.';
}

if((isset($_POST['action']) && $_POST['action']=='delete')  && $_POST['rule_id']!='' )
{
	global $wpdb;
	foreach($_POST['rule_id'] as $id)
	{
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."post_widget_rules WHERE rule_id=%d",$id));
	}
	$success= 'Selected record deleted successfully.';
}

if((isset($_GET['action']) && $_GET['action']=='edit') && $_GET['rule_id']!='')
{

if(isset($_POST['wprpw_update_rule']) && $_POST['wprpw_update_rule']=='Update Rule')
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
		$wpdb->update( 
		$post_widget_rules, 
		array(
			'rule_name' 	=> htmlspecialchars(stripslashes($_POST['wprpw_rule_name'])),
			'rule_match' 	=> $rules,
			'rule_number' => htmlspecialchars(stripslashes($_POST['wprpw_number'])),
			'rule_offset' => htmlspecialchars(stripslashes($_POST['wprpw_offset'])),
			'rule_order_by' => htmlspecialchars(stripslashes($_POST['wprpw_order_by'])),
			'rule_order' 	=> htmlspecialchars(stripslashes($_POST['wprpw_order'])),
			'rule_customfield' 	=> $customfilter_rules
		), 
		array( 'rule_id' => $_GET['rule_id'] ) 
		);
		
		$success = 'Rule updated successfully.';
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

global $wpdb;
$record = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_rules WHERE rule_id=%d',$_GET['rule_id']));
$unserialized = unserialize($record->rule_match);

?>
	
<div class='wpgmp-wrap' id="wrap">
	
<div class="col-md-11">	

<h3 id="wraphead">Edit Rule</h3>
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
		
		<fieldset><legend><?php _e('General Settings','wpp_text');?></legend>
			<label for="wprpw_rule_name" ><?php _e('Set Rule Name','wpp_text');?> <span style="color:#F00;">*</span></label>
			<input type="text" class="regular-text" value="<?php echo $record->rule_name; ?>" name="wprpw_rule_name" id="wprpw_rule_name" placeholder="<?php _e('Enter Rule Name Here','wpp_text'); ?>" style="margin-left: 6.8%;"> 
			
		</fieldset>
		
		
		 <fieldset><legend><?php _e('Filter by Post Types','wpp_text');?></legend>
			 <input type="radio" name="rule_options[post_type]" class="display_all_posttype show_all_tax" value="post" <?php checked($unserialized['post_type'],'post'); ?> /> <span class="value"><?php _e('Post', 'wpp_text'); ?></span>
			 <input type="radio" name="rule_options[post_type]" class="display_all_posttype show_all_tax" value="page" <?php checked($unserialized['post_type'],'page'); ?> /> <span class="value"><?php _e('Page', 'wpp_text'); ?></span>		
			 <?php foreach ( $custom_post_types  as $post_type ) { ?>
				<input type="radio" name="rule_options[post_type]" class="display_all_posttype show_all_tax" value="<?php echo $post_type; ?>" <?php checked($unserialized['post_type'],$post_type); ?> /> <span class="value"><?php echo ucwords($post_type); ?></span>		
			<?php } ?>
		  </fieldset>
		 
		 <?php 
		 if($unserialized['post_type']=="page") 
		 {
			$display_page = 'display:none;';
		 }
		 else
		 {
			 $display_page = 'display:block;';
		 } 
		 ?>
		 
		 <div id="page_disply_none" style="<?php echo $display_page; ?>">	
		 									
			<div id="all_taxonomy"></div>
			
			<div id="all_cats"></div>
			
		</div>		
	
		
		<fieldset><legend><?php _e('Filter by Post Thumbnail Availiability','wpp_text');?></legend>
		
			<input type="checkbox" name="rule_options[wprpw_hasthumbnail]" value="true" <?php if(!empty($unserialized['wprpw_hasthumbnail'])) { checked($unserialized['wprpw_hasthumbnail'],'true'); } ?>/> <span class="value"><?php _e('Display Posts by Thumbnail','wpp_text');?></span>
	   	
		</fieldset>
		
		<fieldset><legend><?php _e('Filter by Sticky Posts','wpp_text');?></legend>
			
			<input type="checkbox" name="rule_options[ignoresticky]" value="1" <?php if(!empty($unserialized['ignoresticky'])) { checked($unserialized['ignoresticky'],'1'); } ?>/> <span class="value"><?php _e('Ignore Sticky Posts','wpp_text');?></span>
	   
		</fieldset>
		
						
				<fieldset><legend><?php _e('Filter by Post Tags');?></legend>
				<?php
				$tags = get_tags();
				
				if($tags) {
				foreach ( $tags as $tag ) {

				//$tag_link = get_tag_link( $tag->term_id );
				
				if($unserialized['tags']!='') {
					if(in_array($tag->term_id,$unserialized['tags'])) {
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
						echo 'No tags founds.';	
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
				if(isset($unserialized['authorname']) && $unserialized['authorname']!='') {
					if(in_array($user->ID,$unserialized['authorname'])) {
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
					foreach ( $post_formats[0] as $format ) {	
						
				if(isset($unserialized['post-formats']) && $unserialized['post-formats']!='') {
					if(in_array('post-format-'.$format,$unserialized['post-formats'])) {
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
				
				
				
				
				<fieldset><legend><?php _e('Filter by # of Post','wpp_text');?></legend>
		
					<label for="wprpw_number" ><?php _e('# of Post to Display','wpp_text');?></label>
					<select name='wprpw_number' style="margin-left: 3%;" >
						<option value="-1" <?php selected($record->rule_number,'-1'); ?>><?php _e('All','wpp_text');?></option>
						<?php for($i=1;$i<21;$i++) echo "<option value='$i' ".selected($record->rule_number,$i).">$i</option>"; ?>
					</select>
				
			       <br/><br/>
		
					<label for="wprpw_" ><?php _e('# of Post to Skip','wpp_text');?> </label>
					<select name='wprpw_offset' style="margin-left: 3%;" >
						<option value = ""><?php _e('Please Select','wpp_text');?></option>
						<?php for($i=1;$i<21;$i++) echo "<option value='$i' ".selected($record->rule_offset,$i).">$i</option>"; ?>
					</select>
				
				</fieldset>
								
				<fieldset> <legend><?php _e('Filter Order By','wpp_text');?></legend>
					<label for="wprpw_order_by" ><?php _e('Order By','wpp_text');?></label>
					<select name='wprpw_order_by'>
						<option value='ID'<?php selected($record->rule_order_by,'ID'); ?>><?php _e('ID','wpp_text');?></option>
						<option value='name'<?php selected($record->rule_order_by,'name'); ?>><?php _e('Post Title','wpp_text');?></option>
						<option value='date'<?php selected($record->rule_order_by,'date'); ?>><?php _e('Post Date');?></option>
						<option value='rand'<?php selected($record->rule_order_by,'rand'); ?>><?php _e('Random');?></option>
					</select>
						
				</fieldset>
				
				<fieldset> <legend><?php _e('Filter By Order','wpp_text');?></legend>
					<label for="wprpw_order"><?php _e('Order','wpp_text');?></label>
					<select name='wprpw_order'>
						<option value='ASC'<?php selected($record->rule_order,'ASC'); ?>><?php _e('Ascending','wpp_text');?></option>
						<option value='DESC'<?php selected($record->rule_order,'DESC'); ?>><?php _e('Decending','wpp_text');?></option>
					</select> 
				
		
				
				
				
				<fieldset> <legend><?php _e('Filter by Custom Fields','wpp_text');?></legend>
			
				<table id="wprpw_addmore" border="0" width="100%" cellspacing="0" cellpadding="0">
						
					<?php  
			          $wprpw_customerules = unserialize($record->rule_customfield);
			            if(empty($wprpw_customerules[0]))
						  $wprpw_customerules[0] = array(0 => array("name"=> "","operation" => "=","value"=>""));
			          
					 if(isset($wprpw_customerules[0]) && is_array($wprpw_customerules))
					 {
						 
						 
						  foreach($wprpw_customerules[0] as $customkey=>$customvalues)
						  {  
							 echo   $this->wprpw_customerules_data($customkey,$customvalues,$indexkey = 0,$wprpw_crgroup = false);
							 ?>
							  
							
							
							
						<?php  }
					 }
					 ?>
					</table>
					<div id="wprpw_addmorerule">
						<?php 
						 if(isset($wprpw_customerules) && is_array($wprpw_customerules))
					     {
							 
						
							
								  foreach($wprpw_customerules as $indexkey=>$customvalues)
								  {  
								
									    if($indexkey == 0 )
									     continue;
									    if($indexkey == 0)
										  $rowindexkey  = 1;
										  else
										  $rowindexkey =$indexkey;
									    ?>
									    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="more_rule" id="more_rule<?php echo $rowindexkey ?>" data-index="<?php echo $rowindexkey ?>">
									     <tr id="wprpw_rowruleor<?php echo $customkey ?>">
						                 <td colspan="6"><?php _e('OR','wpp_text'); ?></td>
						               </tr>
									    <?php
				
									 foreach($customvalues as $customkey=>$indexvalue)
									 {
										  if(!empty($indexvalue['name']) && !empty($indexvalue['operation']) && !empty($indexvalue['value']))
											   {
												   
												   echo   $this->wprpw_customerules_data($customkey,$indexvalue,$indexkey,$wprpw_crgroup = true);
									  
								                }  
									} ?>
									</table>
									<?php  
								  }
					   } 
						  ?>
						
					</div>
				      <input class="wprpw_newgroup" type= "button" value ="<?php _e('New Group Conditions','wpp_text');?>" />
				</fieldset>	
					<?php  
					/*echo "<pre>";
					print_r($unserialized);*/
					 ?>
				<fieldset> <legend><?php _e('Filter by Time Period','wpp_text');?></legend>
				<label for="wprpw_timeperiod_option" ><?php _e('Set Time Period','wpp_text');?></label>
				<select name="wprpw_timeperiod_option" class="wprpw_timeperiod_option"  style="margin-left: 3%;">
					<option value="" >Please Select</option>
					<option value="lastndays" <?php if(!empty($unserialized['timeperiod_rule']['option'])) { selected($unserialized['timeperiod_rule']['option'],'lastndays'); }?>><?php _e('Last N days', 'wpp_text'); ?></option>
				    <option value="betweendate" <?php if(!empty($unserialized['timeperiod_rule']['option'])) { selected($unserialized['timeperiod_rule']['option'],'betweendate'); }?>><?php _e('Bewteen Dates', 'wpp_text'); ?></option>
				</select>

		         <br/><br/>
	             <div style="display:none" id="wprpw_lastndays_setting">
					 <label for="wprpw_lastndays_days" ><?php _e('Enter Number of Days','wpp_text');?></label>
					  <input type="text" name="wprpw_timeperiod[lastndays]" style="margin-left: 3%;" value="<?php if(!empty($unserialized['timeperiod_rule']['lastndays']['days'])) { echo $unserialized['timeperiod_rule']['lastndays']['days'];  }?>"  >
					
					 </div>
				    <div style="display:none" id="wprpw_betweendate_setting">
						<label for="wprpw_timeperiod_startdate" ><?php _e('Start Date','wpp_text');?> <span style="color:#F00;">*</span></label>
						<input type="text" class="regular-text" value="<?php if(!empty($unserialized['timeperiod_rule']['betweendate']['startdate'])) { echo $unserialized['timeperiod_rule']['betweendate']['startdate']; } ?>" name="wprpw_timeperiod[startdate]" id="wprpw_timeperiod_startdate" placeholder="<?php _e('Choose Start Date','wpp_text');?>" > 
						<label for="wprpw_timeperiod_enddate" ><?php _e('End Date','wpp_text');?> <span style="color:#F00;">*</span></label>
						<input type="text" class="regular-text" value="<?php if(!empty($unserialized['timeperiod_rule']['betweendate']['enddate'])) { echo $unserialized['timeperiod_rule']['betweendate']['enddate']; } ?>" name="wprpw_timeperiod[enddate]" id="wprpw_timeperiod_enddate" placeholder="<?php _e('Choose End Date','wpp_text');?>" > 
					</div>
				</fieldset>	
					</td>
					
					
				</tr>
				<tr>
					<td>
						<input type="submit" name="wprpw_update_rule" value="<?php _e('Update Rule','wpp_text');?>" class="button button-primary" />
					</td>
				</tr>
		</table>
</form>
</div>
</div>
</div>
</div>
<?php	
}
else
{
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>	
<h2><?php _e('Manage Rules','wpp_text');?></h2>
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
	
$manage_rule_list_table = new wprpw_manage_rule_table();
$manage_rule_list_table->prepare_items();
?>
<form method="post">
<?php
$manage_rule_list_table->display();
?> 
</form>
 
</div> 
<?php
}
