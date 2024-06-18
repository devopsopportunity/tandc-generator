# Technical Documentation

## Introduction to tandc-generator

**Terms & Conditions (T&C) Generator**

The T&C generator is software that, given:
- A template
- A dataset

transforms the template into a document by expanding the template tags into their representations using the dataset.

**TEMPLATE**

It consists of text composed of:
- Plain text
- Tags

**TAGS**

Supported tags include:
- Clauses: [CLAUSE-#{ID}]
- Sections: a group of clauses represented with [SECTION-#{ID}]

**EXAMPLE**

Given the following template:
```
A T&C Document
This document is made of plain text.
It's made of [CLAUSE-3].
It's made of [CLAUSE-4].
It's made of [SECTION-1].
Your legal terms.
```

And the following dataset:
```
clauses: [
  { "id": 1, "text": "The quick brown fox" },
  { "id": 2, "text": "jumps over the lazy dog" },
  { "id": 3, "text": "And dies" },
  { "id": 4, "text": "The white horse is white" }
]
sections: [
  { "id": 1, "clause_ids": [1, 2] }
]
```

It generates the following T&C document:
```
A T&C Document
This document is made of plain text.
It's made of And dies.
It's made of The white horse is white.
It's made of The quick brown fox;jumps over the lazy dog.
Your legal terms.
```

---

## 1. Setting Up and Running the Application and Automated Tests

### Getting Started: Installation and Environment Setup Instructions

Before running the tests, follow these steps to install and configure the development environment.

### System Requirements

- PHP 8.2
- Required PHP extensions: ctype, dom, xml, mbstring, tokenizer

### Installing Dependencies

1. Update the available packages:
   ```bash
   sudo apt update
   ```

2. Install the required PHP extensions:
   ```bash
   sudo apt install php-pear ctype dom xmlwriter php-ctype php-dom php-json php-libxml php-mbstring php-tokenizer php-xml php-xmlwriter
   sudo apt update
   ```
   
3. Verify that the PHP extensions are active:
   ```bash
   php -m | grep -i 'ctype\|dom\|xmlwriter'
   ```

4. Install PHPUnit:
   ```bash
   wget https://phar.phpunit.de/phpunit.phar
   chmod +x phpunit.phar
   sudo mv phpunit.phar /usr/local/bin/phpunit
   phpunit --version
   ```
   
5. Configure PHPUnit to avoid cache issues:
   ```bash
   sudo touch /usr/local/bin/.phpunit.result.cache
   sudo chmod 777 /usr/local/bin/.phpunit.result.cache
   ```

### Running Tests

To execute the tests, use the `run_tests.sh` script:
```bash
./run_tests.sh
```

### Running the Project

To start the application, use the `start_app.sh` script:
```bash
./start_app.sh
```

---

## 2. Comprehensive Design Decisions

### Project Structure

```
/tandc-generator
├── datasets
│   ├── dataset_1.txt
│   ├── dataset_2.txt
├── php_lessons
├── README.md
├── results
│   ├── result_1.txt
│   ├── result_2.txt
├── run_tests.sh
├── src
│   ├── autoload.php
│   ├── DatasetParser.php
│   ├── FileInput.php
│   ├── Hello.php
│   ├── index.php
│   ├── Main.php
│   ├── Setup.php
│   ├── TemplateParser.php
├── start_app.sh
├── templates
│   ├── template_1.txt
│   ├── template_2.txt
├── tests
│   ├── DatasetParserTest.php
│   ├── HelloTest.php
│   ├── MainTest.php
```

### Explanation of Directories and Files

- **datasets**: Contains input datasets.
  - *dataset_1.txt*: First input dataset file.
  - *dataset_2.txt*: Second input dataset file.
  
- **results**: Contains expected output results for T&C.
  - *result_1.txt*: First result file.
  - *result_2.txt*: Second result file.

- **src**: Contains source codes.
  - *autoload.php*: PHP class loading for testing.
  - *DatasetParser.php*: Data check parser for dataset input in JSON-like format. Converts JSON string to associative array, validating its structure and checking for essential attributes.
  - *FileInput.php*: Input data container for two Template and DataSet files. Defines IFileInput interface and implements FileInput class to handle file input.
  - *Hello.php*: Test file for unit testing.
  - *index.php*: Launch application.
  - *Main.php*: Primary execution class. Coordinates main application flow, managing file input, data parsing, and output of results.
  - *Setup.php*: Initialization class for folders and global data. Provides global constants and configurations for application, such as debug settings and file paths.
  - *TemplateParser.php*: Actual parsing process using Regular Expressions. Manages template parsing, replacing tags `[CLAUSE-#{ID}]` and `[SECTION-#{ID}]` with corresponding texts from dataset.

- **templates**: Contains input templates.
  - *template_1.txt*: First input template file.
  - *template_2.txt*: Second input template file.

- **tests**: Contains PHPUnit tests.
  - *DatasetParserTest.php*: Unit test for DatasetParser class.
  - *HelloTest.php*: Initial setup verification test.
  - *MainTest.php*: Integration test for main processes launched in the project.

- **php_lessons**: Contains basic PHP language review before starting the project.

- **run_tests.sh**: File to execute tests.

- **start_app.sh**: File to start the application.

### Design Considerations for Terms & Conditions Generation Application

[x] **Description of Parser Design and Tag Expansion Logic**

- The `TemplateParser` uses regular expressions to identify tags in the template and replace them with corresponding data texts.
- The logic is implemented using callbacks that access the data and process it based on the ID specified in the tags.
- `TemplateParser` is responsible for parsing the Terms & Conditions template, replacing tags `[CLAUSE-#{ID}]` and `[SECTION-#{ID}]` with corresponding texts from the provided dataset.
- It uses regular expressions to identify tags in the template and callback functions to retrieve and insert relevant data.
- Tag expansion logic is based on searching for IDs within the tags themselves and replacing them with corresponding texts from the data.

[x] **Explanation of Data Structures and Algorithms Used**

- Use of associative arrays to represent dataset data, with structural validation in `DatasetParser` to ensure data correctness before processing.
- In `DatasetParser`, the JSON string containing data is transformed into a PHP associative array.
- The primary data structures used are:
  - **Associative Arrays**: To represent clauses (`clauses`) and sections (`sections`) data, ensuring efficient and structured access to data.
  - **Data Validation**: The parser performs structural checks to ensure data is correct before proceeding with parsing in `TemplateParser`. This includes checks for essential attributes such as `id` and `text` for clauses, and `id` and `clauses_ids` for sections.

#### Error Handling Design Decisions Illustrated

- Throwing specific exceptions (`\InvalidArgumentException`) in case of parsing or validation errors, with detailed messages to identify the issue.
- Error handling is centralized in the `Main` class, which coordinates the parsing process.
- An `\InvalidArgumentException` is thrown if issues occur during data parsing:
  - **Dataset Error**: If data lacks required sections (`clauses` or `sections`), an exception is thrown with a detailed message indicating the missing attribute.
  - **JSON Parsing Error**: If JSON decoding fails, an exception is thrown with the specific error message returned by PHP.

#### Details of Choices Made for Code Modularity and Maintainability

- Clear separation of responsibilities among classes (`TemplateParser`, `Main`, `DatasetParser`, `FileInput`, `Setup`) to promote code reuse and ease maintenance.
- Use of static methods and class instances to manage workflow and minimize dependencies.
- The code is structured to favor modularity and maintainability through the following design decisions:
  - **Separation of Responsibilities**: Each class has a specific responsibility. `TemplateParser` handles template parsing, `DatasetParser` handles JSON conversion, while `Main` coordinates the main application flow.
  - **IFileInput Interface**: Introduced to abstract file input, allowing changing `FileInput` implementation without modifying other parts of code depending on `IFileInput`.
  - **Final Classes and Static Methods**: `Main` is a final class with static methods that coordinate the main flow. This helps maintain strict control over execution flow without needing to instantiate multiple objects.

#### Configuration of Setup Class

`Setup` defines global constants such as:
- `DEBUG`: To enable or disable application debugging.
- `PREFIX`: Main directory path containing templates, datasets, and results.
- `PREFIX_TEMPLATE` and `PREFIX_DATASET`: File name prefixes for templates and datasets.
- `RESULTS_DIR`: Directory where generated results are saved.

### Design Principles

#### Separation of Responsibilities

Classes `FileInput`, `Setup`, `Main`, `DatasetParser`, and `TemplateParser` are designed with clear separation of responsibilities:
- **FileInput**: Implements `IFileInput` interface to

 provide abstraction over input data. It solely manages and returns template and dataset provided during object construction.
- **Setup**: Holds constants and global configurations for the system. It manages information like prefixes for templates, datasets, and results directories, as well as global settings like debug mode.
- **Main**: Coordinates the main application flow, handling file loading, data parsing, and final result generation. It also manages error handling.
- **DatasetParser**: Handles JSON string conversion into associative array, validating data structure to ensure correctness before usage in template parsing.
- **TemplateParser**: Manages template parsing, replacing tags with appropriate texts from dataset.

#### Dependencies

Classes minimize external dependencies:
- **FileInput**: Depends only on information provided during its initialization (template and dataset), with no direct external dependencies.
- **Setup**: Being a final class with constants, it avoids accidental changes to global configurations during development. Changes are handled through constant updates, maintaining system coherence.
- **Main**: Depends on `FileInput`, `DatasetParser`, and `TemplateParser` to coordinate the main flow, but these dependencies are minimized to what's essential.
- **DatasetParser**: Depends solely on the JSON string provided for conversion to associative array and validation.
- **TemplateParser**: Depends on data provided by `DatasetParser` to replace tags in the template.

#### Open-Closed Principles

Classes are designed to be open for extension through:
- **FileInput**: `IFileInput` interface allows extending behavior to handle different input types in the future, e.g., extending to support different dataset formats.
- **Setup**: Defined constants allow adding new global configurations or modifying existing ones without directly changing class code. For example, it could be extended to handle additional configurations like paths for other file types.
- **Main**: Can be extended to handle new parsing types or additional workflows without modifying existing code.
- **DatasetParser**: Can be extended to support additional input formats or new validation rules without changing existing code.
- **TemplateParser**: Can be extended to support new tag types or template formats without modifying existing code.

Classes are closed to direct modification:
- **FileInput**: Once interface structure and basic implementation are defined, no further modification is needed to extend template and dataset reading behavior.
- **Setup**: As a final class with constants, it prevents accidental changes to global configurations during development. Changes are managed by updating constants, maintaining system consistency.
- **Main**: Workflow extensions can be made by adding new methods without modifying existing ones.
- **DatasetParser**: New validation rules or input formats can be added by extending the class, without needing to modify existing code.
- **TemplateParser**: New tag types or template formats can be supported by extending the class, keeping existing code intact to ensure stability.

### Conclusions on Design Choices

These object-oriented design principles for classes `FileInput`, `Setup`, and core components like `TemplateParser`, `DatasetParser`, and `Main` promote modularity, maintainability, and scalability of the system. By employing clear separation of responsibilities, minimizing dependencies, and implementing open-closed principles, the code becomes cleaner, more testable, and less error-prone during development and maintenance. This approach solidifies the software structure and facilitates adding new features or extending existing configurations over time.

These design considerations are crucial to ensure the application is robust, easy to extend, and maintainable in the long term, effectively meeting the needs for automatic generation of Terms & Conditions.

---

## 3. Time Spent

The total time spent is approximately **15.5 hours**

### Timeline Table of Recorded Operations

| Date       | Start Time | End Time | Time Spent (hours) | Notes                                         |
|------------|------------|----------|---------------------|----------------------------------------------|
| 14/06/2024 | 15:00      | 17:00    | 2                   | PHP lessons                                   |
| 16/06/2024 | 12:00      | 18:00    | 6                   | Environment setup, Test setup + Advanced PHP lessons |
| 16/06/2024 | 18:30      | 20:30    | 2                   | Analysis + Code writing                      |
| 17/06/2024 | 11:30      | 16:00    | 4.5                 | Test implementation                          |
| 18/06/2024 | 10:00      | 12:20    | 2.33                | Refinements, comments, and documentation writing |
| 18/06/2024 | 12:47      | 13:40    | 0.88                | Refinements (second part)                    |
| 18/06/2024 | 13:40      | 14:20    | 0.67                | PHP lessons refinement                       |
| 18/06/2024 | 14:20      | 14:50    | 0.5                 | Packaging preparation and submission to HR   |

## 4. What I Would Have Done With More Time

- [ ] Implement a React.js GUI for easier interaction with the generator
- [ ] Add additional tests to cover edge cases and complex scenarios
- [ ] Optimize parser performance for large dataset sizes
- [ ] Document the code more comprehensively
- [ ] Integrate a logging system for operation monitoring
- [ ] Create a Continuous Integration / Continuous Deployment (CI/CD - DevOps) system to automate testing and deployment
- [ ] Expand generator functionalities to support other output formats, such as PDF, using PDFlib. PDFlib is an extension of the PHP interpreter that interfaces with APIs written in ANSI C. Being written in C and integrated as a module of the interpreter, it is currently the fastest library available and allows for the modification of previously created documents.

---

