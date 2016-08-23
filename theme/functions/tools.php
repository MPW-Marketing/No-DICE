<?php

/**
 * Registers Custom Navigation Locations 
 */
function btp_register_theme_nav_menus() {
	register_nav_menus(
		array(
			'primary_nav' 			=> __( 'Primary Navigation', 'btp_theme' ),
			'footer_nav'			=> __( 'Footer Navigation', 'btp_theme' ),
		)		
	);
}



/**
 * Adds custom taxonomy - btp_relation_tag (Relation Tags)
 */
function btp_init_relation_tag_taxonomy()
{
	register_taxonomy(  
    	'btp_relation_tag',  
     	array('post', 'page', 'btp_work', 'btp_product', 'btp_client'),  
     	array(     		
     	  	'hierarchical' 			=> false,  
        	'label' 				=> __('Relation Tag', 'btp_theme'),
     		'labels'				=> array(
     			'name' 					=> __( 'Relation Tags', 'btp_theme' ),
    			'singular_name' 		=> __( 'Relation Tag', 'btp_theme' ),
    			'search_items' 			=> __( 'Search Relation Tags', 'btp_theme' ),
    			'all_items' 			=> __( 'All Relation Tags', 'btp_theme' ),
    			'parent_item' 			=> __( 'Parent Relation Tag', 'btp_theme' ),
    			'parent_item_colon' 	=> __( 'Parent Relation Tag:', 'btp_theme' ),
    			'edit_item' 			=> __( 'Edit Relation Tag', 'btp_theme' ), 
    			'update_item' 			=> __( 'Update Relation Tag', 'btp_theme' ),
    			'add_new_item' 			=> __( 'Add New Relation Tag', 'btp_theme' ),
    			'new_item_name' 		=> __( 'New Relation Tag', 'btp_theme' ),
     					
     		),  
         	'query_var' 			=> false,  
            'rewrite' 				=> false,
     		'show_tagcloud'			=> false,
     		'show_in_nav_menus'		=> false
     	)  
 	);
}

/**
 * Gets related records ids based on relation tags
 * 
 * @param int $post_id
 * @param string $post_type
 * @param int $limit
 */
function btp_get_related_ids( $post_id, $post_type, $limit ) {
	global $post, $wpdb;
			
	if( !$post_id )
		$post_id = $post ? $post->ID : 0;

	/* Post ID must be positive number*/	
	$post_id = absint($post_id);
	if($post_id <= 0)
		return array();
	
	$post_type = preg_replace('/[^0-9a-zA-Z_-]*/', '', $post_type);		
		
	$limit = absint($limit);

	$relation_tags = get_the_terms($post_id, 'btp_relation_tag');
	
	if( $relation_tags && count( $relation_tags ) ) {	
		/* Prepare tag_ids for further query */
		$tag_ids = array();
		foreach($relation_tags as $pt) 
			$tag_ids[] = (int)$pt->term_taxonomy_id;

		$tag_ids = implode(',', $tag_ids);
		
		/* Custom SQL query.
	  	 * Standard query_posts function doesn't have enough power to produce results we need */
		$btp_query =	"SELECT p.ID, COUNT(t_r.object_id) AS cnt " 						// get post ids and count
		 					."FROM $wpdb->term_relationships AS t_r, $wpdb->posts AS p "			
		          			."WHERE t_r.object_id = p.id " 									// build relations
		            			."AND t_r.term_taxonomy_id IN($tag_ids) " 					// only with the same tags
		            			."AND p.post_type='$post_type' "							
		            			."AND p.id != $post_id " 										// only other posts, not the post selfe
		            			."AND p.post_status='publish' " 							// only published posts
		          			."GROUP BY t_r.object_id " 										// group by relation
		          			."ORDER BY cnt DESC, p.post_date_gmt DESC " 					// order by count best matches first, and by date within same count
		          			."LIMIT $limit "; 												// get only the top x

		
		/* Run the query */
  		$btp_posts = $wpdb->get_results( $btp_query );
  		  			  			
  		if ( count( $btp_posts ) ) {
  			$related_ids = array();
			foreach($btp_posts as $p)
				$related_ids[] = (int)$p->ID;
				
			return $related_ids;	
  		}
	}
			
	return array();
}





