<?php
/**
 * @file TropicalFruit.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4.0 / ChatGPT 3.5
 *
 * PHP script defining the TropicalFruit class and the Eat interface.
 */

namespace Fruits;

/**
 * Interface Eat
 *
 * Represents the action of eating.
 */
interface Eat {
    /**
     * Method declaration for the eating action.
     */
    public function eat();
}

/**
 * Class TropicalFruit
 *
 * Represents a tropical fruit that implements the Eat interface.
 */
class TropicalFruit implements Eat {
    /** @var string The name of the fruit. */
    public $name;

    /** @var string The emoji representing the fruit. */
    public $emoji;

    /** @var int The weight of the fruit in grams. */
    public $weight;

    /** @var bool Indicates whether the fruit is tropical or not. */
    public $isTropical;

    /**
     * Constructor for TropicalFruit.
     *
     * @param string $name The name of the fruit.
     * @param string $emoji The emoji representing the fruit.
     * @param int $weight The weight of the fruit in grams.
     * @param bool $isTropical Indicates whether the fruit is tropical or not.
     */
    public function __construct($name, $emoji, $weight, $isTropical) {
        $this->name = $name;
        $this->emoji = $emoji;
        $this->weight = $weight;
        $this->isTropical = $isTropical;
    }

    /**
     * Get the name and emoji of the fruit.
     */
    public function getFruit() {
        echo "Hello, I'm {$this->name} {$this->emoji} and weigh {$this->weight} grams!" . PHP_EOL;
    }

    /**
     * Check if the fruit is tropical.
     *
     * @return string A message indicating whether the fruit is tropical or not.
     */
    public function isTropical() {
        return $this->isTropical ? "Yes, I am a tropical fruit." : "No, I am not a tropical fruit.";
    }

    /**
     * Perform the eating action.
     */
    public function eat() {
        echo "Eat {$this->name} {$this->emoji}, it's delicious!" . PHP_EOL;
    }
}
?>

