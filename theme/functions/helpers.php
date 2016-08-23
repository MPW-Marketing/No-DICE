<?php

/**
 *  Custom function for displaying comments 
 */
function btp_wp_list_comments_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrapper">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'btp_theme' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'btp_theme' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata meta">
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( __( '%1$s at %2$s', 'btp_theme' ), get_comment_date(),  get_comment_time() ); ?>
				</a> 
				<?php edit_comment_link( __('(Edit)', 'btp_theme' ), ' ' ); ?>
			</div>

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</div><!-- END: #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><?php _e( 'Pingback:', 'btp_theme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'btp_theme'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}


/**
 * Prints HTML|JavaScript with tracking code set up in Theme Options.
 * 
 * @since DICE Theme 1.0 
 */
function btp_render_tracking_code() {
	if ( btp_bool( btp_get_theme_option( 'tracking_code_enable' ) ) ) {
		$t_c = btp_get_theme_option( 'tracking_code' );
		if ( strlen( $t_c  ) )
			echo $t_c;
	}
}


/**
 * Renders custom styles (set in Theme Options) compiled into css code.
 * 
 * @param bool $echo
 */
function btp_render_custom_styles( $echo = true ) {
	$btp_css = '';
			
			
	$btp_css .= '<style type="text/css">';
	
	$temp = btp_get_theme_option( 'style_theme_alignment' );
	if ( strlen( $temp ) )
		switch ( $temp ) {
			case 'left':
				$btp_css .= "\n".'#preheader, #preheader-inner, #preheader-toggle, #header, #header-inner, #precontent, #precontent-inner, #content, #content-inner, #prefooter, #prefooter-inner, #footer, #footer-inner { margin-left: 0; margin-right: auto; }';
				break;
			case 'center':
				$btp_css .= "\n".'#preheader, #preheader-inner, #preheader-toggle, #header, #header-inner, #precontent, #precontent-inner, #content, #content-inner, #prefooter, #prefooter-inner, #footer, #footer-inner { margin-left: auto; margin-right: auto; }';
				break;
			case 'right':
				$btp_css .= "\n".'#preheader, #preheader-inner, #preheader-toggle, #header, #header-inner, #precontent, #precontent-inner, #content, #content-inner, #prefooter, #prefooter-inner, #footer, #footer-inner { margin-left: auto; margin-right: 0; }';
				break;
		}
		
	if( !btp_bool( btp_get_theme_option( 'style_custom_styles_enable' ) ) ) {
		$btp_css .= "\n".'</style>';
		
		if ( $echo ) {
			echo $btp_css;
			return;	
		}	
		else {	
			return $btp_css;
		}	
	}		
		

	/* ----- PREHEADER ------------------------------------------------------------------- */
	$btp_css .= "\n\n".'/* ----- PREHEADER ----------------------------------------------------------------- */';
	
	$temp = btp_get_theme_option( 'style_preheader_toggle_alignment' );
	if ( strlen( $temp ) )
		switch ( $temp ) {
			case 'left-screen':
				$btp_css .= "\n".'#preheader-toggle { width: auto; }';	
				$btp_css .= "\n".'#preheader-toggle .arrow { position: absolute; left: 0; bottom: -16px; }';
				break;
			case 'left-outside':
				$btp_css .= "\n".'#preheader-toggle { width: 967px; }';
				$btp_css .= "\n".'#preheader-toggle .arrow { position: absolute; left: -16px; bottom: -16px; }';
				break;
			case 'left-inside':
				$btp_css .= "\n".'#preheader-toggle { width: 967px; }';
				$btp_css .= "\n".'#preheader-toggle .arrow { position: absolute; left: 31px; bottom: -16px; }';
				break;
			case 'center':
				$btp_css .= "\n".'#preheader-toggle { width: 967px; text-align: center; }';
				$btp_css .= "\n".'#preheader-toggle .arrow { margin: 0 auto; position: relative; bottom: 0; }';
				break;
			case 'right-inside':
				$btp_css .= "\n".'#preheader-toggle { width: 967px; }';
				$btp_css .= "\n".'#preheader-toggle .arrow { position: absolute; right: 31px; bottom: -16px; }';
				break;
			case 'right-outside':
				$btp_css .= "\n".'#preheader-toggle { width: 967px; }';
				$btp_css .= "\n".'#preheader-toggle .arrow { position: absolute; right: -16px; bottom: -16px; }';
				break;
			case 'right-screen':
				$btp_css .= "\n".'#preheader-toggle { width: auto; }';		
				$btp_css .= "\n".'#preheader-toggle .arrow { position: absolute; right: 0; bottom: -16px; }';
				break;
		}
		
	
	$temp = btp_get_theme_option( 'style_preheader_background_color' );
	if( !empty( $temp ) )
		$btp_css .= "\n".'#preheader { background-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_preheader_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#preheader, #preheader input, #preheader select, #preheader textarea { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_preheader_link_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#preheader a { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_preheader_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#preheader a:hover { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_preheader_meta_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#preheader .meta { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_preheader_meta_link_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#preheader .meta a { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_preheader_meta_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#preheader .meta a:hover { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_preheader_line_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#preheader * { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .button { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .progress-bar { border-color: '.$temp.'; }';
	}	
	
	$temp = btp_get_theme_option( 'style_preheader_primary_background_color' );
	if ( !empty( $temp ) ) {			
		$btp_css .= "\n".'#preheader .button.primary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .button.primary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#preheader .button.primary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#preheader .button.primary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#preheader .plus, #preheader .minus, #preheader .arrow { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .plus, #preheader .minus, #preheader .arrow { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#preheader .progress-bar-value { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .progress-bar-value { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#preheader table.pricing th.featured  { border-top-color: '.$temp.'; border-right-color: '.$temp.'; border-left-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader table.pricing tbody td.featured  { border-right-color: '.$temp.'; border-left-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader table.pricing tfoot td.featured  { border-right-color: '.$temp.'; border-bottom-color: '.$temp.'; border-left-color: '.$temp.'; }';		
	}
	
	$temp = btp_get_theme_option( 'style_preheader_primary_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#preheader .button.primary span { color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .arrow .css-shape { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .plus .css-line-hor, #preheader .plus .css-line-ver { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .minus .css-line-hor, #preheader .minus .css-line-ver { background-color: '.$temp.'; }';
	}
		
	$temp = btp_get_theme_option( 'style_preheader_primary_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#preheader .plus:hover, #preheader .minus:hover, #preheader .arrow:hover { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .plus:hover, #preheader .minus:hover, #preheader .arrow:hover { background-position: 0 '.((-40)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#preheader .button.primary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .button.primary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#preheader .button.primary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#preheader .button.primary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_preheader_primary_hover_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#preheader .button.primary:hover span { color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .arrow:hover .css-shape { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .plus:hover .css-line-hor, #preheader .plus:hover .css-line-ver { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .minus:hover .css-line-hor, #preheader .minus:hover .css-line-ver { background-color: '.$temp.'; }';
	}
	
	$temp = btp_get_theme_option( 'style_preheader_secondary_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#preheader .button.secondary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .button.secondary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#preheader .button.secondary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#preheader .button.secondary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_preheader_secondary_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#preheader .button.secondary span { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_preheader_secondary_hover_background_color' );
	if ( !empty($temp ) ) {
		$btp_css .= "\n".'#preheader .button.secondary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .button.secondary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#preheader .button.secondary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#preheader .button.secondary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_preheader_secondary_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#preheader .button.secondary:hover span { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_preheader_tertiary_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#preheader .button.tertiary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .button.tertiary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#preheader .button.tertiary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#preheader .button.tertiary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#preheader .progress-bar-scale { background-color: '.$temp.'; }';		
		$btp_css .= "\n".'#preheader .progress-bar-scale { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';
	}
	
	$temp = btp_get_theme_option( 'style_preheader_tertiary_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#preheader .button.tertiary span { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_preheader_tertiary_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#preheader .button.tertiary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#preheader .button.tertiary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#preheader .button.tertiary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#preheader .button.tertiary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_preheader_tertiary_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#preheader .button.tertiary:hover span { color: '.$temp.'; }';
	
	/* ----- HEADER ----------------------------------------------------------------- */
	$btp_css .= "\n\n".'/* ----- HEADER ----------------------------------------------------------------- */';
	
	$temp = btp_get_theme_option( 'style_header_layout' );		
	if ( !empty( $temp ) ) {
		
		if ( $temp == 'stretched' )
			$btp_css .= "\n".'#header { width: auto; }';
		else			
			$btp_css .= "\n".'#header { width: 967px; }';
	}
	
	$temp = btp_get_theme_option( 'style_header_logo_alignment' );		
	if ( $temp == 'right') {
		$btp_css .= "\n".'#header .c-8 { margin: 0; float: right; text-align: right; }';
		$btp_css .= "\n".'#header .c-4 { margin: 0; float: left; }';
	}
	
	$temp = btp_get_theme_option( 'style_header_logo_margin_top' );		
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#header-inner { padding-top: '.intval($temp).'px; }';			
	
	$temp = btp_get_theme_option( 'style_header_logo_margin_bottom' );		
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#id { margin-bottom: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_header_margin_top' );		
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#header { margin-top: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_header_border_top_width' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#header { border-top-width: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_header_border_top_color' );
	if ( strlen( $temp ) ) 
		$btp_css .= "\n".'#header { border-top-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_padding_bottom' );		
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#header { padding-bottom: '.intval($temp).'px; }';

	$temp = btp_get_theme_option( 'style_header_border_bottom_width' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#header { border-bottom-width: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_header_border_bottom_color' );
	if ( strlen( $temp ) ) 
		$btp_css .= "\n".'#header { border-bottom-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_margin_bottom' );		
	if( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#header { margin-bottom: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_header_background_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#header .background { background-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_background_opacity' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#header .background { filter:alpha(opacity='.($temp*100).'); -khtml-opacity: '.$temp.'; -moz-opacity: '.$temp.';  opacity: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#header, #header input, #header select, #header textarea { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_link_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#header a { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#header a:hover { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_meta_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#header .meta { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_meta_link_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#header .meta a { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_meta_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#header .meta a:hover { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_line_color' );
	if( strlen( $temp ) ) 
		$btp_css .= "\n".'#header * { border-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_menu_1_link_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#primary-nav-menu a { color: '.$temp.'; }';
			
	$temp = btp_get_theme_option( 'style_header_menu_1_link_hover_color' );
	if ( strlen( $temp ) ) {
		$btp_css .= "\n".'#primary-nav-menu > li a:hover { color: '.$temp.'; }';
		$btp_css .= "\n".'#primary-nav-menu > li.current-menu-item > a { color: '.$temp.'; }';
		$btp_css .= "\n".'#primary-nav-menu > li.current-menu-ancestor > a { color: '.$temp.'; }';
		$btp_css .= "\n".'#primary-nav-menu > li.current_page_parent > a { color: '.$temp.'; }';
	}
	
	$temp = btp_get_theme_option( 'style_header_menu_sub_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#primary-nav-menu ul { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#primary-nav-menu a span.dd-arrow .css-shape { border-bottom-color: '.$temp.'; }';
	}
	
	$temp = btp_get_theme_option( 'style_header_menu_sub_link_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#primary-nav-menu ul a { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_header_menu_sub_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#primary-nav-menu ul a:hover, #primary-nav-menu ul .dd-path { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#primary-nav-menu ul a:hover, #primary-nav-menu ul .dd-path { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#primary-nav-menu ul a span.dd-arrow .css-shape { border-left-color: '.$temp.'; }';
	}
	
	$temp = btp_get_theme_option( 'style_header_menu_sub_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#primary-nav-menu ul a:hover, #primary-nav-menu ul .dd-path { color: '.$temp.'; }';
	
		
	$temp = btp_get_theme_option( 'style_header_primary_bar_background_color' );
	if ( !empty( $temp ) ) 		
		$btp_css .= "\n".'#primary-bar .background { background-color: '.$temp.'; background-image: url('.get_bloginfo('template_url').'/images/primary_bar_overlay_'.btp_get_color_range($temp).'.png); }';
	
	$temp = btp_get_theme_option( 'style_header_primary_bar_background_opacity' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#primary-bar .background { filter:alpha(opacity='.($temp*100).'); -khtml-opacity: '.$temp.'; -moz-opacity: '.$temp.';  opacity: '.$temp.'; }';
	
	/* ----- PRECONTENT ----------------------------------------------------------------- */
	$btp_css .= "\n\n".'/* ----- PRECONTENT ----------------------------------------------------------------- */';
	
	$temp = btp_get_theme_option( 'style_precontent_layout' );		
	if( strlen( $temp ) ) {
		
		if($temp == 'stretched')
			$btp_css .= "\n".'#precontent { width: auto; }';
		else			
			$btp_css .= "\n".'#precontent { width: 967px; }';
	}
	
	$temp = btp_get_theme_option( 'style_precontent_border_top_width' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#precontent { border-top-width: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_precontent_border_top_color' );
	if ( strlen( $temp ) ) 
		$btp_css .= "\n".'#precontent { border-top-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_precontent_padding_top' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#precontent-inner { padding-top: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_precontent_padding_bottom' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#precontent-inner { padding-bottom: '.intval($temp).'px; }';

	$temp = btp_get_theme_option( 'style_precontent_border_bottom_width' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#precontent { border-bottom-width: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_precontent_border_bottom_color' );
	if ( strlen( $temp ) ) 
		$btp_css .= "\n".'#precontent { border-bottom-color: '.$temp.'; }';
	
	
	$temp = btp_get_theme_option( 'style_precontent_margin_bottom' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#precontent { margin-bottom: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_precontent_slider_shadow_enable' );
	if ( strlen( $temp ) ) {
		if ( btp_bool( $temp ) ) {
			$btp_css .= "\n".'#slider { padding-bottom: 25px; background: url('.get_bloginfo('template_url').'/images/shadow_12_wide.png) center bottom no-repeat; }';
		} else {	
			$btp_css .= "\n".'#slider { padding-bottom: 0; background: none; }';
		}
	}

	
	$temp = btp_get_theme_option( 'style_precontent_background_color' );
	if( !empty( $temp ) ) 
		$btp_css .= "\n".'#precontent .background { background-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_precontent_background_opacity' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#precontent .background { filter:alpha(opacity='.($temp*100).'); -khtml-opacity: '.$temp.'; -moz-opacity: '.$temp.';  opacity: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_precontent_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#precontent, #precontent input, #precontent select, #precontent textarea { color: '.$temp.'; }';

	$temp = btp_get_theme_option( 'style_precontent_link_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#precontent a { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_precontent_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#precontent a:hover { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_precontent_meta_color' );
	if ( !empty( $temp ) )
		$btp_css .= "\n".'#precontent .meta { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_precontent_meta_link_color' );
	if( !empty( $temp ) ) 
		$btp_css .= "\n".'#precontent .meta a { color: '.$temp.'; }';

	$temp = btp_get_theme_option( 'style_precontent_meta_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#precontent .meta a:hover { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_precontent_line_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#precontent * { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .button { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .progress-bar { border-color: '.$temp.'; }';
	}	
		
	$temp = btp_get_theme_option( 'style_precontent_primary_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#precontent .button.primary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .button.primary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#precontent .button.primary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#precontent .button.primary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#precontent .plus, #precontent .minus, #precontent .arrow { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .plus, #precontent .minus, #precontent .arrow { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#precontent .progress-bar-value { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .progress-bar-value { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';			
		$btp_css .= "\n".'#precontent table.pricing th.featured  { border-top-color: '.$temp.'; border-right-color: '.$temp.'; border-left-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent table.pricing tbody td.featured  { border-right-color: '.$temp.'; border-left-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent table.pricing tfoot td.featured  { border-right-color: '.$temp.'; border-bottom-color: '.$temp.'; border-left-color: '.$temp.'; }';	
	}
	
	$temp = btp_get_theme_option( 'style_precontent_primary_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#precontent .button.primary span { color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .arrow .css-shape { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .plus .css-line-hor, #precontent .plus .css-line-ver { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .minus .css-line-hor, #precontent .minus .css-line-ver { background-color: '.$temp.'; }';
	}
		
	$temp = btp_get_theme_option( 'style_precontent_primary_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#precontent .plus:hover, #precontent .minus:hover, #precontent .arrow:hover { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .button.primary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .button.primary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#precontent .button.primary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#precontent .button.primary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_precontent_primary_hover_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#precontent .button.primary:hover span { color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .arrow:hover .css-shape { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .plus:hover .css-line-hor, #precontent .plus:hover .css-line-ver { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .minus:hover .css-line-hor, #precontent .minus:hover .css-line-ver { background-color: '.$temp.'; }';
	}
	
	$temp = btp_get_theme_option( 'style_precontent_secondary_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#precontent .button.secondary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .button.secondary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#precontent .button.secondary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#precontent .button.secondary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_precontent_secondary_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#precontent .button.secondary span { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_precontent_secondary_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#precontent .button.secondary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .button.secondary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#precontent .button.secondary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#precontent .button.secondary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_precontent_secondary_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#precontent .button.secondary:hover span { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_precontent_tertiary_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#precontent .button.tertiary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .button.tertiary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#precontent .button.tertiary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#precontent .button.tertiary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';					
		$btp_css .= "\n".'#precontent .progress-bar-scale { background-color: '.$temp.'; }';		
		$btp_css .= "\n".'#precontent .progress-bar-scale { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';
	}
	
	$temp = btp_get_theme_option( 'style_precontent_tertiary_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#precontent .button.tertiary span { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_precontent_tertiary_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#precontent .button.tertiary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#precontent .button.tertiary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#precontent .button.tertiary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#precontent .button.tertiary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_precontent_tertiary_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#precontent .button.tertiary:hover span { color: '.$temp.'; }';
	
	/* ----- CONTENT ----------------------------------------------------------------- */
	$btp_css .= "\n\n".'/* ----- CONTENT ----------------------------------------------------------------- */';
	
	$temp = btp_get_theme_option( 'style_content_layout' );
	if ( !empty( $temp ) ) {
		
		if( $temp == 'stretched' )
			$btp_css .= "\n".'#content { width: auto; }';
		else			
			$btp_css .= "\n".'#content { width: 967px; }';
	}
	
	$temp = btp_get_theme_option( 'style_content_border_top_width' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#content { border-top-width: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_content_border_top_color' );
	if ( strlen( $temp ) ) 
		$btp_css .= "\n".'#content { border-top-color: '.$temp.'; }';

	$temp = btp_get_theme_option( 'style_content_border_bottom_width' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#content { border-bottom-width: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_content_border_bottom_color' );
	if ( strlen( $temp ) ) 
		$btp_css .= "\n".'#content { border-bottom-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_content_margin_bottom' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#content { margin-bottom: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_content_background_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#content .background { background-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_content_background_opacity' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#content .background { filter:alpha(opacity='.($temp*100).'); -khtml-opacity: '.$temp.'; -moz-opacity: '.$temp.';  opacity: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_content_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#content, #content input, #content select, #content textarea { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_content_link_color' );
	if ( !empty( $temp ) )
		$btp_css .= "\n".'#content a { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_content_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#content a:hover { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_content_meta_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#content .meta { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_content_meta_link_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#content .meta a { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_content_meta_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#content .meta a:hover { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_content_line_color' );
	if ( !empty($temp ) ) { 
		$btp_css .= "\n".'#content * { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .button { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .progress-bar { border-color: '.$temp.'; }';
	}	
		
	$temp = btp_get_theme_option( 'style_content_primary_background_color' );
	if ( !empty( $temp ) ) {			
		$btp_css .= "\n".'#content .button.primary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .button.primary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#content .button.primary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#content .button.primary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';			
		$btp_css .= "\n".'#content .plus, #content .minus, #content .arrow { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .plus, #content .minus, #content .arrow { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#content .progress-bar-value { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .progress-bar-value { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';			
		$btp_css .= "\n".'#content table.pricing th.featured  { border-top-color: '.$temp.'; border-right-color: '.$temp.'; border-left-color: '.$temp.'; }';
		$btp_css .= "\n".'#content table.pricing tbody td.featured  { border-right-color: '.$temp.'; border-left-color: '.$temp.'; }';
		$btp_css .= "\n".'#content table.pricing tfoot td.featured  { border-right-color: '.$temp.'; border-bottom-color: '.$temp.'; border-left-color: '.$temp.'; }';
	}
	
	$temp = btp_get_theme_option( 'style_content_primary_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#content .button.primary span { color: '.$temp.'; }';
		$btp_css .= "\n".'#content .arrow .css-shape { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .plus .css-line-hor, #content .plus .css-line-ver { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .minus .css-line-hor, #content .minus .css-line-ver { background-color: '.$temp.'; }';
	}
		
	$temp = btp_get_theme_option( 'style_content_primary_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#content .plus:hover, #content .minus:hover, #content .arrow:hover { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .button.primary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .button.primary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#content .button.primary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#content .button.primary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_content_primary_hover_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#content .button.primary:hover span { color: '.$temp.'; }';
		$btp_css .= "\n".'#content .arrow:hover .css-shape { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .plus:hover .css-line-hor, #content .plus:hover .css-line-ver { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .minus:hover .css-line-hor, #content .minus:hover .css-line-ver { background-color: '.$temp.'; }';
	}
	
	$temp = btp_get_theme_option( 'style_content_secondary_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#content .button.secondary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .button.secondary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#content .button.secondary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#content .button.secondary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_content_secondary_color' );
	if ( !empty( $temp ) )
		$btp_css .= "\n".'#content .button.secondary span { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_content_secondary_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#content .button.secondary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .button.secondary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#content .button.secondary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#content .button.secondary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_content_secondary_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#content .button.secondary:hover span { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_content_tertiary_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#content .button.tertiary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .button.tertiary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#content .button.tertiary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#content .button.tertiary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';			
		$btp_css .= "\n".'#content .progress-bar-scale { background-color: '.$temp.'; }';		
		$btp_css .= "\n".'#content .progress-bar-scale { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';
	}
	
	$temp = btp_get_theme_option( 'style_content_tertiary_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#content .button.tertiary span { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_content_tertiary_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#content .button.tertiary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#content .button.tertiary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#content .button.tertiary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#content .button.tertiary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_content_tertiary_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#content .button.tertiary:hover span { color: '.$temp.'; }';
	
	/* ----- PREFOOTER ----------------------------------------------------------------- */
	$btp_css .= "\n\n".'/* ----- PREFOOTER ----------------------------------------------------------------- */';
	
	$temp = btp_get_theme_option( 'style_prefooter_layout' );
	if ( strlen( $temp ) ) {
		
		if( $temp == 'stretched' )
			$btp_css .= "\n".'#prefooter { width: auto; }';
		else			
			$btp_css .= "\n".'#prefooter { width: 967px; }';
	}

	$temp = btp_get_theme_option( 'style_prefooter_border_top_width' );
	if ( is_numeric( $temp ) )
		$btp_css .= "\n".'#prefooter { border-top-width: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_border_top_color' );
	if ( strlen( $temp ) ) 
		$btp_css .= "\n".'#prefooter { border-top-color: '.$temp.'; }';

	$temp = btp_get_theme_option( 'style_prefooter_border_bottom_width' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#prefooter { border-bottom-width: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_border_bottom_color' );
	if ( strlen( $temp ) )
		$btp_css .= "\n".'#prefooter { border-bottom-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_margin_bottom' );
	if ( is_numeric( $temp ) )
		$btp_css .= "\n".'#prefooter { margin-bottom: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_background_color' );
	if ( !empty( $temp ) )
		$btp_css .= "\n".'#prefooter .background { background-color: '.$temp.'; }';

	$temp = btp_get_theme_option( 'style_prefooter_background_opacity' );
	if ( is_numeric( $temp ) )
		$btp_css .= "\n".'#prefooter .background { filter:alpha(opacity='.($temp*100).'); -khtml-opacity: '.$temp.'; -moz-opacity: '.$temp.';  opacity: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#prefooter, #prefooter input, #prefooter select, #prefooter textarea { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_link_color' );
	if ( !empty( $temp ) )
		$btp_css .= "\n".'#prefooter a { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#prefooter a:hover { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_meta_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#prefooter .meta { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_meta_link_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#prefooter .meta a { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_meta_link_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#prefooter .meta a:hover { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_line_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#prefooter * { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .button { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .progress-bar { border-color: '.$temp.'; }';
	}	
		
	$temp = btp_get_theme_option( 'style_prefooter_primary_background_color' );
	if ( !empty( $temp ) ) {			
		$btp_css .= "\n".'#prefooter .button.primary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .button.primary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#prefooter .button.primary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#prefooter .button.primary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';			
		$btp_css .= "\n".'#prefooter .plus, #prefooter .minus, #prefooter .arrow { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .plus, #prefooter .minus, #prefooter .arrow { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#prefooter .progress-bar-value { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .progress-bar-value { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';			
		$btp_css .= "\n".'#prefooter table.pricing th.featured  { border-top-color: '.$temp.'; border-right-color: '.$temp.'; border-left-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter table.pricing tbody td.featured  { border-right-color: '.$temp.'; border-left-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter table.pricing tfoot td.featured  { border-right-color: '.$temp.'; border-bottom-color: '.$temp.'; border-left-color: '.$temp.'; }';		
	}
	
	$temp = btp_get_theme_option( 'style_prefooter_primary_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#prefooter .button.primary span { color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .arrow .css-shape { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .plus .css-line-hor, #prefooter .plus .css-line-ver { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .minus .css-line-hor, #prefooter .minus .css-line-ver { background-color: '.$temp.'; }';
	}
		
	$temp = btp_get_theme_option( 'style_prefooter_primary_hover_background_color' );
	if( !empty( $temp ) ) {
		$btp_css .= "\n".'#prefooter .plus:hover, #footer .minus:hover, #footer .arrow:hover { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .button.primary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .button.primary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#prefooter .button.primary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#prefooter .button.primary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_prefooter_primary_hover_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#prefooter .button.primary:hover span { color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .arrow:hover .css-shape { border-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .plus:hover .css-line-hor, #prefooter .plus:hover .css-line-ver { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .minus:hover .css-line-hor, #prefooter .minus:hover .css-line-ver { background-color: '.$temp.'; }';
	}
	
	$temp = btp_get_theme_option( 'style_prefooter_secondary_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#prefooter .button.secondary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .button.secondary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#prefooter .button.secondary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#prefooter .button.secondary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_prefooter_secondary_color' );
	if ( !empty( $temp ) )
		$btp_css .= "\n".'#prefooter .button.secondary span { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_prefooter_secondary_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#prefooter .button.secondary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .button.secondary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#prefooter .button.secondary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#prefooter .button.secondary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_prefooter_secondary_hover_color' );
	if ( !empty( $temp ) )
		$btp_css .= "\n".'#prefooter .button.secondary:hover span { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_prefooter_tertiary_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#prefooter .button.tertiary span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .button.tertiary.small span { background-position: 0 '.(-60)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#prefooter .button.tertiary.medium span { background-position: 0 '.(-70)*btp_get_color_range($temp).'px; }';
		$btp_css .= "\n".'#prefooter .button.tertiary.big span { background-position: 0 '.(-110)*btp_get_color_range($temp).'px; }';				
		$btp_css .= "\n".'#prefooter .progress-bar-scale { background-color: '.$temp.'; }';		
		$btp_css .= "\n".'#prefooter .progress-bar-scale { background-position: 0 '.(-40)*btp_get_color_range($temp).'px; }';	
	}
	
	$temp = btp_get_theme_option( 'style_prefooter_tertiary_color' );
	if ( !empty( $temp ) )
		$btp_css .= "\n".'#prefooter .button.tertiary span { color: '.$temp.'; }';
		
	$temp = btp_get_theme_option( 'style_prefooter_tertiary_hover_background_color' );
	if ( !empty( $temp ) ) {
		$btp_css .= "\n".'#prefooter .button.tertiary:hover span { background-color: '.$temp.'; }';
		$btp_css .= "\n".'#prefooter .button.tertiary.small:hover span { background-position: 0 '.((-60)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#prefooter .button.tertiary.medium:hover span { background-position: 0 '.((-70)*btp_get_color_range($temp)).'px; }';
		$btp_css .= "\n".'#prefooter .button.tertiary.big:hover span { background-position: 0 '.((-110)*btp_get_color_range($temp)).'px; }';		
	}
	
	$temp = btp_get_theme_option( 'style_prefooter_tertiary_hover_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#prefooter .button.tertiary:hover span { color: '.$temp.'; }';
	
	/* ----- FOOTER ----------------------------------------------------------------- */
	$btp_css .= "\n\n".'/* ----- FOOTER ----------------------------------------------------------------- */';
	
	$temp = btp_get_theme_option( 'style_footer_layout' );
	if ( !empty( $temp ) ) {		
		if ( $temp == 'stretched' )
			$btp_css .= "\n".'#footer { width: auto; }';
		else			
			$btp_css .= "\n".'#footer { width: 967px; }';
	}		
	
	$temp = btp_get_theme_option( 'style_footer_border_top_width' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#footer { border-top-width: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_footer_border_top_color' );
	if ( strlen( $temp ) ) 
		$btp_css .= "\n".'#footer { border-top-color: '.$temp.'; }';

	$temp = btp_get_theme_option( 'style_footer_border_bottom_width' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#footer { border-bottom-width: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_footer_border_bottom_color' );
	if ( strlen( $temp ) ) 
		$btp_css .= "\n".'#footer { border-bottom-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_footer_margin_bottom' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#footer { margin-bottom: '.intval($temp).'px; }';
	
	$temp = btp_get_theme_option( 'style_footer_background_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#footer .background { background-color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_footer_background_opacity' );
	if ( is_numeric( $temp ) ) 
		$btp_css .= "\n".'#footer .background { filter:alpha(opacity='.($temp*100).'); -khtml-opacity: '.$temp.'; -moz-opacity: '.$temp.';  opacity: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_footer_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#footer { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_footer_link_color' );
	if ( !empty( $temp ) ) 
		$btp_css .= "\n".'#footer a { color: '.$temp.'; }';
	
	$temp = btp_get_theme_option( 'style_footer_link_hover_color' );
	if( !empty( $temp ) ) 
		$btp_css .= "\n".'#footer a:hover { color: '.$temp.'; }';
	
	$btp_css .= "\n".'</style>';
	
	if ( $echo )
		echo $btp_css;
	else
		return $btp_css;	
}
	


/**
 * Prints HTML with after entry sidebars area.
 * 
 * @param string $area_id
 * @param string $layout
 * @param string $sidebar_prefix
 */
function btp_render_after_entry_sidebars( $area_id, $layout, $sidebar_prefix ) {	
	$layout = btp_get_columns_layout($layout);
	?>
	<?php if(count($layout)): $i = 0; ?>
	<div class="after-entry-sidebars" id="<?php echo esc_attr($area_id); ?>">									
		<?php foreach($layout as $grid): ?>
			<div class="grid">
				<?php foreach($grid as $x): $i++; ?>				
				<div class="c-<?php echo $x; ?>">
					<?php if(is_active_sidebar( $sidebar_prefix.$i )) dynamic_sidebar( $sidebar_prefix.$i ); ?>
				</div>
				<?php endforeach; ?>				
			</div>
		<?php endforeach; ?>
	</div><!-- .after-entry-sidebars -->	
	<?php endif;
}
	


if ( ! function_exists( 'btp_render_placeholder' ) ) :
/**
 * Prints HTML with placeholder image.
 * 
 * @since DICE Theme 1.0
 */
function btp_render_placeholder( $size, $atts = '', $echo = true ) {

	$out = '';
	
	$out .= '<img src="' . get_template_directory_uri() . '/images/placeholder-'.esc_attr($size).'.png" '.
			'alt="' . __('No image placeholder', 'btp_theme') . '" ';
	
	switch( $size ) {
		case 'c-12-wide':
			$out .= 'width="967" height="400" ';
		case 'c-12':
			$out .= 'width="893" height="502" ';
			break;
		case 'post-thumbnail':
			$out .= 'width="581" height="326" ';
			break;
		case 'c-6':
			$out .= 'width="425" height="239" ';
			break;
		case 'c-4':
			$out .= 'width="269" height="179" ';
			break;
		case 'c-3':
			$out .= 'width="191" height="127" ';
			break;
		case 'c-2':
			$out .= 'width="113" height="75" ';
			break;
		case 'c-1':
			$out .= 'width="35" height="23" ';
			break;
		default:
			break;							
	}
	
	$out .=	'/>';
	
	if ( $echo )
		echo $out;
	else
		return $out;	
	
}
endif;





if ( ! function_exists( 'btp_render_id' ) ) :
/**
 * Prints HTML with site identification.
 * 
 * @since DICE Theme 1.0
 */
function btp_render_id() {
	$logo_src = btp_get_theme_option('general_logo_src');
	
	if ( strlen( $logo_src ) )
		$site_id = '<img src="' . esc_url($logo_src) . '" alt="' . get_bloginfo( 'name' ) . '" />';
	else
		$site_id = get_bloginfo( 'name' );
		
	?>	
	<div id="id">
		<h1>
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo $site_id; ?></a>
		</h1>				
	</div><!-- END: #id -->
	<?php			
}
endif;	





if ( ! function_exists( 'btp_title' ) ) :
/**
 * Prints HTML with title based on title linking method.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_title($before = '<h3>', $after = '</h3>' ) {
	global $post, $btp_lightbox_group;
	
    $asset_1 = get_post_meta($post->ID, '_btp_featured_asset_1', true);
	if ( empty( $asset_1 ) ) {
		$asset_1 = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
		$asset_1 = $asset_1[0];	
	} 
	
	$linking = get_post_meta($post->ID, '_btp_title_linking', true);
	$a_ = '';
	$_a = '</a>';	
						
	switch ( $linking ) {
		case 'none':
			$_a = '';								
			break;
			
		case 'new_window':
		case 'new-window':	
			
			$href = get_post_meta($post->ID, '_btp_featured_asset_1', true);
			if ( !strlen($href) )
				$href = get_permalink($post->ID); 
			
			$a_ .= '<a href="'.esc_url($href).'" title="'.the_title_attribute('echo=0').'" class="new-window">';
			break;
			
		case 'lightbox':								
			$a_ .= '<a href="'.esc_url($asset_1).'" title="'.esc_attr(get_the_excerpt()).'" rel="prettyPhoto'.esc_attr($btp_lightbox_group).'">';
			break;
			
		default:
			$a_ .= '<a href="'.get_permalink($post->ID).'" title="'.the_title_attribute('echo=0').'">';
			break;						
	}

	echo $before . $a_ . the_title('', '', false) . $_a. $after;	
}
endif;




if ( ! function_exists( 'btp_the_thumb' ) ) :
/**
 * Prints HTML with thumb based on thumb linking method.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_thumb( $size, $placeholder = true ) {
	global $post, $btp_lightbox_group;
	
    $asset_1 = get_post_meta($post->ID, '_btp_featured_asset_1', true);
	if ( empty( $asset_1 ) ) {
		$asset_1 = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
		$asset_1 = $asset_1[0];	
	} 	
	?>			     	    
        <p class="entry-thumb">
        <?php 
        	$linking = get_post_meta($post->ID, '_btp_thumb_linking', true);
			$a_ = '';
			$_a = '</a>';
			$indicator = '';	
											
			switch($linking){
				case 'none':
					$_a = '';									
					break;
							
				case 'new_window':
				case 'new-window':	
					$href = get_post_meta($post->ID, '_btp_featured_asset_1', true);
					if ( !strlen($href) )
						$href = get_permalink($post->ID);
					
					$a_ .= '<a href="'.esc_url($href).'" title="'.the_title_attribute('echo=0').'" class="new-window">';
					$indicator .= '<span class="indicator indicator-new-window"><span></span></span>';
								
					break;
								
				case 'lightbox':
					$href = get_post_meta($post->ID, '_btp_featured_asset_1', true);
					if($asset_1 != get_post_meta($post->ID, '_btp_featured_asset_1', true))
						$indicator .= '<span class="indicator indicator-zoom"><span></span></span>';
					else
						$indicator .= '<span class="indicator indicator-play"><span></span></span>';
									
					$a_ .= '<a href="'.esc_url($asset_1).'" title="'.esc_attr(get_the_excerpt()).'" rel="prettyPhoto'.esc_attr($btp_lightbox_group).'">';
					break;
								
				default:
					$a_ .= '<a href="'.get_permalink($post->ID).'" title="'.the_title_attribute('echo=0').'">';
					$indicator .= '<span class="indicator indicator-document"><span></span></span>';
					break;						
			}
					
			
			if ( has_post_thumbnail() ) {
				if ( $linking == 'lightbox' ) {
					$alt = esc_attr(get_the_title( $post->ID ) );
					$img = get_the_post_thumbnail( $post->ID, $size, array( 'alt' => $alt ) );
				}
				else
					$img = get_the_post_thumbnail( $post->ID, $size );
			}
			elseif( $placeholder ) {
				$img = btp_render_placeholder( $size, '', false );
			}	
			else {
				return;
			}			
						
							
			echo 	$a_.
					'<span class="frame"><span class="frame-inner">'.									
					$img.
					$indicator.
					'</span></span>'.
					$_a;					 
		?>        	        											
	</p>
	<?php
}
endif;



if ( ! function_exists( 'btp_the_primary_button' ) ) :
/**
 * Prints HTML with primary button.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_primary_button( $priority = 'primary', $size = 'small', $wide = false ) {	
	global $post;		
	if ( !$post )  
		return '';
		
	/* Determine label */
	$label = get_post_meta( $post->ID, '_btp_button_1_label', true );
	if( !strlen( $label ) )
		$label = __('More', 'btp_theme');

	/* Determine href */		
	$href = '';
	$linking = get_post_meta( $post->ID, '_btp_button_1_linking', true );
	switch ( $linking ) {
		case 'lightbox':
		case 'new-window':
		case 'new_window':	
			$href = get_post_meta( $post->ID, '_btp_featured_asset_1', true );
			if ( empty( $href ) ) {
				$href = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 'full' );
				$href = $href[0];	
			}
			break;
						
		default:
			$href = get_permalink($post->ID);	 
			break;	
	}	
		
	echo btp_button_shortcode( 
		$shortcode_atts = array(
			'href'		=> $href,
			'linking'	=> $linking,
			'priority' 	=> $priority,
			'size'		=> $size,
			'wide'		=> $wide,
		), 
		$label 
	);
	
}
endif;



/**
 * Prints HTML with secondary button.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_secondary_button( $priority = 'secondary', $size = 'small', $wide = false ) {	
	global $post;		
	if ( !$post ) { 
		return '';
	}

	echo btp_button_shortcode( 
		$shortcode_atts = array(
			'href'		=> get_post_meta( $post->ID, '_btp_featured_asset_2', true ),
			'linking'	=> get_post_meta( $post->ID, '_btp_button_2_linking', true ),
			'priority' 	=> $priority,
			'size'		=> $size,
			'wide'		=> $wide,
		), 
		get_post_meta( $post->ID, '_btp_button_2_label', true ) 
	);
}

/**
 * Prints HTML with tertiary button.
 * 
 * @since DICE Theme 1.0
 */
function btp_the_tertiary_button( $priority = 'tertiary', $size = 'small', $wide = false ) {	
	global $post;		
	if ( !$post ) { 
		return '';
	}

	echo btp_button_shortcode( 
		$shortcode_atts = array(
			'href'		=> get_post_meta( $post->ID, '_btp_featured_asset_3', true ),
			'linking'	=> get_post_meta( $post->ID, '_btp_button_3_linking', true ),
			'priority' 	=> $priority,
			'size'		=> $size,
			'wide'		=> $wide,
		), 
		get_post_meta( $post->ID, '_btp_button_3_label', true ) 
	);
}

?>