<?php

	function btp_breadcrumbs_add_page_for_posts( $breadcrumbs = array() ) {
		/* If blogpage is not homepage, then blogpage is subpage of homepage :) */
		if ( get_option( 'show_on_front' ) != 'posts' ) {
			$id = (int) get_option( 'page_for_posts' );
			
			$breadcrumbs[] = array(
				'href'	=> get_permalink( $id ),
				'text'	=> get_the_title( $id )				
			);
		}		
		
		return $breadcrumbs;
	}
	
	function btp_breadcrumbs_add_page_for_works( $breadcrumbs = array() ) {
		$id = (int) btp_get_theme_option( 'work_index_page' );
		
		if ( $id ) {
			$breadcrumbs[] = array(
				'href'	=> get_permalink( $id ),
				'text'	=> get_the_title( $id )				
			);
		}		
		
		return $breadcrumbs;
	}
	
	function btp_breadcrumbs_add_page_for_products( $breadcrumbs = array() ) {
		$id = (int) btp_get_theme_option( 'product_index_page' );
		
		if ( $id ) {
			$breadcrumbs[] = array(
				'href'	=> get_permalink( $id ),
				'text'	=> get_the_title( $id )				
			);
		}		
		
		return $breadcrumbs;
	}
	
	function btp_breadcrumbs_add_page_for_clients( $breadcrumbs = array() ) {
		$id = (int) btp_get_theme_option( 'client_index_page' );
		
		if ( $id ) {
			$breadcrumbs[] = array(
				'href'	=> get_permalink( $id ),
				'text'	=> get_the_title( $id )				
			);
		}		
		
		return $breadcrumbs;
	}
	
	
	/**
	 * Gets breadcrumbs for the current context.
	 * 
	 * @return array 
	 */
	function btp_get_breadcrumbs() {
		global $post;
		
		$breadcrumbs = array();
		$breadcrumbs[] = array(
			'href'		=> get_option( 'siteurl' ),
			'text'		=> __( 'Home', 'btp_theme' )
		);
		
		if ( is_home() ) {
			$breadcrumbs = btp_breadcrumbs_add_page_for_posts( $breadcrumbs );
		}
		
				
		if (is_archive() ) {				
			switch( get_post_type() ) {
				case 'post':
					$breadcrumbs = btp_breadcrumbs_add_page_for_posts( $breadcrumbs );
					break;
				case 'btp_work':	
					$breadcrumbs = btp_breadcrumbs_add_page_for_works( $breadcrumbs );
					break;
				case 'btp_product':
					$breadcrumbs = btp_breadcrumbs_add_page_for_products( $breadcrumbs );
					break;
				case 'btp_client':
					$breadcrumbs = btp_breadcrumbs_add_page_for_clients( $breadcrumbs );
					break;
			}		
		}
		
		if ( is_tax( 'btp_work_category' ) ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), 'btp_work_category' );
		
			$breadcrumbs[] = array(
				'href'	=> '', //apply_filters('term_link', get_term_link( $term, 'btp_work_category' ) ),
				'text'	=> $term->name
			);	
		}
		
		if ( is_tax( 'btp_work_tag' ) ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), 'btp_work_tag' );
		
			$breadcrumbs[] = array(
				'href'	=> '', //apply_filters('term_link', get_term_link( $term, 'btp_work_tag' ) ),
				'text'	=> $term->name
			);	
		}
		
		if( is_tax( 'btp_product_category' ) ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), 'btp_product_category' );
		
			$breadcrumbs[] = array(
				'href'	=>'', //apply_filters('term_link', get_term_link($term, 'btp_product_category')),
				'text'	=> $term->name
			);	
		}
		
			if( is_tax( 'btp_product_tag' ) ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), 'btp_product_tag' );
		
			$breadcrumbs[] = array(
				'href'	=>'', //apply_filters('term_link', get_term_link($term, 'btp_product_tag')),
				'text'	=> $term->name
			);	
		}
			
		
		if ( is_category() ) {			
			global $wp_query;      		
      		$cat_obj = $wp_query->get_queried_object();      		
      		$thisCat = $cat_obj->term_id;      		
      		$thisCat = get_category($thisCat);      		
      		
      		$breadcrumbs[] = array(
      			'href' => '',
      			'text' => sprintf(__("Archives by category: %s", 'btp_theme'), single_cat_title('', false))
      		);
		}
 		
		if ( is_tag() ) {
      		$breadcrumbs[] = array(
      			'href' => '',
      			'text' => sprintf(__("Archives by tag: %s", 'btp_theme'), single_tag_title('', false))
      		);
		}
				
		if ( is_page() ) {
			if ( $post->post_parent ) {
      			$parent_id  = $post->post_parent;
      			$parent_breadcrumbs = array();
      			while ( $parent_id ) {
        			$page = get_page($parent_id);
        			$parent_breadcrumbs[] = array(
        				'href'	=> get_permalink( $page->ID ),
        				'text'	=> get_the_title( $page->ID )
      				);
        			$parent_id  = $page->post_parent;
      			}

      			$parent_breadcrumbs = array_reverse( $parent_breadcrumbs );
      			
      			$breadcrumbs = array_merge( $breadcrumbs, $parent_breadcrumbs );
			}
			
			$breadcrumbs[] = array(
				'href'	=>	get_permalink( $post->ID ),	
				'text'	=>	get_the_title( $post->ID )
			);
		}
		
		if ( is_single() && !is_attachment() ) {
			switch ( get_post_type() ) {
				case 'post':					
					$breadcrumbs = btp_breadcrumbs_add_page_for_posts( $breadcrumbs );
					break;
				case 'btp_work':
					$breadcrumbs = btp_breadcrumbs_add_page_for_works( $breadcrumbs );
					break;
				case 'btp_product':
					$breadcrumbs = btp_breadcrumbs_add_page_for_products( $breadcrumbs );
					break;
				case 'btp_client':
					$breadcrumbs = btp_breadcrumbs_add_page_for_clients( $breadcrumbs );
					break;
			}		
      		
      		$breadcrumbs[] = array(
				'href'	=>	get_permalink( $post->ID ),	
				'text'	=>	get_the_title( $post->ID )
			);
			
		}
		
		if ( is_day() ) { 
      		$breadcrumbs[] = array(
      			'href' => get_year_link( get_the_time( 'Y' ) ),
      			'text' => get_the_time( 'Y' )
      		);
      		
      		$breadcrumbs[] = array(
      			'href' => get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ),
      			'text' => get_the_time( 'F' )
      		);
      		
      		$breadcrumbs[] = array(
      			'href' => '',
      			'text' => get_the_time( 'd' )
      		);      		      		
		}
		
		if ( is_month() ) {
      		$breadcrumbs[] = array(
      			'href' => get_year_link( get_the_time( 'Y' ) ),
      			'text' => get_the_time( 'Y' )
      		);
      		
      		$breadcrumbs[] = array(
      			'href' => '',
      			'text' => get_the_time( 'F' )
      		);      	      		      		
		}
		
		if ( is_year() ) {
      		$breadcrumbs[] = array(
      			'href' => '',
      			'text' => get_the_time( 'Y' )
      		);      		      	      		      		
		}
	
		
		if ( is_search() ) { 
			$breadcrumbs[] = array(
				'href' => '',
				'text' => __( 'Search results', 'btp_theme' )
			);		 
		}

		if ( is_author() ) {
			
			$curauth = null;
			if ( get_query_var( 'author_name' ) )
				$curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );			
			
			if ( get_query_var( 'author' ) )
				$curauth = get_user_by( 'id', get_query_var( 'author' ) );
			
			$breadcrumbs[] = array(
				'href' => '',
				'text' => sprintf( __( 'Archives by author: %s', 'btp_theme' ), $curauth->display_name )
			);
		}
		
		if ( is_404() ) { 
			$breadcrumbs[] = array(
				'href' => '',
				'text' => __( '404 - page not found', 'btp_theme' )
			);	  
		}

		return $breadcrumbs;
				
	}
	

	/**
	 * Renders breadcrumb trail
	 * 
	 * @param array $breadcrumbs
	 * @param string $separator
	 * @param bool $echo
	 */
	function btp_render_breadcrumbs( $breadcrumbs = null, $separator = ' &rsaquo; ', $echo = true ) {
		if ( null === $breadcrumbs )
			$breadcrumbs = btp_get_breadcrumbs(); 

		/* Compose output */
		$out = '';	
		
		$counter = count( $breadcrumbs );
		if ( $counter ) {		
			$out .= '<p class="breadcrumbs meta">' . __( 'You are here: ', 'btp_theme' );
			
			for ( $i = 0; $i < $counter; $i++ ) {
				if ( $i == ( $counter - 1 ) )
					$out .= '<strong>' . $breadcrumbs[$i]['text'] . '</strong> ';
				else
					$out .= '<a href="' . $breadcrumbs[$i]['href'] . '">' . $breadcrumbs[$i]['text'] . '</a>' . $separator;
			}		
			$out .= '</p>';
		}
		
		if ( $echo )
			echo $out;
		else
			return $out;
			
	}
	
?>