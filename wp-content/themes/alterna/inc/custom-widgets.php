<?php
/**
 * Custom Theme Widgets
 *
 * @since alterna 7.0
 */
 
/**
 * Register All Widget
 */
function alterna_register_widgets() {
	register_widget( 'alternaPortfolioCategoryWidget' );
	register_widget( 'alternaPortfolioRecentWidget' );
	register_widget( 'alternaPortfolioCustomItemsWidget' );
	register_widget( 'alternaPortfolioTabsWidget' );
	
	register_widget( 'alternaBlogRecentWidget' );
	register_widget( 'alternaBlogCustomItemsWidget' );
	register_widget( 'alternaBlogPopularWidget' );
	register_widget( 'alternaBlogTabsWidget' );
}

add_action( 'widgets_init', 'alterna_register_widgets' );

/**
 * Blog Tabs Items Widget
 */
class alternaBlogTabsWidget extends WP_Widget {

	function alternaBlogTabsWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Blog Tabs Items','alterna'), array( 'description' => __( 'Alterna blog tabs items for popular, features, recent items! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		//$title = apply_filters('widget_title', $instance['title'] );
		$show_style = apply_filters('widget_title', $instance['show_style'] );
		$show_featured = apply_filters('widget_title', $instance['show_featured'] );
		$show_ids = apply_filters('widget_title', $instance['show_ids'] );
		$show_recent = apply_filters('widget_title', $instance['show_recent'] );
		$show_num = apply_filters('widget_title', $instance['show_num'] );
		$featured_title = apply_filters('widget_title', $instance['featured_title'] );
		$recent_title = apply_filters('widget_title', $instance['recent_title'] );
		$show_popular = apply_filters('widget_title', $instance['show_popular'] );
		$popular_title = apply_filters('widget_title', $instance['popular_title'] );
		$popular_num = apply_filters('widget_title', $instance['popular_num'] );
		
		echo $before_widget;
		
		$html = '[tabs]';
		if($show_popular) {
			if($popular_title == ""){
				$popular_title = __('Popular','alterna');
			}
			$html .='[tabs_item title="'.$popular_title.'"]'.alterna_get_blog_recent_post('popular',$popular_num,(intval($show_style) + 1)).'[/tabs_item] ';
		}
		if($show_featured) {
			if($featured_title == ""){
				$featured_title = __('Featured','alterna');
			}
			$html .='[tabs_item title="'.$featured_title.'"]'.alterna_get_blog_recent_post('featured',count(explode(",",$show_ids)),(intval($show_style) + 1),$show_ids).'[/tabs_item] ';
		}
		if($show_recent) {
			if($recent_title == ""){
				$recent_title = __('Recent','alterna');
			}
			$html .='[tabs_item title="'.$recent_title.'"]'.alterna_get_blog_recent_post('recent',$show_num, (intval($show_style) + 1)).'[/tabs_item] ';
		}
		$html .='[/tabs]';
		
