<?php
/**
 * @file polymorphism_namespace_autoloading.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4.0 / ChatGPT 3.5
 *
 * PHP script demonstrating polymorphism, namespaces, and autoloading.
 */

echo "---------------------------" . PHP_EOL;
echo "### Lesson 5: Polymorphism, Namespace, and Autoloading" . PHP_EOL;

// Autoloading
spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name); // Convert namespace to file path
    $file_path = __DIR__ . '/' . $class_name . '.php'; // Build full file path

    if (file_exists($file_path)) {
        require_once $file_path; // Include the file if it exists
    } else {
        die("The file $file_path could not be found."); // Handle error if file doesn't exist
    }
});

use Fruits\Eat; // Import the Eat interface
use Fruits\TropicalFruit; // Use the correct namespace

$mango = new TropicalFruit("mango", "🥭", 60, true);
$pineapple = new TropicalFruit("pineapple", "🍍", 100, true);
$coconut = new TropicalFruit("coconut", "🥥", 150, true);

// Polymorphism: Using the Eat interface
function describeFruit(Eat $fruit) {
    $fruit->eat();
}

$fruits = array($mango, $pineapple, $coconut);

foreach ($fruits as $fruit) {
    describeFruit($fruit);
}

echo "---------------------------" . PHP_EOL;

/**
 * Summary of Concepts Introduced:
 * 
 * 1. **Polymorphism**: Using the `Eat` interface to treat different classes uniformly.
 * 2. **Namespace**: Organizing code into namespaces to avoid naming conflicts.
 * 3. **Autoloading**: Implementing autoloading to automatically load classes.
 */
?>

