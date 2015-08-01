<?php
/**
 * Header Topbar
 * 
 * @since alterna 8.0
 */
if(penguin_get_options_key('topbar-enable') == "on") {
?>
    <div id="header-topbar">
        <div class="container">
        	<div class="row">
            	<?php if(intval(penguin_get_options_key('topbar-layout')) == 1){?>
                <div class="col-md-6 col-sm-6">
                    <div id="header-topbar-left-content">
                    <?php alterna_get_topbar_content(0); ?>
                    </div>
                </div>
                 <div class="col-md-6 col-sm-6">
                    <div id="header-topbar-right-content">
                    <?php alterna_get_topbar_content(1); ?>
                    </div>
                </div>
                <?php }else if(intval(penguin_get_options_key('topbar-layout')) == 2){?>
                <div class="col-md-4 col-sm-4">
                    <div id="header-topbar-left-content">
                    <?php alterna_get_topbar_content(0); ?>
                    </div>
                </div>
                 <div class="col-md-8 col-sm-8">
                    <div id="header-topbar-right-content">
                    <?php alterna_get_topbar_content(1); ?>
                    </div>
                </div>
                <?php }else if(intval(penguin_get_options_key('topbar-layout')) == 3){?>
                <div class="col-md-8 col-sm-8">
                    <div id="header-topbar-left-content">
                    <?php alterna_get_topbar_content(0); ?>
                    </div>
                </div>
                 <div class="col-md-4 col-sm-4">
                    <div id="header-topbar-right-content">
                    <?php alterna_get_topbar_content(1); ?>
                    </div>
                </div>
                <?php }else{ ?>
                 <div class="col-md-12 col-sm-12">
                    <div id="header-topbar-right-content">
                    <?php alterna_get_topbar_content(1); ?>
                    </div>
                </div>
                <?php } ?>
        	</div>
        </div>
    </div>
<?php
}
?>