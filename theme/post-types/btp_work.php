<?php

function btp_init_work_post_type() {
	register_post_type('btp_work',
		array(
			'label'		=> __('Works', 'btp_theme'),
			'labels'	=> array(
				'name'					=> __('Works', 'btp_theme'),
				'singular_name' 		=> __('Work', 'btp_theme'),
				'add_new'				=> __('Add New Work', 'btp_theme'),
				'add_new_item' 			=> __('Add New Work', 'btp_theme'),
				'edit_item'				=> __('Edit Work', 'btp_theme'),
				'new_item'				=> __('New Work', 'btp_theme'),
				'view_item'				=> __('View Work', 'btp_theme'),
				'search_items'			=> __('Search Works', 'btp_theme'),
				'not_found'				=> __('No Works found', 'btp_theme'),
				'not_found_in_trash'	=> __('No Works found in Trash', 'btp_theme'),				
			),
		
			'public'		=> true,
			'query_var'		=> 'btp_work',
			'has_archives'	=> true,
			'supports'		=> array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'comments', 'revisions'),
			'rewrite'		=> array('slug' => 'work', 'with_front' => true)
		)	
	);	
	
	register_taxonomy(  
    	'btp_work_category',  
     	array('btp_work'),  
     	array(     		
     	  	'hierarchical' 			=> true,  
        	'label' 				=> __('Work Category', 'btp_theme'),
     		'labels'				=> array(
     			'name' 					=> __( 'Work Categories', 'btp_theme' ),
    			'singular_name' 		=> __( 'Work Category', 'btp_theme' ),
    			'search_items' 			=> __( 'Search Work Categories', 'btp_theme' ),
    			'all_items' 			=> __( 'All Work Categories', 'btp_theme' ),
    			'parent_item' 			=> __( 'Parent Work Category', 'btp_theme' ),
    			'parent_item_colon' 	=> __( 'Parent Work Category:', 'btp_theme' ),
    			'edit_item' 			=> __( 'Edit Work Category', 'btp_theme' ), 
    			'update_item' 			=> __( 'Update Work Category', 'btp_theme' ),
    			'add_new_item' 			=> __( 'Add New Work Category', 'btp_theme' ),
    			'new_item_name' 		=> __( 'New Work Category', 'btp_theme' ),
     					
     		),  
         	'query_var' 			=> 'btp_work_category',
     		'rewrite' 				=> array('slug' => 'work-category', 'with_front' => true),
     		'show_in_nav_menus'		=> true
     		
     	)  
 	);
 	
 	register_taxonomy(  
    	'btp_work_tag',  
     	array('btp_work'),  
     	array(     		
     	  	'hierarchical' 			=> false,  
        	'label' 				=> __('Work Tag', 'btp_theme'),
     		'labels'				=> array(
     			'name' 					=> __( 'Work Tags', 'btp_theme' ),
    			'singular_name' 		=> __( 'Work Tag', 'btp_theme' ),
    			'search_items' 			=> __( 'Search Work Tags', 'btp_theme' ),
    			'all_items' 			=> __( 'All Work Tags', 'btp_theme' ),
    			'parent_item' 			=> __( 'Parent Work Tag', 'btp_theme' ),
    			'parent_item_colon' 	=> __( 'Parent Work Tag:', 'btp_theme' ),
    			'edit_item' 			=> __( 'Edit Work Tag', 'btp_theme' ), 
    			'update_item' 			=> __( 'Update Work Tag', 'btp_theme' ),
    			'add_new_item' 			=> __( 'Add New Work Tag', 'btp_theme' ),
    			'new_item_name' 		=> __( 'New Work Tag', 'btp_theme' ),
     					
     		),  
         	'query_var' 			=> 'btp_work_tag',
     		'rewrite' 				=> array('slug' => 'work-tag', 'with_front' => true),
     		'show_in_nav_menus'		=> true     		
     	)  
 	);
 	
 	/* Add Custom Write Panels to Work Edit Page */
 	add_action('admin_menu', 'btp_add_work_details_meta_box');
 	add_action('save_post', 'btp_save_work_details_meta_box');
 	
 	add_action('admin_menu', 'btp_add_work_precontent_options_meta_box');
 	add_action('save_post', 'btp_save_work_precontent_options_meta_box');
 	
 	add_action('admin_menu', 'btp_add_work_single_options_meta_box');
 	add_action('save_post', 'btp_save_work_single_options_meta_box');
 	
 	
 	/* Add Custom Write Panels to Work Category Edit Page */
 	add_action('btp_work_category_edit_form_fields', 'btp_work_category_edit_form_fields');
	add_action( 'edited_term_taxonomy', 'btp_work_category_edited_term_taxonomy' );
	
	
	/* Add Custom Write Panels to Work Tag Edit Page */	
	add_action('btp_work_tag_edit_form_fields', 'btp_work_tag_edit_form_fields');
	add_action( 'edited_term_taxonomy', 'btp_work_tag_edited_term_taxonomy' );
 	
 	
 	/* Customize appearance of portfolio project listing page (admin panel) */
 	add_filter('manage_btp_work_posts_columns', 'btp_work_edit_columns');
	add_action('manage_posts_custom_column',  'btp_work_columns_display');
}

