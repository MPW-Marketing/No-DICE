<?php

/**
 * Extracts precontent from first [precontent] shortcode used in post content.
 */
function btp_get_the_precontent() {
	
	if( is_singular() ) {
		$precontent = get_the_content();
	} else {
		$btp_post_id = (int) get_option( 'page_for_posts' );
		$precontent = get_post( $btp_post_id );
		$precontent = $precontent->post_content;
	}	
	
	$precontent = str_replace(
		array('[precontent]', '[/precontent]'),
		array('[btp_precontent]', '[/btp_precontent]'),
		$precontent
	); 
	
	$precontent = apply_filters('the_content', $precontent);
	$precontent = str_replace(']]>', ']]&gt;', $precontent);
	
	/* We use strpos instead of regex because of speed optimalisation */
	$p_start 	= strpos($precontent, '[btp_precontent]');
	$p_end 		= strpos($precontent, '[/btp_precontent]');
	
	if ( ($p_start !== false) && ($p_end !== false) ) {
		$p_1 = $p_start + strlen('[btp_precontent]');
		$p_2 = $p_end - $p_1;
		$precontent = substr($precontent, $p_1, $p_2);
				
		$precontent = preg_replace('#^<\/p>|<p>$#', '', $precontent);
		
		return $precontent;
	}
			
	return '';
}



/* Custom meta box for Precontent Options */
$btp_precontent_options_meta_box = array(
	'_btp_precontent_displaying' => array(
		'model'		=> array(
			'options'			=> array(
						'default'		=> 'Default',
						'none'			=> 'None',
						'slides-dice'	=> 'Slides: DICE Slider',
						'slides-kwicks' => 'Slides: Kwicks Slider',
						'slides-cycle'	=> 'Slides: Cycle Slider',	
			)
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'				=> __('Precontent displaying', 'btp_theme'),	
		)		
	),
	'_btp_slide_category' => array(
		'model'		=> array(
			'null'				=> '',
			'options'			=> 'btp_get_slide_categories_mapping',
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'				=> __('Slide Category', 'btp_theme'),	
		)		
	),
	'_btp_slider_dice_header'   => array('model' => null, 'view' => array( 'render_func' => 'header', 'label' => __('DICE Slider', 'btp_theme'))),
	'_btp_slider_dice_vertical_segments' => array(
		'model'		=> array( 
          ),
        'view'		=> array(        	
        	'render_func'	=> 'input_text',	
        	'label'     	=> __('Vertical segments', 'btp_theme')
        ),
	),        
    '_btp_slider_dice_horizontal_segments' => array(
		'model'		=> array(
          ),
        'view'		=> array(        	
        	'render_func'	=> 'input_text',	
        	'label'     	=> __('Horizontal segments', 'btp_theme')
        ),
    ),        
    '_btp_slider_dice_depth' => array(
		'model'		=> array(
          ),
        'view'		=> array(        	
        	'render_func'	=> 'input_text',	
        	'label'     	=> __('Depth', 'btp_theme')
        ),
    ),
    '_btp_slider_dice_transition' => array(
		'model'		=> array(
    		'null'			=> '',
        	'options'		=> 'btp_get_dice_slider_transition_methods',
          ),
        'view'		=> array(        	
        	'render_func'	=> 'select',	
        	'label'     	=> __('Transition', 'btp_theme')
        ),
	),
	'_btp_slider_dice_tween_time' => array(
		'model'		=> array(
          ),
        'view'		=> array(        	
        	'render_func'	=> 'input_text',	
        	'label'     	=> __('Tween time', 'btp_theme')
        ),
    ),
    '_btp_slider_dice_tween_delay' => array(
		'model'		=> array(
          ),
        'view'		=> array(        	
        	'render_func'	=> 'input_text',	
        	'label'     	=> __('Tween delay', 'btp_theme')
        ),
    ),
    '_btp_slider_dice_easing' => array(
        'model'		=> array(
    		'null'			=> '',
        	'options'		=> 'btp_get_dice_slider_easing_methods',
        ),        	
        'view'		=> array(
        	'render_func'	=> 'select',	
        	'label'     	=> __('Easing', 'btp_theme')
        ),
    ),
    '_btp_slider_dice_tween_timeout' => array(
		'model'		=> array(
          ),
        'view'		=> array(        	
        	'render_func'	=> 'input_text',	
        	'label'     	=> __('Timeout', 'btp_theme')
        ),
    ),
    '_btp_slider_dice_x_distance_multiply' => array(
		'model'		=> array(
          ),
        'view'		=> array(        	
        	'render_func'	=> 'input_text',	
        	'label'     	=> __('X distance multiply', 'btp_theme')
        ),
    ),
    '_btp_slider_dice_y_distance_multiply' => array(
		'model'		=> array(
          ),
        'view'		=> array(        	
        	'render_func'	=> 'input_text',	
        	'label'     	=> __('Y distance multiply', 'btp_theme')
        ),
    ),
    '_btp_slider_dice_z_distance' => array(
		'model'		=> array(
          ),
        'view'		=> array(        	
        	'render_func'	=> 'input_text',	
        	'label'     	=> __('Z distance', 'btp_theme')
        ),
    ),
	'_btp_slider_kwicks_header'   => array('model' => null, 'view' => array( 'render_func' => 'header', 'label' => __('Kwicks Slider', 'btp_theme'))),
	'_btp_slider_kwicks_segments' => array(
		'model'		=> array(
			'options'	=> array(
						'3' => '3',
						'4'	=> '4',
						'5'	=> '5',	
			),        	
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'				=> __('Segments', 'btp_theme'),	
		)		
	),
	'_btp_slider_cycle_header'   => array('model' => null, 'view' => array( 'render_func' => 'header', 'label' => __('Cycle Slider', 'btp_theme'))),
	'_btp_slider_cycle_fx' => array(
		'model'		=> array(
			'null'				=> '',
			'options'			=> 'btp_get_cycle_slider_transition_methods',
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'				=> __('Transition', 'btp_theme'),	
		)		
	),
	'_btp_slider_cycle_speed' => array(
		'model'		=> array(
		),
		'view'		=> array(
			'render_func'		=> 'input_text',
			'label'				=> __('Speed', 'btp_theme'),	
		)		
	),
	'_btp_slider_cycle_easing' => array(
		'model'		=> array(
			'null'				=> '',
			'options'			=> 'btp_get_cycle_slider_easing_methods',
		),
		'view'		=> array(
			'render_func'		=> 'select',
			'label'				=> __('Easing', 'btp_theme'),	
		)		
	),
	'_btp_slider_cycle_timeout' => array(
		'model'		=> array(
		),
		'view'		=> array(
			'render_func'		=> 'input_text',
			'label'				=> __('Timeout', 'btp_theme'),	
		)		
	),
	
);


?>