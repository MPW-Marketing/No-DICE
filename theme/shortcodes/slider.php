<?php
	function btp_slider_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'slider',
			array(
				'label'			=> '[slider] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'width', array(
						'label' => 'width *',
						'hint' => __( 'In pixels', 'btp_theme' ),	
					)),
					new BTP_Form_Unit_Input_Text( 'height', array(
						'label' => 'height *',
						'hint' => __( 'In pixels', 'btp_theme' ),	
					)),					
				),
				'content'		=> new BTP_Form_Unit_Textarea( 'images', array(
					'label' => 'images *',
					'value' => 'http://yourdomain.com/sample_image1.jpg' . "\n" . 'http://yourdomain.com/sample_image2.jpg',
				)),
				'display'		=> 'block',
			)			 
		); 
	}

	function btp_slider_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'width' 			=> 100,
			'height'			=> 100
		    ), $atts ) );		
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);

		$imgs = strip_tags($content);
		$imgs = explode("\n", trim($imgs));	
		    
		    
		$out = '';
		$out .= '<div class="slider slider-cycle">';

			$out .= btp_render_metadata(btp_get_cycle_slider_general_metadata(), 'div', null, null, false);
				
			$out .= '<div class="viewport">';
				$out .= '<ul class="slides">';
				
					foreach($imgs as $img) {	
						$out .= '<li>';
							$out .= '<div class="slide">';						
								$out .= '<div class="slide-media slide-image">';					
									$out .= '<img src="'.esc_url($img).'" alt="" width="' . esc_attr( (int) $width ) . '" height="' . esc_attr( (int) $height ) . '" />';
								$out .= '</div>';	
							$out .= '</div>';
						$out .= '</li>';
					}
				
				$out .= '</ul>';
			$out .= '</div>';
		$out .= '</div>';
		
		return $out;
	}
	
	
	function btp_dice_slider_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'dice_slider',
			array(
				'label'			=> '[dice_slider] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'width', array(
						'label' => 'width *',
						'hint' => __( 'In pixels', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Input_Text( 'height', array(
						'label' => 'height *',
						'hint' => __( 'In pixels', 'btp_theme' ),
					)),
				),
				'content'		=> new BTP_Form_Unit_Textarea( 'images', array(
					'label' => 'images *',
					'value' => 'http://yourdomain.com/sample_image1.jpg' . "\n" . 'http://yourdomain.com/sample_image2.jpg',
				)),
				'display'		=> 'block',
			)			 
		); 
	}
	
	function btp_dice_slider_shortcode( $atts, $content = null ) {
		/* Count google maps for proper reference */
		static $btp_shortcode_dice_slider = 0;
   		$id = (++$btp_shortcode_dice_slider);
		
		extract( shortcode_atts( array(
			'width' 			=> 100,
			'height'			=> 100
		    ), $atts ) );		
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);

		$imgs = strip_tags($content);
		$imgs = explode("\n", trim($imgs));	
		    
		    
		$out = '';
		$out .= '<div id="slider-dice-alt-content-'.$id.'" class="slider-dice-alt-content">';			
			$out .= '<div class="slider slider-dice">';
				
				$out .= btp_render_metadata(
							array_merge( array('height' => intval($height), 'width' => intval($width)), btp_get_dice_slider_general_metadata() ),
							'div', 
							null, 
							null, 
							false
				);				
				
				$out .= '<div class="viewport">';
					$out .= '<ul class="slides">';
										
						foreach($imgs as $img) {							
							$out .= '<li><div class="slide">';
								$out .= '<div class="slide-media slide-image"><img src="'.esc_url($img).'" alt="" /></div>';
							$out .= '</div></li>';		
						}
					
					$out .= '</ul>';
				$out .= '</div>';
			$out .= '</div>';
		
			$out .= '</div>';
					
		return $out;
	}
?>