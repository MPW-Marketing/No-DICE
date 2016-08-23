<?php    

	/**
	 * Adds resources required by Administration Panel  
	 */
    function btp_theme_admin_init() {
    	/* Include custom CSS for proper styling of admin options */
        wp_enqueue_style( 'btp_admin', get_template_directory_uri() . '/framework/admin/css/btp_admin.css', false, '1.0', 'all' );
        wp_enqueue_style( 'farbtastic' );
        
        /* Include custom JS for proper behaviour of admin options */
        wp_enqueue_script( 'main', get_template_directory_uri() . '/framework/admin/js/main.js', array( 'jquery' ) );        
        wp_enqueue_script( 'farbtastic' );        
        wp_enqueue_script('metadata', get_template_directory_uri().'/js/jquery-metadata/jquery.metadata.js', array('jquery'));
    }
    
    
    
	/**
	 * 
	 */
    function btp_theme_admin_menu() {    	
        global $btp_theme_name, $btp_theme_options;
		
       
		if ( isset($_GET['page']) && ($_GET['page'] == basename(__FILE__) ) ) {
			if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {                    
				if ( current_user_can( 'edit_theme_options' ) ) {
			
					foreach ($btp_theme_options as $option_id => $option_def) {	    	        	
						btp_update_theme_option_form_unit( $option_id, $option_def );
					}  	
					
					header( "Location: admin.php?page=btp_admin.php&saved=true" );
					die;
				} else {
					wp_die( __('You do not have sufficient permissions to access this page.') );
				}	    
			}
		}
        
        
        add_theme_page( $btp_theme_name . ' Theme', $btp_theme_name . ' Theme', 'administrator', basename(__FILE__), 'btp_theme_admin' );
    }
    
    

    /**
     * Renders Theme Options
     */
    function btp_theme_admin() {
        global $btp_theme_name, $btp_theme_options;        
        
        if ( isset( $_REQUEST['saved'] ) )
            echo '<div id="message" class="updated fade"><p><strong>' . esc_html( sprintf( __( "%s Theme Options saved", 'btp_theme' ), $btp_theme_name ) ).'</strong></p></div>';
        ?>
        <div class="wrap">
        	<h2><?php printf( __( "%s Theme Options", 'btp_theme' ), $btp_theme_name ); ?></h2>
        				  
	  		<form method="post">
	  		<?php wp_nonce_field( 'howto-metaboxes-general' ); ?>
			<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
			<?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
	  		
	  			<div class="btp-theme-options">
		            <?php 
		            	foreach ( $btp_theme_options as $option_id => $option_def )
		                	btp_render_theme_option_form_unit( $option_id, $option_def, get_option( $option_id ) ); 
		            ?>
		    	</div>
		    	<div class="btp-form-actions">
		            	<input type="submit" class="button-primary" name="submit" value="Save" />
		        	</div>     
			</form>
        </div>
        <?php
    }
    
    
    
    
    /**
     *  Installs theme options when activating theme.
     */
	function btp_install_theme_options() {
		global $pagenow;
		global $btp_theme_options;
		
		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

			foreach ( $btp_theme_options as $id => $def ) {
			 	if ( isset( $def['model'] ) && $def['model'] !== null ) {		 		
			 		$value = '';		 		
			 		$value = isset( $def['model']['default'] ) ? $def['model']['default'] : $value;
			 				 		
			 		add_option( $id, $value );	         
			 	}	
			}
		}		 	
	}
    
    
	/**
	 * Registers custom sidebars. 
	 */
    function btp_sidebar_generator_init() {	
    	$sidebars = explode( "\n", trim( btp_get_theme_option( 'sidebar_generator' ) ) );
    	$sidebars = array_map( 'trim', $sidebars );
    	

    	if ( count( $sidebars ) ) {    		
			foreach ( $sidebars as $sidebar) {
				if ( strlen( $sidebar ) ) {			
	    			register_sidebar( array(
						'name'				=> $sidebar,
						'id'				=> $sidebar,
					    'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
				   		'after_widget' 		=> '</div>',
			   			'before_title'  	=> '<h2 class="widgettitle">',
						'after_title'   	=> '</h2>' 
				    ));
				}
			}		    
    	}
    }
    
    
    
    
    
    
    /**
     * Render theme option form unit
     * 
     * @param string $option_id
     * @param array $option_def Definition of Model and View
     * @param mixed $option_val
     */     
    function btp_render_theme_option_form_unit( $option_id, $option_def, $option_val = null ) {
    	// Determine which view function to call			
    	$function_name = 'btp_view_render_func_' . preg_replace( '/[^0-9a-zA-Z_]*/', '', $option_def['view']['render_func'] );
    	
    	if ( $option_def['model'] !== null ) 
    		call_user_func( $function_name, $option_id, $option_def, $option_val );
		else		
			call_user_func( $function_name, $option_id, $option_def );		
    }     
    
    /**
     * Update theme option form unit
     *
     * @param string $option_id
     * @param array $option_def Definition of Model and View
     */    
    function btp_update_theme_option_form_unit( $option_id, $option_def ) {
	    if( isset( $option_def['model'] ) && $option_def['model'] !== null ) {
	    	/* Custom update function */
	    	if ( isset($option_def['model']['update_func']) ) {
	    		
	    		/* Determine which view function to call */			
	    		$function_name = 'btp_model_update_func_' . preg_replace( '/[^0-9a-zA-Z_]*/', '', $option_def['model']['update_func'] );    			
	    		
	    		call_user_func( $function_name, $option_id, $option_def );
	    	}
	    	/* Default update process */ 
	    	else {
		    	if ( isset( $_POST[$option_id] ) )
	    			update_option( $option_id, $_POST[$option_id] );
	    		else	
	    			update_option( $option_id, '' );
	    	}	
	    }    	
    }
    
    
    
    
    
    /* Update option unit of type feed */        
    function btp_model_update_func_feed( $option_id, $option_def ) {

    	$val = array();    	
    	$val['is_active'] 	= isset( $_POST[ $option_id.'_is_active' ] ) ? true : false;
    	$val['url'] 		= isset( $_POST[ $option_id.'_url' ] ) ? $_POST[ $option_id.'_url' ] : '';
    	$val['label']		= isset( $_POST[ $option_id.'_label' ] ) ? $_POST[ $option_id.'_label' ] : '';
    	$val['caption']		= isset( $_POST[ $option_id.'_caption' ] ) ? $_POST[ $option_id.'_caption' ] : ''; 

    	update_option( $option_id, $val );
    } 
    
    
    
    
    
    
    
    /**
	 * Render post options (meta box).
	 * 
	 * @param $post
	 * @param array $metabox
	 */
	function btp_render_meta_box( $post, $metabox ) {
		global $post;
		
		// Generate nonce number
	    echo '<input type="hidden" name="' . esc_attr( $metabox['id'].'_nonce' ) . '" value="' . wp_create_nonce( $metabox['id'] ) . '" />';
	
	    echo '<table class="form-table btp-meta-box">';
	    foreach ( $metabox['args']['options'] as $option_id => $option_def ) {
	        // get current post meta data
	        $option_val = get_post_meta( $post->ID, $option_id, true );
	        
	        btp_render_post_option_form_unit( $option_id, $option_def, $option_val );
		}
		echo '</table>';    
	}	
	
	/**
	 * Save post options (from meta box).
	 * 
	 * @param int $post_ID
	 * @param array $metabox
	 */
	function btp_save_meta_box( $post_id, $metabox ) {
	    if ( !isset( $_POST['post_type'] ) || $metabox['post_type'] != $_POST['post_type'] )		    
	    	return $post_id;
	    	
	    /* Don't save data when using Quick Edit */	
	    if ( isset( $_POST['_inline_edit'] ) )		    
	    	return $post_id;	
	    
		/* Don't save data automatically via autosave feature */
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
	        return $post_id;	    
	        	
	    /* Verify nonce number */
		if ( !wp_verify_nonce( $_POST[$metabox['id'].'_nonce'], $metabox['id'] ) )
	        return $post_id;
	    	
	    /* Check permissions */
	    if ('page' == $_POST['post_type']) {
	       if (!current_user_can('edit_page', $post_id)) {
	            return $post_id;
	        }
	    } elseif (!current_user_can('edit_post', $post_id)) {
	        return $post_id;
	    }
	    
	    /* Save data */
		foreach ( $metabox['options'] as $option_id => $option_def ) {
	        btp_update_post_option_form_unit( $post_id, $option_id, $option_def );
	    }
	}
	
	/**
     * Render post option form unit
     * 
     * @param string $option_id
     * @param array $option_def Definition of Model and View
     * @param mixed $option_val
     */     
    function btp_render_post_option_form_unit( $option_id, $option_def, $option_val = null ) {
    	// Determine which view function to call			
    	$function_name = 'btp_view_render_func_' . preg_replace( '/[^0-9a-zA-Z_]*/', '', $option_def['view']['render_func'] );
    	
    	if ( $option_def['model'] !== null ) 
			call_user_func( $function_name, $option_id, $option_def, $option_val );			    		
		else		
			call_user_func( $function_name, $option_id, $option_def );
    }

    
    /**
     * Update post option form unit
     *
     * @param string $option_id
     * @param array $option_def Definition of Model and View
     */    
    function btp_update_post_option_form_unit( $post_id, $option_id, $option_def ) {
    	if( isset( $option_def['model'] ) ) {
	    	if ( isset( $_POST[$option_id] ) )
    			update_post_meta( $post_id, $option_id, $_POST[$option_id] );
    		else	
    			update_post_meta( $post_id, $option_id, '' );
    	}
    }
	
	
    
    /**
	 * Render term_taxonomy options panel in addtag|edittag form.
	 * 
	 * @param $term
	 * @param $panel
	 */
	function btp_render_tt_options_panel( $term, $panel ) {
		$nonce = false;
		
		foreach ( $panel['args']['options'] as $option_name => $option_def ) 
		{ ?>
		<tr class="form-field">
			<td colspan="2">
			<?php
				if ( $nonce === false ) {
					// Generate nonce number
					echo '<input type="hidden" name="' . esc_attr( $panel['id'] ) . '_nonce" value="' . wp_create_nonce( $panel['id'] ) . '" />';
					$nonce = true;
				}
			
		    	$option_val = btp_get_tt_option( $term->term_taxonomy_id, $option_name );
		    	btp_render_tt_option_form_unit( $term->term_taxonomy_id, $option_name, $option_def, $option_val );		    	
		    ?>	    
		    </td>	    
		</tr>    
		<?php   
		}	
	}
	
    /**
	 * Save term_taxonomy options set in addtag|edittag form.
	 * 
	 * @param int $term_id
	 * @param array $panel
	 */
	function btp_save_tt_options_panel( $tt_id, $panel ) {
		
	    if ( !isset( $_POST['taxonomy'] ) || $panel['taxonomy'] != $_POST['taxonomy'] )		    
	    	return;

	    /* Save only when edittag form has been submitted */	
	    if ( !isset( $_POST['action'] ) || $_POST['action'] != 'editedtag' )
	    	return;
	    
	    /* Don't save data when using Quick Edit */	
	    if ( isset( $_POST['_inline_edit'] ) )		    
	    	return;		
	    	
	    /* Verify nonce number */
		if ( !wp_verify_nonce( $_POST[$panel['id'] . '_nonce'], $panel['id'] ) ) {
	        return;
	    }
	
	    /* Check permissions */
	    $tax = get_taxonomy( $panel['taxonomy'] );
		if ( !current_user_can( $tax->cap->edit_terms ) )
			wp_die( __( 'Cheatin&#8217; uh?' ) );
	    
		foreach ( $panel['args']['options'] as $option_name => $option_def ) {
	        btp_update_tt_option_form_unit( $tt_id, $option_name, $option_def );
	    }
	}
	
    /**
	 * Render term_taxonomy option form unit. 
	 * 
	 * @param int $term_id
	 * @param int $option_name
	 * @param array $option_def Definition of Model and View
	 * @param mixed $option_val
	 */	 	 
    function btp_render_tt_option_form_unit( $term_id, $option_name, $option_def, $option_val = null ) {
    	global $btp_theme_slug;    	
    	
    	$option_id = $btp_theme_slug . '_tt_' . intval( $term_id ) . '_' . $option_name;
    	
    	// Determine which view function to call			
    	$function_name = 'btp_view_render_func_' . preg_replace( '/[^0-9a-zA-Z_]*/', '', $option_def['view']['render_func'] );
    	
    	if ( $option_def['model'] !== null )
			call_user_func( $function_name, $option_id, $option_def, $option_val );
		else		
			call_user_func( $function_name, $option_id, $option_def );
    }
    
     /**
     * Update term_taxonomy option form unit
     *
     * @param string $option_id
     * @param array $option_def Definition of Model and View
     */    
    function btp_update_tt_option_form_unit( $term_id, $option_name, $option_def ) {
    	global $btp_theme_slug;
    	
    	if ( isset( $option_def['model'] ) ) {
    		$option_id = $btp_theme_slug . '_tt_' . intval( $term_id ) . '_' . $option_name;
    		
	    	if ( isset( $_POST[$option_id] ) )
    			update_option( $option_id, $_POST[$option_id] );
    		else	
    			update_option( $option_id, '' );
    	}
    }
?>