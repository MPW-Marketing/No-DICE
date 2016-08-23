<?php

	function btp_feeds_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'feeds',
			array(
				'label'			=> '[feeds] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'include', array(
						'hint' => __('Comma separated list of feeds to include', 'btp_theme')
					)),
					new BTP_Form_Unit_Input_Text( 'exclude', array(
						'hint' => __('Comma separated list of feeds to exclude', 'btp_theme')
					)),
					new BTP_Form_Unit_Select( 'template', array(
						'label' => 'template *',
						'choices'	=> 'btp_get_feed_collection_templates'
					)),
					new BTP_Form_Unit_Select( 'linking', array(
						'label' => 'linking *',
						'choices'		=> array(
								'default' 		=> 'default',
								'new-window'	=> 'new-window',
						)
					)),
					new BTP_Form_Unit_Input_Text( 'hide', array(
						'help' => __('<p>You can hide following elements:</p><ul><li>icon</li><li>label</li><li>caption</li></ul>', 'btp_theme'),
						'hint' => __('Comma separated list of elements to hide', 'btp_theme')
					)),
				),
				'display'		=> 'block',
			)			 
		); 
	}

	function btp_feeds_shortcode( $atts, $content = null ) {
		global $btp_theme_options, $btp_theme_slug;
		
		$templates = btp_get_feed_collection_templates();
		
		$feeds = array();

		/* Extract arguments */
		extract( shortcode_atts( array(			
			'include'			=> '',
			'exclude'			=> '',
			'template'			=> key($templates),
			'hide'				=> '',
			'linking'			=> 'default'			
		    ), $atts ) 
		);

		$hide = btp_string_to_bools($hide);
		
		/* Process 'include' variable */		
		$include = explode(',', $include);
		foreach ( $include as $feed ) {	
			$feed = preg_replace('/[^a-zA-Z0-9_-]*/', '', $feed);	
				
			if( !empty( $feed ) ) {
				$val = btp_get_theme_option( 'feeds_'.$feed );
				
				if ( $val['is_active'] == true ) {				
					$feeds[$feed] = array(
						'url'		=> $val['url'],					 
						'label'		=> $val['label'],
						'caption'	=> $val['caption'],
					);
				}				
			}
		}
		
		/* Populate 'feeds' array only if there are no feeds from 'include' variable */
		if ( !count( $feeds ) ) {					
			foreach ( $btp_theme_options as $id => $def ) {	
				if ( isset( $def['model']['update_func'] ) && $def['model']['update_func'] == 'feed') {			
					$val = get_option($id);
										
					if ( $val['is_active'] == true ) {									
						$feeds[str_replace($btp_theme_slug.'_feeds_', '', $id)] = array(
							'url'		=> $val['url'],					 
							'label'		=> $val['label'],
							'caption'	=> $val['caption'],
						);
					}	
				}			
			}
			
			/* Exclude feeds based on 'exclude' variable */
			if ( count( $feeds ) ) {
				$exclude = explode(',', $exclude);
				foreach ( $exclude as $feed ) {
					$feed = preg_replace('/[^a-zA-Z0-9_-]*/', '', $feed);
					
					if ( isset($feeds[$feed] ) )
						unset($feeds[$feed]);
				}
			}			
		}
		

		/* Compose output */
		$out = '';	
		$css_class = '';
		$css_class .= 'feeds '.esc_attr($template);
		$css_class .= !isset( $hide['icon'] ) ? '' : ' no-icon';

		$linking = ( $linking == 'new-window' ) ? ' class="new-window"' : '';
		
		if ( count( $feeds ) ) {				
			$out .= '<ul class="'.$css_class.'">';	
				
				foreach ( $feeds as $feed => $args ) {
					$out .= '<li class="feed-'.esc_attr($feed).'">';					
					
					if ( !isset( $hide['label'] ) || !isset( $hide['icon'] ) ) {
						$out .= '<h4><a href="'.esc_url($args['url']).'" title="'.esc_attr($args['label']).'"'.$linking.'>';						
							if ( !isset( $hide['icon'] ) ) {
							 	$out .= '<img src="'.get_bloginfo('template_url').'/images/icons/'.$feed.'.png" alt="'.esc_attr($feed).'"/>';
							}			
							if ( !isset( $hide['label'] ) ) {				
								$out .= '<span>'.esc_html($args['label']).'</span>';
							}															 
						$out .= '</a></h4>';
					}
									
					if ( !isset( $hide['caption'] ) ) {
						$out .= '<span class="meta">'.esc_html($args['caption']).'</span>';
					}
						
					$out .= '</li>';
				}					
			$out .= '</ul>';
		}				
		return $out;
	}
?>