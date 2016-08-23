<?php global $post, $btp_part; ?>
<?php if( ( 'featured-asset' == $btp_part['type'] ) && btp_has_featured_asset()): ?>
	<div class="media-box">	
	<?php if ( has_post_thumbnail() ): ?>
		<?php
			$out = '';
			switch ( btp_asset_type( get_post_meta( $post->ID, '_btp_featured_asset_1', true ) ) ) {
				case 'image': // post thumbnail and lightboxed image					
					$out .= '<a href="'.get_post_meta( $post->ID, '_btp_featured_asset_1', true ).'" rel="prettyPhoto">';					
					$out .= '<span class="frame"><span class="frame-inner">';
					
					$p_t = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $btp_part['size']);					
					$out .= '<img src="'.$p_t[0].'" width="'.$p_t[1].'" height="'.$p_t[2].'" alt="" />';
															
					$out .= '<span class="indicator indicator-zoom"><span></span></span>';
					$out .= '</span></span>';
					$out .= '</a>';
					
					break;			
					
				case 'video':
					
					$out .= '<a href="'.get_post_meta( $post->ID, '_btp_featured_asset_1', true ).'" rel="prettyPhoto">';					
					$out .= '<span class="frame"><span class="frame-inner">';
					
					$p_t = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $btp_part['size']);					
					$out .= '<img src="'.$p_t[0].'" width="'.$p_t[1].'" height="'.$p_t[2].'" alt="" />';
															
					$out .= '<span class="indicator indicator-play"><span></span></span>';
					$out .= '</span></span>';
					$out .= '</a>';
					
					break;	
									
				case 'unknown':
					break;
					
				case false; // post thumbnail and lightboxed post_thumbnail
				
					$p_t = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
							
					$out .= '<a href="'.$p_t[0].'" rel="prettyPhoto">';
					$out .= '<span class="frame"><span class="frame-inner">';
					
					$p_t = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $btp_part['size']);
					$out .= '<img src="'.$p_t[0].'" width="'.$p_t[1].'" height="'.$p_t[2].'" alt="" />';
															
					$out .= '<span class="indicator indicator-zoom"><span></span></span>';
					$out .= '</span></span>';
					$out .= '</a>';	
					break;				
			}
			
			echo $out;
		?>
			
	<?php else: ?>
	
	<?php endif;?>		
	</div><!-- .media-box -->
<?php elseif( 'attachments-cycle' == $btp_part['type'] ): ?>
	<?php
		$args = array(
			'orderby' 			=> 'menu_order',
			'order'         	=> 'ASC',
			'post_type'      	=> 'attachment',
			'post_parent'    	=> $post->ID,
			'post_mime_type' 	=> 'image',
			'post_status'    	=> null,
			'numberposts'    	=> -1,
		);
		$attachments = get_posts($args);
	?>
	<?php if ( $attachments ) : ?>
	<div class="media-box">
	
		<div class="slider slider-cycle">
			<?php btp_render_metadata( btp_get_cycle_slider_general_metadata()); ?>
			<div class="viewport">
				<ul class="slides">
				<?php foreach ($attachments as $attachment): ?>
					<li>	
						<div class="slide">
							<div class="slide-media slide-image">				
								<?php echo wp_get_attachment_image($attachment->ID, $btp_part['size']); ?>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div><!-- .slider -->
		
	</div><!-- .media-box -->	
	<?php endif; ?>	
<?php endif; ?>