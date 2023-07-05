<?php

declare(strict_types=1);

namespace BeechIt\JsonToCodeClimateSubsetConverter\Tests\Psalm;

use BeechIt\JsonToCodeClimateSubsetConverter\Factories\ConverterFactory;
use BeechIt\JsonToCodeClimateSubsetConverter\Factories\ValidatorFactory;
use BeechIt\JsonToCodeClimateSubsetConverter\Tests\TestCase;

use function file_get_contents;
use function json_decode;

/**
 * @internal
 */
class PsalmConverterTest extends TestCase
{
    public function testItCanConvertPsalmJsonToSubset(): void
    {
        // Given
        $jsonInput = file_get_contents(__DIR__.'/fixtures/input.json');
        $jsonDecodedInput = json_decode($jsonInput);

        $validatorFactory = new ValidatorFactory();

        $validator = $validatorFactory->build('Psalm', $jsonDecodedInput);

        $converterFactory = new ConverterFactory();

        $converterImplementation = $converterFactory->build(
            'Psalm',
            $validator,
            $jsonDecodedInput
        );

        // When
        $converterImplementation->convertToSubset();

        // Then
        $this->assertEquals(
            [
                [
                    'categories' => ['Bug Risk'],
                    'check_name' => 'PropertyNotSetInConstructor',
                    'description' => '(Psalm) Property Illuminate\\Foundation\\Console\\Kernel::$artisan is not defined in constructor of App\\Console\\Kernel and in any methods called in the constructor',
                    'fingerprint' => 'a1390ad03dfc4c048ca4023b9a2c7d3d',
                    'severity' => 'minor',
                    'location' => [
                        'path' => 'app/Class.php',
                        'lines' => [
                            'begin' => 2,
                            'end' => 2,
                        ],
                    ],
                ],
            ],
            $converterImplementation->getOutput()
        );
    }

    public function testItCanConvertPsalmJsonToJsonSubset(): void
    {
        // Given
        $jsonInput = file_get_contents(__DIR__.'/fixtures/input.json');
        $jsonDecodedInput = json_decode($jsonInput);

        $jsonOutput = file_get_contents(__DIR__.'/fixtures/output.json');

        $validatorFactory = new ValidatorFactory();

        $validator = $validatorFactory->build('Psalm', $jsonDecodedInput);

        $converterFactory = new ConverterFactory();

        $converterImplementation = $converterFactory->build(
            'Psalm',
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
