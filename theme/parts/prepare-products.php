<?php	
	global $btp_hide;		
	global $paged;	
	
	if(is_archive())
		$btp_hide = btp_get_product_archive_hidden_elements();
	else
		$btp_hide = btp_get_product_index_hidden_elements();
	

	/* Products template can be used by product category */
	if ( !is_archive( )) {
		
		/* Build array of query arguments. */			
		$query_args = array(
			'post_type'		=> 'btp_product',
			'paged'			=> $paged,
		);
		
		/* Products template can be used by page */
		$posts_per_page = (int) btp_get_theme_option('product_index_posts_per_page');
	
		if($posts_per_page > 0)
			$query_args['posts_per_page'] = (int)$posts_per_page;
			
		query_posts($query_args);
	}
	
	//global $query_string;
	//query_posts( $query_string . "&orderby=meta_value_num&meta_key=_btp_price&order=ASC" );
?>