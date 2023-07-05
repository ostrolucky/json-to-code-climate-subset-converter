<?php

declare(strict_types=1);

namespace BeechIt\JsonToCodeClimateSubsetConverter\Tests;

use BeechIt\JsonToCodeClimateSubsetConverter\Phan\PhanConvertToSubset;
use BeechIt\JsonToCodeClimateSubsetConverter\Phan\PhanJsonValidator;
use BeechIt\JsonToCodeClimateSubsetConverter\PHP_CodeSniffer\PhpCodeSnifferConvertToSubset;
use BeechIt\JsonToCodeClimateSubsetConverter\PHP_CodeSniffer\PhpCodeSnifferJsonValidator;
use BeechIt\JsonToCodeClimateSubsetConverter\PHPCSFixer\PHPCSFixerConvertToSubset;
use BeechIt\JsonToCodeClimateSubsetConverter\PHPCSFixer\PHPCSFixerJsonValidator;
use BeechIt\JsonToCodeClimateSubsetConverter\PHPLint\PhpLintConvertToSubset;
use BeechIt\JsonToCodeClimateSubsetConverter\PHPLint\PhpLintJsonValidator;
use BeechIt\JsonToCodeClimateSubsetConverter\PHPStan\PHPStanConvertToSubset;
use BeechIt\JsonToCodeClimateSubsetConverter\PHPStan\PHPStanJsonValidator;
use BeechIt\JsonToCodeClimateSubsetConverter\Psalm\PsalmConvertToSubset;
use BeechIt\JsonToCodeClimateSubsetConverter\Psalm\PsalmJsonValidator;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * @internal
 */
class TestCase extends BaseTestCase
{
    public function multipleConvertersProvider(): array
    {
        return [
            'Phan' => [
                'jsonInput' => '/Phan/fixtures/input.json',
                'jsonOutput' => '/Phan/fixtures/output.json',
                'validator' => PhanJsonValidator::class,
                'converter' => PhanConvertToSubset::class,
                'output' => [
                    'description' => '(Phan) UndefError PhanUndeclaredClassConstant Reference to constant class from undeclared class \PhpParser\Node\Stmt\ClassMethod',
                    'fingerprint' => '99e39ad9a68edd27065f33894a4e3386',
                    'location' => [
                        'path' => 'app/Class.php',
                        'lines' => [
                            'begin' => 32,
                            'end' => 34,
                        ],
                    ],
                ],
                'name' => 'Phan',
            ],
            'PHP_CodeSniffer' => [
                'jsonInput' => '/PHP_CodeSniffer/fixtures/input.json',
                'jsonOutput' => '/PHP_CodeSniffer/fixtures/output.json',
                'validator' => PhpCodeSnifferJsonValidator::class,
                'converter' => PhpCodeSnifferConvertToSubset::class,
                'output' => [
                    'categories' => ['Style'],
                    'check_name' => 'PEAR.Commenting.FileComment.Missing',
                    'description' => '(PHP_CodeSniffer) Missing file doc comment',
                    'fingerprint' => 'fff44d7f0a7aaba31f6f8cdfc0e32598',
                    'severity' => 'major',
                    'location' => [
                        'path' => 'app/Class.php',
                        'lines' => [
                            'begin' => 2,
                            'end' => 2,
                        ],
                    ],
                ],
                'name' => 'PHP_CodeSniffer',
            ],
            'PHPLint' => [
                'jsonInput' => '/PHPLint/fixtures/input.json',
                'jsonOutput' => '/PHPLint/fixtures/output.json',
                'validator' => PhpLintJsonValidator::class,
                'converter' => PhpLintConvertToSubset::class,
                'output' => [
                    'description' => "(PHPLint) unexpected 'public' (T_PUBLIC), expecting ',' or ';' in line 2",
                    'fingerprint' => '10fae914daf98cbd49278d2962b8ad4e',
                    'location' => [
                        'path' => 'app/Class.php',
                        'lines' => [
                            'begin' => 2,
                        ],
                    ],
                ],
                'name' => 'PHPLint',
            ],
            'PHPStan' => [
                'jsonInput' => '/PHPStan/fixtures/input.json',
                'jsonOutput' => '/PHPStan/fixtures/output.json',
                'validator' => PHPStanJsonValidator::class,
                'converter' => PHPStanConvertToSubset::class,
                'output' => [
                    'description' => '(PHPStan) Return type (array) of method App\Class::processNode() should be covariant with return type (array<PHPStan\Rules\RuleError|string>) of method PHPStan\Rules\Rule::processNode()',
                    'fingerprint' => '33a80151c3b863041dbafff13932b7fd',
                    'location' => [
                        'path' => 'app/Class.php',
                        'lines' => [
                            'begin' => 2,
                        ],
                    ],
                ],
                'name' => 'PHPStan',
            ],
            'Psalm' => [
                'jsonInput' => '/Psalm/fixtures/input.json',
                'jsonOutput' => '/Psalm/fixtures/output.json',
                'validator' => PsalmJsonValidator::class,
                'converter' => PsalmConvertToSubset::class,
                'output' => [
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
                'name' => 'Psalm',
            ],
            'PHP-CS-Fixer' => [
                'jsonInput' => '/PHPCSFixer/fixtures/input.json',
                'jsonOutput' => '/PHPCSFixer/fixtures/output.json',
                'validator' => PHPCSFixerJsonValidator::class,
                'converter' => PHPCSFixerConvertToSubset::class,
                'output' => [
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
                'name' => 'PHP-CS-Fixer',
            ],
        ];
    }
}
