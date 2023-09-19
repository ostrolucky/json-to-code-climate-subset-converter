<?php

declare(strict_types=1);

namespace BeechIt\JsonToCodeClimateSubsetConverter\Factories;

use BeechIt\JsonToCodeClimateSubsetConverter\Command\ConverterCommand;
use BeechIt\JsonToCodeClimateSubsetConverter\Interfaces\CommandFactoryInterface;
use BeechIt\JsonToCodeClimateSubsetConverter\Interfaces\SafeMethodsInterface;
use BeechIt\JsonToCodeClimateSubsetConverter\Utilities\SafeMethods;
use Symfony\Component\Console\Command\Command;

class CommandFactory implements CommandFactoryInterface
{
    public function build(string $name, SafeMethodsInterface $safeMethods = null): Command
    {
        return new ConverterCommand($name, $safeMethods ?: new SafeMethods());
    }
}
