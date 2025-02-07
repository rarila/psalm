<?php

declare(strict_types=1);

namespace Psalm\Plugin\EventHandler\Event;

use Psalm\CodeLocation;
use Psalm\Codebase;
use Psalm\FileManipulation;
use Psalm\StatementsSource;

final class AfterClassLikeExistenceCheckEvent
{
    private string $fq_class_name;
    private CodeLocation $code_location;
    private StatementsSource $statements_source;
    private Codebase $codebase;
    /**
     * @var FileManipulation[]
     */
    private array $file_replacements;

    /**
     * @param FileManipulation[] $file_replacements
     * @internal
     */
    public function __construct(
        string $fq_class_name,
        CodeLocation $code_location,
        StatementsSource $statements_source,
        Codebase $codebase,
        array $file_replacements = [],
    ) {
        $this->fq_class_name = $fq_class_name;
        $this->code_location = $code_location;
        $this->statements_source = $statements_source;
        $this->codebase = $codebase;
        $this->file_replacements = $file_replacements;
    }

    public function getFqClassName(): string
    {
        return $this->fq_class_name;
    }

    public function getCodeLocation(): CodeLocation
    {
        return $this->code_location;
    }

    public function getStatementsSource(): StatementsSource
    {
        return $this->statements_source;
    }

    public function getCodebase(): Codebase
    {
        return $this->codebase;
    }

    /**
     * @return FileManipulation[]
     */
    public function getFileReplacements(): array
    {
        return $this->file_replacements;
    }

    /**
     * @param FileManipulation[] $file_replacements
     */
    public function setFileReplacements(array $file_replacements): void
    {
        $this->file_replacements = $file_replacements;
    }
}
