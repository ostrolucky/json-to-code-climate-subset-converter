<?php

declare(strict_types=1);

namespace BeechIt\JsonToCodeClimateSubsetConverter\PHPCSFixer;

use BeechIt\JsonToCodeClimateSubsetConverter\AbstractConverter;

final class PHPCSFixerConvertToSubset extends AbstractConverter
{
    /**
     * We need https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/pull/7089/files to improve this.
     */
    public function convertToSubset(): void
    {
        $this->abstractJsonValidator->validateJson();

        foreach ($this->json as $node) {
            $this->codeClimateNodes[] = [
                'categories' => $node->categories,
                'check_name' => $node->check_name,
                'description' => $this->createDescription($node->description),
                'fingerprint' => $this->createFingerprint(
                    $node->description,
                    $node->location->path,
                    $node->location->lines->begin,
                    $node->location->lines->end,
                ),
                'severity' => $node->severity,
                'location' => [
                    'path' => $node->location->path,
                    'lines' => [
                        'begin' => $node->location->lines->begin,
                        'end' => $node->location->lines->end,
                    ],
                ],
            ];
        }
    }

    public function getToolName(): string
    {
        return 'PHP-CS-Fixer';
    }
}
