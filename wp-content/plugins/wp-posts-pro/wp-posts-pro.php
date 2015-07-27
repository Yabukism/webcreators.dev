<?php 
/*
Plugin Name: WP Posts Pro
Description: A super easy plugin to create posts listing.
Author: flippercode
Version: 2.2.5
Author URI: http://www.flippercode.com
*/

if(!class_exists('WP_Posts_Pro'))
{
	class WP_Posts_Pro
	{
		/**
		 * Construct the plugin object
		 */
				 
		public function __construct()
		{   
            add_action('admin_menu', array(&$this, 'wprpw_post_widget_menu'));
            add_shortcode('wprpw_display_layout', array(&$this, 'wprpw_display_layout'));
            add_action('widgets_init' , array(&$this, 'wprpw_display_widget'));
            add_action('admin_head' , array(&$this, 'wprpw_load_css'));
            add_action('wp_head' , array(&$this, 'wprpw_load_css'));
            add_action('add_meta_boxes', array(&$this, 'add_layout_pages'));
			add_action('save_post', array(&$this,'wpt_save_page_meta'), 1, 2);
			add_action( 'plugins_loaded', array(&$this,'wprpw_load_plugin_languages'));
			
        } // END public function __construct
        
        public function wprpw_load_plugin_languages() 
		{
			load_plugin_textdomain( 'wpp_text', false, dirname( plugin_basename( __FILE__ ) ).'/langs/' );
		}
        
		public function add_layout_pages() 
		{
			add_meta_box(
				'wprpw_layout_pages', 
				__('WP Posts Pro Rules','wpp_text'), 
				array(&$this,'wprpw_layout_pages'), 
				'page', 
				'side', 
				'default'
			);
		} // END public add_layout_pages()
			
		public function wprpw_layout_pages() {
			global $post,$wpdb;
			echo '<input type="hidden" name="wprpw_lout_id_noncename" id="wprpw_lout_id_noncename" value="'. wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
			
			$post_meta_id = get_post_meta($post->ID, '_wprpw_layout_id', true);
			
			$all_rules = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_rules where 1 =%d','1'));
			?>
			<div class="tabs-panel" id="pattern-all">
				<select name="wprpw_layout_id">
					<option><?php _e('Select Layout');?></option>
					<?php foreach($all_rules as $all_rule) { ?>
					<option value="<?php echo $all_rule->rule_id; ?>"<?php selected($all_rule->rule_id,$post_meta_id); ?>><?php echo $all_rule->rule_name; ?></option>
					<?php } ?>
				</select>
			</div>
			<?php 
		}	// END public wprpw_layout_pages()

		public function wpt_save_page_meta($post_id, $post) {
			$_POST['wprpw_lout_id_noncename'] = isset($_POST['wprpw_lout_id_noncename']) ? $_POST['wprpw_lout_id_noncename']  : "" ;
			if ( !wp_verify_nonce( $_POST['wprpw_lout_id_noncename'], plugin_basename(__FILE__) )) {
			return $post->ID;
			}
			
			if ( !current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
				
			$value = $_POST['wprpw_layout_id'];
			if(get_post_meta($post->ID, '_wprpw_layout_id', FALSE)) { 
				update_post_meta($post->ID, '_wprpw_layout_id', $value);
			} else {
				add_post_meta($post->ID, '_wprpw_layout_id', $value);
			}
			if(!$value) delete_post_meta($post->ID, '_wprpw_layout_id');
		} // END public wpt_save_page_meta()
        
        public function wprpw_load_css()
        {
        	
			wp_enqueue_style( 'wprpw_style', plugins_url('wprpw-style.css', __FILE__) ); 
			
		} // END public function wprpw_load_css()
		
        
        public function wprpw_display_widget()
        {
			register_widget('WP_Posts_Pro_Widget');
		} // END public function wprpw_display_widget()
        
    
         public function wprpw_post_excerpt_length($length) 
         {
	   
	         return $this->wprpw_post_lenght;
         }
        public function wprpw_new_excerpt_more($more)
        {
			return '';
		}
        public function wprpw_display_layout($atts, $content=NULL)
        {
        	ob_start();
			include(sprintf("%s/shortcode.php", dirname(__FILE__)));
			$content =  ob_get_contents();
 			ob_clean();
 
 			return $content;
		} // END public function wprpw_display_layout()
            
        // Start function for show rule of custom field
		public function wprpw_customerules_data($customkey = "",$customvalues = "", $indexkey = "",$wprpw_crgroup = "")
		  {
		
			     $customrule_data = "";
					 if($indexkey == 0)
					  $rowindexkey  = 1;
					  else
					  $rowindexkey =$indexkey;
					  
					  
			     $customrule_data = '<tr id="wprpw_row'.$rowindexkey.''.$customkey.'">
						<td><label for="wprpw_customfield">'.__('Custom Field','wpp_text').'</label></td>
					    <td><input type="text" value="'.$customvalues['name'].'" name="wprpw_customfield['.$indexkey.']['.$customkey.'][name]"  placeholder="'.__('Enter Custom Field Name','wpp_text').'" /> </td>
					    <td>
							 <select name="wprpw_customfield['.$indexkey.']['.$customkey.'][operation]">
								 <option value="=" '.selected($customvalues['operation'],'=', false).'>'.__('is equal to','wpp_text').'</option>
								 <option value="!=" '.selected($customvalues['operation'],'!=', false).'>'.__('is not equal to','wpp_text').'</option>
								 <option value=">" '.selected($customvalues['operation'],'>', false).'>'.__('greater than','wpp_text').'</option>
								 <option value=">=" '.selected($customvalues['operation'],'>=', false).'>'.__('greater than or equal to','wpp_text').'</option>
								 <option value="<" '.selected($customvalues['operation'],'<', false).'>'.__('less than','wpp_text').'</option>
								 <option value="<=" '.selected($customvalues['operation'],'<=', false).'>'.__('less than or equal to','wpp_text').'</option>
								 <option value="LIKE" '.selected($customvalues['operation'],'LIKE', false).'>'.__('LIKE','wpp_text').'</option>
								 <option value="NOT LIKE" '.selected($customvalues['operation'],'NOT LIKE', false).'>'.__('NOT LIKE','wpp_text').'</option>
								 <option value="IN" '.selected($customvalues['operation'],'IN', false).'>'.__('IN','wpp_text').'</option>
								 <option value="NOT IN" '.selected($customvalues['operation'],'NOT IN', false).'>'.__('NOT IN','wpp_text').'</option>
								 <option value="BETWEEN" '.selected($customvalues['operation'],'BETWEEN', false).'>'.__('BETWEEN','wpp_text').'</option>
								 <option value="NOT BETWEEN" '.selected($customvalues['operation'],'NOT BETWEEN', false).'>'.__('NOT BETWEEN','wpp_text').'</option>
								
						
					    </td>
					    <td><input type="text" value="'.stripcslashes($customvalues['value']).'" name="wprpw_customfield['.$indexkey.']['.$customkey.'][value]"  placeholder="'.__('Enter Custom Field Value','wpp_text').'" /> </td>';
				        
					    if($wprpw_crgroup)
					     $customrule_data .='<td class="wprpw_addgroup" style="cursor:pointer;"><input type ="button" value="'.__('Add More','wpp_text').'" ></td><td><input type="button" name="deleteca'.$rowindexkey.''.$customkey.'" value="Remove" onclick="wprpw_removeRowRule('.$rowindexkey.''.$customkey.','.$rowindexkey.')"></td>';
					     else
					    $customrule_data .= '<td class="wprpw_addrule" style="cursor:pointer;"><input type ="button" value="'.__('Add More','wpp_text').'" ></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
					     if($customkey > 0 && !$wprpw_crgroup )
					     $customrule_data .='<td><input type="button" name="deleteca'.$rowindexkey.''.$customkey.'" value="'.__('Remove','wpp_text').'" onclick="wprpw_removeRow('.$rowindexkey.''.$customkey.')"></td>';
					     

					    
					 $customrule_data .='</tr>';
					
					return $customrule_data;
		  }
		  // Start function for show rule of custom field
            
        public function wprpw_post_widget_menu()
        {
            // Add a page to manage this plugin's settings
        $page1 = add_menu_page(
        	    __('WP Posts Pro','wpp_text'), 
        	    __('WP Posts Pro','wpp_text'), 
        	    'manage_options', 
        	    'wpp-posts-pro', 
        	    array(&$this, 'wprpw_manage_layouts')
        	);
        $page2 = add_submenu_page(
				'wpp-posts-pro',
        	    __('Add New Rule','wpp_text'), 
        	    __('Add New Rule','wpp_text'), 
        	    'manage_options', 
        	    'wprpw-add-rule', 
        	    array(&$this, 'wprpw_add_rule')
         );
        $page3 = add_submenu_page(
				'wpp-posts-pro',
        	    __('Manage Rules','wpp_text'), 
        	    __('Manage Rules','wpp_text'), 
        	    'manage_options', 
        	    'wprpw-manage-rule', 
        	    array(&$this, 'wprpw_manage_rule')
        	);
        $page4 = add_submenu_page(
				'wpp-posts-pro',
        	    __('Create new layout','wpp_text'), 
        	    __('Create new layout','wpp_text'), 
        	    'manage_options', 
        	    'wprpw-create-layout', 
        	    array(&$this, 'wprpw_create_layout')
        	);
        $page5 = add_submenu_page(
				'wpp-posts-pro',
        	    __('Manage Layouts','wpp_text'), 
        	    __('Manage Layouts','wpp_text'), 
        	    'manage_options', 
        	    'wprpw-manage-layouts', 
        	    array(&$this, 'wprpw_manage_layouts')
        	);
       
        	
        $page6 = add_submenu_page(
				'wpp-posts-pro',
        	    __('Grids','wpp_text'), 
        	    __('Grids','wpp_text'), 
        	    'manage_options', 
        	    'wprpw-select-grid', 
        	    array(&$this, 'wprpw_select_gird')
        	);	
        	
          add_action( 'load-'.$page1, array($this, 'manange_layout_scripts' ) );	
          add_action( 'load-'.$page2, array($this, 'manange_layout_scripts' ) );	
          add_action( 'load-'.$page3, array($this, 'manange_layout_scripts' ) );	
          add_action( 'load-'.$page4, array($this, 'manange_layout_scripts' ) );	
          add_action( 'load-'.$page5, array($this, 'manange_layout_scripts' ) );
          add_action( 'load-'.$page6, array($this, 'manange_layout_scripts' ) );
          add_action( 'load-'.$page6, array($this, 'load_resources_for_responsive_grid' ) );	

        } // END public function wprpw_post_widget_menu()
        
        function load_resources_for_responsive_grid()
        {
			
		  wp_enqueue_script('responsive_grid_script', plugins_url('js/responsive_grid.js',__FILE__),'', '', true );
		 
			
		}
        
        function manange_layout_scripts(){
		
		  wp_enqueue_style( 'bootstrap_style', plugins_url('css/bootstrap.css', __FILE__) );
		  wp_enqueue_style( 'post_pro_style', plugins_url('css/postpro.css', __FILE__) );
		  wp_enqueue_script('jquery-ui-datepicker');
		  wp_enqueue_style( 'jquery-ui-datepicker-style', plugins_url('css/jquery-ui.css', __FILE__) );
		  
		}
		
		
        public function wprpw_select_gird()
        {
			
			if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
        	
        	include(sprintf("%s/create-layout.php", dirname(__FILE__)));
        	
        	include(sprintf("%s/responsive_grid_settings.php", dirname(__FILE__)));
        			
		}
        
        
        public function wprpw_post_widget_overview()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/plugin-overview.php", dirname(__FILE__)));
        } // END public function wprpw_post_widget_overview()
        
        public function wprpw_create_layout()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/create-layout.php", dirname(__FILE__)));
        	include(sprintf("%s/admin-script.php", dirname(__FILE__)));
        } // END public function wprpw_create_layout()
        
        public function wprpw_manage_layouts()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/manage-layout.php", dirname(__FILE__)));
        	include(sprintf("%s/admin-script.php", dirname(__FILE__)));
        } // END public function wprpw_create_layout()
        
        public function wprpw_add_rule()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/add-rule.php", dirname(__FILE__)));
        	include(sprintf("%s/admin-script.php", dirname(__FILE__)));

        } // END public function wprpw_add_rule()
        
        public function wprpw_manage_rule()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/manage-rule.php", dirname(__FILE__)));
        	include(sprintf("%s/admin-script.php", dirname(__FILE__)));
        	
        } // END public function wprpw_add_rule()
        
        
        public static function wprpw_network_propagate($network_wide)
        {
				$WP_Posts_Pro = new WP_Posts_Pro();
				if ( is_multisite() && $network_wide ) { // See if being activated on the entire network or one blog
					global $wpdb;

					// Get this so we can switch back to it later
					$currentblog = $wpdb->blogid;
					// For storing the list of activated blogs
					$activated = array();

					// Get all blogs in the network and activate plugin on each one
					$blog_ids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM {$wpdb->blogs} where 1 =%d",'1'));
					foreach ($blog_ids as $blog_id) {
						switch_to_blog($blog_id);
						$WP_Posts_Pro->jal_install();
						$activated[] = $blog_id;
					}
			 
					// Switch back to the current blog
					switch_to_blog($currentblog);

					// Store the array for a later function
					update_site_option('wpgmp_activated', $activated);
				} else { // Running on a single blog
					$WP_Posts_Pro->jal_install();
				}
		} // END public static function wprpw_network_propagate()
    	
		public function jal_install()
		{
			global $wpdb;	
			
			
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			
				$post_widget_layouts = "CREATE TABLE `".$wpdb->prefix."post_widget_layouts` (
										`layout_id` int(11) NOT NULL AUTO_INCREMENT,
										`layout_title` varchar(255) DEFAULT NULL,
										`layout_rule_id` text DEFAULT NULL,
										`layout_type` varchar(255) DEFAULT NULL,
										`layout_post_setting` text DEFAULT NULL,
										 PRIMARY KEY (`layout_id`)
										) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
				dbDelta( $post_widget_layouts );						
				//$wpdb->query($post_widget_layouts);
					
				
				$post_widget_rules = "CREATE TABLE `".$wpdb->prefix."post_widget_rules` (
							   `rule_id` int(11) NOT NULL AUTO_INCREMENT,
							   `rule_name` varchar(255) DEFAULT NULL,
							   `rule_type` varchar(255) DEFAULT NULL,
							   `rule_match` text DEFAULT NULL,
							   `rule_value` varchar(255) DEFAULT NULL,
							   `rule_number` varchar(255) DEFAULT NULL,
							   `rule_offset` varchar(255) DEFAULT NULL,
							   `rule_order_by` varchar(255) DEFAULT NULL,
							   `rule_order` varchar(255) DEFAULT NULL,
							   `rule_customfield` text DEFAULT NULL,
								PRIMARY KEY (`rule_id`)
							   ) ENGINE=MyISAM;";			   
				dbDelta( $post_widget_rules );			   
				
			   
			//$wpdb->query($rule_table);
		} // END public function wprpw_activate()
		
		public function wppro_rule_show(){
		
		 include (dirname(__FILE__).'/class-rule-generate.php');	
		 
		 return new Rule_Generate();
			
		}
		
    
    } // END class WP_Posts_Pro
} // END if(!class_exists('WP_Posts_Pro'))

