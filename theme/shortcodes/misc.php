<?php
	function btp_icon_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'icon',
			array(
				'label'			=> '[icon] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'name', array(
						'label' => 'name *',
						'hint'	=> __( 'Name of a 16x16 icon from dice/images/shortcode_icon folder', 'btp_theme' ),
					)),
				),
			)			 
		); 
	}

	function btp_icon_shortcode($atts, $content = null)
	{
	 	extract( shortcode_atts( array(
			'name' => 'check',					
			), $atts ) );
			
		$name = preg_replace('/[^0-9a-zA-Z_-]*/', '', $name);
				
		$out = '';
		$out .= '<img class="icon" src="' . get_template_directory_uri() . '/images/shortcode_icon/'.esc_attr($name).'.png" alt="Icon: '.esc_attr($name).'" />';
						
		return $out;
	}
	
	
	function btp_precontent_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'precontent',
			array(
				'label'			=> '[precontent] shortcode',
				'content'		=> new BTP_Form_Unit_Textarea( 'precontent', array(
					'value'				=> __('some text goes here...', 'btp_theme'),
				)),
			)			 
		); 
	}
	
	function btp_precontent_shortcode( $atts, $content = null ) {	
		return '';
	}
	
	function btp_img_caption_shortcode($attr, $content = null) {
	
		// Allow plugins/themes to override the default caption template.
		$output = apply_filters( 'img_caption_shortcode', '', $attr, $content );
		if ( $output != '' )
			return $output;
	
		extract(shortcode_atts(array(
			'id'	=> '',
			'align'	=> 'alignnone',
			'width'	=> '',
			'caption' => ''
		), $attr));
	
		if ( 1 > (int) $width || empty($caption) )
			return $content;
	
		if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	
		return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (10 + (int) $width) . 'px">'
		. do_shortcode( $content ) . '<p class="meta wp-caption-text">' . $caption . '</p></div>';
	}
	
	
?>