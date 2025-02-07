<?php

declare(strict_types=1);

namespace Psalm\Plugin\EventHandler\Event;

use PhpParser;
use Psalm\CodeLocation;
use Psalm\Context;
use Psalm\StatementsSource;
use Psalm\Type\Union;

final class MethodReturnTypeProviderEvent
{
    private StatementsSource $source;
    private string $fq_classlike_name;
    /**
     * @var lowercase-string
     */
    private string $method_name_lowercase;
    private Context $context;
    private CodeLocation $code_location;
    private PhpParser\Node\Expr\MethodCall|PhpParser\Node\Expr\StaticCall $stmt;
    /** @var non-empty-list<Union>|null */
    private ?array $template_type_parameters;
    private ?string $called_fq_classlike_name;
    /**
     * @var lowercase-string|null
     */
    private ?string $called_method_name_lowercase;

    /**
     * Use this hook for providing custom return type logic. If this plugin does not know what a method should return
     * but another plugin may be able to determine the type, return null. Otherwise return a mixed union type if
     * something should be returned, but can't be more specific.
     *
     * @param non-empty-list<Union>|null $template_type_parameters
     * @param lowercase-string $method_name_lowercase
     * @param lowercase-string $called_method_name_lowercase
     * @internal
     */
    public function __construct(
        StatementsSource $source,
        string $fq_classlike_name,
        string $method_name_lowercase,
        PhpParser\Node\Expr\MethodCall|PhpParser\Node\Expr\StaticCall $stmt,
        Context $context,
        CodeLocation $code_location,
        ?array $template_type_parameters = null,
        ?string $called_fq_classlike_name = null,
        ?string $called_method_name_lowercase = null,
    ) {
        $this->source = $source;
        $this->fq_classlike_name = $fq_classlike_name;
        $this->method_name_lowercase = $method_name_lowercase;
        $this->context = $context;
        $this->code_location = $code_location;
        $this->stmt = $stmt;
        $this->template_type_parameters = $template_type_parameters;
        $this->called_fq_classlike_name = $called_fq_classlike_name;
        $this->called_method_name_lowercase = $called_method_name_lowercase;
    }

    public function getSource(): StatementsSource
    {
        return $this->source;
    }

    public function getFqClasslikeName(): string
    {
        return $this->fq_classlike_name;
    }

    /**
     * @return lowercase-string
     */
    public function getMethodNameLowercase(): string
    {
        return $this->method_name_lowercase;
    }

    /**
     * @return list<PhpParser\Node\Arg>
     */
    public function getCallArgs(): array
    {
        return $this->stmt->getArgs();
    }

    public function getContext(): Context
    {
        return $this->context;
    }

    public function getCodeLocation(): CodeLocation
    {
        return $this->code_location;
    }

    /**
     * @return non-empty-list<Union>|null
     */
    public function getTemplateTypeParameters(): ?array
    {
        return $this->template_type_parameters;
    }

    public function getCalledFqClasslikeName(): ?string
    {
        return $this->called_fq_classlike_name;
    }

    /**
     * @return lowercase-string|null
     */
    public function getCalledMethodNameLowercase(): ?string
    {
        return $this->called_method_name_lowercase;
    }

    public function getStmt(): PhpParser\Node\Expr\MethodCall|PhpParser\Node\Expr\StaticCall
    {
        return $this->stmt;
    }
}
