<?php

/** 
 * Modification of 'WHERE' clause of post query: consider only posts with commments. 
 */
function btp_posts_where_filter_only_commented( $where = '' ) {	
	global $wpdb;
	$where .= " AND $wpdb->posts.comment_count > 0";
	
	return $where; 	
} 
	
	
function btp_comment_form_default_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
			
	$fields['author'] = 
		'<div class="form-row comment-form-author">' .
			'<label for="author">'.__( 'Name' ). 
			( $req ? ' <em class="meta">'.__('(required)', 'btp_theme').'</em>' : '' ).
			'</label>'.
            '<input class="u-4" id="author" name="author" type="text" value="'.
            esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />'.
 		'</div>';
            
	$fields['email'] =
		'<div class="form-row comment-form-email">'.
        	'<label for="email">'.__( 'Email' ).
            ( $req ? ' <em class="meta">'.__('(required)', 'btp_theme').'</em>' : '' ).'</label>'.
            '<input class="u-4 " id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" />'.
   		'</div>';
                
    $fields['url'] =
    	'<div class="form-row comment-form-url">'.	 
        	'<label for="url">'.__( 'Website' ).'</label>' .
            '<input class="u-4" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />'.
		'</div>';
                
	return $fields;
}
	
function btp_comment_form_field_comment( $field ) {
	$field =
    	'<div class="form-row comment-form-comment">' .
	        '<label for="comment">' . __( 'Comment' ) . ' <em class="meta">'.__('(required)', 'btp_theme').'</em></label>' .
    	    '<textarea class="u-8" id="comment" name="comment" cols="45" rows="8" tabindex="4"></textarea>' .
		'</div>';	
		
	return $field;
}
	
function btp_comment_form_defaults( $defaults ) {
	$defaults['comment_notes_before'] = '';		
	$defaults['comment_notes_after'] = '';
	
	return $defaults;
} 


/**
 * Customizes password form.
 * 
 * @param unknown_type $form
 */
function btp_get_the_password_form($form) {
	$btp_object = get_post_type_object(get_post_type());
	$btp_text = sprintf( __( "This %s is password protected. To view it please enter your password below:", 'btp_theme' ), $btp_object->labels->singular_name );
 	
	$parts = array(
    	'#<p>This post is password protected. To view it please enter your password below:</p>#' => '<p>' . esc_html( $btp_text ) . '</p>',
    	'#<input(.*?)type="password"(.*?) />#' => '<input$1type="password"$2 class="u-4" />',
  	);

 	return preg_replace( array_keys( $parts ), array_values( $parts ), $form );
}


	
	
/**
 * Sets attribute wmode to transparent
 * 
 * @param $html
 * @param $url
 * @param $attr
 */	
function btp_flash_wmode_transparent( $html, $url, $attr ) {
   if ( strpos( $html, '<embed src=' ) !== false) {
    	$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
   }	
   
   return $html;
}
?>