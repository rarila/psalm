<?php

declare(strict_types=1);

namespace Psalm\Storage\Assertion;

use Psalm\Storage\Assertion;
use UnexpectedValueException;

/**
 * @psalm-immutable
 */
final class HasArrayKey extends Assertion
{
    public function __construct(public readonly string $key)
    {
    }

    public function getNegation(): Assertion
    {
        throw new UnexpectedValueException('This should never be called');
    }

    public function __toString(): string
    {
        return 'has-array-key-' . $this->key;
    }

    public function isNegationOf(Assertion $assertion): bool
    {
        return false;
    }
}
