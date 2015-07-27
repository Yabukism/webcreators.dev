<?php
/**
 * This class used to manage routes in backend.
 * @author Flipper Code <hello@flippercode.com>
 * @version 1.0.0
 * @package Maps
 */

class Wpgmp_Route_Table extends WP_List_Table {
    var $table_data,$found_data;
    function __construct(){
    	global $status, $page,$wpdb;
	    parent::__construct( array(
	            'singular'  => __( 'googlemap', 'wpgmp_google_map' ),    
	            'plural'    => __( 'googlemaps', 'wpgmp_google_map' ),  
	            'ajax'      => false       
	    ) );

		if( $_GET['page']=='wpgmp_manage_routes' &&  !empty($_POST['s']) )
		{
			$query = "SELECT * FROM ".$wpdb->prefix."map_routes WHERE location_title LIKE '%".$_POST['s']."%' OR location_address LIKE '%".$_POST['s']."%' OR location_latitude LIKE '%".$_POST['s']."%' OR location_longitude LIKE '%".$_POST['s']."%'";
		}
		else
		{
			$query = "SELECT * FROM ".$wpdb->prefix."map_routes ORDER BY route_id DESC";
		}
		
	 	$this->table_data = $wpdb->get_results($query,ARRAY_A );
    	add_action( 'admin_head', array( &$this, 'admin_header' ) );            
    }
	
	function admin_header() {
	    $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
	    if( 'location' != $page )
	    return;
    	echo '<style type="text/css">';
    	echo '.wp-list-table .column-route_title  { width: 20%; }';
	 	echo '.wp-list-table .column-route_start_location  { width: 20%;}';
	 	echo '.wp-list-table .column-route_end_location  { width: 20%;}';
    	echo '</style>';
  	}
  
	function no_items() {
	    _e( 'No Records for Manage Routes.' ,'wpgmp_google_map');
	}
	
  	function column_default( $item, $column_name ) {
	    switch( $column_name ) {
			case 'route_title': 
			case 'route_start_location':
			case 'route_end_location':
		    return $this->custom_column_value($column_name,$item);
		    default:
		    return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
	    }
  	}

	function custom_column_value($column_name,$item) {
		global $wpdb;
		if( $column_name=='route_start_location')
		{
			$start_location = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."map_locations WHERE location_id=".$item['route_start_location']);	
			if($start_location->location_title)
			return $start_location->location_title;
			else
			return $start_location->location_address;	
		}
		elseif($column_name=='route_end_location')
		{
			$end_location = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."map_locations WHERE location_id=".$item['route_end_location']);	
			if($end_location->location_title)
			return $end_location->location_title;
			else
			return $end_location->location_address;
		}
		else
		return $item[ $column_name ];
	}

	function get_sortable_columns() {
	  	$sortable_columns = array(
		  	'route_title '   => array('route_title ',false),
		  	'route_start_location '   => array('route_start_location ',false),
			'route_end_location '   => array('route_end_location ',false)
	  	);
	  	return $sortable_columns;
	}

	function get_columns(){
        $columns = array(
           	'cb'        => '<input type="checkbox" />',
			'route_title'      => __( 'Title', 'wpgmp_google_map' ),
			'route_start_location'      => __( 'Start Location', 'wpgmp_google_map' ),
			'route_end_location'      => __( 'End Location', 'wpgmp_google_map' )
        );
        return $columns;
    }

	function usort_reorder( $a, $b ) {
		// If no sort, default to title
		$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'route_title';
		// If no order, default to asc
		$order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
		// Determine sort order
		$result = strcmp( $a[$orderby], $b[$orderby] );
		// Send final sort direction to usort
		return ( $order === 'asc' ) ? $result : -$result;
	}

	function column_route_title($item){
	  	$actions = array(
	        'edit'      => sprintf('<a href="?page=%s&action=%s&route_id=%s">Edit</a>',$_REQUEST['page'],'edit',$item['route_id']),
	        'delete'    => sprintf('<a href="?page=%s&action=%s&route_id=%s">Delete</a>',$_REQUEST['page'],'delete',$item['route_id']),
	    );
	  	return sprintf('%1$s %2$s', $item['route_title'], $this->row_actions($actions) );
	}

	function get_bulk_actions() {
	  $actions = array(
	    'delete' => 'Delete'
	  );
	  return $actions;
	}

	function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="route_id[]" value="%s" />', $item['route_id']
        );
	}

	function prepare_items() {
		$columns  = $this->get_columns();
		$hidden   = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );
		usort( $this->table_data, array( &$this, 'usort_reorder' ) );
		
		$user = get_current_user_id();
		$screen = get_current_screen();
		$option = $screen->get_option('per_page', 'option');
		$screen_per_page = get_user_meta($user, $option, true);
		if(!empty($screen_per_page) && $screen_per_page > 0 )
		   $per_page = $screen_per_page;
		else  
		$per_page = 10;
		$current_page = $this->get_pagenum();
		$total_items = count( $this->table_data );
		// only ncessary because we have sample data
		$this->found_data = array_slice( $this->table_data,( ( $current_page-1 )* $per_page ), $per_page );
		$this->set_pagination_args( array(
		    'total_items' => $total_items,                  //WE have to calculate the total number of items
		    'per_page'    => $per_page                     //WE have to determine how many items to show on a page
		) );
		$this->items = $this->found_data;
	}
}

