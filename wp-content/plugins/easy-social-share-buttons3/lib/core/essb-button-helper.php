<?php

/**
 * Button design time functions
 * 
 * @author appscreo
 * @package Easy Social Share Buttons
 * @version 1.0
 * @since version 3.0
 */
class ESSBButtonHelper {
	
	public static function draw_buttons_start($style = array(), $position = '', $salt = '', $like_or_share = 'share', $share = array()) {
		global $essb_options;
		
		$network_hidden_name_class = "";
		if ($style ['button_style'] == "icon_hover") {
			$network_hidden_name_class = " essb_hide_name";
		}
		if ($style ['button_style'] == "icon") {
			$network_hidden_name_class = " essb_force_hide_name essb_force_hide";
		}
		if ($style ['button_style'] == "button_name") {
			$network_hidden_name_class = " essb_hide_icon";
		}
		
		$template = ESSBCoreHelper::template_folder ( $style ['template'] );
		$instance_template = $template;
		if ($template != '') {
			$template = " essb_template_" . $template;
		}
		
		$use_legacy_lass = ESSBOptionValuesHelper::options_bool_value($essb_options, 'legacy_class');
		
		// TODO: implement all other width styles
		$css_class_width = "";
		if ($style['button_width'] == "fixed") {
			$fixedwidth_key = $style['button_width_fixed_value'] . "_" . $style['button_width_fixed_align'];
			$css_class_width = " essb_fixedwidth_".$fixedwidth_key;
		}
		if ($style['button_width'] == "full") {
			$container_width = $style['button_width_full_container'];
			$single_button_width = intval($container_width) / intval($style['included_button_count']);
			$single_button_width = floor($single_button_width);
			
			$css_class_width = " essb_fullwidth_".$single_button_width.'_'.$style['button_width_full_button'].'_'.$style['button_width_full_container'];
			
			if ($style['fullwidth_align'] == "center") {
				$css_class_width .= " essb_network_align_center";
			}
			if ($style['fullwidth_align'] == "right") {
				$css_class_width .= " essb_network_align_right";
			}
			
		}
		if ($style['button_width'] == "column") {
			$css_class_width = " essb_width_columns_".$style['button_width_columns'];

			if ($style['fullwidth_share_buttons_columns_align'] == "center") {
				$css_class_width .= " essb_network_align_center";
			}
			if ($style['fullwidth_share_buttons_columns_align'] == "right") {
				$css_class_width .= " essb_network_align_right";
			}
		}
		
		$css_class_align = "";
		if ($style['button_align'] == "right") {
			$css_class_align = " essb_links_right";
		}
		if ($style['button_align'] == "center") {
			$css_class_align = " essb_links_center";
		}
		
		// modern counter style
		$essb_css_modern_counter_class = "";
		if ($style ['counter_pos'] == 'leftm') {
			$style ['counter_pos'] = 'left';
			$essb_css_modern_counter_class = ' essb_counter_modern_left';
		}
		
		if ($style ['counter_pos'] == 'rightm') {
			$style ['counter_pos'] = 'right';
			$essb_css_modern_counter_class = ' essb_counter_modern_right';
		}
		
		if ($style ['counter_pos'] == 'top') {
			$style ['counter_pos'] = 'left';
			$essb_css_modern_counter_class = ' essb_counter_modern_top';
		}
		
		if ($style ['counter_pos'] == 'topm') {
			$style ['counter_pos'] = 'left';
			$essb_css_modern_counter_class = ' essb_counter_modern_top_mini';
		}
		if ($style ['counter_pos'] == "bottom") {
			$essb_css_modern_counter_class = ' essb_counter_modern_bottom';
		}
		
		$counter_class = ($style ['show_counter']) ? " essb_counters" : "";
		
		$total_text = ESSBOptionValuesHelper::options_value($essb_options, 'counter_total_text');
		if (empty($total_text)) {
			$total_text = __('Total: ', ESSB3_TEXT_DOMAIN);
		}
		
		$css_hide_total_counter = "";
		if ($style ['total_counter_hidden_till'] != '') {
			$css_hide_total_counter = ' style="display: none !important;" data-essb-hide-till="' . $style ['total_counter_hidden_till'] . '"';
		}
		
		$css_class_nospace = ($style['nospace']) ? " essb_nospace" : "";
		$css_class_nostats = "";
		if (isset($style['nostats'])) {
			$css_class_nostats = ($style['nostats']) ? " essb_nostats" : "";
		}
		
		$like_share_position = ($like_or_share == "share") ? " essb_share" : " essb_native";
		$links_start = "";
		
		$key_position = $position;
		if ($position == "sidebar") {
			$current_sidebar_pos = ESSBOptionValuesHelper::options_value($essb_options, 'sidebar_pos');
			
			if (!empty($style['sidebar_pos'])) {
				$current_sidebar_pos = $style['sidebar_pos'];
			}
			if ($current_sidebar_pos != '' && $current_sidebar_pos != 'left') {
				$key_position .= "_".$current_sidebar_pos;
			}
		}	

		if ($use_legacy_lass) {
			if ($position == "bottombar") {
				$key_position .= ' essb_displayed_sidebar_bottom';
			}
			if ($position == "topbar") {
				$key_position .= ' essb_displayed_sidebar_top';
			}
		}
		
		$links_start = sprintf ( '<div class="essb_links%1$s%2$s essb_displayed_%3$s%4$s%5$s essb_%6$s%13$s%14$s%15$s%16$s print-no" 
				id="essb_displayed_%3$s_%6$s" data-essb-postid="%7$s" data-essb-position="%3$s" data-essb-button-style="%8$s" 
				data-essb-template="%9$s" data-essb-counter-pos="%10$s" data-essb-url="%11$s" data-essb-twitter-url="%12$s" data-essb-instance="%6$s">', 
				$counter_class, $essb_css_modern_counter_class, $key_position, $like_share_position, $template, $salt, 
				$share['post_id'], $style['button_style'], $instance_template, $style['counter_pos'], $share['url'], $share['full_url'], $css_class_width,
				$css_class_align, $css_class_nospace, $css_class_nostats );
		
		if ($like_or_share == "share" && $style ['message_share_buttons'] != '') {
			$style ['message_share_buttons'] = preg_replace(array('#%title%#', '#%siteurl%#', '#%permalink%#', '#%image%#', '#%shorturl%#'), array($share['title'], get_site_url(), $share['url'], $share['image'], $share['short_url']), $style ['message_share_buttons']);
			$links_start .= sprintf ( '<div class="essb_message_above_share">%1$s</div>', stripslashes ( $style ['message_share_buttons'] ) );
		}
		
		$links_start .= sprintf ( '<ul class="essb_links_list%1$s">', $network_hidden_name_class );
		
		// generating share buttons template start
		if ($like_or_share == "share" && $style ['message_share_before_buttons'] != '') {
			$style ['message_share_before_buttons'] = preg_replace(array('#%title%#', '#%siteurl%#', '#%permalink%#', '#%image%#', '#%shorturl%#'), array($share['title'], get_site_url(), $share['url'], $share['image'], $share['short_url']), $style ['message_share_before_buttons']);				
			$links_start .= sprintf ( '<li class="essb_message_before">%1$s</li>', stripslashes ( $style ['message_share_before_buttons'] ) );
		}
		if ($like_or_share == "share" && $style ['show_counter']) {
			if ($style ['total_counter_pos'] == "left" || $style ['total_counter_pos'] == "leftbig" || $style ['total_counter_pos'] == "before" || $style ['total_counter_pos'] == "hidden") {
				
				// left
				if ($style ['total_counter_pos'] == "left" || $style ['total_counter_pos'] == "hidden") {
					$links_start .= '<li class="essb_item essb_totalcount_item" ' . ($style ['total_counter_pos'] == "hidden" ? 'style="display: none !important;"' : '') . $css_hide_total_counter . ' data-counter-pos="' . $style ['counter_pos'] . '"><span class="essb_totalcount essb_t_l"  title="' . $total_text . '"><span class="essb_t_nb"></span></span></li>';
				}
				if ($style ['total_counter_pos'] == "leftbig") {
					$links_start .= '<li class="essb_item essb_totalcount_item" ' . ($style ['total_counter_pos'] == "hidden" ? 'style="display: none !important;"' : '') . $css_hide_total_counter . ' data-counter-pos="' . $style ['counter_pos'] . '"><span class="essb_totalcount essb_t_l_big" title=""><span class="essb_t_nb"></span></span></li>';
				}
				if ($style ['total_counter_pos'] == "before") {
					$userbased_text = $style ['total_counter_afterbefore_text'];
					if ($userbased_text == '') {
						$userbased_text = '{TOTAL} shares';
					}
					
					$userbased_text = str_replace ( '{TOTAL}', '<span class="essb_t_nb"></span>', $userbased_text );
					$links_start .= '<li class="essb_item essb_totalcount_item essb_totalcount_item_before" ' . ($style ['total_counter_pos'] == "hidden" ? 'style="display: none !important;"' : '') . $css_hide_total_counter . ' data-counter-pos="' . $style ['counter_pos'] . '"><span class="essb_totalcount essb_t_before" title="">' . $userbased_text . '</span></li>';
				}
			}
		}
		
		return $links_start;
	}
	
