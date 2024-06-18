<?php
/**
 * @file array_and_loops.php
 * @date 18-06-2024
 * @author Edoardo Sabatini
 *
 * PHP script demonstrating arrays, functions, global variables, associative arrays, and `for` loops in PHP.
 */

// Define an array of fruits
$fruits = array("apple 🍎", "banana 🍌", "orange 🍊", "pear 🍐", "kiwi 🥝");

/**
 * Prints all fruits in the $fruits array.
 */
function allFruits() {
    global $fruits; // Make the $fruits variable visible inside the function
    foreach ($fruits as $fruit) {
        echo "Fruit: $fruit" . PHP_EOL;
    }    
}

// Call the allFruits function
allFruits();
?>

---------------------------

<?php
echo "The first fruit is " . $fruits[0] . "." . PHP_EOL;
?>

Associative array:
<?php
$person = array("name" => "Edoardo", "age" => 50, "city" => "Milan");
echo "The name is " . $person["name"] . " and they are " . $person["age"] . " years old." . PHP_EOL;
?>

---------------------------

Example of a for loop:
<?php
for ($i = 0; $i < 5; $i++) {
    echo "Number: $i" . PHP_EOL;
}
/**
 * ### Summary of Concepts Covered So Far:
 * 1. **Arrays**: You've learned how to define and use arrays in PHP.
 * 2. **Functions**: Created a function `allFruits` that prints elements of an array.
 * 3. **Global**: Used the `global` keyword to make a variable visible inside a function.
 * 4. **Associative Arrays**: Worked with associative arrays to store structured information.
 * 5. **For Loops**: Implemented a `for` loop to iterate over a range of numbers.
 *
 * ### Next Steps:
 * When you return from your coffee break, we can move on to the third lesson, which will include:
 * - **Classes and Objects**: Creating and using classes and objects in PHP.
 * - **Associative Arrays with Objects**: Using associative arrays with objects.
 * - **For Loop with Objects**: Iterating over an array of objects using a `for` loop.
 */
?>

