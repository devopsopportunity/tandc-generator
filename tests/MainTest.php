<?php
/**
 * @file MainTest.php
 * @date 18-06-2024
 * @authors
 *   - PHP Engineer: Edoardo Sabatini
 *   - PHP Developer: ChatGPT 4o / ChatGPT 3.5
 *
 * PHPUnit test case for Main class functionality.
 */

use PHPUnit\Framework\TestCase;
use App\Main;
use App\FileInput;

/**
 * PHPUnit test case for Main class functionality.
 */
final class MainTest extends TestCase
{
    /**
     * Test creation of FileInput instance and parsing data.
     *
     * @return void
     */
    public function testFileInputCreationAndParseData(): void
    {
        $templateContent = 'This document is made of plain text.
It contains [CLAUSE-3].
It contains [CLAUSE-4].
It contains [SECTION-1].
Your legal terms.';

        $datasetContent = 'clauses: [
  { "id": 1, "text": "The quick brown fox" },
  { "id": 2, "text": "jumps over the lazy dog" },
  { "id": 3, "text": "And dies" },
  { "id": 4, "text": "The white horse is white" }
]
sections: [
  { "id": 1, "clauses_ids": [1, 2] }
]
';

        $fileInput = new FileInput($templateContent, $datasetContent);

        $this->assertInstanceOf(FileInput::class, $fileInput);

        $dataSet = $fileInput->getDataSet();

        $expectedValue = Main::getPosSections($dataSet);

        $this->assertEquals(194, $expectedValue);

        $expectedText = <<<EXPECTED
This document is made of plain text.
It contains And dies.
It contains The white horse is white.
It contains The quick brown fox;jumps over the lazy dog.
Your legal terms.
EXPECTED;

        $parsedText = Main::parseData($fileInput);

        $this->assertEquals($expectedText, $parsedText);
    }

    /**
     * Test for dataset with invalid clauses data (missing 'text' in a clause).
     *
     * @return void
     */
    public function testInvalidClausesDataWithClauseInsteadOfText(): void
    {
        $templateContent = 'This document is made of plain text.
It contains [CLAUSE-3].
It contains [CLAUSE-4].
It contains [SECTION-1].
Your legal terms.';

        $datasetContent = 'clauses: [
  { "id": 1, "text": "The quick brown fox" },
  { "id": 2},
  { "id": 3, "text": "And dies" },
  { "id": 4, "text": "The white horse is white" }
]
sections: [
  { "id": 1, "clauses_ids": [1, 2] }
]
';

        $fileInput = new FileInput($templateContent, $datasetContent);

        $expectedErrorMessage = 'Elements of "clauses" must contain "id" and "text".';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedErrorMessage);

        $parsedText = Main::parseData($fileInput);
    }

    /**
     * Test for dataset with invalid JSON structure (missing 'clauses' attribute).
     *
     * @return void
     */
    public function testInvalidClausesErrorData(): void
    {
        $templateContent = 'This document is made of plain text.
It contains [CLAUSE-3].
It contains [CLAUSE-4].
It contains [SECTION-1].
Your legal terms.';

        $datasetContent = 'clausesError: [
  { "id": 1, "text": "The quick brown fox" },
  { "id": 2, "text": "jumps over the lazy dog" },
  { "id": 3, "text": "And dies" },
  { "id": 4, "text": "The white horse is white" }
]
sections: [
  { "id": 1, "clauses_ids": [1, 2] }
]
';

        $fileInput = new FileInput($templateContent, $datasetContent);

        $expectedErrorMessage = 'JSON is missing attribute: clauses';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedErrorMessage);

        $parsedText = Main::parseData($fileInput);
    }

    /**
     * Test for dataset with invalid JSON structure (missing 'sections' attribute).
     *
     * @return void
     */
    public function testInvalidSectionsErrorData(): void
    {
        $templateContent = 'This document is made of plain text.
It contains [CLAUSE-3].
It contains [CLAUSE-4].
It contains [SECTION-1].
Your legal terms.';

        $datasetContent = 'clauses: [
  { "id": 1, "text": "The quick brown fox" },
  { "id": 2, "text": "jumps over the lazy dog" },
  { "id": 3, "text": "And dies" },
  { "id": 4, "text": "The white horse is white" }
]
sectionsError: [
  { "id": 1, "clauses_ids": [1, 2] }
]
';

        $fileInput = new FileInput($templateContent, $datasetContent);

        $expectedErrorMessage = 'JSON is missing attribute: sections';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedErrorMessage);

        $parsedText = Main::parseData($fileInput);
    }
}
?>

