<?php

/* Based on: http://www.smert.net/2008/05/23/inconsistencies-between-php-on-windows-show-me-the-money_format/ */
function btp_price_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(			
		'prefix'	=> null,
		'suffix'	=> null,
		'point'		=> null,
		'precision'	=> null,
		'separator'	=> null,
		'template'	=> 'big',			
		), $atts ) );
		
	/* If there's no content, get value from actual post custom field '_btp_price' */	
	if ( !strlen( $content ) ) {
		global $post;
		if(!$post) 
			return null;
						
		$content = get_post_meta($post->ID, '_btp_price', true);				
	}
	
	$content = explode( '.', $content);
	switch ( count( $content ) ) {
		case 1:
			$value = $content[0];
			$dec_value = 0;
			break;
		case 2;
			$value = $content[0];
			$dec_value = $content[1];
			break;
		default:
			$value = 0;
			$dec_value = 0;
			break;
	}

	
	if($prefix === null)
		$prefix = btp_get_theme_option('product_price_prefix');
	if($suffix === null)
		$suffix = btp_get_theme_option('product_price_suffix');
	if($point === null)
		$point = btp_get_theme_option('product_price_point');
	if($precision === null)
		$precision = btp_get_theme_option('product_price_precision');	
	if($separator === null)
		$separator = btp_get_theme_option('product_price_separator');	
		
	$dec_value = str_pad( $dec_value, $precision, "0");
	$dec_value = substr( $dec_value, 0, $precision );	
	$dec_value = (int)$dec_value;
	$value = (int)$value;
	
	$out = '';
	$out .= '<span class="price ' . esc_attr( $template ) . '">';
		$out .= '<span class="prefix">' . $prefix . '</span>';
		$out .= '<span class="int-part">' . number_format( intval( $value ), 0, '', $separator ) . '</span>';
		if ( $dec_value ) {
			$out .= '<span class="dec-point">' . $point . '</span>';
			$out .= '<span class="dec-part">' . $dec_value . '</span>';
		}
		$out .= '<span class="suffix">' . $suffix . '</span>';
	$out .= '</span>';

	return $out;
}


function btp_recent_products_shortcode_generator_item() {
	return new BTP_Shortcode_Generator_Item( 
		'recent_products',
		array(
			'label'			=> '[recent_products] shortcode',
			'attributes'	=> array(
				new BTP_Form_Unit_Input_Text( 'cat', array(
					'hint' => __( 'Comma separated list of product category ids', 'btp_theme'), 
				)),
				new BTP_Form_Unit_Select( 'template', array(
					'label' => 'template *',
					'choices'	=> 'btp_get_product_collection_templates'
				)),
				new BTP_Form_Unit_Input_Text( 'max', array(
					'label' => 'max *',
					'hint' => __( 'Maximum number of items', 'btp_theme'),
				)),
				new BTP_Form_Unit_Input_Text( 'max_per_row', array(
					'label' => 'max_per_row *',
					'hint' => __( 'Maximum number of items per row in grid templates', 'btp_theme'),
				)),				
				new BTP_Form_Unit_Input_Text( 'hide', array(
					'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>price</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li><li>button_2</li><li>button_3</li></ul>', 'btp_theme'),
					'hint' => __('Comma separated list of elements to hide', 'btp_theme')
				)),
			),
		)			 
	); 
}		


function btp_recent_products_shortcode( $atts, $content = null ) {		
	$default_template = key( btp_get_product_collection_templates() );
	
	extract( shortcode_atts( array(
		'cat'					=> '',
		'max'					=> 1,
		'max_per_row'			=> 0,	
		'template'				=> $default_template,
		'hide'					=> '',
		
		'lightbox_group'		=> 'related_products'		
		), $atts ) );
	
	$out = '';
	
	$btp_query_args = array(
   		'post_type'				=> 'btp_product',
		'posts_per_page'		=> absint($max),  			
  		'orderby'				=> 'date',
  		'order'					=> 'desc',
		'btp_product_category'	=> $cat,
		'ignore_sticky_posts'	=> true, // Ignore sticky posts - 3.1
		//'caller_get_posts'		=> true, // Ignore sticky posts
	);					

	global $btp_query;
	$btp_query = new WP_Query($btp_query_args);	

	if ( $btp_query->have_posts() ) {	
		btp_before_the_loop();
		
		/* Define some global variables for template part */
			global  $btp_max_per_row,
					$btp_hide,
					$btp_lightbox_group;
						
			$btp_max_per_row	= absint($max_per_row);
			$btp_hide = btp_string_to_bools($hide);
			$btp_lightbox_group = $lightbox_group;
		
		/* Compose output */
		$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);						
		ob_start();
		get_template_part('/theme/parts/products', $template);					
		$out .= ob_get_clean();
		
		btp_after_the_loop();
	}
	else {
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';
	}
	
	$btp_query = null;
	$btp_max_per_row = 0;
	$btp_lightbox_group = '';
	
	return $out;
}
	

