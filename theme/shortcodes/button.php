<?php

	function btp_button_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'button',
			array(
				'label'			=> '[button] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'href', array(
						'label' => 'href *',
						'hint' 	=> __( 'For example:. http://www.yourdomain.com', 'btp_theme'),
					)),
					new BTP_Form_Unit_Select( 'priority', array(
						'label' => 'priority *',
						'choices'	=> array(
								'primary' 	=> 'primary',
								'secondary' => 'secondary',
								'tertiary'  => 'tertiary',
						)
					)),
					new BTP_Form_Unit_Select( 'size', array(
						'label' => 'size *',
						'choices'		=> array(
								'small' 	=> 'small',
								'medium'	=> 'medium',
								'big'	  	=> 'big',
						)
					)),
					new BTP_Form_Unit_Select( 'linking', array(
						'label' => 'linking *',
						'choices'		=> array(
								'default' 		=> 'default',
								'new-window'	=> 'new-window',
								'lightbox'		=> 'lightbox',
						)
					)),
					new BTP_Form_Unit_Input_Text( 'title', array(
						'hint'	=> __( 'Title attribute for &lt;a&gt; tag', 'btp_theme' ),
					
					)),
					new BTP_Form_Unit_Checkbox( 'wide', array(
						'hint' => __( 'Check, if your button must cover entire column width', 'btp_theme'),
					)),
				),
				'content'		=> new BTP_Form_Unit_Input_Text( 'label', array(
					'label' => 'label *',
					'hint'	=> __( 'For example: Read more', 'btp_theme'),
				)),
			)			 
		); 
	}


	function btp_button_shortcode($atts, $content = null)
	{
		extract( shortcode_atts( array(
			'href' 			=> '#',
		    'priority'		=> 'primary',
			'size'			=> 'small',
			'wide'			=> false,
			'title'			=> '',
			'linking'		=> 'default',					
			), $atts ) );
		
		if ( !strlen( $href ) || $linking == 'none') {
			return '';
		}
		
		/* Compose output */
		$out 	= '';
		$rel 	= '';
		$class  = '';
		
		$class .= 'button ' . $priority . ' ' . $size . ' ';
		$class .= $wide ? 'wide ' : '';
		
		switch ( $linking ) {			
			case 'lightbox':
				$rel .= 'prettyPhoto ';
				break;
			case 'new_window':	
			case 'new-window':
				$class .= 'new-window ';
				break;
			default:
				break;
		}	
		
		$out .= '<a class="' . esc_attr( $class ) . '" ';
		$out .= 'href="' . esc_url( $href ) . '" ';
		$out .= 'title="' . esc_attr( $title ) . '" ';
		$out .= 'rel="' . esc_attr( $rel ) . '"';
		$out .= '><span>' . esc_html( $content ) . '</span></a>';
				
		return $out;
	}
?>