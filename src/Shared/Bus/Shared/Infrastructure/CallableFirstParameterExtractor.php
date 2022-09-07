<?php

declare(strict_types=1);

namespace Code\Shared\Bus\Shared\Infrastructure;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reindex;

final class CallableFirstParameterExtractor
{
    public static function forCallables(iterable $callables): array
    {
        return map(self::unflatten(), reindex(self::classExtractor(new self()), $callables));
    }

    private static function classExtractor(CallableFirstParameterExtractor $parameterExtractor): callable
    {
        return static function (callable $handler) use ($parameterExtractor): ?string {
            return $parameterExtractor->extract($handler);
        };
    }

    private static function unflatten(): callable
    {
        return static function ($value) {
            return [$value];
        };
    }

    /**
     * @throws ReflectionException
     */
    public function extract($class): ?string
    {
        $reflector = new ReflectionClass($class);
        $method    = $reflector->getMethod('__invoke');

        if ($this->hasOnlyOneParameter($method)) {
            return $this->firstParameterClassFrom($method);
        }

        return null;
    }

    private function firstParameterClassFrom(ReflectionMethod $method): string
    {
        return $method->getParameters()[0]->getType()->getName();
    }

    private function hasOnlyOneParameter(ReflectionMethod $method): bool
    {
        return $method->getNumberOfParameters() === 1;
    }
}