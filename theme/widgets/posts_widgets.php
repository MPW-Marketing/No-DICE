<?php

/* Function called by action/hook 'widgets_init' */
function btp_init_recent_posts_widget() {
	register_widget( 'BTP_Recent_Posts_Widget' );
}

class BTP_Recent_Posts_Widget extends WP_Widget {
	
	function BTP_Recent_Posts_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_recent_posts', 'description' => __('The most recent posts on your site', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_recent_posts_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'btp_recent_posts_widget', __('BTP Recent Posts', 'btp_theme'), $widget_ops, $control_ops );
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
		
		$btp_shortcode = '[recent_posts ';
			$btp_shortcode .= 'cat="'.$instance['cat'].'" ';
			$btp_shortcode .= 'max="'.$instance['max'].'" ';
			$btp_shortcode .= 'max_per_row="'.$instance['max_per_row'].'" ';
			$btp_shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_title'] ? 'title,' : '';
			$hide .= $instance['hide_thumb'] ? 'thumb,' : '';
			$hide .= $instance['hide_date'] ? 'date,' : '';
			$hide .= $instance['hide_author'] ? 'author,' : '';
			$hide .= $instance['hide_comments_link'] ? 'comments_link,' : '';
			$hide .= $instance['hide_categories'] ? 'categories,' : '';
			$hide .= $instance['hide_tags'] ? 'tags,' : '';
			$hide .= $instance['hide_summary'] ? 'summary,' : '';
			$hide .= $instance['hide_button_1'] ? 'button_1,' : '';			
			$hide = trim($hide, ",");
			
			$btp_shortcode .= 'hide="'.$hide.'" ';			
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
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['cat'] 				= strip_tags( $new_instance['cat'] );
		$instance['max'] 				= absint( $new_instance['max'] );
		$instance['max_per_row'] 		= absint( $new_instance['max_per_row'] );
		$instance['template'] 			= strip_tags( $new_instance['template'] );		
		$instance['hide_title'] 		= btp_bool($new_instance['hide_title']);
		$instance['hide_thumb'] 		= btp_bool($new_instance['hide_thumb']);
		$instance['hide_date'] 			= btp_bool($new_instance['hide_date']);
		$instance['hide_author'] 		= btp_bool($new_instance['hide_author']);
		$instance['hide_comments_link']	= btp_bool($new_instance['hide_comments_link']);
		$instance['hide_categories'] 	= btp_bool($new_instance['hide_categories']);
		$instance['hide_tags'] 			= btp_bool($new_instance['hide_tags']);
		$instance['hide_summary'] 		= btp_bool($new_instance['hide_summary']);
		$instance['hide_button_1'] 		= btp_bool($new_instance['hide_button_1']);
		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {
		$templates = btp_get_post_collection_templates(); 
		
		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 				=> __('Recent posts', 'btp_theme'),
			'cat'					=> '',
			'max'					=> 1,
			'max_per_row'			=> 0,
			'template'				=> key($templates),			
			'hide_title'			=> false,
			'hide_thumb'			=> false,
			'hide_date'				=> false,			
			'hide_author'			=> false,
			'hide_comments_link'	=> false,
			'hide_categories'		=> false,
			'hide_tags'				=> false,
			'hide_summary'			=> false,
			'hide_button_1'			=> false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e('Category ids', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" value="<?php echo $instance['cat']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max' ); ?>"><?php _e('Maximum number of items', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max' ); ?>" name="<?php echo $this->get_field_name( 'max' ); ?>" value="<?php echo $instance['max']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max_per_row' ); ?>"><?php _e('Maximum number of items per row', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max_per_row' ); ?>" name="<?php echo $this->get_field_name( 'max_per_row' ); ?>" value="<?php echo $instance['max_per_row']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template', 'btp_theme'); ?>:</label>			
			<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" style="width:100%;">
				<?php foreach($templates as $key => $value): ?>
					<?php if($key == $instance['template']): ?>
						<option selected="selected" value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php else: ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>	
			</select>			 
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" value="true" <?php if($instance['hide_title']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php _e('Hide title?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_thumb' ); ?>" name="<?php echo $this->get_field_name( 'hide_thumb' ); ?>" value="true" <?php if($instance['hide_thumb']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_thumb' ); ?>"><?php _e('Hide thumb?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_date' ); ?>" name="<?php echo $this->get_field_name( 'hide_date' ); ?>" value="true" <?php if($instance['hide_date']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_date' ); ?>"><?php _e('Hide date?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_author' ); ?>" name="<?php echo $this->get_field_name( 'hide_author' ); ?>" value="true" <?php if($instance['hide_author']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_author' ); ?>"><?php _e('Hide author?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>" name="<?php echo $this->get_field_name( 'hide_comments_link' ); ?>" value="true" <?php if($instance['hide_comments_link']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>"><?php _e('Hide comments link?', 'btp_theme'); ?></label>
			<br />			
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_categories' ); ?>" name="<?php echo $this->get_field_name( 'hide_categories' ); ?>" value="true" <?php if($instance['hide_categories']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_categories' ); ?>"><?php _e('Hide categories?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_tags' ); ?>" name="<?php echo $this->get_field_name( 'hide_tags' ); ?>" value="true" <?php if($instance['hide_tags']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_tags' ); ?>"><?php _e('Hide tags?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_summary' ); ?>" name="<?php echo $this->get_field_name( 'hide_summary' ); ?>" value="true" <?php if($instance['hide_summary']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_summary' ); ?>"><?php _e('Hide summary?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_button_1' ); ?>" name="<?php echo $this->get_field_name( 'hide_button_1' ); ?>" value="true" <?php if($instance['hide_button_1']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_button_1' ); ?>"><?php _e('Hide primary button?', 'btp_theme'); ?></label>
		</p>
	<?php
	}
}


