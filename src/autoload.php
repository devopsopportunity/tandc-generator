<?php
/**
 * @file autoload.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4o / ChatGPT 3.5
 *
 * Implements an autoloading function to automatically load project classes
 * using the PSR-4 standard for namespace management.
 */

// Namespace prefix for the application
$prefix = 'App\\';

// Base directory where classes are stored (classes directory)
$base_dir = __DIR__ . '/';

// Register the autoloader function
spl_autoload_register(function ($class) use ($prefix, $base_dir) {
    // Remove the namespace prefix and convert it to file system path
    $relative_class = substr($class, strlen($prefix));
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
?>

