<?php
/**
 * Penguin Framework Config for penguin framework.
 *
 * @package Penguin
 * @version 6.0
 */
global $alterna_options, $google_fonts, $options_custom_color;

// theme directory
$dir = get_template_directory_uri();

require_once("penguin/penguin-functions.php");
require_once("penguin/penguin.php");

/**
* Option page content
*/
$page_content = array();

/* General Page */
$page_content[] = array(
	'section' => 'general',
	'icon'	=>	'fa-cog',
	'name' => __('General','alterna'),
	'title' => __('General Setting','alterna'),
	'elements'	=> array(
		'theme_update'		=> array(
				'title' => __('Theme License Information &amp; Auto Update Setting','alterna'),
				'type' 	=> 'moreline',
				'moreline'	=> array(
					'envato_name'		=> array(
						'name'	=> __('Username','alterna'),
						'type'	=>	'input',
						'property'	=> 'theme-name',
						'desc'	=> __('Envato market username.','alterna')
					),
					'envato_purchase_code'		=> array(
							'name'	=> __('Purchase Code','alterna'),
							'type'	=>	'input',
							'property'	=> 'theme-purchase-code',
							'desc'	=> __('Download License Certificate will find Item Purchase Code.','alterna')
						),
					'envato_api'		=> array(
							'name'	=> __('Envato API','alterna'),
							'type'	=>	'input',
							'property'	=> 'theme-api',
							'desc'	=> __('To obtain your API Key, visit "My Settings" page on any of the Envato Marketplaces.','alterna')
						),
					'enable_auto'	=>	array(
							'name'	=> __('Theme Auto Update','alterna'),
							'type'	=>	'pc',
							'desc' => __('Turn on auto update when have new version.','alterna'),
							'property'	=> 'theme-update-enable'
						)
				)
			),
		'favicon'		=> array(
				'name'	=> __('Favicon','alterna'),
				'title'	=> __('Favicon','alterna'),
				'type'	=>	'upload',
				'property'	=> 'favicon',
			),
		'rss_feed'		=> array(
				'name'	=> __('Feed url','alterna'),
				'title'	=> __('RSS Feed','alterna'),
				'type'	=>	'input',
				'property'	=> 'rss-feed',
			),
		'global'		=> array(
				'title' => __('Global Setting','alterna'),
				'type' 	=> 'moreline',
				'moreline'	=> array(
					'global_layout'		=> array(
							'name'	=> __('Global Layout','alterna'),
							'type'	=>	'radio',
							'property'	=> 'global-layout',
							'radios'	=> array(0 => 'Boxed', 1 => 'Full Width'),
							'enable-element' => 'yes',
							'enable-id'		=> '0-pe_global_layout',
							'enable-group'	=> 'pe_global_layout_group'
						),
					'global_boxed_padding'		=> array(
						'name'	=> __('Boxed Layout Padding','alterna'),
						'type'	=>	'number',
						'default'	=> 30, 
						'after'	=> __('px','alterna'),
						'property'	=> 'global-layout-boxed-padding',
						'desc'	=> __('Setting boxed layout top &amp; bottom padding value','alterna'),
						'enabled-id'		=> 'pe_global_layout',
						'enable-group'	=> 'pe_global_layout_group'
					),
					'global_max_width'		=> array(
						'name'	=> __('Global Layout Content Width','alterna'),
						'type'	=>	'number',
						'default'	=> 1170,
						'min'	=>	970,
						'max'	=>	1170,
						'after'	=> __('px','alterna'),
						'property'	=> 'global-layout-width',
						'desc'	=> __('Setting global layout content max width like 1170, please use number 970 - 1170','alterna'),
					),
					'global_sidebar_layout'		=> array(
							'name'	=> __('Global Sidebar Layout','alterna'),
							'type'	=>	'radio',
							'property'	=> 'global-sidebar-layout',
							'default'	=> 1,
							'radios'	=> array(0 => 'Left Sidebar', 1 => 'Right Sidebar', 2 => 'Full Width')
					),
					'global_breadcrumbs'		=> array(
							'name'	=> __('Enable Plugin Breadcrumbs','alterna'),
							'type'	=>	'pc',
							'desc' => __('Turn on enable Breadcrumbs With WordPress SEO by Yoast.','alterna'),
							'property'	=> 'global-breakcrumbs-enable',
					),
					'fontawesome-cdn'		=> array(
							'name'	=> __('Enable CDN','alterna'),
							'type'	=>	'pc',
							'desc' => __('Turn on enable Bootstrap &amp; FontAwesome from CDN.','alterna'),
							'property'	=> 'bootstrap-fontawesome-cdn',
					)
				)
			),
		'google_analytics'		=> array(
				'title'	=> __('Google Analytics','alterna'),
				'type'	=>	'moreline',
				'moreline'	=> array(
						'position' => array(
							'name'	=> __('Script position','alterna'),
							'type' 	=> 'radio',
							'property' => 'google_analytics-position',
							'radios'	=> array(
									'radios_1' => __('Header','alterna'),
									'radios_2' => __('Footer','alterna')
								)
							
							),
						'scripts' => array(
							'name'	=> __('Analytics script','alterna'),
							'type' 	=> 'textarea',
							'property' => 'google_analytics-text',
							'desc'	=> __('Paste your Google Analytics or other tracking code here.','alterna')
							)	
					)
			)
	),
);

/* WooCommerce Setting */
$page_content[] = array(
	'section' => 'woocommerce',
	'icon'	=>	'fa-shopping-cart',
	'name' => __('WooCommerce','alterna'),
	'title' => __('WooCommerce Basic Setting','alterna'),
	'elements'	=> array(
	'woocommerce_setting'		=> array(
				'title'	=> __('WooCommerce Setting','alterna'),
				'type'	=>	'moreline',
				'moreline'	=> array(
						'shop_per_page' => array(
							'name'	=> __('Shop Per Page Number','alterna'),
							'type' 	=> 'number',
							'property' => 'shop-per-page',
							),
						'enable_product_search'	=>	array(
							'name'	=> __('Enabled Header Product Search','alterna'),
							'type'	=>	'pc',
							'desc' => __('Turn on enabled product search form.','alterna'),
							'property'	=> 'shop-product-search'
						),
					)
				)
			)
	);
	
