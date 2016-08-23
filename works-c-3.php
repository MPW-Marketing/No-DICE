<?php /* Template Name: Works: c-3 */ ?>
<?php get_header(); ?>	

	<div id="content">
		<div id="content-inner">	

			<?php get_template_part( '/theme/parts/content_header', 'works' ); ?>
	
			<div class="bd">
			
			<?php get_template_part('/theme/parts/prepare', 'works' ); ?>		
	
			<?php if(have_posts()): ?>		
				<?php get_template_part( '/theme/parts/works', 'c-3' ); ?>
				<?php echo btp_pagination(); ?>
			<?php else: ?>
				<div class="entry-content">
					<p class="no-results"><?php _e( 'No results found.', 'btp_theme' ); ?></p>	
				</div><!-- .entry-content -->	
        	<?php endif; ?>        

			</div><!-- .bd -->

			<?php get_template_part( '/theme/parts/content_footer', 'works' ); ?>
	
		</div><!-- #content-inner -->
		<div class="background"><!--  --></div>
	</div><!-- #content -->
	
<?php get_footer(); ?>