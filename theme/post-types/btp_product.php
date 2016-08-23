<?php

function btp_init_product_post_type() {
	register_post_type('btp_product',
		array(
			'label'		=> __('Products', 'btp_theme'),
			'labels'	=> array(
				'name'					=> __('Products', 'btp_theme'),
				'singular_name' 		=> __('Product', 'btp_theme'),
				'add_new'				=> __('Add New Product', 'btp_theme'),
				'add_new_item' 			=> __('Add New Product', 'btp_theme'),
				'edit_item'				=> __('Edit Product', 'btp_theme'),
				'new_item'				=> __('New Product', 'btp_theme'),
				'view_item'				=> __('View Product', 'btp_theme'),
				'search_items'			=> __('Search Product', 'btp_theme'),
				'not_found'				=> __('No Products found', 'btp_theme'),
				'not_found_in_trash'	=> __('No Products found in Trash', 'btp_theme'),				
			),
		
			'public'		=> true,
			'query_var'		=> 'btp_product',
			'supports'		=> array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'comments', 'revisions'),
			'rewrite'		=> array('slug' => 'product', 'with_front' => true)
		)	
	);	
	
	register_taxonomy(  
    	'btp_product_category',  
     	array('btp_product'),  
     	array(     		
     	  	'hierarchical' 			=> true,  
        	'label' 				=> __('Product Category', 'btp_theme'),
     		'labels'				=> array(
     			'name' 					=> __( 'Product Categories', 'btp_theme' ),
    			'singular_name' 		=> __( 'Product Category', 'btp_theme' ),
    			'search_items' 			=> __( 'Search Product Categories', 'btp_theme' ),
    			'all_items' 			=> __( 'All Product Categories', 'btp_theme' ),
    			'parent_item' 			=> __( 'Parent Product Category', 'btp_theme' ),
    			'parent_item_colon' 	=> __( 'Parent Product Category:', 'btp_theme' ),
    			'edit_item' 			=> __( 'Edit Product Category', 'btp_theme' ), 
    			'update_item' 			=> __( 'Update Product Category', 'btp_theme' ),
    			'add_new_item' 			=> __( 'Add New Product Category', 'btp_theme' ),
    			'new_item_name' 		=> __( 'New Product Category', 'btp_theme' ),
     					
     		),  
         	'query_var' 			=> true,  
            'rewrite' 				=> array('slug' => 'product-category', 'with_front' => true),
     		'show_in_nav_menus'		=> true
     		
     	)  
 	);
 	
 	register_taxonomy(  
    	'btp_product_tag',  
     	array('btp_product'),  
     	array(     		
     	  	'hierarchical' 			=> false,  
        	'label' 				=> __('Product Tag', 'btp_theme'),
     		'labels'				=> array(
     			'name' 					=> __( 'Product Tags', 'btp_theme' ),
    			'singular_name' 		=> __( 'Product Tag', 'btp_theme' ),
    			'search_items' 			=> __( 'Search Product Tags', 'btp_theme' ),
    			'all_items' 			=> __( 'All Product Tags', 'btp_theme' ),
    			'parent_item' 			=> __( 'Parent Product Tag', 'btp_theme' ),
    			'parent_item_colon' 	=> __( 'Parent Product Tag:', 'btp_theme' ),
    			'edit_item' 			=> __( 'Edit Product Tag', 'btp_theme' ), 
    			'update_item' 			=> __( 'Update Product Tag', 'btp_theme' ),
    			'add_new_item' 			=> __( 'Add New Product Tag', 'btp_theme' ),
    			'new_item_name' 		=> __( 'New Product Tag', 'btp_theme' ),
     					
     		),  
         	'query_var' 			=> 'product_tag',  
            'rewrite' 				=> array('slug' => 'product_tag'),
     		'show_in_nav_menus'		=> true
     		
     	)  
 	);
 	
 	/* Add Custom Write Panels to Slide Edit Page */
 	add_action('admin_menu', 'btp_add_product_details_meta_box');
 	add_action('save_post', 'btp_save_product_details_meta_box');
 	
 	add_action('admin_menu', 'btp_add_product_precontent_options_meta_box');
 	add_action('save_post', 'btp_save_product_precontent_options_meta_box');
 	
 	add_action('admin_menu', 'btp_add_product_single_options_meta_box');
 	add_action('save_post', 'btp_save_product_single_options_meta_box');
 	
 	
 	/* Add Custom Write Panels to Product Category Edit Page */
 	add_action('btp_product_category_edit_form_fields', 'btp_product_category_edit_form_fields');
	add_action( 'edited_term_taxonomy', 'btp_product_category_edited_term_taxonomy' );
	
	
	/* Add Custom Write Panels to Product Tag Page */
	add_action('btp_product_tag_edit_form_fields', 'btp_product_tag_edit_form_fields');
	add_action( 'edited_term_taxonomy', 'btp_product_tag_edited_term_taxonomy' );
	 	
 	
 	/* Customize appearance of product listing page (admin panel) */
 	add_filter('manage_btp_product_posts_columns', 'btp_edit_product_columns');
	add_action('manage_posts_custom_column',  'btp_display_product_columns'); 	
}

