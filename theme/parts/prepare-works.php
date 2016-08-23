<?php
	global $btp_hide;		
	global $paged;
	
	$btp_hide = array();
	if(is_archive())
		$btp_hide = btp_get_work_archive_hidden_elements();
	else
		$btp_hide = btp_get_work_index_hidden_elements();

	
	if ( !is_archive() ) {
		/* Build array of query arguments. */			
		$query_args = array(		
			'post_type'		=> 'btp_work',
			'paged'			=> $paged
		);
		
		$posts_per_page = (int) btp_get_theme_option('work_index_posts_per_page');
	
		if($posts_per_page > 0)
			$query_args['posts_per_page'] = (int)$posts_per_page;
			
		query_posts($query_args);	
	}
?>