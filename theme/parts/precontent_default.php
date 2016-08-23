<?php	
	$btp_precontent = btp_get_the_precontent();
?>	
<?php if ( !empty( $btp_precontent ) ): ?>	
	<div id="precontent">
		<div id="precontent-inner" class="clearfix">
				
			<?php echo $btp_precontent; ?>			
		
		</div><!-- #precontent-inner -->
		<div class="background"><!-- --></div>
	</div><!-- #precontent -->
<?php endif; ?>