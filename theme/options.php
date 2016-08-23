<?php

function btp_add_theme_options() 
{
	global $btp_theme, $btp_theme_slug, $btp_theme_options;  
    
	/*
	 * 'id'	=> array(
	 * 
	 * 	'model'	=> array(
	 *		'update_func'	=> string,
	 *		'null'			=> string,
	 *		'default'		=> string,
	 *		'options'		=> array|callback 	 
	 *  ),  
	 *  view	=> array(
	 *  	'render_func	=> 'string,
	 *  	'label'			=> __('Label', 'btp_theme'),
	 *  	'description'	=> __('Description', 'btp_theme'), 
	 *  	'hint'			=> __('Hint', 'btp_theme'),
	 *  )
	 *  'customize'			=> bool
	 * )
	 */
	
	$btp_theme_options_general = array(   
		$btp_theme_slug.'_general_main_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Main', 'btp_theme'))),
		$btp_theme_slug.'_general_logo_src' => array(
			'model'		=> array(			 
			),
			'view'		=> array(
				'render_func'	=> 'input_text',
				'label'			=> __('Logo source', 'btp_theme'),
				'hint'			=> __('E.g. http://www.company.com/images/logo.png<br />You can <a href="http://dice.localhost/wp-admin/media-new.php">use WordPress Media Library</a> to upload your image', 'btp_theme'),	
			)				
		),
		$btp_theme_slug.'_general_favicon_src' => array(
			'model'		=> array(),
			'view'		=> array(				
				'render_func'	=> 'input_text',	
				'label'			=> __('Favicon source', 'btp_theme'),
				'hint'			=> __('E.g. http://www.company.com/images/favicon.ico<br />You can <a href="http://dice.localhost/wp-admin/media-new.php">use WordPress Media Library</a> to upload your icon', 'btp_theme'),
			),				
		),
		$btp_theme_slug.'_general_apple_touch_icon_src' => array(
			'model'		=> array(),
			'view'		=> array(				
				'render_func'	=> 'input_text',
				'label'			=> __('Apple touch icon source', 'btp_theme'),	
				'hint'			=> __('E.g. http://www.company.com/images/apple_touch.png<br />You can <a href="http://dice.localhost/wp-admin/media-new.php">use WordPress Media Library</a> to upload your image', 'btp_theme'),			
			),
		),
		$btp_theme_slug.'_general_preheader_enable' => array(
        	'model'		=> array(
        		'default'   	=> false,
        	),
        	'view'		=> array(
	        	'render_func'	=> 'input_checkbox',	
        		'label'     	=> __('Preheader - enable?', 'btp_theme'),
	        	'metadata'		=> true
        	),
        ),
        $btp_theme_slug.'_general_preheader_sidebar_layout' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
		        'render_func'	=> 'input_text',	
    	    	'label'     	=> __('Preheader sidebars layout', 'btp_theme'),
	            'hint'      	=> __('E.g. 4,4,4', 'btp_theme'),  
            ),
        ), 
		$btp_theme_slug.'_general_search_form_enable' => array(
        	'model'		=> array(
        		'default'   => true
        	),
        	'view'		=> array( 
        		'render_func'	=> 'input_checkbox',	
        		'label'    	 	=> __('Search form - enable?', 'btp_theme'),
        	),
        ),		
        $btp_theme_slug.'_general_breadcrumbs_enable' => array(
        	'model'		=> array(
        		'default'   => true
        	),
        	'view'		=> array( 
        		'render_func'	=> 'input_checkbox',	
        		'label'    	 	=> __('Breadcrumbs - enable?', 'btp_theme'),
        	),
        ),        
        $btp_theme_slug.'_general_prefooter_sidebar_layout' => array(
			'model'		=> array(
        	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Prefooter sidebars layout', 'btp_theme'),
	            'hint'      	=> __('E.g. 4,4,4', 'btp_theme'),	        	
        	),
        ),   
        $btp_theme_slug.'_general_footer_text' => array(
			'model'		=> array(
        	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Footer text', 'btp_theme'),
	            'hint'      	=> __('E.g. Copyright 2011 by MyCompany', 'btp_theme'),	        	
        	),
        ),
        $btp_theme_slug.'_general_global_dice_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
        
        $btp_theme_slug.'_general_slider_dice_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('DICE slider', 'btp_theme'))),                
        
        
        $btp_theme_slug.'_general_slider_dice_vertical_segments' => array(
			'model'		=> array(        		
        		'default' 		=> '4'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Vertical segments', 'btp_theme')
        	),
        ),        
        $btp_theme_slug.'_general_slider_dice_horizontal_segments' => array(
			'model'		=> array(        		
        		'default' 		=> '4'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Horizontal segments', 'btp_theme')
        	),
        ),        
         $btp_theme_slug.'_general_slider_dice_depth' => array(
			'model'		=> array(        		
        		'default' 		=> '80'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Depth', 'btp_theme')
        	),
        ),
        
        
        
        $btp_theme_slug.'_general_slider_dice_transition' => array(
			'model'		=> array(
        		'options'		=> 'btp_get_dice_slider_transition_methods',
        		'default' 		=> 'FromTopRight'
        			
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'select',	
        		'label'     	=> __('Transition', 'btp_theme')
        	),
        ),
       
        
        
        $btp_theme_slug.'_general_slider_dice_tween_time' => array(
			'model'		=> array(        		
        		'default' 		=> '1'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Tween time', 'btp_theme')
        	),
        ),
        
        $btp_theme_slug.'_general_slider_dice_tween_delay' => array(
			'model'		=> array(        		
        		'default' 		=> '0.05'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Tween delay', 'btp_theme')
        	),
        ),
        
         $btp_theme_slug.'_general_slider_dice_easing' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_dice_slider_easing_methods',
        		'default'		=> 'easeInOutCubic'
        	),        	
        	'view'		=> array(
        		'render_func'	=> 'select',	
        		'label'     	=> __('Easing', 'btp_theme')
        	),
        ),
        
        $btp_theme_slug.'_general_slider_dice_tween_timeout' => array(
			'model'		=> array(        		
        		'default' 		=> '4'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Timeout', 'btp_theme')
        	),
        ),
        
        $btp_theme_slug.'_general_slider_dice_x_distance_multiply' => array(
			'model'		=> array(        		
        		'default' 		=> '1.5'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('X distance multiply', 'btp_theme')
        	),
        ),
        
        
        
        $btp_theme_slug.'_general_slider_dice_y_distance_multiply' => array(
			'model'		=> array(        		
        		'default' 		=> '1.5'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Y distance multiply', 'btp_theme')
        	),
        ),
        
        $btp_theme_slug.'_general_slider_dice_z_distance' => array(
			'model'		=> array(        		
        		'default' 		=> '2000'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Z distance', 'btp_theme')
        	),
        ),

        $btp_theme_slug.'_general_slider_dice_autoplay' => array(
			'model'		=> array(        		
        		'default' 		=> true
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_checkbox',	
        		'label'     	=> __('Autoplay?', 'btp_theme')
        	),
        ),        
        $btp_theme_slug.'_general_slider_dice_autoplay_pause' => array(
			'model'		=> array(        		
        		'default' 		=> true
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_checkbox',	
        		'label'     	=> __('Pause on hover?', 'btp_theme')
        	),
        ),
        
        $btp_theme_slug.'_general_slider_dice_cube_side_color' => array(
			'model'		=> array(
        		'default'	=> '#333333'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'color',	
        		'label'     	=> __('Cube side color', 'btp_theme')
        	),
        ),
        
        
        $btp_theme_slug.'_general_slider_dice_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
        
        
        $btp_theme_slug.'_general_slider_kwicks_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Kwicks slider', 'btp_theme'))),
       
        $btp_theme_slug.'_general_slider_kwicks_duration' => array(
			'model'		=> array(        		        		
        		'default' 		=> '0.5'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'input_text',	
        		'label'     	=> __('Transition speed', 'btp_theme'),
          		'hint'			=> __('Enter the number of seconds, e.g. 1.5', 'btp_theme'),
          	),
        ),        
        $btp_theme_slug.'_general_slider_kwicks_easing' => array(
			'model'		=> array(        		
        		'options'		=> 'btp_get_kwicks_slider_easing_methods',
        		'default' 		=> 'easeInOutQuint'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'select',	
        		'label'     	=> __('Easing', 'btp_theme'),
        	),
        ),        
        $btp_theme_slug.'_general_slider_kwicks_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
        
        $btp_theme_slug.'_general_slider_cycle_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Cycle slider', 'btp_theme'))),        
        $btp_theme_slug.'_general_slider_cycle_fx' => array(
			'model'		=> array(        		
        		'options'		=> 'btp_get_cycle_slider_transition_methods',
        		'default' 		=> 'scrollHorz'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'select',	
        		'label'     	=> __('Transition', 'btp_theme'),
        	),
        ),
        $btp_theme_slug.'_general_slider_cycle_speed' => array(
        	'model'		=> array(
        		'default'		=> '1',        		
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_text',
        		'label'			=> __('Transition speed', 'btp_theme'),
        		'hint'			=> __('Enter the number of seconds, e.g. 1.5', 'btp_theme'),
        	)
        ),
         $btp_theme_slug.'_general_slider_cycle_easing' => array(
			'model'		=> array(        		
        		'options'		=> 'btp_get_cycle_slider_easing_methods',	
        		'default' 		=> 'easeInOutExpo'
          	),
        	'view'		=> array(        	
	        	'render_func'	=> 'select',	
        		'label'     	=> __('Easing', 'btp_theme'),
        	),
        ),        
        // milliseconds between slide transitions (0 to disable auto advance) 
        $btp_theme_slug.'_general_slider_cycle_timeout' => array(
        	'model'		=> array(
        		'default'		=> '4',        		
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_text',
        		'label'			=> __('Timeout', 'btp_theme'),
        		'hint'			=> __('Enter the number of seconds, e.g. 1.5', 'btp_theme'),
        	)
        ),       
        $btp_theme_slug.'_general_slider_cycle_pause' => array(
        	'model'		=> array(
        		'default'		=> true,        		
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',
        		'label'			=> __('Pause on hover?', 'btp_theme'),
        	)
        ),
        
        $btp_theme_slug.'_general_slider_cyle_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
	);
	
	
	$btp_theme_options_style = array (
		$btp_theme_slug.'_style_main_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Main', 'btp_theme'))),	
		$btp_theme_slug.'_style_skin' => array(
			'model'		=> array(				
				'null'			=> '',
				'options'		=> 'btp_get_skins_mapping',
				'default'		=> 'valley-black'
			),
			'view'		=> array(
				'render_func'	=> 'select',
        		'label'     => __('Skin', 'btp_theme'),
			),
			'customize'	=> true
		),
	
    	$btp_theme_slug.'_style_theme_alignment' => array(
			'model'		=> array(
    			'null'		=> '',    			
				'options'   => array(
								'left'		=> __('Left', 'btp_theme'), 
								'center'	=> __('Center', 'btp_theme'), 
								'right'		=> __('Right', 'btp_theme')
    			),
			),
			'view'		=> array(
				'render_func'	=> 'select',
        		'label'     => __('Theme alignment', 'btp_theme'),
            )
        ),       
        $btp_theme_slug.'_style_font_replacement_enable' => array(
        	'model'		=> array(				
				'default'		=> false,
			),		
			'view'		=> array(
				'render_func'	=> 'input_checkbox',
				'label'     	=> __('Font replacement - enable?', 'btp_theme'),
				'metadata'		=> true				
			)          
        ),
        $btp_theme_slug.'_style_font_replacement_font' => array(
        	'model'		=> array(
        		'options'		=> 'btp_get_fonts',
			),		
			'view'		=> array(
				'render_func'	=> 'select',
				'label'     	=> __('Font replacement', 'btp_theme'),
			)          
        ),
        $btp_theme_slug.'_style_custom_styles_enable' => array(
			'model'		=> array(
    			'default'	=> false
			),
			'view'		=> array(
				'render_func'	=> 'input_checkbox',
        		'label'     => __('Custom styles - enable?', 'btp_theme'),
            )
        ),
        
        
        $btp_theme_slug.'_style_main_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
        
	
		$btp_theme_slug.'_style_preheader_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Preheader', 'btp_theme'), 'color' => '#ffa000' )),
		
		$btp_theme_slug.'_style_preheader_toggle_alignment' => array(
			'model'		=> array(  
				'null'		=> '',  			
				'options'   => array(
						'left-screen'		=> __('Left-screen', 'btp_theme'),
						'left-outside' 		=> __('Left-outside', 'btp_theme'),
						'left-inside'		=> __('Left-inside', 'btp_theme'),
						'center' 			=> __('Center', 'btp_theme'),
						'right-inside'		=> __('Right-inside', 'btp_theme'),
						'right-outside' 	=> __('Right-outside', 'btp_theme'),
						'right-screen'		=> __('Right-screen', 'btp_theme')
				),
			),
			'view'		=> array(
				'render_func'	=> 'select',
        		'label'     => __('Toggle alignment', 'btp_theme'),
            )
        ),
		
        $btp_theme_slug.'_style_preheader_basic_colors' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Basics', 'btp_theme'))),
		$btp_theme_slug.'_style_preheader_background_color' => array(
			'model'		=> array(			
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),	
			)            
        ),
    	    	
		$btp_theme_slug.'_style_preheader_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'	=> 'color',
        		'label'     => __('Text Color', 'btp_theme'),
            )
        ),        
        $btp_theme_slug.'_style_preheader_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(        	
	        	'render_func'   => 'color',	
        		'label'     	=> __('Link color', 'btp_theme'),
            ),            
        ),
        $btp_theme_slug.'_style_preheader_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'   => 'color',
        		'label'    		=> __('Link hover color', 'btp_theme'),	
        	)
        ),
        $btp_theme_slug.'_style_preheader_line_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Line color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_preheader_meta_colors' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Meta', 'btp_theme'))),
        $btp_theme_slug.'_style_preheader_meta_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
				'render_func'   => 'color',
        		'label'     	=> __('Text color', 'btp_theme'),
        	)
        ),        
        $btp_theme_slug.'_style_preheader_meta_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link color', 'btp_theme'),
        	)
        ), 
        $btp_theme_slug.'_style_preheader_meta_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'label'     => __('Link hover color', 'btp_theme'),            
            	'render_func'      => 'color',            
        	)            
        ),
        $btp_theme_slug.'_style_preheader_primary_colors' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Primary', 'btp_theme'))),
        $btp_theme_slug.'_style_preheader_primary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),
        
        $btp_theme_slug.'_style_preheader_primary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),
        
        $btp_theme_slug.'_style_preheader_primary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),
        
        $btp_theme_slug.'_style_preheader_primary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),
        $btp_theme_slug.'_style_preheader_secondary_colors' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Secondary', 'btp_theme'))),
        $btp_theme_slug.'_style_preheader_secondary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),
        
        $btp_theme_slug.'_style_preheader_secondary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text Color', 'btp_theme'),
        	)	            
        ),
        
        $btp_theme_slug.'_style_preheader_secondary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),
        
        $btp_theme_slug.'_style_preheader_secondary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),
        $btp_theme_slug.'_style_preheader_tertiary_colors' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Tertiary', 'btp_theme'))),
        $btp_theme_slug.'_style_preheader_tertiary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),
        
        $btp_theme_slug.'_style_preheader_tertiary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),
        
        $btp_theme_slug.'_style_preheader_tertiary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),
        
        $btp_theme_slug.'_style_preheader_tertiary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),
        $btp_theme_slug.'_style_preheader_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')), 
        
        
        $btp_theme_slug.'_style_header_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Header', 'btp_theme'), 'color' => '#feee00')),

        
        $btp_theme_slug.'_style_header_layout' => array(
			'model'		=> array(
        		'null'			=> '',
        		'options'		=> array(
        							'boxed'			=> __('Boxed', 'btp_theme'),	 
        							'stretched'		=> __('Stretched', 'btp_theme')
        		),
			),
			'view'		=> array(
				'render_func'      => 'select',
        		'label'     => __('Layout', 'btp_theme'),	
			)            
        ),
		$btp_theme_slug.'_style_header_margin_top' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Margin top', 'btp_theme'),	
			)            
        ),
        
        $btp_theme_slug.'_style_header_border_top_width' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Border top width', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_header_border_top_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Border top color', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_header_logo_margin_top' => array(
			'model'		=> array( 
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Logo margin top', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_header_logo_alignment' => array(
			'model'		=> array(
        		'null'		=> '',
				'options'   => array(
								'left' 		=> __('Left', 'btp_theme'), 
								'right'		=> __('Right', 'btp_theme')
       			),
			),
			'view'		=> array(
				'render_func'	=> 'select',
        		'label'     => __('Logo alignment', 'btp_theme'),
            )
        ),        
		$btp_theme_slug.'_style_header_logo_margin_bottom' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Logo margin bottom', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_header_padding_bottom' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Padding bottom', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_header_border_bottom_width' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Border bottom width', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_header_border_bottom_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Border bottom color', 'btp_theme'),	
			)            
        ),
        
        $btp_theme_slug.'_style_header_margin_bottom' => array(
			'model'		=> array( 
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Margin bottom', 'btp_theme'),	
			)            
        ),        
        $btp_theme_slug.'_style_header_basic_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Basic Scheme', 'btp_theme'))),
        $btp_theme_slug.'_style_header_background_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_header_background_opacity' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Background opacity', 'btp_theme'),	
			)            
        ),
		$btp_theme_slug.'_style_header_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),	
			)            
        ),        
        $btp_theme_slug.'_style_header_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link color', 'btp_theme'),	
        	)           
        ),
        $btp_theme_slug.'_style_header_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link hover color', 'btp_theme'),
        	)
        ),
		$btp_theme_slug.'_style_header_line_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Line color', 'btp_theme'),
        	)
        ),
        
        $btp_theme_slug.'_style_header_meta_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Meta Scheme', 'btp_theme'))),      
        $btp_theme_slug.'_style_header_meta_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Meta color', 'btp_theme'),	
        	)
        ),        
        $btp_theme_slug.'_style_header_meta_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Meta link color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_header_meta_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Meta link hover color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_header_menu_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Menu Scheme', 'btp_theme'))),
        $btp_theme_slug.'_style_header_primary_bar_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_header_primary_bar_background_opacity' => array(
        	'model'		=> array(
           	),
        	'view'		=> array(
        		'render_func'      => 'input_text',
        		'label'     => __('Background opacity', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_header_menu_1_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_header_menu_1_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link hover color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_header_submenu_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Submenu Scheme', 'btp_theme'))),
        $btp_theme_slug.'_style_header_menu_sub_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_header_menu_sub_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_header_menu_sub_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_header_menu_sub_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link hover color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_header_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
        
        
        $btp_theme_slug.'_style_precontent_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Precontent', 'btp_theme'), 'color' => '#ffa000' )),
		$btp_theme_slug.'_style_precontent_layout' => array(
			'model'		=> array(
        		'null'			=> '',
        		'options'		=> array(
        							'boxed'			=> __('Boxed', 'btp_theme'),	 
        							'stretched'		=> __('Stretched', 'btp_theme')
        		),
			),
			'view'		=> array(
				'render_func'      => 'select',
        		'label'     => __('Layout', 'btp_theme'),	
			)            
        ),  
        $btp_theme_slug.'_style_precontent_border_top_width' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Border top width', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_precontent_border_top_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Border top color', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_precontent_padding_top' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Padding top', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_precontent_padding_bottom' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Padding bottom', 'btp_theme'),	
			)            
        ), 
        $btp_theme_slug.'_style_precontent_border_bottom_width' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Border bottom width', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_precontent_border_bottom_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Border bottom color', 'btp_theme'),	
			)            
        ),        
        $btp_theme_slug.'_style_precontent_margin_bottom' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Margin bottom', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_precontent_slider_shadow_enable' => array(
			'model'		=> array(
        		'null'			=> '',
        		'options'		=> array(        				
        				'yes'	=> __('Yes', 'btp_theme'),
        				'no'	=> __('No', 'btp_theme'),		
        		),
			),
			'view'		=> array(
				'render_func'      => 'select',
        		'label'     => __('Slider shadow - enable?', 'btp_theme'),	
			)            
        ),   
        $btp_theme_slug.'_style_precontent_basic_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Basic Scheme', 'btp_theme'))),
        $btp_theme_slug.'_style_precontent_background_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_precontent_background_opacity' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Background opacity', 'btp_theme'),	
			)            
        ),    	    	
		$btp_theme_slug.'_style_precontent_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'	=> 'color',
        		'label'     => __('Text color', 'btp_theme'),
            )
        ),        
        $btp_theme_slug.'_style_precontent_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(        	
	        	'render_func'   => 'color',	
        		'label'     	=> __('Link color', 'btp_theme'),
            ),            
        ),
        $btp_theme_slug.'_style_precontent_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'   => 'color',
        		'label'    		=> __('Link hover color', 'btp_theme'),	
        	)
        ),       
        $btp_theme_slug.'_style_precontent_line_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Line color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_precontent_meta_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Meta Scheme', 'btp_theme'))),        
        $btp_theme_slug.'_style_precontent_meta_color' => array(
        	'model'		=> array(	
        	),
        	'view'		=> array(
				'render_func'   => 'color',
        		'label'     	=> __('Text color', 'btp_theme'),
        	)
        ),        
        $btp_theme_slug.'_style_precontent_meta_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_precontent_meta_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'label'     => __('Link hover color', 'btp_theme'),            
            	'render_func'      => 'color',            
        	)            
        ),
        $btp_theme_slug.'_style_precontent_primary_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Primary Scheme', 'btp_theme'))),
        $btp_theme_slug.'_style_precontent_primary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_primary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_primary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_primary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),
        $btp_theme_slug.'_style_precontent_secondary_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Secondary Scheme', 'btp_theme'))),        
        $btp_theme_slug.'_style_precontent_secondary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_secondary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_secondary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_secondary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_tertiary_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Tertiary Scheme', 'btp_theme'))),
        $btp_theme_slug.'_style_precontent_tertiary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_tertiary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_tertiary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_tertiary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_precontent_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')), 
        
        
        
        $btp_theme_slug.'_style_content_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Content', 'btp_theme'), 'color' => '#7cff00')),
        $btp_theme_slug.'_style_content_layout' => array(
			'model'		=> array(        		
        		'null'			=> '',
        		'options'		=> array(
        							'boxed'			=> __('Boxed', 'btp_theme'),	 
        							'stretched'		=> __('Stretched', 'btp_theme')
        		),
			),
			'view'		=> array(
				'render_func'      => 'select',
        		'label'     => __('Layout', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_content_border_top_width' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Border top width', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_content_border_top_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Border top color', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_content_border_bottom_width' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Border bottom width', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_content_border_bottom_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Border bottom color', 'btp_theme'),	
			)            
        ),        
        $btp_theme_slug.'_style_content_margin_bottom' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Margin bottom', 'btp_theme'),	
			)            
        ),  
        $btp_theme_slug.'_style_content_basic_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Basic Scheme', 'btp_theme'))),
        $btp_theme_slug.'_style_content_background_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),	
			)            
        ),        
        $btp_theme_slug.'_style_content_background_opacity' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Background opacity', 'btp_theme'),	
			)            
        ),
        
		$btp_theme_slug.'_style_content_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),	
			)            
        ),        
        $btp_theme_slug.'_style_content_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link color', 'btp_theme'),	
        	)           
        ),
        $btp_theme_slug.'_style_content_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link hover color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_content_line_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Line color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_content_meta_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Meta Scheme', 'btp_theme'))),        
        $btp_theme_slug.'_style_content_meta_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),	
        	)
        ),        
        $btp_theme_slug.'_style_content_meta_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_content_meta_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link hover color', 'btp_theme'),
        	)
        ),   
        $btp_theme_slug.'_style_content_primary_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Primary Scheme', 'btp_theme'))),
        $btp_theme_slug.'_style_content_primary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_content_primary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_content_primary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_content_primary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),       
        $btp_theme_slug.'_style_content_secondary_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Secondary Scheme', 'btp_theme'))), 
        $btp_theme_slug.'_style_content_secondary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_content_secondary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_content_secondary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_content_secondary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_content_tertiary_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Tertiary Scheme', 'btp_theme'))),
        $btp_theme_slug.'_style_content_tertiary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_content_tertiary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_content_tertiary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_content_tertiary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),       
        $btp_theme_slug.'_style_content_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
        
        $btp_theme_slug.'_style_prefooter_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Prefooter', 'btp_theme'), 'color' => '#ffa000' )),
		$btp_theme_slug.'_style_prefooter_layout' => array(
			'model'		=> array(        		
        		'null'			=> '',
        		'options'		=> array(
        							'boxed'			=> __('Boxed', 'btp_theme'),	 
        							'stretched'		=> __('Stretched', 'btp_theme')
        		),
			),
			'view'		=> array(
				'render_func'      => 'select',
        		'label'     => __('Layout', 'btp_theme'),	
			)            
        ), 
        $btp_theme_slug.'_style_prefooter_border_top_width' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Border top width', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_prefooter_border_top_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Border top color', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_prefooter_border_bottom_width' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Border bottom width', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_prefooter_border_bottom_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Border bottom color', 'btp_theme'),	
			)            
        ),        
        $btp_theme_slug.'_style_prefooter_margin_bottom' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Margin bottom', 'btp_theme'),	
			)            
        ),          
        $btp_theme_slug.'_style_prefooter_basic_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Basic Scheme', 'btp_theme'))),				
		$btp_theme_slug.'_style_prefooter_background_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),	
			)            
        ),        
        $btp_theme_slug.'_style_prefooter_background_opacity' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Background opacity', 'btp_theme'),	
			)            
        ),    	    	
		$btp_theme_slug.'_style_prefooter_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'	=> 'color',
        		'label'     => __('Text color', 'btp_theme'),
            )
        ),        
        $btp_theme_slug.'_style_prefooter_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(        	
	        	'render_func'   => 'color',	
        		'label'     	=> __('Link color', 'btp_theme'),
            ),            
        ),
        $btp_theme_slug.'_style_prefooter_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'   => 'color',
        		'label'    		=> __('Link hover color', 'btp_theme'),	
        	)
        ),
        $btp_theme_slug.'_style_prefooter_line_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Line color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_prefooter_meta_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Meta Scheme', 'btp_theme'))),        
        $btp_theme_slug.'_style_prefooter_meta_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
				'render_func'   => 'color',
        		'label'     	=> __('Text color', 'btp_theme'),
        	)
        ),        
        $btp_theme_slug.'_style_prefooter_meta_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Link color', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_style_prefooter_meta_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'label'     => __('Link hover color', 'btp_theme'),            
            	'render_func'      => 'color',            
        	)            
        ),
        $btp_theme_slug.'_style_prefooter_primary_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Primary Scheme', 'btp_theme'))),        
        $btp_theme_slug.'_style_prefooter_primary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_prefooter_primary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_prefooter_primary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_prefooter_primary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_prefooter_secondary_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Secondary Scheme', 'btp_theme'))),
        $btp_theme_slug.'_style_prefooter_secondary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_prefooter_secondary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_prefooter_secondary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_prefooter_secondary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),
        $btp_theme_slug.'_style_prefooter_tertiary_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Tertiary Scheme', 'btp_theme'))),        
        $btp_theme_slug.'_style_prefooter_tertiary_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_prefooter_tertiary_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_prefooter_tertiary_hover_background_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Hover background color', 'btp_theme'),
        	)	            
        ),        
        $btp_theme_slug.'_style_prefooter_tertiary_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'      => 'color',
        		'label'     => __('Text hover color', 'btp_theme'),
        	)	            
        ),     
        $btp_theme_slug.'_style_prefooter_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')), 

        
        
        
        $btp_theme_slug.'_style_footer_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Footer', 'btp_theme'), 'color' => '#00fef0')),
        $btp_theme_slug.'_style_footer_layout' => array(
			'model'		=> array(        		
        		'null'			=> '',
        		'options'		=> array(
        							'boxed'			=> __('Boxed', 'btp_theme'),	 
        							'stretched'		=> __('Stretched', 'btp_theme')
        		),
			),
			'view'		=> array(
				'render_func'      => 'select',
        		'label'     => __('Layout', 'btp_theme'),	
			)            
        ),
		$btp_theme_slug.'_style_footer_border_top_width' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Border top width', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_footer_border_top_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Border top color', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_footer_border_bottom_width' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Border bottom width', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_footer_border_bottom_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Border bottom color', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_footer_margin_bottom' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Margin bottom', 'btp_theme'),	
			)            
        ),
        $btp_theme_slug.'_style_footer_basic_scheme' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('Basic Scheme', 'btp_theme'))),        
        $btp_theme_slug.'_style_footer_background_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'color',
        		'label'     => __('Background color', 'btp_theme'),	
			)            
        ),    	   
        $btp_theme_slug.'_style_footer_background_opacity' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'      => 'input_text',
        		'label'     => __('Background opacity', 'btp_theme'),	
			)            
        ), 	
		$btp_theme_slug.'_style_footer_color' => array(
			'model'		=> array(
			),
			'view'		=> array(
				'render_func'	=> 'color',
        		'label'     => __('Text color', 'btp_theme'),
            )
        ),        
        $btp_theme_slug.'_style_footer_link_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(        	
	        	'render_func'   => 'color',	
        		'label'     	=> __('Link color', 'btp_theme'),
            ),            
        ),
        $btp_theme_slug.'_style_footer_link_hover_color' => array(
        	'model'		=> array(
        	),
        	'view'		=> array(
        		'render_func'   => 'color',
        		'label'    		=> __('Link hover color', 'btp_theme'),	
        	)
        ),
        $btp_theme_slug.'_style_footer_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')), 
        
        
    );
	

	$btp_theme_options_feeds_array = array(
		'behance', 'blogger', 'delicious', 'designfloat', 'deviantart', 'digg', 'facebook', 'flickr', 'lastfm', 'linkedin', 
		'livejournal', 'megavideo', 'myspace', 'piano', 'playstation', 'reddit', 'rss', 'socialvibe', 'spotify', 'stumbleupon', 
		'technorati', 'tumblr', 'twitpic', 'twitter', 'vimeo', 'wordpress', 'youtube'
	);
	
	$btp_theme_options_feeds = array();
	$btp_theme_options_feeds[$btp_theme_slug.'_feeds_subsection_start'] = array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Main', 'btp_theme')));
	foreach($btp_theme_options_feeds_array as $x)
	{		
		$btp_theme_options_feeds[$btp_theme_slug.'_feeds_'.$x] = array (
			'model'		=> array(
				'update_func'	=> 'feed'
			),
			'view'		=> array(
				'render_func'	=> 'feed',
				'label'			=> $x
			)    
		);
	} 
	$btp_theme_options_feeds[$btp_theme_slug.'_feeds_subsection_end'] = array('model' => null, 'view' => array('render_func' => 'subsection_end'));

	
	
	$btp_theme_options_works = array(
		$btp_theme_slug.'_work_index_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Index', 'btp_theme'))),
		$btp_theme_slug.'_work_index_page' => array(
			'model'		=> array(
				'null'			=> '',
				'options'		=> 'btp_get_pages_mapping',		
			),
			'view'		=> array(
        		'render_func'	=> 'select',
				'label'     	=> __('Works page', 'btp_theme'),            	            	             
            	'default'   => ''
            )        	
        ),        
        $btp_theme_slug.'_work_index_posts_per_page' => array(
        	'model'		=> array(
        		'default'   	=> 4	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_text',
        		'label'     => __('Works per page', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_index_hide_title' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide title?', 'btp_theme'),
        	)       	
        ),                
        $btp_theme_slug.'_work_index_hide_thumb' => array(
        	'model'		=> array(
        		'default'   	=> false
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide thumb?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_index_hide_date' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide date?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_index_hide_comments_link' => array(
        	'model'		=> array(
        		'default'   	=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide comments link?', 'btp_theme'),	
        	)
        ),
        $btp_theme_slug.'_work_index_hide_categories' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide categories?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_index_hide_tags' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide tags?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_index_hide_summary' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide summary?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_index_hide_button_1' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide primary button?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_index_hide_button_2' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide secondary button?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_index_hide_button_3' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide tertiary button?', 'btp_theme'),
        	)       	
        ),        
        $btp_theme_slug.'_work_index_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
        
        
        $btp_theme_slug.'_work_archive_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Archive', 'btp_theme'))),		        
        $btp_theme_slug.'_work_archive_template' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_work_archive_templates',
        		'default'   	=> 'c-4',	
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Template', 'btp_theme'),
        	),
        ),        
        $btp_theme_slug.'_work_archive_posts_per_page' => array(
        	'model'		=> array(
        		'default'   	=> 4	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_text',
        		'label'     => __('Works per page', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_archive_hide_title' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide title?', 'btp_theme'),
        	)       	
        ),                
        $btp_theme_slug.'_work_archive_hide_thumb' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide thumb?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_archive_hide_date' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide date?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_archive_hide_comments_link' => array(
        	'model'		=> array(
        		'default'   	=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide comments link?', 'btp_theme'),	
        	)
        ),
        $btp_theme_slug.'_work_archive_hide_categories' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide categories?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_archive_hide_tags' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide tags?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_archive_hide_summary' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide summary?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_archive_hide_button_1' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide primary button?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_archive_hide_button_2' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide secondary button?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_archive_hide_button_3' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide tertiary button?', 'btp_theme'),
        	)       	
        ),        
        $btp_theme_slug.'_work_archive_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
        
        $btp_theme_slug.'_work_single_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Single', 'btp_theme'))),        
        $btp_theme_slug.'_work_single_template' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_work_single_templates',
        		'default'   	=> 'full-width',	
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Template', 'btp_theme'),
        	),
        ),
        $btp_theme_slug.'_work_single_sidebar_primary' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_sidebars_mapping',
        		'default'		=> 'primary'	
        	),
           	'view'		=> array( 
				'render_func'	=> 'select',
        		'label'     => __('Primary sidebar', 'btp_theme'),
        	)            
        ),
        $btp_theme_slug.'_work_single_hide_title' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      	=> 'input_checkbox',
        		'label'     		=> __('Hide title?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_single_media_box' => array(
        	'model'		=> array(        		
        		'options'		=> array(
        				'none'				=> __('None', 'btp_theme'),
						'featured-asset'	=> __('Featured asset', 'btp_theme'),
        				'attachments-cycle'	=> __('Attachments: Cycle Slider', 'btp_theme')        						
        		),
        		'default'   	=> 'attachments-cycle',	
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Media box', 'btp_theme'),
        	),
        ), 
        $btp_theme_slug.'_work_single_hide_title' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      	=> 'input_checkbox',
        		'label'     		=> __('Hide title?', 'btp_theme'),
        	)       	
        ),               
        $btp_theme_slug.'_work_single_hide_date' => array(
        	'model'		=> array(
        		'default'   	=> false
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide date?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_single_hide_comments_link' => array(
        	'model'		=> array(
        		'default'   	=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide comments link?', 'btp_theme'),	
        	)
        ),
        $btp_theme_slug.'_work_single_hide_categories' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide categories?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_single_hide_tags' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide tags?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_single_hide_button_2' => array(
        	'model'		=> array(
        		'default'   	=> false
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide secondary button?', 'btp_theme'),
        	)       	
        ),
        $btp_theme_slug.'_work_single_hide_button_3' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'      => 'input_checkbox',
        		'label'     => __('Hide tertiary button?', 'btp_theme'),
        	)       	
        ),        
        $btp_theme_slug.'_work_single_after_12' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('After work area - full width templates', 'btp_theme'))),
        $btp_theme_slug.'_work_single_after_sidebars_c_12_layout' => array(
        	'model'		=> array(),
        	'view'		=> array(
        		'render_func'	=> 'input_text',
        		'label'     	=> __('Layout', 'btp_theme'),
        		'hint'      	=> __('E.g. 4,4,4', 'btp_theme'),
        
            )            
        ),
        $btp_theme_slug.'_work_single_after_8' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('After work area - templates with sidebar', 'btp_theme'))),
        $btp_theme_slug.'_work_single_after_sidebars_c_8_layout' => array(
        	'model'		=> array(),
        	'view'		=> array(
        		'render_func'	=> 'input_text',
        		'label'     	=> __('Layout', 'btp_theme'),
        		'hint'      	=> __('E.g. 4,4', 'btp_theme'),
            )            
        ),
        
        $btp_theme_slug.'_work_single_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
    );
    
    $btp_theme_options_products = array(
    	$btp_theme_slug.'_product_main_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Main', 'btp_theme'))),
		$btp_theme_slug.'_product_price_prefix' => array(
			'model'		=> array(				
				'default'   	=> '$'
			),
			'view'		=> array(
				'render_func'   => 'input_text',
        		'label'			=> __('Price prefix', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_product_price_separator' => array(
			'model'		=> array(				
				'default'   	=> ' '
			),
			'view'		=> array(
				'render_func'   => 'input_text',
        		'label'			=> __('Price thousands separator', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_product_price_point' => array(
			'model'		=> array(				
				'default'   	=> ','
			),
			'view'		=> array(
				'render_func'   => 'input_text',
        		'label'			=> __('Price decimal point', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_product_price_precision' => array(
			'model'		=> array(				
				'default'   	=> 2
			),
			'view'		=> array(
				'render_func'   => 'input_text',
        		'label'			=> __('Price decimal precision', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_product_price_suffix' => array(
			'model'		=> array(				
				'default'   	=> ''
			),
			'view'		=> array(
				'render_func'   => 'input_text',
        		'label'			=> __('Price suffix', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_product_main_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
    
    	$btp_theme_slug.'_product_index_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Index', 'btp_theme'))),
		$btp_theme_slug.'_product_index_page' => array(
			'model'		=> array(				
				'null'			=> '',
				'options'		=> 'btp_get_pages_mapping',
			),
			'view'		=> array(
				'render_func'   => 'select',
        		'label'			=> __('Products page', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_product_index_posts_per_page' => array(
			'model'		=> array(
				'default'   	=> 12
			),
			'view'		=> array(
				'render_func'   => 'input_text',
        		'label'			=> __('Products per page', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_product_index_hide_title' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide title?', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_product_index_hide_thumb' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide thumb?', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_product_index_hide_price' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide price?', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_product_index_hide_comments_link' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide comments_link?', 'btp_theme'),
        	)	
        ),
        $btp_theme_slug.'_product_index_hide_categories' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide categories?', 'btp_theme'),
        	)            	
        ),
        $btp_theme_slug.'_product_index_hide_tags' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide tags?', 'btp_theme'),
        	)            	
        ),
        $btp_theme_slug.'_product_index_hide_summary' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide summary?', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_product_index_hide_button_1' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide primary button?', 'btp_theme'),
        	)            	
        ),
        $btp_theme_slug.'_product_index_hide_button_2' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide secondary button?', 'btp_theme'),
        	)            	
        ),
        $btp_theme_slug.'_product_index_hide_button_3' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide tertiary button?', 'btp_theme'),
        	)	
        ),        
        $btp_theme_slug.'_product_index_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),

        
        $btp_theme_slug.'_product_archive_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Archive', 'btp_theme'))),
		$btp_theme_slug.'_product_archive_template' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_work_collection_templates',
        		'default'   	=> 'c-4',	
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Template', 'btp_theme'),
        	),
        ),   
        $btp_theme_slug.'_product_archive_posts_per_page' => array(
			'model'		=> array(
				'default'   	=> 12
			),
			'view'		=> array(
				'render_func'   => 'input_text',
        		'label'			=> __('Products per page', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_product_archive_hide_title' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide title?', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_product_archive_hide_thumb' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide thumb?', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_product_archive_hide_price' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide price?', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_product_archive_hide_comments_link' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide comments_link?', 'btp_theme'),
        	)	
        ),
        $btp_theme_slug.'_product_archive_hide_categories' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide categories?', 'btp_theme'),
        	)            	
        ),
        $btp_theme_slug.'_product_archive_hide_tags' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide tags?', 'btp_theme'),
        	)            	
        ),
        $btp_theme_slug.'_product_archive_hide_summary' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide summary?', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_product_archive_hide_button_1' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide primary button?', 'btp_theme'),
        	)            	
        ),
        $btp_theme_slug.'_product_archive_hide_button_2' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide secondary button?', 'btp_theme'),
        	)            	
        ),
        $btp_theme_slug.'_product_archive_hide_button_3' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide tertiary button?', 'btp_theme'),
        	)	
        ),
                
        $btp_theme_slug.'_product_archive_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),

        
        
        
        
      
        
        $btp_theme_slug.'_product_single_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Single', 'btp_theme'))),        

        $btp_theme_slug.'_product_single_template' => array(
        	'model'		=> array(				        		
        		'default'		=> 'full-width',
        		'options'		=> 'btp_get_product_single_templates',
        	),
        	'view'		=> array(	
	        	'render_func'	=> 'select',
        		'label'     	=> __('Template', 'btp_theme')
            )
        ),
        $btp_theme_slug.'_product_single_primary_sidebar' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_sidebars_mapping',
        		'default'		=> 'primary'	
        	),
           	'view'		=> array( 
				'render_func'	=> 'select',
        		'label'     => __('Primary sidebar', 'btp_theme'),
        	)            
        ),
        $btp_theme_slug.'_product_single_hide_title' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide title?', 'btp_theme'),
        	)
            	
        ), 
        $btp_theme_slug.'_product_single_media_box' => array(
        	'model'		=> array(        		
        		'options'		=> array(
        				'none'				=> __('None', 'btp_theme'),
						'featured-asset'	=> __('Featured asset', 'btp_theme'),
        				'attachments-cycle'	=> __('Attachments: Cycle Slider', 'btp_theme')        						
        		),
        		'default'   	=> 'attachments-cycle',	
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Media box', 'btp_theme'),
        	),
        ),        
        $btp_theme_slug.'_product_single_hide_price' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide price?', 'btp_theme'),
        	)
            	
        ),        
        $btp_theme_slug.'_product_single_hide_comments_link' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide comments link?', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_product_single_hide_categories' => array(
        	'model'		=> array(
        		'default'		=> false
           	),
           	'view'		=> array(
	        	'render_func'	=> 'input_checkbox',
           		'label'     => __('Hide categories?', 'btp_theme')
			)
        ),
        $btp_theme_slug.'_product_single_hide_tags' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide tags?', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_product_single_hide_button_2' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide secondary button?', 'btp_theme'),
        	)            	
        ),
        $btp_theme_slug.'_product_single_hide_button_3' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide tertiary button?', 'btp_theme'),
        	)
            	
        ),   
        $btp_theme_slug.'_product_single_after_12' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('After product area - full width templates', 'btp_theme'))),
        $btp_theme_slug.'_product_single_after_sidebars_c_12_layout' => array(
        	'model'		=> array(),
        	'view'		=> array(
        		'render_func'	=> 'input_text',
        		'label'     	=> __('Layout', 'btp_theme'),
        		'hint'      	=> __('E.g. 4,4,4', 'btp_theme'),
        
            )            
        ),
        $btp_theme_slug.'_product_single_after_8' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('After product area - templates with sidebar', 'btp_theme'))),
        $btp_theme_slug.'_product_single_after_sidebars_c_8_layout' => array(
        	'model'		=> array(),
        	'view'		=> array(
        		'render_func'	=> 'input_text',
        		'label'     	=> __('Layout', 'btp_theme'),
        		'hint'      	=> __('E.g. 4,4', 'btp_theme'),
            )            
        ),
        $btp_theme_slug.'_product_single_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
        
    );
    
    $btp_theme_options_clients = array(		
		$btp_theme_slug.'_client_index_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Index', 'btp_theme'))),
		$btp_theme_slug.'_client_index_page' => array(
			'model'		=> array(				
				'null'			=> '',
				'options'		=> 'btp_get_pages_mapping',
			),
			'view'		=> array(
				'render_func'   => 'select',
        		'label'			=> __('Clients page', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_client_index_posts_per_page' => array(
			'model'		=> array(
				'default'   	=> 12
			),
			'view'		=> array(
				'render_func'   => 'input_text',
        		'label'			=> __('Clients per page', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_client_index_hide_title' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide title', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_client_index_hide_thumb' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide thumb', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_client_index_hide_summary' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide summary', 'btp_theme'),
        	)
            	
        ),
        $btp_theme_slug.'_client_index_hide_button_1' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide primary button', 'btp_theme'),
        	)            	
        ),      
        $btp_theme_slug.'_client_index_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
                
        
        $btp_theme_slug.'_client_single_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Single', 'btp_theme'))),
        $btp_theme_slug.'_client_single_template' => array(
        	'model'		=> array(				        		
        		'default'		=> 'full-width',
        		'options'		=> 'btp_get_client_single_templates',
        	),
        	'view'		=> array(	
	        	'render_func'	=> 'select',
        		'label'     	=> __('Template', 'btp_theme')
            )
        ),
        $btp_theme_slug.'_client_single_sidebar_primary' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_sidebars_mapping',
        		'default'		=> 'primary'
        	),
           	'view'		=> array( 
				'render_func'	=> 'select',
        		'label'     => __('Primary sidebar', 'btp_theme'),
        	)            
        ), 
        $btp_theme_slug.'_client_single_hide_title' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide title?', 'btp_theme'),
        	)
            	
        ), 
        $btp_theme_slug.'_client_single_media_box' => array(
        	'model'		=> array(        		
        		'options'		=> array(
        				'none'				=> __('None', 'btp_theme'),
						'featured-asset'	=> __('Featured asset', 'btp_theme'),
        				'attachments-cycle'	=> __('Attachments: Cycle Slider', 'btp_theme')        						
        		),
        		'default'   	=> 'attachments-cycle',	
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Media box', 'btp_theme'),
        	),
        ),
        $btp_theme_slug.'_client_single_after_8' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('After client area - templates with sidebar', 'btp_theme'))),
        $btp_theme_slug.'_client_single_after_sidebars_c_8_layout' => array(
        	'model'		=> array(),
        	'view'		=> array(
        		'render_func'	=> 'input_text',
        		'label'     	=> __('Layout', 'btp_theme'),
        		'hint'      	=> __('E.g. 4,4', 'btp_theme'),
            )            
        ),       
        
        
        $btp_theme_slug.'_client_single_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        
        
        
    );
    
    $btp_theme_options_posts = array (    	

    	$btp_theme_slug.'_post_index_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Index', 'btp_theme'))),        
		$btp_theme_slug.'_post_index_template' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_post_archive_templates',
        		'default'   	=> 'c-8-sidebar-right',	
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Template', 'btp_theme'),
        	),
        ),
        'posts_per_page' => array(
			'model'		=> array(
				'default'   	=> 10
			),
			'view'		=> array(
				'render_func'   => 'input_text',
        		'label'			=> __('Posts per page', 'btp_theme'),
			),      	
        ), 
        $btp_theme_slug.'_post_index_hide_title' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
				'render_func'	=> 'input_checkbox',
        		'label' 	    => __('Hide title?', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_post_index_hide_thumb' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
				'render_func'	=> 'input_checkbox',
        		'label' 	    => __('Hide thumb?', 'btp_theme'),
        	)
        ),   	
        $btp_theme_slug.'_post_index_hide_date' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
				'render_func'	=> 'input_checkbox',
        		'label' 	    => __('Hide date?', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_post_index_hide_author' => array(
        	'model'		=> array(
        		'default'   	=> false	
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide author?', 'btp_theme'),	
        	)
        ),
        $btp_theme_slug.'_post_index_hide_comments_link' => array(
        	'model'		=> array(
        		'default'   	=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide comments link?', 'btp_theme'),	
        	)
        ),
        $btp_theme_slug.'_post_index_hide_categories' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',	
        		'label'     	=> __('Hide categories?', 'btp_theme'),
            )
        ),
        $btp_theme_slug.'_post_index_hide_tags' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide tags?', 'btp_theme'),         
        	)
        ),
        $btp_theme_slug.'_post_index_hide_summary' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
				'render_func'	=> 'input_checkbox',
        		'label' 	    => __('Hide summary?', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_post_index_hide_button_1' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide primary button?', 'btp_theme'),         
        	)
        ),
        $btp_theme_slug.'_post_index_sidebar_primary' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_sidebars_mapping',
        		'default'		=> 'primary'
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Primary sidebar', 'btp_theme'),
        	)            
        ),
                
        $btp_theme_slug.'_post_index_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
    

    
    	$btp_theme_slug.'_post_archive_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Archive', 'btp_theme'))),        
		$btp_theme_slug.'_post_archive_template' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_post_archive_templates',
        		'default'   	=> 'c-8-sidebar-right',	
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Template', 'btp_theme'),
        	),
        ),
        $btp_theme_slug.'_post_archive_posts_per_page' => array(
			'model'		=> array(
				'default'   	=> 12
			),
			'view'		=> array(
				'render_func'   => 'input_text',
        		'label'			=> __('Posts per page', 'btp_theme'),
			),      	
        ),
        $btp_theme_slug.'_post_archive_hide_title' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',	
        		'label'     	=> __('Hide title?', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_post_archive_hide_thumb' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',	
        		'label'     	=> __('Hide thumb?', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_post_archive_hide_date' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',	
        		'label'     	=> __('Hide date?', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_post_archive_hide_author' => array(
        	'model'		=> array(
        		'default'   => false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',
        		'label'    		=> __('Hide author?', 'btp_theme'),	
        	)
        ),
        $btp_theme_slug.'_post_archive_hide_comments_link' => array(
        	'model'		=> array(
        		'default'   => false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',
        		'label'    		=> __('Hide comments link?', 'btp_theme'),	
        	)
        ),
        $btp_theme_slug.'_post_archive_hide_categories' => array(
        	'model'		=> array(
        		'default'   => false
        	),
        	'view'		=> array(
        		'render_func'		=> 'input_checkbox',
        		'label'     => __('Hide categories?', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_post_archive_hide_tags' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
				'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide tags?', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_post_archive_hide_summary' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
        		'render_func'	=> 'input_checkbox',	
        		'label'     	=> __('Hide summary?', 'btp_theme'),
        	)
        ),
        $btp_theme_slug.'_post_archive_hide_button_1' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
				'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide primary button?', 'btp_theme'),
        	)
        ),        
        $btp_theme_slug.'_post_archive_sidebar_primary' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_sidebars_mapping',
        		'default'		=> 'primary'
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Primary sidebar', 'btp_theme'),	
        	)            
        ),
                
        $btp_theme_slug.'_post_archive_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
        

        $btp_theme_slug.'_post_single_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Single', 'btp_theme'))),        

        $btp_theme_slug.'_post_single_template' => array(
        	'model'		=> array(				        		
        		'default'		=> 'sidebar-right',
        		'options'		=> 'btp_get_post_single_templates',
        	),
        	'view'		=> array(	
	        	'render_func'	=> 'select',
        		'label'     	=> __('Template', 'btp_theme')
            )
        ),                
        $btp_theme_slug.'_post_single_sidebar_primary' => array(
        	'model'		=> array(        		
        		'options'		=> 'btp_get_sidebars_mapping',
        		'default'		=> 'primary'
        	),
           	'view'		=> array( 
				'render_func'	=> 'select',
        		'label'     => __('Primary sidebar', 'btp_theme'),
        	)            
        ),
        $btp_theme_slug.'_post_single_hide_title' => array(
        	'model'		=> array(
        		'default'		=> false
           	),
        	'view'		=> array(	
	        	'render_func'	=> 'input_checkbox',
	        	'label'     	=> __('Hide title?', 'btp_theme'),           
	         
        	)
        ),
        $btp_theme_slug.'_post_single_media_box' => array(
        	'model'		=> array(        		
        		'options'		=> array(
        				'none'				=> __('None', 'btp_theme'),
						'featured-asset'	=> __('Featured asset', 'btp_theme'),
        				'attachments-cycle'	=> __('Attachments: Cycle Slider', 'btp_theme')        						
        		),
        		'default'   	=> 'attachments-cycle',	
        	),
        	'view'		=> array(
        		'render_func'	=> 'select',
        		'label'     	=> __('Media box', 'btp_theme'),
        	),
        ),        
        $btp_theme_slug.'_post_single_hide_date' => array(
        	'model'		=> array(
        		'default'		=> false
           	),
        	'view'		=> array(	
	        	'render_func'	=> 'input_checkbox',
	        	'label'     	=> __('Hide date?', 'btp_theme'),           
	         
        	)
        ),
        $btp_theme_slug.'_post_single_hide_author' => array(
        	'model'		=> array(
        		'default'		=> false
           	),
           	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
	        	'label'     	=> __('Hide author?', 'btp_theme')
			)           
        ),
        $btp_theme_slug.'_post_single_hide_comments_link' => array(
        	'model'		=> array(
        		'default'		=> false
           	),
           	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
	        	'label'     	=> __('Hide comments link?', 'btp_theme')
			)           
        ),
        $btp_theme_slug.'_post_single_hide_categories' => array(
        	'model'		=> array(
        		'default'		=> false
           	),
           	'view'		=> array(
	        	'render_func'	=> 'input_checkbox',
           		'label'     => __('Hide categories?', 'btp_theme')
			)
        ),
        $btp_theme_slug.'_post_single_hide_tags' => array(
        	'model'		=> array(
        		'default'		=> false
        	),
        	'view'		=> array(
           		'render_func'	=> 'input_checkbox',
        		'label'     	=> __('Hide tags?', 'btp_theme'),
        	)
            	
        ),        
        $btp_theme_slug.'_post_single_after_8' => array('model' => null, 'view' => array('render_func' => 'header', 'label' => __('After post area - templates with sidebar', 'btp_theme'))),
        $btp_theme_slug.'_post_single_after_sidebars_c_8_layout' => array(
        	'model'		=> array(),
        	'view'		=> array(
        		'render_func'	=> 'input_text',
        		'label'     	=> __('Layout', 'btp_theme'),
        		'hint'      	=> __('E.g. 4,4', 'btp_theme'),
            )            
        ), 
        $btp_theme_slug.'_post_single_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
    );
   
    
    $btp_theme_options_misc = array(
    	$btp_theme_slug.'_sidebar_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Sidebars', 'btp_theme'))),
        $btp_theme_slug.'_sidebar_generator' => array(
        	'model'		=> array(
        		'default'   => '',
        		'model'     => 'sidebar',
        	),
        	'view'		=> array(
        		'render_func'      => 'textarea',
        		'label'     => __('Manage sidebars', 'btp_theme'),
        		'hint'		=> __('Each sidebar name on a new line', 'btp_theme')
        	)
 	   ), 	   
 	   $btp_theme_slug.'_sidebar_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
 	    
 	   $btp_theme_slug.'_tracking_code_subsection_start' => array('model' => null, 'view' => array('render_func' => 'subsection_start', 'label' => __('Tracking code', 'btp_theme'))),
 	   $btp_theme_slug.'_tracking_code_enable' => array(
 	   		'model'		=> array(
				'default'		=> false,
 	   		),
 	   		'view' 		=> array(
	        	'render_func'	=> 'input_checkbox',
 	   			'label'     	=> __('Tracking code - enable?', 'btp_theme')
 	   		)
 	   ),
 	   $btp_theme_slug.'_tracking_code' => array(
 	   		'model'		=> array(),
 	   		'view'		=> array(
        		'render_func'	=> 'textarea',	
 	   			'label'     	=> __('Tracking code', 'btp_theme')
 	   		)
 	   ),
 	   $btp_theme_slug.'_tracking_code_subsection_end' => array('model' => null, 'view' => array('render_func' => 'subsection_end')),
 	   
 	);
        
 	/* Collect sections options into one array */
	$btp_theme_options = array_merge(
		
		array('section_start_general' 		=> array('model' => null, 'view' => array('render_func' => 'section_start', 'label' => __('General', 'btp_theme')))),	
		$btp_theme_options_general,		
		array('section_end_general' 		=> array('model' => null, 'view' => array('render_func' => 'section_end'))),
		
		array('section_start_style' 		=> array('model' => null, 'view' => array('render_func' => 'section_start', 'label' => __('Style', 'btp_theme')))),	
		$btp_theme_options_style,		
		array('section_end_style' 			=> array('model' => null, 'view' => array('render_func' => 'section_end'))),
		
		array('section_start_works'			=> array('model' => null, 'view' => array('render_func' => 'section_start', 'label' => __('Works', 'btp_theme')))),
		$btp_theme_options_works,
		array('section_end_works'			=> array('model' => null, 'view' => array('render_func' => 'section_end'))),
		
		array('section_start_products' 		=> array('model' => null, 'view' => array('render_func' => 'section_start', 'label' => __('Products', 'btp_theme')))),
		$btp_theme_options_products,
		array('section_end_products'		=> array('model' => null, 'view' => array('render_func' => 'section_end'))),
		
		array('section_start_clients' 		=> array('model' => null, 'view' => array('render_func' => 'section_start', 'label' => __('Clients', 'btp_theme')))),
		$btp_theme_options_clients,
		array('section_end_clients'			=> array('model' => null, 'view' => array('render_func' => 'section_end'))),
		
		array('section_start_posts'			=> array('model' => null, 'view' => array('render_func' => 'section_start', 'label' => __('Posts', 'btp_theme')))),
		$btp_theme_options_posts,
		array('section_end_posts'			=> array('model' => null, 'view' => array('render_func' => 'section_end'))),
		
		array('section_start_feeds'			=> array('model' => null, 'view' => array('render_func' => 'section_start', 'label' => __('Feeds', 'btp_theme')))),
		$btp_theme_options_feeds,
		array('section_end_feeds' 			=> array('model' => null, 'view' => array('render_func' => 'section_end'))),
		
		array('section_start_misc' 			=> array('model' => null, 'view' => array('render_func' => 'section_start', 'label' => __('Miscellaneous', 'btp_theme')))),
		$btp_theme_options_misc,
		array('section_end_misc' 			=> array('model' => null, 'view' => array('render_func' => 'section_end')))
		
	);
}
?>