/* Function called by action/hook 'widgets_init' */
function btp_init_custom_posts_widget() {
	register_widget( 'BTP_Custom_Posts_Widget' );
}

class BTP_Custom_Posts_Widget extends WP_Widget {
	
	function BTP_Custom_Posts_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_custom_posts', 'description' => __('Custom posts based on ids', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_custom_posts_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'btp_custom_posts_widget', __('BTP Custom Posts', 'btp_theme'), $widget_ops, $control_ops );
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
		
		$btp_shortcode = '[custom_posts ';
			$btp_shortcode .= 'ids="'.$instance['ids'].'" ';
			$btp_shortcode .= 'max_per_row="'.$instance['max_per_row'].'" ';
			$btp_shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_title'] ? 'title,' : '';
			$hide .= $instance['hide_thumb'] ? 'thumb,' : '';
			$hide .= $instance['hide_date'] ? 'date,' : '';
			$hide .= $instance['hide_author'] ? 'author,' : '';
			$hide .= $instance['hide_comments_link'] ? 'comments_link,' : '';
			$hide .= $instance['hide_categories'] ? 'categories,' : '';
			$hide .= $instance['hide_tags'] ? 'tags,' : '';
			$hide .= $instance['hide_summary'] ? 'summary,' : '';
			$hide .= $instance['hide_button_1'] ? 'button_1,' : '';
			$hide = trim($hide, ",");
			
			$btp_shortcode .= 'hide="'.$hide.'" ';
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
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['ids'] 				= strip_tags( $new_instance['ids'] );
		$instance['max_per_row'] 		= absint( $new_instance['max_per_row'] );
		$instance['template'] 			= strip_tags( $new_instance['template'] );		
		$instance['hide_title'] 		= btp_bool($new_instance['hide_title']);
		$instance['hide_thumb'] 		= btp_bool($new_instance['hide_thumb']);
		$instance['hide_date'] 			= btp_bool($new_instance['hide_date']);
		$instance['hide_author'] 		= btp_bool($new_instance['hide_author']);
		$instance['hide_comments_link']	= btp_bool($new_instance['hide_comments_link']);
		$instance['hide_categories']	= btp_bool($new_instance['hide_categories']);
		$instance['hide_tags']			= btp_bool($new_instance['hide_tags']);
		$instance['hide_summary'] 		= btp_bool($new_instance['hide_summary']);
		$instance['hide_button_1'] 		= btp_bool($new_instance['hide_button_1']);
		
		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {
		
		$templates = btp_get_post_collection_templates();

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 				=> __('Featured posts', 'btp_theme'),
			'ids'					=> '',
			'max_per_row'			=> 0,
			'template'				=> key($templates),			
			'hide_title'			=> false,
			'hide_thumb'			=> false,
			'hide_date'				=> false,
			'hide_author'			=> false,
			'hide_comments_link'	=> false,
			'hide_categories'		=> false,
			'hide_tags'				=> false,
			'hide_summary'			=> false,
			'hide_button_1'			=> false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ids' ); ?>"><?php _e('Ids', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'ids' ); ?>" name="<?php echo $this->get_field_name( 'ids' ); ?>" value="<?php echo $instance['ids']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max_per_row' ); ?>"><?php _e('Maximum number of items per row', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max_per_row' ); ?>" name="<?php echo $this->get_field_name( 'max_per_row' ); ?>" value="<?php echo $instance['max_per_row']; ?>" style="width:100%;" />
		</p>
		
