<?php
/**
 * @file inheritance_interfaces_exceptions.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4.0 / ChatGPT 3.5
 *
 * PHP script demonstrating inheritance, interfaces, and exception handling.
 */

// Concepts
echo "---------------------------" . PHP_EOL;
echo "### Lesson 4: Inheritance, Interfaces, and Exceptions" . PHP_EOL;

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

/**
 * Class TropicalFruit
 *
 * Represents a tropical fruit, extending the Fruit class.
 */
class TropicalFruit extends Fruit {
    /** @var bool Indicates if the fruit is tropical. */
    public $tropical;

    /**
     * Constructor for TropicalFruit class.
     *
     * @param string $name The name of the fruit.
     * @param string $emoji The emoji representation of the fruit.
     * @param int $weight The weight of the fruit in grams.
     * @param bool $tropical Indicates if the fruit is tropical.
     */
    public function __construct($name, $emoji, $weight, $tropical) {
        parent::__construct($name, $emoji, $weight);
        $this->tropical = $tropical;
    }

    /**
     * Checks if the fruit is tropical.
     *
     * @return string A message indicating if the fruit is tropical or not.
     */
    public function isTropical() {
        return $this->tropical ? "Yes, I am a tropical fruit." : "No, I am not a tropical fruit.";
    }

    /**
     * Prints a description of the tropical fruit.
     */
    public function getFruit() {
        parent::getFruit();
        echo $this->isTropical() . PHP_EOL;
    }
}

/**
 * Interface Eat
 *
 * Defines a contract for classes that can be eaten.
 */
interface Eat {
    public function eat();
}

/**
 * Abstract Class Food
 *
 * Represents an abstract class for food items.
 */
abstract class Food {
    /**
     * Abstract method to describe nutrients.
     */
    abstract public function nutrients();
}

/**
 * Class ExoticFruit
 *
 * Represents an exotic fruit that implements Eat and extends TropicalFruit.
 */
class ExoticFruit extends TropicalFruit implements Eat {
    /**
     * Provides information about the nutrients in the fruit.
     */
    public function nutrients() {
        echo "I'm rich in vitamins!" . PHP_EOL;
    }

    /**
     * Allows the fruit to be eaten.
     */
    public function eat() {
        echo "Eat $this->name $this->emoji, it's delicious!" . PHP_EOL;
    }
}

/**
 * Function findFruit
 *
 * Finds a specific fruit from an array of fruits.
 *
 * @param string $name The name of the fruit to find.
 * @param array $fruits Array of Fruit objects.
 * @return Fruit The fruit object found.
 * @throws Exception If the fruit with specified name is not found.
 */
function findFruit($name, $fruits) {
    foreach ($fruits as $fruit) {
        if ($fruit->name == $name) {
            return $fruit;
        }
    }
    throw new Exception("Fruit not found: $name");
}

/**
 * What we've introduced:
 * 1. **Inheritance**: The `TropicalFruit` class extends the `Fruit` class, adding specific attributes and methods.
 * 2. **Interfaces**: The `ExoticFruit` class implements the `Eat` interface.
 * 3. **Abstract Classes**: The `ExoticFruit` class extends the abstract class `Food` and implements the abstract method `nutrients`.
 * 4. **Exception Handling**: We use `try`, `catch`, and `throw` to manage errors.
 */

/* Lesson 4: Inheritance, Interfaces, and Exceptions

#### Concepts
- **Inheritance**: Creating a child class that inherits attributes and methods from a parent class.
- **Interfaces**: Defining methods that must be implemented by a class.
- **Abstract Classes**: Creating classes that cannot be instantiated directly but can be inherited.
- **Exception Handling**: Using `try`, `catch`, and `throw` to manage errors.

### Exercise

1. **Inheritance**: Create a `TropicalFruit` class that extends the `Fruit` class.
2. **Interfaces**: Define an `Eat` interface with an `eat` method.
3. **Abstract Classes**: Create an abstract class `Food` that defines an abstract method `nutrients`.
4. **Exception Handling**: Add exception handling to our code.

### What we've introduced:
1. **Inheritance**: The `TropicalFruit` class extends the `Fruit` class, adding specific attributes and methods.
2. **Interfaces**: The `ExoticFruit` class implements the `Eat` interface.
3. **Abstract Classes**: The `ExoticFruit` class extends the abstract class `Food` and implements the abstract method `nutrients`.
4. **Exception Handling**: We use `try`, `catch`, and `throw` to manage errors.
*/

?>

