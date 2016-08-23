<?php

function btp_init_page_post_type() {
	
	add_post_type_support('page', 'excerpt');
	
	/* Add Custom Write Panels to Page Edit Page */
	add_action('admin_menu', 'btp_add_page_details_meta_box');
 	add_action('save_post', 'btp_save_page_details_meta_box');
	
	add_action('admin_menu', 'btp_add_page_precontent_options_meta_box');
	add_action('save_post', 'btp_save_page_precontent_options_meta_box');
	add_action('admin_menu', 'btp_add_page_single_options_meta_box');
	add_action('save_post', 'btp_save_page_single_options_meta_box');
}

$btp_page_details_meta_box = array(
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
);

$btp_page_single_options_meta_box = array(	
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
	'_btp_hide_breadcrumbs' => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'		=> 'input_checkbox',
			'label'				=> __('Hide breadcrumbs', 'btp_theme'),	
		)		
	),	
	'_btp_hide_title' => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'		=> 'input_checkbox',
			'label'				=> __('Hide title', 'btp_theme'),	
		)		
	),
	'_btp_page_intro' => array(
		'model'		=> array(	
		),
		'view'		=> array(
			'render_func'		=> 'input_text',
			'label'				=> __('Page intro', 'btp_theme'),	
		)		
	),
);

function btp_add_page_details_meta_box() {
    global $btp_page_details_meta_box;     
    add_meta_box(
    	'btp_page_details_meta_box', 								//id
    	__('Page Details', 'btp_theme'), 							//title
    	'btp_render_meta_box',									 	//callback function 
    	'page',		 												//post_type
       	'normal', 													//context 
    	'high', 													//priority
    	array('options' => $btp_page_details_meta_box)				//callback arguments
    );
}

function btp_add_page_precontent_options_meta_box() {     
	global $btp_precontent_options_meta_box;     
    add_meta_box(
    	'btp_precontent_options_meta_box', 							//id
    	__('Precontent Options', 'btp_theme'),					//title
    	'btp_render_meta_box',										//callback function 
    	'page',			 											//post_type
       	'normal', 													//context 
    	'high',														//priority
    	array('options'	=> $btp_precontent_options_meta_box)		//callback arguments
    );
}

function btp_add_page_single_options_meta_box() { 
	global $btp_page_single_options_meta_box;       
    add_meta_box(
    	'btp_page_single_options_meta_box', 						//id
    	__('Single Page Options', 'btp_theme'),						//title
    	'btp_render_meta_box',										//callback function 
    	'page', 													//post_type
       	'normal', 													//context 
    	'high', 													//priority
    	array('options' => $btp_page_single_options_meta_box)		//calback arguments
    );
}
/* Save data from 'Page Details' meta box */
function btp_save_page_details_meta_box($post_ID) {     
	global $btp_page_details_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 			=> 'btp_page_details_meta_box', 
		'options' 		=> $btp_page_details_meta_box,
		'post_type'		=> 'page'
	));
}

/* Save data from 'Precontent Options' meta box */
function btp_save_page_precontent_options_meta_box($post_ID) {     
	global $btp_precontent_options_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 				=> 'btp_precontent_options_meta_box', 
		'options' 			=> $btp_precontent_options_meta_box,
		'post_type'			=> 'page'
	));
}

/* Save data from 'Content Options' meta box */
function btp_save_page_single_options_meta_box($post_ID) {     
	global $btp_page_single_options_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 				=> 'btp_page_single_options_meta_box', 
		'options' 			=> $btp_page_single_options_meta_box,
		'post_type'			=> 'page'
	));
}


/**
 * Returns available templates for page collection (used by shortcodes, widgets). 
 */
function btp_get_page_collection_templates() {
	return array(
		'list-c-1'			=> __('list-c-1', 'btp_theme'),
		'c-3'				=> __('c-3', 'btp_theme'),
		'c-4'				=> __('c-4','btp_theme'),
	);	
}




if ( ! function_exists( 'btp_the_page_title' ) ) :
/**
 * Prints HTML with title for the current page.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_page_title( $before = '<h3>', $after = '</h3>' ) {
   btp_the_title( $before, $after );
}
endif;

if ( ! function_exists( 'btp_the_page_thumb' ) ) :
/**
 * Prints HTML with thumb for the current page.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_page_thumb( $size, $placeholder = true ) {
	btp_the_thumb( $size, $placeholder );
}
endif;


if ( ! function_exists( 'btp_the_page_summary' ) ) :
/**
 * Prints HTML with summary for the current page.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_page_summary() {
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
    <?php   
}
endif;


if ( ! function_exists( 'btp_the_page_primary_button' ) ) :
/**
 * Prints HTML with primary button for the current page.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_page_primary_button( $priority = 'primary', $size = 'small', $wide = false ) {	
	return btp_the_primary_button( $priority, $size, $wide );
}
endif;

?>