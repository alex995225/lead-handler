<?php declare(strict_types=1);

namespace LeadProcessing\Contracts;

use LeadGenerator\Lead;

interface LeadProcessingInterface
{
    public static function factory(): static;
    public function process(Lead $lead): void;
}
