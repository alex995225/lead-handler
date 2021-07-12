<?php declare(strict_types=1);

namespace LeadProcessing\Contracts;

use Spatie\Async\PoolStatus;

interface LeadHandlerInterface
{
    public function run(int $limit): PoolStatus;
}
