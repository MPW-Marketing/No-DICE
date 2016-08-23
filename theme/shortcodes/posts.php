<?php	
	function btp_recent_posts_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'recent_posts',
			array(
				'label'			=> '[recent_posts] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'cat', array(
						'hint' => __( 'Comma separated list of category ids', 'btp_theme'), 
					)),
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_post_collection_templates'
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
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>date</li><li>author</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),
				),
				'display'		=> 'block',
			)			 
		); 
	}		

	
	function btp_recent_posts_shortcode( $atts, $content = null ) {	
		$default_template = key( btp_get_post_collection_templates() );
		
		extract( shortcode_atts( array(
			'cat'				=> '',
			'max'				=> 1,
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'recent_posts'										
			), $atts ) );
			
		$out = '';
		
		$btp_query_args = array(
   			'post_type'				=> 'post',
			'posts_per_page'		=> absint($max),  			
  			'orderby'				=> 'date',
  			'order'					=> 'desc',
  			'cat'					=> preg_replace('/[^0-9,\s]*/', '', $cat),
			'ignore_sticky_posts'	=> true, // Ignore sticky posts - 3.1
			//'caller_get_posts'		=> true, // Ignore sticky posts
		);					

		
		global $btp_query;
		$btp_query = new WP_Query($btp_query_args);	
		
		if($btp_query->have_posts()) {
			
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
			get_template_part('/theme/parts/posts', $template);					
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
	
	
	function btp_related_posts_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'related_posts',
			array(
				'label'			=> '[related_posts] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'id', array(
						'hint' => __( 'Related entry id', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_post_collection_templates'
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
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>date</li><li>author</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),
				),
				'display'		=> 'block',
			)			 
		); 
	}
	
	function btp_related_posts_shortcode( $atts, $content = null ) {
		$default_template = key( btp_get_post_collection_templates() );
		
		extract( shortcode_atts( array(
			'id'				=> 0,	
			'max'				=> 1,
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'related_posts'										
			), $atts ) );
		
		$out = '';
				
		$related_ids = btp_get_related_ids($id, 'post', $max);
		if(count($related_ids)){
  			$btp_query_args = array(
   				'post_type'				=> 'post',
  				'post__in'				=> $related_ids,
  				'orderby'				=> 'none',
  				'ignore_sticky_posts'	=> true, // Ignore sticky posts - 3.1
  				//'caller_get_posts'		=> true, // Ignore sticky posts
			);					

			global $btp_query;
			$btp_query = new WP_Query($btp_query_args);	
				
			if($btp_query->have_posts()) {					
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
				get_template_part('/theme/parts/posts', $template);					
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
	
	
	
	function btp_custom_posts_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'custom_posts',
			array(
				'label'			=> '[custom_posts] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'ids', array(
						'label' => 'ids *',
						'hint' => __( 'Comma separated list of post ids', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_post_collection_templates'
					)),
					new BTP_Form_Unit_Input_Text( 'max_per_row', array(
						'label' => 'max_per_row *',
						'hint' => __( 'Maximum number of items per row in grid templates', 'btp_theme'),
					)),
					new BTP_Form_Unit_Input_Text( 'hide', array(
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>date</li><li>author</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),
				),
				'display'		=> 'block',
			)			 
		); 
	}
	
	function btp_custom_posts_shortcode( $atts, $content = null ) {
		$default_template = key( btp_get_post_collection_templates() );
		
		extract( shortcode_atts( array(			
			'ids'				=> 0,
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'custom_posts'					
			), $atts ) );
			
		$out = '';
		
		$ids = explode(',', $ids);
		
		$btp_query_args = array(
   			'post_type'				=> 'post',
  			'post__in'				=> $ids,
  			'orderby'				=> 'none',
			'ignore_sticky_posts'	=> true, // Ignore sticky posts - 3.1
			//'caller_get_posts'		=> true, // Ignore sticky posts
		);					

		global $btp_query;
		$btp_query = new WP_Query($btp_query_args);	

		if($btp_query->have_posts()) {
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
			get_template_part('/theme/parts/posts', $template);					
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
	
	
	
	
	function btp_popular_posts_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'popular_posts',
			array(
				'label'			=> '[popular_posts] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_post_collection_templates'
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
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>date</li><li>author</li><li>comments_link</li><li>summary</li><li>categories</li><li>tags</li><li>button_1</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),
				),
				'display'		=> 'block',
			)			 
		); 
	}
	
	function btp_popular_posts_shortcode( $atts, $content = null ) {	
		$default_template = key( btp_get_post_collection_templates() );
		
		extract( shortcode_atts( array(
			'max'				=> 1,
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'popular_posts'										
			), $atts ) );
			
		$out = '';
		
		$btp_query_args = array(
   			'post_type'				=> 'post',
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
			get_template_part('/theme/parts/posts', $template);					
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