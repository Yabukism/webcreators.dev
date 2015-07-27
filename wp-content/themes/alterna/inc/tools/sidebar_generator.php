<?php
/*
Copyright (C) 2009 Kyle Robert Getson, kylegetson.com and getson.info

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class sidebar_generator {
	
	function sidebar_generator(){
		add_action('init',array('sidebar_generator','init'));
		add_action('admin_menu',array('sidebar_generator','admin_menu'));
		add_action('admin_print_scripts', array('sidebar_generator','admin_print_scripts'));
		add_action('wp_ajax_add_sidebar', array('sidebar_generator','add_sidebar') );
		add_action('wp_ajax_remove_sidebar', array('sidebar_generator','remove_sidebar') );
	}
	
	public static function init() {
		//go through each sidebar and register it
	    $sidebars = sidebar_generator::get_sidebars();
	    

	    if(is_array($sidebars)){
			foreach($sidebars as $sidebar){
				$sidebar_class = sidebar_generator::name_to_class($sidebar);
				register_sidebar(array(
					'id' => $sidebar,
					'name'=>$sidebar,
					'before_widget' => '<div id="%1$s" class="content-spacing widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3><div class="line"><span class="left-line"></span><span class="right-line"></span></div><div class="clear"></div>'
		    	));
			}
		}
	}
	
	public static function admin_print_scripts(){
		wp_print_scripts( array( 'sack' ));
		?>
			<script>
				function add_sidebar( sidebar_name )
				{
					var mysack = new sack("<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );    
				
				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "add_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
					//mysack.onCompletion = function() {alert('Ajax success. Can add sidebar' )};
				  	mysack.runAJAX();
					return true;
				}
				
				function remove_sidebar( sidebar_name,num )
				{
					var mysack = new sack("<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );    
				
				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "remove_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.setVar( "row_number", num );
				  	mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot remove sidebar' )};
					//mysack.onCompletion = function() {alert('Ajax success. Can remove sidebar' )};
				  	mysack.runAJAX();
					//alert('hi!:::'+sidebar_name);
					return true;
				}
			</script>
		<?php
	}
	
	public static function add_sidebar(){
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);
		$id = sidebar_generator::name_to_class($name);
		if(isset($sidebars[$id])){
			die("alert('Sidebar already exists, please use a different name.')");
		}
		
		$sidebars[$id] = $name;
		sidebar_generator::update_sidebars($sidebars);
		
		$js = "
			var tbl = document.getElementById('sbg_table');
			var lastRow = tbl.rows.length;
			// if there's no header row in the table, then iteration = lastRow + 1
			var iteration = lastRow;
			var row = tbl.insertRow(lastRow);
			
			// left cell
			var cellLeft = row.insertCell(0);
			var textNode = document.createTextNode('$name');
			cellLeft.appendChild(textNode);
			
			//middle cell
			var cellLeft = row.insertCell(1);
			var textNode = document.createTextNode('$id');
			cellLeft.appendChild(textNode);
			
			//var cellLeft = row.insertCell(2);
			//var textNode = document.createTextNode('[<a href=\'javascript:void(0);\' onclick=\'return remove_sidebar_link($name);\'>Remove</a>]');
			//cellLeft.appendChild(textNode)
			
			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('input');
			//removeLink.setAttribute('onclick', 'remove_sidebar_link(\'$name\')');
			removeLink.setAttribute('type', 'button');
			removeLink.setAttribute('class', 'button-primary sidebar-remove-btn');
			removeLink.setAttribute('value', 'remove');

      		cellLeft.appendChild(removeLink);
			
			add_sidebar_link_listener();
			
		";
		
		
		die( "$js");
	}
	
	public static function remove_sidebar(){
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);
		$id = sidebar_generator::name_to_class($name);
		if(!isset($sidebars[$id])){
			die("alert('Sidebar does not exist.')");
		}
		$row_number = $_POST['row_number'];
		unset($sidebars[$id]);
		sidebar_generator::update_sidebars($sidebars);
		$js = "
			var tbl = document.getElementById('sbg_table');
			tbl.deleteRow($row_number)
			
			add_sidebar_link_listener();
			
		";
		die($js);
	}
	
	public static function admin_menu(){
		add_submenu_page( 'alterna_options_page',
							'Sidebars', 'Sidebars', 'manage_options', 'sidebars_page', array('sidebar_generator','admin_page'));
	}
	
	public static function admin_page(){
		?>
		<script>
			function add_sidebar_link_listener(){
				
				var btns = jQuery('.sidebar-remove-btn');
				
				jQuery('#sidebar-name').attr('value','');
				
				if(btns.length > 0){
					jQuery('.sidebar-tip').css('display','none');
				}else{
					jQuery('.sidebar-tip').css('display','block');
				}
				
				jQuery(btns).each(function(index, element) {
                    if(jQuery(this).attr('data-click')){
					}else{
						jQuery(this).attr('data-click','yes');
						add_click_event(jQuery(this));
					}
                });
				
			}
			
			function add_click_event(element){
				jQuery(element).click(function(e) {
					var name = jQuery(this).parent().parent().children('td').get(1).textContent;
					var items = jQuery('#sbg_table tr');
					var num	 = 0;
					
					for(var i=0; i<items.length; i++){
						if(jQuery(items[i]).children('td').length > 0){
							if(jQuery(items[i]).children('td').get(1).textContent == name){
								num = i;
								break;
							}
						}
					}
					
					remove_sidebar_link(name,num);
				});
			}
			
			function remove_sidebar_link(name,num){
				answer = confirm("Are you sure you want to remove " + name + "?\nThis will remove any widgets you have assigned to this sidebar.");
				if(answer){
					//alert('AJAX REMOVE');
					remove_sidebar(name,num);
				}else{
					return false;
				}
			}
			function add_sidebar_link(){
				var sidebar_name = jQuery('#sidebar-name').attr('value');
				if(sidebar_name == '' || sidebar_name.length == 0) {
					return false;
				}
				//var sidebar_name = prompt("Sidebar Name:","");
				//alert(sidebar_name);
				add_sidebar(sidebar_name);
			}
			jQuery(document).ready(function(e) {
                add_sidebar_link_listener();
            });
		</script>
		<div class="wrap">
			<h2>Sidebar Generator</h2>
			<br />
			<table class="widefat page" id="sbg_table" style="width:600px;">
				<tr>
					<th>Name</th>
					<th>CSS class</th>
					<th>Remove</th>
				</tr>
				<?php
				$sidebars = sidebar_generator::get_sidebars();
				//$sidebars = array('bob','john','mike','asdf');
				if(is_array($sidebars) && !empty($sidebars)){
					$cnt=0;
					foreach($sidebars as $sidebar){
						$alt = ($cnt%2 == 0 ? 'alternate' : '');
				?>
				<tr class="<?php echo $alt?>">
					<td><?php echo $sidebar; ?></td>
					<td><?php echo sidebar_generator::name_to_class($sidebar); ?></td>
					<td><input type="button" class="button-primary sidebar-remove-btn" value="remove" /></td>
				</tr>
				<?php
						$cnt++;
					}
				}else{
					?>
					<!--<tr>
						<td colspan="3">No Sidebars defined</td>
					</tr>-->
					<?php
				}
				?>
			</table>
            <p class="sidebar-tip">No Sidebars defined!</p>
            <br /><br />
            <div class="add_sidebar">
            <h4>Add Sidebar: </h4>
            	<input id="sidebar-name" type="text" class="regular-text" placeholder="Input sidebar name" />
            </div>
			<p class="submit">
            	<input type="button" onclick="add_sidebar_link();" class="button-primary" value="Add New Sidebar" />
            </p>
		</div>
		<?php
	}
	
	/**
	 * called by the action get_sidebar. this is what places this into the theme
	*/
	public static function get_sidebar($name="0"){
		
		if(!is_singular()){
			echo "\n\n<!-- begin is_singular sidebar -->\n";
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
			return;//dont do anything
		}
		
		global $wp_query,$wp_registered_sidebars;
		
		if($name == "0"){
			$post = $wp_query->get_queried_object();
			$name = get_post_meta($post->ID, 'sidebar-type', true);
		}
		
		$sidebars = $wp_registered_sidebars;
		
		$have_sidebar = false;
		
		if(is_array($sidebars) && !empty($sidebars)){
			foreach($sidebars as $sidebar){
				if($name == $sidebar['name']){
					$have_sidebar = true;
					break;
				}
			}
		}

		if($name != "0" && $have_sidebar){
			dynamic_sidebar($name);
		}else{
			dynamic_sidebar();
		}
	}
	
	/**
	 * replaces array of sidebar names
	*/
	public static function update_sidebars($sidebar_array){
		$sidebars = update_option('sbg_sidebars',$sidebar_array);
	}	
	
	/**
	 * gets the generated sidebars
	*/
	public static function get_sidebars(){
		$sidebars = get_option('sbg_sidebars');
		return $sidebars;
	}
	
	public static function name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}
	
}
$sbg = new sidebar_generator;

function generated_dynamic_sidebar($name='0'){
	sidebar_generator::get_sidebar($name);	
	return true;
}
?>