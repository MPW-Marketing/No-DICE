<?php
function btp_init_slide_post_type() {
	register_post_type('btp_slide',
		array(
			'label'		=> __('Slides', 'btp_theme'),
			'labels'	=> array(
				'name'					=> __('Slides', 'btp_theme'),
				'singular_name' 		=> __('Slide', 'btp_theme'),
				'add_new'				=> __('Add New Slide', 'btp_theme'),
				'add_new_item' 			=> __('Add New Slide', 'btp_theme'),
				'edit_item'				=> __('Edit Slide', 'btp_theme'),
				'new_item'				=> __('New Slide', 'btp_theme'),
				'view_item'				=> __('View Slide', 'btp_theme'),
				'search_items'			=> __('Search Slides', 'btp_theme'),
				'not_found'				=> __('No Slides found', 'btp_theme'),
				'not_found_in_trash'	=> __('No Slides found in Trash', 'btp_theme'),				
			),
			'public'					=> true,
			'publicly_queryable'		=> false,
			'exclude_from_search'		=> true,
			'hierarchical'				=> false,
			'query_var'					=> true,			
			'supports'					=> array('title', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes'),
			'show_in_nav_menus'			=> false
		)	
	);		
	
	register_taxonomy(  
    	'btp_slide_category',  
     	array('btp_slide'),  
     	array(     		
     	  	'hierarchical' 			=> true,  
        	'label' 				=> __('Slide Category', 'btp_theme'),
     		'labels'				=> array(
     			'name' 					=> __( 'Slide Categories', 'btp_theme' ),
    			'singular_name' 		=> __( 'Slide Category', 'btp_theme' ),
    			'search_items' 			=> __( 'Search Slide Categories', 'btp_theme' ),
    			'all_items' 			=> __( 'All Slide Categories', 'btp_theme' ),
    			'parent_item' 			=> __( 'Parent Slide Category', 'btp_theme' ),
    			'parent_item_colon' 	=> __( 'Parent Slide Category:', 'btp_theme' ),
    			'edit_item' 			=> __( 'Edit Slide Category', 'btp_theme' ), 
    			'update_item' 			=> __( 'Update Slide Category', 'btp_theme' ),
    			'add_new_item' 			=> __( 'Add New Slide Category', 'btp_theme' ),
    			'new_item_name' 		=> __( 'New Slide Category', 'btp_theme' ),
     					
     		),  
         	'query_var' 			=> true,  
     		'exclude_from_search'	=> true,
            'rewrite' 				=> false,
     		'show_tagcloud'			=> false,
     		'show_in_nav_menus'		=> false
     	)  
 	);	

	/* Add Custom Write Panels to Slide Edit Page */
 	add_action('admin_menu', 'btp_add_slide_details_meta_box');
 	add_action('save_post', 'btp_save_slide_details_meta_box');
 	
 	add_action('admin_menu', 'btp_add_slide_dice_meta_box'); 	
 	add_action('save_post', 'btp_save_slide_dice_meta_box');
 	

 	/* Customize appearance of slide listing page (admin panel) */
 	add_filter('manage_btp_slide_posts_columns', 'btp_slide_edit_columns');
	add_action('manage_posts_custom_column',  'btp_slide_columns_display');	
	add_filter('pre_get_posts', 'btp_slide_admin_order'); 	
}

$btp_slide_details_meta_box = array(
	
   '_btp_featured_asset_1'    => array(
		'model'		=> array(
		),
		'view'		=> array(
			'render_func'	=> 'textarea',
			'label'     	=> __('Featured asset', 'btp_theme'),
		)
	),
	'_btp_linking'    => array(
		'model'		=> array(
			'options'		=> array('default' => __('Default', 'btp_theme'), 'none' => __('None', 'btp_theme'), 'new_window' => __('Open in new window', 'btp_theme'), 'lightbox' => __('Open in lightbox', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Linking', 'btp_theme'),
		)
	),
);


$btp_slide_dice_meta_box = array(
	'_btp_slider_dice_vertical_segments'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Vertical segments', 'btp_theme'),
		)
	),	
	'_btp_slider_dice_horizontal_segments'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Horizontal segments', 'btp_theme'),
		)
	),
	'_btp_slider_dice_depth'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Depth', 'btp_theme'),
		)
	),	
   '_btp_slider_dice_transition'    => array(
		'model'		=> array(
			'null'			=> '',
			'options'		=> 'btp_get_dice_slider_transition_methods',
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Transition', 'btp_theme'),
		)
	),
	'_btp_slider_dice_tween_time'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Tween time', 'btp_theme'),
		)
	),
	'_btp_slider_dice_tween_delay'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Tween delay', 'btp_theme'),
		)
	),
	'_btp_slider_dice_easing'    => array(
		'model'		=> array(
			'null'			=> '',
			'options'		=> 'btp_get_dice_slider_easing_methods',
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Easing', 'btp_theme'),
		)
	),
	'_btp_slider_dice_timeout'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Timeout', 'btp_theme'),
		)
	),		
	'_btp_slider_dice_x_distance_multiply'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('X distance multiply', 'btp_theme'),
		)
	),
	'_btp_slider_dice_y_distance_multiply'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Y distance multiply', 'btp_theme'),
		)
	),
	'_btp_slider_dice_z_distance'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Z distance', 'btp_theme'),
		)
	),
   
);