		echo do_shortcode($html);
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		//$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_style'] = strip_tags($new_instance['show_style']);
		// popular
		$instance['show_popular'] = strip_tags($new_instance['show_popular']);
		$instance['popular_title'] = strip_tags($new_instance['popular_title']);
		$instance['popular_num'] = strip_tags($new_instance['popular_num']);
		// featured show
		$instance['show_featured'] = strip_tags($new_instance['show_featured']);
		$instance['featured_title'] = strip_tags($new_instance['featured_title']);
		$instance['show_ids'] = strip_tags($new_instance['show_ids']);
		// recent show
		$instance['show_recent'] = strip_tags($new_instance['show_recent']);
		$instance['recent_title'] = strip_tags($new_instance['recent_title']);
		$instance['show_num'] = strip_tags($new_instance['show_num']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['show_style']) ){
			$show_style = $instance['show_style'];
		}else{
			$show_style = 0;
		}

		if( isset($instance['show_popular']) ){
			$show_popular = $instance['show_popular'];
		}else{
			$show_popular = 'yes';
		}
		if( isset($instance['popular_title']) ){
			$popular_title = $instance['popular_title'];
		}else{
			$popular_title = __('Popular','alterna');
		}
		if( isset($instance['popular_num']) ){
			$popular_num = $instance['popular_num'];
		}else{
			$popular_num = 5;
		}
		
		if( isset($instance['show_featured']) ){
			$show_featured = $instance['show_featured'];
		}else{
			$show_featured = 'yes';
		}
		if( isset($instance['featured_title']) ){
			$featured_title = $instance['featured_title'];
		}else{
			$featured_title = __('Featured','alterna');
		}
		if( isset($instance['show_ids']) ){
			$show_ids = $instance['show_ids'];
		}else{
			$show_ids = '';
		}
		
		if( isset($instance['show_recent']) ){
			$show_recent = $instance['show_recent'];
		}else{
			$show_recent = 'yes';
		}
		if( isset($instance['recent_title']) ){
			$recent_title = $instance['recent_title'];
		}else{
			$recent_title = __('Recent','alterna');
		}
		if( isset($instance['show_num']) ){
			$show_num = $instance['show_num'];
		}else{
			$show_num = 5;
		}
		?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>"><?php _e( 'Show Style:' , 'alterna'); ?></label> 
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_style' )); ?>" type="text">
            <option value="0" <?php echo $show_style == 0 ? 'selected="selected"' : ''; ?>><?php _e( 'Icon Style' , 'alterna'); ?></option>
            <option value="1" <?php echo $show_style == 1 ? 'selected="selected"' : ''; ?>><?php _e( 'Thumbs Style' , 'alterna'); ?></option>
            <option value="2" <?php echo $show_style == 2 ? 'selected="selected"' : ''; ?>><?php _e( 'Big Thumbs Style' , 'alterna'); ?></option>
        </select>
        </p>
        <hr />
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_popular' )); ?>"><input id="<?php echo esc_attr($this->get_field_id( 'show_popular' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_popular' )); ?>" type="checkbox" <?php checked('yes' , $show_popular); ?>  value="yes" /><?php _e( 'Click show popular items' , 'alterna'); ?></label> 
		</p>
         <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'popular_title' )); ?>"><?php _e( 'Popular Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'popular_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'popular_title' )); ?>" type="text" value="<?php echo esc_attr( $popular_title ); ?>" />
		</p>
		<p>
        <label for="<?php echo esc_attr($this->get_field_id( 'popular_num' )); ?>"><?php _e( 'Popular Items number' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'popular_num' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'popular_num' )); ?>" value="<?php echo esc_attr( $popular_num ); ?>" type="number">
		</p>
        <hr />
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_featured' )); ?>"><input id="<?php echo esc_attr($this->get_field_id( 'show_featured' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_featured' )); ?>" type="checkbox" <?php checked('yes' , $show_featured); ?>  value="yes" /><?php _e( 'Click show featured items' , 'alterna'); ?></label> 
		</p>
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'featured_title' )); ?>"><?php _e( 'Featured Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'featured_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'featured_title' )); ?>" type="text" value="<?php echo esc_attr( $featured_title ); ?>" />
		</p>
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'show_ids' )); ?>"><?php _e( 'IDs:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_ids' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_ids' )); ?>" type="text" value="<?php echo esc_attr( $show_ids ); ?>" placeholder="1,2,3" />
		</p>
        <hr />
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_recent' )); ?>"><input id="<?php echo esc_attr($this->get_field_id( 'show_recent' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_recent' )); ?>" type="checkbox" <?php checked('yes' , $show_recent); ?>  value="yes" /><?php _e( 'Click show recent items' , 'alterna'); ?></label> 
		</p>
         <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'recent_title' )); ?>"><?php _e( 'Recent Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_title' )); ?>" type="text" value="<?php echo esc_attr( $recent_title ); ?>" />
		</p>
		<p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_num' )); ?>"><?php _e( 'Recent Items number' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_num' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_num' )); ?>" value="<?php echo esc_attr( $show_num ); ?>" type="number">
		</p>
        <?php
	}
}

/**
 * Blog Popular Widget
 */
class alternaBlogPopularWidget extends WP_Widget {

	function alternaBlogPopularWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Blog Popular Items','alterna'), array( 'description' => __( 'Alterna blog popular items! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$show_style = apply_filters('widget_title', $instance['show_style'] );
		$show_num = apply_filters('widget_title', $instance['show_num'] );
		
		echo $before_widget;
		
