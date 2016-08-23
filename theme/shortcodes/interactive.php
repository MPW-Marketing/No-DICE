<?php

	function btp_toggle_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'toggle',
			array(
				'label'			=> '[toggle] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'title', array(
						'label' => 'title *',
					)),
					new BTP_Form_Unit_Checkbox( 'on', array(
						'hint' => __( 'Check to expand', 'btp_theme' ),
					)),
				),
				'content'		=> new BTP_Form_Unit_Textarea( 'content', array(
					'value'			=> __('some text goes here...', 'btp_theme'),				
				)),
				'display'		=> 'block',
			)			 
		); 
	}
	
	function btp_toggle_shortcode($atts, $content = null) 
	{
		 extract( shortcode_atts( array(
			'title' 	=> '...',
			'on'		=> false,			
			), $atts ) );
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		
		$out = '';
		if($on)
			$out .= '<div class="toggle toggle-on">';
		else
			$out .= '<div class="toggle toggle-off">';
		
		$out .= '<div class="toggle-title"><h4>'.$title.'</h4></div>';
		$out .= '<div class="toggle-content"><div class="block">'.do_shortcode( shortcode_unautop( $content ) ).'</div></div>';
		$out .= '</div>';
		
		return $out;
	}
	
	
	
	function btp_accordion_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'accordion',
			array(
				'label'			=> '[accordion_shortcode]',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'title', array(
						'label' => 'title *',
					)),
					new BTP_Form_Unit_Checkbox( 'first' ),
					new BTP_Form_Unit_Checkbox( 'last' ),
				),
				'content'		=> new BTP_Form_Unit_Textarea( 'content', array(
					'value'			=> __('some text goes here...', 'btp_theme'),				
				)),
				'display'		=> 'block',
			)			 
		); 
	}
	
	function btp_2_accordions_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** 2 accordions',
			array(
				'label'			=> __('2 accordions shortcode set', 'btp_theme'),
				'result'		=> '[accordion first="true" title="Title 1"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/accordion]'
									. "\n\n" 	
									. '[accordion last="true" title="Title 2"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/accordion]',
			)			 
		); 
	}
	
	function btp_3_accordions_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** 3 accordions',
			array(
				'label'			=> __('3 accordions shortcode set', 'btp_theme'),
				'result'		=> '[accordion first="true" title="Title 1"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/accordion]'
									. "\n\n" 	
									. '[accordion title="Title 2"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/accordion]'
									. "\n\n"
									. '[accordion last="true" title="Title 3"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/accordion]',
			)			 
		); 
	}
	
	function btp_4_accordions_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** 4 accordions',
			array(
				'label'			=> __('4 accordions shortcode set', 'btp_theme'),
				'result'		=> '[accordion first="true" title="Title 1"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/accordion]'
									. "\n\n" 	
									. '[accordion title="Title 2"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/accordion]'
									. "\n\n"
									. '[accordion title="Title 3"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/accordion]'
									. "\n\n"
									. '[accordion last="true" title="Title 4"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/accordion]',
			)			 
		); 
	}
	
	function btp_accordion_shortcode($atts, $content = null) 
	{
		 extract( shortcode_atts( array(
			'title' 	=> '...',
			'first'		=> false,			
			'last'		=> false,
			), $atts ) );
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		
		$out = '';
		
		if($first) 
			$out .= '<div class="accordion">';
		
		$out .= '<div class="accordion-panel">';
			$out .= '<div class="accordion-panel-title"><h4>'.$title.'</h4></div>';
			$out .= '<div class="accordion-panel-content"><div class="block">'.do_shortcode( shortcode_unautop( $content ) ).'</div></div>';
		$out .= '</div>';
		
		if($last)
			$out .= '</div><!-- END: .accordion -->';
		
		return $out;
	
	}
	
	
	
	function btp_tab_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'tab',
			array(
				'label'			=> '[tab] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'title', array(
						'label' => 'title *',
					)),
					new BTP_Form_Unit_Checkbox( 'first' ),
					new BTP_Form_Unit_Checkbox( 'last' ),
				),
				'content'		=> new BTP_Form_Unit_Textarea( 'content', array(
					'value'			=> __('some text goes here...', 'btp_theme'),				
				)),
				'display'		=> 'block',
			)			 
		); 
	}
	
	function btp_2_tabs_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** 2 tabs',
			array(
				'label'			=> __('2 tabs shortcode set', 'btp_theme'),
				'result'		=> '[tab first="true" title="Title 1"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/tab]'
									. "\n\n" 	
									. '[tab last="true" title="Title 2"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/tab]',
			)			 
		); 
	}
	
	function btp_3_tabs_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** 3 tabs',
			array(
				'label'			=> __('3 tabs shortcode set', 'btp_theme'),
				'result'		=> '[tab first="true" title="Title 1"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/tab]'
									. "\n\n" 
									. '[tab title="Title 2"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/tab]'
									. "\n\n"	
									. '[tab last="true" title="Title 3"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/tab]',
			)			 
		); 
	}
	
	function btp_4_tabs_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'*** 4 tabs',
			array(
				'label'			=> __('4 tabs shortcode set', 'btp_theme'),
				'result'		=> '[tab first="true" title="Title 1"]' 
									. "\n\n" 
									. 'some text goes here...' 
									. "\n\n"
									. '[/tab]'
									. "\n\n" 
									. '[tab title="Title 2"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/tab]'
									. "\n\n" 
									. '[tab title="Title 3"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/tab]'
									. "\n\n"	
									. '[tab last="true" title="Title 4"]'
									. "\n\n"
									. 'some text goes here...'
									. "\n\n"
									. '[/tab]',
			)			 
		); 
	}
	
	function btp_tab_shortcode($atts, $content = null) 
	{
		 extract( shortcode_atts( array(
			'title' 	=> '...',
			'first'		=> false,			
			'last'		=> false,
			), $atts ) );
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		
		$out = '';
		
		if($first) 
			$out .= '<div class="tabs">';
		
		$out .= '<div class="tab">';		
			
		$out .= '<div class="tab-title">'.$title.'</div>';
		$out .= '<div class="tab-content">'.do_shortcode( shortcode_unautop( $content ) ).'</div>';
		$out .= '</div>';
		
		if($last)
			$out .= '</div>';
		
		return $out;
	
	}
	
?>