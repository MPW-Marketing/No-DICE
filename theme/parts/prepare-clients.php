<?php
	global $btp_hide;
	global $paged;
	
	$btp_hide = btp_get_client_index_hidden_elements();
	
	/* Build array of query arguments. */			
	$query_args = array(		
		'post_type'		=> 'btp_client',
		'paged'			=> $paged
	);
	
	$posts_per_page = (int) btp_get_theme_option('client_index_posts_per_page');

	if($posts_per_page > 0)
		$query_args['posts_per_page'] = (int)$posts_per_page;
		
	query_posts($query_args);
?>