function btp_related_products_shortcode_generator_item() {
	return new BTP_Shortcode_Generator_Item( 
		'related_products',
		array(
			'label'			=> '[related_ products] shortcode',
			'attributes'	=> array(
				new BTP_Form_Unit_Input_Text( 'id', array(
					'hint' => __( 'Related entry id', 'btp_theme' ),
				)),
				new BTP_Form_Unit_Select( 'template', array(
					'label' => 'template *',
					'choices'	=> 'btp_get_product_collection_templates'
				)),
				new BTP_Form_Unit_Input_Text( 'max', array(
					'label' => 'max *',
					'hint' => __( 'Maximum number of items', 'btp_theme'),
				)),
				new BTP_Form_Unit_Input_Text( 'max_per_row', array(
					'label' => 'max_per_row *',
					'hint' => __( 'Maximum number of items per row in grid templates', 'btp_theme'),
				)),
				new BTP_Form_Unit_Input_Text( 'hide', array(
					'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>price</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li><li>button_2</li><li>button_3</li></ul>', 'btp_theme'),
					'hint' => __('Comma separated list of elements to hide', 'btp_theme')
				)),
			),
		)			 
	); 
}

function btp_related_products_shortcode( $atts, $content = null ) {
	$default_template = key( btp_get_product_collection_templates() );
	
	extract( shortcode_atts( array(			
		'id'				=> 0,
		'max'				=> 1,
		'max_per_row'		=> 0,	
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'related_products'		
		), $atts ) );
	
	$out = '';
			
	$related_ids = btp_get_related_ids($id, 'btp_product', $max);
	
	if ( count( $related_ids ) ) {
								  				
  		$btp_query_args = array(
   			'post_type'				=> 'btp_product',
  			'post__in'				=> $related_ids,
  			'orderby'				=> 'none',
  			'ignore_sticky_posts'	=> true, // Ignore sticky posts - 3.1
  			//'caller_get_posts'		=> true, // Ignore sticky posts		   					
		);					
			
		global $btp_query;
		$btp_query = new WP_Query($btp_query_args);
			
		if ( $btp_query->have_posts() ) {
			btp_before_the_loop();
			
			/* Define some global variables for template part */
			global  $btp_max_per_row,
					$btp_hide,
					$btp_lightbox_group;
						
			$btp_max_per_row	= absint($max_per_row);
			$btp_hide = btp_string_to_bools($hide);
			$btp_lightbox_group = $lightbox_group;
				
			/* Compose output */
			$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);						
			ob_start();
			get_template_part('/theme/parts/products', $template);					
			$out .= ob_get_clean();
		
			btp_after_the_loop();
		}			
	}
	else {
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';	
	}
	
	$btp_query = null;
	$btp_max_per_row = 0;
	$btp_lightbox_group = '';
	
	return $out;
}
	

function btp_custom_products_shortcode_generator_item() {
	return new BTP_Shortcode_Generator_Item( 
		'custom_products',
		array(
			'label'			=> '[custom_products] shortcode',
			'attributes'	=> array(
				new BTP_Form_Unit_Input_Text( 'ids', array(
					'label' => 'ids *',	
					'hint' => __( 'Comma separated list of product ids', 'btp_theme' ),
				)),
				new BTP_Form_Unit_Select( 'template', array(
					'label' => 'template *',
					'choices'	=> 'btp_get_product_collection_templates'
				)),
				new BTP_Form_Unit_Input_Text( 'max_per_row', array(
					'label' => 'max_per_row *',
					'hint' => __( 'Maximum number of items per row in grid templates', 'btp_theme'),
				)),
				new BTP_Form_Unit_Input_Text( 'hide', array(
					'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>price</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li><li>button_2</li><li>button_3</li></ul>', 'btp_theme'),
					'hint' => __('Comma separated list of elements to hide', 'btp_theme')
				)),
			),
		)			 
	); 
}

