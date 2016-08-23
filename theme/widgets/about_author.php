<?php

/* Function called by action/hook 'widgets_init' */
function btp_init_about_author_widget() {
	register_widget( 'BTP_About_Author_Widget' );
}

class BTP_About_Author_Widget extends WP_Widget {
	
	function BTP_About_Author_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_about_author', 'description' => __('Author box', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_about_author_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'btp_about_author_widget', __('BTP About Author', 'btp_theme'), $widget_ops, $control_ops );
	}
	
	/* Display widget */
	function widget( $args, $instance ) {
		extract( $args );
		
		/* Start composing output */
		$out = '';
		
		global $post;
		if ( $post ) {
			$btp_author_description = trim( get_the_author_meta('description') );
			
			if ( strlen( $btp_author_description ) ) {
			
				/* User-selected settings. */
				$title = apply_filters('widget_title', $instance['title'] );	
							
				/* Before widget (defined by themes). */
				$out .= $before_widget;
	
				/* Title of widget (before and after defined by themes). */
				if ( $title )
					$out .= $before_title . $title . $after_title;
			
				
				global $id, $authordata;
				
				$out .= '<div class="about-author">';
				
					$out .= '<h4>';
						ob_start();
						the_author_posts_link();					
						$out .= ob_get_clean();
					$out .= '</h4>';
					$out .= '<p class="author-avatar"><span class="frame"><span class="frame-inner">'.get_avatar( get_the_author_meta('email'), '80' ).'</span></span></p>';
					$out .= '<p class="author-description">' . $btp_author_description . '</p>';
					
				$out .= '</div>';	
			
				/* After widget (defined by themes). */
				$out .= $after_widget;
				
			}
		}
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 			=> __('About Author', 'btp_theme'),			
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
				
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
	<?php
	}
	
	
}
?>