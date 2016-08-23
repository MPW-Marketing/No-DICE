<?php
	$btp_title = '';
	$btp_intro = '';
	$btp_breadcrumbs = array();

	if( is_home() ){
		if( get_option('show_on_front') != 'posts' ) {
			$id = (int) get_option('page_for_posts');
			
			if ( !btp_bool( get_post_meta( $id, '_btp_hide_title', true ) ) )
				$btp_title = get_the_title($id);
			
			$btp_intro = get_post_meta($id, '_btp_page_intro', true);
		}
		else {
			$btp_title = get_option('blogname');
			$btp_intro = '';
		}
	/* Archives */
	} elseif( is_category() ) {
		$btp_title = single_cat_title('', false);
		$btp_intro = __('Blog Archives by Category', 'btp_theme');
	} elseif( is_tag() ) {
		$btp_title = single_tag_title('', false);
		$btp_intro = __('Blog Archives by Tag', 'btp_theme');	
	} elseif( is_author() ) {
		
		$curauth = null;
		if ( get_query_var( 'author_name' ) )
			$curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );			
			
		if ( get_query_var( 'author' ) )
			$curauth = get_user_by( 'id', get_query_var( 'author' ) );		
		
		$btp_title = $curauth->display_name;
		
		$btp_intro = __('Blog Archives by Author', 'btp_theme');	
	} elseif( is_day() ) {
		$btp_title = get_the_date();
		$btp_intro = __('Blog Archives by Day', 'btp_theme');	
	} elseif( is_month() ) {
		$btp_title = get_the_date('F Y');
		$btp_page_intro = __('Blog Archives by Month', 'btp_theme');	
	} elseif( is_year() ) {
		$btp_title = get_the_date('Y');
		$btp_intro = __('Blog Archives by Year', 'btp_theme');
	} elseif( is_single() && get_post_type() == 'post' ) {
		$btp_title = the_title( '', '', false );	
		$btp_hide = btp_get_post_single_hidden_elements();	
		if ( isset( $btp_hide['title'] ) )
			$btp_title = '';
	}
	
				
	/**
	 * You can hide breadcrumbs on the whole blog or only on the blog main page 
	 */		
	if ( btp_bool( btp_get_theme_option('general_breadcrumbs_enable', true ) ) ) {		
		$btp_breadcrumbs = btp_get_breadcrumbs();

		if( btp_is_static_posts_page() ) {
			$btp_post_id = (int) get_option( 'page_for_posts' );	
			if ( btp_bool( get_post_meta( $btp_post_id, '_btp_hide_breadcrumbs', true ) ) == true ) {
				$btp_breadcrumbs = array();
			}
		}		
	}		
?>
<?php if( count( $btp_breadcrumbs ) || strlen( $btp_title ) || strlen( $btp_intro ) ): ?>
<div class="hd">
	<?php btp_render_breadcrumbs( $btp_breadcrumbs ); ?>
	
	<?php if ( strlen( $btp_title ) ): ?>
		<h1 class="page-title"><?php echo esc_html( $btp_title ); ?></h1>
	<?php endif; ?>
	
	<?php if ( strlen( $btp_intro ) ): ?>
		<p class="page-intro meta"><?php echo esc_html( $btp_intro ); ?></p>
	<?php endif; ?>			
</div>
<?php endif; ?>