	public static function draw_buttons_end($style = array(), $position = '', $salt = '', $like_or_share = 'share') {
		global $essb_options;
		
		$css_hide_total_counter = "";
		if ($style ['total_counter_hidden_till'] != '') {
			$css_hide_total_counter = ' style="display: none !important;" data-essb-hide-till="' . $style ['total_counter_hidden_till'] . '"';
		}
		
		$links_start = "";
		$total_text = ESSBOptionValuesHelper::options_value($essb_options, 'counter_total_text');
		if (empty($total_text)) {
			$total_text = __('Total: ', ESSB3_TEXT_DOMAIN);
		}
		// generating share buttons template start
		if ($like_or_share == "share") {
			
			if ($style ['show_counter']) {
				if ($style ['total_counter_pos'] == "right" || $style ['total_counter_pos'] == "rightbig" || $style ['total_counter_pos'] == "after") {
					
					// left
					if ($style ['total_counter_pos'] == "right" || $style ['total_counter_pos'] == "hidden") {
						$links_start .= '<li class="essb_item essb_totalcount_item" ' . ($style ['total_counter_pos'] == "hidden" ? 'style="display: none !important;"' : '') . $css_hide_total_counter . ' data-counter-pos="' . $style ['counter_pos'] . '"><span class="essb_totalcount essb_t_r"  title="' . $total_text . '"><span class="essb_t_nb"></span></span></li>';
					}
					if ($style ['total_counter_pos'] == "rightbig") {
						$links_start .= '<li class="essb_item essb_totalcount_item" ' . ($style ['total_counter_pos'] == "hidden" ? 'style="display: none !important;"' : '') . $css_hide_total_counter . ' data-counter-pos="' . $style ['counter_pos'] . '"><span class="essb_totalcount essb_t_r_big" title=""><span class="essb_t_nb"></span></span></li>';
					}
					if ($style ['total_counter_pos'] == "after") {
						$userbased_text = $style ['total_counter_afterbefore_text'];
						if ($userbased_text == '') {
							$userbased_text = '{TOTAL} shares';
						}
						
						$userbased_text = str_replace ( '{TOTAL}', '<span class="essb_t_nb"></span>', $userbased_text );
						$links_start .= '<li class="essb_item essb_totalcount_item essb_totalcount_item_before" ' . ($style ['total_counter_pos'] == "hidden" ? 'style="display: none !important;"' : '') . $css_hide_total_counter . ' data-counter-pos="' . $style ['counter_pos'] . '"><span class="essb_totalcount essb_t_before" title="">' . $userbased_text . '</span></li>';
					}
				}
			}
		}
		
		$links_start .= '</ul>';
		$links_start .= '</div>';
		
		return $links_start;
	}
	
