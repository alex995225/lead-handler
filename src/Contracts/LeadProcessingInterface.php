<?php declare(strict_types=1);

namespace LeadHandler\Contracts;

use LeadGenerator\Lead;

interface LeadProcessingInterface
{
    public static function factory(): static;
    public function process(Lead $lead): void;
}