/** 
 * Returns available transition methods for DICE Slider. 
 */
function btp_get_dice_slider_transition_methods() {
	return array(
		'FromTopLeft'		=> __( 'FromTopLeft', 'btp_theme' ), 
		'FromTop'			=> __( 'FromTop', 'btp_theme' ),
		'FromTopRight'		=> __( 'FromTopRight', 'btp_theme' ), 
		'FromRight'			=> __( 'FromRight', 'btp_theme' ),
		'FromBottomRight'	=> __( 'FromBottomRight', 'btp_theme' ), 
		'FromBottom'		=> __( 'FromBottom', 'btp_theme' ),
		'FromBottomLeft'	=> __( 'FromBottomLeft', 'btp_theme' ), 
		'FromLeft'			=> __( 'FromLeft', 'btp_theme' ),
		'FromTopTwist'		=> __( 'FromTopTwist', 'btp_theme' ),
	);
}
	
/**
 * Returns available easing methods for DICE Slider. 
 */
function btp_get_dice_slider_easing_methods() {
	return array(
		'easeNone' 			=> __( 'easeNone', 'btp_theme' ),
		'easeInQuad'		=> __( 'easeInQuad', 'btp_theme' ),
		'easeOutQuad'		=> __( 'easeOutQuad', 'btp_theme' ), 
		'easeInOutQuad'		=> __( 'easeInOutQuad', 'btp_theme' ), 
        'easeOutInQuad'		=> __( 'easeOutInQuad', 'btp_theme' ), 
        'easeInCubic'		=> __( 'easeInCubic', 'btp_theme' ), 
        'easeOutCubic'		=> __( 'easeOutCubic', 'btp_theme' ), 
        'easeInOutCubic'	=> __( 'easeInOutCubic', 'btp_theme' ), 
        'easeOutInCubic'	=> __( 'easeOutInCubic', 'btp_theme' ), 
        'easeInQuart'		=> __( 'easeInQuart', 'btp_theme' ), 
        'easeOutQuart'		=> __( 'easeOutQuart', 'btp_theme' ), 
        'easeInOutQuart'	=> __( 'easeInOutQuart', 'btp_theme' ), 
        'easeOutInQuart'	=> __( 'easeOutInQuart', 'btp_theme' ), 
        'easeInQuint'		=> __( 'easeInQuint', 'btp_theme' ),
        'easeOutQuint'		=> __( 'easeOutQuint', 'btp_theme' ), 
        'easeInOutQuint'	=> __( 'easeInOutQuint', 'btp_theme' ), 
        'easeOutInQuint'	=> __( 'easeOutInQuint', 'btp_theme' ), 
        'easeInSine'		=> __( 'easeInSine', 'btp_theme' ), 
        'easeOutSine'		=> __( 'easeOutSine', 'btp_theme' ), 
        'easeInOutSine'		=> __( 'easeInOutSine', 'btp_theme' ), 
        'easeOutInSine'		=> __( 'easeOutInSine', 'btp_theme' ), 
        'easeInCirc'		=> __( 'easeInCirc', 'btp_theme' ), 
        'easeOutCirc'		=> __( 'easeOutCirc', 'btp_theme' ), 
        'easeInOutCirc'		=> __( 'easeInOutCirc', 'btp_theme' ),
        'easeOutInCirc'		=> __( 'easeOutInCirc', 'btp_theme' ), 
        'easeInExpo'		=> __( 'easeInExpo', 'btp_theme' ), 
        'easeOutExpo'		=> __( 'easeOutExpo', 'btp_theme' ), 
        'easeInOutExpo'		=> __( 'easeInOutExpo', 'btp_theme' ), 
        'easeOutInExpo'		=> __( 'easeOutInExpo', 'btp_theme' ), 
        'easeInElastic'		=> __( 'easeInElastic', 'btp_theme' ), 
        'easeOutElastic'	=> __( 'easeOutElastic', 'btp_theme' ), 
        'easeInOutElastic'	=> __( 'easeInOutElastic', 'btp_theme' ), 
        'easeOutInElastic'	=> __( 'easeOutInElastic', 'btp_theme' ), 
        'easeInBack'		=> __( 'easeInBack', 'btp_theme' ), 
        'easeOutBack'		=> __( 'easeOutBack', 'btp_theme' ), 
        'easeInOutBack'		=> __( 'easeInOutBack', 'btp_theme' ), 
        'easeOutInBack'		=> __( 'easeOutInBack', 'btp_theme' ), 
        'easeInBounce'		=> __( 'easeInBounce', 'btp_theme' ), 
        'easeOutBounce'		=> __( 'easeOutBounce', 'btp_theme' ), 
        'easeInOutBounce'	=> __( 'easeInOutBounce', 'btp_theme' ), 
        'easeOutInBounce'	=> __( 'easeOutInBounce', 'btp_theme' )
	);
}

