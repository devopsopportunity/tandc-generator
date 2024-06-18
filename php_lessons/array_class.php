<?php
/**
 * @file array_class.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4.0 / ChatGPT 3.5
 *
 * PHP script demonstrating advanced class methods using associative arrays with objects.
 */

// Concepts
echo "---------------------------" . PHP_EOL;
echo "### Lesson 3: Classes, Objects, and Advanced Methods" . PHP_EOL;

/**
 * Class Fruit
 *
 * Represents a basic fruit with properties and methods.
 */
class Fruit {
    /** @var string The name of the fruit. */
    public $name;
    
    /** @var string The emoji representation of the fruit. */
    public $emoji;
    
    /** @var int The weight of the fruit in grams. */
    public $weight;

    /**
     * Constructor for Fruit class.
     *
     * @param string $name The name of the fruit.
     * @param string $emoji The emoji representation of the fruit.
     * @param int $weight The weight of the fruit in grams.
     */
    public function __construct($name, $emoji, $weight) {
        $this->name = $name;
        $this->emoji = $emoji;
        $this->weight = $weight;
    }

    /**
     * Prints a description of the fruit.
     */
    public function getFruit() {
        echo "Hello, I'm $this->name $this->emoji and I weigh $this->weight grams!" . PHP_EOL;
    }

    /**
     * Finds the lightest fruit from an array of fruits.
     *
     * @param array $fruits Array of Fruit objects.
     * @return Fruit The lightest fruit object.
     */
    public static function lightestFruit($fruits) {
        $lightest = $fruits[0];
        foreach ($fruits as $fruit) {
            if ($fruit->weight < $lightest->weight) {
                $lightest = $fruit;
            }
        }
        return $lightest;
    }
}

// Associative array with objects
$fruits = array(
    new Fruit("apple", "🍎", 50),
    new Fruit("banana", "🍌", 30),
    new Fruit("orange", "🍊", 25),
    new Fruit("pear", "🍐", 10),
    new Fruit("kiwi", "🥝", 40)
);

// A single fruit
$fruit = new Fruit("apple", "🍎", 50);
$fruit->getFruit();

// Define a function that prints all fruits
function allFruits() {
    global $fruits; // Makes the $fruits variable visible inside the function
    // Use a for loop to iterate over the associative array with objects
    for ($i = 0; $i < count($fruits); $i++) {
        $fruits[$i]->getFruit();
    }
}

echo "---------------------------" . PHP_EOL;
allFruits();

// Using a static method
echo "---------------------------" . PHP_EOL;
echo "The lightest fruit is: " . PHP_EOL;
Fruit::lightestFruit($fruits)->getFruit();
echo "we used: Fruit::lightestFruit(\$fruits)->getFruit();" . PHP_EOL;

/*
### What we've introduced:
1. **Classes and Objects**: We created a `Fruit` class with attributes and methods.
2. **Static Methods**: We introduced a static method `lightestFruit` to find the fruit with the least weight.
3. **Advanced Array Usage**: We worked with arrays of objects and iterated over them using `for` loops.
*/
?>

