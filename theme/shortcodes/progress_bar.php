<?php
	function btp_progress_bar_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'progress_bar',
			array(
				'label'			=> '[progress_bar] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'value', array(
						'label' => 'value *',
						'hint' => __( 'Integer value from 0 to 100', 'btp_theme' ),
					)),
				),
				'display'		=> 'block',
			)			 
		); 
	}

	function btp_progress_bar_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(			
			'value'			=> 50				
			), $atts ) );
			
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		
		$value = absint($value);
		if  ($value < 0 )
			$value = 0;

		if( $value > 100 )
			$value = 100;	
			
		
		/* Compose output */
		$out = '';
		$out .= '<p class="progress-bar">';
			$out .= '<span class="progress-bar-scale">';
				$out .= '<span class="progress-bar-value" style="width: '.esc_attr($value).'%;"></span>';
			$out .= '</span>';	
		$out .= '</p>';		
		
		return $out;
	}
	
	
	function btp_countdown_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'countdown',
			array(
				'label'			=> '[countdown] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'until', array(
						'label' => 'until *',
						'hint' => __( 'For example: 1 March 2012', 'btp_theme'),
					)),
				),
				'content' 		=> new BTP_Form_Unit_Textarea( 'expiry_text' ),
				'display'		=> 'block',
			)			 
		); 
	}
	
	function btp_countdown_shortcode( $atts, $content = null ) {
		add_action('wp_footer', 'btp_install_countdown_shortcode');
		
		extract( shortcode_atts( array(			
			'until'			=> null,				
			), $atts ) );
			
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		
		$until = strtotime($until);

		$until_year 	= date("Y", $until);
		$until_month 	= date("n", $until);
		$until_day 		= date("j", $until);
		$until_hours 	= date("G", $until);
		$until_minutes 	= intval(date("i", $until));
		$until_seconds 	= intval(date("s", $until));
					
		/* Compose output */
		$out = '';
		$out .= '<div class="countdown">';
			$out .= '<div class="metadata { ';
				$out .= 'until_year: \''.esc_attr($until_year).'\', '; 
				$out .= 'until_month: \''.esc_attr($until_month).'\', ';
				$out .= 'until_day: \''.esc_attr($until_day).'\', ';
				$out .= 'until_hours: \''.esc_attr($until_hours).'\', ';
				$out .= 'until_minutes: \''.esc_attr($until_minutes).'\', ';
				$out .= 'until_seconds: \''.esc_attr($until_seconds).'\'';
			$out .=	' }"></div>';	
			$out .= '<div class="countdown-inner"></div>';
			
			if( !empty( $content ) )
				$out .= '<div class="countdown-expiry-text">'.do_shortcode($content).'</div>';
						
			
		$out .= '</div>';		
		
		return $out;
	}
	
	function btp_install_countdown_shortcode()
	{
		wp_register_script('countdown', get_template_directory_uri().'/js/jquery.countdown/jquery.countdown.min.js', array('jquery'), '1.0', true); 
		wp_print_scripts('countdown');		
	}

?>