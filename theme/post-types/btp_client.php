<?php

function btp_init_client_post_type() {
	register_post_type( 'btp_client',
		array(
			'label'		=> __( 'Clients', 'btp_theme' ),
			'labels'	=> array(
				'name'					=> __( 'Clients', 'btp_theme' ),
				'singular_name' 		=> __( 'Client', 'btp_theme' ),
				'add_new'				=> __( 'Add New Client', 'btp_theme' ),
				'add_new_item' 			=> __( 'Add New Client', 'btp_theme' ),
				'edit_item'				=> __( 'Edit Client', 'btp_theme' ),
				'new_item'				=> __( 'New Client', 'btp_theme' ),
				'view_item'				=> __( 'View Client', 'btp_theme' ),
				'search_items'			=> __( 'Search Client', 'btp_theme' ),
				'not_found'				=> __( 'No Clients found', 'btp_theme' ),
				'not_found_in_trash'	=> __( 'No Clients found in Trash', 'btp_theme' ),				
			),
		
			'public'		=> true,
			'query_var'		=> true,
			'supports'		=> array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'revisions' ),
			'rewrite'		=> array( 'slug' => 'client', 'with_front' => true )
		)	
	);
	
 	/* Add Custom Write Panels to Client Edit Page */
	add_action('admin_menu', 'btp_add_client_details_meta_box');
 	add_action('save_post', 'btp_save_client_details_meta_box');
	
 	add_action( 'admin_menu', 'btp_add_client_precontent_options_meta_box' );
 	add_action( 'save_post', 'btp_save_client_precontent_options_meta_box' );

 	add_action( 'admin_menu', 'btp_add_client_single_options_meta_box' );
 	add_action( 'save_post', 'btp_save_client_single_options_meta_box' );
 	
 	
 	/* Customize appearance of client listing page (admin panel) */
 	add_filter( 'manage_btp_client_posts_columns', 'btp_edit_client_columns' );
	add_action( 'manage_posts_custom_column',  'btp_display_client_columns' ); 	
}