$btp_work_details_meta_box = array(
	'_btp_featured_asset_1'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'textarea',
			'label'     	=> __('Primary asset', 'btp_theme'),
		)
	),	
	'_btp_thumb_linking'    => array(
		'model'		=> array(
			'options'		=> 'btp_get_linking_methods',	
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Thumb linking', 'btp_theme'),
		)
	),	
	'_btp_title_linking'    => array(
		'model'		=> array(
			'options'		=> 'btp_get_linking_methods',	
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Title linking', 'btp_theme'),
		)
	),
	'_btp_button_1_header'   => array('model' => null, 'view' => array( 'render_func' => 'header', 'label' => __('Primary Button', 'btp_theme'))),
	'_btp_button_1_label'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Label', 'btp_theme'),
		)
	),		
	'_btp_button_1_linking'    => array(
		'model'		=> array(
			'options'		=> 'btp_get_linking_methods',
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Linking', 'btp_theme'),
		)
	),	
	'_btp_button_2_header'   => array('model' => null, 'view' => array( 'render_func' => 'header', 'label' => __('Secondary Button', 'btp_theme'))),
	'_btp_button_2_label'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Label', 'btp_theme'),
		)
	),	
	'_btp_featured_asset_2'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'textarea',
			'label'     	=> __('Asset', 'btp_theme'),
		)
	),	
	'_btp_button_2_linking'    => array(
		'model'		=> array(
			'options'		=> 'btp_get_linking_methods',
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Linking', 'btp_theme'),
		)
	),
	'_btp_button_3_header'   => array('model' => null, 'view' => array( 'render_func' => 'header', 'label' => __('Tertiary Button', 'btp_theme'))),	
	'_btp_button_3_label'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Label', 'btp_theme'),
		)
	),	
	'_btp_featured_asset_3'    => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'	=> 'textarea',
			'label'     	=> __('Asset', 'btp_theme'),
		)
	),	
	'_btp_button_3_linking'    => array(
		'model'		=> array(
			'options'		=> 'btp_get_linking_methods',
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Linking', 'btp_theme'),
		)
	),
);

$btp_work_single_options_meta_box = array(
	'_btp_template'    => array(
		'model'		=> array(
			'null'			=> '',
			'options'		=> 'btp_get_work_single_templates',
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Template', 'btp_theme'),
		)
	),
	'_btp_sidebar_primary'   => array(
		'model'		=> array(
			'null'				=> '',
			'options'			=> 'btp_get_sidebars_mapping',
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'     		=> __('Primary Sidebar', 'btp_theme'),
		)
	),
	'_btp_hide_title' => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'				=> __('Hide title?', 'btp_theme'),	
		)		
	),   	
	'_btp_media_box'   => array(
		'model'		=> array(
			'null'			=> '',
			'options'		=> array(
        				'none'				=> __('None', 'btp_theme'),
						'featured-asset'	=> __('Featured asset', 'btp_theme'),
        				'attachments-cycle'	=> __('Attachments: Cycle Slider', 'btp_theme')        						
        		),
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'     		=> __('Media box', 'btp_theme'),
		)
	),
	'_btp_hide_date' => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'     		=> __('Hide date?', 'btp_theme'),
		),
	),
	'_btp_hide_comments_link' => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'     		=> __('Hide comments link?', 'btp_theme'),
		),
	),
	'_btp_hide_categories' => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'     		=> __('Hide categories?', 'btp_theme'),
		),
	),
	'_btp_hide_tags' => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'     		=> __('Hide tags?', 'btp_theme'),
		),
	),
	'_btp_hide_button_2' => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'     		=> __('Hide secondary button?', 'btp_theme'),
		),
	),
	'_btp_hide_button_3' => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'     		=> __('Hide tertiary button?', 'btp_theme'),
		),
	),
);
function btp_add_work_details_meta_box() {
    global $btp_work_details_meta_box;     
    add_meta_box(
    	'btp_work_details_meta_box', 								//id
    	__('Work Details', 'btp_theme'), 							//title
    	'btp_render_meta_box',									 	//callback function 
    	'btp_work', 												//post_type
       	'normal', 													//context 
    	'high', 													//priority
    	array('options' => $btp_work_details_meta_box)				//callback arguments
    );
}

