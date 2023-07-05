<?php

declare(strict_types=1);

namespace BeechIt\JsonToCodeClimateSubsetConverter\Tests\PHPCSFixer;

use BeechIt\JsonToCodeClimateSubsetConverter\Factories\ConverterFactory;
use BeechIt\JsonToCodeClimateSubsetConverter\Factories\ValidatorFactory;
use BeechIt\JsonToCodeClimateSubsetConverter\Tests\TestCase;

/**
 * @internal
 */
class PHPCSFixerConverterTest extends TestCase
{
    public function testItCanConvertPhpCsFixerSuccessfulJsonToSubset(): void
    {
        // Given
        $jsonInput = file_get_contents(__DIR__.'/fixtures/empty.json');
        $jsonDecodedInput = json_decode($jsonInput);

        $validatorFactory = new ValidatorFactory();

        $validator = $validatorFactory->build('PHP-CS-Fixer', $jsonDecodedInput);

        $converterFactory = new ConverterFactory();

        $converterImplementation = $converterFactory->build(
            'PHP-CS-Fixer',
            $validator,
            $jsonDecodedInput
        );

        // When
        $converterImplementation->convertToSubset();

        // Then
        $this->assertEquals([], $converterImplementation->getOutput());
    }

    public function testItCanConvertPhpCsFixerJsonToSubset(): void
    {
        // Given
        $jsonInput = file_get_contents(__DIR__.'/fixtures/input.json');
        $jsonDecodedInput = json_decode($jsonInput);

        $validatorFactory = new ValidatorFactory();

        $validator = $validatorFactory->build('PHP-CS-Fixer', $jsonDecodedInput);

        $converterFactory = new ConverterFactory();

        $converterImplementation = $converterFactory->build(
            'PHP-CS-Fixer',
            $validator,
            $jsonDecodedInput
        );

        // When
        $converterImplementation->convertToSubset();

        // Then
        $this->assertEquals(
            [
                [
                    'categories' => ['Style'],
                    'check_name' => 'no_unused_imports',
                    'description' => '(PHP-CS-Fixer) no_unused_imports',
                    'fingerprint' => '845a60d662be89526ed15f15b02f9181',
                    'severity' => 'minor',
                    'location' => [
                        'path' => 'app/Class.php',
                        'lines' => [
                            'begin' => 5,
                            'end' => 7,
                        ],
                    ],
                ],
            ],
            $converterImplementation->getOutput()
        );
    }

    public function testItCanConvertPhpCsFixerJsonToJsonSubset(): void
    {
        // Given
        $jsonInput = file_get_contents(__DIR__.'/fixtures/input.json');
        $jsonDecodedInput = json_decode($jsonInput);

        $jsonOutput = file_get_contents(__DIR__.'/fixtures/output.json');

        $validatorFactory = new ValidatorFactory();

        $validator = $validatorFactory->build('PHP-CS-Fixer', $jsonDecodedInput);

        $converterFactory = new ConverterFactory();

        $converterImplementation = $converterFactory->build(
            'PHP-CS-Fixer',
            $validator,
            $jsonDecodedInput
        );

        // When
        $converterImplementation->convertToSubset();

        // Then
        $this->assertEquals(
            $jsonOutput,
            $converterImplementation->getJsonEncodedOutput()
        );
    }
}
