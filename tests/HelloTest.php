<?php
/**
 * @file HelloTest.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4o / ChatGPT 3.5
 *
 * PHPUnit test case for the Hello class.
 */

use PHPUnit\Framework\TestCase;
use App\Hello; // Import the namespace of the Hello class

/**
 * PHPUnit test case for the Hello class.
 */
final class HelloTest extends TestCase
{
    /**
     * Tests creating a Hello instance with a specific name.
     *
     * @return void
     */
    public function testName(): void
    {
        $name = 'Edoardo';
        $hello = Hello::fromString($name);
        $this->assertSame($name, $hello->asString());
    }

    /**
     * Tests the greet() method of the Hello class.
     *
     * @return void
     */
    public function testGreet(): void
    {
        $name = 'Edoardo';
        $hello = Hello::fromString($name);
        $this->assertSame("Hello, $name!", $hello->greet());
    }
}
?>