function btp_add_work_precontent_options_meta_box() {     
	global $btp_precontent_options_meta_box;     
    add_meta_box(
    	'btp_precontent_options_meta_box', 							//id
    	__('Precontent Options', 'btp_theme'),					//title
    	'btp_render_meta_box',										//callback function 
    	'btp_work',			 										//post_type
       	'normal', 													//context 
    	'high',														//priority
    	array('options'	=> $btp_precontent_options_meta_box)		//calback arguments
    );
}
function btp_add_work_single_options_meta_box() { 
	global $btp_work_single_options_meta_box;       
    add_meta_box(
    	'btp_work_single_options_meta_box', 						//id
    	__('Single Page Options', 'btp_theme'),						//title
    	'btp_render_meta_box',										//callback function 
    	'btp_work', 												//post_type
       	'normal', 													//context 
    	'high', 													//priority
    	array('options' => $btp_work_single_options_meta_box)		//calback arguments
    );
}
/* Save data from 'Work Details' meta box */
function btp_save_work_details_meta_box($post_ID) {     
	global $btp_work_details_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 			=> 'btp_work_details_meta_box', 
		'options' 		=> $btp_work_details_meta_box,
		'post_type'		=> 'btp_work'
	));
}
/* Save data from 'Precontent Options' meta box */
function btp_save_work_precontent_options_meta_box($post_ID) {     
	global $btp_precontent_options_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 			=> 'btp_precontent_options_meta_box', 
		'options' 		=> $btp_precontent_options_meta_box,
		'post_type'		=> 'btp_work'	
	));
}
/* Save data from 'Single Page Options' meta box */
function btp_save_work_single_options_meta_box($post_ID) {     
	global $btp_work_single_options_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 			=> 'btp_work_single_options_meta_box', 
		'options' 		=> $btp_work_single_options_meta_box,
		'post_type'		=> 'btp_work'
	));
}



$btp_work_archive_options = array(
	'template'   => array(
		'model'		=> array(
			'null'			=> '',
			'options'		=> 'btp_get_work_archive_templates'			
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Template', 'btp_theme'),
		)
	),   	
	'posts_per_page'   => array(
		'model'		=> array(
				
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'     	=> __('Works per page', 'btp_theme'),
		)
	),
	'hide_title'   => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Hide title?', 'btp_theme'),
		)
	),
	'hide_date'   => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Hide date?', 'btp_theme'),
		)
	),
	'hide_comments_link'   => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Hide comments link?', 'btp_theme'),
		)
	),
	'hide_categories'   => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Hide categories?', 'btp_theme'),
		)
	),
	'hide_tags'   => array(
		'model'		=> array(			
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Hide tags?', 'btp_theme'),
		)
	),
	'hide_summary'   => array(
		'model'		=> array(			
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Hide summary?', 'btp_theme'),
		)
	),
	'hide_button_1'   => array(
		'model'		=> array(			
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Hide primary button?', 'btp_theme'),
		)
	),	
	'hide_button_2'   => array(
		'model'		=> array(			
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Hide secondary button?', 'btp_theme'),
		)
	),
	'hide_button_3'   => array(
		'model'		=> array(			
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Hide tertiary button?', 'btp_theme'),
		)
	),
);