		if ( $title ) {
		    echo $before_title . $title . $after_title;
		}
		echo '<div class="widget-alterna-recent-blog">'.alterna_get_blog_recent_post('popular',$show_num, (intval($show_style) + 1)).'</div>';
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_style'] = strip_tags($new_instance['show_style']);
		$instance['show_num'] = strip_tags($new_instance['show_num']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['title']) ){
			$title = $instance['title'];
		}else{
			$title = __('Popular Items','alterna');
		}
		if( isset($instance['show_style']) ){
			$show_style = $instance['show_style'];
		}else{
			$show_style = 0;
		}
		if( isset($instance['show_num']) ){
			$show_num = $instance['show_num'];
		}else{
			$show_num = 5;
		}
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>"><?php _e( 'Show Style:' , 'alterna'); ?></label> 
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_style' )); ?>" type="text">
            <option value="0" <?php echo $show_style == 0 ? 'selected="selected"' : ''; ?>><?php _e( 'Icon Style' , 'alterna'); ?></option>
            <option value="1" <?php echo $show_style == 1 ? 'selected="selected"' : ''; ?>><?php _e( 'Thumbs Style' , 'alterna'); ?></option>
            <option value="2" <?php echo $show_style == 2 ? 'selected="selected"' : ''; ?>><?php _e( 'Big Thumbs Style' , 'alterna'); ?></option>
        </select>
        </p>
       	<p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_num' )); ?>"><?php _e( 'Recent Items number' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_num' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_num' )); ?>" value="<?php echo esc_attr( $show_num ); ?>" type="number">
		</p>
        <?php
	}
}

/**
 * Blog Custom Items Widget
 */
class alternaBlogCustomItemsWidget extends WP_Widget {

	function alternaBlogCustomItemsWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Blog Custom Items','alterna'), array( 'description' => __( 'Alterna blog custom show items! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$show_style = apply_filters('widget_title', $instance['show_style'] );
		$show_ids = apply_filters('widget_title', $instance['show_ids'] );
		
		$show_num = count(explode(",",$show_ids));
		
		echo $before_widget;
		
		if ( $title ) {
		    echo $before_title . $title . $after_title;
		}
		echo '<div class="widget-alterna-recent-blog">'.alterna_get_blog_recent_post('featured',$show_num, (intval($show_style) + 1),$show_ids).'</div>';
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_style'] = strip_tags($new_instance['show_style']);
		$instance['show_ids'] = strip_tags($new_instance['show_ids']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['title']) ){
			$title = $instance['title'];
		}else{
			$title = __('Featured Items','alterna');
		}
		if( isset($instance['show_style']) ){
			$show_style = $instance['show_style'];
		}else{
			$show_style = 0;
		}
		if( isset($instance['show_ids']) ){
			$show_ids = $instance['show_ids'];
		}else{
			$show_ids = '';
		}
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'show_ids' )); ?>"><?php _e( 'IDs:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_ids' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_ids' )); ?>" type="text" value="<?php echo esc_attr( $show_ids ); ?>" placeholder="1,2,3" />
		</p>
        
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>"><?php _e( 'Show Style:' , 'alterna'); ?></label> 
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_style' )); ?>" type="text">
            <option value="0" <?php echo $show_style == 0 ? 'selected="selected"' : ''; ?>><?php _e( 'Icon Style' , 'alterna'); ?></option>
            <option value="1" <?php echo $show_style == 1 ? 'selected="selected"' : ''; ?>><?php _e( 'Thumbs Style' , 'alterna'); ?></option>
            <option value="2" <?php echo $show_style == 2 ? 'selected="selected"' : ''; ?>><?php _e( 'Big Thumbs Style' , 'alterna'); ?></option>
        </select>
        </p>
        <?php
	}
}

/**
 * Blog Recent Widget
 */
class alternaBlogRecentWidget extends WP_Widget {

	function alternaBlogRecentWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Blog Recent Items','alterna'), array( 'description' => __( 'Alterna blog recent items! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$show_style = apply_filters('widget_title', $instance['show_style'] );
		$show_num = apply_filters('widget_title', $instance['show_num'] );
		$show_rand = apply_filters('widget_title', $instance['show_rand'] );
		
		echo $before_widget;
		
