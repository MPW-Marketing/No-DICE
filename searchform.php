<form method="get" id="searchform" action="<?php echo home_url(); ?>">
    <fieldset>
        <input type="text" value="" name="s" id="s" size="15" title="<?php esc_attr( _e('Search...', 'btp_theme') ); ?>" />        
        <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/submit-search.png" value="Search" id="searchsubmit" />
    </fieldset>
</form>