/** 
 * Composes default metadata for all DICE Sliders. 
 */
function btp_get_dice_slider_general_metadata() {
	$result = array();		
	
	$value = btp_get_theme_option('general_slider_dice_vertical_segments');
	if ( is_numeric( $value ) )
		$result['vertical_segments'] = intval($value);	
		
	$value = btp_get_theme_option('general_slider_dice_horizontal_segments');
	if ( is_numeric( $value ) )
		$result['horizontal_segments'] = intval($value);	

	$value = btp_get_theme_option('general_slider_dice_depth');
	if ( is_numeric( $value ) )
		$result['depth'] = intval($value);
		
	$value = btp_get_theme_option('general_slider_dice_transition');
	if ( !empty( $value ) )
		$result['transition'] = htmlspecialchars(strip_tags($value));	
		
	$value = btp_get_theme_option('general_slider_dice_tween_time');
	if ( is_numeric( $value ) )
		$result['tween_time'] = htmlspecialchars(strip_tags($value));

	$value = btp_get_theme_option('general_slider_dice_tween_delay');
	if ( is_numeric( $value ) )
		$result['tween_delay'] = htmlspecialchars(strip_tags($value));

	$value = btp_get_theme_option('general_slider_dice_easing');
	if ( !empty( $value ) )
		$result['easing'] = htmlspecialchars(strip_tags($value));

	$value = btp_get_theme_option('general_slider_dice_tween_timeout');
	if ( is_numeric( $value ) )
		$result['tween_timeout'] = htmlspecialchars(strip_tags($value));	
			
	$value = btp_get_theme_option('general_slider_dice_x_distance_multiply');
	if ( is_numeric( $value ) )
		$result['x_distance_multiply'] = htmlspecialchars(strip_tags($value));
		
	$value = btp_get_theme_option('general_slider_dice_y_distance_multiply');
	if ( is_numeric( $value ) )
		$result['y_distance_multiply'] = htmlspecialchars(strip_tags($value));
		
	$value = btp_get_theme_option('general_slider_dice_z_distance');
	if ( is_numeric( $value ) )
		$result['z_distance'] = htmlspecialchars(strip_tags($value));	
				
	$value = btp_get_theme_option('general_slider_dice_autoplay');
	if ( btp_bool( $value ) )
		$result['autoplay'] = true;
	else		
		$result['autoplay'] = false;
		
	$value = btp_get_theme_option('general_slider_dice_autoplay_pause');
	if ( btp_bool( $value ) )
		$result['autoplay_pause'] = true;
	else		
		$result['autoplay_pause'] = false;

	$value = btp_get_theme_option('general_slider_dice_cube_side_color');
	if( !empty($value) )
		$result['cube_side_color'] = htmlspecialchars(strip_tags(str_replace('#', '0x', $value)));	
	
	return $result;
}	
	
/** 
 * Composes metadata for DICE Slider located in precontent section of single post. 
 */
