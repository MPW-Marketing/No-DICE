<?php
global $post;

$btp_title = '';
$btp_intro = '';
$btp_breadcrumbs = array();

if ( !btp_bool( get_post_meta( $post->ID, '_btp_hide_title', true ) ) )
	$btp_title = the_title( '', '', false );
	
if ( !btp_bool( get_post_meta( $post->ID, '_btp_hide_page_intro', true ) ) )
	$btp_intro = get_post_meta( $post->ID, '_btp_page_intro', true );	
	
if ( btp_bool( get_post_meta( $post->ID, '_btp_hide_breadcrumbs', true ) ) == false )
	if ( btp_bool( btp_get_theme_option('general_breadcrumbs_enable', true ) ) )
		$btp_breadcrumbs = btp_get_breadcrumbs(); 
	
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