		<p>			
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template', 'btp_theme'); ?>:</label>			
			<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" style="width:100%;">
				<?php foreach($templates as $key => $value): ?>
					<?php if($key == $instance['template']): ?>
						<option selected="selected" value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php else: ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>	
			</select>			 
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" value="true" <?php if($instance['hide_title']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php _e('Hide title?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_thumb' ); ?>" name="<?php echo $this->get_field_name( 'hide_thumb' ); ?>" value="true" <?php if($instance['hide_thumb']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_thumb' ); ?>"><?php _e('Hide thumb?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_date' ); ?>" name="<?php echo $this->get_field_name( 'hide_date' ); ?>" value="true" <?php if($instance['hide_date']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_date' ); ?>"><?php _e('Hide date?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_author' ); ?>" name="<?php echo $this->get_field_name( 'hide_author' ); ?>" value="true" <?php if($instance['hide_author']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_author' ); ?>"><?php _e('Hide author?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>" name="<?php echo $this->get_field_name( 'hide_comments_link' ); ?>" value="true" <?php if($instance['hide_comments_link']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>"><?php _e('Hide comments link?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_categories' ); ?>" name="<?php echo $this->get_field_name( 'hide_categories' ); ?>" value="true" <?php if($instance['hide_categories']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_categories' ); ?>"><?php _e('Hide categories?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_tags' ); ?>" name="<?php echo $this->get_field_name( 'hide_tags' ); ?>" value="true" <?php if($instance['hide_tags']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_tags' ); ?>"><?php _e('Hide tags?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_summary' ); ?>" name="<?php echo $this->get_field_name( 'hide_summary' ); ?>" value="true" <?php if($instance['hide_summary']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_summary' ); ?>"><?php _e('Hide summary?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_button_1' ); ?>" name="<?php echo $this->get_field_name( 'hide_button_1' ); ?>" value="true" <?php if($instance['hide_button_1']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_button_1' ); ?>"><?php _e('Hide primary button?', 'btp_theme'); ?></label>
			<br />
		</p>
	<?php
	}
}


/* Function called by action/hook 'widgets_init' */
function btp_init_popular_posts_widget() {
	register_widget( 'BTP_Popular_Posts_Widget' );
}

class BTP_Popular_Posts_Widget extends WP_Widget {
	
	function BTP_Popular_Posts_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_popular_posts', 'description' => __('The most popular posts on your site based on comment count', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_popular_posts_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'btp_popular_posts_widget', __('BTP Popular Posts', 'btp_theme'), $widget_ops, $control_ops );
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
		
		$btp_shortcode = '[popular_posts ';
			$btp_shortcode .= 'max="'.$instance['max'].'" ';
			$btp_shortcode .= 'max_per_row="'.$instance['max_per_row'].'" ';
			$btp_shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_title'] ? 'title,' : '';
			$hide .= $instance['hide_thumb'] ? 'thumb,' : '';
			$hide .= $instance['hide_date'] ? 'date,' : '';
			$hide .= $instance['hide_author'] ? 'author,' : '';
			$hide .= $instance['hide_comments_link'] ? 'comments_link,' : '';
			$hide .= $instance['hide_categories'] ? 'categories,' : '';
			$hide .= $instance['hide_tags'] ? 'tags,' : '';
			$hide .= $instance['hide_summary'] ? 'summary,' : '';
			$hide .= $instance['hide_button_1'] ? 'button_1,' : '';			
			$hide = trim($hide, ",");
			
