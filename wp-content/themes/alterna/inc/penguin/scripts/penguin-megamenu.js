/**
	Penguin Framework

	Copyright (c) 2009-2015 ThemeFocus

	@url http://penguin.themefocus.co
	@package Penguin
	@version 6.0
**/
"use strict";
jQuery(document).ready(function($) {

	/* create penguin object */
	var penguin = new Object({
		init:function(){
			var refresh_bool = false;
			
			var is_subtitle = false;
			
			if($('.megamenu-subtitle-style').length > 0){
				is_subtitle = true;
			}
			
			/* check new menu element then add event for it*/
			function checkMenuChanged(){
				$('#menu-to-edit li').each(function() {
					if($(this).hasClass('penguin-had-add-event')){
						return;
					}else{
						addMenuChangeEvent(this);
						refreshMegaMenu();
					}
				});
			}
			
			/* add menu element event like mouse over and checkbox event */
			function addMenuChangeEvent(element){
				$(element).addClass('penguin-had-add-event');
				var menu = $(element);
				
				/* enabled mega menu checkbox */
				menu.find('.penguin-megamenu-enable-checkbox').click(function() {
					if($(this).attr('checked') == "checked"){
						if(!menu.hasClass('megamenu-enabled')){
							menu.addClass('megamenu-enabled');
						}
						if(is_subtitle){
							if(!menu.hasClass('megamenu-subtitle-style')){
								menu.addClass('megamenu-subtitle-style');
							}
						}
					}else{
						menu.removeClass('megamenu-enabled');
						if(is_subtitle){
							menu.removeClass('megamenu-subtitle-style');
						}
					}
					refreshMegaMenu();
				});
				
				menu.find('.penguin-megamenu-direction input').click(function() {
					refreshMegaMenu();
				});
				
				/* menu li element mouse up start refresh data */
				menu.mouseup(function() {
					refreshMegaMenu();
					refresh_bool = true;
				});
				
				/* menu li element mouse out end refresh data */
				menu.mouseout(function() {
					if(refresh_bool){
						refreshMegaMenu();
						refresh_bool = false;
					}
				});
			}
			
			/* refresh mega menu style data */
			function refreshMegaMenu(){
				var items = $('#menu-to-edit li');
				var main_menu = false;
				var megamenu_enabled = false;
				var current_main;
				
				for(var i=0; i<items.length; i++){
					if($(items[i]).hasClass('menu-item-depth-0')){
						if($(items[i]).find('.penguin-megamenu-enable-checkbox').attr('checked') == "checked"){
							main_menu = true;
							megamenu_enabled = true;
							current_main = items[i];
							if(!$(items[i]).hasClass('megamenu-enabled')){
								$(items[i]).addClass('megamenu-enabled');
							}
							
							if(is_subtitle){
								if(!$(items[i]).hasClass('megamenu-subtitle-style')){
									$(items[i]).addClass('megamenu-subtitle-style');
								}
							}
							
						}else{
							megamenu_enabled = false;
							if($(items[i]).hasClass('megamenu-enabled')){
								$(items[i]).removeClass('megamenu-enabled');
							}
							if(is_subtitle){
								$(items[i]).removeClass('megamenu-subtitle-style');
							}
						}
						$(items[i]).removeClass('sub-megamenu-enabled');
					}else{
						main_menu = false;
						$(items[i]).removeClass('megamenu-enabled');
						if(is_subtitle){
							$(items[i]).removeClass('megamenu-subtitle-style');
						}
						if(megamenu_enabled){
							if(!$(items[i]).hasClass('sub-megamenu-enabled')){
								$(items[i]).addClass('sub-megamenu-enabled');
							}
						}else{
							$(items[i]).removeClass('sub-megamenu-enabled');
						}
					}
				}
			}
			
			refreshMegaMenu();
			
			setInterval(checkMenuChanged,3000);
		}
	});
	
	penguin.init();
	
});