	public static function draw_share_buttons($share = array(), $style = array(), $networks = array(), $networks_order = array(), $network_names = array(),
			 $position = '', $salt = '', $like_or_share = 'share', $native_buttons = '') {
		
		global $essb_networks, $essb_options;
		
		$content = "";
		
		$mycred_group = ESSBOptionValuesHelper::options_value($essb_options, 'mycred_group', 'mycred_default');
		$mycred_points = ESSBOptionValuesHelper::options_value($essb_options, 'mycred_points', '1');
		
		$more_button_icon = ESSBOptionValuesHelper::options_value($essb_options, 'more_button_icon');
		
		$comments_address = ESSBOptionValuesHelper::options_value($essb_options, 'comments_address');
		if ($comments_address == '') {
			$comments_address = '#comments';
		}
		
		$button_follow_state = "nofollow";
		if (ESSBOptionValuesHelper::options_bool_value($essb_options, 'use_rel_me')) {
			$button_follow_state = "me";
		}
		
		if (isset($style['more_button_icon'])) {
			$more_button_icon = $style['more_button_icon'];
		}
		
		// beginning of share buttons snippet
		$content .= ESSBButtonHelper::draw_buttons_start ( $style, $position, $salt, $like_or_share, $share );
		$is_active_more_button = false;
		
		foreach ( $networks_order as $single ) {
			// generate single network button
			if (in_array ( $single, $networks )) {
				
				if ($single == "no") { continue; }
				
				$url = '';
				$api_command = '';
				
				$link_target = "_blank";
				
				$single_share_address = $single;
				$icon = $single;
				
				// specail network code
				if ($single == "print" && ESSBOptionValuesHelper::options_bool_value($essb_options, 'print_use_printfriendly')) {
					$single_share_address = "print_friendly";
				}

				if ($single == "mail" && ESSBOptionValuesHelper::options_value($essb_options, 'mail_function') == "form") {
					$single_share_address = "mail_form";
				}	

				if ($single == "pinterest" && !ESSBOptionValuesHelper::options_bool_value($essb_options, 'pinterest_sniff_disable')) {
					$single_share_address = "pinterest_picker";
				}
				

				if ($single == "more" && $style['more_button_func'] != "1") {
					$single_share_address = "more_popup";
				}
				
				if ($single == "more" && $more_button_icon == "dots") {
					$icon = "more_dots";
				}
								
				// get single social network commands
				$share_details = ESSBButtonHelper::get_share_address($single_share_address, $share, $salt);
				$url = $share_details['url'];
				$api_command = $share_details['api_command'];

				if ($single == "sidebar-close") {
					$api_command = "";
				}
				
				if ($single == "comments") {
					$api_command = "";
					$url = $comments_address;
					$link_target = "_self";
				}
				
				$hover_text = ESSBOptionValuesHelper::options_value($essb_options, 'hovertext_'.$single);
				
				$name = isset($network_names[$single]) ? $network_names[$single] : '';
				$noname_class = "";
				if ($style['button_style'] == "icon" || $name == "-" || $single == "more") {
					$noname_class = " essb_noname";
				}
				if ($style['counter_pos'] == "insidehover") {
					$noname_class .= " essb_hideonhover";
				}
				// clean network names when depends on button style or seleceted network
				if ($style['button_style'] == "icon" || (($style['counter_pos'] == "inside" || $style['counter_pos'] == "bottom") && $style['show_counter'] ) || $name == "-" || $single == "more") {
					$name = "";
				}
				
							
				$mycred_token = "";
				if (defined ('ESSB3_MYCRED_ACTIVE')) {
					$mycred_token = ESSBMyCredIntegration::generate_mycred_datatoken($mycred_group, $mycred_points);
				}
				
				$more_after_class = ($is_active_more_button) ? " essb_after_more" : "";
				
				if ($single == "sidebar-close") {
					$more_after_class = "";
				}
				
				$content .= sprintf('<li class="essb_item essb_link_%8$s nolightbox%2$s">
						<a href="%3$s" title="%4$s" onclick="%5$s" target="%10$s" rel="%11$s" %7$s><span class="essb_icon"></span><span class="essb_network_name%9$s">%6$s</span></a></li>', 
						$single, $more_after_class, $url, $hover_text, $api_command, $name, $mycred_token, $icon, $noname_class, $link_target, $button_follow_state);
				
				// at the end toggle more button state
				if ($single == "more") { 
					$is_active_more_button = true;
				}
			}
		}
		
		// adding less button when + function of more button is active
		if ($is_active_more_button && $style['more_button_func'] == "1") {
			$share_details = ESSBButtonHelper::get_share_address("less", $share, $salt);
			$url = $share_details['url'];
			$api_command = $share_details['api_command'];
			
			$content .= sprintf('<li class="essb_item essb_link_%1$s nolightbox%2$s">
					<a href="%3$s" title="%4$s" onclick="%5$s" target="_blank" rel="nofollow"><span class="essb_icon"></span><span class="essb_network_name">%6$s</span></a></li>',
					"less", $more_after_class, $url, "", $api_command, "");
			
		}
		
		if (is_array($native_buttons)) {
			if ($native_buttons['active']) {
				if ($native_buttons['sameline']) {
  					$content .= ESSBNativeButtonsHelper::draw_native_buttons($native_buttons, $native_buttons['order'], $native_buttons['counters'],
							$native_buttons['sameline'], $native_buttons['skinned']);
				}
			}
		}
		
		// end of share buttons snippet
		$content .= ESSBButtonHelper::draw_buttons_end ( $style, $position, $salt, $like_or_share );
		
		return $content;
	}
	