$btp_product_details_meta_box = array(
   	'_btp_price'    => array(
		'model'		=> array(
		),
		'view'		=> array(
			'render_func'	=> 'input_text',
			'label'			=> __('Price', 'btp_theme')		
		)
	),
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

$btp_product_single_options_meta_box = array(
	'_btp_template'    => array(
		'model'		=> array(
			'null'			=> '',
			'options'		=> 'btp_get_product_single_templates',
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
	'_btp_hide_price' => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'     		=> __('Hide price?', 'btp_theme'),
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

function btp_add_product_details_meta_box() {
    global $btp_product_details_meta_box;     
    add_meta_box(
    	'btp_product_details_meta_box', 								//id
    	__('Product Details', 'btp_theme'), 							//title
    	'btp_render_meta_box', 											//callback function 
    	'btp_product', 													//post_type
       	'normal', 														//context 
    	'high', 														//priority
    	array('options' => $btp_product_details_meta_box)				//callback arguments
    );
}

function btp_add_product_precontent_options_meta_box() {     
	global $btp_precontent_options_meta_box;     
    add_meta_box(
    	'btp_precontent_options_meta_box', 								//id
    	__('Precontent Options', 'btp_theme'),						//title
    	'btp_render_meta_box',											//callback function 
    	'btp_product',			 										//post_type
       	'normal', 														//context 
    	'high',															//priority
    	array('options'	=> $btp_precontent_options_meta_box)			//callback arguments
    );
}

function btp_add_product_single_options_meta_box() {     
	global $btp_product_single_options_meta_box;     
    add_meta_box(
    	'btp_product_single_options_meta_box', 							//id
    	__('Single Page Options', 'btp_theme'),							//title
    	'btp_render_meta_box',											//callback function 
    	'btp_product',			 										//post_type
       	'normal', 														//context 
    	'high',															//priority
    	array('options'	=> $btp_product_single_options_meta_box)				//callback arguments
    );
}

/* Save data from 'Product Details' meta box */
function btp_save_product_details_meta_box($post_ID) {     
	global $btp_product_details_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 				=> 'btp_product_details_meta_box', 
		'options' 			=> $btp_product_details_meta_box,
		'post_type'			=> 'btp_product'
	));
}

/* Save data from 'Precontent Options' meta box */
function btp_save_product_precontent_options_meta_box($post_ID) {     
	global $btp_precontent_options_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 				=> 'btp_precontent_options_meta_box', 
		'options' 			=> $btp_precontent_options_meta_box,
		'post_type'			=> 'btp_product'
	));
}

/* Save data from 'Single Page Options' meta box */
function btp_save_product_single_options_meta_box($post_ID) {     
	global $btp_product_single_options_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 				=> 'btp_product_single_options_meta_box', 
		'options' 			=> $btp_product_single_options_meta_box,
		'post_type'			=> 'btp_product'
	));
}





