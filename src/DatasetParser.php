<?php
/**
 * @file DatasetParser.php
 * @date 18-06-2024
 * @authors PHP Engineer: Edoardo Sabatini
 *          PHP Developer: ChatGPT 4o / ChatGPT 3.5
 */

namespace App;

/**
 * Class DatasetParser
 *
 * Parses JSON data into an associative array format.
 */
class DatasetParser {
    /**
     * Parses JSON string into an associative array.
     *
     * @param string $jsonString The JSON string to parse.
     * @return array The parsed data.
     * @throws \InvalidArgumentException If there is an error decoding the JSON.
     */
    public static function fromJsonString($jsonString) {
        // Remove unnecessary whitespace
        $jsonString = trim($jsonString, "\t\n\r\0\x0B");

        // Decode the JSON string into an associative array
        $data = json_decode($jsonString, true);

        // Check if decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Error decoding JSON: ' . json_last_error_msg());
        }

        // Check for required attributes and their types
        self::checkRequiredAttributes($data);

        // Validate array structures
        self::validateArraysStructure($data);

        return $data;
    }

    /**
     * Checks for the presence and type of required attributes.
     *
     * @param array $data The data to check.
     * @return void
     * @throws \InvalidArgumentException If required attributes are missing or have incorrect types.
     */
    private static function checkRequiredAttributes(array $data): void {
        $requiredAttributes = ['clauses', 'sections'];

        foreach ($requiredAttributes as $attribute) {
            if (!isset($data[$attribute])) {
                throw new \InvalidArgumentException('JSON is missing attribute: ' . $attribute);
            }

            // Check if the attribute is an array
            if (!is_array($data[$attribute])) {
                throw new \InvalidArgumentException('Attribute ' . $attribute . ' is not an array in the JSON.');
            }
        }
    }

    /**
     * Validates the structure of arrays within the data.
     *
     * @param array $data The data to validate.
     * @return void
     * @throws \InvalidArgumentException If array structures are invalid.
     */
    private static function validateArraysStructure(array $data): void {
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                continue; // Skip if it's not an array
            }

            switch ($key) {
                case 'clauses':
                    self::validateClauses($value);
                    break;
                case 'sections':
                    self::validateSections($value);
                    break;
                // Add more cases for other arrays if needed
            }
        }
    }

    /**
     * Validates the structure of 'clauses' array.
     *
     * @param array $clauses The 'clauses' array to validate.
     * @return void
     * @throws \InvalidArgumentException If 'clauses' array is empty or contains invalid elements.
     */
    private static function validateClauses(array $clauses): void {
        // Check if there is at least one 'clauses' element
        if (count($clauses) === 0) {
            throw new \InvalidArgumentException('The "clauses" attribute is empty in the JSON.');
        }

        foreach ($clauses as $clause) {
            if (!is_array($clause)) {
                throw new \InvalidArgumentException('Elements of "clauses" must be arrays.');
            }

            // Check that each 'clause' element has 'id' and 'text'
            if (!isset($clause['id']) || !isset($clause['text'])) {
                throw new \InvalidArgumentException('Elements of "clauses" must contain "id" and "text".');
            }

            // Check that 'id' is a positive integer
            if (!is_int($clause['id']) || $clause['id'] <= 0) {
                throw new \InvalidArgumentException('The "id" attribute of "clauses" must be a positive integer.');
            }
        }
    }

    /**
     * Validates the structure of 'sections' array.
     *
     * @param array $sections The 'sections' array to validate.
     * @return void
     * @throws \InvalidArgumentException If 'sections' array contains invalid elements.
     */
    private static function validateSections(array $sections): void {
        foreach ($sections as $section) {
            if (!is_array($section)) {
                throw new \InvalidArgumentException('Elements of "sections" must be arrays.');
            }

            // Check that each section has 'id' and 'clauses_ids'
            if (!isset($section['id']) || !isset($section['clauses_ids'])) {
                throw new \InvalidArgumentException('Elements of "sections" must contain "id" and "clauses_ids".');
            }

            // Check that 'id' is a positive integer
            if (!is_int($section['id']) || $section['id'] <= 0) {
                throw new \InvalidArgumentException('The "id" attribute of "sections" must be a positive integer.');
            }

            // Check that 'clauses_ids' is an array
            if (!is_array($section['clauses_ids'])) {
                throw new \InvalidArgumentException('The "clauses_ids" attribute of "sections" is not an array.');
            }

            // Check that each 'clauses_ids' element is an integer
            foreach ($section['clauses_ids'] as $clause_id) {
                if (!is_int($clause_id)) {
                    throw new \InvalidArgumentException('Elements of "clauses_ids" must be integers.');
                }
            }
        }
    }
}
?>

