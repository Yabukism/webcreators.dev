<?php

add_action( 'widgets_init' , create_function( '' , 'return register_widget( "ESSBSocialProfilesWidget" );' ) );

class ESSBSocialProfilesWidget extends WP_Widget {
	
	protected $widget_slug = "easy-social-profile-buttons";

	public function __construct() {

		$options = array( 'description' => __( 'Social Profiles' , ESSB3_TEXT_DOMAIN ), 'classname' => $this->widget_slug."-class" );

		parent::__construct( false , __( 'Easy Social Share Buttons: Social Profiles' , ESSB3_TEXT_DOMAIN ) , $options );

	}
	
	public function form( $instance ) {
		global $essb_available_social_profiles;
		
		$defaults = array(
				'title' => 'Social Profiles' ,
				'type' => 'square' ,
				'size' => 'small' ,
				'style' => 'fill' ,
				'nospace' => 0,
				'show_title' => 1
		);
		
		$profile_networks = array();
		$profile_networks = ESSBOptionValuesHelper::advanced_array_to_simple_array($essb_available_social_profiles);
		
		foreach ($profile_networks as $network) {
			$defaults['profile_'.$network] = '';
		}
	
		$instance = wp_parse_args( ( array ) $instance , $defaults );

		$listOfType = array("square" => "Square buttons", "round" => "Round buttons", "edge" => "Round edges");
		$listOfFill = array("fill" => "White icons on colored background", "colored" => "Colored icons");
		
		$listOfSize = array("small" => "Small", "medium" => "Medium", "large" => "Large");
		
		$instance_type = $instance['type'];
		$instance_size = $instance['size'];
		$instance_style = $instance['style'];
		
		?>
		
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title' , ESSB3_TEXT_DOMAIN ); ?>:</label>
  <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" value="<?php echo $instance['title']; ?>" />
</p>
	
<p>
  <label for="<?php echo $this->get_field_id( 'show_title' ); ?>"><?php echo __( 'Display widget title' , ESSB3_TEXT_DOMAIN ); ?>:</label>
  <input type="checkbox" name="<?php echo $this->get_field_name( 'show_title' ); ?>" id="<?php echo $this->get_field_id( 'show_title' ); ?>" value="1" <?php if ( 1 == $instance['show_title'] ) { echo ' checked="checked"'; } ?> />
</p>

<p>
  <label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php echo __( 'Button style' , ESSB3_TEXT_DOMAIN ); ?>:</label>
  <select name="<?php echo $this->get_field_name( 'type' ); ?>" id="<?php echo $this->get_field_id( 'type' ); ?>" class="widefat">
<?php 
foreach ($listOfType as $key => $text) {
	$selected = ($key == $instance_type) ? " selected='selected'" : '';
	
	printf('<option value="%1$s" %2$s>%3$s</option>', $key, $selected, $text);
}
?>
  </select>
</p>

<p>
  <label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php echo __( 'Button color style' , ESSB3_TEXT_DOMAIN ); ?>:</label>
  <select name="<?php echo $this->get_field_name( 'style' ); ?>" id="<?php echo $this->get_field_id( 'style' ); ?>" class="widefat">
<?php 
foreach ($listOfFill as $key => $text) {
	$selected = ($key == $instance_style) ? " selected='selected'" : '';
	
	printf('<option value="%1$s" %2$s>%3$s</option>', $key, $selected, $text);
}
?>
  </select>
</p>

<p>
  <label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php echo __( 'Button size' , ESSB3_TEXT_DOMAIN ); ?>:</label>
  <select name="<?php echo $this->get_field_name( 'size' ); ?>" id="<?php echo $this->get_field_id( 'size' ); ?>" class="widefat">
<?php 
foreach ($listOfSize as $key => $text) {
	$selected = ($key == $instance_size) ? " selected='selected'" : '';
	
	printf('<option value="%1$s" %2$s>%3$s</option>', $key, $selected, $text);
}
?>
  </select>
</p>

<p>
  <label for="<?php echo $this->get_field_id( 'nospace' ); ?>"><?php echo __( 'Remove space between buttons' , ESSB3_TEXT_DOMAIN ); ?>:</label>
  <input type="checkbox" name="<?php echo $this->get_field_name( 'nospace' ); ?>" id="<?php echo $this->get_field_id( 'nospace' ); ?>" value="1" <?php if ( 1 == $instance['nospace'] ) { echo ' checked="checked"'; } ?> />
</p>
		<?php

		foreach ($essb_available_social_profiles as $network => $display) {
			$network_value = $instance['profile_'.$network];
			?>
<p>
  <label for="<?php echo $this->get_field_id('profile_'.$network ); ?>"><?php echo __( $display , ESSB3_TEXT_DOMAIN ); ?>:</label>
  <input type="text" name="<?php echo $this->get_field_name( 'profile_'.$network ); ?>" id="<?php echo $this->get_field_id( 'profile_'.$network ); ?>" class="widefat" value="<?php echo $network_value ?>" />
</p>
			<?php 
		}
	}
	