			$btp_shortcode .= 'hide="'.$hide.'" ';			
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
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['max'] 				= absint( $new_instance['max'] );
		$instance['max_per_row'] 		= absint( $new_instance['max_per_row'] );
		$instance['template'] 			= strip_tags( $new_instance['template'] );		
		$instance['hide_title'] 		= btp_bool($new_instance['hide_title']);
		$instance['hide_thumb'] 		= btp_bool($new_instance['hide_thumb']);
		$instance['hide_date'] 			= btp_bool($new_instance['hide_date']);
		$instance['hide_author'] 		= btp_bool($new_instance['hide_author']);
		$instance['hide_comments_link']	= btp_bool($new_instance['hide_comments_link']);
		$instance['hide_categories'] 	= btp_bool($new_instance['hide_categories']);
		$instance['hide_tags'] 			= btp_bool($new_instance['hide_tags']);
		$instance['hide_summary'] 		= btp_bool($new_instance['hide_summary']);
		$instance['hide_button_1'] 		= btp_bool($new_instance['hide_button_1']);
		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {
		$templates = btp_get_post_collection_templates(); 
		
		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 				=> __('Popular posts', 'btp_theme'),
			'max'					=> 1,
			'max_per_row'			=> 0,
			'template'				=> key($templates),			
			'hide_title'			=> false,
			'hide_thumb'			=> false,
			'hide_date'				=> false,			
			'hide_author'			=> false,
			'hide_comments_link'	=> false,
			'hide_categories'		=> false,
			'hide_tags'				=> false,
			'hide_summary'			=> false,
			'hide_button_1'			=> false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max' ); ?>"><?php _e('Maximum number of items', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max' ); ?>" name="<?php echo $this->get_field_name( 'max' ); ?>" value="<?php echo $instance['max']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max_per_row' ); ?>"><?php _e('Maximum number of items per row', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max_per_row' ); ?>" name="<?php echo $this->get_field_name( 'max_per_row' ); ?>" value="<?php echo $instance['max_per_row']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template', 'btp_theme'); ?>:</label>			
			<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" style="width:100%;">
				<?php foreach($templates as $key => $value): ?>
					<?php if($key == $instance['template']): ?>
						<option selected="selected" value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php else: ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>	
			</select>			 
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" value="true" <?php if($instance['hide_title']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php _e('Hide title?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_thumb' ); ?>" name="<?php echo $this->get_field_name( 'hide_thumb' ); ?>" value="true" <?php if($instance['hide_thumb']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_thumb' ); ?>"><?php _e('Hide thumb?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_date' ); ?>" name="<?php echo $this->get_field_name( 'hide_date' ); ?>" value="true" <?php if($instance['hide_date']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_date' ); ?>"><?php _e('Hide date?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_author' ); ?>" name="<?php echo $this->get_field_name( 'hide_author' ); ?>" value="true" <?php if($instance['hide_author']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_author' ); ?>"><?php _e('Hide author?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>" name="<?php echo $this->get_field_name( 'hide_comments_link' ); ?>" value="true" <?php if($instance['hide_comments_link']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>"><?php _e('Hide comments link?', 'btp_theme'); ?></label>
			<br />			
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_categories' ); ?>" name="<?php echo $this->get_field_name( 'hide_categories' ); ?>" value="true" <?php if($instance['hide_categories']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_categories' ); ?>"><?php _e('Hide categories?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_tags' ); ?>" name="<?php echo $this->get_field_name( 'hide_tags' ); ?>" value="true" <?php if($instance['hide_tags']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_tags' ); ?>"><?php _e('Hide tags?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_summary' ); ?>" name="<?php echo $this->get_field_name( 'hide_summary' ); ?>" value="true" <?php if($instance['hide_summary']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_summary' ); ?>"><?php _e('Hide summary?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_button_1' ); ?>" name="<?php echo $this->get_field_name( 'hide_button_1' ); ?>" value="true" <?php if($instance['hide_button_1']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_button_1' ); ?>"><?php _e('Hide primary button?', 'btp_theme'); ?></label>
		</p>
	<?php
	}
}



/* Function called by action/hook 'widgets_init' */
function btp_init_related_posts_widget() {
	register_widget( 'BTP_Related_Posts_Widget' );
}

class BTP_Related_Posts_Widget extends WP_Widget {
	
	function BTP_Related_Posts_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_related_posts', 'description' => __('Related posts based on relation tags', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_related_posts_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'btp_related_posts_widget', __('BTP Related Posts', 'btp_theme'), $widget_ops, $control_ops );
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
		
		$btp_shortcode = '[related_posts ';
			$btp_shortcode .= 'id="'.$instance['id'].'" ';
			$btp_shortcode .= 'max="'.$instance['max'].'" ';
			$btp_shortcode .= 'max_per_row="'.$instance['max_per_row'].'" ';
			$btp_shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_title'] ? 'title,' : '';
			$hide .= $instance['hide_thumb'] ? 'thumb,' : '';
			$hide .= $instance['hide_date'] ? 'date,' : '';
			$hide .= $instance['hide_author'] ? 'author,' : '';
			$hide .= $instance['hide_comments_link'] ? 'comments_link,' : '';
			$hide .= $instance['hide_categories'] ? 'categories,' : '';
			$hide .= $instance['hide_tags'] ? 'tags,' : '';
			$hide .= $instance['hide_summary'] ? 'summary,' : '';
			$hide .= $instance['hide_button_1'] ? 'button_1,' : '';
			$hide = trim($hide, ",");
			
