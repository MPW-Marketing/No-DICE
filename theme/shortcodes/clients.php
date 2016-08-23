<?php
	function btp_recent_clients_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'recent_clients',
			array(
				'label'			=> '[recent_clients] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_client_collection_templates'
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
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>summary</li><li>button_1</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),
				),
				'display'	=> 'block',
			)			 
		); 
	}	
		
	function btp_recent_clients_shortcode( $atts, $content = null ) {
		$default_template = key( btp_get_client_collection_templates() );
		
		extract( shortcode_atts( array(
			'max'				=> 0,
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'recent_clients'			
			), $atts ) );
			
		$out = '';
		
		$btp_query_args = array(
   			'post_type'				=> 'btp_client',
			'posts_per_page'		=> absint($max),  			
  			'orderby'				=> 'date',
  			'order'					=> 'desc',		
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
			
			/* compose output */
			$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);
			ob_start();
			get_template_part('/theme/parts/clients', $template);					
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
	
	
	
	
	function btp_related_clients_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'related_clients',
			array(
				'label'			=> '[related_clients] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'id', array(
						'hint' => __( 'Related entry id', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_client_collection_templates'
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
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>summary</li><li>button_1</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),					
				),
				'display'	=> 'block',
			)			 
		); 
	}	
	
	function btp_related_clients_shortcode( $atts, $content = null ) {
		$default_template = key( btp_get_client_collection_templates() );
		
		extract( shortcode_atts( array(			
			'id'				=> 0,
			'max'				=> 0,
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'related_clients'		
			), $atts ) );
			
		$out = '';
		
		$related_ids = btp_get_related_ids($id, 'btp_client', $max);

		if(count($related_ids)){
		
  			$btp_query_args = array(
   				'post_type'				=> 'btp_client',
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
				global 	$btp_max_per_row,
						$btp_hide,
						$btp_lightbox_group;
								
				$btp_max_per_row 	= absint($max_per_row);
				$btp_hide = btp_string_to_bools($hide);
				$btp_lightbox_group = $lightbox_group;
				
				/* Compose output */
				$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);						
				ob_start();
				get_template_part('/theme/parts/clients', $template);					
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
	
	
	
	function btp_custom_clients_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'custom_clients',
			array(
				'label'			=> '[custom_clients] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'ids', array(
						'label' => 'ids *',
						'hint' => __( 'Comma separated list of client ids', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_client_collection_templates'
					)),
					new BTP_Form_Unit_Input_Text( 'max_per_row', array(
						'label' => 'max_per_row *',
						'hint' => __( 'Maximum number of items per row in grid templates', 'btp_theme'),
					)),
					new BTP_Form_Unit_Input_Text( 'hide', array(
						'help' => __('<p>You can hide following elements:</p><ul><li>title</li><li>thumb</li><li>summary</li><li>button_1</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),					
				),
				'display'	=> 'block',
			)			 
		); 
	}
	
	function btp_custom_clients_shortcode( $atts, $content = null ) {
		$default_template = key( btp_get_client_collection_templates() );
		
		extract( shortcode_atts( array(			
			'ids'				=> '',			
			'max_per_row'		=> 0,	
			'template'			=> $default_template,
			'hide'				=> '',
			'lightbox_group'	=> 'custom_clients',
			), $atts ) );
			
		$out = '';
		
		$ids = explode(',', $ids);	
		
		$btp_query_args = array(
   			'post_type'				=> 'btp_client',			
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
			global 	$btp_max_per_row,
					$btp_hide,
					$btp_lightbox_group;
							
			$btp_max_per_row 	= absint($max_per_row);
			$btp_hide = btp_string_to_bools($hide);
			$btp_lightbox_group = $lightbox_group;
			
			/* Compose output */
			$template = preg_replace('/[^0-9a-zA-Z_-]*/', '', $template);
			ob_start();
			get_template_part('/theme/parts/clients', $template);					
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