function btp_get_dice_slider_precontent_metadata() {		
	global $post;
	$btp_post_id = is_singular() ? $post->ID : (int) get_option( 'page_for_posts' );
	$result = array();
	
	if ( !$btp_post_id ) 
		return $result;			
		
	$value = get_post_meta($btp_post_id, '_btp_slider_dice_vertical_segments', true);
	if ( is_numeric( $value ) )
		$result['vertical_segments'] = intval($value);	

	$value = get_post_meta($btp_post_id, '_btp_slider_dice_horizontal_segments', true);
	if ( is_numeric( $value ) )
		$result['horizontal_segments'] = intval($value);				
		
	$value = get_post_meta($btp_post_id, '_btp_slider_dice_depth', true);
	if ( is_numeric( $value ) )
		$result['depth'] = intval($value);
		
	$value = get_post_meta($btp_post_id, '_btp_slider_dice_transition', true);
	if( strlen( $value ) )
		$result['transition'] = htmlspecialchars(strip_tags($value));	

	$value = get_post_meta($btp_post_id, '_btp_slider_dice_tween_time', true);
	if ( is_numeric( $value ) )
		$result['tween_time'] = htmlspecialchars(strip_tags($value));

	$value = get_post_meta($btp_post_id, '_btp_slider_dice_tween_delay', true);
	if ( is_numeric( $value ) )
		$result['tween_delay'] = htmlspecialchars(strip_tags($value));

	$value = get_post_meta($btp_post_id, '_btp_slider_dice_easing', true);
	if( strlen( $value ) )
		$result['easing'] = htmlspecialchars(strip_tags($value));	
		
	$value = get_post_meta($btp_post_id, '_btp_slider_dice_tween_timeout', true);
	if ( is_numeric( $value ) )
		$result['tween_timeout'] = htmlspecialchars(strip_tags($value));
		
	$value = get_post_meta($btp_post_id, '_btp_slider_dice_x_distance_multiply', true);
	if ( is_numeric( $value ) )
		$result['x_distance_multiply'] = htmlspecialchars(strip_tags($value));
		
	$value = get_post_meta($btp_post_id, '_btp_slider_dice_y_distance_multiply', true);
	if ( is_numeric( $value ) )
		$result['y_distance_multiply'] = htmlspecialchars(strip_tags($value));	

	$value = get_post_meta($btp_post_id, '_btp_slider_dice_z_distance', true);
	if ( is_numeric( $value ) )
		$result['z_distance'] = htmlspecialchars(strip_tags($value));		
			
	return $result;
}

/** 
 * Composes metadata for DICE single Slide. 
 */
function btp_get_dice_slide_metadata() {
	global $post;
	$result = array();
	
	if ( !$post )
		return $result;

	$value = get_post_meta($post->ID, '_btp_slider_dice_vertical_segments', true);
	if ( is_numeric( $value ) )
		$result['vertical_segments'] = intval($value);	

	$value = get_post_meta($post->ID, '_btp_slider_dice_horizontal_segments', true);
	if ( is_numeric( $value ) )
		$result['horizontal_segments'] = intval($value);				
		
	$value = get_post_meta($post->ID, '_btp_slider_dice_depth', true);
	if ( is_numeric( $value ) )
		$result['depth'] = intval($value);
		
	$value = get_post_meta($post->ID, '_btp_slider_dice_transition', true);
	if( strlen( $value ) )
		$result['transition'] = htmlspecialchars(strip_tags($value));	

	$value = get_post_meta($post->ID, '_btp_slider_dice_tween_time', true);
	if ( is_numeric( $value ) )
		$result['tween_time'] = htmlspecialchars(strip_tags($value));

	$value = get_post_meta($post->ID, '_btp_slider_dice_tween_delay', true);
	if ( is_numeric( $value ) )
		$result['tween_delay'] = htmlspecialchars(strip_tags($value));

	$value = get_post_meta($post->ID, '_btp_slider_dice_easing', true);
	if( strlen( $value ) )
		$result['easing'] = htmlspecialchars(strip_tags($value));	
		
	$value = get_post_meta($post->ID, '_btp_slider_dice_timeout', true);
	if ( is_numeric( $value ) )
		$result['tween_timeout'] = htmlspecialchars(strip_tags($value));
		
	$value = get_post_meta($post->ID, '_btp_slider_dice_x_distance_multiply', true);
	if ( is_numeric( $value ) )
		$result['x_distance_multiply'] = htmlspecialchars(strip_tags($value));
		
	$value = get_post_meta($post->ID, '_btp_slider_dice_y_distance_multiply', true);
	if ( is_numeric( $value ) )
		$result['y_distance_multiply'] = htmlspecialchars(strip_tags($value));	

	$value = get_post_meta($post->ID, '_btp_slider_dice_z_distance', true);
	if ( is_numeric( $value ) )
		$result['z_distance'] = htmlspecialchars(strip_tags($value));
	
	return $result;		
}


	
/**
 * Returns available easing methods for Kwicks Slider. 
 */
