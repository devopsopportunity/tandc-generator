<?php
/**
 * @file third_lesson.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4.0 / ChatGPT 3.5
 *
 * PHP script demonstrating basic concepts, arrays, loops, associative arrays, objects, and advanced array usage with objects.
 */

// Lesson 1: Basic Concepts

// Function that greets a user
function greet($name) {
    echo "Hello, $name! 😊" . PHP_EOL;
}

// Call the greet function to greet Edoardo
greet("Edoardo");

// Variable declarations
$name = "Edoardo"; // A string variable
$age = 50;
echo "My name is $name and I am $age years old." . PHP_EOL;

// Conditional structure to determine message based on age
if ($age < 18) {
    echo "You are underaged." . PHP_EOL;
} elseif ($age >= 18 && $age < 65) {
    echo "You are an adult but not yet of retirement age." . PHP_EOL;
} else {
    echo "You are of retirement age." . PHP_EOL;
}

// Call greet function again to greet Edoardo
greet("Edoardo");

echo "---------------------------" . PHP_EOL;

// Lesson 2: Arrays and Loops

// Define an array of fruits
$fruits = array("apple 🍎", "banana 🍌", "orange 🍊", "pear 🍐", "kiwi 🥝");

// Define a function that prints fruits
function allFruits() {
    global $fruits; // Make the $fruits variable visible inside the function
    foreach ($fruits as $fruit) {
        echo "Fruit: $fruit" . PHP_EOL;
    }
}

// Call the allFruits function
allFruits();

echo "The first fruit is " . $fruits[0] . "." . PHP_EOL;

echo "Associative array:" . PHP_EOL;

// Associative array
$person = array(
    "name" => "Edoardo",
    "age" => 50,
    "city" => "Milan"
);

// Access and print values from the associative array
echo "The name is " . $person["name"] . " and they are " . $person["age"] . " years old." . PHP_EOL;

echo "Example of a for loop:" . PHP_EOL;

// Example of a for loop
for ($i = 0; $i < 5; $i++) {
    echo "Number: $i" . PHP_EOL;
}

echo "---------------------------" . PHP_EOL;

// Lesson 3: Associative Arrays and Objects

// Class Person
class Person {
    public $name;
    public $age;
    public $city;

    public function __construct($name, $age, $city) {
        $this->name = $name;
        $this->age = $age;
        $this->city = $city;
    }

    public function introduce() {
        echo "Hello, I'm $this->name, I'm $this->age years old, and I live in $this->city." . PHP_EOL;
    }
}

// Create an instance of the Person class
$person = new Person("Edoardo", 50, "Milan");
$person->introduce();

echo "---------------------------" . PHP_EOL;

// Associative array with objects
$people = array(
    new Person("Edoardo", 50, "Milan"),
    new Person("Maria", 30, "Rome"),
    new Person("Luca", 25, "Naples")
);

// Use a for loop to iterate over the associative array with objects
foreach ($people as $person) {
    $person->introduce();
}

/*
### What we've introduced:
1. **Basic Concepts**: Reviewed functions, variables, and conditional structures.
2. **Arrays and Loops**: Demonstrated simple arrays, associative arrays, `foreach` and `for` loops.
3. **Associative Arrays and Objects**: Reviewed previous lessons and introduced associative arrays, object creation and usage, and `for` loops with associative arrays.
*/
?>