function btp_work_category_edit_form_fields($term){
	global $btp_work_archive_options;
	btp_render_tt_options_panel($term, array(
		'id' 		=> 'btp_work_archive_options',
		'taxonomy' 	=> 'btp_work_category',
		'args' 		=> array('options' => $btp_work_archive_options)	
	));	
}
function btp_work_tag_edit_form_fields($term){
	global $btp_work_archive_options;
	btp_render_tt_options_panel($term, array(
		'id' 		=> 'btp_work_archive_options',
		'taxonomy' 	=> 'btp_work_tag',
		'args' 		=> array('options' => $btp_work_archive_options)	
	));	
}
function btp_work_category_edited_term_taxonomy($tt_id){
	global $btp_work_archive_options;
	btp_save_tt_options_panel($tt_id, array(
		'id' 		=> 'btp_work_archive_options',
		'taxonomy'	=> 'btp_work_category',
		'args' 		=> array('options' => $btp_work_archive_options)	
	));	
}
function btp_work_tag_edited_term_taxonomy($tt_id){
	global $btp_work_archive_options;
	btp_save_tt_options_panel($tt_id, array(
		'id' 		=> 'btp_work_archive_options',
		'taxonomy'	=> 'btp_work_tag',
		'args' 		=> array('options' => $btp_work_archive_options)	
	));	
}






/**
 * Returns available templates for single work page. 
 */
function btp_get_work_single_templates()
{
	return array(
		'full-width-1'		=> __('Full-width 1', 'btp_theme'),
		'full-width-2'		=> __('Full-width 2', 'btp_theme'),
		'sidebar-left'		=> __('Sidebar on left', 'btp_theme'),
		'sidebar-right'		=> __('Sidebar on right', 'btp_theme'),
	);
}

/**
 * Returns available templates for work collection (used by shortcodes, widgets). 
 */
function btp_get_work_collection_templates() {
	return array(				
		'c-3'				=> __('c-3', 'btp_theme'),
		'c-4'				=> __('c-4', 'btp_theme'),
		'c-6'				=> __('c-6', 'btp_theme'),
		'list-c-1'			=> __('list-c-1', 'btp_theme'),
		'list-c-4'			=> __('list-c-4', 'btp_theme'),
		'list-c-6'			=> __('list-c-6', 'btp_theme'),
		'list-c-8'			=> __('list-c-8', 'btp_theme'),
	);	
}
	
/**
 * Returns available templates for work archive.
 */
function btp_get_work_archive_templates() {
	return array_merge(
		btp_get_work_collection_templates(),
		array()
	);
}


/**
 * Composes an array of visible elements on work index page.
 */
function btp_get_work_index_hidden_elements() {
	$result = array();
	$elements = array('title', 'thumb', 'date', 'comments_link', 'categories', 'tags', 'summary', 'button_1', 'button_2', 'button_3');
	
	foreach ( $elements as $key => $value )
		$result[$value] = (bool) btp_get_theme_option('work_index_hide_'.$value);		
	
	$result = array_filter($result);
	
	return $result;
}


/**
 * Composes an array of visible elements on work archive pages.
 */
function btp_get_work_archive_hidden_elements() {
	$result = array();
	$elements = array('title', 'thumb', 'date', 'comments_link', 'categories', 'tags', 'summary', 'button_1', 'button_2', 'button_3');
	
	if(is_archive()) {
		
		foreach ( $elements as $key => $value )
			$result[$value] = (bool) btp_get_theme_option('work_archive_hide_'.$value);
		
		$taxonomy_slug = get_query_var('taxonomy');
 		if ( $taxonomy_slug == 'btp_work_category' || $taxonomy_slug == 'btp_work_tag' ) {
 			$term_slug = get_query_var('term');
 			
 			if($term_slug) {
			
				if($taxonomy_slug == 'btp_work_category')					 	
			 		$term = get_term_by( 'slug', $term_slug, 'btp_work_category');
			 	else	
			 		$term = get_term_by( 'slug', $term_slug, 'btp_work_tag');
		 		
	 			foreach ( $elements as $key => $value ) {
					$t = btp_get_tt_option($term->term_taxonomy_id, 'hide_'.$value);
					if ( strlen($t) )
						$result[$value] = btp_bool($t);	
				}	
			}
 		}		
	}
	
	$result = array_filter($result);
	
	return $result;
}


/**
 * Composes an array of visible elements on single work page.
 */
