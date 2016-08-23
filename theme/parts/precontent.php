<?php
	/* Precontent is available for singular items */
	if( is_singular() || btp_is_static_posts_page() ) {
		global $post;
		
		$btp_post_id = is_singular() ? $post->ID : (int) get_option( 'page_for_posts' );		
		
		$btp_precontent_displaying = get_post_meta($btp_post_id, '_btp_precontent_displaying', true);
			
		switch ( $btp_precontent_displaying ) {
			case 'none';						
				break;				
			case 'slides-dice':
				get_template_part('/theme/parts/precontent_slides_dice');
				break;
			case 'slides-kwicks':
				get_template_part('/theme/parts/precontent_slides_kwicks');
				break;				
			case 'slides-cycle':
				get_template_part('/theme/parts/precontent_slides_cycle');
				break;				
			default:
				get_template_part('/theme/parts/precontent_default');
				break; 
		}	
	}
?>