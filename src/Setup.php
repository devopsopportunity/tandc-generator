<?php
/**
 * @file Setup.php
 * @date 18-06-2024
 * @authors PHP Engineer: Edoardo Sabatini
 *          PHP Developer: ChatGPT 4o / ChatGPT 3.5
 */

namespace App;

/**
 * Class Setup
 *
 * Defines constants for directory paths and debugging options.
 */
final class Setup {
    public const DEBUG = false; // Option to enable or disable debugging
    public const PREFIX = "../"; // Directories are within the main directory
    public const PREFIX_TEMPLATE = "templates/template"; // Directory containing templates with prefix "template"
    public const PREFIX_DATASET  = "datasets/dataset";   // Directory containing datasets with prefix "dataset"
    public const RESULTS_DIR = "results/"; // Directory for storing results
}
?>