function btp_get_kwicks_slider_easing_methods() {
	return array(
		'linear'			=> __( 'linear', 'btp_theme' ), 
		'easeInSine'		=> __( 'easeInSine', 'btp_theme' ),
		'easeOutSine'		=> __( 'easeOutSine', 'btp_theme' ), 
		'easeInOutSine'		=> __( 'easeInOutSine', 'btp_theme' ), 
		'easeInCubic'		=> __( 'easeInCubic', 'btp_theme' ), 
		'easeOutCubic'		=> __( 'easeOutCubic', 'btp_theme' ), 
		'easeInOutCubic'	=> __( 'easeInOutCubic', 'btp_theme' ), 
		'easeOutInCubic'	=> __( 'easeOutInCubic', 'btp_theme' ), 
		'easeInQuint'		=> __( 'easeInQuint', 'btp_theme' ), 
		'easeOutQuint'		=> __( 'easeOutQuint', 'btp_theme' ), 
		'easeInOutQuint'	=> __( 'easeInOutQuint', 'btp_theme'), 
		'easeOutInQuint'	=> __( 'easeOutInQuint', 'btp_theme'), 
		'easeInCirc'		=> __( 'easeInCirc', 'btp_theme'), 
		'easeOutCirc'		=> __( 'easeOutCirc', 'btp_theme'), 
		'easeInOutCirc'		=> __( 'easeInOutCirc', 'btp_theme'), 
		'easeOutInCirc'		=> __( 'easeOutInCirc', 'btp_theme'), 
		'easeInBack'		=> __( 'easeInBack', 'btp_theme'), 
		'easeOutBack'		=> __( 'easeOutBack', 'btp_theme'), 
		'easeInOutBack'		=> __( 'easeInOutBack', 'btp_theme'), 
		'easeOutInBack'		=> __( 'easeOutInBack', 'btp_theme'), 
		'easeInQuad'		=> __( 'easeInQuad', 'btp_theme'), 
		'easeOutQuad'		=> __( 'easeOutQuad', 'btp_theme'), 
		'easeInOutQuad'		=> __( 'easeInOutQuad', 'btp_theme'), 
		'easeOutInQuad'		=> __( 'easeOutInQuad', 'btp_theme'), 
		'easeInQuart'		=> __( 'easeInQuart', 'btp_theme'), 
		'easeOutQuart'		=> __( 'easeOutQuart', 'btp_theme'), 
		'easeInOutQuart'	=> __( 'easeInOutQuart', 'btp_theme'), 
		'easeOutInQuart'	=> __( 'easeOutInQuart', 'btp_theme'), 
		'easeInExpo'		=> __( 'easeInExpo', 'btp_theme'), 
		'easeOutExpo'		=> __( 'easeOutExpo', 'btp_theme'), 
		'easeInOutExpo'		=> __( 'easeInOutExpo', 'btp_theme'), 
		'easeOutInExpo'		=> __( 'easeOutInExpo', 'btp_theme'), 
		'easeInElastic'		=> __( 'easeInElastic', 'btp_theme'), 
		'easeOutElastic'	=> __( 'easeOutElastic', 'btp_theme'), 
		'easeInOutElastic'	=> __( 'easeInOutElastic', 'btp_theme'),  
		'easeOutInElastic'	=> __( 'easeOutInElastic', 'btp_theme'),  
		'easeInBounce'		=> __( 'easeInBounce', 'btp_theme'), 
		'easeOutBounce'		=> __( 'easeOutBounce', 'btp_theme'), 
		'easeInOutBounce'	=> __( 'easeInOutBounce', 'btp_theme'), 
		'easeOutInBounce'	=> __( 'easeOutInBounce', 'btp_theme')
	);
}

