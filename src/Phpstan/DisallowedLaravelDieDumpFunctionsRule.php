<?php

declare(strict_types=1);

namespace Airlst\PhpstanConfig\Phpstan;

use Override;
use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

use function in_array;

class DisallowedLaravelDieDumpFunctionsRule implements Rule // @phpstan-ignore-line
{
    private const array DISALLOWED_METHODS = [
        'dd',
        'dump',
    ];

    #[Override]
    public function getNodeType(): string
    {
        return FuncCall::class;
    }

    #[Override]
    public function processNode(Node $node, Scope $scope): array
    {
        if (! $node instanceof FuncCall) {
            return [];
        }

        $functionName = $node->name->parts[0]; // @phpstan-ignore-line

        if (! in_array($functionName, self::DISALLOWED_METHODS, true)) {
            return [];
        }

        return [
            RuleErrorBuilder::message("Disallowed `{$functionName}` function usage!")
                ->identifier("disallowedLaravelFunctions.{$functionName}")
                ->build(),
        ];
    }
}
