<?php
global	$post, 	
		$btp_query,
		$btp_hide, 				// hidden elements
		$btp_lightbox_group;
		
/* Normalize variables */		
$btp_query = ( $btp_query === null ) ? $wp_query : $btp_query;
$btp_lightbox_group = empty($btp_lightbox_group) ? '' : '['.$btp_lightbox_group.']' ;

$css_class = '';
$css_class .= 'collection-list-c-1 posts-list-c-1';
$css_class .= !isset($btp_hide['thumb']) ? '' : ' no-thumb';	
?>
<ul class="<?php echo $css_class; ?>">
	<?php while ($btp_query->have_posts()): $btp_query->the_post(); ?>		 
		<li>
            <div class="pid-<?php the_ID(); ?>">
            
            	<?php if ( !isset($btp_hide['thumb']) ) { btp_the_post_thumb('c-1'); } ?>
				<?php if ( !isset($btp_hide['title']) ) { btp_the_post_title(); } ?>
				
               <?php if ( !isset($btp_hide['date']) || !isset($btp_hide['author']) || !isset($btp_hide['comments_link']) ): ?>
				<p class="meta entry-meta">					
					<?php 
						if ( !isset($btp_hide['date']) ) { btp_the_post_date(); }
						if ( !isset($btp_hide['author']) ) { btp_the_post_author(); }
						if ( !isset($btp_hide['comments_link']) ) { btp_the_post_comments_link(); }
					?>
				</p>
				<?php endif; ?>
				
				<?php if ( !isset($btp_hide['summary']) ) { btp_the_post_summary();} ?>
				
				<?php if ( !isset($btp_hide['categories']) || !isset($btp_hide['tags']) ): ?>
				<div class="meta entry-terms">					
					<?php
					
						if ( !isset($btp_hide['categories']) ) { btp_the_post_categories(); }
						if ( !isset($btp_hide['tags']) ) { btp_the_post_tags(); }
					?>
				</div>
				<?php endif; ?>
                
        	    <?php if ( !isset($btp_hide['button_1']) ): ?>
                <ul class="entry-buttons">
                	<li><?php btp_the_post_primary_button(); ?></li>
                </ul>
                <?php endif; ?>	
                		
			</div><!-- END: .pid-XX -->	
		</li>
	<?php endwhile; ?>
</ul>