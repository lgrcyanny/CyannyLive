<?php
/**
 * Menu Template Tag
 *
 * @param array $options list id and classes array('ul_id'=>'menu','ul_class'=>'menu')
 * @return boolean if menu has menu items
 * @author Shane & Peter, Inc. (Peter Chester)
 */
function the_menu($options=array()) {
	global $Menu;
	$output = $Menu->renderMenu($options);
	if( !empty( $output ) ) {
		echo $output;
		return true;
	}
	return false;
}

/**
 * Menu Test Template Tag
 *
 * @return boolean if menu has menu items
 * @author Shane & Peter, Inc. (Peter Chester)
 */
function has_menu() {
	global $Menu;
	return $Menu->hasMenuItems();
}
?>