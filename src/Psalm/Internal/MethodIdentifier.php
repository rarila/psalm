<?php

declare(strict_types=1);

namespace Psalm\Internal;

use InvalidArgumentException;
use Psalm\Storage\ImmutableNonCloneableTrait;

use function explode;
use function is_string;
use function ltrim;
use function strpos;
use function strtolower;

/**
 * @psalm-immutable
 * @internal
 */
final class MethodIdentifier
{
    use ImmutableNonCloneableTrait;

    public string $fq_class_name;
    /** @var lowercase-string  */
    public string $method_name;

    /**
     * @param lowercase-string $method_name
     */
    public function __construct(string $fq_class_name, string $method_name)
    {
        $this->fq_class_name = $fq_class_name;
        $this->method_name = $method_name;
    }

    /**
     * Takes any valid reference to a method id and converts
     * it into a MethodIdentifier
     *
     * @psalm-pure
     */
    public static function wrap(string|MethodIdentifier $method_id): self
    {
        return is_string($method_id) ? static::fromMethodIdReference($method_id) : $method_id;
    }

    /**
     * @psalm-pure
     */
    public static function isValidMethodIdReference(string $method_id): bool
    {
        return strpos($method_id, '::') !== false;
    }

    /**
     * @psalm-pure
     */
    public static function fromMethodIdReference(string $method_id): self
    {
        if (!static::isValidMethodIdReference($method_id)) {
            throw new InvalidArgumentException('Invalid method id reference provided: ' . $method_id);
        }
        // remove leading backslash if it exists
        $method_id = ltrim($method_id, '\\');
        $method_id_parts = explode('::', $method_id);
        return new self($method_id_parts[0], strtolower($method_id_parts[1]));
    }

    /** @return non-empty-string */
    public function __toString(): string
    {
        return $this->fq_class_name . '::' . $this->method_name;
    }
}
