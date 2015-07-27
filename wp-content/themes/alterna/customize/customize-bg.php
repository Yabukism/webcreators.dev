<?php
if(penguin_get_options_key('custom-background-enable') == "on"){
/* body */
if(intval(penguin_get_options_key('global-layout')) != 1) {alterna_add_background_style('global','body.boxed-layout');} 
/* header */
alterna_add_background_style('global-header','#alterna-header');
/* title */
alterna_add_background_style('global-title','#page-header');
/* content */
alterna_add_background_style('global-content','.content-wrap');
/* footer */
alterna_add_background_style('global-footer','.footer-content');
?>
/* 	RETINA	*/
@media only screen and (-Webkit-min-device-pixel-ratio: 1.5),only screen and (-moz-min-device-pixel-ratio: 1.5),only screen and (-o-min-device-pixel-ratio: 3/2),only screen and (min-device-pixel-ratio: 1.5) {
<?php
/* body */
if(intval(penguin_get_options_key('global-layout')) != 1) {alterna_add_background_style('global','body.boxed-layout', 0, true);}
/* header */
alterna_add_background_style('global-header','#alterna-header', 0, true);
/* title */
alterna_add_background_style('global-title','#page-header', 0, true);
/* content */
alterna_add_background_style('global-content','.content-wrap', 0, true);
/* footer */
alterna_add_background_style('global-footer','.footer-content', 0, true);
?>
}
<?php
}
?>