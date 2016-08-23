<?php 
	btp_before_the_loop(); // Save current context
	
	$btp_post_id = is_singular() ? $post->ID : (int) get_option( 'page_for_posts' );	
	
	$btp_query_args=array(
		'post_type'			=> 'btp_slide',
		'posts_per_page'	=> 15,
		'orderby'			=> 'menu_order',
		'order'				=> 'ASC'
	);

	/* Every page can display all slides or just from specific slide category */		
	$btp_slide_category = get_post_meta($btp_post_id, '_btp_slide_category', true);
		
	if ( strlen( $btp_slide_category ) ) {
		$btp_slide_category = absint( $btp_slide_category );
		
		$btp_slide_category = get_term_by('id', $btp_slide_category, 'btp_slide_category');		
		$btp_slide_category = $btp_slide_category->slug;
		$btp_query_args['btp_slide_category'] = $btp_slide_category;
	}	
	
	$slides_query = new WP_Query($btp_query_args);		
?>
	<div id="precontent">
		<div id="precontent-inner">
			
					<div id="slider" class="slider slider-dice slider-cycle">	
						<?php 
							btp_render_metadata( array_merge(
								btp_get_dice_slider_general_metadata(),
								btp_get_dice_slider_precontent_metadata(),
								array( 'embed' => true, 'description_min_width' => 967, 'description_text_max_width' => 500, 'width' => 967, 'height' => 400 )		
							)); 
						?>
						<div class="viewport">
							<?php if($slides_query->have_posts()): ?>						
							<ul class="slides">						
								<?php while($slides_query->have_posts()): $slides_query->the_post(); ?>
								<li>
									<div class="slide">
										<?php btp_render_metadata( array_merge( btp_get_dice_slide_metadata(), array('embed' => true ) ) ); ?>									
										<div class="slide-description"><?php the_title('<h3>', '</h3>'); ?><?php the_excerpt(); ?></div>
										<div class="slide-media slide-image">
										<?php											
											$asset_1 = get_post_meta($post->ID, '_btp_featured_asset_1', true);
											$linking = get_post_meta($post->ID, '_btp_linking', true);
											$linking = strlen( $asset_1 ) ? $linking : 'none';										
											
											$a_ = '';
											$_a = '</a>';
																						
											switch( $linking ) {												
												case 'none': 
													$_a = '';									
													break;
												case 'new-window':
												case 'new_window':
													$a_ .= '<a href="' . esc_attr( $asset_1 ) . '" class="new-window">';
													break;													
												default:
													$a_ .= '<a href="' . esc_attr( $asset_1 ) . '">';
													break;
											}
										
											echo $a_;
											
											if ( has_post_thumbnail() ) 
												the_post_thumbnail( 'c-12-wide' );
											else 
												btp_render_placeholder( 'c-12-wide' );	
											
											echo $_a;	
										?>
										</div>		
									</div>
								</li>
								<?php endwhile; ?>
							</ul>
							<?php endif; ?>	
						</div><!-- .viewport -->	
					</div><!-- .slider -->

			
		
		</div><!-- #precontent-inner -->
		<div class="background"><!-- --></div>	
	</div><!-- #precontent -->
	
<?php btp_after_the_loop(); // Restore original context ?>