$btp_client_details_meta_box = array(
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


$btp_client_single_options_meta_box = array(
	'_btp_template'    => array(
		'model'		=> array(
			'null'			=> '',
			'options'		=> 'btp_get_client_single_templates',
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
);
function btp_add_client_details_meta_box() {
    global $btp_client_details_meta_box;     
    add_meta_box(
    	'btp_client_details_meta_box', 								//id
    	__('Client Details', 'btp_theme'), 							//title
    	'btp_render_meta_box',									 	//callback function 
    	'btp_client', 												//post_type
       	'normal', 													//context 
    	'high', 													//priority
    	array('options' => $btp_client_details_meta_box)			//callback arguments
    );
}


function btp_add_client_precontent_options_meta_box() {	     
	global $btp_precontent_options_meta_box;     
    add_meta_box(
    	'btp_precontent_options_meta_box', 								//id
    	__( 'Precontent Options', 'btp_theme' ),						//title
    	'btp_render_meta_box',											//callback function 
    	'btp_client',			 										//post_type
       	'normal', 														//context 
    	'high',															//priority
    	array( 'options'	=> $btp_precontent_options_meta_box )		//callback arguments
    );
}
function btp_add_client_single_options_meta_box() {     
	global $btp_client_single_options_meta_box;
	
    add_meta_box(
    	'btp_client_single_options_meta_box', 							//id
    	__( 'Single Page Options', 'btp_theme' ),						//title
    	'btp_render_meta_box',											//callback function 
    	'btp_client',			 										//post_type
       	'normal', 														//context 
    	'high',															//priority
    	array( 'options'	=> $btp_client_single_options_meta_box )	//callback arguments
    );
}
/* Save data from 'Client Details' meta box */
function btp_save_client_details_meta_box($post_ID) {     
	global $btp_client_details_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 			=> 'btp_client_details_meta_box', 
		'options' 		=> $btp_client_details_meta_box,
		'post_type'		=> 'btp_client'
	));
}
/* Save data from 'Precontent Options' meta box */
function btp_save_client_precontent_options_meta_box( $post_ID ) {     
	global $btp_precontent_options_meta_box;     
	btp_save_meta_box( $post_ID, array(
		'id' 				=> 'btp_precontent_options_meta_box', 
		'options' 			=> $btp_precontent_options_meta_box,
		'post_type'			=> 'btp_client'
	) );
}

/* Save data from 'Content Options' meta box */
function btp_save_client_single_options_meta_box( $post_ID ) {     
	global $btp_client_single_options_meta_box;     
	btp_save_meta_box( $post_ID, array(
		'id' 				=> 'btp_client_single_options_meta_box', 
		'options' 			=> $btp_client_single_options_meta_box,
		'post_type'			=> 'btp_client'
	) );
} 



/* 
 * Returns available templates for client collection (used by shortcodes, widgets). 
 */
function btp_get_client_collection_templates()
{
	return array(		
		'c-2'				=> __( 'c-2', 'btp_theme' ),
		'c-3'				=> __( 'c-3','btp_theme' ),
		'c-4'				=> __( 'c-4','btp_theme' ),
	);
}
	
/* 
 * Returns available templates for single client page. 
 */
function btp_get_client_single_templates()
{
	return array(
		'sidebar-left'		=> __( 'Sidebar on left', 'btp_theme' ),	
		'sidebar-right'		=> __( 'Sidebar on right', 'btp_theme' ),
	);
}




/**
 * Composes an array of visible elements on client index page.
 */
function btp_get_client_index_hidden_elements() {
	$result = array();
	$elements = array('title', 'thumb', 'summary', 'button_1');
		
	foreach ( $elements as $key => $value )
		$result[$value] = (bool) btp_get_theme_option('client_index_hide_'.$value);		
	
	$result = array_filter($result);
	
	return $result;
}

/**
 * Composes an array of visible elements on single client page.
 */
function btp_get_client_single_hidden_elements() {
	global $post;
	
	$result = array();
	$elements = array( 'title' );
		
	foreach ( $elements as $key => $value )
		$result[$value] = (bool) btp_get_theme_option( 'client_single_hide_' . $value );
		
	foreach ( $elements as $key => $value ) {		
		$t = get_post_meta( $post->ID, '_btp_hide_' . $value, true );
		if ( strlen($t) )
			$result[$value] = btp_bool( $t );	
	}

	/* Remove false values */
	$result = array_filter( $result );
	
	return $result;
}



/**
 * Determines template for single client page with single_template filter.
 * 
 * @param string $template
 */
function btp_client_single_template( $template ) {
	global $post;
	
	if ( get_post_type() == 'btp_client' ) {
		$templates = array();
		
		/* Single client options */
		$temp = get_post_meta( $post->ID, '_btp_template', true );
		if ( !empty( $temp ) )
			$templates[] = "single-client-$temp.php";
		
		/* General options */
		$temp = btp_get_theme_option( 'client_single_template' );
		if ( !empty( $temp ) )
			$templates[] = "single-client-$temp.php";

		$new_template = locate_template( $templates );
		 
		if ( !empty( $new_template ) )
			return $new_template;		
	}
	
	return $template;
}



/**
 * Fixes CSS classes in custom navigation menus.
 * 
 * @param array $classes
 * @param object $item
 */
function btp_fix_client_nav_menu_css_class($classes, $item) 
{
	/* Highlight client page when displaying single client */
	if ( get_post_type() == 'btp_client' ) {
		if($item->object_id == get_option('page_for_posts'))
			foreach($classes as $k => $v)
				if ($v=='current_page_parent') 
					unset($classes[$k]);
		
		$page_for_clients = (int) btp_get_theme_option('client_index_page');
		if ( $page_for_clients ) {
			if($item->object_id == $page_for_clients)
				$classes[] = 'current_page_parent';
		}
		
	}
					
	return $classes;
}



/* Customize appearance of client listing page (admin panel). 
 * Add/remove some columns */
function btp_edit_client_columns( $columns ) {		
	$columns['btp_client_featured_image'] = __( 'Featured Image', 'btp_theme' );
	
	return $columns;
}
 
/* Customize appearance of client listing page (admin panel). 
 * Render columns */
function btp_display_client_columns( $column_name ) {
	if ( 'btp_client_featured_image' != $column_name )
		return;
		
	the_post_thumbnail( 'c-1' );
}






if ( ! function_exists( 'btp_the_client_title' ) ) :
/**
 * Prints HTML with title based on title linking method for the current client.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_client_title( $before = '<h3>', $after = '</h3>' ) {
	btp_the_title( $before, $after );
}
endif;

if ( ! function_exists( 'btp_the_client_thumb' ) ) :
/**
 * Prints HTML with thumb based on thumb linking method for the current client.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_client_thumb($size, $placeholder = true) {
	btp_the_thumb($size, $placeholder);
}
endif;

if ( ! function_exists( 'btp_the_client_summary' ) ) :
/**
 * Prints HTML with summary for the current client.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_client_summary() {
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
    <?php   
}
endif;




if ( ! function_exists( 'btp_the_client_primary_button' ) ) :
/**
 * Prints HTML with primary button for the current client.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_client_primary_button( $priority = 'primary', $size = 'small', $wide = false ) {	
	return btp_the_primary_button( $priority, $size, $wide );
}
endif;

?>