if(class_exists('WP_Posts_Pro'))
{
	// Installation hooks
	register_activation_hook(__FILE__, array('WP_Posts_Pro', 'wprpw_network_propagate'));
	
	// instantiate the plugin class
	$WP_Posts_Pro = new WP_Posts_Pro();
	
	if( !is_admin() )
	$WP_Posts_Pro->wppro_rule_show();
}

class WP_Posts_Pro_Widget extends WP_Widget{
	public function __construct()
	{
		parent::__construct(
			'WP_Posts_Pro_Widget',
			__('WP Posts Pro','wpp_text'),
			array('description' => 'Display wordpress posts in sidebar.')
		);
	}
	
	function widget( $args, $instance )
	{
	   
		global $wpdb;
		extract($args);
		$layout_id=$instance['layout_id'];
		$title = apply_filters( 'widget_title', $instance['title'] );
		$layout = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."post_widget_layouts where layout_id='".$layout_id."'");
		echo $args['before_widget'];
		
		 if ( ! empty( $layout_id ) )
		{
		  echo $before_title . $instance['layout_title'] . $after_title;
		  echo do_shortcode('[wprpw_display_layout pagination="false" id='.$layout_id.']' );
		}

        echo $args['after_widget'];

		
		
		
	   }
	
	function update( $new_instance, $old_instance )
	{
		
		$instance=$old_instance;
		$instance['layout_id']=strip_tags($new_instance['layout_id']);
		$instance['layout_title'] = isset($instance['layout_title']) ? $instance['layout_title'] : "";
		$instance['layout_title']=strip_tags($new_instance['layout_title']);
	
		update_option('wpgmp_short_mapselect_marker' , $mark);
		return $instance;
	}
	
	function form( $instance )
	{
   $layout_title  = isset( $instance['layout_title'] ) ? esc_attr( $instance['layout_title'] ) : '';
	 global $wpdb;
	 $layout_records = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."post_widget_layouts where 1 = %d",'1'));
	?>
		<p>
			<label for="<?php echo $this->get_field_id('layout_title');?>" style="font-weight:bold;"><?php _e('Title','wpp_text');?> : </label> <br />
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'layout_title' ); ?>" value="<?php if(!empty($instance['layout_title']) && isset($instance['layout_title'])) { echo $instance['layout_title']; }?>" />
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('layout_id');?>" style="font-weight:bold;"><?php _e('Select Layout','wpp_text');?> : </label> 
			<select id="<?php echo $this->get_field_id('layout_id'); ?>" name="<?php echo $this->get_field_name( 'layout_id' ); ?>" style="width:80%;">
			<option value=""><?php _e('Select layout','wpp_text');?></option>
			<?php foreach($layout_records as $key => $layout_record){  ?>
			<option value="<?php echo $layout_record->layout_id; ?>"<?php selected($layout_record->layout_id,$instance['layout_id']); ?>><?php echo $layout_record->layout_title; ?></option>
			<?php } ?>	
			</select>
        </p> 
             
	<?php	
	}
}


