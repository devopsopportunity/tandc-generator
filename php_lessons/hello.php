<?php
/**
 * @file hello.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4.0 / ChatGPT 3.5
 *
 * PHP script demonstrating basic concepts such as functions, variables, output, and conditionals.
 */

// Define a function that greets a user
function greet($name) {
    echo "Hello, $name! 😊" . PHP_EOL; // Greets the user with an emoji
}

// Call the function to greet Edoardo
greet("Edoardo");

// Variable declaration
$name = "Edoardo"; // A string variable
$age = 50; // An integer variable

// Print the name and age
echo "My name is $name and I am $age years old." . PHP_EOL;

// Conditional structure to determine the message based on age
if ($age < 18) {
    echo "You are underage." . PHP_EOL;
} elseif ($age >= 18 && $age < 65) {
    echo "You are of legal age but have not yet reached retirement age." . PHP_EOL;
} else {
    echo "You are at retirement age." . PHP_EOL;
}

// Call the greet function again to greet Edoardo
greet("Edoardo");

/**
 * Summary of Concepts Covered:
 *
 * 1. Functions:
 *    - Definition: The `greet` function takes a `$name` parameter and prints a greeting message.
 *    - Invocation: The function is called with the argument "Edoardo".
 *
 * 2. Variables:
 *    - Declaration: We declared the variables `$name` and `$age`.
 *    - Usage: The variables are used within a string to print a message.
 *
 * 3. Output:
 *    - `echo`: Used to print text to the screen.
 *    - `PHP_EOL`: Constant representing a new line, independent of the operating system.
 *
 * 4. Conditional Structures:
 *    - `if`, `elseif`, `else`: Used to execute different code blocks based on the value of `$age`.
 *
 * 5. Function Reuse:
 *    - Reuse: The `greet` function is called again to demonstrate how functions can be reused.
 */
?>

