<?php

declare(strict_types=1);

namespace Airlst\PhpstanConfig\Phpstan;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class NoAbortIfRule implements Rule // @phpstan-ignore-line
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

        if ($node->name->parts[0] === 'abort_if') { // @phpstan-ignore-line
            return [
                RuleErrorBuilder::message('abort_if() call in application code')
                    ->identifier('abortIf.if')
                    ->build(),
            ];
        }

        if ($node->name->parts[0] === 'abort_unless') { // @phpstan-ignore-line
            return [
                RuleErrorBuilder::message('abort_unless() call in application code')
                    ->identifier('abortIf.unless')
                    ->build(),
            ];
        }

        return [];
    }
}
