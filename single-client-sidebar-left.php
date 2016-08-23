<?php get_header(); ?>
<?php if ( have_posts() ): the_post(); ?>
	<?php $btp_hide = btp_get_client_single_hidden_elements(); ?>

	<?php get_template_part( '/theme/parts/precontent' ); ?>

	<div id="content">
		<div id="content-inner">

			<?php get_template_part( '/theme/parts/content_header', 'clients' ); ?>
	
			<div class="bd">		
				<div class="grid">
				
					<div class="c-4 sidebar sidebar-before">
						<div class="helper1"><!--  --></div>
						<?php 
							$btp_sidebar = btp_get_first_active_sidebar(array(
								get_post_meta($post->ID, '_btp_sidebar_primary', true),
								btp_get_theme_option('client_single_sidebar_primary', true),
								'primary'
							));
							if($btp_sidebar) 
								dynamic_sidebar($btp_sidebar);
						?>	
						<div class="helper2"><!--  --></div>
					</div><!-- .sidebar -->
				
					<div class="c-8">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
														
							<?php 
								global $btp_part;
								$btp_part = array(
									'size'		=> 'post-thumbnail'
								);
								
								$btp_part['type'] = btp_get_theme_option('client_single_media_box');									
								if ( strlen(get_post_meta($post->ID, '_btp_media_box', true)) ) 
									$btp_part['type'] = get_post_meta($post->ID, '_btp_media_box', true);
								
								get_template_part( '/theme/parts/media_box' ); 
							?>
				
							<div class="entry-content clearfix">
								<?php the_content(); ?>							
							</div><!-- .entry-content -->
							
								
							<div class="entry-utility">
								<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
							</div><!-- .entry-utility -->
								
						</div><!-- #post-## -->
							
						<?php 
							btp_render_after_entry_sidebars( 
								'after-client-sidebars', 
								btp_get_theme_option('client_single_after_sidebars_c_8_layout'), 
								'after-client-'
							); 
						?>
										

						
					</div>
					
				</div><!-- .grid -->	
			</div><!-- .bd -->	
	
			<?php get_template_part( '/theme/parts/content_footer', 'clients' ); ?>
	
		</div><!-- #content-inner -->
		<div class="background"><!--  --></div>
	</div><!-- #content -->
	
<?php endif; ?>	
		
<?php get_footer(); ?>