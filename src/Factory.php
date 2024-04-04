<?php

declare(strict_types=1);

namespace Airlst\PhpstanConfig;

use Airlst\PhpstanConfig\Phpstan\NoDumpRule;

use function is_null;

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
            'return_type' => 100,
            'param_type' => 100,
            'property_type' => 100,
        ],
        'strictRules' => [
            'allRules' => false,
            'disallowedLooseComparison' => true,
            'requireParentConstructorCall' => true,
            'overwriteVariablesWithLoop' => true,
            'closureUsesThis' => true,
            'matchingInheritedMethodNames' => true,
            'numericOperandsInArithmeticOperators' => true,
            'switchConditionsMatchingType' => true,
            'noVariableVariables' => true,
            'disallowedConstructs' => true,
            'booleansInConditions' => true,
            'uselessCast' => true,
            'strictCalls' => false,
        ],
        'editorUrl' => 'phpstorm://open?file=%%file%%&line=%%line%%',
        'editorUrlTitle' => '%%relFile%%:%%line%%',
        'ignoreErrors' => [],
    ];

    /** @var array<string> */
    private array $rules = [
        NoDumpRule::class,
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

    public function typeCoverage(int $returnType, int $paramType, int $propertyType): self
    {
        $this->parameters['type_coverage'] = [
            'return_type' => $returnType,
            'param_type' => $paramType,
            'property_type' => $propertyType,
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
        string $message,
        ?string $path = null,
        ?int $count = null,
        ?bool $reportUnmatched = null
    ): self {
        // Convert plain message to regex
        if (! str_starts_with($message, '#')) {
            $message = sprintf('#^%s$#', preg_quote($message, '#'));
        }

        $error = ['message' => $message];

        if (! is_null($path)) {
            $error['path'] = $path;
        }
        if (! is_null($count)) {
            $error['count'] = $count;
        }
        if (! is_null($reportUnmatched)) {
            $error['reportUnmatched'] = $reportUnmatched;
        }

        $this->parameters['ignoreErrors'][] = $error; // @phpstan-ignore-line

        return $this;
    }

    public function checkMissingIterableValueType(bool $enable = true): self
    {
        $this->parameters['checkMissingIterableValueType'] = $enable;

        return $this;
    }

    public function checkGenericClassInNonGenericObjectType(bool $enable = true): self
    {
        $this->parameters['checkGenericClassInNonGenericObjectType'] = $enable;

        return $this;
    }

    public function reportMaybesInMethodSignatures(bool $enable = true): self
    {
        $this->parameters['reportMaybesInMethodSignatures'] = $enable;

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
            'disallowedConstructs' => $disallowedConstructs,
            'booleansInConditions' => $booleansInConditions,
            'uselessCast' => $uselessCast,
            'strictCalls' => $strictCalls,
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