/**
 * This function used to edit route in backend.
 * @author Flipper Code <hello@flippercode.com>
 * @version 1.0.0
 * @package Maps
 */

function wpgmp_manage_routes()
{

global $wpdb; 

if( !empty($_GET['action']) && $_GET['action']=='delete' && !empty($_GET['route_id']) )
{
	$id = (int)$_GET['route_id'];
	$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."map_routes WHERE route_id=%d",$id));
	$success = __( 'Selected record deleted successfully.', 'wpgmp_google_map' );
}

if( !empty($_POST['action']) && $_POST['action'] == 'delete' && !empty($_POST['route_id']) )
{
	foreach($_POST['route_id'] as $id)
	{
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."map_routes WHERE route_id=%d",$id));					
	}
	$success = __( 'Selected record deleted successfully.', 'wpgmp_google_map' );
}

if( isset($_POST['submit']) && $_POST['submit']=='Update Route' )
{
	
	if( empty($_POST['route_title']) )
	{
		$error[]= __( 'Please enter route title.', 'wpgmp_google_map' );
	}

	if( empty($_POST['route_marker_draggable']) ) 
	{
		$_POST['route_marker_draggable'] = 'false';
	}
	else
	{
		$_POST['route_marker_draggable'] = $_POST['route_marker_draggable'];
	}

	if( empty($_POST['route_custom_marker']) ) 
	{
		$_POST['route_custom_marker'] = 'false';
	}
	else
	{
		$_POST['route_custom_marker'] = $_POST['route_custom_marker'];
	}

	if( empty($_POST['route_optimize_waypoints']) ) 
	{
		$_POST['route_optimize_waypoints'] = 'false';
	}
	else
	{
		$_POST['route_optimize_waypoints'] = $_POST['route_optimize_waypoints'];
	}
				
	if( empty($error) )
	{
		$map_routes_update_table=$wpdb->prefix."map_routes";
		$wpdb->update( 
		$map_routes_update_table, 
		array( 
		'route_title' 				=> htmlspecialchars(stripslashes($_POST['route_title'])),
		'route_stroke_color' 		=> htmlspecialchars(stripslashes($_POST['route_stroke_color'])),
		'route_stroke_opacity' 		=> htmlspecialchars(stripslashes($_POST['route_stroke_opacity'])),
		'route_stroke_weight' 		=> htmlspecialchars(stripslashes($_POST['route_stroke_weight'])),
		'route_travel_mode' 		=> htmlspecialchars(stripslashes($_POST['route_travel_mode'])),
		'route_unit_system'			=> htmlspecialchars(stripslashes($_POST['route_unit_system'])),
		'route_marker_draggable'	=> htmlspecialchars(stripslashes($_POST['route_marker_draggable'])),
		'route_custom_marker'		=> htmlspecialchars(stripslashes($_POST['route_custom_marker'])),
		'route_optimize_waypoints'	=> htmlspecialchars(stripslashes($_POST['route_optimize_waypoints'])),
		'route_start_location' 		=> htmlspecialchars(stripslashes($_POST['route_start_location'])),
		'route_end_location' 		=> htmlspecialchars(stripslashes($_POST['route_end_location'])),
		'route_way_points'			=> serialize($_POST['route_way_points'])
		), 
		array( 'route_id' => $_GET['route_id'] ) 
		);
	
		$success = __( 'Route updated successfully.', 'wpgmp_google_map' );
	}
}

