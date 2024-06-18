<?php
/**
 * @file FileInput.php
 * @date 18-06-2024
 * @authors PHP Engineer: Edoardo Sabatini
 *          PHP Developer: ChatGPT 4o / ChatGPT 3.5
 */

namespace App;

// Interface IFileInput
/**
 * Interface IFileInput
 *
 * Defines methods for retrieving template and dataset from a file input.
 */
interface IFileInput {
    /**
     * Retrieves the template content.
     *
     * @return string The template content.
     */
    public function getTemplate(): string;

    /**
     * Retrieves the dataset content.
     *
     * @return string The dataset content.
     */
    public function getDataSet(): string;
}

// Class FileInput implements IFileInput
/**
 * Class FileInput
 *
 * Implements the IFileInput interface to handle file input operations.
 */
class FileInput implements IFileInput {
    /**
     * @var string $template The template content.
     */
    private $template;

    /**
     * @var string $dataSet The dataset content.
     */
    private $dataSet;

    /**
     * FileInput constructor.
     *
     * @param string $template The template content.
     * @param string $dataSet The dataset content.
     */
    public function __construct(string $template, string $dataSet) {
        $this->template = $template;
        $this->dataSet = $dataSet;
    }

    /**
     * Retrieves the template content.
     *
     * @return string The template content.
     */
    public function getTemplate(): string {
        return $this->template;
    }

    /**
     * Retrieves the dataset content.
     *
     * @return string The dataset content.
     */
    public function getDataSet(): string {
        return $this->dataSet;
    }
}
?>

