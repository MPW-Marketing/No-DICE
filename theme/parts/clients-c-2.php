<?php
global 	$post,
		$btp_query,		
		$btp_max_per_row,
		$btp_hide, 				// hidden elements
		$btp_lightbox_group;

/* Normalize variables */		
$btp_query = ( $btp_query === null ) ? $wp_query : $btp_query;
$btp_lightbox_group = empty($btp_lightbox_group) ? '' : '['.$btp_lightbox_group.']' ;
$btp_max_per_row = btp_normalize_max_per_row($btp_max_per_row, 6);

$i = 0;
?>
<?php while ($btp_query->have_posts()): $btp_query->the_post(); ?>
	<?php if( ($i % $btp_max_per_row) == 0): ?><div class="grid collection-c-2 clients-c-2"><?php endif; ?>	            
            <div class="c-2">    	            
            	<div class="pid-<?php the_ID(); ?>">            	
					<?php if ( !isset($btp_hide['thumb']) ) { btp_the_client_thumb('c-2'); } ?>
					<?php if ( !isset($btp_hide['title']) ) btp_the_client_title(); ?>
										
					<?php if ( !isset($btp_hide['summary']) ) { btp_the_client_summary();} ?>				
	                
	        	    <?php if ( !isset($btp_hide['button_1']) ): ?>
	                <ul class="entry-buttons">
	                	<li><?php btp_the_client_primary_button(); ?></li>
	                </ul>
	                <?php endif; ?>	 	    
				</div><!-- .pid-XX -->						
			</div>	
	<?php $i++; if( ($i % $btp_max_per_row) == 0): ?></div><?php endif; ?>
<?php endwhile; ?>			        
<?php if( $i % $btp_max_per_row != 0): ?></div><?php endif; ?>