	public function update( $new_instance , $old_instance ) {
		global $essb_available_social_profiles;
		
		$instance = $old_instance;
		
		$profile_networks = array();
		$profile_networks = ESSBOptionValuesHelper::advanced_array_to_simple_array($essb_available_social_profiles);
		
		$instance['title'] = $new_instance['title'];
		$instance['type'] = $new_instance['type'];
		$instance['size'] = $new_instance['size'];
		$instance['style'] = $new_instance['style'];
		$instance['nospace'] = $new_instance['nospace'];
		$instance['show_title'] = $new_instance['show_title'];
		
		foreach ($profile_networks as $network) {
			$instance['profile_'.$network] = $new_instance['profile_'.$network];
		}
		
		return $instance;
	}
	
	public function widget( $args, $instance ) {
		global $essb_available_social_profiles;
		
		extract($args);
		
		$before_widget = $args['before_widget'];
		$before_title  = $args['before_title'];
		$after_title   = $args['after_title'];
		$after_widget  = $args['after_widget'];
		
		$show_title = $instance['show_title'];
		$title = $instance['title'];
		
		$sc_button_type = isset($instance['type']) ? $instance['type'] : 'square';
		$sc_button_size = isset($instance['size']) ? $instance['size'] : 'small';
		$sc_button_fill = isset($instance['style']) ? $instance['style'] : 'fill';
		$sc_nospace = $instance['nospace'];
		
		if (!empty($sc_nospace) && $sc_nospace != '0') {
			$sc_nospace = "true";
		}
		else {
			$sc_nospace = "false";
		}
		$sc_nospace = ESSBOptionValuesHelper::unified_true($sc_nospace);
		$profile_networks = array();
		$profile_networks = ESSBOptionValuesHelper::advanced_array_to_simple_array($essb_available_social_profiles);
		
		$sc_network_address = array();
		foreach ($profile_networks as $network) {
			$value = $instance['profile_'.$network];
			
			if (!empty($value)) {
				$sc_network_address[$network] = $value;
			}
		}
		
		if (!empty($show_title)) {
			echo $before_widget . $before_title . $title . $after_title;
		}
		
		// if module is not activated include the code
		if (!defined('ESSB3_SOCIALPROFILES_ACTIVE')) {
			include_once (ESSB3_PLUGIN_ROOT . 'lib/modules/social-profiles/essb-social-profiles.php');
			define('ESSB3_SOCIALPROFILES_ACTIVE', 'true');
			$resource_builder = ESSBResourceBuilder::get_instance();
			$template_url = ESSB3_PLUGIN_URL.'/assets/css/essb-profiles.css';
			$resource_builder->add_static_footer_css($template_url, 'easy-social-share-buttons-profiles');
		}
		
		echo ESSBSocialProfiles::generate_social_profile_icons($sc_network_address, $sc_button_type, $sc_button_size, $sc_button_fill, $sc_nospace);
		
		if (!empty($show_title)) {
			echo $after_widget;
		}
	}
}

?>