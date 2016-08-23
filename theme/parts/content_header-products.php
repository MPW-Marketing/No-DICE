<?php
$btp_title = '';
$btp_breadcrumbs = array();

if ( is_archive() && get_post_type() == 'btp_product' ) {
	$taxonomy_slug = get_query_var('taxonomy');
	
	$term = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy_slug);		
	$btp_title = $term->name;
}
elseif ( is_single() && get_post_type() == 'btp_product' ) {
	$btp_title = the_title( '', '', false );
	
	$btp_hide = btp_get_product_single_hidden_elements();	
	if ( isset( $btp_hide['title'] ) )
		$btp_title = '';
}
else {
	$btp_title = the_title( '', '', false );
}

if ( btp_bool( btp_get_theme_option('general_breadcrumbs_enable', true ) ) )
		$btp_breadcrumbs = btp_get_breadcrumbs(); 	

?>
<?php if( count( $btp_breadcrumbs ) || strlen( $btp_title ) ): ?>
<div class="hd">
	<?php btp_render_breadcrumbs( $btp_breadcrumbs ); ?>
	
	<?php if ( strlen( $btp_title ) ): ?>
		<h1 class="page-title"><?php echo esc_html( $btp_title ); ?></h1>
	<?php endif; ?>	
</div>
<?php endif; ?>