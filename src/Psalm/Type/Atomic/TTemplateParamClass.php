<?php

declare(strict_types=1);

namespace Psalm\Type\Atomic;

/**
 * Denotes a `class-string` corresponding to a template parameter previously specified in a `@template` tag.
 *
 * @psalm-immutable
 */
final class TTemplateParamClass extends TClassString
{
    public string $param_name;

    public string $defining_class;

    public function __construct(
        string $param_name,
        string $as,
        ?TNamedObject $as_type,
        string $defining_class,
        bool $from_docblock = false,
    ) {
        $this->param_name = $param_name;
        $this->defining_class = $defining_class;
        parent::__construct(
            $as,
            $as_type,
            false,
            false,
            false,
            $from_docblock,
        );
    }

    public function getKey(bool $include_extra = true): string
    {
        return 'class-string<' . $this->param_name . '>';
    }

    public function getId(bool $exact = true, bool $nested = false): string
    {
        return 'class-string<' . $this->param_name . ':' . $this->defining_class
            . ' as ' . ($this->as_type ? $this->as_type->getId($exact) : $this->as) . '>';
    }

    public function getAssertionString(): string
    {
        return 'class-string<' . $this->param_name . '>';
    }

    /**
     * @param  array<lowercase-string, string> $aliased_classes
     */
    public function toNamespacedString(
        ?string $namespace,
        array $aliased_classes,
        ?string $this_class,
        bool $use_phpdoc_format,
    ): string {
        return $this->param_name . '::class';
    }
}