function btp_get_work_single_hidden_elements() {
	global $post;
	
	$result = array();
	$elements = array('title', 'date', 'comments_link', 'categories', 'tags', 'button_2', 'button_3');
		
	foreach ( $elements as $key => $value )
		$result[$value] = (bool) btp_get_theme_option('work_single_hide_'.$value);
	
			
	foreach ( $elements as $key => $value ) {		
		$t = get_post_meta($post->ID, '_btp_hide_'.$value, true);
		if ( strlen($t) )
			$result[$value] = btp_bool($t);	
	}

	/* Remove false values */
	$result = array_filter($result);
	
	return $result;
}




/**
 * Fixes work archive query, so that it takes into account some theme options
 * 
 * This function is called by parse query hook.
 * @param $query
 */
function btp_fix_work_archive_query( $query ) {

	if( is_tax( 'btp_work_category' ) || is_tax( 'btp_work_tag' ) ) {
		
		$result = null;
		$posts_per_page = btp_get_theme_option('work_archive_posts_per_page');		
		if ( is_numeric($posts_per_page) )
			$result = $posts_per_page;
		
		$posts_per_page =  btp_get_tt_option($query->get_queried_object()->term_taxonomy_id, 'posts_per_page');
		if ( is_numeric($posts_per_page) )
			$result = $posts_per_page;
		
		if($result)	
			$query->set('posts_per_page', $result);
						
		remove_action('parse_query', 'btp_fix_work_archive_query');
	}
}
/**
 * Fixes CSS classes in custom navigation menus.
 * 
 * @param array $classes
 * @param object $item
 */
function btp_fix_work_nav_menu_css_class($classes, $item) 
{
	/* Highlight work page when displaying single work */
	if ( get_post_type() == 'btp_work' ) {
		if($item->object_id == get_option('page_for_posts'))
			foreach($classes as $k => $v)
				if ($v=='current_page_parent') 
					unset($classes[$k]);
		
		$page_for_works = (int) btp_get_theme_option('work_index_page');
		if ( $page_for_works ) {
			if($item->object_id == $page_for_works)
				$classes[] = 'current_page_parent';
		}
		
	}
					
	return $classes;
}

/**
 * taxonomy_template filter to determine template for btp_work_category, btp_work_tag.
 * 
 * @param string $template
 */
function btp_work_taxonomy_template($template){
	$taxonomy_slug = get_query_var('taxonomy'); 

 	if ( $taxonomy_slug == 'btp_work_category' || $taxonomy_slug == 'btp_work_tag' ) {
 		
 		$templates = array();
 	
		$term_slug = get_query_var('term');
		
		if($term_slug) {
			
			if($taxonomy_slug == 'btp_work_category')					 	
		 		$term = get_term_by( 'slug', $term_slug, 'btp_work_category');
		 	else	
		 		$term = get_term_by( 'slug', $term_slug, 'btp_work_tag');
		 		
		 	if( $term ){
		 		$term_template = btp_get_tt_option($term->term_taxonomy_id, 'template');
		 		if ( !empty($term_template) )	
		 			$templates[] = "works-$term_template.php";
		 	}
		}
		 	
		$archive_template = btp_get_theme_option('work_archive_template');
		if ( !empty($archive_template) )
			$templates[] = "works-$archive_template.php";	 
		  
		$new_template = locate_template($templates);
		 
		if ( !empty($new_template) )
			return $new_template;	
 	}
 	
 	return $template;
}
add_filter('taxonomy_template', 'btp_work_taxonomy_template');



/**
 * Determines template for single work page with single_template filter.
 * 
 * @param string $template
 */
function btp_work_single_template($template) {
	global $post;
	
	if ( get_post_type() == 'btp_work' ) {
		$templates = array();
		
		/* Single work options */
		$temp = get_post_meta($post->ID, '_btp_template', true);
		if( !empty( $temp ) )
			$templates[] = "single-work-$temp.php";
		
		/* General options */
		$temp = btp_get_theme_option('work_single_template');
		if ( !empty( $temp ) )
			$templates[] = "single-work-$temp.php";
			
		$new_template = locate_template($templates);
		 
		if ( !empty( $new_template ) )
			return $new_template;		
	}
	
	return $template;
}





/* Customize appearance of work listing page (admin panel). 
 * Add/remove some columns */