function btp_custom_products_shortcode( $atts, $content = null ) {	
	$default_template = key( btp_get_product_collection_templates() );
	
	extract( shortcode_atts( array(			
		'ids'				=> '',		
		'max_per_row'		=> 0,	
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'custom_products'	
		), $atts ) );
		
	$out = '';

	$ids = explode(',', $ids);	
	
	$btp_query_args = array(
   		'post_type'				=> 'btp_product',		
  		'post__in'				=> $ids,
  		'orderby'				=> 'none',
		'ignore_sticky_posts'	=> true, // Ignore sticky posts - 3.1
		//'caller_get_posts'		=> true, // Ignore sticky posts		   					
	);					

	global $btp_query;
	$btp_query = new WP_Query($btp_query_args);
			
	if ( $btp_query->have_posts() ) {	
		btp_before_the_loop();
		
		/* Define some global variables for template part */
		global  $btp_max_per_row,
				$btp_hide,
				$btp_lightbox_group;
				
		$btp_max_per_row 	= absint($max_per_row);
		$btp_hide = btp_string_to_bools($hide);
		$btp_lightbox_group = btp_bool($lightbox_group);
		
		/* Compose output */
		$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);						
		ob_start();
		get_template_part('/theme/parts/products', $template);					
		$out .= ob_get_clean();

		btp_after_the_loop();
	}
	else {
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';	
	}
	
	$btp_query = null;
	$btp_max_per_row = 0;
	$btp_lightbox_group = '';
	
	return do_shortcode($out);
}
	
	
	
function btp_popular_products_shortcode_generator_item() {
	return new BTP_Shortcode_Generator_Item( 
		'popular_products',
		array(
			'label'			=> '[popular_products] shortcode',
			'attributes'	=> array(
				new BTP_Form_Unit_Select( 'template', array(
					'label' => 'template *',
					'choices'	=> 'btp_get_product_collection_templates'
				)),
				new BTP_Form_Unit_Input_Text( 'max', array(
					'label' => 'max *',
					'hint' => __( 'Maximum number of items', 'btp_theme'),
				)),
				new BTP_Form_Unit_Input_Text( 'max_per_row', array(
					'label' => 'max_per_row *',
					'hint' => __( 'Maximum number of items per row in grid templates', 'btp_theme'),
				)),
				new BTP_Form_Unit_Input_Text( 'hide', array(
					'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>price</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li><li>button_2</li><li>button_3</li></ul>', 'btp_theme'),
					'hint' => __('Comma separated list of elements to hide', 'btp_theme')
				)),
			),
		)			 
	); 
}

function btp_popular_products_shortcode( $atts, $content = null ) {		
	$default_template = key( btp_get_product_collection_templates() );
	
	extract( shortcode_atts( array(
		'max'				=> 1,
		'max_per_row'		=> 0,	
		'template'			=> $default_template,
		'hide'				=> '',
		'lightbox_group'	=> 'popular_products'		
		), $atts ) );
	
	$out = '';
	
	$btp_query_args = array(
   		'post_type'				=> 'btp_product',
		'posts_per_page'		=> absint($max),  			
  		'orderby'				=> 'comment_count',
  		'order'					=> 'desc',
		'ignore_sticky_posts'	=> true, // Ignore sticky posts - 3.1
		//'caller_get_posts'		=> true, // Ignore sticky posts					
	);					

	global $btp_query;
	
	/* Modify post query to consider only commented posts */		
	add_filter('posts_where', 'btp_posts_where_filter_only_commented');	    
	$btp_query = new WP_Query($btp_query_args);	

	if ( $btp_query->have_posts() ) {
		/* Remove filter to not interfere with further post queries */
		remove_filter('posts_where', 'btp_posts_where_filter_only_commented');
				
		btp_before_the_loop();
		
		/* Define some global variables for template part */
			global  $btp_max_per_row,
					$btp_hide,
					$btp_lightbox_group;
						
			$btp_max_per_row	= absint($max_per_row);
			$btp_hide = btp_string_to_bools($hide);
			$btp_lightbox_group = $lightbox_group;
		
		/* Compose output */
		$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);						
		ob_start();
		get_template_part('/theme/parts/products', $template);					
		$out .= ob_get_clean();
		
		btp_after_the_loop();
	}
	else {
		$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';
	}
	
	$btp_query = null;
	$btp_max_per_row = 0;
	$btp_lightbox_group = '';
	
	return $out;
}
?>