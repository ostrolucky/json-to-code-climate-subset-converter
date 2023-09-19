<?php

declare(strict_types=1);

namespace BeechIt\JsonToCodeClimateSubsetConverter\Interfaces;

use Symfony\Component\Console\Command\Command;

interface CommandFactoryInterface
{
    public function build(
        string $name,
        SafeMethodsInterface $safeMethods = null
    ): Command;
}
