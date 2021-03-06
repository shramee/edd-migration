<?php
	if ( ! function_exists( '__fs' ) ) {
		// Load essentials.
		require_once __DIR__ . '/includes/fs-essential-functions.php';
	}

	// Load config file.
	require_once __DIR__ . '/config.php';

	if (!class_exists('FS_Logger')) {
		require_once WP_FSM__DIR_INCLUDES . '/class-fs-logger.php';
	}

	if (!function_exists('fs_request_is_action')) {
		require_once WP_FSM__DIR_INCLUDES . '/fs-core-functions.php';
	}

//	require_once WP_FSM__DIR_INCLUDES . '/debug/debug-bar-start.php';

	// Register entities auto loader.
	spl_autoload_register( function ( $class ) {
		$class = trim( $class, '\\' );

		$fs_class = ( strpos( $class, 'FS_' ) === 0 );

		if ( ! $fs_class ) {
			// Not Freemius class.
			return;
		}

		$file = WP_FSM__DIR_ENTITIES . '/class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';
		if ( file_exists( $file ) ) {
			require_once $file;
		}
	} );

	require_once WP_FSM__DIR_INCLUDES . '/i18n.php';

	global $fsm_text;

	fs_override_i18n( $fsm_text );