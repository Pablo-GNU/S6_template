<?php

declare(strict_types=1);

namespace Code\Shared;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use JsonException;
use ReflectionClass;
use RuntimeException;

use function Lambdish\Phunctional\filter;

final class Utils
{
    public static function endsWith(string $needle, string $haystack): bool
    {
        $length = \strlen($needle);

        if (0 === $length) {
            return true;
        }

        return \substr($haystack, -$length) === $needle;
    }

    public static function dateToString(DateTimeInterface $date): string
    {
        return $date->format(DateTimeInterface::ATOM);
    }

    /**
     * @throws Exception
     */
    public static function stringToDate(string $date): DateTimeImmutable
    {
        return new DateTimeImmutable($date);
    }

    /**
     * @throws JsonException
     */
    public static function jsonEncode(array $values): string
    {
        return \json_encode($values, JSON_THROW_ON_ERROR);
    }

    public static function jsonDecode(string $json): array
    {
        $data = \json_decode($json, true);

        if (JSON_ERROR_NONE !== \json_last_error()) {
            throw new RuntimeException('Unable to parse response body into JSON: ' . \json_last_error());
        }

        return $data;
    }

    public static function toSnakeCase(string $text): string
    {
        return \ctype_lower($text) ? $text : \strtolower((string) \preg_replace('/([^A-Z\s])([A-Z])/', '$1_$2', $text));
    }

    public static function toCamelCase(string $text): string
    {
        return \lcfirst(\str_replace('_', '', \ucwords($text, '_')));
    }

    public static function dot(array $array, string $prepend = ''): array
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (\is_array($value) && !empty($value)) {
                $results = \array_merge($results, Utils::dot($value, $prepend . $key . '.'));
            } else {
                $results[$prepend . $key] = $value;
            }
        }

        return $results;
    }

    public static function filesIn(string $path, string $fileType): array
    {
        return filter(
            static fn (string $possibleModule) => \strstr($possibleModule, $fileType),
            \scandir($path)
        );
    }

    public static function extractClassName(object $object): string
    {
        $reflect = new ReflectionClass($object);

        return $reflect->getShortName();
    }

    public static function iterableToArray(iterable $iterable): array
    {
        if (\is_array($iterable)) {
            return $iterable;
        }

        return \iterator_to_array($iterable);
    }
}
