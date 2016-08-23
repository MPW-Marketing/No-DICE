<?php

	/**
	 * Gets slide categories as an associative array (id => name)
	 * 
	 * @return array
 	*/
	function btp_get_pages_mapping() {
		$options = array();
		$pages = get_pages( 'post_type=page' );    	
    	foreach( $pages as $page )
    		$options[$page->ID] = apply_filters( 'the_title', $page->post_title );

    	return $options;
	}
	
	
	
	/**
	 * Gets sidebars as an associative array (id => name)
	 * 
	 * @return array
 	*/	
	function btp_get_sidebars_mapping() {
		global $wp_registered_sidebars;
		
    	$options = array();
    	foreach ( $wp_registered_sidebars as $x )
    		$options[$x['id']] = $x['name'];

    	return $options;	
	}
	
	
	
	/** 
	 * Converts a string that represents columns layout to an array.
	 * 
	 * @param string $v
	 * @return array
	 */
	function btp_get_columns_layout( $v ) {	
		$layout = array();		
		
		$grids = explode( '_', trim( $v ) );
		
		foreach ( $grids as $grid ) {
			$temp = array();
			foreach ( explode( ',', trim( $grid ) ) as $x ) {
				$x = absint( trim( $x ) );
				if ( $x > 0 )
					$temp[] = $x;
			}
			
			if ( count( $temp ) )
				$layout[] = $temp;
		}
				
		return $layout;
	}
	
	
	
	/**
	 * Gets first active sidebar from the passed array.
	 * 
	 * @param array $sidebars
	 * @return mixed
	 */
	function btp_get_first_active_sidebar( $sidebars = array() ) {
		foreach ( $sidebars as $s ) {
			if ( is_active_sidebar( $s ) )
				return $s;
		}	

		return false;
	}

	

	/**
	 * Saves current context before using custom WP loop.
	 */
	function btp_before_the_loop() {
		global $post;
		global $btp_temp_post;
		$btp_temp_post = null;
				
		/* Save current post object for further operations */
		$btp_temp_post = $post ? clone $post : $post;		
	}
	
	
	
	/**
	 * Restores original context after using custom WP loop.
	 */
	function btp_after_the_loop() {
		global $post;
		global $btp_temp_post;		
		
		/* Back to current post */
		$post = $btp_temp_post? clone $btp_temp_post : $btp_temp_post;
		if ( $post )
			setup_postdata( $post );
			
		unset( $btp_temp_post );	
	}
	
	
	
	/**
	 * Gets theme option from the options database table.
	 *  
	 * @param string $option_name
	 * @param mixed $default
	 * @return mixed
	 */	
	function btp_get_theme_option( $option_name, $default = false ) {
		global $btp_theme_options, $btp_theme_slug;
		
		$option_id = $btp_theme_slug . '_' . $option_name;
				
		
		/* CUSTOMIZE_MODE shouldn't be on in production environment.
		 * This is only for theme presentation purposes */
		if ( BTP_CUSTOMIZE_MODE  
		&& isset( $btp_theme_options[$option_id]) 
		&& isset( $btp_theme_options[$option_id]['customize'] ) 
		&& $btp_theme_options[$option_id]['customize'] == true )
		{	
			/* Try to return value from GET request and save it in session variable */
			if ( isset( $_GET[$option_id] ) ) {			
				$_SESSION[$option_id] = $_GET[$option_id];
				return $_GET[$option_id];
			}	
			
			/* Try to return value from session */
			if ( isset( $_SESSION[$option_id] ) ) {
				return $_SESSION[$option_id];			
			}
		}
		
		return get_option( $option_id, $default );
	}
	
	
	
	/**
	 * Deletes theme option from the options database table. 
	 * 
	 * @param string $option_name
	 * @return bool 
	 */	
	function btp_delete_theme_option( $option_name ) {
		global $btp_theme_slug;
		
		$option_id = $btp_theme_slug . '_' . $options_name;
		return delete_option( $option_id );
	}
	
	
	
	/**
	 * Gets term_taxonomy option from the options database table.
	 * 
	 * @param int $tt_id
	 * @param string $option_name
	 * @param mixed $default
	 * @return mixed
	 */	
	function btp_get_tt_option( $tt_id, $option_name, $default = null ) {
		global $btp_theme_slug;
		
		$option_id = $btp_theme_slug . '_tt_' . intval( $tt_id ) . '_' . $option_name;
		return get_option( $option_id, $default );
	}
	
	
	/**
	 * Deletes term_taxonomy option from the options database table. 
	 * 
	 * @param int $term_id
	 * @param string $option_name
	 * @return bool 
	 */	
	function btp_delete_tt_option( $tt_id, $option_name ) {
		global $btp_theme_slug;
		
		$option_id = $btp_theme_slug . '_tt_' . intval( $tt_id ) . '_' . $options_name;
		return delete_option( $option_id );
	}
	
	
	/**
	 * Converts string of coma separated names into an array of true bool values
	 * 
	 * @param string $string
	 * @return array
	 */ 
	function btp_string_to_bools( $string ) {
		$string = preg_replace( '/[^0-9a-zA-Z,_-]*/', '', $string );
		
		$results = array();
		$bools = explode( ',', $string );
				
		foreach ( $bools as $key => $value )
			$results[$value] = true; 
			
		return $results;
	}
	
	
	/** 
	 * Determines bool value 
	 * 
	 * @param mixed $value
	 * @return bool
	 */
	function btp_bool( $value ) {
		if( empty( $value ) || $value === 'false' || $value === 'off' || $value === 'no' )
			return false;
		
		return true;	 	
	}
	
	
	/**
	 * Checks if passed value is null 
	 * 
	 * @param $value
	 * @return true
	 */
	function btp_is_null( $value ) {
		if ( $value === null || $value === 'null' )
			return true;
			
		return false;	
	}
	
	
?>