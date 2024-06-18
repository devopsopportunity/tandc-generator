<?php
/**
 * @file true_polymorphism.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4.0 / ChatGPT 3.5
 *
 * PHP script demonstrating polymorphism, namespaces, and autoloading.
 */

echo "---------------------------" . PHP_EOL;
echo "### Exercise 5: Polymorphism, Namespace, and Autoloading" . PHP_EOL;

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

use Fruits\TropicalFruit; // Use the correct namespace
use Fruits\Eat; // Import the Eat interface

// Inheritance: NewZealandFruit class extending TropicalFruit
class NewZealandFruit extends TropicalFruit {

    public $newZealand;

    /**
     * Constructor for NewZealandFruit.
     *
     * @param string $name The name of the fruit.
     * @param string $emoji The emoji representing the fruit.
     * @param int $weight The weight of the fruit in grams.
     * @param bool $isTropical Indicates whether the fruit is tropical or not.
     * @param bool $newZealand Indicates whether the fruit is from New Zealand.
     */
    public function __construct($name, $emoji, $weight, $isTropical, $newZealand) {
        parent::__construct($name, $emoji, $weight, $isTropical);
        $this->newZealand = $newZealand;
    }

    /**
     * Check if the fruit is from New Zealand.
     *
     * @return string A message indicating whether the fruit is from New Zealand or not.
     */
    public function isFromNewZealand() {
        return $this->newZealand ? "Yes, I am a tropical fruit from New Zealand!" : "No, I am not a tropical fruit from New Zealand.";
    }

    /**
     * Override the getFruit method to include origin information.
     */
    public function getFruit() {
        parent::getFruit();
        echo $this->isFromNewZealand() . PHP_EOL;
    }
    
    /**
     * Override the eat method to customize behavior based on origin.
     */
    public function eat() {
        if ($this->newZealand) {
            echo "Eat {$this->name} from New Zealand {$this->emoji}, it's delicious!" . PHP_EOL;
        } else {
            parent::eat(); // Fallback to parent method if not from New Zealand
            echo "But it does not come from New Zealand!" . PHP_EOL;
        }
    }
}

// Instances of TropicalFruit
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

// Instances of NewZealandFruit
$kiwi = new NewZealandFruit("kiwi", "🥝", 40, true, true);
$pear = new NewZealandFruit("pear", "🍐", 70, true, false);

// Test:
$kiwi->getFruit();
describeFruit($kiwi);
echo "---------------------------" . PHP_EOL;

// The pear, not being a fruit from New Zealand, uses the fallback logic in the eat() method,
// displaying both the generic message and the specific message when the fruit is not from New Zealand.
$pear->getFruit();
describeFruit($pear);
?>

