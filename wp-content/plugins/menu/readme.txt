=== Menu ===

Contributors: Nick Ohrn produced by Shane & Peter, Inc.
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=10750983
Tags: simple, plugin, template, theme, nav, navigation, menu, buttons
Requires at least: 2.8
Tested up to: 2.9.1
Stable tag: 1.0

== Description ==

Easy to use menu system that allows for modifications of the main menu including linking to internal posts, pages, categories as well as external sites.

= Features =

* Link internally or externally ( Home, Post, Page, Category, External Site )
* CSS class overrides for menu items
* Drag sorting

= Upcoming Features =

* Multi level menus
* UI improvements
* Support multiple menus per site
* Default menu CSS styling

Please visit the forum for feature suggestions: http://wordpress.org/tags/menu/

This plugin is actively supported and we will do our best to help you. In return we simply as 2 things:

1. Donate - if this is generating enough revenue to support our time it makes all the difference in the world.  https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=10750983
1. Rate the plugin. :)

== Installation ==

= Install =

1. Unzip the `menu.zip` file. 
1. Upload the the `menu` folder (not just the files in it!) to your `wp-contents/plugins` folder. If you're using FTP, use 'binary' mode.
1. Activate the plugin.
1. Configure the menu in Appearance > Custom Menu
1. Add the_menu() template tag to your header where you want the menu to appear.
1. You'll need to stylize the menu once it's installed.

= Template Tags =

**the_menu()**

prints the menu unordered list html.

**has_menu()**

returns true if you have any items in your menu.

== Screenshots ==

1. Menu editor screen.

== Frequently Asked Questions ==

= Where do I go to file a bug or ask a question? =

Please visit the forum for questions or comments: http://wordpress.org/tags/menu/

= How do I add the menu to my header? =

After configuring your menu to taste in the admin, add the following code to your header file:

`<?php if (function_exists('has_menu') && has_menu()) { the_menu(); } ?>`

== Changelog ==

= 1.0 =
* Initial Plugin Release

== Upgrade Notice ==

= 1.0 =
This is the initial release of the Menu plugin.