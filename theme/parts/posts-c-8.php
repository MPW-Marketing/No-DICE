<?php
	$btp_hide = array();
	if ( is_archive() )
		$btp_hide = btp_get_post_archive_hidden_elements();	 	
	else
		$btp_hide = btp_get_post_index_hidden_elements();
?>

<ul class="collection-list-c-8 post-list-c-8">
	<?php while(have_posts()): the_post(); ?>
		<li>
			<div class="pid-<?php the_ID(); ?>">
			
			<?php if ( !isset($btp_hide['title']) ) btp_the_post_title( '<h2>', '</h2>' ); ?>
			
			<?php if ( !isset($btp_hide['date']) || !isset($btp_hide['author']) || !isset($btp_hide['comments_link']) ): ?>
			<p class="meta entry-meta">					
				<?php 
					if ( !isset($btp_hide['date']) ) { btp_the_post_date(); }
					if ( !isset($btp_hide['author']) ) { btp_the_post_author(); }
					if ( !isset($btp_hide['comments_link']) ) { btp_the_post_comments_link(); }
				?>
			</p>
			<?php endif; ?>
			
			<?php if ( !isset($btp_hide['thumb']) ) { btp_the_post_thumb('post-thumbnail', false); } ?>
			
			<?php if ( !isset($btp_hide['summary']) ) { btp_the_post_summary();} ?>
			
			<?php if ( !isset($btp_hide['categories']) || !isset($btp_hide['tags']) ): ?>
			<div class="meta entry-terms">					
				<?php
				
					if ( !isset($btp_hide['categories']) ) { btp_the_post_categories(); }
					if ( !isset($btp_hide['tags']) ) { btp_the_post_tags(); }
				?>
			</div>
			<?php endif; ?>
			
			<?php if ( !isset($btp_hide['button_1']) ): ?>
            <p class="entry-buttons">
	          	<?php btp_the_post_primary_button(); ?>
	        </p>
	        <?php endif; ?>
		</div>	
	</li>		
	<?php endwhile; ?>	
</ul><!-- END: .collection-list-c-8 -->

<?php echo btp_pagination(); ?>