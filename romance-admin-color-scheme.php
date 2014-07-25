<?php
/*
Plugin Name: Romance Admin Color Scheme
Plugin URI: http://increasy.com
Description: A custom admin color scheme that will make your heart skip a beat.
Author: Kumar Abhisek
Author URI: http://increasy.com
Version:1.0
License: GPLv2

 Copyright 2014 Kumar Abhisek (email:meabhi[at]outlook dot com)
 
 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License version 2,
 as published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 GNU General Public License for more details.
 
 The license for this software can likely be found here:
 http://www.gnu.org/licenses/gpl-2.0.html

*/

class romance_Admin_Color_Scheme {

	function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'load_default_css') );
		add_action( 'admin_init', array( $this, 'add_color_scheme') );
	}

	/**
	 * Register the custom admin color scheme
	 *
	 * @TODO Implement RTL stylesheets
	 * @TODO Implement Icon colors
	 */
	function add_color_scheme() {
		wp_admin_css_color(
			'romance',
			__( 'Romance', 'romance-color-scheme' ),
			plugins_url( 'romance.css', __FILE__ ),
			array( '#ffa1cd', '#d60490', '#ff00a2', '#d60490' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);
	}

	/**
	 * Make sure core's default `colors.css` gets enqueued, since we can't
	 * @import it from a plugin stylesheet. Also force-load the default colors
	 * on the profile screens, so the JS preview isn't broken-looking.
	 *
	 * Copied from Admin Color Schemes - http://wordpress.org/plugins/admin-color-schemes/
	 */
	function load_default_css() {

		global $wp_styles;

		$color_scheme = get_user_option( 'admin_color' );

		if ( 'romance' === $color_scheme || in_array( get_current_screen()->base, array( 'profile', 'profile-network' ) ) ) {
			$wp_styles->registered[ 'colors' ]->deps[] = 'colors-fresh';
		}

	}
}

new romance_Admin_Color_Scheme();