<?php

declare(strict_types=1);

namespace Airlst\RectorConfig\Phpstan;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class NoDumpRule implements Rule // @phpstan-ignore-line
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

        if ($node->name->parts[0] === 'dd') { // @phpstan-ignore-line
            return [
                RuleErrorBuilder::message('Remaining dd() call in application code')->build(),
            ];
        }

        if ($node->name->parts[0] === 'dump') { // @phpstan-ignore-line
            return [
                RuleErrorBuilder::message('Remaining dump() call in application code')->build(),
            ];
        }

        return [];
    }
}