include(dirname(__FILE__).'/wprpw-function.php');
//include(dirname(__FILE__).'/get-terms.php');

// END function wprpw_message()


add_action('wp_ajax_get_rule_match_options','wppro_get_rule_match_options');

add_action('wp_ajax_wppro_load_layout','wppro_load_layout');

add_action('wp_ajax_get_category_all_terms','wppro_get_category_all_terms');

add_action('wp_ajax_get_all_taxonomy_post_type','wppro_get_all_taxonomy_post_type');

function wppro_get_all_taxonomy_post_type() {

global $wpdb; 

$wprpw_rule_id = isset($_POST['wprpw_rule_id']) ? $_POST['wprpw_rule_id'] : "" ;

if($wprpw_rule_id!='')
{
$record = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_rules WHERE rule_id=%d',$wprpw_rule_id));
$unserialized = unserialize($record->rule_match);

}

	  $selected_current_post_type = isset($_POST['selected_current_post_type']) ? $_POST['selected_current_post_type'] : "";
	echo '<fieldset><legend>'.__('Filter by Taxonomies.','wpp_text').'</legend>';
	if($selected_current_post_type)
	{
		
		$taxonomy_names = get_object_taxonomies( $selected_current_post_type, 'objects' );
		if($taxonomy_names) {
			foreach ( $taxonomy_names  as $taxonomy ) { 
				
				if(in_array($taxonomy->name,array('post_tag','post_format')))				
				continue;	
			?>
				<input type="radio" name="rule_options[category_taxonomy]" class="display_all_category_terms" value="<?php echo $taxonomy->name; ?>"<?php if($selected_current_post_type == isset($unserialized['post_type']) ? $unserialized['post_type']: '') { checked(isset($unserialized['category_taxonomy']) ? $unserialized['category_taxonomy']: '',$taxonomy->name); } ?> /> <span class="value"><?php echo $taxonomy->labels->singular_name; ?></span>		
			<?php 
				
			} 
		} else {
			 _e('No taxonomies founds.','wpp_text');
		}
	} 
	echo '</fieldset>';	
exit;	
}