?>
<?php
if( !empty($_GET['action']) && $_GET['action']=='edit' && !empty($_GET['route_id']) )
{
$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."map_locations");
$group_results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."group_map");
$route_detail = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."map_routes WHERE route_id=%d",$_GET['route_id']));
$all_way_points = unserialize($route_detail->route_way_points);
?>

<script>   
jQuery(document).ready(function($) {
    $('.filter_location').change(function () {
		location_value=$(this).val();
	    if(location_value>0)		
	    {
			$('li[class^="group"]').hide();
	        $('li[class="group'+$(this).val()+'"]').show();
	    }
	    else
	    {
	    	$('li[class^="group"]').show();
	    }
	}); 
});	   
</script>

<div class="wpgmp-wrap"> 
	<div class="col-md-11">  
		<div id="icon-options-general" class="icon32"><br/></div>
		<h3>
			<span class="glyphicon glyphicon-asterisk"></span><?php _e('Edit Route', 'wpgmp_google_map')?>
		</h3> 
		<div class="wpgmp-overview">
			<?php
			if( !empty($error) )
			{
				$error_msg=implode('<br>',$error);
				
				wpgmp_showMessage($error_msg,true);
			}
			if( !empty($success) )
			{
			    wpgmp_showMessage($success);
			}
			?>
			<form method="post">
				<div class="form-horizontal">

					<div class="row">
			            <div class="col-md-3">
			              	<label for="title"><?php _e('Route Title', 'wpgmp_google_map')?><span style="color:red;">*<span></label>
			            </div>
			            <div class="col-md-7">
			               	<input type="text" name="route_title" class="form-control" value="<?php echo $route_detail->route_title; ?>" />
			                <p class="description"><?php _e('Please enter route title.', 'wpgmp_google_map')?></p>
			            </div>
			        </div>

			        <div class="row">
			            <div class="col-md-3">
			              	<label for="title"><?php _e('Stroke Color', 'wpgmp_google_map')?></label>
			            </div>
			            <div class="col-md-7">
			               	<input type="text" value="<?php echo $route_detail->route_stroke_color; ?>" name="route_stroke_color" class="color {pickerClosable:true} form-control" autocomplete="off">
			                <p class="description"><?php _e('Choose route direction stroke color.(Default is Blue)', 'wpgmp_google_map')?></p>
			            </div>
			        </div>

			        <div class="row">
			            <div class="col-md-3">
			              <label for="title"><?php _e('Stroke Opacity', 'wpgmp_google_map')?></label>
			            </div>
			            <div class="col-md-7">
			              <select name="route_stroke_opacity" class="form-control-select">			              	
			                <option value="1"<?php if(!empty($route_detail->route_stroke_opacity)) { echo selected($route_detail->route_stroke_opacity,1); } ?>>1</option>
			                <option value="0.9"<?php if(!empty($route_detail->route_stroke_opacity)) { echo selected($route_detail->route_stroke_opacity,0.9); } ?>>0.9</option>
			                <option value="0.8"<?php if(!empty($route_detail->route_stroke_opacity)) { echo selected($route_detail->route_stroke_opacity,0.8); } ?>>0.8</option>
			                <option value="0.7"<?php if(!empty($route_detail->route_stroke_opacity)) { echo selected($route_detail->route_stroke_opacity,0.7); } ?>>0.7</option>
			                <option value="0.6"<?php if(!empty($route_detail->route_stroke_opacity)) { echo selected($route_detail->route_stroke_opacity,0.6); } ?>>0.6</option>
			                <option value="0.5"<?php if(!empty($route_detail->route_stroke_opacity)) { echo selected($route_detail->route_stroke_opacity,0.5); } ?>>0.5</option>
			                <option value="0.4"<?php if(!empty($route_detail->route_stroke_opacity)) { echo selected($route_detail->route_stroke_opacity,0.4); } ?>>0.4</option>
			                <option value="0.3"<?php if(!empty($route_detail->route_stroke_opacity)) { echo selected($route_detail->route_stroke_opacity,0.3); } ?>>0.3</option>
			                <option value="0.2"<?php if(!empty($route_detail->route_stroke_opacity)) { echo selected($route_detail->route_stroke_opacity,0.2); } ?>>0.2</option>
			                <option value="0.1"<?php if(!empty($route_detail->route_stroke_opacity)) { echo selected($route_detail->route_stroke_opacity,0.1); } ?>>0.1</option>
			              </select>
			              <p class="description"><?php _e('Please select route direction stroke opacity.', 'wpgmp_google_map')?></p>
			            </div>
			        </div>

			        <div class="row">
			            <div class="col-md-3">
			              <label for="title"><?php _e('Stroke Weight', 'wpgmp_google_map')?></label>
			            </div>
			            <div class="col-md-7">
			              <select name="route_stroke_weight" class="form-control-select">
			              	<?php 
		                  	for ($sw=10; $sw>=1; $sw--)
		                  	{ 
		                  		?>
		                  		<option value="<?php echo $sw; ?>"<?php if(!empty($route_detail->route_stroke_weight)) { echo selected($route_detail->route_stroke_weight,$sw); } ?>><?php echo $sw; ?></option>
								<?php
							} 
							?>
			              </select>
			              <p class="description"><?php _e('Please select route direction stroke weight.', 'wpgmp_google_map')?></p>
			            </div>
			        </div>

			        <div class="row">
		                <div class="col-md-3">
		                  <label for="title"><?php _e('Travel Modes', 'wpgmp_google_map')?></label>
		                </div>
		                <div class="col-md-7">
		                  <select name="route_travel_mode" class="form-control-select"> 
		                    <option value="DRIVING"<?php echo selected($route_detail->route_travel_mode,'DRIVING'); ?>><?php _e('Driving', 'wpgmp_google_map')?></option>
		                    <option value="WALKING"<?php echo selected($route_detail->route_travel_mode,'WALKING'); ?>><?php _e('Walking', 'wpgmp_google_map')?></option>
		                    <option value="BICYCLING"<?php echo selected($route_detail->route_travel_mode,'BICYCLING'); ?>><?php _e('Bicycling', 'wpgmp_google_map')?></option>
		                    <option value="TRANSIT"<?php echo selected($route_detail->route_travel_mode,'TRANSIT'); ?>><?php _e('Transit', 'wpgmp_google_map')?></option>
		                  </select>
		                  <p class="description"><?php _e('Please select travel mode.', 'wpgmp_google_map')?></p>
		                </div>
		            </div>

		            <div class="row">
		                <div class="col-md-3">
		                  <label for="title"><?php _e('Unit Systems', 'wpgmp_google_map')?></label>
		                </div>
		                <div class="col-md-7">
		                  <select name="route_unit_system" class="form-control-select">
		                    <option value="METRIC"<?php echo selected($route_detail->route_unit_system,'METRIC'); ?>><?php _e('METRIC', 'wpgmp_google_map')?></option>
		                    <option value="IMPERIAL"<?php echo selected($route_detail->route_unit_system,'IMPERIAL'); ?>><?php _e('IMPERIAL', 'wpgmp_google_map')?></option>
		                  </select>
		                  <p class="description"><?php _e('Please select travel mode.', 'wpgmp_google_map')?></p>
		                </div>
		            </div>

		            <div class="row">
		              <div class="col-md-3">
		                <label for="title"><?php _e('Draggable', 'wpgmp_google_map')?></label>
		              </div>
		              <div class="col-md-7">
		              	<p class="description">
		              	<input type="checkbox" name="route_marker_draggable" value="true"<?php checked($route_detail->route_marker_draggable,'true') ?> />
		                <?php _e('Please check to enable marker draggable.', 'wpgmp_google_map')?>
		            	</p>
		              </div>
		            </div>

		            <div class="row">
		              <div class="col-md-3">
		                <label for="title"><?php _e('Display Custom Marker', 'wpgmp_google_map')?></label>
		              </div>
		              <div class="col-md-7">
		              	<p class="description">
		              	<input type="checkbox" name="route_custom_marker" value="true"<?php checked($route_detail->route_custom_marker,'true') ?> />
		                <?php _e('Please check to display custom markers.', 'wpgmp_google_map')?>
		            	</p>
		              </div>
		            </div>

		            <div class="row">
		              <div class="col-md-3">
		                <label for="title"><?php _e('Optimize Waypoints', 'wpgmp_google_map')?></label>
		              </div>
		              <div class="col-md-7">
		              	<p class="description">
		              	<input type="checkbox" name="route_optimize_waypoints" value="true"<?php checked($route_detail->route_optimize_waypoints,'true') ?> />
		                <?php _e('Please check to enable optimize waypoints.', 'wpgmp_google_map')?>
		            	</p>
		              </div>
		            </div>

				    <div class="row">
			            <div class="col-md-3">
			              <label for="title"><?php _e('Start Location', 'wpgmp_google_map')?></label>
			            </div>  
						<div class="col-md-7">
							<?php
							echo '<select name="route_start_location" class="form-control">';

							if( !empty($results) )
							{
						        for($i = 0; $i < count($results); $i++)
								{
									?>
									
			                		<option value="<?php echo $results[$i]->location_id; ?>"<?php echo selected($route_detail->route_start_location,$results[$i]->location_id); ?>><?php echo $results[$i]->location_title; ?></option>
			              	
						        	<?php   
									}
				            }
				            else
				            {
							?>
				              <?php _e('Seems you don\"t have any location right now', 'wpgmp_google_map'); ?> &nbsp; <a href="<?php echo admin_url('admin.php?page=wpgmp_add_location') ?>"> <?php _e('Click here', 'wpgmp_google_map'); ?> </a> &nbsp; <?php _e('to add a location now.', 'wpgmp_google_map'); ?>
				            <?php  
							}

							echo '</select>';
							?>
							<p class="description"><?php _e('Please select start location.', 'wpgmp_google_map')?></p>
						</div>	
					</div>

					<div class="row">
			            <div class="col-md-3">
			              <label for="title"><?php _e('End Location', 'wpgmp_google_map')?></label>
			            </div>  
						<div class="col-md-7">
							<?php
							echo '<select name="route_end_location" class="form-control">';

							if( !empty($results) )
							{
						        for($i = 0; $i < count($results); $i++)
								{
									?>
									
			                		<option value="<?php echo $results[$i]->location_id; ?>"<?php echo selected($route_detail->route_end_location,$results[$i]->location_id); ?>><?php echo $results[$i]->location_title; ?></option>
			              	
						        	<?php   
									}
				            }
				            else
				            {
							?>
				              <?php _e('Seems you don\"t have any location right now', 'wpgmp_google_map'); ?> &nbsp; <a href="<?php echo admin_url('admin.php?page=wpgmp_add_location') ?>"> <?php _e('Click here', 'wpgmp_google_map'); ?> </a> &nbsp; <?php _e('to add a location now.', 'wpgmp_google_map'); ?>
				            <?php  
							}

							echo '</select>';
							?>
							<p class="description"><?php _e('Please select end location.', 'wpgmp_google_map')?></p>
						</div>	
					</div>


					<fieldset>
					    <legend>
					    	<?php _e('Way Points', 'wpgmp_google_map')?>
					    	<span style="float:right;"><?php _e('Filter :', 'wpgmp_google_map')?> 
					    	<select name="filter_location" class="filter_location">  
					        	<option value=""><?php _e('Select group', 'wpgmp_google_map')?></option>
							    <?php
							    if( !empty($group_results) )
						    	{
						        	for($i = 0; $i < count($group_results); $i++)
						        	{
							    ?>
					        		<option value="<?php echo $group_results[$i]->group_map_id; ?>"<?php if(!empty($_POST['location_group_map'])) { selected($group_results[$i]->group_map_id,$_POST['location_group_map']); } ?>><?php echo $group_results[$i]->group_map_title; ?></option>
							    <?php
							    	}
							    }	
							    ?>
							</select>
						</legend>

						<div class="row"> 
							<div class="col-md-12">
							<?php
							echo '<ul>';
							if( !empty($results) )
							{
						        for($i = 0; $i < count($results); $i++)
								{
									?>
									<li class="group<?php echo $results[$i]->location_group_map; ?>">
										<?php 
										if(empty($all_way_points))
										{
											?>
												<input type="checkbox" name="route_way_points[]" value="<?php echo $results[$i]->location_id; ?>" />&nbsp;<?php echo $results[$i]->location_title; ?>
											<?php
										}
										else
										{	
											if(in_array($results[$i]->location_id, $all_way_points)) 
											{ 
											?>
			                					<input type="checkbox" checked="checked" name="route_way_points[]" value="<?php echo $results[$i]->location_id; ?>" />&nbsp;<?php echo $results[$i]->location_title; ?>
			              					<?php 
			              					} 
			              					else 
			              					{ 
			              					?>
			              						<input type="checkbox" name="route_way_points[]" value="<?php echo $results[$i]->location_id; ?>" />&nbsp;<?php echo $results[$i]->location_title; ?>
			              					<?php
			              					}
			              				}
			              				?>
			              			</li>
						        	<?php   
									}
				            }
				            else
				            {
							?>
				              <?php _e('Seems you don\"t have any location right now', 'wpgmp_google_map'); ?> &nbsp; <a href="<?php echo admin_url('admin.php?page=wpgmp_add_location') ?>"> <?php _e('Click here', 'wpgmp_google_map'); ?> </a> &nbsp; <?php _e('to add a location now.', 'wpgmp_google_map'); ?>
				            <?php  
							}
							echo '</ul>';
							?>
							</div>	
						</div>
					</fieldset>

					<div class="row">
					    <div class="col-md-3">
					    	<input type="submit" name="submit" id="submit" class="btn btn-lg btn-primary" value="<?php _e('Update Route', 'wpgmp_google_map')?>"/>
					  	</div>
				    </div> 

				</div>
			</form>
		</div>
	</div>
</div>				
<?php
}
else
{
?>
<div class="wpgmp-wrap">
	<div class="col-md-12">   
		<div id="icon-options-general" class="icon32"><br></div>
		<h3><span class="glyphicon glyphicon-asterisk"></span><?php _e('Manage Routes', 'wpgmp_google_map')?></h3>
		<?php
		$route_list_table = new Wpgmp_Route_Table();
		$route_list_table->prepare_items();
		?>
		<form method="post">
		<?php
		$route_list_table->search_box('search', 'search_id');
		$route_list_table->display();
		?> 
		</form> 
	</div>
</div> 
<?php
}
}
