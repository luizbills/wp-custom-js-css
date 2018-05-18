<?php
/*
Plugin Name: Custom JS & CSS
Plugin URI: https://github.com/luizbills/wp-custom-asset-codes
Description: Include custom JS & CSS
Version: 1.0.0
Author: Luiz Bills
Author URI: https://luizpb.com/en
License: GPL v2
*/

add_action( 'wp_enqueue_scripts', function () {
	// frontend file list
	$files = [
		'css' => '/assets/frontend/code.css',
		'js' => '/assets/frontend/code.js',
	];

	foreach( $files as $type => $file ) {
		$file_path = __DIR__ . $file;

		// just include file that exists
		if ( ! file_exists( $file_path ) ) continue;

		if ( $type === 'js' ) {
			// js file
			wp_enqueue_script(
				wp_hash( $file_path ), // id
				plugins_url( $file, __FILE__ ), // url
				[ 'jquery' ], // dependencies
				'1.0.0', // version
				true // put this scripts at the bottom of a page?
			);
		} else {
			// css file
			wp_enqueue_style(
				wp_hash( $file_path ), // id
				plugins_url( $file, __FILE__ ), // url
				[], // dependencies
				'1.0.0', // version
				'all' // media attribute
			);
		}
	}
}, 20 );

add_action( 'admin_enqueue_scripts', function () {
	// admin-side file list
	$files = [
		'css' => '/assets/admin/code.css',
		'js' => '/assets/admin/code.js',
	];

	foreach( $files as $type => $file ) {
		$file_path = __DIR__ . $file;

		if ( ! file_exists( $file_path ) ) continue;

		if ( $type === 'js' ) {
			wp_enqueue_script(
				wp_hash( $file_path ),
				plugins_url( $file, __FILE__ ),
				[ 'jquery' ],
				'1.0.0',
				true
			);
		} else {
			wp_enqueue_style(
				wp_hash( $file_path ),
				plugins_url( $file, __FILE__ ),
				[],
				'1.0.0',
				'all'
			);
		}
	}
}, 20 );