function wppro_load_layout(){

  if(!current_user_can('manage_options'))
  return false;
  
  $layout = $_POST['layout'];
  
  
  if( !isset($layout['wprpw_choose_layout']) )
  return false;
  
  $layout_id = $layout['wprpw_choose_layout'];
  
  $thumb_src = plugins_url('/thumb.jpg',__file__);
  
  $data = load_layout_fields_array();
  
  if( $layout['wprpw_hide_title'] == 'false')
  
  $data['title'] = wppro_apply_wrapper($layout['title_html'],'<a href="#">Lorem ipsum dolor sit amet</a>');
  
  if( $layout['wprpw_hide_excerpt'] == 'false' )
  $data['content'] = wppro_apply_wrapper($layout['content_html'],'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');
  
  if( $layout['wprpw_hide_thumbnail'] == 'false' ){
	  
    $thumb_width = $layout['thumb_width'] ? $layout['thumb_width'] : 120;
    
    $thumb_height = $layout['thumb_height'] ? $layout['thumb_height'] : 68;
	
	$data['thumbnail'] = '<a href="#"><image src="'.$thumb_src.'" style="width:'.$thumb_width.'px;height:'.$thumb_height.'px;" /></a>';  
	  
  }

  if( $layout['content_display'] == 'full'){
	
	if($layout['wprpw_hide_read_more_link'] == 'false')  
	$layout['wprpw_hide_read_more_link'] = 'true';
  }
    
  if( $layout['wprpw_hide_read_more_link'] != 'true' ){
    
    $data['read_more'] = wppro_apply_wrapper($layout['readmore_html'],'<a class="read-more" href="#">'.__("Read More...",'wpp_text').'</a>');
    
  }
  
  if($data['content'] && $layout['content_display'] == 'full' )
  $data['content'] = wppro_apply_wrapper($layout['content_html'],'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');  


  $meta_data = array();
 

   if(isset($layout['date_format']) &&  $layout['date_format']=='' )
  $date_format = 'F,d Y T';
  else
  $date_format = isset($layout['date_format']) ? $layout['date_format'] : "";

  

  if( $layout['wprpw_hide_publish_date'] == 'false' )
  {
	
	  $meta_data[] = wppro_apply_wrapper($layout['date_html'],date($date_format));
	  
  }
  
  
  if( $layout['wprpw_hide_author'] == 'false' )
  $meta_data[] = wppro_apply_wrapper($layout['author_html'],'Admin');


  if($meta_data)
  $data['meta_data'] = implode(", ", $meta_data);
  
  
  
  if( $layout['wprpw_hide_post_categories'] == 'false' )
    $data['categories'] = wppro_apply_wrapper($layout['category_html'],'<a href="#" title="View all posts in Uncategorized" rel="category">Uncategorized</a>, <a href="#" title="View all posts in News" rel="category">News</a> ,<a href="#" title="View all posts in Slider" rel="category">Slider</a>');

  
  if( $layout['wprpw_hide_post_tags'] == 'false' )
  $data['tags']	= wppro_apply_wrapper($layout['tags_html'],'<a href="#" rel="tag">Aside</a>, <a href="#" rel="tag">Video</a>, <a href="#" rel="tag">Image</a>');		 


  if( ! empty($layout['layout_template']) && strlen($layout['layout_template']) > 20 ){
	
	$layout_content = stripslashes($layout['layout_template']);  
  
  }else{
   
   $layout_settings = isset($layout_settings) ? $layout_settings : "" ;
    $layout_content = get_layout_content($layout_id, $layout_settings);
  	  
  }
  
  $json_data['template'] = $layout_content;
  
  foreach( $data as $key => $value){
	
	$layout_content =   str_replace("{{$key}}", $value, $layout_content);
  }
  
  $output = '<div id="layout_'.$layout_id.'"><div class="wp-posts-pro">';
  
  $output .=  $layout_content; 
  
  $output .= '</div></div>';
  
  $json_data['html'] = $output;
  
  echo json_encode($json_data);
 
exit;

}