/**
 *  Composes default metadata for all Kwicks Sliders. 
 */
function btp_get_kwicks_slider_general_metadata() {
	$result = array();
	
	$value = btp_get_theme_option('general_slider_kwicks_duration');
	if ( is_numeric( $value ) )
		$result['duration'] = $value*1000;
	
	$value = btp_get_theme_option('general_slider_kwicks_easing');
	if ( !empty( $value ) )
		$result['easing'] = htmlspecialchars(strip_tags($value));
		
	return $result;
}



/** 
 * Returns available transition methods for Cycle Slider. 
 */
function btp_get_cycle_slider_transition_methods() {
	return array(
		'blindX'			=> __( 'blindX', 'btp_theme' ),
		'blindY'			=> __( 'blindY', 'btp_theme' ),		
		'blindZ'			=> __( 'blindZ', 'btp_theme' ),
		'cover'				=> __( 'cover', 'btp_theme' ),
		'curtainX'			=> __( 'curtainX', 'btp_theme' ),
		'curtainY'			=> __( 'curtainY', 'btp_theme' ),
		'fade'				=> __( 'fade', 'btp_theme' ),
		'fadeZoom'			=> __( 'fadeZoom', 'btp_theme' ),
		'growX'				=> __( 'growX', 'btp_theme' ),
		'growY'				=> __( 'growY', 'btp_theme' ),
		'none'				=> __( 'none', 'btp_theme' ),
		'scrollUp'			=> __( 'scrollUp', 'btp_theme' ),
		'scrollDown'		=> __( 'scrollDown', 'btp_theme' ),
		'scrollLeft'		=> __( 'scrollLeft', 'btp_theme' ),
		'scrollRight'		=> __( 'scrollRight', 'btp_theme' ),
    	'scrollHorz'		=> __( 'scrollHorz', 'btp_theme' ),
    	'scrollVert'		=> __( 'scrollVert', 'btp_theme' ),
    	'shuffle'			=> __( 'shuffle', 'btp_theme' ),
    	'slideX'			=> __( 'slideX', 'btp_theme' ),
    	'slideY'			=> __( 'slideY', 'btp_theme' ),
    	'toss'				=> __( 'toss', 'btp_theme' ),	
    	'turnUp'			=> __( 'turnUp', 'btp_theme' ),
    	'turnDown'			=> __( 'turnDown', 'btp_theme' ),
    	'turnLeft'			=> __( 'turnLeft', 'btp_theme' ),
    	'turnRight'			=> __( 'turnRight', 'btp_theme' ),
    	'uncover'			=> __( 'uncover', 'btp_theme' ),
    	'wipe'				=> __( 'wipe', 'btp_theme' ),
    	'zoom'				=> __( 'zoom', 'btp_theme' )
        );
}    	
	
/** 
 * Returns available easing methods for Cycle Slider. 
 */
