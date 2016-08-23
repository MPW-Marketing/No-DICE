<?php

	/**
	 * Encodes captcha 'secret' value 
	 * 
	 * @param string $v
	 */
	function btp_encode_captcha( $v ) {
		return md5( $v . '41' );
	}
	
	function btp_contact_form_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'contact_form',
			array(
				'label'			=> '[contact_form] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'r_email', array(
						'hint' => __( 'Recipient\'s email address', 'btp_theme' ),	
					)),
					new BTP_Form_Unit_Input_Text( 'r_name', array(
						'hint' => __( 'Recipient\'s name', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Input_Text( 'subject', array(
						'hint' => __( 'Subject of an email', 'btp_theme' ),
					)),
					new BTP_Form_Unit_Input_Text( 'success_text', array(
						'hint' => __( 'Text displayed after successful action', 'btp_theme'),
					)),
					new BTP_Form_Unit_Input_Text( 'failure_text', array(
						'hint' => __( 'Text displayed after failure action', 'btp_theme'),
					)),
				),
				'display'		=> 'block',
			)			 
		); 
	}	

	/**
	 * Shortcode contact_form
	 * 
	 * @param $atts
	 * @param $content
	 */
	function btp_contact_form_shortcode( $atts, $content = null ) {
		/* Count contact forms for proper reference */
		static $btp_shortcode_contact_form_increment_id = 0;
		$id = (++$btp_shortcode_contact_form_increment_id);
			
		extract( shortcode_atts( array(			
			'r_email'				=> '',
			'r_name'				=> '',		
			'subject'				=> '',
			'success_text'			=> '',
			'failure_text'			=> '',								
			), $atts ) );					
			
		$r_email = strlen( $r_email ) ? $r_email : get_option( 'admin_email' );	
		$r_name = strlen( $r_name ) ? $r_name : get_option( 'blogname' );
		$subject = strlen( $subject ) ? $subject : __( 'Website Contact Form', 'btp_theme' );
		$success_text = strlen( $success_text ) ? $success_text : __('We have received your email. Thank you', 'btp_theme'); 	
		$failure_text = strlen( $failure_text ) ? $failure_text : __('Ooops, something has gone wrong', 'btp_theme');
			
		$errors = array();
		$email_sent = null;
		
		/* Captcha vars */
		$captcha_n1 = rand(1, 15);
		$captcha_n2 = rand(1, 15);
		$captcha_hidden_hash = btp_encode_captcha($captcha_n1 + $captcha_n2);
				
		/* Initialize data */
		$name 			= '';
		$email 			= '';
		$message 		= '';
		$captcha		= '';
		
		/* Check if form has been submitted */
		if( isset($_POST['contact_form_submit_'.$id]) ) {
			
			/* Filter input data */
			foreach ( $_POST as $key => $value ) {    
    			if( ini_get('magic_quotes_gpc') )
					$_POST[$key] = stripslashes( $_POST[$key] );	
				
    			$_POST[$key] = htmlspecialchars( strip_tags( $_POST[$key] ) );    
			}
			
			/* Get input data */
			$name 			= trim( $_POST['contact_form_name_'.$id] );
			$email 			= trim( $_POST['contact_form_email_'.$id] );
			$message 		= trim( $_POST['contact_form_message_'.$id] );
			$captcha 		= trim( $_POST['contact_form_captcha_'.$id] );
			$captcha_hash	= trim( $_POST['contact_form_captcha_hash_'.$id] );			
			
			/* Validate input data */	
			if ( strlen( $name ) < 2 ) {
				$errors['name'] = true;
			}
	
			if ( !preg_match( '/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email ) ) {
				$errors['email'] = true;
			}
	
			if ( strlen( $message ) < 2 ) {
				$errors['message'] = true;
			}
	
			if ( btp_encode_captcha( $captcha ) != $captcha_hash ) {
				$errors['captcha'] = true;
			}	
		
			if ( !count( $errors ) ) {
				// Send email 
       			
				$headers = 'From: ' . htmlspecialchars( strip_tags( $name ) ) . ' <'. htmlspecialchars( strip_tags( $email ) ) . '>' . "\r\n";
   				$email_sent = wp_mail($r_email, $subject, $message, $headers);
			}	
		}
		
		
		/* Compose output */
		$out = '';	
		
					
		
		$out .= '<form action="' . get_permalink() . '#contact_form_' . esc_attr( $id ) . '" method="post" id="contact_form_' . esc_attr( $id ) . '">';
		
			/* Notification message */
			if ( $email_sent === true )
				$out .= btp_message_shortcode(array( 'type' => 'success' ), esc_html( $success_text ) );
			elseif( $email_sent === false )
				$out .= btp_message_shortcode(array( 'type' => 'error'), esc_html( $failure_text ) );
		
			if ( count( $errors ) ) 
				$out .= btp_message_shortcode(array( 'type' => 'warning'), esc_html( __( 'Please correct the errors on this form.', 'btp_theme' ) ) );
			
			/* Name field */
			$out .= isset( $errors['name'] ) ? '<div class="form-row form-row-error">' : '<div class="form-row">';				
				$out .= '<label for="contact_form_name_' . esc_attr( $id ) . '">';
					$out .= esc_html( __( 'Name', 'btp_theme' ) ) . ' <em class="meta">' . __( '(required)', 'btp_theme' );
				$out .=	'</em></label>';
				$out .= isset( $errors['name'] ) ? '<div class="form-message">'.esc_html(__('Please enter your name', 'btp_theme')).'</div>' : '' ;
				$out .= '<input type="text" id="contact_form_name_' . esc_attr( $id ) . '" name="contact_form_name_'. esc_attr( $id ) . '" value="' . $name . '" />';
			$out .= '</div>';
			
			/* Email field */
			$out .= isset( $errors['email'] ) ? '<div class="form-row form-row-error">' : '<div class="form-row">';				
				$out .= '<label for="contact_form_email_' . esc_attr( $id ) . '">';
					$out .= esc_html( __( 'Email', 'btp_theme' ) ) . ' <em class="meta">' . __( '(required)', 'btp_theme' );
				$out .= '</em></label>';
				$out .= isset( $errors['email'] ) ? '<div class="form-message">'.esc_html( __('Please enter a valid email address', 'btp_theme') ).'</div>' : '' ;
				$out .= '<input type="text" id="contact_form_email_' . esc_attr( $id ) . '" name="contact_form_email_' . esc_attr( $id ) . '" value="' . $email . '" />';
			$out .= '</div>';
			
			/* Message field */
			$out .= isset( $errors['message'] ) ? '<div class="form-row form-row-error">' : '<div class="form-row">';
				$out .= '<label for="contact_form_message_' . esc_attr( $id ) . '">' . esc_html( __( 'Message', 'btp_theme' ) ) . '</label>';
				$out .= isset( $errors['message'] ) ? '<div class="form-message">'.esc_html( __('Please leave a message', 'btp_theme') ).'</div>' : '' ;
				$out .= '<textarea id="contact_form_message_' . esc_attr( $id ) . '" name="contact_form_message_' . esc_attr( $id ) . '" rows="5" cols="5">' . $message . '</textarea>';
			$out .= '</div>';
			
			/* Captcha field */
			$out .= isset( $errors['captcha'] ) ? '<div class="form-row form-row-error">' : '<div class="form-row">';
				$out .= '<label for="contact_form_captcha_' . esc_attr( $id ) . '">';
					$out .= esc_html( $captcha_n1 . ' + ' . $captcha_n2 . ' ? ') . '<em class="meta">' . __( '(just to check if you are human)', 'btp_theme');
				$out .= '</em></label>';
				$out .= isset( $errors['captcha'] ) ? '<div class="form-message">' . esc_html( __( 'Please enter a valid result', 'btp_theme') ) . '</div>' : '' ;
				$out .= '<input type="text" class="u-2" id="contact_form_captcha_' . esc_attr( $id ) . '" name="contact_form_captcha_' . esc_attr( $id ) . '" value="" />';
			$out .= '</div>';				
			
			/* Hidden captcha hash */
			$out .= '<fieldset>';
				$out .= '<input type="hidden" id="contact_form_captcha_hash_' . esc_attr( $id) . '" name="contact_form_captcha_hash_' . esc_attr( $id ) . '" value="' . $captcha_hidden_hash . '" />';
			$out .= '</fieldset>';			
			
			/* Submit button */
			$out .= '<div class="form-row">';
				$out .= '<input type="submit" name="contact_form_submit_' . esc_attr( $id ) . '" id="contact_form_submit_' . esc_attr( $id ) . '" value="' . __( 'Submit', 'btp_theme' ) . '" />';
			$out .= '</div>';			
			
		$out .= '</form>';
		
		return $out;
	}
?>