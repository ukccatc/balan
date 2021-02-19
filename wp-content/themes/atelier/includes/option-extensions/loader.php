<?php

// You may replace {$redux_opt_name} with a string if you wish. 
// Make sure {$redux_opt_name} is defined.

if(!function_exists('atelier_redux_register_custom_extension_loader')) :
	function atelier_redux_register_custom_extension_loader($ReduxFramework) {
		$path = get_template_directory() . '/includes/option-extensions/extensions/';
		$folders = scandir( $path, 1 );		   
		foreach($folders as $folder) {
			if ($folder === '.' or $folder === '..' or !is_dir($path . $folder) ) {
				continue;	
			} 
			$extension_class = 'ReduxFramework_Extension_' . $folder;
			if( !class_exists( $extension_class ) ) {
				// In case you wanted override your override, hah.
				$class_file = $path . $folder . '/extension_' . $folder . '.php';
				$class_file = apply_filters( 'redux/extension/'.$ReduxFramework->args['opt_name'].'/'.$folder, $class_file );
				if( $class_file ) {
					require_once( $class_file );
					$extension = new $extension_class( $ReduxFramework );
				}
			}
		}
	}
	// Modify redux_demo to match your opt_name
	add_action("redux/extensions/sf_atelier_options/before", 'atelier_redux_register_custom_extension_loader', 0);
endif;