function btp_get_cycle_slider_easing_methods() {
	return array(
		'easeInQuad'		=> __( 'easeInQuad', 'btp_theme' ),
		'easeOutQuad'		=> __( 'easeOutQuad', 'btp_theme' ), 
		'easeInOutQuad'		=> __( 'easeInOutQuad', 'btp_theme' ), 
		'easeInCubic'		=> __( 'easeInCubic', 'btp_theme' ), 
		'easeOutCubic'		=> __( 'easeOutCubic', 'btp_theme' ),
		'easeInOutCubic'	=> __( 'easeInOutCubic', 'btp_theme' ),
        'easeInQuart'		=> __( 'easeInQuart', 'btp_theme' ),
        'easeOutQuart'		=> __( 'easeOutQuart', 'btp_theme' ),
        'easeInOutQuart'	=> __( 'easeInOutQuart', 'btp_theme' ),
        'easeInQuint'		=> __( 'easeInQuint', 'btp_theme' ),
        'easeOutQuint'		=> __( 'easeOutQuint', 'btp_theme' ),
        'easeInOutQuint'	=> __( 'easeInOutQuint', 'btp_theme' ),
        'easeInSine'		=> __( 'easeInSine', 'btp_theme' ),
        'easeOutSine'		=> __( 'easeOutSine', 'btp_theme' ),
        'easeInOutSine'		=> __( 'easeInOutSine', 'btp_theme' ),
        'easeInExpo'		=> __( 'easeInExpo', 'btp_theme' ),
        'easeOutExpo'		=> __( 'easeOutExpo', 'btp_theme' ),
        'easeInOutExpo'		=> __( 'easeInOutExpo', 'btp_theme' ),
        'easeInCirc'		=> __( 'easeInCirc', 'btp_theme' ),
        'easeOutCirc'		=> __( 'easeOutCirc', 'btp_theme' ),
        'easeInOutCirc'		=> __( 'easeInOutCirc', 'btp_theme' ),
        'easeInElastic'		=> __( 'easeInElastic', 'btp_theme' ),
        'easeOutElastic'	=> __( 'easeOutElastic', 'btp_theme' ),
        'easeInOutElastic'	=> __( 'easeInOutElastic', 'btp_theme' ),
        'easeInBack'		=> __( 'easeInBack', 'btp_theme' ),
        'easeOutBack'		=> __( 'easeOutBack', 'btp_theme' ),
        'easeInOutBack'		=> __( 'easeInOutBack', 'btp_theme' ),
        'easeInBounce'		=> __( 'easeInBounce', 'btp_theme' ),
        'easeOutBounce'		=> __( 'easeOutBounce', 'btp_theme' ),
        'easeInOutBounce'	=> __( 'easeInOutBounce', 'btp_theme' )
        );
}

/** 
 * Composes default metadata for all Cycle Sliders. 
 */
function btp_get_cycle_slider_general_metadata() {
	$result = array();	
		
	$value = btp_get_theme_option('general_slider_cycle_fx');
	if ( !empty( $value ) )
		$result['fx'] = htmlspecialchars(strip_tags($value));	
		
	$value = btp_get_theme_option('general_slider_cycle_speed');
	if ( is_numeric( $value ) )
		$result['speed'] = $value*1000;
	
	$value = btp_get_theme_option('general_slider_cycle_easing');
	if ( !empty( $value ) )
		$result['easing'] = htmlspecialchars(strip_tags($value));

	$value = btp_get_theme_option('general_slider_cycle_timeout');
	if ( is_numeric( $value ) )
		$result['timeout'] = $value*1000;
		
	$value = btp_get_theme_option('general_slider_cycle_pause');
	if ( btp_bool( $value ) )
		$result['pause'] = true;
	else		
		$result['pause'] = false;
		
	return $result;
}	
	
/** 
 * Composes metadata for Cycle Slider located in precontent section of single post. 
 */
function btp_get_cycle_slider_precontent_metadata() {
	global $post;
	$btp_post_id = is_singular() ? $post->ID : (int) get_option( 'page_for_posts' );
	$result = array();
	
	if ( !$btp_post_id ) 
		return $result;	
		
	$value = get_post_meta($btp_post_id, '_btp_slider_cycle_fx', true);
	if ( strlen( $value ) )
		$result['fx'] = htmlspecialchars(strip_tags($value));	
		
	$value = get_post_meta($btp_post_id, '_btp_slider_cycle_speed', true);
	if ( is_numeric( $value ) )
		$result['speed'] = $value*1000;
	
	$value = get_post_meta($btp_post_id, '_btp_slider_cycle_easing', true);
	if ( strlen( $value ) )
		$result['easing'] = htmlspecialchars(strip_tags($value));

	$value = get_post_meta($btp_post_id, '_btp_slider_cycle_timeout', true);
	if ( is_numeric( $value ) )
		$result['timeout'] = $value*1000;
	
	return $result;
}







/**
 * Returns available skins. 
 */
function btp_get_skins_mapping() {
	return array(
		'valley-black'			=> __( 'Valley - Black', 'btp_theme' ),
		'glass-purple'			=> __( 'Glass - Purple', 'btp_theme' ),
		'minimal-red'			=> __( 'Minimal - Red', 'btp_theme' ),
		'sky-blue'				=> __( 'Sky - Blue', 'btp_theme' ),
	);
}

