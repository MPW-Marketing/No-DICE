<?php get_header(); ?>

<?php if ( have_posts() ): the_post(); ?>
	<?php $btp_hide = btp_get_product_single_hidden_elements(); ?>

	<?php get_template_part( '/theme/parts/precontent' ); ?>

	<div id="content">
		<div id="content-inner">
			<?php get_template_part( '/theme/parts/content_header', 'products' ); ?>
		
			<div class="bd">	
			
				<?php 
					global $btp_part;
					$btp_part = array(
						'size'		=> 'c-12'
					);
					
					$btp_part['type'] = btp_get_theme_option('product_single_media_box');									
					if ( strlen(get_post_meta($post->ID, '_btp_media_box', true)) ) 
						$btp_part['type'] = get_post_meta($post->ID, '_btp_media_box', true);
					
					get_template_part( '/theme/parts/media_box' ); 
				?>
				<div class="grid">
					<div class="c-8">
						<div class="entry-content">
							<?php the_content(); ?>				
						</div><!-- .entry-content -->
					</div>
					<div class="c-4">
					
						<?php if ( !isset($btp_hide['price']) ): ?>
						<p>
							<?php echo do_shortcode('[price]'); ?>
						</p>
						<?php endif; ?>
				
						<ul class="entry-buttons vertical">
							<li><?php  if ( !isset($btp_hide['button_2']) ) { btp_the_product_secondary_button('primary', 'big', true); } ?></li>
							<li><?php  if ( !isset($btp_hide['button_3']) ) { btp_the_product_tertiary_button('secondary', 'big', true); } ?></li>
						</ul>
						
						
						<?php if ( !isset($btp_hide['comments_link']) ): ?>
						<p class="meta entry-meta">					
							<?php btp_the_product_comments_link(); ?>
						</p>
						<?php endif; ?>
								
						<?php if ( !isset($btp_hide['categories']) || !isset($btp_hide['tags']) ): ?>
						<div class="meta entry-terms">					
							<?php 
								if ( !isset($btp_hide['categories']) ) { btp_the_product_categories(); }
								if ( !isset($btp_hide['tags']) ) { btp_the_product_tags(); }
							?>
						</div>
						<?php endif; ?>
						
					</div>
				</div>
	
				<div class="entry-utility">		
					<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-utility -->
				
				<?php 
					btp_render_after_entry_sidebars( 
						'after-product-sidebars', 
						btp_get_theme_option('product_single_after_sidebars_c_12_layout'), 
						'after-product-full-'
					); 
				?>
			

				
			</div><!--  .bd -->
	
			<?php get_template_part( '/theme/parts/content_footer', 'products' ); ?>	
	
		</div><!-- #content-inner -->
		<div class="background"><!--  --></div>
	</div><!-- #content -->
	
<?php endif; ?>	
	
<?php get_footer(); ?>
