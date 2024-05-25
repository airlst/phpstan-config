<?php

declare(strict_types=1);

namespace Airlst\PhpstanConfig\Phpstan;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

use function in_array;

class DisallowedLaravelHelperMethodsRule implements Rule // @phpstan-ignore-line
{
    private const DISALLOWED_METHODS = [
        'dd',
        'dump',
        'blank',
        'abort_if',
        'abort_unless',
        'throw_if',
        'throw_unless',
        'report_if',
        'report_unless',
    ];

    public function getNodeType(): string
    {
        return FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (! $node instanceof FuncCall) {
            return [];
        }

        $functionName = $node->name->getParts()[0]; // @phpstan-ignore-line

        if (! in_array($functionName, self::DISALLOWED_METHODS, true)) {
            return [];
        }

        return [
            RuleErrorBuilder::message("Disallowed `{$functionName}` function usage!")
                ->identifier('disallowedLaravelFunctions.' . lcfirst(str_replace('_', '', ucwords($functionName, '_'))))
                ->build(),
        ];
    }
}
