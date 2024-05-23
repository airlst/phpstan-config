<?php

declare(strict_types=1);

namespace Airlst\PhpstanConfig\Phpstan;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class NoReportIfRule implements Rule // @phpstan-ignore-line
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

        if ($node->name->parts[0] === 'report_if') { // @phpstan-ignore-line
            return [
                RuleErrorBuilder::message('report_if() call in application code')
                    ->identifier('report_if.if')
                    ->build(),
            ];
        }

        if ($node->name->parts[0] === 'report_unless') { // @phpstan-ignore-line
            return [
                RuleErrorBuilder::message('report_unless() call in application code')
                    ->identifier('report_if.unless')
                    ->build(),
            ];
        }

        return [];
    }
}
