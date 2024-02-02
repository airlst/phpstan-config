<?php

declare(strict_types=1);

namespace Airlst\PhpstanConfig;

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

    public function with(string $file): self
    {
        $this->includes[] = $file;

        return $this;
    }

    public function without(string $file): self
    {
        $key = array_search($file, $this->includes, true);

        if ($key !== false) {
            unset($this->includes[$key]);
        }

        return $this;
    }

    public function withBleedingEdge(): self
    {
        return $this->with('phar://phpstan.phar/conf/bleedingEdge.neon');
    }

    public function useCacheDir(string $cacheDir): self
    {
        $this->parameters['tmpDir'] = $cacheDir;

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

        $this->parameters['ignoreErrors'][] = $error;

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
        ];
    }
}
