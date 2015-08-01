(function() {
    tinymce.create('tinymce.plugins.penguinshortcodes', {
		
        init: function(ed, url) {

			// Register example button
            ed.addButton('penguinshortcodes', {
                title: 'Alterna | Shortcodes',
				style :'background-image: url("'+url+"/penguinshortcodes.png"+'"); background-repeat: no-repeat; background-position: 2px 2px;"',
				text: "",
			icon: true,
			type: 'menubutton',
			menu: [
					{
						text: 'Page Columns',
						menu: [
								{
									text: '1/1',
									onclick: function() {
										ed.insertContent('[one]Add in your content here.[one]');
									}
								},
								{
									text: '1/2 + 1/2',
									onclick: function() {
										ed.insertContent('[row][one_half]Add in your content here.[/one_half][one_half]Add in your content here.[/one_half][/row]');
									}
								},
								{
									text: '1/3 + 1/3 + 1/3',
									onclick: function() {
										ed.insertContent('[row][one_third]Add in your content here.[/one_third][one_third]Add in your content here.[/one_third][one_third]Add in your content here.[/one_third][/row]');
									}
								},
								{
									text: '1/3 + 2/3',
									onclick: function() {
										ed.insertContent('[row][one_third]Add in your content here.[/one_third][two_third]Add in your content here.[/two_third][/row]');
									}
								},
								{
									text: '2/3 + 1/3',
									onclick: function() {
										ed.insertContent('[row][two_third]Add in your content here.[/two_third][one_third]Add in your content here.[/one_third][/row]');
									}
								},
								{
									text: '1/4 + 1/4 + 1/4 + 1/4',
									onclick: function() {
										ed.insertContent('[row][one_fourth]Add in your content here.[/one_fourth][one_fourth]Add in your content here.[/one_fourth][one_fourth]Add in your content here.[/one_fourth][one_fourth]Add in your content here.[/one_fourth][/row]');
									}
								},
								{
									text: '1/4 + 2/4 + 1/4',
									onclick: function() {
										ed.insertContent('[row][one_fourth]Add in your content here.[/one_fourth][two_fourth]Add in your content here.[/two_fourth][one_fourth]Add in your content here.[/one_fourth][/row]');
									}
								},
								{
									text: '1/4 + 1/4 + 2/4',
									onclick: function() {
										ed.insertContent('[row][one_fourth]Add in your content here.[/one_fourth][one_fourth]Add in your content here.[/one_fourth][two_fourth]Add in your content here.[/two_fourth][/row]');
									}
								},
								{
									text: '2/4 + 1/4 + 1/4',
									onclick: function() {
										ed.insertContent('[row][two_fourth]Add in your content here.[/two_fourth][one_fourth]Add in your content here.[/one_fourth][one_fourth]Add in your content here.[/one_fourth][/row]');
									}
								},
								{
									text: '1/4 + 3/4',
									onclick: function() {
										ed.insertContent('[row][one_fourth]Add in your content here.[/one_fourth][three_fourth]Add in your content here.[/three_fourth][/row]');
									}
								},
								{
									text: '3/4 + 1/4',
									onclick: function() {
										ed.insertContent('[row][three_fourth]Add in your content here.[/three_fourth][one_fourth]Add in your content here.[/one_fourth][/row]');
									}
								},
								{
									text: 'Inner Columns',
									menu: [
										{
											text: '1/1',
											onclick: function() {
												ed.insertContent('[one]Add in your content here.[one]');
											}
										},
										{
											text: '1/2 + 1/2',
											onclick: function() {
												ed.insertContent('[inner_row][one_half]Add in your content here.[/one_half][one_half]Add in your content here.[/one_half][/inner_row');
											}
										},
										{
											text: '1/3 + 1/3 + 1/3',
											onclick: function() {
												ed.insertContent('[inner_row[one_third]Add in your content here.[/one_third][one_third]Add in your content here.[/one_third][one_third]Add in your content here.[/one_third][/inner_row');
											}
										},
										{
											text: '1/3 + 2/3',
											onclick: function() {
												ed.insertContent('[inner_row[one_third]Add in your content here.[/one_third][two_third]Add in your content here.[/two_third][/inner_row');
											}
										},
										{
											text: '2/3 + 1/3',
											onclick: function() {
												ed.insertContent('[inner_row[two_third]Add in your content here.[/two_third][one_third]Add in your content here.[/one_third][/inner_row');
											}
										},
										{
											text: '1/4 + 1/4 + 1/4 + 1/4',
											onclick: function() {
												ed.insertContent('[inner_row[one_fourth]Add in your content here.[/one_fourth][one_fourth]Add in your content here.[/one_fourth][one_fourth]Add in your content here.[/one_fourth][one_fourth]Add in your content here.[/one_fourth][/inner_row');
											}
										},
										{
											text: '1/4 + 2/4 + 1/4',
											onclick: function() {
												ed.insertContent('[inner_row[one_fourth]Add in your content here.[/one_fourth][two_fourth]Add in your content here.[/two_fourth][one_fourth]Add in your content here.[/one_fourth][/inner_row');
											}
										},
										{
											text: '1/4 + 1/4 + 2/4',
											onclick: function() {
												ed.insertContent('[inner_row[one_fourth]Add in your content here.[/one_fourth][one_fourth]Add in your content here.[/one_fourth][two_fourth]Add in your content here.[/two_fourth][/inner_row');
											}
										},
										{
											text: '2/4 + 1/4 + 1/4',
											onclick: function() {
												ed.insertContent('[inner_row[two_fourth]Add in your content here.[/two_fourth][one_fourth]Add in your content here.[/one_fourth][one_fourth]Add in your content here.[/one_fourth][/inner_row');
											}
										},
										{
											text: '1/4 + 3/4',
											onclick: function() {
												ed.insertContent('[inner_row[one_fourth]Add in your content here.[/one_fourth][three_fourth]Add in your content here.[/three_fourth][/inner_row');
											}
										},
										{
											text: '3/4 + 1/4',
											onclick: function() {
												ed.insertContent('[inner_row[three_fourth]Add in your content here.[/three_fourth][one_fourth]Add in your content here.[/one_fourth][/inner_row');
											}
										},
									]
								}
							]
					},
					{
						text: 'Page Elements',
						menu: [
								{
									text: 'Wide Background',
									onclick: function() {
										ed.insertContent('[wide id="" class="" style=""]Add in your content here.[/wide]');
									}
								},
								{
									text: 'Space',
									onclick: function() {
										ed.insertContent('[space size="" line="yes" style="solid"]');
									}
								},
								{
									text: 'Title',
									onclick: function() {
										ed.insertContent('[title text="Alterna TITLE" icon="fa-flag" icon_color="red"]');
									}
								},
								{
									text: 'Button',
									onclick: function() {
										ed.insertContent('[button text="Button" icon="fa-star" style="float-btn" color="theme" url="#"]');
									}
								},
								{
									text: 'Service',
									onclick: function() {
										ed.insertContent('[service icon="fa-flag" title="Alterna Service" color="theme" align="center"]Add in your content here.[/service]');
									}
								},
								{
									text: 'Skills',
									onclick: function() {
										ed.insertContent('[skills][skill name="HTML5" percent="40%" color="theme"][skill name="WORDPRESS" percent="70%" color="red"][/skills]');
									}
								},
								{
									text: 'Bullets',
									onclick: function() {
										ed.insertContent('[bullets effect="none"][bullet icon="fa-flag" color="theme"]Bullet 1[/bullet][bullet icon="fa-flag" color="theme"]Add in your content here.[/bullet][/bullets]');
									}
								},
								{
									text: 'Image',
									onclick: function() {
										ed.insertContent('[img src="image url" align="alignleft" effect="none"]');
									}
								},
								{
									text: 'Alert Message',
									onclick: function() {
										ed.insertContent('[alert type="alert-warning" close="yes"]Add in your content here.[/alert]');
									}
								},
								{
									text: 'Icon',
									onclick: function() {
										ed.insertContent('[icon name="fa-flag" color="theme"]');
									}
								},
								{
									text: 'Dropcap',
									onclick: function() {
										ed.insertContent('[dropcap text="R" type="default" txt_color="#ffffff" bg_color="#000000"]');
									}
								},
								{
									text: 'Blockquote',
									onclick: function() {
										ed.insertContent('[blockquote border_color="#00a9e0" bg_color="#f2f2f2" effect="none"]Add in your content here.[/blockquote ]');
									}
								}
							]
					},
					{
						text: 'Posts Elements',
						menu: [
								{
									text: 'Blog List',
									onclick: function() {
										ed.insertContent('[blog_list style="1" number="4" columns="4" type="recent" orderby="" cat__in="" tag__in="" post__in="" post__not_in="" effect="none" nocrop="off"]');
									}
								},
								{
									text: 'Portfolio List',
									onclick: function() {
										ed.insertContent('[portfolio_list style="1" number="4" columns="4" type="recent" orderby="" cat__in="" tag__in="" post__in="" post__not_in="" effect="none" nocrop="off"]');
									}
								}
							]
					},
					{
						text: 'Tools Elements',
						menu: [
								{
									text: 'Call to action',
									onclick: function() {
										ed.insertContent('[call_to_action style="default" size="big" title="Awesome WordPress Theme" btn_title="Purchase The Theme" url="#" target="_self" btn_color="theme" btn_style="float-btn" effect="none"]Do you looking for an awesome wordpress theme for your website?[/call_to_action]');
									}
								},
								{
									text: 'Price Plan',
									onclick: function() {
										ed.insertContent('[price type="default" title="Plan" price="100" color="theme" btn_text="FREE TRIAL" btn_icon="" btn_url="#" btn_target="_self" btn_style="float-btn" effect="none"]<ul><li>Plan details 1</li><li>Plan details 2</li></ul>[/price]');
									}
								},
								{
									text: 'Tabs',
									onclick: function() {
										ed.insertContent('[tabs align="left" effect="none" ][tabs_item title="Tab 1"]Tab Content[/tabs_item][tabs_item title="Tab 2" icon="fa-flag"]Add in your content here.[/tabs_item][/tabs]');
									}
								},
								{
									text: 'SideTabs',
									onclick: function() {
										ed.insertContent('[sidetabs align="left" effect="none" ][sidetabs_item title="Side Tab 1"]Add in your content here.[/sidetabs_item][sidetabs_item title="Side Tab 2" icon="fa-flag"]Add in your content here.[/sidetabs_item][/sidetabs]');
									}
								},
								{
									text: 'Accordion',
									onclick: function() {
										ed.insertContent('[accordion effect="none"][accordion_item title="Accordion Title 1" open="yes" color="theme"]Add in your content here.[/accordion_item][accordion_item title="Accordion Title 2" color="theme"]Add in your content here.[/accordion_item][/accordion]');
									}
								},
								{
									text: 'Toggle',
									onclick: function() {
										ed.insertContent('[toggle title="Toggle Title" open="no" color="theme" faq="yes" effect="none"]Add in your content here.[/toggle]');
									}
								},
								{
									text: 'History',
									onclick: function() {
										ed.insertContent('[history date="2014-11-22" start="yes" title="Title" color="theme"]Add in your content here.[/history]');
									}
								},
								{
									text: 'Testimonials',
									onclick: function() {
										ed.insertContent('[testimonials type="" autoplay="yes" delay="6000" effect="none"][testimonials_item name="John Deo" job="Designer"]Add in your content here.[/testimonials_item][testimonials_item name="Jason" job="Coder"]Add in your content here.[/testimonials_item][testimonials_item name="Tom" job="Coder"]Add in your content here.[/testimonials_item][/testimonials]');
									}
								},
								{
									text: 'Clients',
									onclick: function() {
										ed.insertContent('[clients effect="none"][client url="#" target="_blank" src="logo image url" alt=""][client url="#" target="_blank" src="logo image url" alt=""][/clients]');
									}
								},
								{
									text: 'Team',
									onclick: function() {
										ed.insertContent('[team name="User Name" job="Job" src="" color="theme" effect="none"]Add in your content here.[/team]');
									}
								},
								{
									text: 'One Page Nav',
									onclick: function() {
										ed.insertContent('[pagenav position="right"][pagenav_item link="home" title="Home"][pagenav_item link="theme-services" title="Services"][pagenav_item link="theme-works" title="Works"][pagenav_item link="theme-team" title="Team"][pagenav_item link="theme-contact" title="Contact"][/pagenav]');
									}
								}
								
							]
					},
					{
						text: 'Media Elements',
						menu: [
								{
									text: 'Socials',
									onclick: function() {
										ed.insertContent('[social tooltip="yes" tooltip_placement="bottom" bg_color="#f2f2f2"][social_item type="twitter" url="#"][social_item type="facebook" url="#"][/social]');
									}
								},
								{
									text: 'Flex Slider',
									onclick: function() {
										ed.insertContent('[flexslider auto="yes" delay="6000"][flexslider_item type="image" src="image url" url="#" target="_self"][/flexslider_item][flexslider_item type="video"]Input video content when used video type like use vimeo shortcode.[/flexslider_item][/flexslider]');
									}
								},
								{
									text: 'Carousel',
									onclick: function() {
										ed.insertContent('[carousel auto="yes" delay="6000"][carousel_item src="image url"]Add in your content here.[/carousel_item][/carousel]');
									}
								},
								{
									text: 'Google Maps',
									onclick: function() {
										ed.insertContent('[map zoom="13" draggable="yes" scrollwheel="yes" width="100%" height="350" latlng="MAP_LAT_LNG like 40.716038,-74.080811" show_marker="yes" show_info="yes" info_width="240" theme="default"]Add in your content here.[/map]');
									}
								},
								{
									text: 'Youtube',
									onclick: function() {
										ed.insertContent('[youtube id="Enter video ID (eg.6qmj5mhDwJQ)" width="100%" height="400"]');
									}
								},
								{
									text: 'Vimeo',
									onclick: function() {
										ed.insertContent('[vimeo id="Enter video ID (eg.54578415)" width="100%" height="440"]');
									}
								},
								{
									text: 'SoundCloud',
									onclick: function() {
										ed.insertContent('[soundcloud url="Enter soundcloud URL (eg.http://api.soundcloud.com/tracks/38987054)"]');
									}
								}
							]
					},
					{
						text: 'Alterna Shortcode Help',
						icon:'help',
								onclick: function() {
									window.open('http://support.themefocus.co','newwindow');
								}
					}
				]
            });

			// Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('penguinshortcodes', n.nodeName == 'IMG');
            });
        },
        getInfo: function() {
            return {
                longname: 'penguinshortcodes',
                author: 'ThemeFocus',
                authorurl: 'http://themefocus.co',
                infourl: 'http://penguin.themefocus.co',
                version: "1.0"
            };
        }
    });

// Register plugin
    tinymce.PluginManager.add('penguinshortcodes', tinymce.plugins.penguinshortcodes);
})();