<?php

class ESSBSocialFansCounterHelper {
	
	public static function get_option($option, $default = '') {
		global $essb_socialfans_options;		

		$option = str_replace('.', '_', $option);
		$option = 'essb3fans_'.$option;
		
		$value = isset($essb_socialfans_options[$option]) ? $essb_socialfans_options[$option] : '';
		//print " checking option = ".$option;
		//print_r($value);
		if (empty($value)) { 
			$value = $default;
		}
		
		return $value;
	}
	
	public static function get_active_networks() {
		$network_list = self::get_option('networks');
		
		return $network_list;
	}

	public static function get_active_networks_order() {
		$network_order = self::get_option('networks_order');
		
		$network_order = self::simplify_order_list($network_order);
	
		return $network_order;
	}
	
	public static function simplify_order_list($order) {
		$result = array();
		foreach ($order as $network) {
			$network_details = explode('|', $network);
			$result[] = $network_details[0];
		}
		
		return $result;
	}
	
	public static function available_social_networks ($display_total = true) {
	
		$socials = array ();
		$socials['facebook'] = 'Facebook';
		$socials['twitter'] = 'Twitter';
		$socials['google'] = 'Google';
		$socials['pinterest'] = 'Pinterest';
		$socials['linkedin'] = 'LinkedIn';
		$socials['github'] = 'GitHub';
		$socials['vimeo'] = 'Vimeo';
		$socials['dribbble'] = 'Dribbble';
		$socials['envato'] = 'Envato';
		$socials['soundcloud'] = 'SoundCloud';
		$socials['behance'] = 'Behance';
		$socials['foursquare'] = 'Foursquare';
		$socials['forrst'] = 'Forrst';
		$socials['mailchimp'] = 'MailChimp';
		$socials['delicious'] = 'Delicious';
		$socials['instgram'] = 'Instagram';
		$socials['youtube'] = 'YouTube';
		$socials['vk'] = 'VK';
		$socials['rss'] = 'RSS';
		$socials['vine'] = 'Vine';
		$socials['tumblr'] = 'Tumblr';
		$socials['slideshare'] = 'SlideShare';
		$socials['500px'] = '500px';
		$socials['flickr'] = 'Flickr';
		$socials['wp_posts'] = 'WordPress Posts';
		$socials['wp_comments'] = 'WordPress Comments';
		$socials['wp_users'] = 'WordPress Users';
		$socials['audioboo'] = 'Audioboo';
		$socials['steamcommunity'] = 'Steam';
		$socials['weheartit'] = 'WeHeartit';
		$socials['feedly'] = 'Feedly';
		$socials['love'] = 'Love Counter';
		if ($display_total) {
			$socials['total'] = 'Total Fans Counter';
		}
		
		return $socials;
	}
	
	public static function available_cache_periods () {
	
		$periods = array ();
		$periods[0] = 'Use Default';
		$periods[15] = '15 Minutes';
		$periods[30] = '30 Minutes';
		$periods[45] = '45 minutes';
		$periods[60] = '01 Hour';
		$periods[120] = '03 Hours';
		$periods[600] = '06 Hours';
		$periods[540] = '09 Hours';
		$periods[720] = '12 Hours';
		$periods[900] = '15 Hours';
		$periods[1080] = '18 Hours';
		$periods[1260] = '21 Hours';
		$periods[1440] = '01 Day';
		$periods[4320] = '03 Days';
		$periods[7200] = '05 Days';
		$periods[14400] = '10 Days';
		$periods[21600] = '15 Days';
		$periods[28800] = '20 Days';
		$periods[36000] = '25 Days';
		$periods[43200] = '01 Month';
	
		return $periods;
	}
	
	public static function available_number_formats () {
	
		$format = array ();
		$format['nf'] = '1000, 10000'; #no format
		$format['d'] = '1.000, 10.000'; #format dot
		$format['c'] = '1,000, 10,000'; #format comma
		$format['s'] = '1 000, 10 000'; #format space
		$format['l'] = '1k, 10k, 100k, 1m'; #format with letters
	
		return $format;
	}
	
