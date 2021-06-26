<form role="search" method="get" class="c-search-form search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<label class="c-search-form__label">
		<span class="screen-reader-text"><?php esc_html_e('Search for:' , 'wp-notes'); ?></span>
		<input type="search" class="c-search-form__label__field search-field" placeholder="<?php esc_attr_e('Search …', 'wp-notes') ?>" value="<?php echo get_search_query(); ?>" name="s">
	</label>
	<button aria-label="<?php esc_attr_e('Submit', 'wp-notes'); ?>" class="c-search-form__submit js-search-form-btn" type="submit">
		<svg class="c-search-form__submit__icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256"><path d="M229.651 218.344l-43.222-43.223a92.112 92.112 0 1 0-11.315 11.314l43.223 43.223a8 8 0 1 0 11.314-11.314zM40 116a76 76 0 1 1 76 76a76.086 76.086 0 0 1-76-76z" /></svg>
	</button>
</form>
