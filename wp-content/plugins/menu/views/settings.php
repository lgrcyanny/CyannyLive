<?php if( $_GET['updated'] == 1 ) { ?>
<div class="updated" id="menu-updated">
	<p><?php _e( 'Menu Items Updated!' ); ?></p>
</div>
<?php } ?>
<div class="wrap">
	<h2><?php _e( 'Custom Menu' ); ?></h2>
	<p>
	<?php _e('To replace the default menu with a custom menu, add menu buttons using the form below. Here are some things to note.'); ?>
	</p>
	<ol>
		<li><?php printf(__( 'If you leave the URL blank, the resulting menu button will link to the site home url: <a href="%s">%s</a>' ), get_bloginfo('url'), get_bloginfo('url')); ?></li>
		<li><?php printf(__( 'If the CSS class is not filled in, it is automatically generated based on the link title.'  )); ?></li>
		<li><?php printf(__( 'You may enter a "slug" in the url field if you\'d like it to point to an internal Category, Page, or Post. Example: enter "events" for a link that points to the Events category.'  )); ?></li>
		<li><?php printf(__( 'You may enter complete URLs if you wish to link to an external site. A complete URL should always start with "http://". Example: http://blackplanet.com.'  )); ?></li>
		<li><?php printf(__( 'There is a limited amount of space in the header. Please be careful to keep link names short and not make too many menu items.'  )); ?></li>
		<li><?php printf(__( 'Check your work on the <a href="%s">live site</a>' ), get_bloginfo('url')); ?></li>
	</ol>

	<?php 
	$items = $this->getSettings();
	if( empty($items) ) {
		$items = array(array());
	}
	?>
	<form method="post">
		<table class="form-table">
			<tbody id="menu-items">
				<?php foreach($items as $item) { ?>
				<tr class="menu-item">
					<th scope="row">
						<span class="drag-handle"><?php _e( 'Menu Item' ); ?></span>
						<a href="#remove-item" class="remove"><small><?php _e( 'Remove' ); ?></small></a>
						<a href="#remove-item" class="add"><small><?php _e( 'Add Another' ); ?></small></a>
					</th>
					<td>
						<label><span><?php _e( 'Label' ); ?></span> <input type="text" class="regular-text" name="menu[label][]" value="<?php echo esc_attr($item['label']); ?>" /></label>
						<label><span><?php _e( 'URL' ); ?></span> <input type="text" class="regular-text" name="menu[url][]" value="<?php echo esc_attr($item['url']); ?>" /></label>
						<label><span><?php _e( 'CSS Class' ); ?></span> <input type="text" class="regular-text" name="menu[class][]" value="<?php echo esc_attr($item['class']); ?>" /></label>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<p class="submit">
			<?php wp_nonce_field( 'save-menu' ); ?>
			<input type="submit" name="save-menu" id="save-menu" class="button-primary" value="<?php _e( 'Save' ); ?>" />
		</p>
	</form>
</div>