	public static function get_share_address($network, $share = array(), $salt = '') {
		global $essb_networks, $essb_options;
		
		// TODO: add handle of user_image_url
		
		if (ESSBOptionValuesHelper::options_bool_value($essb_options, 'advanced_custom_share')) {
			$as_url = ESSBOptionValuesHelper::options_value($essb_options, 'as_'.$network.'_url');
			$as_text = ESSBOptionValuesHelper::options_value($essb_options, 'as_'.$network.'_text');
			$as_image = ESSBOptionValuesHelper::options_value($essb_options, 'as_'.$network.'_image');
			$as_desc = ESSBOptionValuesHelper::options_value($essb_options, 'as_'.$network.'_desc');
			
			if (!empty($as_url)) {
				$share['url'] = $as_url;
			}
			if (!empty($as_text)) {
				$as_text = preg_replace(array('#%title%#', '#%siteurl%#', '#%permalink%#', '#%image%#', '#%shorturl%#'), array($share['title'], get_site_url(), $share['url'], $share['image'], $share['short_url']), $as_text);				
				$share['title'] = $as_text;
			}
			if (!empty($as_image)) {
				$share['image'] = $as_image;
			}
			if (!empty($as_desc)) {
				$as_desc = preg_replace(array('#%title%#', '#%siteurl%#', '#%permalink%#', '#%image%#', '#%shorturl%#'), array($share['title'], get_site_url(), $share['url'], $share['image'], $share['short_url']), $as_desc);				
				$share['description'] = $as_desc;
			}
		}
		
		$share['url'] = esc_attr($share['url']);
		$share['short_url'] = esc_attr($share['short_url']);
		$share['full_url'] = esc_attr($share['full_url']);
		$share['title'] = esc_attr($share['title']);
		$share['image'] = esc_attr($share['image']);
		$share['description'] = esc_attr($share['description']);
		
		$pinterest_description = $share['description'];
		if (empty($pinterest_description)) {
			$pinterest_description = $share['title'];
		}
		
		$url = "";
		$api_command = "";
		
		$network_type = "buildin";
		if (isset($essb_networks[$network])) {
			$network_type = isset($essb_networks[$network]['type']) ? $essb_networks[$network]['type'] : "buildin";
		}
		
		switch ($network) {
			case "facebook" :
				$url = sprintf ( 'http://www.facebook.com/sharer/sharer.php?u=%1$s&t=%2$s', $share ['url'], $share ['title'] );
				break;
			case "twitter" :
				if ($share['short_url_twitter'] == '') {
					$share['short_url_twitter'] = $share['url'];
				}
				
				$twitter_pass_user = ($share['twitter_user'] != '') ? sprintf('&amp;related=%1$s&amp;via=%1$s', $share['twitter_user']) : "";
				
				$use_tweet = $share ['twitter_tweet'];
				$use_tweet = str_replace('#', '%23', $use_tweet);
				
				$url = sprintf ( 'https://twitter.com/intent/tweet?text=%1$s&amp;url=%2$s&amp;counturl=%3$s%4$s&amp;hashtags=%5$s', $use_tweet, $share ['short_url_twitter'], $share ['full_url'], $twitter_pass_user, $share ['twitter_hashtags'] );
				break;
			case "google" :
				$url = sprintf ( 'https://plus.google.com/share?url=%1$s', $share ['url'] );
				break;
			case "pinterest" :
				$url = sprintf ( 'http://pinterest.com/pin/create/bookmarklet/?media=%1$s&amp;url=%2$s&amp;title=%3$s&amp;description=%4$s', $share ['image'], $share ['url'], $share ['title'], $pinterest_description );
				break;
			case "pinterest_picker" :
				$url = "#";
				$api_command = "essb_pinterest_picker(&#39;" . $salt . "&#39;); return false;";
				break;
			case "linkedin" :
				$url = sprintf ( 'http://www.linkedin.com/shareArticle?mini=true&amp;ro=true&amp;trk=EasySocialShareButtons&amp;title=%1$s&amp;url=%2$s', $share ['title'], $share ['url'] );
				break;
			case "digg" :
				$url = sprintf ( 'http://digg.com/submit?phase=2%20&amp;url=%1$s&amp;title=%2$s', $share ['url'], $share ['title'] );
				break;
			case "reddit" :
				$url = sprintf ( 'http://reddit.com/submit?url=%1$s&amp;title=%2$s', $share ['url'], $share ['title'] );
				break;
			case "del" :
				$url = sprintf ( 'https://delicious.com/save?v=5&noui&jump=close&url=%1$s&amp;title=%2$s', $share ['url'], $share ['title'] );
				break;
			case "buffer" :
				$url = sprintf ( 'https://bufferapp.com/add?url=%1$s&text=%2$s&via=%3$s&picture=&count=horizontal&source=button', $share ['url'], $share ['title'], $share ['twitter_user'] );
				break;
			case "love" :
				$url = "#";
				$api_command = "essb_lovethis(&#39;" . $salt . "&#39;); return false;";
				break;
			case "stumbleupon" :
				$url = sprintf ( 'http://www.stumbleupon.com/badge/?url=%1$s', $share ['full_url'] );
				break;
			case "tumblr" :
				$url = sprintf ( 'http://tumblr.com/share?s=&v=3&t=%1$s&u=%2$s', $share ['title'], urlencode ( $share ['url'] ) );
				break;
			case "vk" :
				$url = sprintf ( 'http://vkontakte.ru/share.php?url=%1$s', $share ['url'] );
				break;
			case "ok" :
				$url = sprintf ( 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=%1$s', $share ['url'] );
				break;
			case "weibo" :
				$url = sprintf ( 'http://service.weibo.com/share/share.php?url=%1$s', $share ['url'] );
				break;
			case "xing" :
				$url = sprintf ( 'https://www.xing.com/social_plugins/share?h=1;url=%1$s', $share ['url'] );
				break;
			case "pocket" :
				$url = sprintf ( 'https://getpocket.com/save?title=%1$s&url=%2$s', $share ['title'], urlencode ( $share ['url'] ) );
				break;
			case "mwp" :
				$url = sprintf ( 'http://managewp.org/share/form?url=%1$s', urlencode ( $share ['url'] ) );
				break;
			case "whatsapp" :
				if ($share['short_url_whatsapp'] == '') {
					$share['short_url_whatsapp'] = $share['url'];
				}
				
				$url = sprintf ( 'whatsapp://send?text=%1$s%3$s%2$s', ESSBCoreHelper::urlencode ( $share ['title_plain'] ), rawurlencode ( $share ['short_url_whatsapp'] ), '%20' );
				break;
			case "meneame" :
				$url = sprintf ( 'http://www.meneame.net/submit.php?url=%1$s', $share ['url'] );
				break;
			case "print_friendly" :
				$url = sprintf ( 'http://www.printfriendly.com/print/?url=%1$s', $share ['url'] );
				break;
			case "print" :
				$url = "#";
				$api_command = "essb_print(&#39;" . $salt . "&#39;); return false;";
				break;
			case "mail" :
				$url = sprintf('mailto:?subject=%1$s&amp;body=%2$s', $share['mail_subject'], $share['mail_body']);
				break;
			case "mail_form" :
				$url = "#";
				$api_command = "essb_mailform_".$salt."(&#39;" . $salt . "&#39;); return false;";
				break;
			case "more" :
				$url = "#";
				$api_command = "essb_toggle_more(&#39;" . $salt . "&#39;); return false;";
				break;
			case "less" :
				$url = "#";
				$api_command = "essb_toggle_less(&#39;" . $salt . "&#39;); return false;";
				break;
			case "more_popup" :
				$url = "#";
				$api_command = "essb_toggle_more_popup(&#39;" . $salt . "&#39;); return false;";
				break;
			case "flattr" :
				$url = ESSBNetworks_Flattr::getStaticFlattrUrl ($share);
				break;			
			// @since 3.0
			case "blogger" :
				$url = sprintf ( 'https://www.blogger.com/blog_this.pyra?t&u=%1$s&n=%2$s', $share ['url'], $share ['title'] );
				break;
			case 'amazon' :
				$url = sprintf ( 'http://www.amazon.com/gp/wishlist/static-add?u=%1$s&t=%2$s', $share ['url'], $share ['title'] );
				break;
			case 'yahoomail' :
				$url = sprintf ( 'http://compose.mail.yahoo.com/?body=%1$s', $share ['url'] );
				break;
			
			case 'gmail' :
				$url = sprintf ( 'https://mail.google.com/mail/u/0/?view=cm&fs=1&su=%2$s&body=%1$s&ui=2&tf=1', $share ['url'], $share ['title'] );
				break;
			
			case 'aol' :
				$url = sprintf ( 'http://webmail.aol.com/Mail/ComposeMessage.aspx?subject=%2$s&body=%1$s', $share ['url'], $share ['title'] );
				break;
			
			case 'newsvine' :
				$url = sprintf ( 'http://www.newsvine.com/_tools/seed&save?u=%1$s&h=%2$s', $share ['url'], $share ['title'] );
				break;
			
			case 'hackernews' :
				$url = sprintf ( 'https://news.ycombinator.com/submitlink?u=%1$s&t=%2$s', $share ['url'], $share ['title'] );
				break;
			
			case 'evernote' :
				$url = sprintf ( 'http://www.evernote.com/clip.action?url=%1$s&title=%2$s', $share ['url'], $share ['title'] );
				break;
			case 'myspace':
				$url = sprintf( 'https://myspace.com/post?u=%1$s',
						esc_attr( $share ['url'] )
				);
				break;
			case "mailru":
				$url = sprintf('http://connect.mail.ru/share?url=%1$s&title=%2$s&description=%3$s', $share['url'], $share['title'], $share['description']);
				break;
			case "viadeo":
				$url = sprintf('https://www.viadeo.com/?url=%1$s&amp;title=%2$s', $share['url'], $share['title']);
				break;
			case "line":
				//$url = sprintf('http://line.me/R/msg/text/%1$s%20%2$s', ESSBCoreHelper::urlencode ( $share ['title'] ), rawurlencode ( $share ['short_url_whatsapp'] ));
				$url = sprintf('line://msg/text/%1$s%3$s%2$s', ESSBCoreHelper::urlencode ( $share ['title_plain'] ), rawurlencode ( $share ['short_url_whatsapp'] ), '%20');
				break;
			case "embedly":
				$url = "";
				$api_command = "embedly.modal();";
				break;
			case "flipboard":
				$url = sprintf('https://share.flipboard.com/bookmarklet/popout?url=%1$s&title=%2$s', $share['url'], $share['title']);
				break;
			case "yummly" :
				$url = sprintf ( 'http://www.yummly.com/urb/verify?url=%2$s&title=%3$s&image=%1$s&yumtype=button', $share ['image'], $share ['url'], $share ['title'], $share ['description'] );
				break;				
			default:
				// @since 3.0 - module parsing social buttons or custom social buttons
				if ($network_type != 'buildin') {
					/*$url = '';
					$api_command = '';
					
					$button_object_name = "ESSBNetwork_".$network;
					if (method_exists($button_object_name, 'get_share_address')) {
						$url = $button_object_name::get_share_address($share);
					}
					if (method_exists($button_object_name, 'get_api_command')) {
						$api_command = $button_object_name::get_api_command($share);
					}*/
				}
				break;
		}
		
		if ($api_command == '') {
			$api_command = sprintf('essb_window(&#39;%1$s&#39;,&#39;%2$s&#39;,&#39;%3$s&#39;); return false;', $url, $network, $salt);
			
			if ($network == "twitter") {
				$url = "#";
			}
		}
		
		return array("url" => $url, 'api_command' => $api_command);
	}
	
	public static function print_mailer_code($title, $text, $salt_parent, $post_id, $shorturl = '') {
		global $post;
	
		$site_title = get_the_title();
		$url = get_site_url();
		$permalink = get_permalink();
	
		$salt = mt_rand ();
		$mailform_id = 'essb_mail_from_'.$salt;
		$stats_callback = "essb_tracking_only('', 'mail', '".$salt_parent."');";
	
	
		//$text =nl2br($text);
		$text = str_replace("\r", "", $text);
		$text = str_replace("\n", "", $text);
	
		$text = str_replace("'", "&apos;", $text);
		$title = str_replace("'", "&apos;", $title);
		$site_title = str_replace("'", "&apos;", $site_title);
	
		$siteurl = ESSB3_PLUGIN_URL. '/';
	
		$image = has_post_thumbnail( $post->ID ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ) : '';
		$post_image = ($image != '') ? $image[0] : '';
		$html = 'function essb_mailform_'.$salt_parent.'() {
		'.$stats_callback.'		
		essb_mailer(\''.$title.'\', \''.$text.'\', \''.$site_title.'\', \''.$url.'\', \''.$post_image.'\', \''.$permalink.'\', \''.$shorturl.'\');
	};';
	
		return $html;
	}
	

}

?>