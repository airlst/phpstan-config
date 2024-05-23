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
                RuleErrorBuilder::message('throw_if() call in application code')
                    ->identifier('throw_if.if')
                    ->build(),
            ];
        }

        if ($node->name->parts[0] === 'throw_unless') { // @phpstan-ignore-line
            return [
                RuleErrorBuilder::message('throw_unless() call in application code')
                    ->identifier('throw_if.unless')
                    ->build(),
            ];
        }

        return [];
    }
}
