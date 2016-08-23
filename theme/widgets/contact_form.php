<?php

/* Function called by action/hook 'widgets_init' */
function btp_init_contact_form_widget() {
	register_widget( 'BTP_Contact_Form_Widget' );
}

class BTP_Contact_Form_Widget extends WP_Widget {
	
	function BTP_Contact_Form_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_contact_form', 'description' => __('Well, just a contact form', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_contact_form_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'btp_contact_form_widget', __('BTP Contact Form', 'btp_theme'), $widget_ops, $control_ops );
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
		
		$btp_shortcode = '[contact_form ';
			$btp_shortcode .= 'r_email="'.$instance['r_email'].'" ';
			$btp_shortcode .= 'r_name="'.$instance['r_name'].'" ';
			$btp_shortcode .= 'subject="'.$instance['subject'].'" ';
			$btp_shortcode .= 'success_text="'.$instance['success_text'].'" ';
			$btp_shortcode .= 'failure_text="'.$instance['failure_text'].'" ';
		$btp_shortcode .= ']';	
			
		$out .= do_shortcode($btp_shortcode);		
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['r_email'] = strip_tags( $new_instance['r_email'] );
		$instance['r_name'] = strip_tags( $new_instance['r_email'] );
		$instance['subject'] = strip_tags( $new_instance['subject'] );
		$instance['success_text'] = strip_tags( $new_instance['success_text'] );
		$instance['failure_text'] = strip_tags( $new_instance['failure_text'] );
		
		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title'				=> __('Contact Form', 'btp_theme'),
			'r_email'			=> '',
			'r_name'			=> '',	
			'subject'			=> '',			
			'success_text'		=> '',
			'failure_text'		=> ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'r_email' ); ?>"><?php _e('Recipient email', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'r_email' ); ?>" name="<?php echo $this->get_field_name( 'r_email' ); ?>" value="<?php echo $instance['r_email']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'r_name' ); ?>"><?php _e('Recipient name', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'r_name' ); ?>" name="<?php echo $this->get_field_name( 'r_name' ); ?>" value="<?php echo $instance['r_name']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'subject' ); ?>"><?php _e('Subject', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'subject' ); ?>" name="<?php echo $this->get_field_name( 'subject' ); ?>" value="<?php echo $instance['subject']; ?>" style="width:100%;" />
		</p>
			
		<p>
			<label for="<?php echo $this->get_field_id( 'success_text' ); ?>"><?php _e('Success text', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'success_text' ); ?>" name="<?php echo $this->get_field_name( 'success_text' ); ?>" value="<?php echo $instance['success_text']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'failure_text' ); ?>"><?php _e('Failure text', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'failure_text' ); ?>" name="<?php echo $this->get_field_name( 'failure_text' ); ?>" value="<?php echo $instance['failure_text']; ?>" style="width:100%;" />
		</p>
		
	<?php
	}
}
?>