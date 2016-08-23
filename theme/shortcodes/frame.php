<?php

	function btp_frame_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'frame',
			array(
				'label'			=> '[frame] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Select( 'align', array(
						'label' => 'align *',
						'choices'	=> array(
								'left'  	=> 'left',
								'center' 	=> 'center',
								'right'		=> 'right',
							), 
					)),
				),
				'content'			=> new BTP_Form_Unit_Input_Text( 'image_source', array(
					'label'		=> 'image_source *',
					'hint'		=> __( 'For example: http://www.yourdomain.com/image1.jpg', 'btp_theme' ),
				)),
			)			 
		); 
	}

	function btp_frame_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'align'		=> ''	
			), $atts ) );
			
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		$align  = empty( $align ) ? 'center' : $align;		
		$align = ' align'.$align;	
		
		/* Compose output */
		$out = '';
		$out .= '<span class="frame'.esc_attr($align).'">';
			$out .= '<span class="frame-inner">';
				$out .= '<img src="'.esc_url($content).'" alt="" />';
			$out .= '</span>';
		$out .= '</span>';		
		
		return $out;
	}

?>