function wppro_get_rule_match_options() {
	
	  global $wpdb;
	  $_POST['r_type'] = isset($_POST['r_type']) ? $_POST['r_type'] : "" ;
	  $_POST['r_id'] = isset($_POST['r_id']) ? $_POST['r_id'] : "" ;
	  $rule_type = $_POST['r_type'];
	  $rule_id 	 = $_POST['r_id'];
	  $options = "";
	  if(!empty($rule_id))
	  {
		$record = $wpdb->get_row($wpdb->prepare('SELECT rule_value FROM '.$wpdb->prefix.'post_widget_rules WHERE rule_id=%d',$rule_id));
	  }
	  
	  $options.="<option value='all'>".__('All','wpp_text')."</option>";
	  
	  if( $rule_type=='post' )
	  {
		  $all_posts=get_posts();
		  foreach($all_posts as $all_post)
		  $options.="<option value='$all_post->ID' ".selected($all_post->ID,$record->rule_value).">$all_post->post_name</option>";
	  }
	  elseif( $rule_type=='post_category' )
	  {
		  $all_categorys=get_categories();
		  foreach($all_categorys as $category)
		  $options.="<option value='$category->term_id' ".selected($category->term_id,$record->rule_value).">$category->name</option>";
	  } 
	  else
	  {
		  $all_posts=get_posts('post_type='.$rule_type);
		  foreach($all_posts as $post)
		  $options.="<option value='$post->ID'  ".selected($post->ID,isset($record->rule_value) ? $record->rule_value : "").">$post->post_title</option>";
	  } 
	  echo $options;
exit;	
}


