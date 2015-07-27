<script type='text/javascript'>
jQuery(document).ready(function($){	
	
	$('#wprpw_display_thumbnail').click(function() {
		if($(this).is(':checked')){
			$('#wprpw_display_thumbnail_show').show();
		}
		else
		{
			$('#wprpw_display_thumbnail_show').hide();
		}
	});
	
	$('#wprpw_display_title').click(function() {
		if($(this).is(':checked')){
			$('#wprpw_display_title_show').show();
		}
		else
		{
			$('#wprpw_display_title_show').hide();
		}
	});
	
	$('#wprpw_display_excerpt').click(function() {
		if($(this).is(':checked')){
			$('#wprpw_display_excerpt_show').show();
		}
		else
		{
			$('#wprpw_display_excerpt_show').hide();
		}
	});
	
	$('#wprpw_display_read_more_link').click(function() {
		if($(this).is(':checked')){
			$('#wprpw_display_readmore_show').show();
		}
		else
		{
			$('#wprpw_display_readmore_show').hide();
		}
	});
	
	$('#wprpw_display_publish_date').click(function() {
		if($(this).is(':checked')){
			$('#wprpw_display_date_show').show();
		}
		else
		{
			$('#wprpw_display_date_show').hide();
		}
	});
	
	$('#wprpw_display_publish_time').click(function() {
		if($(this).is(':checked')){
			$('#wprpw_display_time_show').show();
		}
		else
		{
			$('#wprpw_display_time_show').hide();
		}
	});
	
	$('#wprpw_display_author').click(function() {
		if($(this).is(':checked')){
			$('#wprpw_display_author_show').show();
		}
		else
		{
			$('#wprpw_display_author_show').hide();
		}
	});

});	

</script>
