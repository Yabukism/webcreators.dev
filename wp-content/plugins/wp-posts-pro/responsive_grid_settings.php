<?php
?>
<style>
.divider{
border-bottom:2px dashed #999;";
padding-bottom: 15px;	
}
#dynamicselectbox{
padding-bottom: 20px;	
}
.div_top
{
	border-top:2px dashed #999;padding-top: 15px;
}	
</style> 
<div class="wrap">
	
	<div class="section group">
	<h2><?php _e('Responsive Grid Settings','wpp_text');?></h2>
	<p><?php _e('Please select the layout from dropdown below to see how content will look like in the columns.','wpp_text');?></p>
	</div>
	<form method="post" action="" id="grid_setting_form" name="grid_setting_form">
	<table style="width:100%;" class="grid_table">
	<tbody>
	<tr valign="top"><td id="dynamicselectbox"></td></tr>
	</tbody>
	</table>			
	</form>			
	
	<div class="darkcontainer " id="example">
			<div class="maincontent">
				

				<div class="section group div_top">
				<h3><?php _e('Two Columns','wpp_text');?></h3>
				</div>

				<div class="section group divider">
					<div class="col span_1_of_2">
					&nbsp;	
					</div>
					<div class="col span_1_of_2">
					&nbsp;
					</div>
				</div>
				
				<div class="section group">
				<h3><?php _e('Three Columns','wpp_text');?></h3>
				</div>

				<div class="section group divider">
					<div class="col span_1_of_3">
					&nbsp;
					</div>
					<div class="col span_1_of_3">
					&nbsp;
					</div>
					<div class="col span_1_of_3">
				    &nbsp;
					</div>
				</div>

				<div class="section group">
				<h3><?php _e('Four Columns','wpp_text');?></h3>
				</div>

				<div class="section group divider">
					<div class="col span_1_of_4">
					&nbsp;
					</div>
					<div class="col span_1_of_4">
					&nbsp;
					</div>
					<div class="col span_1_of_4">
					&nbsp;
					</div>
					<div class="col span_1_of_4">
					&nbsp;
					</div>
				</div>

				<div class="section group">
				<h3><?php _e('Five Columns','wpp_text');?></h3>
				</div>

				<div class="section group divider">
					<div class="col span_1_of_5">
					&nbsp;
					</div>
					<div class="col span_1_of_5">
					&nbsp;
					</div>
					<div class="col span_1_of_5">
					&nbsp;
					</div>
					<div class="col span_1_of_5">
				    &nbsp;
					</div>
					<div class="col span_1_of_5">
					&nbsp;
					</div>
				</div>

				<div class="section group">
				<h3><?php _e('Six Columns','wpp_text');?></h3>
				</div>

				<div class="section group divider">
					<div class="col span_1_of_6">
					&nbsp;
					</div>
					<div class="col span_1_of_6">
					&nbsp;
					</div>
					<div class="col span_1_of_6">
					&nbsp;
					</div>
					<div class="col span_1_of_6">
					&nbsp;
					</div>
					<div class="col span_1_of_6">
					&nbsp;
					</div>
					<div class="col span_1_of_6">
					&nbsp;
					</div>
				</div>

				
			</div>
		</div>

</div>
