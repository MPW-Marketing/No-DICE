<?php
global 	$post,
		$btp_query,
		$btp_hide, 				// hidden elements
		$btp_lightbox_group;
		
/* Normalize variables */		
$btp_query = ( $btp_query === null ) ? $wp_query : $btp_query;
$btp_lightbox_group = empty($btp_lightbox_group) ? '' : '['.$btp_lightbox_group.']' ;

$css_class = '';
$css_class .= 'collection-list-c-4 works-list-c-4';
$css_class .= !isset($btp_hide['thumb']) ? '' : ' no-thumb';	
?>
<ul class="<?php echo $css_class; ?>">
	<?php while ($btp_query->have_posts()): $btp_query->the_post(); ?>
		<li>    	            
            <div class="pid-<?php the_ID(); ?> grid">
            	
				<?php if( !isset($btp_hide['thumb']) ): ?>
				<div class="c-4">					     	    
        	       <?php btp_the_work_thumb('c-4'); ?>
				</div>
				<?php endif; ?>				
				
				<div class="c-x">				
					<?php if ( !isset($btp_hide['title']) ) { btp_the_work_title(); } ?>
					
                	<?php if ( !isset($btp_hide['date']) || !isset($btp_hide['comments_link']) ): ?>
					<p class="meta entry-meta">					
						<?php 
							if ( !isset($btp_hide['date']) ) { btp_the_work_date(); }
							if ( !isset($btp_hide['comments_link']) ) { btp_the_work_comments_link(); }
						?>
					</p>
					<?php endif; ?>
					
					<?php if ( !isset($btp_hide['summary']) ) { btp_the_work_summary();} ?>
					
					<?php if ( !isset($btp_hide['categories']) || !isset($btp_hide['tags']) ): ?>
					<div class="meta entry-terms">					
						<?php 
							if ( !isset($btp_hide['categories']) ) { btp_the_work_categories(); }
							if ( !isset($btp_hide['tags']) ) { btp_the_work_tags(); }
						?>
					</div>
					<?php endif; ?>
	                
	                <?php  if ( !isset($btp_hide['button_1']) || !isset($btp_hide['button_2']) || !isset($btp_hide['button_3'])  ): ?>
	        	    <ul class="entry-buttons">						
	        	    	<li><?php  if ( !isset($btp_hide['button_1']) ) { btp_the_work_primary_button(); } ?></li>
						<li><?php  if ( !isset($btp_hide['button_2']) ) { btp_the_work_secondary_button(); } ?></li>
						<li><?php  if ( !isset($btp_hide['button_3']) ) { btp_the_work_tertiary_button(); } ?></li>
	        	    </ul>              
	        	    <?php endif; ?>
				
				</div><!-- .c-x -->				
			</div><!-- .pid-XX -->			
		</li>
	<?php endwhile; ?>			        
</ul>