		if ( $title ) {
		    echo $before_title . $title . $after_title;
		}
		echo '<div class="widget-alterna-recent-blog">'.alterna_get_blog_recent_post('recent',$show_num, (intval($show_style) + 1),'',$show_rand).'</div>';
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_style'] = strip_tags($new_instance['show_style']);
		$instance['show_num'] = strip_tags($new_instance['show_num']);
		$instance['show_rand'] = strip_tags($new_instance['show_rand']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['title']) ){
			$title = $instance['title'];
		}else{
			$title = __('Recent Items','alterna');
		}
		if( isset($instance['show_style']) ){
			$show_style = $instance['show_style'];
		}else{
			$show_style = 0;
		}
		if( isset($instance['show_num']) ){
			$show_num = $instance['show_num'];
		}else{
			$show_num = 5;
		}
		if( isset($instance['show_rand']) ){
			$show_rand = $instance['show_rand'];
		}else{
			$show_rand = '';
		}
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>"><?php _e( 'Show Style:' , 'alterna'); ?></label> 
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_style' )); ?>" type="text">
            <option value="0" <?php echo $show_style == 0 ? 'selected="selected"' : ''; ?>><?php _e( 'Icon Style' , 'alterna'); ?></option>
            <option value="1" <?php echo $show_style == 1 ? 'selected="selected"' : ''; ?>><?php _e( 'Thumbs Style' , 'alterna'); ?></option>
            <option value="2" <?php echo $show_style == 2 ? 'selected="selected"' : ''; ?>><?php _e( 'Big Thumbs Style' , 'alterna'); ?></option>
        </select>
        </p>
       	<p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_num' )); ?>"><?php _e( 'Recent Items number' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_num' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_num' )); ?>" value="<?php echo esc_attr( $show_num ); ?>" type="number">
		</p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_rand' )); ?>"><input id="<?php echo esc_attr($this->get_field_id( 'show_rand' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_rand' )); ?>" type="checkbox" <?php checked('yes' , $show_rand); ?>  value="yes" /><?php _e( 'Click show random posts' , 'alterna'); ?></label> 
		</p>
        <?php
	}
}


/**
 * Portfolio Tabs Items Widget
 */
class alternaPortfolioTabsWidget extends WP_Widget {

	function alternaPortfolioTabsWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Portfolio Tabs Items','alterna'), array( 'description' => __( 'Alterna portfolio tabs items for custom ids, recent items! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		//$title = apply_filters('widget_title', $instance['title'] );
		$show_style = apply_filters('widget_title', $instance['show_style'] );
		$show_featured = apply_filters('widget_title', $instance['show_featured'] );
		$show_ids = apply_filters('widget_title', $instance['show_ids'] );
		$show_recent = apply_filters('widget_title', $instance['show_recent'] );
		$show_num = apply_filters('widget_title', $instance['show_num'] );
		$featured_title = apply_filters('widget_title', $instance['featured_title'] );
		$recent_title = apply_filters('widget_title', $instance['recent_title'] );
		
		echo $before_widget;
		
		$html = '[tabs]';
		if($show_featured) {
			if($featured_title == ""){
				$featured_title = __('Featured','alterna');
			}
			$html .='[tabs_item title="'.$featured_title.'"]'.alterna_get_portfolio_recent_post('featured',count(explode(",",$show_ids)),(intval($show_style) + 1),$show_ids).'[/tabs_item] ';
		}
		if($show_recent) {
			if($recent_title == ""){
				$recent_title = __('Recent','alterna');
			}
			$html .='[tabs_item title="'.$recent_title.'"]'.alterna_get_portfolio_recent_post('recent',$show_num, (intval($show_style) + 1)).'[/tabs_item] ';
		}
		$html .='[/tabs]';
		
