<?php get_header(); ?>

	<div id="content">
		<div id="content-inner">

			<div class="hd">	
				<?php if(btp_bool(btp_get_theme_option('general_breadcrumbs_enable', true))):?>
					<?php btp_render_breadcrumbs(); ?>
				<?php endif; ?>
						
				<h1 class="page-title"><?php _e('Search results', 'btp_theme'); ?></h1>
				<p class="page-intro"><?php printf( __('Query: %s', 'btp_theme'), esc_html( get_search_query() ) ); ?></p>
			</div>
			
			<div class="bd">	
				<div class="grid">
					<div class="c-8">
						<?php if ( have_posts() ) : ?>
							<ul class="search-results">								
							<?php while( have_posts() ): the_post(); ?>
								<li>
									<p class="meta search-meta">
										<?php 
											$obj = get_post_type_object(get_post_type()); 
											print $obj->labels->singular_name;
										?>
									</p>
									<h3 class="search-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr(__('Permalink to %s', 'btp_theme') ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
									<div class="search-summary">
										<?php the_excerpt(); ?>
									</div>
								</li>
							<?php endwhile; ?>
							</ul>
						<?php else: ?>
							<p class="no-results"><?php _e( 'No results found.', 'btp_theme' ); ?></p>				
						<?php endif; ?>
					</div>
		
					<div class="c-4 sidebar sidebar-after">
						<div class="helper1"><!-- --></div>
						<?php if(is_active_sidebar( 'primary' )): ?>
							<?php dynamic_sidebar( 'primary' ); ?>
						<?php endif; ?>	
						<div class="helper2"><!-- --></div>
					</div>
		
				</div>
			</div><!-- .bd -->
			
			<?php get_template_part( '/theme/parts/content_footer' );?>
		
		</div><!-- #content-inner -->
		<div class="background"><!--  --></div>
	</div><!-- #content -->	

<?php get_footer(); ?>