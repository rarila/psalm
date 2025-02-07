<?php

declare(strict_types=1);

namespace Psalm\Plugin\EventHandler\Event;

use PhpParser\Node\Expr;
use Psalm\Codebase;
use Psalm\Context;
use Psalm\StatementsSource;

final class AddRemoveTaintsEvent
{
    private Expr $expr;
    private Context $context;
    private StatementsSource $statements_source;
    private Codebase $codebase;

    /**
     * Called after an expression has been checked
     *
     * @internal
     */
    public function __construct(
        Expr $expr,
        Context $context,
        StatementsSource $statements_source,
        Codebase $codebase,
    ) {
        $this->expr = $expr;
        $this->context = $context;
        $this->statements_source = $statements_source;
        $this->codebase = $codebase;
    }

    public function getExpr(): Expr
    {
        return $this->expr;
    }

    public function getContext(): Context
    {
        return $this->context;
    }

    public function getStatementsSource(): StatementsSource
    {
        return $this->statements_source;
    }

    public function getCodebase(): Codebase
    {
        return $this->codebase;
    }
}
