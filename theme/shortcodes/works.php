<?php
	function btp_recent_works_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'recent_works',
			array(
				'label'			=> '[recent_works] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'cat', array(
						'hint' => __( 'Comma separated list of work category ids', 'btp_theme'), 
					)),
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_work_collection_templates'
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
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>date</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li><li>button_2</li><li>button_3</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),
				),
			)			 
		); 
	}
	
	function btp_recent_works_shortcode( $atts, $content = null ) {	
		$default_template = key( btp_get_work_collection_templates() );
		
		extract( shortcode_atts( array(
			'cat'				=> '',
			'max'				=> 1,
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'recent_works'										
			), $atts ) );
			
		$out = '';
		
		$btp_query_args = array(
   			'post_type'				=> 'btp_work',
			'posts_per_page'		=> absint($max),  			
  			'orderby'				=> 'date',
  			'order'					=> 'desc',
			'btp_work_category'		=> $cat,
			'ignore_sticky_posts'	=> true, // Ignore sticky posts - 3.1
			//'caller_get_posts'		=> true, // Ignore sticky posts				
		);					

		global $btp_query;
		$btp_query = new WP_Query($btp_query_args);	

		if ( $btp_query->have_posts() ) {	 
			btp_before_the_loop();			
			
			/* Define some global variables for template part */
			global 	$btp_max_per_row,
					$btp_hide,
					$btp_lightbox_group;
			
			$btp_max_per_row 	= absint($max_per_row);
			$btp_hide = btp_string_to_bools($hide);
			$btp_lightbox_group = $lightbox_group;
			
			/* Compose output */
			$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);
			ob_start();
			get_template_part('/theme/parts/works', $template);					
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
	
	
	
	
	function btp_related_works_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'related_works',
			array(
				'label'			=> '[related_works] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'id', array(
						'hint' => __( 'Related entry id', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_work_collection_templates'
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
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>date</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li><li>button_2</li><li>button_3</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),
				),
			)			 
		); 
	}
	
	function btp_related_works_shortcode( $atts, $content = null ) {
		$default_template = key(btp_get_work_collection_templates());
		
		extract( shortcode_atts( array(
			'id'				=> 0,	
			'max'				=> 1,
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'related_works',
			), $atts ) );
		
		$out = '';
		
		$related_ids = btp_get_related_ids($id, 'btp_work', $max);
		if ( count($related_ids) ) {
  			$btp_query_args = array(
   				'post_type'				=> 'btp_work',
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
				
				$btp_max_per_row 	= absint($max_per_row);
				$btp_hide = btp_string_to_bools($hide);
				$btp_lightbox_group = $lightbox_group;
				
				/* Compose output */
				$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);
				ob_start();
				get_template_part('/theme/parts/works', $template);					
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
	
	
	function btp_custom_works_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'custom_works',
			array(
				'label'			=> '[custom_works] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'ids', array(
						'label' => 'ids *',
						'hint' => __( 'Comma separated list of work ids', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_work_collection_templates'
					)),
					new BTP_Form_Unit_Input_Text( 'max_per_row', array(
						'label' => 'max_per_row *',
						'hint' => __( 'Maximum number of items per row in grid templates', 'btp_theme'),
					)),
					new BTP_Form_Unit_Input_Text( 'hide', array(
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>date</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li><li>button_2</li><li>button_3</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),
				),
			)			 
		); 
	}
	
	function btp_custom_works_shortcode( $atts, $content = null ) {
		$default_template = key( btp_get_work_collection_templates() );
		
		extract( shortcode_atts( array(			
			'ids'				=> '',			
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'custom_works',
			), $atts ) );
			
		$out = '';
		
		$ids = explode(',', $ids);			
		
		$btp_query_args = array(
   			'post_type'				=> 'btp_work',			
  			'post__in'				=> $ids,
  			'orderby'				=> 'none',
			'ignore_sticky_posts'	=> true, // Ignore sticky posts - 3.1			
			//'caller_get_posts'		=> true, // Ignore sticky posts	   					
		);					

		global $btp_query;
		$btp_query = new WP_Query($btp_query_args);	

		if ( $btp_query->have_posts() ) {		
			global $post;	
			/* Save current post object for further operations */
			$temp_post = $post ? clone $post : $post;	
			
			/* Define some global variables for template part */
			global  $btp_max_per_row,
					$btp_hide,
					$btp_lightbox_group;
			
			$btp_max_per_row 	= absint($max_per_row);
			$btp_hide = btp_string_to_bools($hide);
			$btp_lightbox_group = $lightbox_group;
			
			/* Compose output */
			$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);
			ob_start();
			get_template_part('/theme/parts/works', $template);					
			$out .= ob_get_clean();
			
			/* Back to current post */
			$post = $temp_post? clone $temp_post : $temp_post;
			if($post)
				setup_postdata($post);
		}
		else {
			$out .= '<p class="no-results">'.__( 'No results found.', 'btp_theme' ).'</p>';	
		}
		
		$btp_query = null;
		$btp_max_per_row = 0;
		$btp_lightbox_group = '';
		
		return $out;
	}
	
	
	
	function btp_popular_works_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'popular_works',
			array(
				'label'			=> '[popular_works] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_work_collection_templates'
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
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>date</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li><li>button_2</li><li>button_3</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),
				),
			)			 
		); 
	}
	
	function btp_popular_works_shortcode( $atts, $content = null ) {	
		$default_template = key( btp_get_work_collection_templates() );
		
		extract( shortcode_atts( array(
			'max'				=> 1,
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'popular_works'										
			), $atts ) );
			
		$out = '';
		
		$btp_query_args = array(
   			'post_type'				=> 'btp_work',
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
			global 	$btp_max_per_row,
					$btp_hide,
					$btp_lightbox_group;
			
			$btp_max_per_row 	= absint($max_per_row);
			$btp_hide = btp_string_to_bools($hide);
			$btp_lightbox_group = $lightbox_group;
			
			/* Compose output */
			$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);
			ob_start();
			get_template_part('/theme/parts/works', $template);					
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