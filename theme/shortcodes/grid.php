<?php

	function btp_c_3_c_9_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** c_3 + c_9',
			array(
				'label'			=> 'c_3 + c_9 shortcode set',
				'result'		=> '[c_3 first="true"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/c_3]'
									. "\n\n"  	
									. '[c_9 last="true"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_9]',
			)			 
		); 
	}

	function btp_c_3_c_3_c_3_c_3_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** c_3 + c_3 + c_3 + c_3',
			array(
				'label'			=> 'c_3 + c_3 + c_3 + c_3 shortcode set',
				'result'		=> '[c_3 first="true"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/c_3]'
									. "\n\n"
									. '[c_3]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_3]'
									. "\n\n"
									. '[c_3]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_3]'
									. "\n\n"  	
									. '[c_3 last="true"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_3]',
			)			 
		); 
	}

	function btp_c_4_c_4_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** c_4 + c_4',
			array(
				'label'			=> 'c_4 + c_4 shortcode set',
				'result'		=> '[c_4 first="true"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/c_4]'
									. "\n\n" 	
									. '[c_4 last="true"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_4]',
			)			 
		); 
	}
	
	function btp_c_4_c_8_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** c_4 + c_8',
			array(
				'label'			=> 'c_4 + c_8 shortcode set',
				'result'		=> '[c_4 first="true"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/c_4]'
									. "\n\n" 	
									. '[c_8 last="true"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_8]',
			)			 
		); 
	}

	function btp_c_4_c_4_c_4_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** c_4 + c_4 + c_4',
			array(
				'label'			=> 'c_4 + c_4 + c_4 shortcode set',
				'result'		=> '[c_4 first="true"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/c_4]'
									. "\n\n"
									. '[c_4]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_4]'
									. "\n\n" 	
									. '[c_4 last="true"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_4]',
			)			 
		); 
	}

	function btp_c_6_c_6_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** c_6 + c_6',
			array(
				'label'			=> 'c_6 + c_6 shortcode set',
				'result'		=> '[c_6 first="true"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/c_6]'
									. "\n\n"
									. '[c_6 last="true"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_6]',
			)			 
		); 
	}
	
	function btp_c_8_c_4_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** c_8 + c_4',
			array(
				'label'			=> 'c_8 + c_4 shortcode set',
				'result'		=> '[c_8 first="true"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/c_8]'
									. "\n\n" 	
									. '[c_4 last="true"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_4]',
			)			 
		); 
	}

	function btp_c_9_c_3_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** c_9 + c_3',
			array(
				'label'			=> 'c_9 + c_3 shortcode set',
				'result'		=> '[c_9 first="true"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/c_9]'
									. "\n\n" 	
									. '[c_3 last="true"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/c_3]',
			)			 
		); 
	}
	
	function btp_c_x_shortcode_generator_item( $x ) {
		return new BTP_Shortcode_Generator_Item( 
			'c_'. intval( $x ),
			array(
				'label'			=> '[c_' . intval( $x ) .'] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Checkbox( 'first' ),
					new BTP_Form_Unit_Checkbox( 'last' ),
				),
				'content'		=> new BTP_Form_Unit_Textarea( 'label', array(
					'value'		=> __('some text goes here...', 'btp_theme')
				)),
				'display'		=> 'block',
			)			 
		); 
	}
	
	function btp_c_1_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 1 ); }
	function btp_c_2_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 2 ); }
	function btp_c_3_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 3 ); }
	function btp_c_4_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 4 ); }
	function btp_c_5_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 5 ); }
	function btp_c_6_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 6 ); }
	function btp_c_7_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 7 ); }
	function btp_c_8_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 8 ); }
	function btp_c_9_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 9 ); }
	function btp_c_10_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 10 ); }
	function btp_c_11_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 11 ); }
	function btp_c_12_shortcode_generator_item()  { return btp_c_x_shortcode_generator_item( 12 ); }


	function btp_grid_c_x($x, $atts, $content = null) 
	{
		 extract( shortcode_atts( array(
			'first' => false,
			'last'	=> false,			
			), $atts ) );
			
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		
		//$content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
		
		
		//var_dump(htmlspecialchars( $content ));
		
		$out = '';
		
		if($first) 
			$out .= '<div class="grid">';
		
		if($last)
			$out .= '<div class="c-'.esc_attr($x).'">'.do_shortcode(shortcode_unautop($content)).'</div></div>';
		else
			$out .= '<div class="c-'.esc_attr($x).'">'.do_shortcode(shortcode_unautop($content)).'</div>';			
			
		//if($last)
		//	$out .= '<div class="c-'.esc_attr($x).'">'.do_shortcode($content).'</div></div>';
		//else
		//	$out .= '<div class="c-'.esc_attr($x).'">'.do_shortcode($content).'</div>';

		//$out = wpautop($out);	
		
		//var_dump(htmlspecialchars($out));
			
			
		return $out;
	}
	
	function btp_c_1_shortcode($atts, $content = null)  { return btp_grid_c_x(1, $atts, $content); }
	function btp_c_2_shortcode($atts, $content = null)  { return btp_grid_c_x(2, $atts, $content); }
	function btp_c_3_shortcode($atts, $content = null)  { return btp_grid_c_x(3, $atts, $content); }
	function btp_c_4_shortcode($atts, $content = null)  { return btp_grid_c_x(4, $atts, $content); }
	function btp_c_5_shortcode($atts, $content = null)  { return btp_grid_c_x(5, $atts, $content); }
	function btp_c_6_shortcode($atts, $content = null)  { return btp_grid_c_x(6, $atts, $content); }
	function btp_c_7_shortcode($atts, $content = null)  { return btp_grid_c_x(7, $atts, $content); }
	function btp_c_8_shortcode($atts, $content = null)  { return btp_grid_c_x(8, $atts, $content); }
	function btp_c_9_shortcode($atts, $content = null)  { return btp_grid_c_x(9, $atts, $content); }
	function btp_c_10_shortcode($atts, $content = null) { return btp_grid_c_x(10, $atts, $content); }
	function btp_c_11_shortcode($atts, $content = null) { return btp_grid_c_x(11, $atts, $content); }
	function btp_c_12_shortcode($atts, $content = null) { return btp_grid_c_x(12, $atts, $content); }
	function btp_c_13_shortcode($atts, $content = null) { return btp_grid_c_x(13, $atts, $content); }
	function btp_c_14_shortcode($atts, $content = null) { return btp_grid_c_x(14, $atts, $content); }
	function btp_c_15_shortcode($atts, $content = null) { return btp_grid_c_x(15, $atts, $content); }
	function btp_c_16_shortcode($atts, $content = null) { return btp_grid_c_x(16, $atts, $content); }
	function btp_c_17_shortcode($atts, $content = null) { return btp_grid_c_x(17, $atts, $content); }
	function btp_c_18_shortcode($atts, $content = null) { return btp_grid_c_x(18, $atts, $content); }
	function btp_c_19_shortcode($atts, $content = null) { return btp_grid_c_x(19, $atts, $content); }
	function btp_c_20_shortcode($atts, $content = null) { return btp_grid_c_x(20, $atts, $content); }
	function btp_c_21_shortcode($atts, $content = null) { return btp_grid_c_x(21, $atts, $content); }
	function btp_c_22_shortcode($atts, $content = null) { return btp_grid_c_x(22, $atts, $content); }
	function btp_c_23_shortcode($atts, $content = null) { return btp_grid_c_x(23, $atts, $content); }
	function btp_c_24_shortcode($atts, $content = null) { return btp_grid_c_x(24, $atts, $content); }

?>