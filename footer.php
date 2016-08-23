	<?php $sidebar_layout = btp_get_columns_layout(btp_get_theme_option('general_prefooter_sidebar_layout'));	?>			
	<?php if(count($sidebar_layout)): $i = 0; ?>
		<div id="prefooter">
			<div id="prefooter-inner">							
			<?php foreach($sidebar_layout as $grid): ?>
				<div class="grid">
					<?php foreach($grid as $x): $i++; ?>				
					<div class="c-<?php echo $x; ?>">
						<?php if(is_active_sidebar( 'prefooter-'.$i )) dynamic_sidebar( 'prefooter-'.$i ); ?>
					</div>
					<?php endforeach; ?>				
				</div>
			<?php endforeach; ?>				
			</div><!-- #prefooter-inner -->
			<div class="background"><!--  --></div>		
		</div><!-- #prefooter -->	
	<?php endif; ?>
	
	<div id="footer">
		<div id="footer-inner">
			<div class="grid">									
				<div class="c-6">
					<p id="copyright"><?php echo btp_get_theme_option('general_footer_text'); ?></p>	
				</div>
				<div class="c-6">
					<?php 
						$footer_nav = array(
							'theme_location'	=> 'footer_nav',
							'container'			=> '',
							'menu_id'			=> 'footer-nav-menu',
							'menu_class'		=> 'footer-menu',
							'depth'				=> 1
						);
						wp_nav_menu($footer_nav); 
					?>
				</div>								
			</div>							
			</div><!-- #footer-inner -->
			<div class="background"><!--  --></div>		
		</div><!-- #footer -->	
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>