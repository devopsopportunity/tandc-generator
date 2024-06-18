<?php
/**
 * @file Main.php
 * @date 18-06-2024
 * @authors PHP Engineer: Edoardo Sabatini
 *          PHP Developer: ChatGPT 4o / ChatGPT 3.5
 */

namespace App;

require_once 'Setup.php';
require_once 'TemplateParser.php';
require_once 'DatasetParser.php';
require_once 'FileInput.php';

/**
 * Main class for initiating parsing processes.
 */
final class Main {
    private static $prefix;

    /**
     * Gets the position of the "sections" section in the dataset.
     *
     * @param string $dataSet The dataset content.
     * @return int The position of the "sections" section.
     * @throws \InvalidArgumentException If "clauses" or "sections" are not found in the dataset.
     */
    public static function getPosSections(string $dataSet): int {
        // Check for the presence of the substring "clauses"
        $posClauses = strpos($dataSet, 'clauses');
        if ($posClauses === false) {
            throw new \InvalidArgumentException('Error: the word "clauses" not found in the dataset file.');
        }

        // Check for the presence of the substring "sections"
        $posSections = strpos($dataSet, 'sections');
        if ($posSections === false) {
            throw new \InvalidArgumentException('Error: the word "sections" not found in the dataset file.');
        }
        
        return $posSections;
    }

    /**
     * Prints the file input.
     *
     * @param IFileInput $fileInput The file input object.
     * @return void
     */
    public static function printFileInput(IFileInput $fileInput): void {
        echo 'Template: ' . PHP_EOL . $fileInput->getTemplate(). PHP_EOL;
        echo 'DataSet: '  . PHP_EOL . $fileInput->getDataSet();
    }

    /**
     * Parses data from the provided dataset.
     *
     * @param IFileInput $fileInput The file input object.
     * @return string The text processed from the template.
     * @throws \InvalidArgumentException If an error occurs during data parsing.
     */
    public static function parseData(IFileInput $fileInput): string {
        $dataSet = $fileInput->getDataSet();

        try {
            // Get the position of "sections" and check for the presence of "clauses" and "sections"
            $posSections = self::getPosSections($dataSet);

            // Split the string into two parts: before "sections" and after
            $part1 = substr($dataSet, 0, $posSections);
            $part2 = substr($dataSet, $posSections);

            // Add quotes around keys and values in both parts
            $part1 = preg_replace('/(\w+):/', '"$1":', $part1);
            $part2 = preg_replace('/(\w+):/', '"$1":', $part2);

            // Concatenate the two parts to form the complete JSON string
            $jsonString = '{' . $part1 . ',' . $part2 . '}';

            if (Setup::DEBUG) {
                // Print the intermediate result
                print("---------------------------------------" . PHP_EOL);
                print("jsonString: " . PHP_EOL . $jsonString . PHP_EOL);
                print("---------------------------------------" . PHP_EOL);
            }

            // Parse the JSON
            $datasetObject = DatasetParser::fromJsonString($jsonString);
            $parser = new TemplateParser($fileInput->getTemplate(), $datasetObject);
            $parsedText = $parser->parseTemplate();

            return $parsedText;

        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException('Error during data parsing: ' . $e->getMessage());
        }
    }

    /**
     * Prints the processed text to the screen.
     *
     * @param string $parsedText The text processed from the template.
     * @return void
     */
    public static function printParsedTextToScreen(string $parsedText): void {
        echo '---------------------------------------' . PHP_EOL;
        echo 'Terms & Conditions Document:' . PHP_EOL;
        echo $parsedText;
    }

    /**
     * Saves the processed text to a file.
     *
     * @param string $parsedText The text processed from the template.
     * @param int $processNumber The current process number.
     * @return void
     */
    public static function saveParsedTextToFile(string $parsedText, int $processNumber): void {
        // Save the result to a file
        $resultFile = Setup::PREFIX . Setup::RESULTS_DIR . "result_{$processNumber}.txt";
        file_put_contents($resultFile, $parsedText);
        echo "Result saved to: " . $resultFile . PHP_EOL;
    }

    /**
     * Executes the main processes.
     *
     * @return void
     */
    public static function runMainProcess(): void {
        self::$prefix = Setup::PREFIX;

        // Create results directory if it does not exist
        if (!is_dir(self::$prefix . Setup::RESULTS_DIR)) {
            mkdir(self::$prefix . Setup::RESULTS_DIR, 0777, true);
        }

        // Loop to iterate through the two files
        for ($i = 1; $i <= 2; $i++) {
            echo "Process #{$i}..." . PHP_EOL . PHP_EOL;
            $templateFile = self::$prefix . Setup::PREFIX_TEMPLATE . "_{$i}.txt";
            $datasetFile  = self::$prefix . Setup::PREFIX_DATASET  . "_{$i}.txt";
            
            // Check if both files exist
            if (file_exists($templateFile) && file_exists($datasetFile)) {
                
                // Read the contents of the files
                $templateContent = file_get_contents($templateFile);
                $datasetContent = file_get_contents($datasetFile);

                // Create an instance of FileInput
                $fileInput = new FileInput($templateContent, $datasetContent);
                
                // Print the input
                self::printFileInput($fileInput);
            
                try {
                    // Parse the data
                    $parsedText = self::parseData($fileInput);
                    
                    // Print the result to screen
                    self::printParsedTextToScreen($parsedText);
                    
                    // Save the result to file
                    self::saveParsedTextToFile($parsedText, $i);

                } catch (\InvalidArgumentException $e) {
                    echo $e->getMessage() . PHP_EOL;
                }
                
            } else {
                echo "File template_{$i}.txt or dataset_{$i}.txt not found, skipping to next." . PHP_EOL;
            }

            echo '---------------------------------------' . PHP_EOL;
        }
    }
}
?>

