<?php 
	function btp_twitter_shortcode_generator_item() {
		return new BTP_Shortcode_Generator_Item( 
			'twitter',
			array(
				'label'			=> '[twitter] shortcode',
				'attributes'	=> array(
					new BTP_Form_Unit_Input_Text( 'username', array(
						'label' => 'username *',
						'hint'	=> __( 'Twitter username', 'btp_theme' ),
					) ),					
					new BTP_Form_Unit_Input_Text( 'max', array(
						'label' => 'max *',
						'value' => 3,
						'hint'  => __( 'Maximum number of items', 'btp_theme'),
					)),
				),
				'display'		=> 'block',
			)			 
		); 
	}
	
	// Based on http://www.zetalight.com/how-to-add-twitter-in-wordpress-using-a-simple-php-function/
	// Based on http://davidwalsh.name/linkify-twitter-feed
	function btp_twitter_shortcode( $atts, $content = null ) {		
		extract( shortcode_atts( array(
			'username' => 'bringthepixel',
			'max' => 1		
		    ), $atts ) );
		$max = abs((int)$max);
		
		$transient = 'btp_twitter_'.$username.'_'.$max;		
		
		$out = get_transient($transient);		
				
		if (false === $out) {	
			$resource = 'http://twitter.com/statuses/user_timeline.json?screen_name=' . $username . '&count=' . $max;
		
			$out = '';
			
			$result = wp_remote_get($resource);
			if( is_wp_error( $result ) )
				return $out;
			
			$json = $result['body'];
			//Convert JSON String to PHP Array
			$tweets = json_decode($json);
		
			
			$out .= '<ul class="tweets">';	

			foreach ( (array) $tweets as $tweet) {
				// Convert twitter Usernames and links to Hyperlinks
				//$tweetcontent = linkify($tweet->text);
				$out .= '<li>';
					$out .= '<div class="tweet">';
						$out .= '<p class="tweet-text">'.btp_twitter_linkify($tweet->text).'</p>';
						$out .= '<p class="meta">';
							$out .= '<a href="http://twitter.com/'.$username.'/status/'.$tweet->id.'" rel="bookmark">';
								$out .= date(get_option('time_format'), strtotime($tweet->created_at));
								$out .= ', ';
								$out .= date(get_option('date_format'), strtotime($tweet->created_at)); 
							$out .= '</a>';
						$out .= '</p>';
					$out .= '</div>';
				$out .= '</li>';
			}
			
			$out .= '</ul>';
				
			//Set transient, 15 minutes
			set_transient($transient, $out, 60*15);
		}
		
		return $out;	
	}
	
	function btp_twitter_linkify( $status_text ) {
  		// linkify URLs
  		$status_text = preg_replace(
    		'/(https?:\/\/\S+)/',
    		'<a href="\1">\1</a>',
    		$status_text
  		);

	  	// linkify twitter users
  		$status_text = preg_replace(
    		'/(^|\s)@(\w+)/',
    		'\1@<a href="http://twitter.com/\2">\2</a>',
    	$status_text
  		);

		// linkify tags
  		$status_text = preg_replace(
    		'/(^|\s)#(\w+)/',
    		'\1#<a href="http://search.twitter.com/search?q=%23\2">\2</a>',
    	$status_text
  		);

  		return $status_text;
	}
?>