$btp_product_archive_options = array(
	'template'   => array(
		'model'		=> array(
			'null'			=> '',
			'options'		=> 'btp_get_product_archive_templates'			
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
			'label'     	=> __('Products per page', 'btp_theme'),
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
	'hide_price'   => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'	=> 'select',
			'label'     	=> __('Hide price?', 'btp_theme'),
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

function btp_product_category_edit_form_fields($term){
	global $btp_product_archive_options;
	btp_render_tt_options_panel($term, array(
		'id' 		=> 'btp_product_archive_options',
		'taxonomy'	=> 'btp_product_category',
		'args' 		=> array('options' => $btp_product_archive_options)	
	));	
}
function btp_product_tag_edit_form_fields($term){
	global $btp_product_archive_options;
	btp_render_tt_options_panel($term, array(
		'id' 		=> 'btp_product_archive_options',
		'taxonomy'	=> 'btp_product_tag',
		'args' 		=> array('options' => $btp_product_archive_options)	
	));	
}
function btp_product_category_edited_term_taxonomy($tt_id){	
	global $btp_product_archive_options;
	btp_save_tt_options_panel($tt_id, array(
		'id' 		=> 'btp_product_archive_options',
		'taxonomy'	=> 'btp_product_category',
		'args' 		=> array('options' => $btp_product_archive_options)	
	));	
}
function btp_product_tag_edited_term_taxonomy($tt_id){
	global $btp_product_archive_options;
	btp_save_tt_options_panel($tt_id, array(
		'id' 		=> 'btp_product_archive_options',
		'taxonomy'	=> 'btp_product_tag',
		'args' 		=> array('options' => $btp_product_archive_options)	
	));	
}








/* 
 * Returns available templates for single product page.
 */
function btp_get_product_single_templates()
{
	return array(
		'full-width-1'		=> __('Full-width 1', 'btp_theme'),
		'full-width-2'		=> __('Full-width 2', 'btp_theme'),
	);
}

/* 
 * Returns available templates for product collection (used by shortcodes, widgets). 
 */
function btp_get_product_collection_templates()
{
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
	
/* 
 * Returns available templates for work archive. 
 */
function btp_get_product_archive_templates() {
	return array_merge(
		btp_get_product_collection_templates(),
		array()
	);
}


/**
 * Composes an array of visible elements on product index page.
 */
function btp_get_product_index_hidden_elements() {
	$result = array();
	$elements = array('title', 'thumb', 'price', 'comments_link', 'categories', 'tags', 'summary', 'button_1', 'button_2', 'button_3');
		
	foreach ( $elements as $key => $value )
		$result[$value] = (bool) btp_get_theme_option('product_index_hide_'.$value);		
	
	$result = array_filter($result);
	
	return $result;
}

/**
 * Composes an array of visible elements on product archive pages.
 */
function btp_get_product_archive_hidden_elements() {
	$result = array();
	$elements = array('title', 'thumb', 'price', 'comments_link', 'categories', 'tags', 'summary', 'button_1', 'button_2', 'button_3');
	
	if(is_archive()) {
		foreach ( $elements as $key => $value )
			$result[$value] = (bool) btp_get_theme_option('product_archive_hide_'.$value);
		
		$taxonomy_slug = get_query_var('taxonomy');
 		if ( $taxonomy_slug == 'btp_product_category' || $taxonomy_slug == 'btp_product_tag' ) {
 			$term_slug = get_query_var('term');
 			
 			if($term_slug) {
			
				if($taxonomy_slug == 'btp_product_category')					 	
			 		$term = get_term_by( 'slug', $term_slug, 'btp_product_category');
			 	else	
			 		$term = get_term_by( 'slug', $term_slug, 'btp_product_tag');
		 		
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
 * Composes an array of visible elements on single product page.
 */
function btp_get_product_single_hidden_elements() {
	global $post;
	
	$result = array();
	$elements = array('title', 'price', 'comments_link', 'categories', 'tags', 'button_2', 'button_3');
		
	foreach ( $elements as $key => $value )
		$result[$value] = (bool) btp_get_theme_option('product_single_hide_'.$value);
			
	foreach ( $elements as $key => $value ) {		
		$t = get_post_meta($post->ID, '_btp_hide_'.$value, true);
		
		if ( strlen($t) ) {			
			$result[$value] = btp_bool($t);
		}		
	}
	
	

	/* Remove false values */
	$result = array_filter($result);
	
	return $result;
}

/**
 * Fixes product archive query, so that it takes into account some theme options
 * 
 * This function is called by parse query hook.
 * @param $query
 */
function btp_fix_product_archive_query( $query ){
	
	if( is_tax( 'btp_product_category' ) || is_tax( 'btp_product_tag' ) ) {
		
		$result = null;
		$posts_per_page = btp_get_theme_option('product_archive_posts_per_page');
		if ( is_numeric($posts_per_page) )
			$result = $posts_per_page;
			
		$posts_per_page =  btp_get_tt_option($query->get_queried_object()->term_taxonomy_id, 'posts_per_page');
		if ( is_numeric($posts_per_page) )
			$result = $posts_per_page;
		
		if($result)	
			$query->set('posts_per_page', $result);
						
		remove_action('parse_query', 'btp_fix_product_archive_query');
	}	
}

/**
 * Fixes CSS classes in custom navigation menus.
 * 
 * @param array $classes
 * @param object $item
 */
function btp_fix_product_nav_menu_css_class($classes, $item) 
{
	
	/* Highlight product page when displaying single product */
	if ( get_post_type() == 'btp_product' ) {
		if($item->object_id == get_option('page_for_posts'))
			foreach($classes as $k => $v)
				if ($v=='current_page_parent') 
					unset($classes[$k]);
		
		$page_for_products = (int) btp_get_theme_option('product_index_page');
		if ( $page_for_products ) {
			if($item->object_id == $page_for_products)
				$classes[] = 'current_page_parent';
		}
		
	}
					
	return $classes;
}

/**
 * taxonomy_template filter to determine template for btp_product_category, btp_product_tag.
 * 
 * @param string $template
 */
function btp_product_taxonomy_template($template){
	$taxonomy_slug = get_query_var('taxonomy'); 	

 	if ( $taxonomy_slug == 'btp_product_category' || $taxonomy_slug == 'btp_product_tag' ) {
 		
 		$templates = array();
 	
		$term_slug = get_query_var('term');
		 
		if($term_slug) {
			
			if($taxonomy_slug == 'btp_product_category')					 	
		 		$term = get_term_by( 'slug', $term_slug, 'btp_product_category');
		 	else	
		 		$term = get_term_by( 'slug', $term_slug, 'btp_product_tag');

		 	if( $term ){
		 		$term_template = btp_get_tt_option($term->term_taxonomy_id, 'template');
		 		if ( !empty($term_template) )	
		 			$templates[] = "products-$term_template.php";
		 	}
		}
		 	
		$archive_template = btp_get_theme_option('product_archive_template');
		
		if ( !empty($archive_template) )
			$templates[] = "products-$archive_template.php";	 
		  
		$new_template = locate_template($templates);
		 
		if ( !empty($new_template) )
			return $new_template;	
 	}
 	
 	return $template;
}
add_filter('taxonomy_template', 'btp_product_taxonomy_template');




/**
 * Determines template for single product page with single_template filter.
 * 
 * @param string $template
 */
function btp_product_single_template($template) {
	global $post;	
	if ( get_post_type() == 'btp_product' ) {		
		
		$templates = array();
		
		/* Single product options */
		$temp = get_post_meta($post->ID, '_btp_template', true);		
		if( !empty( $temp ) )
			$templates[] = "single-product-$temp.php";
		
		/* General options */
		$temp = btp_get_theme_option('product_single_template');
		if ( !empty( $temp ) )
			$templates[] = "single-product-$temp.php";
			
		$new_template = locate_template($templates);
				
		if ( !empty( $new_template ) )
			return $new_template;		
	}
	
	return $template;
}




/* Customize appearance of work listing page (admin panel). 
 * Add/remove some columns */
function btp_edit_product_columns($columns){		
	$columns['btp_product_categories'] 		= __('Product Categories', 'btp_theme');
	$columns['btp_product_tags'] 			= __('Product Tags', 'btp_theme');
	$columns['btp_product_featured_image'] 	= __('Featured Image', 'btp_theme');
	
	
	return $columns;
}


/* Customize appearance of product listing page (admin panel). 
 * Add/remove some columns */
function btp_display_product_columns($column_name){
	global $post;
	
	switch ( $column_name ) {
		case 'btp_product_categories':
			echo get_the_term_list( $post->ID, 'btp_product_category', '<p>', ',', '</p>' );
			break;
						
		case 'btp_product_tags':
			echo get_the_term_list( $post->ID, 'btp_product_tag', '<p>', ',', '</p>' );
			break;	
		
		case 'btp_product_featured_image':
			the_post_thumbnail('c-1');
			break;
									
		default:	
			return;
			break;	
	}
}









if ( ! function_exists( 'btp_the_product_title' ) ) :
/**
 * Prints HTML with title based on title linking method for the current product.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_product_title( $before = '<h3>', $after = '</h3>' ) {
	btp_the_title( $before, $after );
}
endif;

if ( ! function_exists( 'btp_the_product_thumb' ) ) :
/**
 * Prints HTML with thumb based on thumb linking method for the current product.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_product_thumb($size, $placeholder = true ) {
	btp_the_thumb( $size, $placeholder );
}
endif;

if ( ! function_exists( 'btp_the_product_comments_link' ) ) :
/**
 * Prints HTML with comments link for the current product.
 * 
 * @since DICE Theme 1.0
 */   	
function btp_the_product_comments_link() {
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

if ( ! function_exists( 'btp_the_product_summary' ) ) :
/**
 * Prints HTML with summary for the current product.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_product_summary() { 
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
    <?php   
}
endif;

if ( ! function_exists( 'btp_the_product_categories' ) ) :
/**
 * Prints HTML with category list for the current product.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_product_categories(){
	global $post;
	?>
	<div class="product-categories">
		<h6><?php _e('Categories', 'btp_theme'); ?></h6>
		<?php echo get_the_term_list( $post->ID, 'btp_product_category', '<ul><li>', ',</li><li>', '</li></ul>' ); ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'btp_the_product_tags' ) ) :
/**
 * Prints HTML with tag list for the current product.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_product_tags(){
	global $post;
	?>
	<div class="product-tags">
		<h6><?php _e('Tags', 'btp_theme'); ?></h6>
		<?php echo get_the_term_list( $post->ID, 'btp_product_tag', '<ul><li>', ',</li><li>', '</li></ul>' ); ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'btp_the_product_primary_button' ) ) :
/**
 * Prints HTML with primary button for the current product.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_product_primary_button( $priority = 'primary', $size = 'small', $wide = false ) {	
	return btp_the_primary_button( $priority, $size, $wide );
}
endif;


if ( ! function_exists( 'btp_the_product_secondary_button' ) ) :
/**
 * Prints HTML with secondary button for the current product.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_product_secondary_button( $priority = 'secondary', $size = 'small', $wide = false ) {
	return btp_the_secondary_button($priority, $size, $wide);	
}
endif;

if ( ! function_exists( 'btp_the_product_tertiary_button' ) ) :
/**
 * Prints HTML with tertiary button for the current product.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_product_tertiary_button( $priority = 'tertiary', $size = 'small', $wide = false ) {
	return btp_the_tertiary_button($priority, $size, $wide);	
}
endif;
?>