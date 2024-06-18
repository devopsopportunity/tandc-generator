<?php
/**
 * @file TemplateParser.php
 * @date 18-06-2024
 * @authors PHP Engineer: Edoardo Sabatini
 *          PHP Developer: ChatGPT 4o / ChatGPT 3.5
 */

namespace App;

/**
 * Class TemplateParser
 *
 * A class to parse templates using data provided.
 */
class TemplateParser {
    /**
     * @var string $template The template content.
     */
    private $template;

    /**
     * @var array $data The data array containing clauses and sections.
     */
    private $data;

    /**
     * TemplateParser constructor.
     *
     * @param string $template The template content.
     * @param array $data The data array containing clauses and sections.
     */
    public function __construct(string $template, array $data) {
        $this->template = $template;
        $this->data = $data;
    }

    /**
     * Parses the template and replaces placeholders with actual content.
     *
     * @return string The parsed template text.
     */
    public function parseTemplate(): string {
        $parsedText = $this->template;
        
        // Replace clauses placeholders with actual text
        $parsedText = preg_replace_callback('/\[CLAUSE-(\d+)\]/', function($matches) {
            $clauseId = intval($matches[1]);
            $clause = $this->findClauseById($clauseId);
            return $clause['text'] ?? "";
        }, $parsedText);

        // Replace sections placeholders with actual text
        $parsedText = preg_replace_callback('/\[SECTION-(\d+)\]/', function($matches) {
            $sectionId = intval($matches[1]);
            $section = $this->findSectionById($sectionId);
            if (!$section) return "";

            $clausesText = [];
            foreach ($section['clauses_ids'] as $clauseId) {
                $clause = $this->findClauseById($clauseId);
                if ($clause) {
                    $clausesText[] = $clause['text'];
                }
            }
            return implode(';', $clausesText);
        }, $parsedText);

        return $parsedText;
    }

    /**
     * Finds a clause by its ID in the data array.
     *
     * @param int $clauseId The ID of the clause to find.
     * @return array|null The clause data if found, null otherwise.
     */
    private function findClauseById(int $clauseId): ?array {
        foreach ($this->data['clauses'] as $clause) {
            if ($clause['id'] === $clauseId) {
                return $clause;
            }
        }
        return null;
    }

    /**
     * Finds a section by its ID in the data array.
     *
     * @param int $sectionId The ID of the section to find.
     * @return array|null The section data if found, null otherwise.
     */
    private function findSectionById(int $sectionId): ?array {
        foreach ($this->data['sections'] as $section) {
            if ($section['id'] === $sectionId) {
                return $section;
            }
        }
        return null;
    }
}
?>

