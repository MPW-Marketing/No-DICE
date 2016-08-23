<?php get_header(); ?>

<?php if ( have_posts() ): the_post(); ?>
	<?php $btp_hide = btp_get_work_single_hidden_elements(); ?>

	<?php get_template_part( '/theme/parts/precontent' ); ?>

	<div id="content">
		<div id="content-inner">
	
			<?php get_template_part( '/theme/parts/content_header', 'works' ); ?>
			
			<div class="bd">		
				<div class="grid">
					<div class="c-8">
					
						<?php if ( !isset($btp_hide['date']) || !isset($btp_hide['comments_link']) ): ?>
						<p class="meta entry-meta">					
							<?php 
								if ( !isset($btp_hide['date']) ) { btp_the_work_date(); }
								if ( !isset($btp_hide['comments_link']) ) { btp_the_work_comments_link(); }
							?>
						</p>
						<?php endif; ?>	
					
						<?php 
							global $btp_part;
							$btp_part = array(
								'size'		=> 'post-thumbnail'
							);
							
							$btp_part['type'] = btp_get_theme_option('work_single_media_box');									
							if ( strlen(get_post_meta($post->ID, '_btp_media_box', true)) ) 
								$btp_part['type'] = get_post_meta($post->ID, '_btp_media_box', true);
							
							get_template_part( '/theme/parts/media_box' ); 
						?>
						
						<ul class="entry-buttons">
							<li><?php  if ( !isset($btp_hide['button_2']) ) { btp_the_work_secondary_button('primary', 'medium'); } ?></li>
							<li><?php  if ( !isset($btp_hide['button_3']) ) { btp_the_work_tertiary_button('secondary', 'medium'); } ?></li>
						</ul>
				
						<div class="entry-content">
							<?php the_content(); ?>						
						</div><!-- .entry-content -->
						
						<?php if ( !isset($btp_hide['categories']) || !isset($btp_hide['tags']) ): ?>
						<div class="meta entry-terms">					
							<?php 
								if ( !isset($btp_hide['categories']) ) { btp_the_work_categories(); }
								if ( !isset($btp_hide['tags']) ) { btp_the_work_tags(); }
							?>
						</div>
						<?php endif; ?>
			
						<div class="entry-utility">		
							<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-utility -->
						
						<?php 
							btp_render_after_entry_sidebars( 
								'after-work-sidebars', 
								btp_get_theme_option('work_single_after_sidebars_c_8_layout'), 
								'after-work-'
							); 
						?>
											

					</div>	
					
					<div class="c-4 sidebar sidebar-after">
						<div class="helper1"><!-- --></div>
						<?php 
							$btp_sidebar = btp_get_first_active_sidebar(array(
								get_post_meta($post->ID, '_btp_sidebar_primary', true),
								btp_get_theme_option('work_single_sidebar_primary'),
								'primary'
								)
							);
							if($btp_sidebar) 
								dynamic_sidebar($btp_sidebar);
						?>
						<div class="helper2"><!-- --></div>		
					</div><!-- .sidebar -->				
				</div>
				
			</div><!-- .bd -->	
			
			<?php get_template_part( '/theme/parts/content_footer', 'works' ); ?>	
	
		</div><!-- #content-inner -->
		<div class="background"><!--  --></div>
	</div><!-- #content -->

<?php endif; ?>	
	
<?php get_footer(); ?>