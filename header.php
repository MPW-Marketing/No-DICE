<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title>
		<?php 
		if(is_front_page())
			echo get_bloginfo('name').' - '.get_bloginfo('description');
		else
			 wp_title( '', true, 'right' ); 
		 ?>
	</title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	
	<?php btp_include_skin_css(); ?>
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri().'/js/prettyPhoto/css/prettyPhoto.css'; ?>" />
	
	<?php btp_render_favicon(); ?>
	<?php btp_render_apple_touch_icon(); ?>
	
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" /><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" /><![endif]-->

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php 
		wp_enqueue_script('jquery'); 
		wp_enqueue_script('metadata', get_template_directory_uri().'/js/jquery-metadata/jquery.metadata.js', array('jquery'));
		wp_enqueue_script('easing', get_template_directory_uri().'/js/easing/jquery.easing.1.3.js', array('jquery'));
	
		wp_enqueue_script('jcycle', get_template_directory_uri().'/js/jquery.cycle/jquery.cycle.all.min.js', array('jquery'));
		wp_enqueue_script('kwicks', get_template_directory_uri().'/js/jquery.kwicks.2.0/js/jquery.kwicks.min.js', array('jquery'));		
		wp_enqueue_script('prettyphoto', get_template_directory_uri().'/js/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'));
			
		wp_enqueue_script('cufon', get_template_directory_uri().'/js/cufon/cufon-yui.js', array('jquery'));
		
		$btp_font = btp_get_theme_option('style_font_replacement_font');
		wp_enqueue_script('cufon_font', get_template_directory_uri().'/js/cufon/'.$btp_font.'.js', array('jquery', 'cufon'));
		
		wp_enqueue_script('swfobject', get_template_directory_uri().'/js/swfobject/swfobject.js', array('jquery'));
		wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', array('jquery'), '1.0');
	?>

	<?php
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		wp_head();
	?>
			
	<?php btp_render_custom_styles(); ?>	

<!-- INSERT THIS CODE IN YOUR PAGE HEAD ON EVERY PAGE -->
<script type="text/JavaScript" src="https://secure.ifbyphone.com/js/ibp_clickto_referral.js"></script>
<script type="text/JavaScript">
    var _ibp_public_key = "9f07b368a10015f031d2929e655edd9b5819dadb";
    var _ibp_formatting = true;
    var _ibp_keyword_set = 43914;
</script>  
</head>

<body <?php body_class(); ?>>
<?php echo btp_the_jquery_metadata(); ?>

<div id="page">
	<?php if(btp_get_theme_option('general_preheader_enable')): ?>
		<div id="preheader">
			<div id="preheader-inner">
				<?php $preheader_sidebar_layout = btp_get_columns_layout(btp_get_theme_option('general_preheader_sidebar_layout'));	?>			
				<?php if(count($preheader_sidebar_layout)): $i = 0; ?>							
					<?php foreach($preheader_sidebar_layout as $grid): ?>
						<div class="grid">
							<?php foreach($grid as $x): $i++; ?>				
							<div class="c-<?php echo $x; ?>">
								<?php if(is_active_sidebar( 'preheader-'.$i )) dynamic_sidebar( 'preheader-'.$i ); ?>
							</div>
							<?php endforeach; ?>				
						</div>
					<?php endforeach; ?>
				<?php endif; ?>				
			</div><!-- #preheader-inner -->
			<div id="preheader-toggle">
				<span class="arrow"><span class="css-shape"></span></span>
			</div>
		</div><!-- #preheader -->				
	<?php endif; ?>
			
	<div id="header">	
		
		<div id="header-inner" class="clearfix">
		
			<div class="grid">
				<div class="c-8">	
					<?php btp_render_id(); ?>	
				</div>
				<div class="c-4">
          <?php if(btp_get_theme_option('general_search_form_enable')): ?>
            <?php get_search_form(); ?>
          <?php endif; ?>
					<div style="color:#000000; margin:0 0 0 2px; font-size:120%;">
						<p style="margin-top:20px;"><strong>Phone: </strong><script type="text/JavaScript" src="https://secure.ifbyphone.com/js/keyword_replacement.js"></script></p>
						<p style="margin-top:-15px;"><strong>E-MAIL:</strong>&nbsp;
						<a style="color:#24641b;" href="mailto:<?php echo antispambot('moreinfo@samscreen.com'); ?>"><strong><?php echo antispambot('moreinfo@samscreen.com'); ?></strong></a></p>
  					</div>
				</div>
			</div>	
				
				<div id="primary-bar">	
					<div id="primary-bar-inner">				
						<div id="primary-nav" class="nav">							  				
							<?php 
								$primary_nav = array(
									'theme_location'	=> 'primary_nav',
									'container'			=> '',
									'menu_id'			=> 'primary-nav-menu',
									'menu_class'		=> 'dd-menu',
									'depth'				=> 0								
								);
								wp_nav_menu($primary_nav); 
							?>					
						</div><!-- #primary-nav -->
						
						<div id="feeds-nav">
							<?php echo do_shortcode('[feeds template="list-horizontal" hide="label, caption" linking="new-window"]'); ?>
						</div>
					</div><!-- #primary-bar-inner -->							
					<div class="background"><!--  --></div>
				</div><!-- #primary-bar -->
				
		</div><!-- #header-inner -->		
		<div class="background"><!-- --></div>	
	</div><!-- #header -->