<?php	

	function btp_pullquote_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'pullquote',
			array(
				'label'			=> '[pullquote] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Select( 'align', array(
						'label' => 'align *',
						'choices'	=> array(
								'left' 	=> 'left',
								'right'	=> 'right',
						),
					)),
				),
				'content'		=> new BTP_Form_Unit_Textarea( 'content', array(
					'label' => 'content *',
				)),
			)			 
		); 
	}


	function btp_pullquote_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(			
			'align'	=> 'left',			
			), $atts ) );
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);

		/* Compose output */
		$out = '';		
		$out .= '<span class="pullquote ' . esc_attr($align) . '">' . $content . '</span>';
		
		return $out;
	}
	
	
	
	function btp_message_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'message',
			array(
				'label'			=> '[message] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Select( 'type', array(
						'label' => 'type *',
						'choices'	=> array(
								'success' 	=> 'success',
								'info'		=> 'info',
								'warning'	=> 'warning',
								'error'		=> 'error',								
						)
					)),
				),
				'content'		=> new BTP_Form_Unit_Textarea( 'content', array(
					'label' => 'content *',
				)),
				'display'		=> 'block',	
			)			 
		); 
	}
	
	function btp_message_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(			
			'type'	=> 'success',			
			), $atts ) );
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);

		$out = '';	
		$out .= '<div class="'.esc_attr($type).' message"><div class="message-inner">'.$content.'</div></div>';		
		
		return $out;
	}
	
	
	function btp_dropcap_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'dropcap',
			array(
				'label'			=> '[dropcap] shortcode',
				'content'		=> new BTP_Form_Unit_Input_Text( 'letter', array(
					'label' => 'letter *',
				)),
			)			 
		); 
	}	
	
	function btp_dropcap_shortcode( $atts, $content = null ) {		
		return '<span class="dropcap">'.$content.'</span>';				
	}
	
	
	function btp_mark_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'mark',
			array(
				'label'			=> '[mark] shortcode',
				'content'		=> new BTP_Form_Unit_Textarea( 'content', array(
					'label' => 'content *',
				)),
			)			 
		); 
	}	
	
	function btp_mark_shortcode( $atts, $content = null ) {		
		return '<span class="mark">'.$content.'</span>';				
	}
	
	
	
	
	function btp_checklist_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'checklist',
			array(
				'label'			=> '[checklist] shortcode',
				'content'		=> new BTP_Form_Unit_Textarea( 'content', array(
					'label' => 'content *',
				)),
				'display'		=> 'block',
			)		
		); 
	}
	
	function btp_checklist_shortcode( $atts, $content = null ) {    
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		
		$content = str_replace('<ul>', '<ul class="checklist">', 
    	do_shortcode($content));    	
    	
    	return $content;
	}
	
	
	
	function btp_crosslist_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'crosslist',
			array(
				'label'			=> '[crosslist] shortcode',
				'content'		=> new BTP_Form_Unit_Textarea( 'content', array(
					'label' => 'content *',
				)),
				'display'		=> 'block',
			)		
		); 
	}
	
	function btp_crosslist_shortcode( $atts, $content = null ) {    
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		
		$content = str_replace('<ul>', '<ul class="crosslist">', 
    	do_shortcode($content));    	
    	
    	return $content;
	}
	
	
	function btp_divider_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'divider',
			array(
				'label'			=> '[divider] shortcode',
				'result'		=> '[divider]',
				'display'		=> 'block',
			)		
		); 
	}
	
	function btp_divider_shortcode( $atts, $content = null ) {			
		$out = '';	
		$out = '<span class="divider"></span>';
		    
		return $out;    
	}
	
	
	function btp_divider_top_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'divider_top',
			array(
				'label'			=> '[divider_top] shortcode',
				'result'		=> '[divider_top]',
				'display'		=> 'block',
			)		
		); 
	}
	
	function btp_divider_top_shortcode( $atts, $content = null ) {			
		$out = '';	
		$out = '<span class="divider-top"><span><a class="meta" href="#">'.__('Top', 'btp_theme').'</a></span></span>';
		    
		return $out;    
	}
	
	
	function btp_space_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'space',
			array(
				'label'			=> '[space] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Select( 'px', array(
						'label' => 'px *',
						'hint' => __( 'In pixels', 'btp_theme' ),
					)),
				),
				'display'		=> 'block',	
			)			 
		); 
	}
	
	function btp_space_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(			
			'px'	=> 0,			
		), $atts ) );
				
		$out = '';
		$out .= '<div class="space" style="height: '.absint($px).'px;"></div>';

		return $out;
	}
	
	function btp_clear_shortcode( $atts, $content = null ) {
		return '<span class="clear"></span>';
	}
	
?>