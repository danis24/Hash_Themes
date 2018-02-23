<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_e( 'Search for:', 'hash' ) ?></span>
	</label>
		<input type="search" class="search-field form-control" placeholder="<?php echo esc_html_e( 'Search &hellip;', 'hash' )?>" value="<?php echo get_search_query()?>" name="s" title="<?php echo esc_html_e( 'Search for:', 'hash' )?>" />
	
	<input type="submit" class="search-submit btn btn-default" value="<?php echo esc_html_e( 'Search', 'hash' ) ?>" />
</form>