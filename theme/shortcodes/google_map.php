<?php

	function btp_google_map_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'google_map',
			array(
				'label'			=> '[google_map] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'width', array(
						'label' => 'width *',
						'hint' => __( 'In pixels', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Input_Text( 'height', array(
						'label' => 'height *',
						'hint' => __( 'In pixels', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Input_Text( 'src', array(
						'label' => 'src *',
						'hint' => __( 'Map link', 'btp_theme' ),					
					)),
				),
				'display'		=> 'block',
			)			 
		); 
	}

	function btp_google_map_shortcode( $atts, $content = null ) {
   		/* Count google maps for proper reference */
		static $btp_shortcode_google_map = 0;
   		$id = (++$btp_shortcode_google_map);
		
		extract(shortcode_atts(array(
      		"width" => '640',
      		"height" => '480',
      		"src" => ''
   		), $atts));
   		
   		$width = (int)$width;
   		$height = (int)$height;

   		/* Compose output */
   		$out = '';
   		$out .= '<div id="google_map_'.$id.'" style="width: '.esc_attr($width).'px; height: '.esc_attr($height).'px;">';
   			$out .= '<iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.esc_url($src).'&amp;output=embed"></iframe>';   			
   		$out .= '</div>';
   		
   		return $out;
	}
?>