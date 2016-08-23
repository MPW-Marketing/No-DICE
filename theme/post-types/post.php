<?php

function btp_init_post_post_type() {
	
	/* Add Custom Write Panels to Post Edit Page */
	add_action('admin_menu', 'btp_add_post_details_meta_box');
 	add_action('save_post', 'btp_save_post_details_meta_box');
	
	add_action('admin_menu', 'btp_add_post_precontent_options_meta_box');
	add_action('save_post', 'btp_save_post_precontent_options_meta_box');
	add_action('admin_menu', 'btp_add_post_single_options_meta_box');
	add_action('save_post', 'btp_save_post_single_options_meta_box');
}

$btp_post_details_meta_box = array(
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

$btp_post_single_options_meta_box = array(	
	'_btp_template'    => array(
		'model'		=> array(
			'null'			=> '',
			'options'		=> 'btp_get_post_single_templates',
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
	'_btp_hide_author' => array(
		'model'		=> array(
			'null'			=> '',		
			'options'		=> array( 'yes'	=> __('Yes', 'btp_theme'), 'no'	=> __('No', 'btp_theme')),
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'     		=> __('Hide author?', 'btp_theme'),
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
   	
);

function btp_add_post_details_meta_box() {
    global $btp_post_details_meta_box;     
    add_meta_box(
    	'btp_post_details_meta_box', 								//id
    	__('Post Details', 'btp_theme'), 							//title
    	'btp_render_meta_box',									 	//callback function 
    	'post',		 												//post_type
       	'normal', 													//context 
    	'high', 													//priority
    	array('options' => $btp_post_details_meta_box)				//callback arguments
    );
}

function btp_add_post_precontent_options_meta_box() {     
	global $btp_precontent_options_meta_box;     
    add_meta_box(
    	'btp_precontent_options_meta_box', 							//id
    	__('Precontent Options', 'btp_theme'),						//title
    	'btp_render_meta_box',										//callback function 
    	'post',			 											//post_type
       	'normal', 													//context 
    	'high',														//priority
    	array('options'	=> $btp_precontent_options_meta_box)		//callback arguments
    );
}

function btp_add_post_single_options_meta_box() {     
	global $btp_post_single_options_meta_box;     
    add_meta_box(
    	'btp_post_single_options_meta_box', 						//id
    	__('Single Page Options', 'btp_theme'),					//title
    	'btp_render_meta_box',										//callback function 
    	'post',			 											//post_type
       	'normal', 													//context 
    	'high',														//priority
    	array('options'	=> $btp_post_single_options_meta_box)		//callback arguments
    );
}
/* Save data from 'Post Details' meta box */
function btp_save_post_details_meta_box($post_ID) {     
	global $btp_post_details_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 			=> 'btp_post_details_meta_box', 
		'options' 		=> $btp_post_details_meta_box,
		'post_type'		=> 'post'
	));
}
/* Save data from 'Single Page Options' meta box */
function btp_save_post_single_options_meta_box($post_ID) {     
	global $btp_post_single_options_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 				=> 'btp_post_single_options_meta_box', 
		'options' 			=> $btp_post_single_options_meta_box,
		'post_type'			=> 'post'
	));
}
/* Save data from 'Precontent Options' meta box */
function btp_save_post_precontent_options_meta_box($post_ID) {     
	global $btp_precontent_options_meta_box;     
	btp_save_meta_box($post_ID, array(
		'id' 				=> 'btp_precontent_options_meta_box', 
		'options' 			=> $btp_precontent_options_meta_box,
		'post_type'			=> 'post'
	));
}



	
/**
 * Returns available templates for post collection (used by shortcodes, widgets). 
 */
function btp_get_post_collection_templates() {
	return array(
		'list-c-1'			=> __('list-c-1', 'btp_theme'),
		'c-3'				=> __('c-3', 'btp_theme'),
		'c-4'				=> __('c-4','btp_theme'),
	);	
}
	
/**
 * Returns available templates for post archive.
 */
function btp_get_post_archive_templates() {
	return array(
		'c-8-sidebar-left'	=> __('c-8, sidebar on left', 'btp_theme'),
		'c-8-sidebar-right'	=> __('c-8, sidebar on right', 'btp_theme'),
	);
}

/**
 * Returns available templates for single post page. 
 */ 
function btp_get_post_single_templates()
{
	return array(
		'sidebar-left'		=> __('Sidebar on left', 'btp_theme'),
		'sidebar-right'		=> __('Sidebar on right', 'btp_theme'),
	);
}



/**
 * Filter to determine template for post index.
 * 
 * @param string $template
 */
function btp_post_index_template($template){
	$taxonomy_slug = get_query_var('taxonomy'); 

 	if ( is_home() ) { 		
 		$templates = array();
 	
		/*$term_slug = get_query_var('term');
		 
		if($term_slug) {
			
			if($taxonomy_slug == 'btp_product_category')					 	
		 		$term = get_term_by( 'slug', $term_slug, 'btp_product_category');
		 	else	
		 		$term = get_term_by( 'slug', $term_slug, 'btp_product_tag');

		 	if( $term ){
		 		$term_template = btp_get_tt_option($term->term_taxonomy_id, 'template');
		 		if ( !empty($term_template) )	
		 			$templates[] = "works-$term_template.php";
		 	}
		}*/
		 	
		$archive_template = btp_get_theme_option('post_index_template');
		if ( !empty($archive_template) )
			$templates[] = "posts-$archive_template.php";	 
		  
		$new_template = locate_template($templates);
		 
		if ( !empty($new_template) )
			return $new_template;	
 	}
 	
 	return $template;
}
add_filter('home_template', 'btp_post_index_template');



/**
 * Filter to determine template for post archive.
 * 
 * @param string $template
 */
function btp_post_archive_template($template){	
	if( 'post' == get_post_type() && is_archive() ) {
		if ( !strlen( $template )  ) {
			$templates = array();	
		
		 	$archive_template = btp_get_theme_option('post_archive_template');
			if ( !empty($archive_template) )
				$templates[] = "posts-$archive_template.php";	 
			  
			$new_template = locate_template($templates);
		 		
		 	if ( strlen( $new_template ) )
				return $new_template;
		}
	}		
 	
 	return $template;
}

add_filter('category_template', 'btp_post_archive_template');
add_filter('tag_template', 'btp_post_archive_template');
add_filter('author_template', 'btp_post_archive_template');
add_filter('date_template', 'btp_post_archive_template');


/**
 * Determines template for single post page with single_template filter.
 * 
 * @param string $template
 */
function btp_post_single_template($template) {
	global $post;
	
	if ( get_post_type() == 'post' ) {
		$templates = array();
		
		/* Single post options */
		$temp = get_post_meta($post->ID, '_btp_template', true);
		if( !empty( $temp ) )
			$templates[] = "single-post-$temp.php";
			
		/* General options */
		$temp = btp_get_theme_option('post_single_template');
		if ( !empty( $temp ) )
			$templates[] = "single-post-$temp.php";
			
		$new_template = locate_template($templates);
		 
		if ( !empty( $new_template ) )
			return $new_template;		
	}
	
	return $template;
}



/**
 * Composes an array of visible elements on post index page.
 */
function btp_get_post_index_hidden_elements() {
	$result = array();
	$elements = array('title', 'thumb', 'date', 'author', 'comments_link', 'categories', 'tags', 'summary', 'button_1');
		
	foreach ( $elements as $key => $value )
		$result[$value] = (bool) btp_get_theme_option('post_index_hide_'.$value);		
	
	$result = array_filter($result);
	
	return $result;
}

/**
 * Composes an array of visible elements on post archive pages.
 */
function btp_get_post_archive_hidden_elements() {
	$result = array();
	$elements = array('title', 'thumb', 'date', 'author', 'comments_link', 'categories', 'tags', 'summary', 'button_1');
	
	if(is_archive()) {
		foreach ( $elements as $key => $value )
			$result[$value] = (bool) btp_get_theme_option('post_archive_hide_'.$value);
	}
	
	$result = array_filter($result);
	
	return $result;
}


/**
 * Composes an array of visible elements on single post page.
 */
function btp_get_post_single_hidden_elements() {
	global $post;
	
	$result = array();
	$elements = array('title', 'date', 'author', 'comments_link', 'categories', 'tags');
		
	foreach ( $elements as $key => $value )
		$result[$value] = (bool) btp_get_theme_option('post_single_hide_'.$value);
			
	foreach ( $elements as $key => $value ) {		
		$t = get_post_meta($post->ID, '_btp_hide_'.$value, true);
		if ( strlen($t) )
			$result[$value] = btp_bool($t);	
	}

	/* Remove false values */
	$result = array_filter($result);
	
	return $result;
}







if ( ! function_exists( 'btp_the_post_title' ) ) :
/**
 * Prints HTML with title based on title linking method for the current post.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_post_title( $before = '<h3>', $after = '</h3>' ) {
	btp_the_title($before, $after);
}
endif;

if ( ! function_exists( 'btp_the_post_thumb' ) ) :
/**
 * Prints HTML with thumb based on thumb linking method for the current post.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_post_thumb($size, $placeholder = true) {
	btp_the_thumb($size, $placeholder);
}
endif;

if ( ! function_exists( 'btp_the_post_date' ) ) :
/**
 * Prints HTML with date for the current post.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_post_date() {
   	?>
      	<span class="entry-date"><?php the_time(get_option('date_format')); ?>, </span>
    <?php 
}
endif;

if ( ! function_exists( 'btp_the_post_author' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 * 
 * @since DICE Theme 1.0
 */
function btp_the_post_author() {
   	?>
      	<span class="entry-author"><?php _e('by', 'btp_theme'); ?> <?php the_author_posts_link(); ?>, </span>
    <?php 
}
endif;

if ( ! function_exists( 'btp_the_post_comments_link' ) ) :
/**
 * Prints HTML with comments link for the current post.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_post_comments_link() {
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

if ( ! function_exists( 'btp_the_post_summary' ) ) :
/**
 * Prints HTML with summary for the current post.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_post_summary() {
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
    <?php   
}
endif;

if ( ! function_exists( 'btp_the_post_categories' ) ) :
/**
 * Prints HTML with category list for the current post.
 * 
 * @since DICE Theme 1.0
 */   	
function btp_the_post_categories(){
	global $post;
	?>
	<div class="post-categories">
		<h6><?php _e('Categories', 'btp_theme'); ?></h6>
		<?php echo get_the_term_list( $post->ID, 'category', '<ul><li>', ',</li><li>', '</li></ul>' ); ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'btp_the_post_tags' ) ) :
/**
 * Prints HTML with tag list for the current post.
 * 
 * @since DICE Theme 1.0
 */	
function btp_the_post_tags(){
	global $post;
	?>
	<div class="post-tags">
		<h6><?php _e('Tags', 'btp_theme'); ?></h6>
		<?php echo get_the_term_list( $post->ID, 'post_tag', '<ul><li>', ',</li><li>', '</li></ul>' ); ?>
	</div>
	<?php
}
endif;


if ( ! function_exists( 'btp_the_post_primary_button' ) ) :
/**
 * Prints HTML with primary button for the current post.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_post_primary_button( $priority = 'primary', $size = 'small', $wide = false ) {	
	return btp_the_primary_button( $priority, $size, $wide );
}
endif;

?>