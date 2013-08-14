<?php
/*
 Plugin Name: Menu
 Description: Easy to use menu system that allows for modifications of the main menu including linking to internal posts, pages, categories as well as external sites.
 Author: Shane & Peter, Inc.
 Version: 1.0
 Author URI: http://www.shaneandpeter.com
 Site Wide Only: true
 */

if( !class_exists( 'Menu' ) ) {
	class Menu {

		private $cached = null;
		private $settings = null;
		private $_option_Name = 'menu';
		private $_option_Cache = 'menu-cache';

		public function __construct() {
			$this->addActions();
			$this->addFilters();
		}

		private function addActions() {
			add_action( 'admin_init', array( $this, 'processSubmission' ) );
			add_action( 'admin_menu', array( $this, 'addAdministrativeItems' ) );
		}

		private function addFilters() {

		}

		/// CALLBACKS

		public function addAdministrativeItems() {
			add_theme_page(__('Custom Menu'),__('Custom Menu'),'switch_themes','menu',array($this,'displaySettingsPage'));

			global $pagenow;
			if( 'themes.php' == $pagenow && 'menu' == $_GET['page'] ) {
				wp_enqueue_script('menu',plugins_url('resources/menu.js',__FILE__),array('jquery-ui-sortable'));
				wp_enqueue_style('menu',plugins_url('resources/menu.css',__FILE__));
			}
		}

		public function processSubmission() {
			if( isset( $_POST['save-menu'] ) && check_admin_referer( 'save-menu' ) ) {
				$stripped = stripslashes_deep($_POST['menu']);
				$items = array();
				for($i = 0; $i < count($stripped['label']); $i++) {
					if(!empty($stripped['label'][$i])) { // Just checking the label to allow for home page links
						$items[] = array( 'label' => $stripped['label'][$i], 'url' => $stripped['url'][$i], 'class' => $stripped['class'][$i] );
					}
				}
				$this->saveSettings($items);
				wp_redirect( admin_url('themes.php?page=menu&updated=1' ) );
			}
		}

		/// UTILITY

		private function getSettings() {
			if( null === $this->settings ) {
				$this->settings = get_option( $this->_option_Name, array() );
			}
			return $this->settings;
		}

		private function saveSettings($settings) {
			if( is_array( $settings ) ) {
				$this->settings = $settings;
				update_option( $this->_option_Name, $this->settings );
			}
		}

		/// DISPLAY

		public function displaySettingsPage() {
			include('views/settings.php');
		}

		/// RENDERING UTILITY

		public function renderMenu($options = array()) {
			$options = shortcode_atts(array('ul_id'=>'menu','ul_class'=>'menu'), $options);
			$items = $this->getSettings();

			extract($options);
				
			$items = (array)$this->getSettings();
			$output = '';
			for($i = 0; $i < count($items); $i++) {
				$item = $items[$i];
				$output .= $this->renderMenuItem($item,$i);
			}
			if( !empty( $output ) ) {
				$output = "<ul id='{$ul_id}' class='{$ul_class}'>{$output}</ul>";
			}

			return $output;
		}
		
		public function hasMenuItems() {
			return count((array)$this->getSettings());
		}

		private function renderMenuItem($item,$count = 99) {
			$class = $this->getItemClass($item,$count);
			$output = '<li class="' . $class . '"><a class="' . $class . '" href="' . $this->getItemUrl($item) . '">' . esc_html($item['label']) . '</a></li>';
			return $output;
		}

		private function getItemClass($item,$count = 99) {
			$classes = array();
			$classes[] = $item['class'];
			$classes[] = "menu-{$count}";
			if(false === strpos($item['url'],'/')) {
				$classes[] = "menu-{$item['url']}";
			} else {
				$classes[] = 'menu-' . sanitize_title_with_dashes($item['label']);
			}
			global $wp;				
			if (is_home() && trailingslashit($wp->request) == trailingslashit($item['url'])) {
				$classes[] = 'current-cat';
			} elseif(is_category() && ($category = get_category_by_slug( $item['url'] ) ) && is_category(array($category->term_id)) ) {
				$classes[] = 'current-cat';
			} elseif(($page = $this->getPageBySlug($item['url'])) && is_page($page->ID)) {
				$classes[] = 'current-cat';
			}

			return implode(' ', $classes);
		}

		private function getPageBySlug($slug) {
			if(empty($slug)) {
				return false;
			}
			$pages = get_posts(array('post_type'=>'page','post_status'=>'publish','name'=>$slug));
			
			if(count($pages) > 0) {
				return $pages[0];
			}
			return false;
		}

		private function getItemUrl($item) {
			if( 0 === strpos($item['url'],'http') ) {
				return $item['url'];
			} elseif( false !== strpos($item['url'],'/')) {
				return site_url($item['url']);
			} elseif( ($category = get_category_by_slug($item['url'])) ) {
				return get_category_link($category->term_id);
			} elseif( ($page = $this->getPageBySlug($item['url']) ) ) {
				return get_page_link($page->ID);
			} else {
				return site_url($item['url']);
			}
		}

		private function getItemId($item) {
			return 'menu-item-' . sanitize_title_with_dashes($item['label']);
		}
	}

	global $Menu;
	$Menu = new Menu();
	include('lib/template-tags.php');
}