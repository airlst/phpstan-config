<?php

declare(strict_types=1);

namespace Airlst\PhpstanConfig;

use Airlst\RectorConfig\Phpstan\NoDumpRule;

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
