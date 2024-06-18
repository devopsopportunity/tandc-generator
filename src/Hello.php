<?php
/**
 * @file Hello.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4o / ChatGPT 3.5
 *
 * Defines the Hello class which represents a greeting message.
 */

namespace App;

/**
 * Represents a greeting message.
 */
final class Hello
{
    private string $name;

    /**
     * Constructor.
     *
     * @param string $name The name to include in the greeting.
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Creates a Hello instance from a string.
     *
     * @param string $name The name to include in the greeting.
     * @return self The created Hello instance.
     */
    public static function fromString(string $name): self
    {
        return new self($name);
    }

    /**
     * Returns the name as a string.
     *
     * @return string The name.
     */
    public function asString(): string
    {
        return $this->name;
    }
    
    /**
     * Generates a greeting message.
     *
     * @return string The greeting message.
     */
    public function greet(): string
    {
        return "Hello, $this->name!";
    }
}
?>

