<?php
	$directory = __DIR__ . '/env.php';

	if (file_exists($directory)) {
		include $directory;
	}

	if (!function_exists('env')) {
		function env($key, $default = null) {
			$value = getenv($key);

			if ($value === false) {
				return $default;
			}

			return $value;
		}
	}
?>