<?php

/* Function called by action/hook 'widgets_init' */
function btp_init_subpages_widget() {
	register_widget( 'BTP_Subpages_Widget' );
}

class BTP_Subpages_Widget extends WP_Widget {
	
	function BTP_Subpages_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_subpages', 'description' => __('Display a list of subpages', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_subpages_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'btp_subpages_widget', __('BTP Subpages', 'btp_theme'), $widget_ops, $control_ops );
	}
	
	/* Display widget */
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );		
		
		/* Start composing output */
		$out = '';
				
		/* Before widget (defined by themes). */
		$out .= $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			$out .= $before_title . $title . $after_title;

		global $post;	
			
		if ($post->post_parent)	{
			$ancestors = get_post_ancestors($post->ID);			
			$parent = array_pop($ancestors);
		} else {
			$parent = $post->ID;
		}
		
		$subpages = wp_list_pages("title_li=&child_of=". $parent ."&echo=0");
		if( $subpages ) {
			$out .= '<ul>';
				$out .= $subpages;
			$out .= '</ul>';
		}		
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
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
			'title' 			=> __('Submenu', 'btp_theme'),
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