		echo do_shortcode($html);
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		//$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_style'] = strip_tags($new_instance['show_style']);
		// featured show
		$instance['show_featured'] = strip_tags($new_instance['show_featured']);
		$instance['featured_title'] = strip_tags($new_instance['featured_title']);
		$instance['show_ids'] = strip_tags($new_instance['show_ids']);
		// recent show
		$instance['show_recent'] = strip_tags($new_instance['show_recent']);
		$instance['recent_title'] = strip_tags($new_instance['recent_title']);
		$instance['show_num'] = strip_tags($new_instance['show_num']);
		return $instance;
	}

	function form( $instance ) {
		
		if( isset($instance['show_style']) ){
			$show_style = $instance['show_style'];
		}else{
			$show_style = 0;
		}
		if( isset($instance['show_featured']) ){
			$show_featured = $instance['show_featured'];
		}else{
			$show_featured = 'yes';
		}
		if( isset($instance['featured_title']) ){
			$featured_title = $instance['featured_title'];
		}else{
			$featured_title = __('Featured','alterna');
		}
		if( isset($instance['show_ids']) ){
			$show_ids = $instance['show_ids'];
		}else{
			$show_ids = '';
		}
		if( isset($instance['show_recent']) ){
			$show_recent = $instance['show_recent'];
		}else{
			$show_recent = 'yes';
		}
		if( isset($instance['recent_title']) ){
			$recent_title = $instance['recent_title'];
		}else{
			$recent_title = __('Recent','alterna');
		}
		if( isset($instance['show_num']) ){
			$show_num = $instance['show_num'];
		}else{
			$show_num = 5;
		}
		?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>"><?php _e( 'Show Style:' , 'alterna'); ?></label> 
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_style' )); ?>" type="text">
            <option value="0" <?php echo $show_style == 0 ? 'selected="selected"' : ''; ?>><?php _e( 'Icon Style' , 'alterna'); ?></option>
            <option value="1" <?php echo $show_style == 1 ? 'selected="selected"' : ''; ?>><?php _e( 'Thumbs Style' , 'alterna'); ?></option>
            <option value="2" <?php echo $show_style == 2 ? 'selected="selected"' : ''; ?>><?php _e( 'Big Thumbs Style' , 'alterna'); ?></option>
        </select>
        </p>
        <hr />
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_featured' )); ?>"><input id="<?php echo esc_attr($this->get_field_id( 'show_featured' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_featured' )); ?>" type="checkbox" <?php checked('yes' , $show_featured); ?>  value="yes" /><?php _e( 'Click show featured items' , 'alterna'); ?></label> 
		</p>
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'featured_title' )); ?>"><?php _e( 'Featured Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'featured_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'featured_title' )); ?>" type="text" value="<?php echo esc_attr( $featured_title ); ?>" />
		</p>
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'show_ids' )); ?>"><?php _e( 'IDs:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_ids' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_ids' )); ?>" type="text" value="<?php echo esc_attr( $show_ids ); ?>" placeholder="1,2,3" />
		</p>
        <hr />
         <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_recent' )); ?>"><input id="<?php echo esc_attr($this->get_field_id( 'show_recent' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_recent' )); ?>" type="checkbox" <?php checked('yes' , $show_recent); ?>  value="yes" /><?php _e( 'Click show recent items' , 'alterna'); ?></label> 
		</p>
         <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'recent_title' )); ?>"><?php _e( 'Recent Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_title' )); ?>" type="text" value="<?php echo esc_attr( $recent_title ); ?>" />
		</p>
		<p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_num' )); ?>"><?php _e( 'Recent Items number' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_num' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_num' )); ?>" value="<?php echo esc_attr( $show_num ); ?>" type="number">
		</p>
        <?php
	}
}


/**
 * Portfolio Custom Items Widget
 */
class alternaPortfolioCustomItemsWidget extends WP_Widget {

	function alternaPortfolioCustomItemsWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Portfolio Custom Items','alterna'), array( 'description' => __( 'Alterna portfolio custom show items! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$show_style = apply_filters('widget_title', $instance['show_style'] );
		$show_ids = apply_filters('widget_title', $instance['show_ids'] );
		
		$show_num = count(explode(",",$show_ids));
		
		echo $before_widget;
		
		if ( $title ) {
		    echo $before_title . $title . $after_title;
		}
		echo '<div class="widget-alterna-recent-portfolios">'.alterna_get_portfolio_recent_post('featured',$show_num, (intval($show_style) + 1),$show_ids).'</div>';
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_style'] = strip_tags($new_instance['show_style']);
		$instance['show_ids'] = strip_tags($new_instance['show_ids']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['title']) ){
			$title = $instance['title'];
		}else{
			$title = __('Featured Items','alterna');
		}
		if( isset($instance['show_style']) ){
			$show_style = $instance['show_style'];
		}else{
			$show_style = 0;
		}
		if( isset($instance['show_ids']) ){
			$show_ids = $instance['show_ids'];
		}else{
			$show_ids = '';
		}
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'show_ids' )); ?>"><?php _e( 'IDs:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_ids' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_ids' )); ?>" type="text" value="<?php echo esc_attr( $show_ids ); ?>" placeholder="1,2,3" />
		</p>
        
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>"><?php _e( 'Show Style:' , 'alterna'); ?></label> 
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_style' )); ?>" type="text">
            <option value="0" <?php echo $show_style == 0 ? 'selected="selected"' : ''; ?>><?php _e( 'Icon Style' , 'alterna'); ?></option>
            <option value="1" <?php echo $show_style == 1 ? 'selected="selected"' : ''; ?>><?php _e( 'Thumbs Style' , 'alterna'); ?></option>
            <option value="2" <?php echo $show_style == 2 ? 'selected="selected"' : ''; ?>><?php _e( 'Big Thumbs Style' , 'alterna'); ?></option>
        </select>
        </p>
        <?php
	}
}

