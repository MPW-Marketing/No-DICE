<?php /* Template Name: Page: Under Construction */ ?>
<?php get_header('under-construction'); ?>

<?php if ( have_posts() ):?>
	<?php the_post(); ?>

	<?php get_template_part( '/theme/parts/precontent' ); ?>

	<div id="content">
		<div id="content-inner">		
	
			<?php get_template_part( '/theme/parts/content_header' ); ?>
			
			<div class="bd">
			
				<div class="grid">
					<div class="c-12">
			
							<div class="entry-content">
								<?php the_content(); ?>
							</div><!-- .entry-content -->	
							
							<div class="entry-utility">		
								<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
							</div><!-- .entry-utility -->
							
							<?php comments_template( '', true ); ?>
					</div>
				</div>
				
				<?php 
					$pagination_args = array(
						'before'		=> '<p class="pagination"><strong>'.__('Pages:').'</strong>',
						'after'			=> '</p>',
						'link_before'	=> '<span>',
						'link_after'	=> '</span>'	 
					);
					wp_link_pages($pagination_args);
				?>			
				
			</div><!-- .bd -->
			
			<?php get_template_part( '/theme/parts/content_footer' ); ?>
			
		</div><!-- #content-inner -->
		<div class="background"><!--  --></div>
	</div><!-- #content -->

<?php endif; ?>

<?php get_footer('under-construction'); ?>