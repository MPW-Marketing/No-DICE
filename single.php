<?php get_header(); ?>
<?php if ( have_posts() ): the_post(); ?>
<?php
	$btp_hide = array(
		'date'			=> btp_bool(btp_get_theme_option('posts_single_hide_date')),
		'author'		=> btp_bool(btp_get_theme_option('posts_single_hide_author')),
		'comments_link' => btp_bool(btp_get_theme_option('posts_single_hide_comments_link')),
		'categories'	=> btp_bool(btp_get_theme_option('posts_single_hide_categories')),
		'tags'			=> btp_bool(btp_get_theme_option('posts_single_hide_tags'))	
	);
	
	$btp_hide = array_filter($btp_hide);
?>	

	<?php get_template_part( '/theme/parts/precontent' ); ?>

	<div id="content">
		<div id="content-inner">

			<?php get_template_part( '/theme/parts/content_header', 'posts' ); ?>
	
			<div class="bd">		
				<div class="grid">
					<div class="c-8">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
														
							<?php if( !isset($btp_hide['date']) || !isset($btp_hide['author']) || !isset($btp_hide['comments_link'])): ?>
							<p class="meta">
								<?php if ( !isset($btp_hide['date'])) { btp_the_post_date(); } ?>
								<?php if ( !isset($btp_hide['author'])) { btp_the_post_author(); } ?>
								<?php if ( !isset($btp_hide['comments_link'])) { btp_the_post_comments_link(); } ?>
							</p>
							<?php endif; ?>			
														
							<?php if(has_post_thumbnail()): ?>
							<p class="featured-asset">
								<span class="frame">
									<span class="frame-inner">
										<?php the_post_thumbnail(); ?>
									</span>
								</span>
							</p>		
							<?php endif; ?>
				
							<div class="entry-content clearfix">
								<?php the_content(); ?>							
							</div><!-- .entry-content -->
									
							<?php if ( !isset($btp_hide['categories']) || !isset($btp_hide['tags']) ): ?>
								<div class="meta item-terms">					
								<?php 
									if ( !isset($btp_hide['categories']) ) { btp_the_post_categories(); }
									if ( !isset($btp_hide['tags']) ) { btp_the_post_tags(); }
								?>
							</div>
							<?php endif; ?>	
								
							<div class="entry-utility">		
								<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
							</div><!-- .entry-utility -->
								
						</div><!-- #post-## -->
							
							
						<?php 
							btp_render_after_post_widgets( 
									'after-post-widgets', 
									btp_get_theme_option('blog_single_after_sidebar_layout'), 
									'after-post-'); 
						?> 
										
						<?php comments_template( '', true ); ?>		
						
					</div>
					
					<div class="c-4 sidebar sidebar-after">
						<div class="helper1"><!--  --></div>
						<?php 
							$btp_sidebar = btp_get_first_active_sidebar(array(
								get_post_meta($post->ID, '_btp_sidebar_primary', true),
								btp_get_theme_option('posts_single_sidebar_primary', true),
								'primary'
							));
							if($btp_sidebar) 
								dynamic_sidebar($btp_sidebar);
						?>	
						<div class="helper2"><!--  --></div>
					</div><!-- .sidebar -->
					
				</div><!-- .grid -->	
			</div><!-- .bd -->	
	
			<?php get_template_part( '/theme/parts/content_footer', 'posts' ); ?>
	
		</div><!-- #content-inner -->
		<div class="background"><!--  --></div>
	</div><!-- #content -->
	
<?php endif; ?>	
		
<?php get_footer(); ?>