<?php
/**
 * Footer Widgets
 * 
 * @since alterna 7.0
 */

// get footer widget list
$widgets = alterna_get_footer_widget_active_items(); 
if(count($widgets) > 0) {
?>
<div class="footer-top-content">
    <div class="container">
        <div class="row">
            <?php foreach($widgets as $widget){ ?>
            <div class="<?php echo esc_attr($widget[0]); ?>"><?php dynamic_sidebar(esc_attr($widget[1])); ?></div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>