function wppro_get_category_all_terms()
{
	$selected_taxonomy = isset($_POST['selected_taxonomy']) ? $_POST['selected_taxonomy'] : "" ;;
	
	if($selected_taxonomy)
	{
		echo '<fieldset><legend>'.__('Filter by','wpp_text').' '.$selected_taxonomy.'</legend>';
		echo wppro_Category(0,$selected_taxonomy,'');
		echo '</fieldset>';
	}	
exit;	
}


function wppro_Category($cat,$taxonomy, $level='')
{  
global $wpdb; 
$wprpw_rule_id = isset($_POST['wprpw_rule_id']) ? $_POST['wprpw_rule_id'] : "";

if($wprpw_rule_id!='')
{
$record = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'post_widget_rules WHERE rule_id=%d',$wprpw_rule_id));
$unserialized = unserialize($record->rule_match);
}

$sql = "SELECT txno.term_taxonomy_id,txno.term_id as tid,tn.name as name,tn.slug as slug from ".$wpdb->prefix."term_taxonomy as txno left join ".$wpdb->prefix."terms as tn ON txno.term_id = tn.term_id WHERE taxonomy='".$taxonomy."' and parent=".$cat;
$qry = $wpdb->get_results($sql);

  $arr =  array();  
	 if(count($qry) >= 1)
	 {
		   if($cat>0){
			  $level .= '---&nbsp;---';
			}
		   	 	
		   echo '<ul>';
		  
		   foreach($qry as $q)
		   { 
			   ?>
		  <li>	
			  <?php
				if(isset($unserialized['category_term']) && $unserialized['category_term']!='') {
					if(in_array($q->tid,$unserialized['category_term'])) { ?>
						<?php echo $level; ?>&nbsp;<input type="checkbox" name="rule_options[category_term][]" value="<?php echo $q->tid; ?>" checked="checked" />&nbsp;<?php echo $q->name; ?><br />
			   <?php } else { ?>
						<?php echo $level; ?>&nbsp;<input type="checkbox" name="rule_options[category_term][]" value="<?php echo $q->tid; ?>" />&nbsp;<?php echo $q->name; ?><br />
			   <?php } } else { ?>
						<?php echo $level; ?>&nbsp;<input type="checkbox" name="rule_options[category_term][]" value="<?php echo $q->tid; ?>" />&nbsp;<?php echo $q->name; ?><br />
			   <?php } ?>
		  </li>
		  <?php
		  
		   wppro_Category($q->tid, $taxonomy, $level);
			 
		  } 
		  echo '</ul>';
	 }
 }
