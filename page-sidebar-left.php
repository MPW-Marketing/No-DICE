<?php /* Template Name: Page: Sidebar on Left */ ?>
<?php get_header(); ?>

<?php if ( have_posts() ): the_post(); ?>

	<?php get_template_part( '/theme/parts/precontent' ); ?>

	<div id="content">
		<div id="content-inner">
		
			<?php get_template_part( '/theme/parts/content_header' ); ?> 
	 
			<div class="bd"> 
				<div class="grid">		
					<div class="c-4 sidebar sidebar-before">
						<div class="helper1"><!-- --></div>
						<?php 
							$btp_sidebar = btp_get_first_active_sidebar(array(
							get_post_meta($post->ID, '_btp_sidebar_primary', true),
							'primary'
							)
						);
						if($btp_sidebar) 
							dynamic_sidebar($btp_sidebar);
						?>	
						<div class="helper2"><!-- --></div>
					</div>
					
					<div class="c-8">			
						<div class="entry-content">						
							<?php the_content(); ?>
						</div><!-- .entry-content -->
						
						<?php 
							$pagination_args = array(
								'before'		=> '<p class="pagination"><strong>'.__('Pages:').'</strong>',
								'after'			=> '</p>',
								'link_before'	=> '<span>',
								'link_after'	=> '</span>'	 
							);
							wp_link_pages($pagination_args);
						?>
						
						<div class="entry-utility">		
							<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-utility -->
						

					</div>		
				</div>		
			</div><!-- .bd -->	
			
			<?php get_template_part( '/theme/parts/content_footer' ); ?>
	
		</div><!-- #content-inner -->
		<div class="background"><!--  --></div>
	</div><!-- #content -->

<?php endif; ?>

<?php get_footer(); ?>