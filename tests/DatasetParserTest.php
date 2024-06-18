<?php
/**
 * @file DatasetParserTest.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4o / ChatGPT 3.5
 *
 * PHPUnit test case for DatasetParser class functionality.
 */

use PHPUnit\Framework\TestCase;
use App\DatasetParser;

/**
 * PHPUnit test case for DatasetParser class functionality.
 */
final class DatasetParserTest extends TestCase
{
    /**
     * Test valid JSON data parsing.
     *
     * @return void
     */
    public function testValidData(): void
    {
        $jsonString = '
            {
                "clauses": [
                    { "id": 1, "text": "The quick brown fox" },
                    { "id": 2, "text": "jumps over the lazy dog" },
                    { "id": 3, "text": "And dies" },
                    { "id": 4, "text": "The white horse is white" }
                ],
                "sections": [
                    { "id": 1, "clauses_ids": [1, 2] }
                ]
            }
        ';

        try {
            $parsedData = DatasetParser::fromJsonString($jsonString);
        } catch (\InvalidArgumentException $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }

        $this->assertIsArray($parsedData);
        $this->assertArrayHasKey('clauses', $parsedData);
        $this->assertArrayHasKey('sections', $parsedData);

        $expectedJsonString = '
            {
                "clauses": [
                    { "id": 1, "text": "The quick brown fox" },
                    { "id": 2, "text": "jumps over the lazy dog" },
                    { "id": 3, "text": "And dies" },
                    { "id": 4, "text": "The white horse is white" }
                ],
                "sections": [
                    { "id": 1, "clauses_ids": [1, 2] }
                ]
            }
        ';

        $this->assertJsonStringEqualsJsonString($expectedJsonString, json_encode($parsedData));
    }

    /**
     * Test for empty "clauses" array in JSON.
     *
     * @return void
     */
    public function testEmptyClausesJson(): void
    {
        $jsonString = '
            {
                "clauses": [],
                "sections": [
                    { "id": 1, "clauses_ids": [1, 2] }
                ]
            }
        ';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The "clauses" attribute is empty in the JSON.');

        DatasetParser::fromJsonString($jsonString);
    }

    /**
     * Test for invalid "clauses" attribute (not an array).
     *
     * @return void
     */
    public function testInvalidClausesData(): void
    {
        $jsonString = '
            {
                "clauses": "not an array of clauses",
                "sections": [
                    { "id": 1, "clauses_ids": [1, 2] }
                ]
            }
        ';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Attribute clauses is not an array in the JSON.');

        DatasetParser::fromJsonString($jsonString);
    }

    /**
     * Test for invalid "sections" attribute (not an array).
     *
     * @return void
     */
    public function testInvalidSectionsData(): void
    {
        $jsonString = '
            {
                "clauses": [
                    { "id": 1, "text": "The quick brown fox" }
                ],
                "sections": "not an array of sections"
            }
        ';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Attribute sections is not an array in the JSON.');

        DatasetParser::fromJsonString($jsonString);
    }

    /**
     * Test for invalid IDs in clauses and sections.
     *
     * @return void
     */
    public function testInvalidIds(): void
    {
        $jsonString = '
            {
                "clauses": [
                    { "id": 1, "text": "The quick brown fox" },
                    { "id": "not an integer", "text": "jumps over the lazy dog" },
                    { "id": 3, "text": "And dies" }
                ],
                "sections": [
                    { "id": "not an integer", "clauses_ids": ["not an integer", 2] }
                ]
            }
        ';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The "id" attribute of "clauses" must be a positive integer');

        DatasetParser::fromJsonString($jsonString);
    }

    /**
     * Test for clauses with invalid attributes.
     *
     * @return void
     */
    public function testInvalidClausesAttributes(): void
    {
        $jsonString = '
            {
                "clauses": [
                    { "id": 1, "text": "The quick brown fox", "extra": "extra field" },
                    { "id": 2, "text": "jumps over the lazy dog" },
                    { "id": 3, "extra": "missing text field" },
                    { "text": "And dies" },
                    { "id": "not an integer", "text": "The white horse is white" }
                ],
                "sections": [
                    { "id": 1, "clauses_ids": [1, 2] }
                ]
            }
        ';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Elements of "clauses" must contain "id" and "text"');

        DatasetParser::fromJsonString($jsonString);
    }
}
?>

