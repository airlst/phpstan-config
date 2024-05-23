<?php

declare(strict_types=1);

namespace Airlst\PhpstanConfig\Phpstan;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class NoThrowIfRule implements Rule // @phpstan-ignore-line
{
    public function getNodeType(): string
    {
        return FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (! $node instanceof FuncCall) {
            return [];
        }

        if ($node->name->parts[0] === 'throw_if') { // @phpstan-ignore-line
            return [
                RuleErrorBuilder::message('throw_if() function is not allowed! Use if condition instead.')
                    ->identifier('throwIf.if')
                    ->build(),
            ];
        }

        if ($node->name->parts[0] === 'throw_unless') { // @phpstan-ignore-line
            return [
                RuleErrorBuilder::message('throw_unless() function is not allowed! Use if condition instead.')
                    ->identifier('throwIf.unless')
                    ->build(),
            ];
        }

        return [];
    }
}
