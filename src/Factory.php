<?php

declare(strict_types=1);

namespace Airlst\PhpstanConfig;

use Airlst\PhpstanConfig\Phpstan\DisallowedLaravelDieDumpFunctionsRule;
use Airlst\PhpstanConfig\Phpstan\DisallowMutableDatetimeRule;

use function is_null;
use function sprintf;

class Factory
{
    /** @var array<string> */
    private array $includes = [
        'vendor/spaze/phpstan-disallowed-calls/disallowed-dangerous-calls.neon',
        'vendor/spaze/phpstan-disallowed-calls/disallowed-execution-calls.neon',
        'vendor/spaze/phpstan-disallowed-calls/disallowed-insecure-calls.neon',
        'vendor/spaze/phpstan-disallowed-calls/disallowed-loose-calls.neon',
    ];

    /** @var array<string, mixed> */
    private array $parameters = [
        'type_coverage' => [
            'return' => 100,
            'param' => 100,
            'property' => 100,
            'constant' => 100,
        ],
        'type_perfect' => [
            'null_over_false' => true,
            'no_mixed_property' => true,
            'no_mixed_caller' => true,
            'narrow_param' => true,
            'narrow_return' => true,
        ],
        'strictRules' => [
            'allRules' => false,
            'disallowedLooseComparison' => true,
            'booleansInConditions' => true,
            'uselessCast' => true,
            'requireParentConstructorCall' => true,
            'disallowedBacktick' => true,
            'disallowedEmpty' => true,
            'disallowedImplicitArrayCreation' => true,
            'disallowedShortTernary' => true,
            'overwriteVariablesWithLoop' => true,
            'closureUsesThis' => true,
            'matchingInheritedMethodNames' => true,
            'numericOperandsInArithmeticOperators' => true,
            'strictFunctionCalls' => true,
            'dynamicCallOnStaticMethod' => true,
            'switchConditionsMatchingType' => true,
            'noVariableVariables' => true,
            'strictArrayFilter' => true,
            'illegalConstructorMethodCall' => true,
        ],
        'editorUrl' => 'phpstorm://open?file=%%file%%&line=%%line%%',
        'editorUrlTitle' => '%%relFile%%:%%line%%',
        'ignoreErrors' => [],
    ];

    /** @var array<string> */
    private array $rules = [
        DisallowedLaravelDieDumpFunctionsRule::class,
        DisallowMutableDatetimeRule::class,
    ];

    /** @param array<string> $paths */
    public function __construct(array $paths)
    {
        $this->parameters['paths'] = $paths;
    }

    public function level(int $level): self
    {
        $this->parameters['level'] = $level;

        return $this;
    }

    public function include(string $file): self
    {
        $this->includes[] = $file;

        return $this;
    }

    public function exclude(string $file): self
    {
        $excluded = array_filter(
            $this->includes,
            fn (string $include): bool => $include !== $file
        );

        $this->includes = array_values($excluded);

        return $this;
    }

    public function allowDangerousCalls(): self
    {
        return $this->exclude('vendor/spaze/phpstan-disallowed-calls/disallowed-dangerous-calls.neon');
    }

    public function allowExecutionCalls(): self
    {
        return $this->exclude('vendor/spaze/phpstan-disallowed-calls/disallowed-execution-calls.neon');
    }

    public function allowInsecureCalls(): self
    {
        return $this->exclude('vendor/spaze/phpstan-disallowed-calls/disallowed-insecure-calls.neon');
    }

    public function allowLooseCalls(): self
    {
        return $this->exclude('vendor/spaze/phpstan-disallowed-calls/disallowed-loose-calls.neon');
    }

    public function typeCoverage(int $return, int $param, int $property, int $constant): self
    {
        $this->parameters['type_coverage'] = [
            'return' => $return,
            'param' => $param,
            'property' => $property,
            'constant' => $constant,
        ];

        return $this;
    }

    public function typePerfect(
        bool $nullOverFalse,
        bool $noMixedProperty,
        bool $noMixedCaller,
        bool $narrowParam,
        bool $narrowReturn
    ): self {
        $this->parameters['type_perfect'] = [
            'null_over_false' => $nullOverFalse,
            'no_mixed_property' => $noMixedProperty,
            'no_mixed_caller' => $noMixedCaller,
            'narrow_param' => $narrowParam,
            'narrow_return' => $narrowReturn,
        ];

        return $this;
    }

    public function withBleedingEdge(): self
    {
        return $this->include('phar://phpstan.phar/conf/bleedingEdge.neon');
    }

    public function useCacheDir(string $cacheDir): self
    {
        $this->parameters['tmpDir'] = $cacheDir;

        return $this;
    }

    public function addRule(string $file): self
    {
        $this->rules[] = $file;

        return $this;
    }

    public function ignoreError(
        ?string $identifier,
        ?string $message,
        ?string $path = null,
        ?int $count = null,
        ?bool $reportUnmatched = null
    ): self {
        $error = [];

        if (! is_null($identifier)) {
            $error['identifier'] = $identifier;
        }

        // Convert plain message to regex
        if (! str_starts_with($message, '#')) {
            $error['message'] = sprintf('#^%s$#', preg_quote($message, '#'));
        }

        if (! is_null($path)) {
            $error['path'] = $path;
        }

        if (! is_null($count)) {
            $error['count'] = $count;
        }
        $error['reportUnmatched'] = $reportUnmatched ?? true;

        $this->parameters['ignoreErrors'][] = $error; // @phpstan-ignore-line

        return $this;
    }

    public function strictRules(
        bool $disallowedLooseComparison = true,
        bool $requireParentConstructorCall = true,
        bool $overwriteVariablesWithLoop = true,
        bool $closureUsesThis = true,
        bool $matchingInheritedMethodNames = true,
        bool $numericOperandsInArithmeticOperators = true,
        bool $switchConditionsMatchingType = true,
        bool $noVariableVariables = true,
        bool $disallowedConstructs = true,
        bool $booleansInConditions = true,
        bool $uselessCast = true,
        bool $strictCalls = false
    ): self {
        $this->parameters['strictRules'] = [
            'disallowedLooseComparison' => $disallowedLooseComparison,
            'requireParentConstructorCall' => $requireParentConstructorCall,
            'overwriteVariablesWithLoop' => $overwriteVariablesWithLoop,
            'closureUsesThis' => $closureUsesThis,
            'matchingInheritedMethodNames' => $matchingInheritedMethodNames,
            'numericOperandsInArithmeticOperators' => $numericOperandsInArithmeticOperators,
            'switchConditionsMatchingType' => $switchConditionsMatchingType,
            'noVariableVariables' => $noVariableVariables,
            'booleansInConditions' => $booleansInConditions,
            'uselessCast' => $uselessCast,
        ];

        return $this;
    }

    /** @return array<string, mixed> */
    public function create(): array
    {
        return [
            'includes' => $this->includes,
            'parameters' => $this->parameters,
            'rules' => $this->rules,
        ];
    }
}