function btp_add_slide_details_meta_box() {
    global $btp_slide_details_meta_box;     
    add_meta_box(
    	'btp_slide_details_meta_box', 								//id
    	__('Slide Details', 'btp_theme'), 						//title
    	'btp_render_meta_box', 										//callback function 
    	'btp_slide', 												//post_type
       	'normal', 													//context    	
       	'high',														//priority
    	array('options' => $btp_slide_details_meta_box)				//callback arguments													
    );
}

function btp_add_slide_dice_meta_box() {
    global $btp_slide_dice_meta_box;     
    add_meta_box(
    	'btp_slide_dice_meta_box', 									//id
    	__('DICE Slide', 'btp_theme'), 							//title
    	'btp_render_meta_box', 										//callback function 
    	'btp_slide', 												//post_type
       	'normal', 													//context 
    	'high',														//priority
    	array('options' => $btp_slide_dice_meta_box)				//callback arguments
    );
}

/* Save data from 'Slide Details' meta box */
function btp_save_slide_details_meta_box($post_ID) {     
	global $btp_slide_details_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 				=> 'btp_slide_details_meta_box', 
		'options' 			=> $btp_slide_details_meta_box,
		'post_type'			=> 'btp_slide'
	));
}

/* Save data from 'DICE Slide' meta box */
function btp_save_slide_dice_meta_box($post_ID) {     
	global $btp_slide_dice_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 				=> 'btp_slide_dice_meta_box', 
		'options' 			=> $btp_slide_dice_meta_box,
		'post_type'			=> 'btp_slide'
	));
}



/**
 * Gets slide categories as an associative array (id => name)
 * 
 * @return array
 */
function btp_get_slide_categories_mapping() {
	$options = array();
	
	$terms = get_terms('btp_slide_category');    	
    foreach($terms as $term) {    	    		
    	$options[$term->term_id] = htmlspecialchars( strip_tags( $term->name ) );
    }
    
    return $options;
}





/* Customize appearance of work listing page (admin panel). 
 * Add/remove some columns */
function btp_slide_edit_columns($columns){		
	$columns['btp_slide_categories'] 		= __('Slide Categories', 'btp_theme');
	$columns['btp_slide_featured_image'] 	= __('Featured Image', 'btp_theme');
	
	
	return $columns;
}

/* Customize appearance of slide listing page (admin panel). 
 * Add/remove some columns */
function btp_slide_columns_display($column_name){
	global $post;
	
	switch ( $column_name ) {
		case 'btp_slide_categories':
			echo get_the_term_list( $post->ID, 'btp_slide_category', '<p>', ',', '</p>' );
			break;
		
		case 'btp_slide_featured_image':
			the_post_thumbnail('c-1');
			break;
									
		default:	
			return;
			break;	
	}
}

/* Customize appearance of slide listing page (admin panel). 
 * Order slides by menu_order attribute */
function btp_slide_admin_order($wp_query) {
   
 	if (is_admin() && $wp_query->query['post_type'] == 'btp_slide' )
 	{ 
 		$wp_query->set('orderby', 'menu_order');
 		$wp_query->set('order', 'ASC');
 		
 	}
	return $wp_query;
 }
?>