	<div id="sidebar" class="grid_5">
		<ul class="nobullet">
			<li>
				<?php get_search_form(); ?>
			</li>
				
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			
			<?php if ( is_404() || is_category() || is_day() || is_month() ||
						is_year() || is_search() || is_paged() ) {
			?>

			<li><h2>Archives</h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

			<?php wp_list_categories('title_li=<h2>Categories</h2>'); ?>

			<?php } ?>
			<?php endif; ?>
		</ul>
	</div>