/**
 * Portfolio Recent Widget
 */
class alternaPortfolioRecentWidget extends WP_Widget {

	function alternaPortfolioRecentWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Portfolio Recent Items','alterna'), array( 'description' => __( 'Alterna portfolio recent items! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$show_style = apply_filters('widget_title', $instance['show_style'] );
		$show_num = apply_filters('widget_title', $instance['show_num'] );
		$show_rand = apply_filters('widget_title', $instance['show_rand'] );
		
		echo $before_widget;
		
		if ( $title ) {
		    echo $before_title . $title . $after_title;
		}
		echo '<div class="widget-alterna-recent-portfolios">'.alterna_get_portfolio_recent_post('recent',$show_num, (intval($show_style) + 1),'',$show_rand).'</div>';
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_style'] = strip_tags($new_instance['show_style']);
		$instance['show_num'] = strip_tags($new_instance['show_num']);
		$instance['show_rand'] = strip_tags($new_instance['show_rand']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['title']) ){
			$title = $instance['title'];
		}else{
			$title = __('Recent Items','alterna');
		}
		if( isset($instance['show_style']) ){
			$show_style = $instance['show_style'];
		}else{
			$show_style = 0;
		}
		if( isset($instance['show_num']) ){
			$show_num = $instance['show_num'];
		}else{
			$show_num = 5;
		}
		if( isset($instance['show_rand']) ){
			$show_rand = $instance['show_rand'];
		}else{
			$show_rand = '';
		}
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>"><?php _e( 'Show Style:' , 'alterna'); ?></label> 
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_style' )); ?>" type="text">
            <option value="0" <?php echo $show_style == 0 ? 'selected="selected"' : ''; ?>><?php _e( 'Icon Style' , 'alterna'); ?></option>
            <option value="1" <?php echo $show_style == 1 ? 'selected="selected"' : ''; ?>><?php _e( 'Thumbs Style' , 'alterna'); ?></option>
            <option value="2" <?php echo $show_style == 2 ? 'selected="selected"' : ''; ?>><?php _e( 'Big Thumbs Style' , 'alterna'); ?></option>
        </select>
        </p>
       	<p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_num' )); ?>"><?php _e( 'Recent Items number' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_num' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_num' )); ?>" value="<?php echo esc_attr( $show_num ); ?>" type="number">
		</p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_rand' )); ?>"><input id="<?php echo esc_attr($this->get_field_id( 'show_rand' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_rand' )); ?>" type="checkbox" <?php checked('yes' , $show_rand); ?>  value="yes" /><?php _e( 'Click show random posts' , 'alterna'); ?></label> 
		</p>
        <?php
	}
}

/**
 * Portfolio Category Widget
 */
class alternaPortfolioCategoryWidget extends WP_Widget {

	function alternaPortfolioCategoryWidget() {
		// Instantiate the parent object
		parent::__construct( false, __('Alterna Portfolio Category','alterna'), array( 'description' => __( 'Alterna portfolio categories! ', 'alterna' )));
	}

	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$show_count = apply_filters('widget_title', $instance['show_count'] );
		
		echo $before_widget;
		
		if ( $title ) {
		    echo $before_title . $title . $after_title;
		}
		echo alterna_get_portfolio_categories($show_count == "yes");
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_count'] = strip_tags($new_instance['show_count']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		if( isset($instance['title']) ){
			$title = $instance['title'];
		}else{
			$title = __('Categories','alterna');
		}
		if( isset($instance['show_count']) ){
			$show_count = $instance['show_count'];
		}else{
			$show_count = '';
		}
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' , 'alterna'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
       <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'show_count' )); ?>"><input id="<?php echo esc_attr($this->get_field_id( 'show_count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_count' )); ?>" type="checkbox" <?php checked('yes' , $show_count); ?>  value="yes" /><?php _e( 'Click show category item number' , 'alterna'); ?></label> 
		</p>
        <?php
	}
}