/** 
 * Returns available fonts.
 */
function btp_get_fonts() {
	return array(
		'TitilliumText25L_300.font' 		=> __( 'TitilliumText25L_300', 'btp_theme' ),
		'TitilliumText25L_400.font' 		=> __( 'TitilliumText25L_400', 'btp_theme' ),	
	);
}
	
/**
 * Calculates color range based on haxadecimal color representation. 
 * 
 * @param $color
 * @return int
 */
function btp_get_color_range( $color ) {
	
	if ( $color[0] == '#' )
        $color = substr( $color, 1 );

    if ( strlen( $color ) == 6 )
       	list( $r, $g, $b ) = array( $color[0].$color[1], $color[2].$color[3], $color[4].$color[5] );

    $r = hexdec( $r ); 
    $g = hexdec( $g ); 
    $b = hexdec( $b );
    
    $range = ( $r + $g + $b ) / 3;
    $range = floor( ( $range / 250 ) * 10 );
    
    return $range;
}
	





/** 
 * Returns available templates for feeds collection (used by shortcodes, widgets). 
 */
function btp_get_feed_collection_templates() {
	return array(
		'list-vertical'		=> __( 'list-vertical', 'btp_theme' ),
		'list-horizontal'	=> __( 'list-horizontal', 'btp_theme' ),
	);
}
	
/** 
 * Returns available linking methods.
 */
function btp_get_linking_methods() {
	return array(
		'default' 			=> __( 'Default', 'btp_theme' ), 
		'none' 				=> __( 'None', 'btp_theme' ), 
		'new_window' 		=> __( 'Open in new window', 'btp_theme' ), 
		'lightbox' 			=> __( 'Open in lightbox', 'btp_theme' )
	);
}
	



/**
 * Normalize max_per_row value.
 * 
 * @param int_type $value
 * @param int $max
 * @param int $min
 * @return int
 */
function btp_normalize_max_per_row($value, $max, $min = 1) {
	$value = empty($value) ? $max : $value;	
	$value = ($value > $max) ? $max : $value;
	$value = ($value < $min) ? $min : $value;
	
	return $value;
}



/**
 * Checks if a post has a featured asset. 
 * 
 * @param int $post_id
 */
function btp_has_featured_asset( $post_id = null ) {
	global $id;
	$post_id = ( null === $post_id ) ? $id : $post_id;
	
	if ( has_post_thumbnail( $post_id ) )
		return true;

	if ( strlen(get_post_meta($post_id, '_btp_featured_asset_1', true)) )
		return true;
		
	return false;
}


/**
 * Determines asset type.
 * 
 * @param string $asset
 */
function btp_asset_type( $asset ) { 	
	if ( strlen( $asset ) ) {
		if ( strpos( $asset, 'http://www.youtube.com/') === 0 )
			return 'video';
			
		if ( strpos( $asset, 'http://vimeo.com/') === 0 )
			return 'video';
			
		if ( strpos( $asset, '.jpg') == ( strlen($asset) - 1 - 3 ) )
			return 'image';	
		
		if ( strpos( $asset, '.jpeg') == ( strlen($asset) - 1 - 4 ) )
			return 'image';

		if ( strpos( $asset, '.png') == ( strlen($asset) - 1 - 3 ) )
			return 'image';	

		if ( strpos( $asset, '.gif') == ( strlen($asset) - 1 - 3 ) )
			return 'image';
			
		return 'unknown';				
	}
		
	return false;
}


function btp_include_skin_css() {
	$btp_skin = preg_replace('/[^0-9a-zA-Z_-]*/', '', btp_get_theme_option('style_skin'));
	
	if ( strlen( $btp_skin ) )
		echo '<link rel="stylesheet" type="text/css" media="all" href="' . get_template_directory_uri().'/css/skins/'.$btp_skin.'.css" />';
}	


/**
 * Determines if blog page is a static page
 */
function btp_is_static_posts_page() {
	global $wp_query;
	
	$post = $wp_query->get_queried_object();
	return ( get_option('show_on_front') == 'page' && is_home() && $post->ID == get_option('page_for_posts' ) );
}


?>