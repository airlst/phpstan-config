<?php

declare(strict_types=1);

namespace Airlst\PhpstanConfig\Phpstan;

use DateTime;
use Override;
use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

use function in_array;

class DisallowMutableDatetimeRule implements Rule // @phpstan-ignore-line
{
    private const array DISALLOWED_CLASSES = [
        DateTime::class,
        'Carbon\Carbon',
    ];

    #[Override]
    public function getNodeType(): string
    {
        return Node::class;
    }

    #[Override]
    public function processNode(Node $node, Scope $scope): array
    {
        $errors = [];

        // Check for instantiation or static method calls of the disallowed class
        if (($node instanceof Node\Expr\New_ || $node instanceof Node\Expr\StaticCall) && $node->class instanceof Node\Name) {
            $className = $scope->resolveName($node->class);

            if (in_array($className, self::DISALLOWED_CLASSES, true)) {
                $errors[] = RuleErrorBuilder::message(
                    sprintf('Instantiation of class %s is disallowed. Use immutable DateTime instead.', $className)
                )->identifier('disallowMutableDatetime')->build();
            }
        }

        return $errors;
    }
}