	public static function default_field_settings() {
		$defaults = array ();
		
		$defaults['facebook']['id'] = array('type' => 'textbox', 'text' => 'Page ID/Name or porifle');
		$defaults['facebook']['account_type'] = array('type' => 'select', 'text' => 'Account type', 'values' => array('page' => 'Page', 'followers' => 'Followers'));
		$defaults['facebook']['access_token'] = array('type' => 'textbox', 'text' => 'Access token', 'description' => 'Access token is optional parameter. Generate and fill such only if you are not able to see fans counter without it (usually this is required to be filled when Facebook page has limtiation set - for age, country or other). To generate access token please visit this link and follow instructions: <a href="http://tools.creoworx.com/facebook/" target="_blank">http://tools.creoworx.com/facebook/</a>');
		$defaults['facebook']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['facebook']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['facebook']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['twitter']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['twitter']['consumer_key'] = array('type' => 'textbox', 'text' => 'Consumer key');
		$defaults['twitter']['consumer_secret'] = array('type' => 'textbox', 'text' => 'Consumer secret');
		$defaults['twitter']['access_token'] = array('type' => 'textbox', 'text' => 'Access token');
		$defaults['twitter']['access_token_secret'] = array('type' => 'textbox', 'text' => 'Access token secret');
		$defaults['twitter']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['twitter']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['twitter']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['google']['id'] = array('type' => 'textbox', 'text' => 'Page ID/Name');
		$defaults['google']['api_key'] = array('type' => 'textbox', 'text' => 'API Key');
		$defaults['google']['value_type'] = array('type' => 'select', 'text' => 'Google+ display value type', 'values' => array("circledByCount+plusOneCount" => "circledByCount+plusOneCount", "circledByCount" => "circledByCount", "plusOneCount" => "plusOneCount"));
		$defaults['google']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['google']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['google']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['pinterest']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['pinterest']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['pinterest']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['pinterest']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['linkedin']['id'] = array('type' => 'textbox', 'text' => 'LinkedIn ID');
		$defaults['linkedin']['token'] = array('type' => 'textbox', 'text' => 'Access Token', 'description' => 'To generate your access token key visit this address: <a href="http://tools.creoworx.com/linkedin/" target="_blank">http://tools.creoworx.com/linkedin/</a> and follow provided instructions on screen.');
		$defaults['linkedin']['account_type'] = array('type' => 'select', 'text' => 'Account type', 'values' => array('profile' => 'Profile', 'company' => 'Company'));
		$defaults['linkedin']['text'] = array('type' => 'textbox', 'text' => 'Fans text');;
		$defaults['linkedin']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['linkedin']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['github']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['github']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['github']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['github']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['vimeo']['id'] = array('type' => 'textbox', 'text' => 'Channel name/Username');
		$defaults['vimeo']['account_type'] = array('type' => 'select', 'text' => 'Profile type', 'values' => array('channel' => 'Channel', 'user' => 'User'));
		$defaults['vimeo']['access_token'] = array('type' => 'textbox', 'text' => 'Access token', 'description' => 'Access token key is required only if you display information for user. To generate such key you need to go to Vimeo Developer Center and create application <a href="https://developer.vimeo.com/" target="_blank">https://developer.vimeo.com/</a>');
		$defaults['vimeo']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['vimeo']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['vimeo']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['dribbble']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['dribbble']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['dribbble']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['dribbble']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['envato']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['envato']['site'] = array('type' => 'select', 'text' => 'Envato site', 'values' => array('themeforest' => 'Themeforest', 'codecanyon' => 'Codecanyon', '3docean' => '3docean', 'activeden' => 'Activeden', 'audiojungle' => 'Audiojungle', 'graphicriver' => 'Graphicriver', 'photodune' => 'Photodune', 'videohive' => 'Videohive'));
		$defaults['envato']['ref'] = array('type' => 'textbox', 'text' => 'Referral username', 'description' => 'Provide different username that will appear in the ref link to site');
		$defaults['envato']['text'] =array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['envato']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['envato']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['soundcloud']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['soundcloud']['api_key'] = array('type' => 'textbox', 'text' => 'API Key');
		$defaults['soundcloud']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['soundcloud']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['soundcloud']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['behance']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['behance']['api_key'] = array('type' => 'textbox', 'text' => 'API Key');
		$defaults['behance']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['behance']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['behance']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['foursquare']['api_key'] = array('type' => 'textbox', 'text' => 'API Key');
		$defaults['foursquare']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['foursquare']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['foursquare']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['forrst']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['forrst']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['forrst']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['forrst']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['mailchimp']['list_id'] = array('type' => 'textbox', 'text' => 'List ID');
		$defaults['mailchimp']['api_key'] = array('type' => 'textbox', 'text' => 'API Key');
		$defaults['mailchimp']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['mailchimp']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['mailchimp']['list_url'] = array('type' => 'textbox', 'text' => 'List URL address', 'description' => 'Provide subscribe form address where users will be redirected when click on button');
		$defaults['mailchimp']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['delicious']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['delicious']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['delicious']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['delicious']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['instgram']['id'] = array('type' => 'textbox', 'text' => 'User ID');
		$defaults['instgram']['username'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['instgram']['api_key'] = array('type' => 'textbox', 'text' => 'Access Token');
		$defaults['instgram']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['instgram']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['instgram']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['youtube']['id'] = array('type' => 'textbox', 'text' => 'Channel/User');
		$defaults['youtube']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['youtube']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['youtube']['account_type'] = array('type' => 'select', 'text' => 'Account Type', 'values' => array('channel' => 'Channel', 'user' => 'User'));
		$defaults['youtube']['api_key'] = array('type' => 'textbox', 'text' => 'API Key', 'description' => 'If you have set a Google+ API key you can use it same here - all you need is to enable access to YouTube API in Google Console.');
		$defaults['youtube']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['vk']['id'] = array('type' => 'textbox', 'text' => 'Your VK.com ID number or Community ID/Name');
		$defaults['vk']['account_type'] = array('type' => 'select', 'text' => 'Profile type', 'values' => array('profile' => 'Profile', 'community' => 'Community ID/Name'));
		$defaults['vk']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['vk']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['vk']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['rss']['link'] = array('type' => 'textbox', 'text' => 'URL address of your feed');
		$defaults['rss']['count'] = array('type' => 'textbox', 'text' => 'Value of subsribers');
		$defaults['rss']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['rss']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		//$defaults['rss']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['vine']['email'] = array('type' => 'textbox', 'text' => 'Email');
		$defaults['vine']['password'] = array('type' => 'textbox', 'text' => 'Password');
		$defaults['vine']['username'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['vine']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['vine']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['vine']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['tumblr']['basename'] = array('type' => 'textbox', 'text' => 'Blog basename');
		$defaults['tumblr']['api_key'] = array('type' => 'textbox', 'text' => 'Consumer Key');
		$defaults['tumblr']['api_secret'] = array('type' => 'textbox', 'text' => 'Consumer Secret');
		$defaults['tumblr']['access_token'] = array('type' => 'textbox', 'text' => 'Access Token');
		$defaults['tumblr']['access_token_secret'] = array('type' => 'textbox', 'text' => 'Access Token Secret');
		$defaults['tumblr']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['tumblr']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['tumblr']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['slideshare']['username'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['slideshare']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['slideshare']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['slideshare']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['500px']['username'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['500px']['api_key'] = array('type' => 'textbox', 'text' => 'API Key');
		$defaults['500px']['api_secret'] = array('type' => 'textbox', 'text' => 'API Secret');
		$defaults['500px']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['500px']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['500px']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['flickr']['id'] = array('type' => 'textbox', 'text' => 'Group slug');
		$defaults['flickr']['api_key'] = array('type' => 'textbox', 'text' => 'API Key');
		$defaults['flickr']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['flickr']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['flickr']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['wp_posts']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['wp_posts']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['wp_comments']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['wp_comments']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['wp_users']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['wp_users']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['audioboo']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['audioboo']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['audioboo']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['audioboo']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['steamcommunity']['id'] = array('type' => 'textbox', 'text' => 'Social network profile ID');
		$defaults['steamcommunity']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['steamcommunity']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['steamcommunity']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['weheartit']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$defaults['weheartit']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['weheartit']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['weheartit']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['feedly']['url'] = array('type' => 'textbox', 'text' => 'Feedly URL address');
		$defaults['feedly']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['feedly']['hover_text'] = array('type' => 'textbox', 'text' => 'Hover text');
		$defaults['feedly']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$defaults['total']['url'] = array('type' => 'textbox', 'text' => 'URL address when user click on total button');
		$defaults['total']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['total']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		$defaults['total']['viewtype'] = array('type' => 'select', 'text' => 'Total counter display type', 'values' => array('button' => 'Display as button', 'text' => 'Display as text'));
		$defaults['total']['textposition'] = array('type' => 'select', 'text' => 'Text total counter position', 'description' => 'Choose position of total counter when displayed as text', 'values' => array('bottom' => 'After all networks', 'top' => 'Before all networks'));
		
		$defaults['love']['url'] = array('type' => 'textbox', 'text' => 'URL address when user click on love button');
		$defaults['love']['text'] = array('type' => 'textbox', 'text' => 'Fans text');
		$defaults['love']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		
		return $defaults;
	}
	
	public static function default_options() {
		$defaults = array ();
		
		$defaults['facebook']['id'] = '';
		$defaults['facebook']['account_type'] = 'page';
		$defaults['facebook']['access_token'] = '';
		$defaults['facebook']['text'] = __( 'Fans' , ESSB3_TEXT_DOMAIN );
		$defaults['facebook']['hover_text'] = __( 'Like' , ESSB3_TEXT_DOMAIN );
		$defaults['facebook']['uservalue'] = '';
		
		$defaults['twitter']['consumer_key'] = '';
		$defaults['twitter']['consumer_secret'] = '';
		$defaults['twitter']['access_token'] = '';
		$defaults['twitter']['access_token_secret'] = '';
		$defaults['twitter']['id'] = '';
		$defaults['twitter']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['twitter']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['twitter']['uservalue'] = '';
		
		$defaults['google']['id'] = '';
		$defaults['google']['api_key'] = '';
		$defaults['google']['text'] = __( 'Fans' , ESSB3_TEXT_DOMAIN );
		$defaults['google']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['google']['uservalue'] = '';
		
		$defaults['pinterest']['id'] = '';
		$defaults['pinterest']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['pinterest']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['pinterest']['uservalue'] = '';
		
		$defaults['linkedin']['app_key'] = '';
		$defaults['linkedin']['app_secret'] = '';
		$defaults['linkedin']['id'] = '~';
		$defaults['linkedin']['account_type'] = 'profile';
		$defaults['linkedin']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['linkedin']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['linkedin']['uservalue'] = '';
		
		$defaults['github']['id'] = '';
		$defaults['github']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['github']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['github']['uservalue'] = '';
		
		$defaults['vimeo']['id'] = '';
		$defaults['vimeo']['account_type'] = 'channel';
		$defaults['vimeo']['access_token'] = '';
		$defaults['vimeo']['text'] = __( 'Subscribers' , ESSB3_TEXT_DOMAIN );
		$defaults['vimeo']['hover_text'] = __( 'Subscribe' , ESSB3_TEXT_DOMAIN );
		$defaults['vimeo']['uservalue'] = '';
		
		$defaults['dribbble']['id'] = '';
		$defaults['dribbble']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['dribbble']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['dribbble']['uservalue'] = '';
		
		$defaults['envato']['id'] = '';
		$defaults['envato']['site'] = 'themeforest';
		$defaults['envato']['ref'] = '';
		$defaults['envato']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['envato']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['envato']['uservalue'] = '';
		
		$defaults['soundcloud']['api_key'] = '';
		$defaults['soundcloud']['id'] = '';
		$defaults['soundcloud']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['soundcloud']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['soundcloud']['uservalue'] = '';
		
		$defaults['behance']['api_key'] = '';
		$defaults['behance']['id'] = '';
		$defaults['behance']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['behance']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['behance']['uservalue'] = '';
		
		$defaults['foursquare']['api_key'] = '';
		$defaults['foursquare']['text'] = __( 'Friends' , ESSB3_TEXT_DOMAIN );
		$defaults['foursquare']['hover_text'] = __( 'Add' , ESSB3_TEXT_DOMAIN );
		$defaults['foursquare']['uservalue'] = '';
		
		$defaults['forrst']['id'] = '';
		$defaults['forrst']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['forrst']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['forrst']['uservalue'] = '';
		
		$defaults['mailchimp']['api_key'] = '';
		$defaults['mailchimp']['id'] = '';
		$defaults['mailchimp']['list_url'] = '';
		$defaults['mailchimp']['text'] = __( 'Subscribers' , ESSB3_TEXT_DOMAIN );
		$defaults['mailchimp']['hover_text'] = __( 'Subscribe' , ESSB3_TEXT_DOMAIN );
		$defaults['mailchimp']['uservalue'] = '';
		
		$defaults['delicious']['id'] = '';
		$defaults['delicious']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['delicious']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['delicious']['uservalue'] = '';
		
		$defaults['instgram']['id'] = '';
		$defaults['instgram']['username'] = '';
		$defaults['instgram']['text'] = 'Followers';
		$defaults['instgram']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['instgram']['uservalue'] = '';
		
		$defaults['youtube']['id'] = '';
		$defaults['youtube']['text'] = __( 'Subscribers' , ESSB3_TEXT_DOMAIN );
		$defaults['youtube']['hover_text'] = __( 'Subscribe' , ESSB3_TEXT_DOMAIN );
		$defaults['youtube']['account_type'] = 'user';
		$defaults['youtube']['uservalue'] = '';
		
		$defaults['vk']['id'] = '';
		$defaults['vk']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['vk']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['vk']['uservalue'] = '';
		
		$defaults['rss']['link'] = '';
		$defaults['rss']['count'] = '';
		$defaults['rss']['text'] = __( 'Subscribers' , ESSB3_TEXT_DOMAIN );
		$defaults['rss']['hover_text'] = __( 'Subscribe' , ESSB3_TEXT_DOMAIN );
		$defaults['rss']['uservalue'] = '';
		
		$defaults['vine']['email'] = '';
		$defaults['vine']['password'] = '';
		$defaults['vine']['username'] = '';
		$defaults['vine']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['vine']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['vine']['uservalue'] = '';
		
		$defaults['tumblr']['api_key'] = '';
		$defaults['tumblr']['basename'] = '';
		$defaults['tumblr']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['tumblr']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['tumblr']['uservalue'] = '';
		
		$defaults['slideshare']['username'] = '';
		$defaults['slideshare']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['slideshare']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['slideshare']['uservalue'] = '';
		
		$defaults['500px']['api_key'] = '';
		$defaults['500px']['api_secret'] = '';
		$defaults['500px']['username'] = '';
		$defaults['500px']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['500px']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['500px']['uservalue'] = '';
		
		$defaults['flickr']['id'] = '';
		$defaults['flickr']['count'] = '';
		$defaults['flickr']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['flickr']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['flickr']['uservalue'] = '';
		
		$defaults['wp_posts']['text'] = __( 'Posts' , ESSB3_TEXT_DOMAIN );
		$defaults['wp_posts']['uservalue'] = '';
		
		$defaults['wp_comments']['text'] = __( 'Comments' , ESSB3_TEXT_DOMAIN );
		$defaults['wp_comments']['uservalue'] = '';
		
		$defaults['wp_users']['text'] = __( 'Subscribers' , ESSB3_TEXT_DOMAIN );
		$defaults['wp_users']['uservalue'] = '';
		
		$defaults['audioboo']['id'] = '';
		$defaults['audioboo']['text'] = __( 'Followers' , ESSB3_TEXT_DOMAIN );
		$defaults['audioboo']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['audioboo']['uservalue'] = '';
		
		$defaults['steamcommunity']['id'] = '';
		$defaults['steamcommunity']['text'] = __( 'Members' , ESSB3_TEXT_DOMAIN );
		$defaults['steamcommunity']['hover_text'] = __( 'Join' , ESSB3_TEXT_DOMAIN );
		$defaults['steamcommunity']['uservalue'] = '';
		
		$defaults['weheartit']['id'] = '';
		$defaults['weheartit']['text'] = __( 'Followrs' , ESSB3_TEXT_DOMAIN );
		$defaults['weheartit']['hover_text'] = __( 'Follow' , ESSB3_TEXT_DOMAIN );
		$defaults['weheartit']['uservalue'] = '';
		
		$defaults['feedly']['url'] = '';
		$defaults['feedly']['text'] = __( 'Subscribers' , ESSB3_TEXT_DOMAIN );
		$defaults['feedly']['hover_text'] = __( 'subscribe' , ESSB3_TEXT_DOMAIN );
		$defaults['feedly']['uservalue'] = '';
		
		$defaults['total']['url'] = '';
		$defaults['total']['text'] = __( 'Fans Love us' , ESSB3_TEXT_DOMAIN );
		$defaults['total']['uservalue'] = '';

		$defaults['love']['url'] = '';
		$defaults['love']['text'] = __( 'Loves' , ESSB3_TEXT_DOMAIN );
		$defaults['love']['uservalue'] = '';
		
		$defaults['setting']['expire'] = 1440;
		$defaults['setting']['format'] = 'l';
 		
		return $defaults;
	}
	
	public static function conver_default_options($options) {
		$save_options = array();
		
		foreach ($options as $network => $data) {
			$base_network_option_id = "essb3fans_".$network."_";
			
			foreach ($data as $key => $value) {
				$field_id = $base_network_option_id.$key;
				$save_options[$field_id] = $value;
			}
		}
		
		return $save_options;
	
	}
}

?>