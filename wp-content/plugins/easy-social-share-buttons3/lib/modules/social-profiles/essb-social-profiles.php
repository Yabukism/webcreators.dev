<?php

class ESSBSocialProfiles {
	private static $instance = null;
	
	public static function get_instance() {
	
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
	
		return self::$instance;
	
	} // end get_instance;
	
	function __construct() {
		global $essb_options;
		
		$is_active = false;
		
		if (ESSBOptionValuesHelper::options_bool_value($essb_options, 'profiles_display')) {
			$is_active = true;
			
			if (ESSBOptionValuesHelper::options_bool_value($essb_options, 'profiles_mobile_deactivate')) {
				$mobile = new ESSB_Mobile_Detect();
				if ($mobile->isMobile()) {
					$is_active = false;
				}
			}
		}
		
		
		if ($is_active) {
			add_action('wp_footer', array($this, 'display_profiles'));
		}
	}	
	
	function display_profiles() {
		global $essb_options, $essb_available_social_profiles;
		
		$profiles_display_position = ESSBOptionValuesHelper::options_value($essb_options, 'profiles_display_position');
		$profiles_button_type = ESSBOptionValuesHelper::options_value($essb_options, 'profiles_button_type');
		$profiles_button_size = ESSBOptionValuesHelper::options_value($essb_options, 'profiles_button_size');
		$profiles_nospace = ESSBOptionValuesHelper::options_bool_value($essb_options, 'profiles_nospace');
		$profiles_button_fill = ESSBOptionValuesHelper::options_value($essb_options, 'profiles_button_fill');
		
		$profiles_order = ESSBOptionValuesHelper::options_value($essb_options, 'profiles_order');
		
		if (!is_array($profiles_order)) {
			$profiles_order = array();
			foreach ($essb_available_social_profiles as $network => $text) {
				$profiles_order[] = $network;
			}
		}
		
		$profiles = array();
		foreach ($profiles_order as $network) {
			$value_address = ESSBOptionValuesHelper::options_value($essb_options, 'profile_'.$network);
			
			if (!empty($value_address)) {
				$profiles[$network] = $value_address;
			}
		}		
		
		echo $this->generate_social_profile_icons($profiles, $profiles_button_type, $profiles_button_size, $profiles_button_fill,
				$profiles_nospace, $profiles_display_position);
	}
	
	public static function generate_social_profile_icons($profiles = array(), $button_type = 'square', 
			$button_size = 'small', $button_fill = 'colored', $nospace = true, $position = '') {
		
		$output = "";
		
		$nospace_class = ($nospace) ? " essb-profiles-nospace" : "";
		$position_classs = (!empty($position)) ? " essb-profiles-".$position : "";
		
		if (!empty($position)) {
			if ($position != "left" && $position != "right") {
				$position_classs .= " essb-profiles-horizontal";
			}
 		}
		
		$output .= sprintf('<div class="essb-profiles essb-profiles-%1$s essb-profiles-size-%2$s%3$s%4$s">', $button_type, $button_size,
				$nospace_class, $position_classs);
		
		$output .= '<ul class="essb-profile">';
				
		
		foreach ($profiles as $network => $address) {
			$output .= sprintf('<li class="essb-single-profile"><a href="%1$s" target="_blnak" rel="nofollow" class="essb-profile-all essb-profile-%2$s-%3$s"><span class="essb-profile-%2$s"></span></a></li>', $address, $network, $button_fill);
		}
		
		$output .= '</ul>';
		$output .= "</div>";

		return $output;
	}
	
}

?>