function btp_work_edit_columns($columns){		
	$columns['btp_work_categories'] 	= __('Work Categories', 'btp_theme');
	$columns['btp_work_tags'] 			= __('Work Tags', 'btp_theme');
	$columns['btp_work_featured_image'] = __('Featured Image', 'btp_theme');
	
	
	return $columns;
}
 
/* Customize appearance of work listing page (admin panel). 
 * Render columns */
function btp_work_columns_display($column_name){
	global $post;
	
	switch ( $column_name ) {
		case 'btp_work_categories':
			echo get_the_term_list( $post->ID, 'btp_work_category', '<p>', ',', '</p>' );
			break;
						
		case 'btp_work_tags':
			echo get_the_term_list( $post->ID, 'btp_work_tag', '<p>', ',', '</p>' );
			break;	
		
		case 'btp_work_featured_image':
			the_post_thumbnail('c-1');
			break;
									
		default:	
			return;
			break;	
	}
}











if ( ! function_exists( 'btp_the_work_title' ) ) :
/**
 * Prints HTML with title based on title linking method for the current work.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_work_title( $before = '<h3>', $after = '</h3>' ) {
	btp_the_title( $before, $after );
}
endif;


if ( ! function_exists( 'btp_the_work_thumb' ) ) :
/**
 * Prints HTML with thumb based on thumb linking method for the current work.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_work_thumb( $size, $placeholder = true ) {
	btp_the_thumb( $size, $placeholder );
}
endif;

if ( ! function_exists( 'btp_the_work_summary' ) ) :
/**
 * Prints HTML with summary for the current work.
 * 
 * @since DICE Theme 1.0
 */	
function btp_the_work_summary() {
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
    <?php   
}
endif;

if ( ! function_exists( 'btp_the_work_date' ) ) :
/**
 * Prints HTML with date for the current work.
 * 
 * @since DICE Theme 1.0
 */   	
function btp_the_work_date() {
   ?>
    <span class="entry-date"><?php the_time('F Y'); ?>, </span>
    <?php 
}
endif;

if ( ! function_exists( 'btp_the_work_comments_link' ) ) :
/**
 * Prints HTML with comments link for the current work.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_work_comments_link() {
   	?>
    <span class="entry-comments-link">
    	<?php 
    		comments_popup_link(__('Leave a comment', 'btp_theme'), 
    							__('1 Comment', 'btp_theme'), 
    							__('% Comments', 'btp_theme'),
    							'',
    							__('Comments are off', 'btp_theme')
    		); 
    	?>
    </span>
    <?php 
}
endif;

if ( ! function_exists( 'btp_the_work_categories' ) ) :
/**
 * Prints HTML with category list for the current work.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_work_categories(){
	global $post;
	?>
	<div class="work-categories">
		<h6><?php _e('Categories', 'btp_theme'); ?></h6>
		<?php echo get_the_term_list( $post->ID, 'btp_work_category', '<ul><li>', ',</li><li>', '</li></ul>' ); ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'btp_the_work_tags' ) ) :
/**
 * Prints HTML with tag list for the current work.
 * 
 * @since DICE Theme 1.0
 */	
function btp_the_work_tags(){
	global $post;
	?>
	<div class="work-tags">
		<h6><?php _e('Tags', 'btp_theme'); ?></h6>
		<?php echo get_the_term_list( $post->ID, 'btp_work_tag', '<ul><li>', ',</li><li>', '</li></ul>' ); ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'btp_the_work_primary_button' ) ) :
/**
 * Prints HTML with primary button for the current work.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_work_primary_button( $priority = 'primary', $size = 'small', $wide = false ) {	
	return btp_the_primary_button( $priority, $size, $wide );
}
endif;

if ( ! function_exists( 'btp_the_work_secondary_button' ) ) :
/**
 * Prints HTML with secondary button for the current work.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_work_secondary_button( $priority = 'secondary', $size = 'small', $wide = false ) {
	return btp_the_secondary_button( $priority, $size, $wide );	
}
endif;

if ( ! function_exists( 'btp_the_work_tertiary_button' ) ) :
/**
 * Prints HTML with tertiary button for the current work.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_work_tertiary_button( $priority = 'tertiary', $size = 'small', $wide = false ) {
	return btp_the_tertiary_button( $priority, $size, $wide );	
}
endif;

?>