			$btp_shortcode .= 'hide="'.$hide.'" ';
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
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['id'] 				= strip_tags( $new_instance['id'] );
		$instance['max'] 				= absint( $new_instance['max'] );
		$instance['max_per_row'] 		= absint( $new_instance['max_per_row'] );
		$instance['template'] 			= strip_tags( $new_instance['template'] );		
		$instance['hide_title'] 		= btp_bool($new_instance['hide_title']);
		$instance['hide_thumb'] 		= btp_bool($new_instance['hide_thumb']);
		$instance['hide_date'] 			= btp_bool($new_instance['hide_date']);
		$instance['hide_author'] 		= btp_bool($new_instance['hide_author']);
		$instance['hide_comments_link']	= btp_bool($new_instance['hide_comments_link']);
		$instance['hide_categories']	= btp_bool($new_instance['hide_categories']);
		$instance['hide_tags']			= btp_bool($new_instance['hide_tags']);
		$instance['hide_summary'] 		= btp_bool($new_instance['hide_summary']);
		$instance['hide_button_1'] 		= btp_bool($new_instance['hide_button_1']);

		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {

		$templates = btp_get_post_collection_templates();
		
		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 				=> __('Related posts', 'btp_theme'),
			'id'					=> '',
			'max'					=> 1,
			'max_per_row'			=> 0,
			'template'				=> key($templates),			
			'hide_title'			=> false,
			'hide_thumb'			=> false,
			'hide_date'				=> false,
			'hide_author'			=> false,
			'hide_comments_link'	=> false,
			'hide_categories'		=> false,
			'hide_tags'				=> false,		
			'hide_summary'			=> false,
			'hide_button_1'			=> false,		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('Related id', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max' ); ?>"><?php _e('Maximum number of items', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max' ); ?>" name="<?php echo $this->get_field_name( 'max' ); ?>" value="<?php echo $instance['max']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max_per_row' ); ?>"><?php _e('Maximum number of items per row', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max_per_row' ); ?>" name="<?php echo $this->get_field_name( 'max_per_row' ); ?>" value="<?php echo $instance['max_per_row']; ?>" style="width:100%;" />
		</p>
		
		<p>			
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template', 'btp_theme'); ?>:</label>			
			<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" style="width:100%;">
				<?php foreach($templates as $key => $value): ?>
					<?php if($key == $instance['template']): ?>
						<option selected="selected" value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php else: ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>	
			</select>			 
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" value="true" <?php if($instance['hide_title']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php _e('Hide title?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_thumb' ); ?>" name="<?php echo $this->get_field_name( 'hide_thumb' ); ?>" value="true" <?php if($instance['hide_thumb']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_thumb' ); ?>"><?php _e('Hide thumb?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_date' ); ?>" name="<?php echo $this->get_field_name( 'hide_date' ); ?>" value="true" <?php if($instance['hide_date']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_date' ); ?>"><?php _e('Hide date?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_author' ); ?>" name="<?php echo $this->get_field_name( 'hide_author' ); ?>" value="true" <?php if($instance['hide_author']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_author' ); ?>"><?php _e('Hide author?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>" name="<?php echo $this->get_field_name( 'hide_comments_link' ); ?>" value="true" <?php if($instance['hide_comments_link']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>"><?php _e('Hide comments link?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_categories' ); ?>" name="<?php echo $this->get_field_name( 'hide_categories' ); ?>" value="true" <?php if($instance['hide_categories']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_categories' ); ?>"><?php _e('Hide categories?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_tags' ); ?>" name="<?php echo $this->get_field_name( 'hide_tags' ); ?>" value="true" <?php if($instance['hide_tags']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_tags' ); ?>"><?php _e('Hide tags?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_summary' ); ?>" name="<?php echo $this->get_field_name( 'hide_summary' ); ?>" value="true" <?php if($instance['hide_summary']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_summary' ); ?>"><?php _e('Hide summary?', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_button_1' ); ?>" name="<?php echo $this->get_field_name( 'hide_button_1' ); ?>" value="true" <?php if($instance['hide_button_1']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_button_1' ); ?>"><?php _e('Hide primary button?', 'btp_theme'); ?></label>
		</p>
	<?php
	}
}
?>