/* Background */	
$page_content[] = array(
	'section' => 'background',
	'icon'	=>	'fa-certificate',
	'name' => __('Background','alterna'),
	'title' => __('Background Setting','alterna'),
	'elements'	=> array(
			'background_enable'		=> array(
				'title'	=> __('Enable Custom Background Setting','alterna'),
				'name'	=> __('Enable Custom Background','alterna'),
				'type' 	=> 'pe',
				'property' => 'custom-background-enable',
				'enable-element' => 'yes',
				'enable-id'		=> '1-pe_custom_background',
				'enable-group'	=> 'pe_custom_background_group'
				),
			'background_setting'	=> array(
				'title'	=> __('Body Background Setting','alterna'),
				'type'	=>	'moreline',
				'enabled-id'		=> 'pe_custom_background',
				'enable-group'	=> 'pe_custom_background_group',
				'moreline'	=> array(
						'background_type' => array(
							'name'	=> __('Body Background Type','alterna'),
							'type' 	=> 'radio',
							'property' => 'global-bg-type',
							'radios' => array(__('Pattern','alterna'),__('Image','alterna'),__('Color','alterna')),
							'enable-element' => 'yes',
							'enable-id'		=> '0-global_bg_type_pattern:1-global_bg_type_image:2-global_bg_type_color',
							'enable-group'	=> 'global_bg_type_group'
						),
						'background_pattern_width' => array(
							'name'	=> __('Pattern Image Width','alterna'),
							'type' 	=> 'number',
							'property' => 'global-bg-pattern-width',
							'enabled-id'		=> 'global_bg_type_pattern',
							'enable-group'	=> 'global_bg_type_group'
						),
						'background_pattern_height' => array(
							'name'	=> __('Pattern Image Height','alterna'),
							'type' 	=> 'number',
							'property' => 'global-bg-pattern-height',
							'enabled-id'		=> 'global_bg_type_pattern',
							'enable-group'	=> 'global_bg_type_group'
						),
						'background_pattern_image' => array(
							'name'	=> __('Pattern Image','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-bg-pattern-image',
							'enabled-id'		=> 'global_bg_type_pattern',
							'enable-group'	=> 'global_bg_type_group'
						),
						'background_pattern_retina' => array(
							'name'	=> __('Pattern Retina Image @2x','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-bg-pattern-retina',
							'enabled-id'		=> 'global_bg_type_pattern',
							'enable-group'	=> 'global_bg_type_group'
						),
						'background_image' => array(
							'name'	=> __('Background Image','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-bg-image',
							'enabled-id'		=> 'global_bg_type_image',
							'enable-group'	=> 'global_bg_type_group'
						),
						'background_color' => array(
							'name'	=> __('Background Color','alterna'),
							'type' 	=> 'color',
							'default'	=>	'ffffff',
							'property' => 'global-bg-color',
							'enabled-id'		=> 'global_bg_type_color',
							'enable-group'	=> 'global_bg_type_group'
						)
					)
			),
			'header_background_setting'	=> array(
				'title'	=> __('Header Background Setting','alterna'),
				'type'	=>	'moreline',
				'enabled-id'		=> 'pe_custom_background',
				'enable-group'	=> 'pe_custom_background_group',
				'moreline'	=> array(
						'background_type' => array(
							'name'	=> __('Header Background Type','alterna'),
							'type' 	=> 'radio',
							'property' => 'global-header-bg-type',
							'radios' => array(__('Pattern','alterna'),__('Image','alterna'),__('Color','alterna')),
							'enable-element' => 'yes',
							'enable-id'		=> '0-global_header_bg_type_pattern:1-global_header_bg_type_image:2-global_header_bg_type_color',
							'enable-group'	=> 'global_header_bg_type_group'
						),
						'background_pattern_width' => array(
							'name'	=> __('Pattern Image Width','alterna'),
							'type' 	=> 'number',
							'property' => 'global-header-bg-pattern-width',
							'enabled-id'		=> 'global_header_bg_type_pattern',
							'enable-group'	=> 'global_header_bg_type_group'
						),
						'background_pattern_height' => array(
							'name'	=> __('Pattern Image Height','alterna'),
							'type' 	=> 'number',
							'property' => 'global-header-bg-pattern-height',
							'enabled-id'		=> 'global_header_bg_type_pattern',
							'enable-group'	=> 'global_header_bg_type_group'
						),
						'background_pattern_image' => array(
							'name'	=> __('Pattern Image','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-header-bg-pattern-image',
							'enabled-id'		=> 'global_header_bg_type_pattern',
							'enable-group'	=> 'global_header_bg_type_group'
						),
						'background_pattern_retina' => array(
							'name'	=> __('Pattern Retina Image @2x','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-header-bg-pattern-retina',
							'enabled-id'		=> 'global_header_bg_type_pattern',
							'enable-group'	=> 'global_header_bg_type_group'
						),
						'background_image' => array(
							'name'	=> __('Background Image','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-header-bg-image',
							'enabled-id'		=> 'global_header_bg_type_image',
							'enable-group'	=> 'global_header_bg_type_group'
						),
						'background_color' => array(
							'name'	=> __('Background Color','alterna'),
							'type' 	=> 'color',
							'property' => 'global-header-bg-color',
							'enabled-id'		=> 'global_header_bg_type_color',
							'enable-group'	=> 'global_header_bg_type_group'
						)
					)
			),
			'title_background_setting'	=> array(
				'title'	=> __('Title Background Setting','alterna'),
				'type'	=>	'moreline',
				'enabled-id'		=> 'pe_custom_background',
				'enable-group'	=> 'pe_custom_background_group',
				'moreline'	=> array(
						'background_type' => array(
							'name'	=> __('Title Background Type','alterna'),
							'type' 	=> 'radio',
							'property' => 'global-title-bg-type',
							'radios' => array(__('Pattern','alterna'),__('Image','alterna'),__('Color','alterna')),
							'enable-element' => 'yes',
							'enable-id'		=> '0-global_title_bg_type_pattern:1-global_title_bg_type_image:2-global_title_bg_type_color',
							'enable-group'	=> 'global_title_bg_type_group'
						),
						'background_pattern_width' => array(
							'name'	=> __('Pattern Image Width','alterna'),
							'type' 	=> 'number',
							'property' => 'global-title-bg-pattern-width',
							'enabled-id'		=> 'global_title_bg_type_pattern',
							'enable-group'	=> 'global_title_bg_type_group'
						),
						'background_pattern_height' => array(
							'name'	=> __('Pattern Image Height','alterna'),
							'type' 	=> 'number',
							'property' => 'global-title-bg-pattern-height',
							'enabled-id'		=> 'global_title_bg_type_pattern',
							'enable-group'	=> 'global_title_bg_type_group'
						),
						'background_pattern_image' => array(
							'name'	=> __('Pattern Image','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-title-bg-pattern-image',
							'enabled-id'		=> 'global_title_bg_type_pattern',
							'enable-group'	=> 'global_title_bg_type_group'
						),
						'background_pattern_retina' => array(
							'name'	=> __('Pattern Retina Image @2x','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-title-bg-pattern-retina',
							'enabled-id'		=> 'global_title_bg_type_pattern',
							'enable-group'	=> 'global_title_bg_type_group'
						),
						'background_image' => array(
							'name'	=> __('Background Image','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-title-bg-image',
							'enabled-id'		=> 'global_title_bg_type_image',
							'enable-group'	=> 'global_title_bg_type_group'
						),
						'background_color' => array(
							'name'	=> __('Background Color','alterna'),
							'type' 	=> 'color',
							'property' => 'global-title-bg-color',
							'enabled-id'		=> 'global_title_bg_type_color',
							'enable-group'	=> 'global_title_bg_type_group'
						)
					)
			),
			'content_background_setting'	=> array(
				'title'	=> __('Content Background Setting','alterna'),
				'type'	=>	'moreline',
				'enabled-id'		=> 'pe_custom_background',
				'enable-group'	=> 'pe_custom_background_group',
				'moreline'	=> array(
						'background_type' => array(
							'name'	=> __('Content Background Type','alterna'),
							'type' 	=> 'radio',
							'property' => 'global-content-bg-type',
							'radios' => array(__('Pattern','alterna'),__('Image','alterna'),__('Color','alterna')),
							'enable-element' => 'yes',
							'enable-id'		=> '0-global_content_bg_type_pattern:1-global_content_bg_type_image:2-global_content_bg_type_color',
							'enable-group'	=> 'global_content_bg_type_group'
						),
						'background_pattern_width' => array(
							'name'	=> __('Pattern Image Width','alterna'),
							'type' 	=> 'number',
							'property' => 'global-content-bg-pattern-width',
							'enabled-id'		=> 'global_content_bg_type_pattern',
							'enable-group'	=> 'global_content_bg_type_group'
						),
						'background_pattern_height' => array(
							'name'	=> __('Pattern Image Height','alterna'),
							'type' 	=> 'number',
							'property' => 'global-content-bg-pattern-height',
							'enabled-id'		=> 'global_content_bg_type_pattern',
							'enable-group'	=> 'global_content_bg_type_group'
						),
						'background_pattern_image' => array(
							'name'	=> __('Pattern Image','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-content-bg-pattern-image',
							'enabled-id'		=> 'global_content_bg_type_pattern',
							'enable-group'	=> 'global_content_bg_type_group'
						),
						'background_pattern_retina' => array(
							'name'	=> __('Pattern Retina Image @2x','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-content-bg-pattern-retina',
							'enabled-id'		=> 'global_content_bg_type_pattern',
							'enable-group'	=> 'global_content_bg_type_group'
						),
						'background_image' => array(
							'name'	=> __('Background Image','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-content-bg-image',
							'enabled-id'		=> 'global_content_bg_type_image',
							'enable-group'	=> 'global_content_bg_type_group'
						),
						'background_color' => array(
							'name'	=> __('Background Color','alterna'),
							'type' 	=> 'color',
							'property' => 'global-content-bg-color',
							'enabled-id'		=> 'global_content_bg_type_color',
							'enable-group'	=> 'global_content_bg_type_group'
						)
					)
			),
			'footer_background_setting'	=> array(
				'title'	=> __('Footer Background Setting','alterna'),
				'type'	=>	'moreline',
				'enabled-id'		=> 'pe_custom_background',
				'enable-group'	=> 'pe_custom_background_group',
				'moreline'	=> array(
						'background_type' => array(
							'name'	=> __('Footer Background Type','alterna'),
							'type' 	=> 'radio',
							'property' => 'global-footer-bg-type',
							'default'	=> 2,
							'radios' => array(__('Pattern','alterna'),__('Image','alterna'),__('Color','alterna')),
							'enable-element' => 'yes',
							'enable-id'		=> '0-global_footer_bg_type_pattern:1-global_footer_bg_type_image:2-global_footer_bg_type_color',
							'enable-group'	=> 'global_footer_bg_type_group'
						),
						'background_pattern_width' => array(
							'name'	=> __('Pattern Image Width','alterna'),
							'type' 	=> 'number',
							'default'	=>	100,
							'property' => 'global-footer-bg-pattern-width',
							'enabled-id'		=> 'global_footer_bg_type_pattern',
							'enable-group'	=> 'global_footer_bg_type_group'
						),
						'background_pattern_height' => array(
							'name'	=> __('Pattern Image Height','alterna'),
							'type' 	=> 'number',
							'default'	=>	100,
							'property' => 'global-footer-bg-pattern-height',
							'enabled-id'		=> 'global_footer_bg_type_pattern',
							'enable-group'	=> 'global_footer_bg_type_group'
						),
						'background_pattern_image' => array(
							'name'	=> __('Pattern Image','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-footer-bg-pattern-image',
							'enabled-id'		=> 'global_footer_bg_type_pattern',
							'enable-group'	=> 'global_footer_bg_type_group'
						),
						'background_pattern_retina' => array(
							'name'	=> __('Pattern Retina Image @2x','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-footer-bg-pattern-retina',
							'enabled-id'		=> 'global_footer_bg_type_pattern',
							'enable-group'	=> 'global_footer_bg_type_group'
						),
						'background_image' => array(
							'name'	=> __('Background Image','alterna'),
							'type' 	=> 'upload',
							'property' => 'global-footer-bg-image',
							'enabled-id'		=> 'global_footer_bg_type_image',
							'enable-group'	=> 'global_footer_bg_type_group'
						),
						'background_color' => array(
							'name'	=> __('Background Color','alterna'),
							'type' 	=> 'color',
							'property' => 'global-footer-bg-color',
							'enabled-id'		=> 'global_footer_bg_type_color',
							'enable-group'	=> 'global_footer_bg_type_group'
						),
						'border_color' => array(
							'name'	=> __('Border Top Color','alterna'),
							'type' 	=> 'color',
							'property' => 'global-footer-border-color',
							'enabled-id'		=> 'global_footer_bg_type_color global_footer_bg_type_image global_footer_bg_type_pattern',
							'enable-group'	=> 'global_footer_bg_type_group'
						),
						'bottom_bg_color' => array(
							'name'	=> __('Bottom Content Background Color','alterna'),
							'type' 	=> 'color',
							'property' => 'global-footer-bottom-bg-color',
							'enabled-id'		=> 'global_footer_bg_type_color global_footer_bg_type_image global_footer_bg_type_pattern',
							'enable-group'	=> 'global_footer_bg_type_group'
						),
						'bottom_border_color' => array(
							'name'	=> __('Bottom Content Border Top Color','alterna'),
							'type' 	=> 'color',
							'property' => 'global-footer-bottom-border-color',
							'enabled-id'		=> 'global_footer_bg_type_color global_footer_bg_type_image global_footer_bg_type_pattern',
							'enable-group'	=> 'global_footer_bg_type_group'
						)
					)
			)
	)
);

/* Header */
$page_content[] = array(
		'section' => 'header',
		'icon'	=>	'fa-tasks',
		'name' => __('Header','alterna'),
		'title' => __('Header Setting','alterna'),
		'elements'	=> array(
			'header_style'	=> array(
				'title' => __('Header Style Setting','alterna'),
				'type' 	=> 'moreline',
				'moreline'	=> array(
					'header_type'		=> array(
						'name'	=> __('Header Style','alterna'),
						'type'	=>	'select',
						'property'	=> 'header-style-type',
						'default'	=> 0,
						'options'	=> array(0 => __('Bottom Menu Style #1','alterna'),
                                                                         1 => __('Right Menu Style #2','alterna'),
                                                                         2 => __('Center Style #3','alterna'),
                                                                         3 => __('Right Menu Style #4','alterna'),
                                                                         4 => __('Right Menu Style #5','alterna'),
                                                                         5 => __('Left Menu Style #6','alterna'),
                                                                         6 => __('Bottom Menu Style #7','alterna')
                                                                    ),
						'enable-element' => 'yes',
						'enable-id'		=> '0-pe_header_custom_enable:1-pe_header_custom_enable_1:2-pe_header_custom_enable_2',
						'enable-group'	=> 'pe_header_custom_enable_group',
					),
					/*'mega_menu_enable'	=> array(
							'name'	=> __('Enable Mega Menu','alterna'),
							'type' 	=> 'pc',
							'desc' => __('Check to enable mega menu support','alterna'),
							'property' => 'header-megamenu-enable'
						),*/
					'top_banner_enable'	=> array(
							'name'	=> __('Enable Top Banner','alterna'),
							'type' 	=> 'pc',
							'desc' => __('Check to enable top banner','alterna'),
							'property' => 'header-banner-enable',
							'enable-element' => 'yes',
							'enable-id'		=> '1-pe_topbanner_enable',
							'enable-group'	=> 'pe_topbanner_enable_group'
						),
					'top_topbar_enable'	=> array(
							'name'	=> __('Enable Topbar','alterna'),
							'type' 	=> 'pc',
							'desc' => __('Check to enable topbar','alterna'),
							'property' => 'topbar-enable',
							'enable-element' => 'yes',
							'enable-id'		=> '1-pe_topbar_enable',
							'enable-group'	=> 'pe_topbar_enable_group'
						),
					'search_enable'	=> array(
							'name'	=> __('Enable Search Form','alterna'),
							'type' 	=> 'pc',
							'desc' => __('Check to enable search form','alterna'),
							'property' => 'header-search-enable'
						),
				)
			),
			'logo_custom'	=> array(
				'title' => __('Custom Logo','alterna'),
				'type' 	=> 'moreline',
				'moreline'	=> array(
						'logo_enable_txt'	=> array(
							'name'	=> __('Enable text logo','alterna'),
							'type' 	=> 'pc',
							'desc' => __('Check to enable text logo','alterna'),
							'property' => 'logo-txt-enable',
							'enable-element' => 'yes',
							'enable-id'		=> '0-pe_logo_txt_enable',
							'enable-group'	=> 'pe_logo_txt_enable_group'
						),
						'logo_image'	=> array(
							'name'	=> __('Logo image url','alterna'),
							'type' 	=> 'upload',
							'property' => 'logo-image',
							'enabled-id'		=> 'pe_logo_txt_enable',
							'enable-group'	=> 'pe_logo_txt_enable_group'
							),
						'logo_retina_image'	=> array(
							'name'	=> __('Logo retina image @2x','alterna'),
							'type' 	=> 'upload',
							'property' => 'logo-retina-image',
							'desc'	=> __('You need upload a retina logo @2x default logo size. ','alterna'),
							'enabled-id'		=> 'pe_logo_txt_enable',
							'enable-group'	=> 'pe_logo_txt_enable_group'
							),
						'logo_image_width' => array(
							'name'	=> __('Logo image width','alterna'),
							'type' 	=> 'number',
							'property' => 'logo-image-width',
							'after'	=>	'px',
							'enabled-id'		=> 'pe_logo_txt_enable',
							'enable-group'	=> 'pe_logo_txt_enable_group'
							),
						'logo_image_height' => array(
							'name'	=> __('Logo image height','alterna'),
							'type' 	=> 'number',
							'property' => 'logo-image-height',
							'after'	=>	'px',
							'enabled-id'		=> 'pe_logo_txt_enable',
							'enable-group'	=> 'pe_logo_txt_enable_group'
							)
					)
			),
			'fixed_header'	=> array(
				'title' => __('Fixed Header','alterna'),
				'type' 	=> 'moreline',
				'moreline'	=> array(
						'fixed_enable'	=> array(
							'name'	=> __('Enable fixed header','alterna'),
							'type' 	=> 'pc',
							'desc' => __('Check to enable fixed header','alterna'),
							'property' => 'fixed-enable',
							'enable-element' => 'yes',
							'enable-id'		=> '1-pe_fixed_header_enable',
							'enable-group'	=> 'pe_fixed_header_enable_group'
						),
						'fixed_logo_image'	=> array(
							'name'	=> __('Fixed header logo image url','alterna'),
							'type' 	=> 'upload',
							'property' => 'fixed-logo-image',
							'desc'	=> __('It\'s important logo when scroll window show fixed header! Logo height fixed 44px.','alterna'),
							'enabled-id'		=> 'pe_fixed_header_enable',
							'enable-group'	=> 'pe_fixed_header_enable_group'
							),
						'fixed_logo_retina_image'	=> array(
							'name'	=> __('Fixed header logo retina image @2x','alterna'),
							'type' 	=> 'upload',
							'property' => 'fixed-logo-retina-image',
							'desc'	=> __('You need upload a retina support logo @2x default logo.','alterna'),
							'enabled-id'		=> 'pe_fixed_header_enable',
							'enable-group'	=> 'pe_fixed_header_enable_group'
							),
						'fixed_logo_image_width' => array(
							'name'	=> __('Fixed header logo image width','alterna'),
							'type' 	=> 'number',
							'property' => 'fixed-logo-image-width',
							'after'	=>	'px',
							'enabled-id'		=> 'pe_fixed_header_enable',
							'enable-group'	=> 'pe_fixed_header_enable_group'
							)
					)
			),
			'header_banner_setting'	=> array(
				'title' => __('Header Banner Setting','alterna'),
				'type' 	=> 'moreline',
				'enabled-id'	=> 'pe_topbanner_enable',
				'enable-group'	=> 'pe_topbanner_enable_group',
				'moreline'	=> array(
						'header_banner_id' => array(
							'name'	=> __('ID','alterna'),
							'type'	=>	'input',
							'property' => 'header-banner-id',
							'desc'	=> __('Use it different before banner id','alterna')
							),
						'header_banner_content' => array(
							'name'	=> __('Content','alterna'),
							'type'	=>	'textarea',
							'property' => 'header-banner-content',
							'desc'	=> __('Support HTML format','alterna')
							)
					)
			),
			'header_topbar_setting'	=> array(
				'title' => __('Header Topbar Setting','alterna'),
				'type' 	=> 'moreline',
				'enabled-id'		=> 'pe_topbar_enable',
				'enable-group'	=> 'pe_topbar_enable_group',
				'moreline'	=> array(
					'topbar_style'	=> array(
						'name'		=> __('Topbar Basic Columns','alterna'),
						'type'		=> 'pi',
						'property'	=> 'topbar-layout',
						'radios'	=> array( 	array('1/1',$dir.'/img/penguin/footer_widget_11.png'),
												array('1/2-1/2',$dir.'/img/penguin/footer_widget_5.png'),
												array('1/3-2/3',$dir.'/img/penguin/footer_widget_9.png'),
												array('2/3-1/3',$dir.'/img/penguin/footer_widget_10.png')
											),
						'desc'		=> __('If you choose full width will just show right side element.','alterna'),
					),
					'topbar'	=> array(
						'name'		=> __('Custom Topbar Show Element','alterna'),
						'type'		=> 'drag',
						'property'	=> 'topbar-elements',
						'position'	=> array(__('Left Side','alterna'),__('Right Side','alterna')),
						'fields'	=> array(
										array('index'=>0, 'open'=> 2, 'name' => __('Topbar Menu','alterna')),
										array('index'=>1, 'open'=> 2, 'name' => __('Socials','alterna')),
										array('index'=>2, 'open'=> 2, 'name' => __('Switch Language','alterna')),
										array('index'=>3, 'open'=> 2, 'name' => __('Custom Content','alterna')),
										array('index'=>4, 'open'=> 2, 'name' => __('Login','alterna')),
										array('index'=>5, 'open'=> 2, 'name' => __('Cart','alterna'))
								),	
						'desc'		=> __('Drag module as sort show;Click show position as where show it.(Right area position need you view site make sure is you wanted.)','alterna')
					),
					'topbar_custom'	=> array(
						'name'		=> __('Topbar Custom Content','alterna'),
						'type'		=> 'textarea',
						'property'	=> 'topbar-custom-content',
						'desc'		=> __('Support html code for topbar custom content.','alterna')
					)	,
					
				)
			),
			'header_style_1_area'	=> array(
				'title' => __('Header Style 1, 2, 3 Custom Area Setting','alterna'),
				'type' 	=> 'moreline',
				'enabled-id'		=> 'pe_header_custom_enable pe_header_custom_enable_1 pe_header_custom_enable_2',
				'enable-group'	=> 'pe_header_custom_enable_group',
				'moreline'	=> array(
					'area_type'		=> array(
						'name'	=> __('Custom Area Show Type','alterna'),
						'type'	=>	'select',
						'property'	=> 'header-right-area-type',
						'default'	=> 0,
						'options'	=> array(0 => 'Default Show Social', 1 => 'Custom Content'),
						'desc'	=> __('If you want to custom content, please choose "Custom". It\'s works for header style 1 right social area and header style 2, 3 social area ','alterna')
					),
					'area_custom_content'	=> array(
						'name'	=> __('Header Custom Area Content','alterna'),
						'type'	=>	'textarea',
						'property'	=> 'header-right-area-content',
						'desc'	=> __('Support HTML CODE for your custom content!','alterna')
					),
				)
			),
			'padding_custom'	=> array(
				'title' => __('Header Area Setting','alterna'),
				'type' 	=> 'moreline',
				'moreline'	=> array(
						'logo_image_padding-top' => array(
							'name'	=> __('Logo Padding Top','alterna'),
							'type' 	=> 'number',
							'property' => 'logo-image-padding-top',
							'after'	=>	'px'
							),
						'header_right_area_padding_top' => array(
							'name'	=> __('Right Content Padding Top','alterna'),
							'type' 	=> 'number',
							'property' => 'header-right-area-padding-top',
							'after'	=>	'px'
							),
						'topbar_login_page'	=> array(
								'name'	=> __('Custom Login Page Link','alterna'),
								'type'	=>	'input',
								'property'	=> 'topbar-login-page',
								'desc'	=> __('Click login tools turn to which page (Which had used "Login Template" )!','alterna'),
						),
						'header_6_login_btn'	=> array(
								'name'	=> __('Enable Login &amp; Register Button','alterna'),
								'type'	=>	'pc',
								'property'	=> 'header-style-6-login-btn',
								'desc'	=> __('Click enable Header Style #6 button','alterna'),
						)
					)
			)
		)
	);

/* Footer */
$page_content[] = array(
		'section' => 'footer',
		'icon'	=>	'fa-ellipsis-h',
		'name' => __('Footer','alterna'),
		'title' => __('Footer Setting','alterna'),
		'elements'	=> array(
			'footer_widget_style'	=> array(
				'name'	=> __('Footer Widget Basic Columns','alterna'),
				'title'	=> __('Footer Widget Setting','alterna'),
				'type' 	=> 'pi',
				'property' => 'footer-widget-style',
				'radios'	=> array( 	array('1-1-1-1',$dir.'/img/penguin/footer_widget_1.png'),
										array('1-2-1',$dir.'/img/penguin/footer_widget_2.png'),
										array('2-1-1',$dir.'/img/penguin/footer_widget_3.png'),
										array('1-1-2',$dir.'/img/penguin/footer_widget_4.png'),
										array('2-2',$dir.'/img/penguin/footer_widget_5.png'),
										array('1-3',$dir.'/img/penguin/footer_widget_6.png'),
										array('3-1',$dir.'/img/penguin/footer_widget_7.png'),
										array('1',$dir.'/img/penguin/footer_widget_11.png'),
										array('1-1-1',$dir.'/img/penguin/footer_widget_8.png'),
										array('1-2',$dir.'/img/penguin/footer_widget_9.png'),
										array('2-1',$dir.'/img/penguin/footer_widget_10.png'),
									),
				'desc' => __('It\'s also depends your footer widgets had added content.','alterna'),
			),
			'footer_copyright_message'		=> array(
				'name'	=> __('Footer Copyright Setting','alterna'),
				'title'	=> __('Copyright Content','alterna'),
				'type'	=>	'textarea',
				'property'	=> 'footer-copyright-message',
			),
			'footer_link'		=> array(
				'name'	=> __('Footer Right Content Setting','alterna'),
				'title'	=> __('Link Content','alterna'),
				'type'	=>	'textarea',
				'property'	=> 'footer-link-text',
			),
			'footer_banner_setting'	=> array(
				'title' => __('Footer Banner Setting','alterna'),
				'type' 	=> 'moreline',
				'moreline'	=> array(
						'footer_banner_enable'	=> array(
							'name'	=> __('Enable Bottom Banner','alterna'),
							'type' 	=> 'pc',
							'desc' => __('Check to enable bottom banner','alterna'),
							'property' => 'footer-banner-enable',
							'enable-element' => 'yes',
							'enable-id'		=> '1-pe_footer_banner_enable',
							'enable-group'	=> 'pe_footer_banner_enable_group'
						),
						'footer_banner_id' => array(
							'name'	=> __('ID','alterna'),
							'type'	=>	'input',
							'property' => 'footer-banner-id',
							'desc'	=> __('Use it different before banner id','alterna'),
							'enabled-id'		=> 'pe_footer_banner_enable',
							'enable-group'	=> 'pe_footer_banner_enable_group'
							),
						'footer_banner_content' => array(
							'name'	=> __('Content','alterna'),
							'type'	=>	'textarea',
							'property' => 'footer-banner-content',
							'desc'	=> __('Support HTML format','alterna'),
							'enabled-id'		=> 'pe_footer_banner_enable',
							'enable-group'	=> 'pe_footer_banner_enable_group'
							)
					)
			),
		)
	);
	
/* Font Setting Page */
$page_content[] = array(
	'section' => 'font',
	'icon'	=>	'fa-text-width',
	'name' => __('Font','alterna'),
	'title' => __('Font Setting','alterna'),
	'elements'	=> array(
			'font_enable'		=> array(
				'title'	=> __('Enable Font Setting','alterna'),
				'name'	=> __('Enable Custom Font','alterna'),
				'type' 	=> 'pc',
				'property' => 'custom-enable-font',
				'desc'	=> __('Just when enable custom font,then all choose font will run.','alterna'),
				'enable-element' => 'yes',
				'enable-id'		=> '1-pe_custom_font',
				'enable-group'	=> 'pe_custom_font_group'
				),
			'font_setting'	=> array(
				'title'	=> __('Theme Font Setting','alterna'),
				'type'	=>	'moreline',
				'enabled-id'		=> 'pe_custom_font',
				'enable-group'	=> 'pe_custom_font_group',
				'moreline'	=> array(
						'general_font' => array(
							'name'	=> __('General Font','alterna'),
							'type' 	=> 'select',
							'property' => 'custom-general-font',
							'default_option'	=> 'Default: Open Sans',
							'option_array'	=> $google_fonts,
							'desc' => __('Now have 676+ Google web fonts for u choose!','alterna')
							),
						'general_font_weight' => array(
							'name'	=> __('Font Weight','alterna'),
							'type' 	=> 'input',
							'default'	=> '300,300italic,400,400italic,700,700italic',
							'property' => 'custom-general-font-weight',
							'desc' => __('You can check font support style http://google.com/fonts/','alterna')
							),
						'general_font_size' => array(
							'name'	=> '',
							'type' 	=> 'number',
							'property' => 'custom-general-font-size',
							'after'	=>	'px'
							),
						'top_nav_font' => array(
							'name'	=> __('Header Menu Font','alterna'),
							'type' 	=> 'select',
							'property' => 'custom-menu-font',
							'default_option'	=> 'Default: Open Sans',
							'option_array'	=> $google_fonts
							),
						'top_nav_font_weight' => array(
							'name'	=> __('Font Weight','alterna'),
							'type' 	=> 'input',
							'default'	=> '400',
							'property' => 'custom-menu-font-weight',
							),
						'top_nav_font_size' => array(
							'name'	=> '',
							'type' 	=> 'number',
							'property' => 'custom-menu-font-size',
							'after'	=>	'px'
							),
						'title_font' => array(
							'name'	=> __('Title (h1-h6) Font','alterna'),
							'type' 	=> 'select',
							'property' => 'custom-title-font',
							'default_option'	=> 'Default: Open Sans',
							'option_array'	=> $google_fonts
							),
						'title_font_weight' => array(
							'name'	=> __('Font Weight','alterna'),
							'type' 	=> 'input',
							'default'	=> '300,300italic,400,400italic,700,700italic',
							'property' => 'custom-title-font-weight',
							),
						'subset_font' => array(
							'name'	=> __('Google Fonts Subsets','alterna'),
							'type' 	=> 'input',
							'property' => 'google-font-subset',
							'desc' => __('Some of the fonts in the Google Font Directory support multiple scripts (like Latin and Cyrillic for example). Example: "latin,cyrillic" please use "," for more subsets ','alterna')
							),
					)
			),
		)
	);

/* Color Setting Page */
$page_content[] = array(
	'section' => 'color',
	'icon'	=>	'fa-magic',
	'name' => __('Color','alterna'),
	'title' => __('Color Setting','alterna'),
	'elements'	=> array(
			'enable_colors'		=> array(
				'title'	=> __('Enable Color Setting','alterna'),
				'name'	=> __('Enable Custom Color','alterna'),
				'type' 	=> 'pc',
				'property' => 'custom-enable-color',
				'desc'	=> __('Just when enable custom color,then all choose color will run.','alterna'),
				'enable-element' => 'yes',
				'enable-id'		=> '1-pe_custom_color',
				'enable-group'	=> 'pe_custom_color_group'
				),
			'theme_color'		=> array(
				'title'	=> __('Theme Colors Setting','alterna'),
				'type'	=>	'moreline',
				'enabled-id' 	=> 'pe_custom_color',
				'enable-group'	=> 'pe_custom_color_group',
				'moreline'	=> array(
						'theme_color' => array(
							'name'	=> __('Theme Color','alterna'),
							'type' 	=> 'color',
							'property' => 'theme-color'
							),
						'general_text_color' => array(
							'name'	=> __('General Text Color','alterna'),
							'type' 	=> 'color',
							'property' => 'custom-general-color',
							'desc'	=> __('General default text color for div,p,span,a color','alterna')
							),
						'links_color' => array(
							'name'	=> __('Links Color','alterna'),
							'type' 	=> 'color',
							'property' => 'custom-links-color'
							),
						'links_hover_color' => array(
							'name'	=> __('Links Hover Color','alterna'),
							'type' 	=> 'color',
							'property' => 'custom-links-hover-color'
							),
						'h_color' => array(
							'name'	=> __('H1-H6 Color','alterna'),
							'type' 	=> 'color',
							'property' => 'custom-h-color',
							'desc'	=> __('h1,h2,h3,h4,h5,h6 default color','alterna')
							),
					),
					
				),
				'theme_menu_color'		=> array(
						'title'	=> __('Header Menu Colors Setting','alterna'),
						'type'	=>	'moreline',
						'enabled-id' 	=> 'pe_custom_color',
						'enable-group'	=> 'pe_custom_color_group',
						'moreline'	=> array(
								'top_menu_bg_color' => array(
									'name'	=> __('Background Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-menu-background-color',
									'desc'	=> __('Header menu background color','alterna')
									),
								'top_menu_bg_hover_color' => array(
									'name'	=> __('Background Hover Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-menu-background-hover-color',
									'desc'	=> __('Header menu background hover color','alterna')
									),
								'top_menu_border_bottom_color' => array(
									'name'	=> __('Border Bottom Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-menu-border-bottom-color',
									'desc'	=> __('Header menu border bottom color','alterna')
									),
								'top_sub_menu_bg_color' => array(
									'name'	=> __('Sub Menu Background Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-sub-menu-background-color',
									'desc'	=> __('Header sub menu background color','alterna')
									),
								'top_sub_hover_menu_bg_color' => array(
									'name'	=> __('Sub Menu Background Hover Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-sub-menu-hover-background-color',
									'desc'	=> __('Header sub menu hover background color','alterna')
									),
								'top_sub_hover_menu_border_top_color' => array(
									'name'	=> __('Sub Menu Border Top Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-sub-menu-hover-border-top-color',
									'desc'	=> __('Header sub menu border top color','alterna')
									),
								'top_sub_hover_menu_border_bottom_color' => array(
									'name'	=> __('Sub Menu Border Bottom Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-sub-menu-hover-border-bottom-color',
									'desc'	=> __('Header sub menu border bottom color','alterna')
									),
								'top_menu_font_color' => array(
									'name'	=> __('Links Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-menu-font-color',
									'desc'	=> __('Header menu links color','alterna')
									),
								'top_hover_menu_font_color' => array(
									'name'	=> __('Links Hover Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-menu-hover-font-color',
									'desc'	=> __('Header menu links hover color','alterna')
									),
								'top_sub_menu_font_color' => array(
									'name'	=> __('Sub Menu Links Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-sub-menu-font-color',
									'desc'	=> __('Header sub menu links color','alterna')
									),
								'top_sub_hover_menu_font_color' => array(
									'name'	=> __('Sub Menu Links Hover Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-sub-menu-hover-font-color',
									'desc'	=> __('Header sub menu links hover color','alterna')
									),
							)
					),
				'theme_mobile_menu_color'		=> array(
						'title'	=> __('Header Menu Mobile Colors Setting','alterna'),
						'type'	=>	'moreline',
						'enabled-id' 	=> 'pe_custom_color',
						'enable-group'	=> 'pe_custom_color_group',
						'moreline'	=> array(
								'mobile_menu_bg_color' => array(
									'name'	=> __('Background Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-mobile-menu-background-color',
									'desc'	=> __('Header mobile menu background color','alterna')
									),
                                                                'mobile_2_level_menu_bg_color' => array(
									'name'	=> __('2 Level Background Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-mobile-2-level-menu-background-color',
									'desc'	=> __('Header mobile 2 level menu background color','alterna')
									),
                                                                'mobile_3_level_menu_bg_color' => array(
									'name'	=> __('3 Level Background Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-mobile-3-level-menu-background-color',
									'desc'	=> __('Header mobile 3 level menu background color','alterna')
									),
								'mobile_menu_font_color' => array(
									'name'	=> __('Links Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-mobile-menu-font-color',
									'desc'	=> __('Header mobile menu links color','alterna')
									),
								'mobile_hover_menu_font_color' => array(
									'name'	=> __('Links Hover Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-mobile-menu-hover-font-color',
									'desc'	=> __('Header mobile menu links hover color','alterna')
									),
                                                                'mobile_icon_color' => array(
									'name'	=> __('Icon Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-mobile-icon-color',
									'desc'	=> __('Header mobile menu icon color','alterna')
									),
                                                                'mobile_icon_border_color' => array(
									'name'	=> __('Icon Border Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-mobile-icon-border-color',
									'desc'	=> __('Header mobile menu icon border color','alterna')
									),
                                                                'mobile_menu_top_border_color' => array(
									'name'	=> __('Menu Top Border Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-mobile-menu-top-border-color',
									'desc'	=> __('Header mobile menu top border color','alterna')
									)
							)
					),
				'theme_header_banner_color'		=> array(
						'title'	=> __('Header Banner Colors Setting','alterna'),
						'type'	=>	'moreline',
						'enabled-id' 	=> 'pe_custom_color',
						'enable-group'	=> 'pe_custom_color_group',
						'moreline'	=> array(
								'header_banner_color' => array(
									'name'	=> __('Background Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-header-banner-bg-color',
									'desc'	=> __('Header banner area background color','alterna')
									),
								'header_general_color' => array(
									'name'	=> __('Text Default Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-header-banner-text-color',
									'desc'	=> __('Header banner area text default color','alterna')
									),
								'header_links_color' => array(
									'name'	=> __('Links Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-header-banner-links-color',
									'desc'	=> __('Header banner area links color','alterna')
									),
								'header_links_color_hover' => array(
									'name'	=> __('Links Hover Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-header-banner-links-hover-color',
									'desc'	=> __('Header banner area links hover color','alterna')
									)
							)
					),
				'theme_topbar_color'		=> array(
						'title'	=> __('Header Topbar Area Colors Setting','alterna'),
						'type'	=>	'moreline',
						'enabled-id' 	=> 'pe_custom_color',
						'enable-group'	=> 'pe_custom_color_group',
						'moreline'	=> array(
								'header_topbar_color' => array(
									'name'	=> __('Background Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-header-topbar-bg-color',
									'desc'	=> __('Header topbar area background color','alterna')
									),
								'header_topbar_border_color' => array(
									'name'	=> __('Border Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-header-topbar-border-color',
									'desc'	=> __('Header topbar area border color','alterna')
									),
								'header_topbar_sub_menu_hover_bg_color' => array(
									'name'	=> __('Menu Hover Background Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-header-topbar-sub-menu-hover-bg-color',
									'desc'	=> __('Header topbar area sub menu hover background color','alterna')
									),
								'header_topbar_font_color' => array(
									'name'	=> __('Text Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-header-topbar-font-color',
									'desc'	=> __('Header topbar area text color','alterna')
									),
								'header_topbar_font_over_color' => array(
									'name'	=> __('Topbar Links Hover Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-header-topbar-hover-font-color',
									'desc'	=> __('Header topbar area links hover color','alterna')
									)
							)
					),
				'theme_footer_color'		=> array(
						'title'	=> __('Footer Area Colors Setting','alterna'),
						'type'	=>	'moreline',
						'enabled-id' 	=> 'pe_custom_color',
						'enable-group'	=> 'pe_custom_color_group',
						'moreline'	=> array(
								'footer_text_color' => array(
									'name'	=> __('Text Default Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-text-color',
									'desc'	=> __('Footer area text default color','alterna')
									),
								'footer_links_color' => array(
									'name'	=> __('Links Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-links-color',
									'desc'	=> __('Footer area links color','alterna')
									),
								'footer_links_color_hover' => array(
									'name'	=> __('Links Hover Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-links-hover-color',
									'desc'	=> __('Footer area links hover color','alterna')
									),
								'footer_h_color' => array(
									'name'	=> __('Widget Title Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-h-color',

									'desc'	=> __('Footer area widget title color ','alterna')
									),
								'footer_bottom_color' => array(
									'name'	=> __('Footer Bottom Text Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-bottom-color',
									'desc'	=> __('Footer bottom area text color','alterna')
									),
								'footer_bottom_links_color' => array(
									'name'	=> __('Footer Bottom Links Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-bottom-links-color',
									'desc'	=> __('Footer bottom area links color','alterna')
									),
								'footer_bottom_links_color_hover' => array(
									'name'	=> __('Footer Bottom Links Hover Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-bottom-links-hover-color',
									'desc'	=> __('Footer bottom area links hover color','alterna')
									)
								
							)
					),
					'theme_footer_banner_color'		=> array(
						'title'	=> __('Footer Banner Colors Setting','alterna'),
						'type'	=>	'moreline',
						'enabled-id' 	=> 'pe_custom_color',
						'enable-group'	=> 'pe_custom_color_group',
						'moreline'	=> array(
								'footer_banner_color' => array(
									'name'	=> __('Background Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-banner-bg-color',
									'desc'	=> __('Footer banner area background color','alterna')
									),
								'footer_general_color' => array(
									'name'	=> __('Text Default Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-banner-text-color',
									'desc'	=> __('Footer banner area text default color','alterna')
									),
								'footer_links_color' => array(
									'name'	=> __('Links Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-banner-links-color',
									'desc'	=> __('Footer banner area links color','alterna')
									),
								'footer_links_color_hover' => array(
									'name'	=> __('Links Hover Color','alterna'),
									'type' 	=> 'color',
									'property' => 'custom-footer-banner-links-hover-color',
									'desc'	=> __('Footer banner area links hover color','alterna')
									)
							)
					)
				
		)
	);

/* Enbale Css */
$page_content[] = array(
	'section' => 'css',
	'icon'	=>	'fa-css3',
	'name' => __('CSS','alterna'),
	'title' => __('Custom Css Setting','alterna'),
	'elements'	=> array(
	'enable_custom_css'		=> array(
				'title'	=> __('Enable Custom CSS','alterna'),
				'type'	=>	'moreline',
				'moreline'	=> array(
						'enable_css' => array(
							'name'	=> __('Enable Custom CSS','alterna'),
							'type' 	=> 'pc',
							'desc' 	=> __('Check here enable custom css for theme','alterna'),
							'property' => 'custom-enable-css',
							'enable-element' => 'yes',
							'enable-id'		=> '1-pe_custom_css',
							'enable-group'	=> 'pe_custom_css_group'
						),
						'custom_css' => array(
							'name'	=> __('Custom CSS','alterna'),
							'type' 	=> 'textarea',
							'codetype' 	=> 'css',
							'property' => 'custom-css-content',
							'enabled-id' 	=> 'pe_custom_css',
							'enable-group'	=> 'pe_custom_css_group'
						),
						'custom_retina_css' => array(
							'name'	=> __('Custom Retina CSS','alterna'),
							'type' 	=> 'textarea',
							'codetype' 	=> 'css',
							'property' => 'custom-css-retina-content',
							'enabled-id' 	=> 'pe_custom_css',
							'enable-group'	=> 'pe_custom_css_group'
						)
					)
				)
			)
	);

/* Enbale Scripts */
$page_content[] = array(
	'section' => 'scripts',
	'icon'	=>	'fa-code',
	'name' => __('Scripts','alterna'),
	'title' => __('Custom Scripts Setting','alterna'),
	'elements'	=> array(
	'enable_custom_scripts'		=> array(
				'title'	=> __('Enable Custom Scripts','alterna'),
				'type'	=>	'moreline',
				'moreline'	=> array(
						'enable_scripts' => array(
							'name'	=> __('Enable Custom Scripts','alterna'),
							'type' 	=> 'pc',
							'desc' 	=> __('Check here enable custom scripts for theme','alterna'),
							'property' => 'custom-enable-scripts',
							'enable-element' => 'yes',
							'enable-id'		=> '1-pe_custom_scripts',
							'enable-group'	=> 'pe_custom_scripts_group'
						),
						'custom_scripts' => array(
							'name'	=> __('Custom Scripts','alterna'),
							'type' 	=> 'textarea',
							'codetype' 	=> 'javascript',
							'property' => 'custom-scripts-content',
							'enabled-id'		=> 'pe_custom_scripts',
							'enable-group'	=> 'pe_custom_scripts_group'
						)
					)
				)
			)
	);

/* Blog Page */
$page_content[] = array(
		'section' => 'blog',
		'icon'	=>	'fa-comment',
		'name' => __('Blog','alterna'),
		'title' => __('Blog','alterna'),
		'elements'	=> array(
				'blog_cat_tag' => array(
							'title'	=> __('Blog Show Type, Category, Tags Show Setting','alterna'),
									'type'	=>	'moreline',
									'moreline'	=> array(
											'blog_type' => array(
															'name'	=> __('Blog Show Type','alterna'),
															'type' 	=> 'select',
															'options'	=> array(
																	0 => __('Default: Large Width','alterna'),
																	1 => __('Mid Width','alterna')
																),
															'property' => 'blog-show-type',
															'desc'	=> __('Default global blog posts show type.','alterna'),
											),
											'blog_category_tags' => array(
															'name'	=> __('Blog Category, Tags Style','alterna'),
															'type' 	=> 'select',
															'options'	=> array(
																	0 => __('Default','alterna'),
																	1 => __('Waterfall Flux','alterna')
																),
															'property' => 'blog-cat-tags-style',
											),
											'blog_page'	=> array(
																'name'	=> __('Default Waterfall Flux Page','alterna'),
																'type' 	=> 'select',
																'property' => 'blog-waterfall-page',
																'desc'	=> __('Default blog page for category, tag show style just when you choose "Waterfall Flux" style.','alterna'),
																'options'	=> alterna_get_all_template_type_pages(array('page-blog-ajax.php'))
															)
													)
										),
				'blog_page_top_content'	=> array(
									'title'	=> __('Blog Category, Tag Page Top Area Content','alterna'),
									'type'	=>	'moreline',
									'moreline'	=> array(
											'blog_enable_breadchrumb' => array(
																'name'	=> __('Category, Tag Page Top Area Content','alterna'),
																'type'	=>	'pc',
																'desc' => __('Check to enable show default blog page content for Category, Tags top area content.','alterna'),
																'property'	=> 'blog-enable-top-content'
															)
											)
										),
				'blog_author' => array(
									'title'	=> __('Author Information Setting','alterna'),
									'type'	=>	'moreline',
									'moreline'	=> array(
											'blog_author_link' => array(
																'name'	=> __('Author link type','alterna'),
																'type' 	=> 'select',
																'options'	=> array(
																		0 => __('Link to author website','alterna'),
																		1 => __('Link to author page','alterna'),
																	),
																'desc' => __('Choose post author link type.','alterna'),
																'property'	=> 'blog-author-link'
															),
											'blog_enable_author' => array(
																'name'	=> __('Author information','alterna'),
																'type'	=>	'pc',
																'desc' => __('Check to enable single post page show author information','alterna'),
																'property'	=> 'blog-enable-author'
															)
											)
										),
				'blog_setting' => array(
							'title'	=> __('Single Post Setting','alterna'),
									'type'	=>	'moreline',
									'moreline'	=> array(
													'enable_breadchrumb' => array(
															'name'	=> __('Category for Single Post Breadchrumb','alterna'),
															'type'	=>	'pc',
															'desc' => __('Check to enable show single post breadchrumb with category','alterna'),
															'property'	=> 'blog-enable-breadchrumb'
														),
													'post_related'		=> array(	
															'name'	=> __('Enable Show Related Posts','alterna'),
															'type'	=>	'pc',
															'property' 	=> 'blog-related-enable',
															'enable-element'=> 'yes',
															'enable-id'		=> '1-blog_enable_related',
															'enable-group'	=> 'blog_enable_related_group'
														),
													'post_related_style'=> array(	
															'name'	=> __('Related Items Style','alterna'),
															'type'	=>	'select',
															'property' 	=> 'blog-related-style',
															'options' => array(__('Style #1','alterna'),__('Style #2','alterna'),__('Style #3','alterna'),__('Style #4','alterna')),
															'enabled-id' => 'blog_enable_related',
															'enable-group'	=> 'blog_enable_related_group'
														),
													'post_comment_hide'=> array(	
															'name'	=> __('Hide Posts Comment When Close','alterna'),
															'type'	=>	'pc',
															'property' 	=> 'blog-comment-hide',
														),
													'post_related_num'=> array(	
															'name'	=> __('Related Posts Number','alterna'),
															'type'	=>	'number',
															'property' 	=> 'blog-related-num',
															'default' => '3',
															'enabled-id'		=> 'blog_enable_related',
															'enable-group'	=> 'blog_enable_related_group'
														),
													'enable_share' => array(
															'name'	=> __('Enable Show Share','alterna'),
															'type'	=>	'pc',
															'property'	=> 'blog-enable-share',
															'enable-element' => 'yes',
															'enable-id'		=> '1-pe_blog_share',
															'enable-group'	=> 'pe_blog_share_group'
															),
													'custom_share' => array(
															'name'	=> __('Custom share code','alterna'),
															'type' 	=> 'textarea',
															'property' => 'blog-share-code',
															'desc'	=> __('You can copy your share plugin code into here.Like AddThis','alterna'),
															'enabled-id'		=> 'pe_blog_share',
															'enable-group'	=> 'pe_blog_share_group'
															)
														)
										),
				)
	);

/* Portfolio Page */		
$page_content[] = array(
		'section' => 'portfolio',
		'icon'	=>	'fa-th-large',
		'name' => __('Portfolio','alterna'),
		'title' => __('Portfolio','alterna'),
		'elements'	=> array(
				'portfolio_page'	=> array(
									'title'	=> __('Default Portfolio Page','alterna'),
									'name'	=> __('Default Portfolio Page','alterna'),
									'type' 	=> 'select',
									'property' => 'portfolio-default-page',
									'desc'	=> __('Default portfolio page for category default show style.','alterna'),
									'options'	=> alterna_get_all_template_type_pages(array('page-portfolio.php', 'page-portfolio-ajax.php'))
								),
				'portfolio_single_page' => array(
							'title'	=> __('Single Post Page Setting','alterna'),
							'type'	=>	'moreline',
							'moreline'	=> array(
											'post_layout'		=> array(
													'name'	=> __('Single Page Layout','alterna'),
													'type'	=>	'radio',
													'property'	=> 'portfolio-post-layout',
													'default'	=> 0,
													'radios'	=> array(0 => __('Full Width','alterna'), 1 => __('Left Sidebar','alterna'), 2 => __('Right Sidebar','alterna'))
											),
											'post_style'		=> array(
													'name'	=> __('Single Page Style','alterna'),
													'type'	=>	'select',
													'property'	=> 'portfolio-post-style',
													'default'	=> 0,
													'options'	=> array(0 => __('Style #1','alterna'),
                                                                                                                                 1 => __('Style #2','alterna'),
                                                                                                                                 2 => __('Style #3','alterna'),
                                                                                                                                 3 => __('Style #4','alterna'))
											),
											'enable_breadchrumb' => array(
													'name'	=> __('Category for Single Post Breadchrumb','alterna'),
													'type'	=>	'pc',
													'desc' => __('Check to enable show single post breadchrumb with category','alterna'),
													'property'	=> 'portfolio-enable-breadchrumb'
											),
											'post_related'		=> array(	
													'name'	=> __('Enable Show Related Posts','alterna'),
													'type'	=>	'pc',
													'property' 	=> 'portfolio-related-enable',
													'enable-element'=> 'yes',
													'enable-id'		=> '1-portfolio_enable_related',
													'enable-group'	=> 'portfolio_enable_related_group'
												),
											'post_related_style'=> array(	
													'name'	=> __('Related Items Style','alterna'),
													'type'	=>	'select',
													'property' 	=> 'portfolio-related-style',
													'options' => array(__('Style #1','alterna'),
                                                                                                                           __('Style #2','alterna'),__('Style #3','alterna'),__('Style #4','alterna')),
													'enabled-id' => 'portfolio_enable_related',
													'enable-group'	=> 'portfolio_enable_related_group'
												),
											'post_related_num'=> array(	
													'name'	=> __('Related Posts Number','alterna'),
													'type'	=>	'number',
													'property' 	=> 'portfolio-related-num',
													'default' => '4',
													'enabled-id'		=> 'portfolio_enable_related',
													'enable-group'	=> 'portfolio_enable_related_group'
												),
											'enable_share' => array(
													'name'	=> __('Enable Show Share','alterna'),
													'type'	=>	'pc',
													'property'	=> 'portfolio-enable-share',
													'enable-element' => 'yes',
													'enable-id'		=> '1-pe_portfolio_share',
													'enable-group'	=> 'pe_portfolio_share_group'
													),
											'custom_share' => array(
													'name'	=> __('Custom share code','alterna'),
													'type' 	=> 'textarea',
													'property' => 'portfolio-share-code',
													'desc'	=> __('You can copy your share plugin code into here.Like AddThis','alterna'),
													'enabled-id'		=> 'pe_portfolio_share',
													'enable-group'	=> 'pe_portfolio_share_group'
													)
												)
								)
			)
	);
	
/* Social */
$page_content[] = array(
		'section' => 'social',
		'icon'	=>	'fa-twitter',
		'name' => __('Socials','alterna'),
		'title' => __('Socials','alterna'),
		'elements'	=> array(
			'social'	=> array(
				'title'	=> __('Social Links with http://','alterna'),
				'type'	=>	'moreline',
				'moreline'	=> array(
						'social_email'	=> array(
								'name'	=> __('Email','alterna'),
								'type' 	=> 'input',
								'property' => 'social-email'
							),
						'social_twitter'	=> array(
								'name'	=> __('Twitter','alterna'),
								'type' 	=> 'input',
								'property' => 'social-twitter'
							),
						'social_facebook'	=> array(
								'name'	=> __('Facebook','alterna'),
								'type' 	=> 'input',
								'property' => 'social-facebook'
							),
						'social_google_plus'	=> array(
								'name'	=> __('Google Plus','alterna'),
								'type' 	=> 'input',
								'property' => 'social-google'
							),
						'social_dribbble'	=> array(
								'name'	=> __('Dribbble','alterna'),
								'type' 	=> 'input',
								'property' => 'social-dribbble'
							),
						'social_pinterest'	=> array(
								'name'	=> __('Pinterest','alterna'),
								'type' 	=> 'input',
								'property' => 'social-pinterest'
							),
						'social_flickr'	=> array(
								'name'	=> __('Flickr','alterna'),
								'type' 	=> 'input',
								'property' => 'social-flickr'
							),
						'social_skype'	=> array(
								'name'	=> __('Skype','alterna'),
								'type' 	=> 'input',
								'property' => 'social-skype'
							),
						'social_youtube'	=> array(
								'name'	=> __('Youtube','alterna'),
								'type' 	=> 'input',
								'property' => 'social-youtube'
							),
						'social_vimeo'	=> array(
								'name'	=> __('Vimeo','alterna'),
								'type' 	=> 'input',
								'property' => 'social-vimeo'
							),
						'social_linkedin'	=> array(
								'name'	=> __('Linkedin','alterna'),
								'type' 	=> 'input',
								'property' => 'social-linkedin'
							),
						'social_digg'	=> array(
								'name'	=> __('Digg','alterna'),
								'type' 	=> 'input',
								'property' => 'social-digg'
							),
						'social_deviantart'	=> array(
								'name'	=> __('Deviantart','alterna'),
								'type' 	=> 'input',
								'property' => 'social-deviantart'
							),
						'social_behance'	=> array(
								'name'	=> __('Behance','alterna'),
								'type' 	=> 'input',
								'property' => 'social-behance'
							),
						//'social_forrst'	=> array(
						//		'name'	=> __('Forrst','alterna'),
						//		'type' 	=> 'input',
						//		'property' => 'social-forrst'
						//	),
						'social_lastfm'	=> array(
								'name'	=> __('Lastfm','alterna'),
								'type' 	=> 'input',
								'property' => 'social-lastfm'
							),
						'social_xing'	=> array(
								'name'	=> __('XING','alterna'),
								'type' 	=> 'input',
								'property' => 'social-xing'
							),
						'social_instagram'	=> array(
								'name'	=> __('Instagram','alterna'),
								'type' 	=> 'input',
								'property' => 'social-instagram'
							),
						'social_stumbleupon'	=> array(
								'name'	=> __('StumbleUpon','alterna'),
								'type' 	=> 'input',
								'property' => 'social-stumbleupon'
							),
                                                'social_github'	=> array(
								'name'	=> __('Github','alterna'),
								'type' 	=> 'input',
								'property' => 'social-github'
							),
                                                'social_soundcloud'	=> array(
								'name'	=> __('SoundCloud','alterna'),
								'type' 	=> 'input',
								'property' => 'social-soundcloud'
							),
                                                'social_vine'	=> array(
								'name'	=> __('Vine','alterna'),
								'type' 	=> 'input',
								'property' => 'social-vine'
							),
                                                'social_whatsapp'	=> array(
								'name'	=> __('Whatsapp','alterna'),
								'type' 	=> 'input',
								'property' => 'social-whatsapp'
							),
                                                'social_yelp'	=> array(
								'name'	=> __('Yelp','alterna'),
								'type' 	=> 'input',
								'property' => 'social-yelp'
							),
                                                'social_codepen'	=> array(
								'name'	=> __('Codepen','alterna'),
								'type' 	=> 'input',
								'property' => 'social-codepen'
							),
						//'social_picasa'	=> array(
						//		'name'	=> __('Picasa','alterna'),
						//		'type' 	=> 'input',
						//		'property' => 'social-picasa'
						//	)
					)
			)
		)
	);

$page_content[] =  array('section' => 'update',	'icon'	=> 'fa-bullhorn','name' => __('Update Log','alterna') ,'title' => __('Update History', 'alterna'),'type'	=> 'update');
		
$page_content[] =  array('section' => 'import',	'icon'	=> 'fa-retweet','name' => __('Import/Export','alterna') ,'title' => __('Import/Export Options', 'alterna'),'type'	=> 'import');

$page_content[] =  array('section' => 'get_support','icon'	=> 'fa-question-circle','name' => __('Get Support','alterna'),'title' => 'link','type'	=> 'link',	'class'	=>	'light','pagecontent'	=> 'http://support.themefocus.co');

/**
 * Option Default Value
 */
$options_custom_general = array(
	'theme-name'					=>	'',
'theme-purchase-code'			=> '',
'theme-api'						=>	'',
'theme-update-enable'			=> 'off',
'favicon'						=>	$dir.'/img/favicon.png',
'rss-feed'						=>	"",

'global-layout'					=>	0,
'global-layout-boxed-padding'	=>	30,
'global-layout-width'		=>	1170,

'global-sidebar-layout'			=>	1,
'global-breakcrumbs-enable'		=>	'off',
'bootstrap-fontawesome-cdn'		=>	'off',
'google_analytics-position'		=> 	1,
'google_analytics-text'			=>	"",

'custom-background-enable'		=>	'off',

'global-bg-type'				=>	0,
'global-bg-color'				=>	'5a5a5a',
'global-bg-pattern-width'		=>	100,
'global-bg-pattern-height'		=>	100,
'global-bg-image'				=>	'',
'global-bg-pattern-image'		=>	$dir.'/img/bgnoise_lg.png',
'global-bg-pattern-retina'		=>	$dir.'/img/bgnoise_lg@2x.png',

'global-header-bg-type'				=>	2,
'global-header-bg-pattern-width'	=>	0,
'global-header-bg-pattern-height'	=>	0,
'global-header-bg-pattern-image'	=>	'',
'global-header-bg-pattern-retina'	=>	'',
'global-header-bg-image'			=>	'',
'global-header-bg-color'			=>	'ffffff',

'global-title-bg-type'				=>	0,
'global-title-bg-pattern-width'		=>	297,
'global-title-bg-pattern-height'	=>	297,
'global-title-bg-pattern-image'		=>	$dir.'/img/bright_squares.png',
'global-title-bg-pattern-retina'	=>	$dir.'/img/bright_squares@2x.png',
'global-title-bg-image'				=>	'',
'global-title-bg-color'				=>	'f9f9f9',

'global-content-bg-type'			=>	2,
'global-content-bg-pattern-width'	=>	0,
'global-content-bg-pattern-height'	=>	0,
'global-content-bg-pattern-image'	=>	'',
'global-content-bg-pattern-retina'	=>	'',
'global-content-bg-image'			=>	'',
'global-content-bg-color'			=>	'ffffff',

'global-footer-bg-type'				=>	2,
'global-footer-bg-pattern-width'	=>	0,
'global-footer-bg-pattern-height'	=>	0,
'global-footer-bg-pattern-image'	=>	'',
'global-footer-bg-pattern-retina'	=>	'',
'global-footer-bg-image'			=>	'',
'global-footer-bg-color'			=>	'404040',
'global-footer-border-color'		=>	'7AB80E',
'global-footer-bottom-bg-color'		=>	'0C0C0C',
'global-footer-bottom-border-color'	=>	'4a4a4a',

'shop-per-page'			=>	24,
'shop-product-search'	=>	'on',

//header
'header-style-type'			=>	0,
'header-megamenu-enable'	=>	'off',
'header-search-enable'		=>	'on',

'header-banner-enable'		=>	'off',
'header-banner-id'			=>	1,
'header-banner-content'		=>	'Input Content',

'topbar-enable'		=>	'off',
'topbar-layout'				=>	0,
'topbar-elements'			=>	'0-2|1-2|2-2|3-2|4-2|5-2',
'topbar-custom-content'		=>	'',
'topbar-login-page'			=>	'',

'logo-txt-enable'			=>	"off",
'logo-image'				=>	$dir.'/img/logo.png',
'logo-retina-image'			=>	$dir.'/img/logo@2x.png',
'logo-image-width'			=>	227,
'logo-image-height'			=>	60,

'fixed-enable'				=>	"on",
'fixed-logo-image'			=>	$dir.'/img/fixed-logo.png',
'fixed-logo-retina-image'	=>	$dir.'/img/fixed-logo@2x.png',
'fixed-logo-image-width'	=>	44,

'logo-image-padding-top'	=>	0,
'header-right-area-padding-top'	=>	14,
'header-style-6-login-btn'		=>	'off',

//footer
'footer-widget-style'			=>	0,
'footer-copyright-message'		=> 'Copyright &copy; 2015 <a href="http://themeforest.net/user/ThemeFocus">ThemeFocus</a>. All rights reserved.',
'footer-link-text'				=> 'Powered by WordPress.',
'footer-banner-enable'			=>	'off',
'footer-banner-id'				=>	1,
'footer-banner-content'			=>	'Input Content',

//font
'custom-enable-font'		=>	"off",
'google-font-subset'		=>	"",
'custom-general-font'		=>	0,
'custom-general-font-size'	=>	14,
'custom-menu-font'			=>	0,
'custom-menu-font-size'		=>	13,
'custom-title-font'			=>	0,
		
//color
'custom-enable-color'			=>	'off',
'fixed-header-enable-color'		=>	'off',

//css
'custom-enable-css'			=>	'off',
'custom-css-content'		=>	'',
'custom-css-retina-content'	=>	'',		

//scripts
'custom-enable-scripts'		=>	'off',
'custom-scripts-content'	=>	'',

//blog
'blog-show-type'			=>	0,
'blog-cat-tags-style'		=>	0,
'blog-waterfall-page'		=>	"",
'blog-enable-top-content'	=>	'off',
'blog-enable-breadchrumb'	=>	'off',
'blog-author-link'			=>	0,
'blog-enable-author'		=>	"off",
'blog-enable-share'			=>	"off",
'blog-share-code'			=>	"",
'blog-comment-hide'			=>	'off',
'blog-related-enable'		=>	'off',
'blog-related-style'		=>	1,
'blog-related-num'			=>	3,

//portfolio 
'portfolio-default-page'		=>	"",
'portfolio-enable-breadchrumb'	=>	'off',
'portfolio-post-layout'			=>	0,
'portfolio-post-style'			=>	0,
'portfolio-related-enable'		=>	'off',
'portfolio-related-style'		=>	3,
'portfolio-related-num'			=>	4,
'portfolio-enable-share'		=>	"off",
'portfolio-share-code'			=>	"",

//social 
'social-email'		=> "",
'social-twitter'	=> "" ,
'social-facebook'	=> "" ,
'social-google'=>	"" ,
'social-pinterest'	=>	"",
'social-github'		=>	"",
'social-linkedin'	=>	"",
'social-dribbble'	=>	"",
'social-flickr'		=>	"",
'social-skype'		=>	"",
'social-vimeo'		=>	"",
'social-digg'		=>	"",
'social-deviantart'	=>	"",
'social-behance'	=>	"",
//'social-forrst'		=>	"",
'social-lastfm'		=>	"",
'social-xing'		=>	"",
'social-instagram'	=>	"",
'social-stumbleupon'=>	"",
//'social-picasa'		=>	""
'social-github'         =>      "",
'social-soundcloud'     =>      "",
'social-vine'           =>      "",
'social-whatsapp'       =>      "",
'social-yelp'           =>      "",
'social-codepen'        =>      ""
);

$options_custom_color = array(
//color
'theme-color'						=>	'7AB80E',
'custom-general-color'				=>	'666666',
'custom-links-color'				=>	'1c1c1c',
'custom-links-hover-color'			=>	'7AB80E',
'custom-h-color'					=>	'3a3a3a',

'custom-menu-background-color'		=>	'0C0C0C',
'custom-menu-background-hover-color'=>	'7AB80E',
'custom-menu-border-bottom-color'	=>	'7AB80E',
'custom-sub-menu-background-color'	=>	'7AB80E',
'custom-sub-menu-hover-background-color' =>	'0c0c0c',
'custom-sub-menu-hover-border-top-color'	=>	'ffffff',
'custom-sub-menu-hover-border-bottom-color'	=>	'0c0c0c',
'custom-menu-font-color'			=>	'ffffff',
'custom-menu-hover-font-color'		=>	'7ab80e',
'custom-sub-menu-font-color'		=>	'000000',
'custom-sub-menu-hover-font-color' 	=>	'ffffff',

'custom-mobile-menu-background-color'           =>	'0C0C0C',
'custom-mobile-2-level-menu-background-color'   =>	'202020',
'custom-mobile-3-level-menu-background-color'   =>	'303030',
'custom-mobile-menu-font-color'                 =>	'C2C2C2',
'custom-mobile-menu-hover-font-color'           =>	'ffffff',
'custom-mobile-icon-color'                      =>	'ffffff',
'custom-mobile-icon-border-color'               =>	'616161',
'custom-mobile-menu-top-border-color'           =>      '0f0f0f',

'custom-header-banner-bg-color'				=>	'f7d539',
'custom-header-banner-text-color'			=>	'222222',
'custom-header-banner-links-color'			=>	'1c1c1c',
'custom-header-banner-links-hover-color'	=>	'7ab80e',
									
'custom-header-topbar-bg-color'					=>	'f2f2f2',
'custom-header-topbar-border-color'				=>	'e6e6e6',
'custom-header-topbar-font-color'				=>	'757575',
'custom-header-topbar-hover-font-color'			=>	'16a2da',
'custom-header-topbar-sub-menu-hover-bg-color'	=>	'f7f7f7',

'custom-footer-text-color'					=>	'999999',
'custom-footer-links-color'				=>	'1c1c1c',
'custom-footer-links-hover-color'			=>	'7AB80E',
'custom-footer-h-color'					=>	'ffffff',
'custom-footer-bottom-color'				=>	'999999',
'custom-footer-bottom-links-color'			=>	'606060',
'custom-footer-bottom-links-hover-color'	=>	'7AB80E',
 
'custom-footer-banner-bg-color'				=>	'0DDBFF',
'custom-footer-banner-text-color'			=>	'222222',
'custom-footer-banner-links-color'			=>	'1c1c1c',
'custom-footer-banner-links-hover-color'	=>	'7ab80e',
);
	
$page_default_property = array_merge($options_custom_general,$options_custom_color);

/**
* Option Config
*/
$optionsConfig = array(
/* type -> menu,submenu */
/* page_title,menu_title,capability,menu_slug,function,icon_url,position from 100 */
'menu'	=> array(
		'type'			=> 'menu',
		'option_name' 	=> 'alterna_options',
		'page_desc'		=> '',
		'page_logo'		=>	'',
		'page_title' 	=> 'Alterna Options',
		'menu_title' 	=> 'Alterna',
		'capability' 	=> 'manage_options',
		'menu_slug'	 	=> 'alterna_options_page',
		'icon_url'		=> get_template_directory_uri().'/img/penguin/penguin-icon.png',
		'position'		=> 99.1,
		'fun'			=>	'',
		'admin_bar'		=>	true,
		'backpage'		=>	true
	),
'submenu'	=> array(
		'type'			=> 'submenu',
		'parent_slug' 	=> 'alterna_options_page',
		'option_name' 	=> 'alterna_options',
		'page_desc'		=> __('Welcome to setting alterna theme style!','alterna'),
		'page_logo'		=>	get_template_directory_uri().'/img/penguin/penguin_logo.png',
		'page_logo_url'		=> 'http://themefocus.co/alterna/',
		'page_title' 	=> 'Alterna Option',
		'menu_title' 	=> 'Alterna Options',
		'capability' 	=> 'manage_options',
		'menu_slug'	 	=> 'alterna_options_page',
		'icon_url'		=> get_template_directory_uri().'/img/alterna-icon.png',
		'pages'		 	=> $page_content,
		'pages_default_property'	=> $page_default_property,
		'link'			=>	'http://support.themefocus.co',
		'pid'			=>	'3946450',
		'notifier'		=> "http://support.themefocus.co/notifier/alterna.xml",
		'update_history'		=> "http://support.themefocus.co/update/?theme=alterna",
		'update_opt'		=> "yes"
	)
);

// custom metas field
$metasConfig = array();

// general element field
$generalConfig = array(
	array(	'name' 	=> 'layout-type',
			'title'	=> __('Layout Type','alterna'),
			'type'	=>	'radio',
			'radios' => array(__('Use Global','alterna'),__('Full Width','alterna'),__('Left Sidebar','alterna'),__('Right Sidebar','alterna')),
			'enable-element'=> 'yes',
			'enable-id'		=> '0-page_layout_type:2-page_layout_type:3-page_layout_type',
			'enable-group'	=> 'page_layout_type_group'
		),
	array(	'name' 	=> 'sidebar-type',
			'title'	=> __('Sidebar','alterna'),
			'type'	=>	'selectname',
			'options' => 'wp_registered_sidebars',
			'enabled-id'	=> 'page_layout_type',
			'enable-group'	=> 'page_layout_type_group'
		),
	array(	'name' 	=> 'title-show',
			'title'	=> __('Show Page Header Title','alterna'),
			'type'	=>	'pc',
			'default'	=> 'on',
			'enable-element'=> 'yes',
			'enable-id'		=> '1-page_title_show',
			'enable-group'	=> 'page_title_show_group'
	),
	array(	'name' 	=> 'title-align',
			'title'	=> __('Title Style','alterna'),
			'type'	=>	'radio',
			'radios' => array('left','center','right'),
			'enabled-id' => 'page_title_show',
			'enable-group'	=> 'page_title_show_group'
		),
	array(	'name' 	=> 'title-content',
			'title'	=> __('Custom Title Content','alterna'),
			'type'	=>	'textarea',
			'enabled-id' => 'page_title_show',
			'enable-group'	=> 'page_title_show_group',
			'desc'	=>	esc_html(__('Support HTML Format content.<h1 class="title"></h1>','alterna')),
		),
	array(	'name' 	=> 'title-desc',
			'title'	=> __('Custom Title Description','alterna'),
			'type'	=>	'textarea',
			'enabled-id' => 'page_title_show',
			'enable-group'	=> 'page_title_show_group',
			'desc'	=>	__('Support HTML Format content','alterna'),
		),
	array(	'name' 	=> 'title-breadcrumb',
			'title'	=> __('Show Title Breadcrumb','alterna'),
			'type'	=>	'pc',
			'default'	=> 'on',
			'enabled-id' => 'page_title_show',
			'enable-group'	=> 'page_title_show_group'
		),
	array(	'name' 	=> 'slide-type',
			'title'	=> __('Slider Type','alterna'),
			'type'	=>	'radio',
			'radios' => array('None Slider','Layer Slider','Revolution Slider'),
			'enable-element' => 'yes',
			'enable-id'	=> '1-layer_slide_id:2-rev_slide_id',
			'enable-group'	=> 'layer_slide_group',

		),
	array(	'name' 	=> 'layer-slide-id',
			'title'	=> __('Select Layer Slider','alterna'),
			'type'	=>	'select',
			'options' => penguin_get_layerslider(),
			'enabled-id' => 'layer_slide_id',
			'enable-group'	=> 'layer_slide_group'
		),
	array(	'name' 	=> 'rev-slide-id',
			'title'	=> __('Select Revolution Slider','alterna'),
			'type'	=>	'select',
			'options' => penguin_get_revslider(),
			'enabled-id' => 'rev_slide_id',
			'enable-group'	=> 'layer_slide_group'
		)
);

$bgConfig = array(
				//background
				array(	'name' 	=> 'page-bg-type',
						'title'	=> __('Page Body Background Type','alterna'),
						'type'	=>	'radio',
						'radios' => array(__('Use Global','alterna'),__('Pattern','alterna'),__('Image','alterna'),__('Color','alterna')),
						'enable-element'=> 'yes',
						'enable-id'		=> '1-page_bg_pattern:2-page_bg_image:3-page_bg_color',
						'enable-group'	=> 'page_bg_type_group'
					),
				array(	'name' 	=> 'page-bg-pattern-width',
						'title'	=> __('Pattern Image Width','alterna'),
						'type'	=>	'number',
						'enabled-id'		=> 'page_bg_pattern',
						'enable-group'	=> 'page_bg_type_group'
				),
				array(	'name' 	=> 'page-bg-pattern-height',
						'title'	=> __('Pattern Image Height','alterna'),
						'type'	=>	'number',
						'enabled-id'		=> 'page_bg_pattern',
						'enable-group'	=> 'page_bg_type_group'
				),
				array(	'name' 	=> 'page-bg-pattern-image',
						'title'	=> __('Pattern Image','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_bg_pattern',
						'enable-group'	=> 'page_bg_type_group'
				),
				array(	'name' 	=> 'page-bg-pattern-retina',
						'title'	=> __('Pattern Retina Image @2x','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_bg_pattern',
						'enable-group'	=> 'page_bg_type_group'
				),
				array(	'name' 	=> 'page-bg-image',
						'title'	=> __('Background Image','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_bg_image',
						'enable-group'	=> 'page_bg_type_group'
				),
				array(	'name' 	=> 'page-bg-color',
						'title'	=> __('Background Color','alterna'),
						'type'	=>	'color',
						'default'	=>	'ffffff',
						'enabled-id'		=> 'page_bg_color',
						'enable-group'	=> 'page_bg_type_group'
				),
				//header
				array(	'name' 	=> 'page-header-bg-type',
						'title'	=> __('Page Header Background Type','alterna'),
						'type'	=>	'radio',
						'radios' => array(__('Use Global','alterna'),__('Pattern','alterna'),__('Image','alterna'),__('Color','alterna')),
						'enable-element'=> 'yes',
						'enable-id'		=> '1-page_header_bg_pattern:2-page_header_bg_image:3-page_header_bg_color',
						'enable-group'	=> 'page_header_bg_type_group'
					),
				array(	'name' 	=> 'page-header-bg-pattern-width',
						'title'	=> __('Pattern Image Width','alterna'),
						'type'	=>	'number',
						'enabled-id'	=> 'page_header_bg_pattern',
						'enable-group'	=> 'page_header_bg_type_group'
				),
				array(	'name' 	=> 'page-header-bg-pattern-height',
						'title'	=> __('Pattern Image Height','alterna'),
						'type'	=>	'number',
						'enabled-id'		=> 'page_header_bg_pattern',
						'enable-group'	=> 'page_header_bg_type_group'
				),
				array(	'name' 	=> 'page-header-bg-pattern-image',
						'title'	=> __('Pattern Image','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_header_bg_pattern',
						'enable-group'	=> 'page_header_bg_type_group'
				),
				array(	'name' 	=> 'page-header-bg-pattern-retina',
						'title'	=> __('Pattern Retina Image @2x','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_header_bg_pattern',
						'enable-group'	=> 'page_header_bg_type_group'
				),
				array(	'name' 	=> 'page-header-bg-image',
						'title'	=> __('Background Image','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_header_bg_image',
						'enable-group'	=> 'page_header_bg_type_group'
				),
				array(	'name' 	=> 'page-header-bg-color',
						'title'	=> __('Background Color','alterna'),
						'type'	=>	'color',
						'default'	=>	'ffffff',
						'enabled-id'		=> 'page_header_bg_color',
						'enable-group'	=> 'page_header_bg_type_group'
				),
				// title
				array(	'name' 	=> 'page-title-bg-type',
						'title'	=> __('Page Title Background Type','alterna'),
						'type'	=>	'radio',
						'radios' => array(__('Use Global','alterna'),__('Pattern','alterna'),__('Image','alterna'),__('Color','alterna')),
						'enable-element'=> 'yes',
						'enable-id'		=> '1-page_title_bg_pattern:2-page_title_bg_image:3-page_title_bg_color',
						'enable-group'	=> 'page_title_bg_type_group'
					),
				array(	'name' 	=> 'page-title-bg-pattern-width',
						'title'	=> __('Pattern Image Width','alterna'),
						'type'	=>	'number',
						'enabled-id'		=> 'page_title_bg_pattern',
						'enable-group'	=> 'page_title_bg_type_group'
				),
				array(	'name' 	=> 'page-title-bg-pattern-height',
						'title'	=> __('Pattern Image Height','alterna'),
						'type'	=>	'number',
						'enabled-id'		=> 'page_title_bg_pattern',
						'enable-group'	=> 'page_title_bg_type_group'
				),
				array(	'name' 	=> 'page-title-bg-pattern-image',
						'title'	=> __('Pattern Image','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_title_bg_pattern',
						'enable-group'	=> 'page_title_bg_type_group'
				),
				array(	'name' 	=> 'page-title-bg-pattern-retina',
						'title'	=> __('Pattern Retina Image @2x','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_title_bg_pattern',
						'enable-group'	=> 'page_title_bg_type_group'
				),
				array(	'name' 	=> 'page-title-bg-image',
						'title'	=> __('Background Image','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_title_bg_image',
						'enable-group'	=> 'page_title_bg_type_group'
				),
				array(	'name' 	=> 'page-title-bg-color',
						'title'	=> __('Background Color','alterna'),
						'type'	=>	'color',
						'default'	=>	'ffffff',
						'enabled-id'		=> 'page_title_bg_color',
						'enable-group'	=> 'page_title_bg_type_group'
				),
				// content
				array(	'name' 	=> 'page-content-bg-type',
						'title'	=> __('Page Content Background Type','alterna'),
						'type'	=>	'radio',
						'radios' => array(__('Use Global','alterna'),__('Pattern','alterna'),__('Image','alterna'),__('Color','alterna')),
						'enable-element'=> 'yes',
						'enable-id'		=> '1-page_content_bg_pattern:2-page_content_bg_image:3-page_content_bg_color',
						'enable-group'	=> 'page_content_bg_type_group'
					),
				array(	'name' 	=> 'page-content-bg-pattern-width',
						'title'	=> __('Pattern Image Width','alterna'),
						'type'	=>	'number',
						'enabled-id'		=> 'page_content_bg_pattern',
						'enable-group'	=> 'page_content_bg_type_group'
				),
				array(	'name' 	=> 'page-content-bg-pattern-height',
						'title'	=> __('Pattern Image Height','alterna'),
						'type'	=>	'number',
						'enabled-id'		=> 'page_content_bg_pattern',
						'enable-group'	=> 'page_content_bg_type_group'
				),
				array(	'name' 	=> 'page-content-bg-pattern-image',
						'title'	=> __('Pattern Image','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_content_bg_pattern',
						'enable-group'	=> 'page_content_bg_type_group'
				),
				array(	'name' 	=> 'page-content-bg-pattern-retina',
						'title'	=> __('Pattern Retina Image @2x','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_content_bg_pattern',
						'enable-group'	=> 'page_content_bg_type_group'
				),
				array(	'name' 	=> 'page-content-bg-image',
						'title'	=> __('Background Image','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_content_bg_image',
						'enable-group'	=> 'page_content_bg_type_group'
				),
				array(	'name' 	=> 'page-content-bg-color',
						'title'	=> __('Background Color','alterna'),
						'type'	=>	'color',
						'default'	=>	'ffffff',
						'enabled-id'		=> 'page_content_bg_color',
						'enable-group'	=> 'page_content_bg_type_group'
				),
				// footer
				array(	'name' 	=> 'page-footer-bg-type',
						'title'	=> __('Page Footer Background Type','alterna'),
						'type'	=>	'radio',
						'radios' => array(__('Use Global','alterna'),__('Pattern','alterna'),__('Image','alterna'),__('Color','alterna')),
						'enable-element'=> 'yes',
						'enable-id'		=> '1-page_footer_bg_pattern:2-page_footer_bg_image:3-page_footer_bg_color',
						'enable-group'	=> 'page_footer_bg_type_group'
					),
				array(	'name' 	=> 'page-footer-bg-pattern-width',
						'title'	=> __('Pattern Image Width','alterna'),
						'type'	=>	'number',
						'enabled-id'		=> 'page_footer_bg_pattern',
						'enable-group'	=> 'page_footer_bg_type_group'
				),
				array(	'name' 	=> 'page-footer-bg-pattern-height',
						'title'	=> __('Pattern Image Height','alterna'),
						'type'	=>	'number',
						'enabled-id'		=> 'page_footer_bg_pattern',
						'enable-group'	=> 'page_footer_bg_type_group'
				),
				array(	'name' 	=> 'page-footer-bg-pattern-image',
						'title'	=> __('Pattern Image','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_footer_bg_pattern',
						'enable-group'	=> 'page_footer_bg_type_group'
				),
				array(	'name' 	=> 'page-footer-bg-pattern-retina',
						'title'	=> __('Pattern Retina Image @2x','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_footer_bg_pattern',
						'enable-group'	=> 'page_footer_bg_type_group'
				),
				array(	'name' 	=> 'page-footer-bg-image',
						'title'	=> __('Background Image','alterna'),
						'type'	=>	'upload',
						'enabled-id'		=> 'page_footer_bg_image',
						'enable-group'	=> 'page_footer_bg_type_group'
				),
				array(	'name' 	=> 'page-footer-bg-color',
						'title'	=> __('Background Color','alterna'),
						'type'	=>	'color',
						'default'	=>	'404040',
						'enabled-id'		=> 'page_footer_bg_color',
						'enable-group'	=> 'page_footer_bg_type_group'
				),
				array(	'name' 	=> 'page-footer-border-color',
						'title'	=> __('Border Top Color','alterna'),
						'type'	=>	'color',
						'default'	=>	'7AB80E',
						'enabled-id'		=> 'page_footer_bg_color page_footer_bg_image page_footer_bg_pattern',
						'enable-group'	=> 'page_footer_bg_type_group'
				),
				array(	'name' 	=> 'page-footer-bottom-bg-color',
						'title'	=> __('Bottom Background Color','alterna'),
						'type'	=>	'color',
						'default'	=>	'0C0C0C',
						'enabled-id'		=> 'page_footer_bg_color page_footer_bg_image page_footer_bg_pattern',
						'enable-group'	=> 'page_footer_bg_type_group'
				),
				array(	'name' 	=> 'page-footer-bottom-border-color',
						'title'	=> __('Bottom Border Top Color','alterna'),
						'type'	=>	'color',
						'default'	=>	'4a4a4a',
						'enabled-id'		=> 'page_footer_bg_color page_footer_bg_image page_footer_bg_pattern',
						'enable-group'	=> 'page_footer_bg_type_group'
				)
		);
//post
$metasConfig[] = array( 'id'		=>	'custom-post-setting',
					'type'		=>	'post',
					'priority'	=>	'high',
					'title' 	=>	__('Page Option Setting','alterna'),
					'page_elements'	=> array(
									'element-general' => array(	
											'id'	=>	'custom-post-general',
											'icon'	=>	'fa-gear',
											'title'	=>	__('General','alterna'),
											'fields'	=>	$generalConfig				
									),
									'element-template' => array(	
											'id'	=>	'custom-post-template',
											'icon'	=>	'fa-puzzle-piece',
											'title'	=>	__('Post Options','alterna'),
											'fields'	=>	array(
														array(	'name' 	=> 'gallery-images',
																'title'	=> __('Gallery Images','alterna'),
																'type'	=>	'gallery',
																'postformat'	=> 'gallery'
														),
														array(	'name' 	=> 'video-type',
																'title'	=> __('Video Type','alterna'),
																'type'	=>	'select',
																'options' => array('Youtube','Vimeo','Custom Code'),
																'postformat'	=> 'video'
															),
														array(	'name' 	=> 'video-content',
																'title'	=> __('Video ID or Custom Code','alterna'),
																'type'	=>	'textarea',
																'longdesc' => __('Youtube ID e.g. OapE7K5KyG0 "','alterna'),
																'postformat'	=> 'video'
															),
														array(	'name' 	=> 'audio-type',
																'title'	=> __('Audio Type','alterna'),
																'type'	=>	'select',
																'options' => array('Soundcloud','Custom Code'),
																'postformat'	=> 'audio'
															),
														array(	'name' 	=> 'audio-content',
																'title'	=> __('Soundcloud Url or Custom Code','alterna'),
																'type'	=>	'textarea',
																'longdesc' => __('Soundcloud e.g.  " http://api.soundcloud.com/tracks/38987054 "','alterna'),
																'postformat'	=> 'audio'
															),
														array(	'name' 	=> 'related-items-style',
																'title'	=> __('Related Items Style','alterna'),
																'type'	=>	'select',
																'options' => array(__('Use Global','alterna'), __('Style #1','alterna'),__('Style #2','alterna'),__('Style #3','alterna'),__('Style #4','alterna')),
																'desc'	=> __('Global will use default style, you can setting it through Alterna Options -> Blog','alterna')
															)
												)
									),
									'element-background' => array(	
											'id'	=>	'custom-post-background',
											'icon'	=>	'fa-picture-o',
											'title'	=>	__('Background','alterna'),
											'fields'	=>	$bgConfig
									),
									'element-style' => array(	
												'id'	=>	'custom-post-css-style',
												'icon'	=>	'fa-code',
												'title'	=>	__('Page Custom CSS, Scripts','alterna'),
												'fields'	=>	array(	
																		array(	'name' 	=> 'post-css-style',
																				'title'	=> __('Custom Page CSS','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		),
																		array(	'name' 	=> 'post-css-retina-style',
																				'title'	=> __('Custom Page Retina CSS','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		),
																		array(	'name' 	=> 'post-custom-scripts',
																				'title'	=> __('Custom Page Scripts','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		)
																	)
									)
					)
	);

//page
$metasConfig[] = array( 
	'id'		=>	'custom-page-setting',
	'type'		=>	'page',
	'priority'	=>	'high',
	'title' 	=>	__('Page Option Setting','alterna'),
	'page_elements'	=> array(
						'element-general' => array(	
								'id'	=>	'custom-page-general',
								'icon'	=>	'fa-gear',
								'title'	=>	__('General','alterna'),
								'fields'	=>	$generalConfig				
						),
						'element-template' => array(	
								'id'	=>	'custom-post-template',
								'icon'	=>	'fa-puzzle-piece',
								'title'	=>	__('Template Options','alterna'),
								'fields'	=>	array(
														array(	'name' 	=> 'blog-show-type',
																'title'	=> __('Item Style','alterna'),
																'type'	=>	'select',
																'template' => 'page-blog',
																'default' => 0 ,
																'options' => array(__('Default: Large Width','alterna') , __('Mid Width','alterna'))
															),
														// Blog with ajax
														array(	'name' 	=> 'blog-ajax-show-type',
																'title'	=> __('Item Style','alterna'),
																'type'	=>	'select',
																'template' => 'page-blog-ajax',
																'default' => 0 ,
																'options' => array(__('Default','alterna') , __('New Style','alterna'))
															),
														array(	'name' 	=> 'page-posts-cols',
																'title'	=> __('Columns','alterna'),
																'type'	=>	'select',
																'template' => 'page-blog-ajax page-portfolio-ajax page-portfolio',
																'default' => 1 ,
																'options' => array(__('2 columns','alterna') , __('3 columns','alterna') , __('4 columns','alterna'))
															),
														array(	'name' 	=> 'page-posts-num',
																'title'	=> __('Per Page Posts','alterna'),
																'type' 	=> 'number',
																'default' => 10 ,
																'template' => 'page-blog-ajax page-blog page-portfolio page-portfolio-ajax' ,
																'desc' => __('Also as read more load number.','alterna')
															),
														array(	'name' 	=> 'page-posts-cats',
																'title'	=> __('Custom Show Categories','alterna'),
																'type'	=>	'input',
																'template' => 'page-blog-ajax page-blog',
																'desc'	=>	__('Input post category id will just show these categories items use "," ','alterna')
																
															),
														array(	'name' 	=> 'page-posts-img-no-crop',
																'title'	=> __('Item Images Without Crop','alterna'),
																'type'	=>	'pc',
																'default'	=>	'off',
																'desc'	=>	__('Turn on will show image didn\'t crop so that show full image.','alterna'),
																'template'	=>	'page-blog-ajax page-portfolio page-portfolio-ajax',
														),
														array(	'name' 	=> 'page-posts-ajax-auto',
																'title'	=> __('Enabled Auto Load','alterna'),
																'type'	=>	'pc',
																'default'	=>	'off',
																'template'	=>	'page-blog-ajax page-portfolio-ajax',
														),
														// Portfolio
														array(	'name' 	=> 'portfolio-show-style',
																'title'	=> __('Item Show Style','alterna'),
																'type'	=>	'select',
																'template' => 'page-portfolio page-portfolio-ajax',
																'options' => array(__('Style #1','alterna'),__('Style #2','alterna'),__('Style #3','alterna'),__('Style #4','alterna'))
															),
														array(	'name' 	=> 'portfolio-show-filter',
																'title'	=> __('Portfolio Show Filters','alterna'),
																'type'	=>	'pc',
																'template' => 'page-portfolio page-portfolio-ajax',
																'desc'	=>	__('Check show filters buttons','alterna')
																
															),
														array(	'name' 	=> 'page-posts-cat-slugs',
																'title'	=> __('Custom Show Categories','alterna'),
																'type'	=>	'input',
																'template' => 'page-portfolio page-portfolio-ajax',
																'desc'	=>	__('Input portfolio category slug will just show these categories items use "," ','alterna')
																
															),
														// Google Map for contact page
														array(	'name' 	=> 'map-show',
																'title'	=> __('Header Map Show','alterna'),
																'type'	=>	'pc',
																'template' => 'page-contact',
																'enable-element' => 'yes',
																'enable-id'	=> '1-map_show_id',
																'enable-group'	=> 'map_show_group'
															),
														array(	'name' 	=> 'map-height',
																'title'	=> __('Map Height ','alterna'),
																'template' => 'page-contact',
																'type'	=>	'number',
																'default' => '320',
																'desc' =>	__('Header map height','alterna'),
																'enabled-id' => 'map_show_id',
																'enable-group'	=> 'map_show_group'
															),
														array(	'name' 	=> 'map-latlng',
																'title'	=> __('Map LatLng ','alterna'),
																'template' => 'page-contact',
																'type'	=>	'input',
																'desc' =>	__('For Example : 40.716038,-74.080811 ','alterna'),
																'enabled-id' => 'map_show_id',
																'enable-group'	=> 'map_show_group'
															),
														array(	'name' 	=> 'map-address',
																'title'	=> __('Map Address ','alterna'),
																'template' => 'page-contact',
																'type'	=>	'textarea',
																'desc' =>	__('(Support HTML )For Example : Company Name 123 street, New Valley , USA','alterna'),
																'enabled-id' => 'map_show_id',
																'enable-group'	=> 'map_show_group'
															),
														array(	'name' 	=> 'contact-map-theme',
																'title'	=> __('Map Skin','alterna'),
																'type'	=>	'select',
																'options'	=>	array('default','white','black'),
																'template'	=>	'page-contact',
																'enabled-id' => 'map_show_id',
																'enable-group'	=> 'map_show_group'
														),
														array(	'name' 	=> 'contact-form',
																'title'	=> __('Enable Contact Form','alterna'),
																'template' => 'page-contact',
																'type'	=>	'pc',
																'desc' => __('Use theme provided default contact form','alterna'),
																'enable-element' => 'yes',
																'enable-id'	=> '1-enable_contact_form',
																'enable-group'	=> 'enable_contact_form_group'
															),
														array(	'name' 	=> 'contact-recipient',
																'title'	=> __('Contact Recipient Email','alterna'),
																'template' => 'page-contact',
																'type'	=>	'input',
																'desc'	=>	__('It\'s just for default contact form. ','alterna'),
																'enabled-id'	=> 'enable_contact_form',
																'enable-group'	=> 'enable_contact_form_group'
															),
														array(	'name' 	=> 'contact-backsender',
																'title'	=> __('Sender Email Feedback','alterna'),
																'template' => 'page-contact',
																'type'	=>	'pc',
																'desc'	=>	__('If check sender will also get a success email when submit success. ','alterna'),
																'enabled-id'	=> 'enable_contact_form',
																'enable-group'	=> 'enable_contact_form_group'
															),
														array(	'name' 	=> 'form-recaptcha',
																'title'	=> __('Enabld Form Recaptcha','alterna'),
																'type'	=>	'pc',
																'template' => 'page-contact',
																'desc'	=>	__('Use google recaptcha for theme default contact form. ','alterna'),
																'enable-element' => 'yes',
																'enable-id'	=> '1-recaptcha_show_id',
																'enable-group'	=> 'recaptcha_show_group',
															),
														array(	'name' 	=> 'recaptcha-pub-api',
																'title'	=> __('Recaptcha Public Key','alterna'),
																'template' => 'page-contact',
																'type'	=>	'input',
																'default' => '',
																'desc' =>	__('<strong>The basic registration form requires</strong> that new users copy text from a "Captcha" image to keep spammers out of the site. You need an account at <a href="http://recaptcha.net/">recaptcha.net</a>. Signing up is FREE and easy. Once you have signed up, come back here and enter the following settings:','alterna'),
																'enabled-id' => 'recaptcha_show_id',
																'enable-group'	=> 'recaptcha_show_group'
															),
														array(	'name' 	=> 'recaptcha-pri-api',
																'title'	=> __('Recaptcha Private Key','alterna'),
																'template' => 'page-contact',
																'type'	=>	'input',
																'enabled-id' => 'recaptcha_show_id',
																'enable-group'	=> 'recaptcha_show_group'
															),
														array(	'name' 	=> 'recaptcha-theme',
																'title'	=> __('Recaptcha Theme','alterna'),
																'template' => 'page-contact',
																'type'	=>	'selectname',
																'options'	=> array('white', 'red', 'blackglass', 'clean'),
																'enabled-id' => 'recaptcha_show_id',
																'enable-group'	=> 'recaptcha_show_group',
															),
														array(	'name' 	=> 'recaptcha-lang',
																'title'	=> __('Recaptcha Language','alterna'),
																'template' => 'page-contact',
																'type'	=>	'selectname',
																'enabled-id' => 'recaptcha_show_id',
																'enable-group'	=> 'recaptcha_show_group',
																'options'	=> array('en', 'nl', 'fr', 'de', 'pt', 'ru', 'es', 'tr'),
															)
												)
									),
									'element-background' => array(	
											'id'	=>	'custom-post-background',
											'icon'	=>	'fa-picture-o',
											'title'	=>	__('Background','alterna'),
											'fields'	=>	$bgConfig
									),
									'element-style' => array(	
												'id'	=>	'custom-post-css-style',
												'icon'	=>	'fa-code',
												'title'	=>	__('Page Custom CSS, Scripts','alterna'),
												'fields'	=>	array(	
																		array(	'name' 	=> 'post-css-style',
																				'title'	=> __('Custom Page CSS','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		),
																		array(	'name' 	=> 'post-css-retina-style',
																				'title'	=> __('Custom Page Retina CSS','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		),
																		array(	'name' 	=> 'post-custom-scripts',
																				'title'	=> __('Custom Page Scripts','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		)
																	)
									)
					)
	);
	

//portfolio
$metasConfig[] = array( 'id'		=>	'custom-portfolio-setting',
					'type'		=>	'portfolio',
					'priority'	=>	'high',
					'title' 	=>	__('Page Option Setting','alterna'),
					'page_elements'	=> array(
									'element-general' => array(	
											'id'	=>	'custom-post-general',
											'icon'	=>	'fa-gear',
											'title'	=>	__('General','alterna'),
											'fields'	=>	$generalConfig				
									),
									'element-template' => array(	
											'id'	=>	'custom-post-template',
											'icon'	=>	'fa-puzzle-piece',
											'title'	=>	__('Portfolio Options','alterna'),
											'fields'	=>	array(
														array(	'name' 	=> 'portfolio-type',
																'title'	=> __('Portfolio Type','alterna'),
																'type'	=>	'radio',
																'radios'	=>	array(__('Image','alterna'),__('Gallery','alterna'),__('Video','alterna' )),
																'enable-element' => 'yes',
																'enable-id' => '0-portfolio_post_format_image:1-portfolio_post_format_gallery:2-portfolio_post_format_video',
																'enable-group'	=> 'portfolio_post_format'
																
														),
														array(	'name' 	=> 'gallery-images',
																'title'	=> __('Gallery Images','alterna'),
																'type'	=>	'gallery',
																'enabled-id' => 'portfolio_post_format_gallery',
																'enable-group'	=> 'portfolio_post_format'
														),
														array(	'name' 	=> 'video-type',
																'title'	=> __('Video Type','alterna'),
																'type'	=>	'radio',
																'radios'	=>	array('Youtube','Vimeo'),
																'enabled-id' => 'portfolio_post_format_video',
																'enable-group'	=> 'portfolio_post_format'
														),
														array(	'name' 	=> 'video-content',
																'title'	=> __('Video ID','alterna'),
																'type'	=>	'input',
																'desc'	=>	__('Youtube Id Example : " OapE7K5KyG0 "','alterna'),
																'enabled-id' => 'portfolio_post_format_video',
																'enable-group'	=> 'portfolio_post_format'
														),
														array(	'name' 	=> 'portfolio-client',
																'title'	=> __('Client','alterna'),
																'type'	=>	'input'																								
															),
														array(	'name' 	=> 'portfolio-skills',
																'title'	=> __('Skills','alterna'),
																'type'	=>	'input',		
															),
														array(	'name' 	=> 'portfolio-colors',
																'title'	=> __('Colors','alterna'),
																'type'	=>	'input',
																'desc'	=> __('Please use "," for multiple colors. Example: #ffffff,#000000 ','alterna')											
															),
														array(	'name' 	=> 'portfolio-system',
																'title'	=> __('Used System','alterna'),
																'type'	=>	'input'							
															),
														array(	'name' 	=> 'portfolio-price',
																'title'	=> __('Price ','alterna'),
																'type'	=>	'input'							
															),
														array(	'name' 	=> 'portfolio-link',
																'title'	=> __('Link','alterna'),
																'type'	=>	'input',									
															),
                                                                                                                array(	'name' 	=> 'portfolio-link-name',
																'title'	=> __('Link Name','alterna'),
																'type'	=>	'input',
                                                                                                                                'desc'	=> __('Link name for style #4 link button text','alterna')
															),
														array(	'name' 	=> 'portfolio-custom-fields',
																'title'	=> __('Custom Portfolio Fields','alterna'),
																'type'	=>	'custom',
																'fileds' => array('Name','Icon','Value'), 
																'default'	=>	'',
																'desc'	=> __('Icon field use fontawesome icon name','alterna')
														),
														array(	'name' 	=> 'portfolio-post-style',
																'title'	=> __('Single Page Style','alterna'),
																'type'	=>	'select',
																'options' => array(__('Use Global','alterna'),__('Style #1','alterna'),__('Style #2','alterna'),__('Style #3','alterna'),__('Style #4','alterna')),
																'desc'	=> __('Global will use default style, you can setting it through Alterna Options -> Portfolio','alterna')
															),
														array(	'name' 	=> 'related-items-style',
																'title'	=> __('Related Items Style','alterna'),
																'type'	=>	'select',
																'options' => array(__('Use Global','alterna'), __('Style #1','alterna'),__('Style #2','alterna'),__('Style #3','alterna'),__('Style #4','alterna')),
																'desc'	=> __('Global will use default style, you can setting it through Alterna Options -> Portfolio','alterna')
															)
												)
									),
									'element-background' => array(	
											'id'	=>	'custom-post-background',
											'icon'	=>	'fa-picture-o',
											'title'	=>	__('Background','alterna'),
											'fields'	=>	$bgConfig
									),
									'element-style' => array(	
												'id'	=>	'custom-post-css-style',
												'icon'	=>	'fa-code',
												'title'	=>	__('Page Custom CSS, Scripts','alterna'),
												'fields'	=>	array(	
																		array(	'name' 	=> 'post-css-style',
																				'title'	=> __('Custom Page CSS','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		),
																		array(	'name' 	=> 'post-css-retina-style',
																				'title'	=> __('Custom Page Retina CSS','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		),
																		array(	'name' 	=> 'post-custom-scripts',
																				'title'	=> __('Custom Page Scripts','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		)
																	)
									)
					)
	);

//product
$metasConfig[] = array( 'id'		=>	'custom-product-setting',
					'type'		=>	'product',
					'priority'	=>	'high',
					'title' 	=>	__('Page Option Setting','alterna'),
					'page_elements'	=> array(
									'element-general' => array(	
											'id'	=>	'custom-post-general',
											'icon'	=>	'fa-gear',
											'title'	=>	__('General','alterna'),
											'fields'	=>	$generalConfig				
									),
									'element-background' => array(	
											'id'	=>	'custom-post-background',
											'icon'	=>	'fa-picture-o',
											'title'	=>	__('Background','alterna'),
											'fields'	=>	$bgConfig
									),
									'element-style' => array(	
												'id'	=>	'custom-post-css-style',
												'icon'	=>	'fa-code',
												'title'	=>	__('Page Custom CSS, Scripts','alterna'),
												'fields'	=>	array(	
																		array(	'name' 	=> 'post-css-style',
																				'title'	=> __('Custom Page CSS','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		),
																		array(	'name' 	=> 'post-css-retina-style',
																				'title'	=> __('Custom Page Retina CSS','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		),
																		array(	'name' 	=> 'post-custom-scripts',
																				'title'	=> __('Custom Page Scripts','alterna'),
																				'type'	=>	'textarea',
																				'codetype' => 'css'
																		)
																	)
									)
					)
	);


$postsConfig = array(
				'portfolio' => array(
									'id'					=>	'portfolio',
									'name'					=>	__('Portfolios','alterna'),
									'menu_name'				=>	__('Portfolios','alterna'),
									'singular_name'			=>	__('Portfolio','alterna'),
									'add_new'				=>	__('Add New','alterna'),
									'add_new_item'			=>	__('Add New','alterna'),
									'edit_item'				=>	__('Edit Portfolio','alterna'),
									'new_item'				=>	__('New Portfolio','alterna'),
									'all_items'				=>	__('All Portfolios','alterna'),
									'view_item'				=>	__('View Portfolio','alterna'),
									'search_items'			=>	__('Search Portfolio','alterna'),
									'not_found'				=>	__('No portfolio found','alterna'),
									'not_found_in_trash'	=>	__('No portfolio found in Trash','alterna'),
									'parent_item_colon'		=>	'',
									'menu_position'			=>	5,
									'rewrite'				=>	'portfolio',
									'rewrite_rule'			=>	'',
									'menu_icon'				=>	'\f180',
									'supports'				=>	array('title', 'editor' , 'thumbnail', 'comments'),
									'categories'			=>	array(
																	'portfolio_cats'	=>	array(
																								'id'			=>	'portfolio_categories',
																								'name'			=>	__( 'Portfolio Categories' ,'alterna'),
																								'menu_name'		=>	__( 'Portfolio Categories' ,'alterna'),
																								'singular_name'	=>	__( 'Portfolio Categories' ,'alterna'),
																								'search_items'	=>	__( 'Search Portfolio Categories' ,'alterna'),
																								'all_items'		=>	__( 'All Portfolio Categories' ,'alterna'),
																								'parent_item'	=>	__( 'Parent Category' ,'alterna'),
																								'parent_item_colon'	=>	__( 'Parent Category:' ,'alterna'),
																								'edit_item'			=>	__( 'Edit Portfolio Category' ,'alterna'),
																								'update_item'		=>	__( 'Update Portfolio Category' ,'alterna'),
																								'add_new_item'		=>	__( 'Add Portfolio Category' ,'alterna'),
																								'new_item_name'		=>	__( 'New Portfolio Category' ,'alterna'),
																								'rewrite'			=>	'',
																								'hierarchical'		=>	true
																							)
																)
									
							)
			);
$postsColumnsConfig = array('portfolio' => array(
											'type'		=>	'portfolio',
											'fields'	=>	array(
																array('id' => 'portfolio-type', 'name' => __( 'Post Type' ,'alterna')),
															)
										)
			);
			
// start penguin framework for them
Penguin::$FRAMEWORK_PATH = "/inc/penguin";
Penguin::$THEME_NAME = "alterna";
Penguin::start($optionsConfig , $metasConfig , $postsConfig , $postsColumnsConfig, false);

// here need custom return value
function Penguin_Custom_Posts_Columns_Value($type, $column_name, $id){
/* start */
if($type == 'portfolio'){
	if($column_name == 'portfolio-type'){
		switch(intval(penguin_get_post_meta_key($column_name, $id))){
			case 0: _e('Image','alterna');break;
			case 1: _e('Gallery','alterna');break;
			case 2: _e('Video','alterna');break;
		}
	}
}
/* end */
}

/********************************************************************************************
* Other Theme Ready Setting
*
* @since alterna 8.0
********************************************************************************************/

// theme plugins
include_once('tools/sidebar_generator.php');
include_once('plugins-config.php');

// Disable LayerSlider auto-updates
function penguin_layerslider_overrides() {
	$GLOBALS['lsAutoUpdateBox'] = false;
}
add_action('layerslider_ready', 'penguin_layerslider_overrides');

// Disable VC auto-updates
function penguin_vcSetAsTheme() {
	vc_set_as_theme(true);
}
add_action( 'vc_before_init', 'penguin_vcSetAsTheme' );

// Disable RevSlider auto-updates
function penguin_set_revSetAsTheme() {
	if(function_exists( 'set_revslider_as_theme' )){
		set_revslider_as_theme();
	}
}
add_action( 'init', 'penguin_set_revSetAsTheme' );

// Generate Options CSS
add_action('admin_init', 'penguin_generate_options_css');

// Register an action (can be any suitable action)
function on_envato_init(){
	if(penguin_get_options_key('theme-update-enable') != "on" || penguin_get_options_key('theme-purchase-code') == "" || penguin_get_options_key('theme-name') == "" || penguin_get_options_key('theme-api') == ""){
		 return false;
	}
	
	// include the library
	include_once(get_template_directory().'/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');
	
        $theme_name = trim(penguin_get_options_key('theme-name'));
        $theme_api  = trim(penguin_get_options_key('theme-api') );

	$upgrader = new Envato_WordPress_Theme_Upgrader($theme_name , $theme_api );
	/*
	 *  Uncomment to check if the current theme has been updated
	 */
	$upgrader->check_for_theme_update(); 

	/*
	 *  Uncomment to update the current theme
	 */
	$upgrader->upgrade_theme();
}
add_action('admin_init', 'on_envato_init');

add_action('admin_notices', 'on_theme_license_notices');

function on_theme_license_notices(){
	global $pagenow;
	if($pagenow == "admin.php" && isset($_GET['page']) && $_GET['page'] == 'alterna_options_page'){
		
	}else{
		$output = 'Hi! Please <a href="'.admin_url().'admin.php?page=alterna_options_page">input your license information</a> of <strong>Alterna</strong> theme.';
		
		if(penguin_get_options_key('theme-purchase-code') != "" && penguin_get_options_key('theme-name') != "" && penguin_get_options_key('theme-api') != ""){
			$output = '';
		}
		if($output != ''){
		?>
		<div id="penguin-notice-message" style="display:none;" class="updated below-h2"><p><?php echo $output;?><a id="penguin-license-close" href="#" class="penguin-notice-close" style="float: right;"><strong>X</strong></a></p></div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				jQuery('#wpbody-content .wrap').prepend(jQuery('#penguin-notice-message'));
				jQuery('#penguin-notice-message').show();
				jQuery('#penguin-license-close').click(function() {
					jQuery('#penguin-notice-message').hide();
					return false;
				});
			});
		</script>
		<?php
		}
	}
}

?>