<?php

/**
 * Builds pagination links  
 * 
 * @param int $range
 * @return string
 */
function btp_pagination( $range = 3 ) {	
	global $wp_query;
	
	$posts_per_page = absint( get_query_var( 'posts_per_page' ) );
	$paged 			= absint( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max_num_pages 	= absint( $wp_query->max_num_pages ) ? absint( $wp_query->max_num_pages ) : 1;	
	$request 		= $wp_query->request;
	$found_posts 	= $wp_query->found_posts;
		
	$max_num_links 	= 2 * $range + 1;
	$start_at		= 0;
	$end_at			= 0;		
	if ( $max_num_links >= $max_num_pages ) {
		$start_at	 = 1;
		$end_at	 	 = $max_num_pages;
	}
	else {
		/* Determine first page to display */
		$start_at = $paged - $range;
		if ( $start_at < 1 )
			$start_at = 1;
		
		/* Determine last page to display */
		$end_at		= $paged + $range;
		if ( $end_at > $max_num_pages )
			$end_at = $max_num_pages; 
	} 
	
	/* Compose output */
	$out = '';	
	if( $max_num_pages > 1 ) {
		$out .= '<p class="pagination"><strong>' . __( 'Pages:', 'btp_theme' ) . '</strong>';

			/* Previous Page Link */	
			$prev_page = $paged - 1;				
			if ( $prev_page >= 1 ) {
				$out .= '<a href="' . esc_url( get_pagenum_link( $prev_page ) ) . '" class="prev">';
					$out .= '<span>' . __( 'Prev', 'btp_theme' ) . '</span>';
				$out .= '</a>';
				
			}
			
			/* Page Links */				
			for ( $i = $start_at; $i <= $end_at; $i++ ) {
				$class = ( $i == $paged ) ? 'active' : 'tertiary';
				if ( $i != $paged )				
					$out .= '<a href="' . esc_url( get_pagenum_link( $i ) ) . '">';					
				
				$out .= '<span>' . $i . '</span>';
				
				if ( $i != $paged )
					$out .= '</a>';
			}					
			
			/* Next Page Link */	
			$next_page = $paged + 1;				
			if ( $next_page <= $max_num_pages ) {	
				$out .= '<a href="' . esc_url( get_pagenum_link( $next_page ) ) . '" class="next">';
					$out .= '<span>' . __( 'Next', 'btp_theme' ) . '</span>';
				$out .= '</a>';
			
			}
				
		$out .= '</p>';
	}	
		
	return $out;
	
}
?>