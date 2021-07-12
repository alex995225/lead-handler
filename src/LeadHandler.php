<?php declare(strict_types=1);

namespace LeadHandler;

use LeadGenerator\Generator;
use LeadGenerator\Lead;
use LeadHandler\Contracts\LeadHandlerInterface;
use Spatie\Async\Pool;
use Spatie\Async\PoolStatus;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class LeadHandler implements LeadHandlerInterface
{
    private Generator $generator;
    private Pool $pool;

    private int $timeout;
    private int $concurrency = 50;

    public function __construct(int $timeout)
    {
        $this->timeout      = $timeout;
        $this->generator    = new Generator;
        $this->pool         = $this->pool();
    }

    public function run(int $limit): PoolStatus
    {
        $this->progress($limit);

        $this->generator->generateLeads($limit, fn (Lead $lead) => $this->leadProcessing($lead));

        $this->pool->wait();

        $this->progress->finish();

        return $this->pool->status();
    }

    private function leadProcessing(Lead $lead): void
    {
        $this->pool->add(function () use ($lead) {
                LeadProcessing::factory()->process($lead);
            })
            ->catch(function (\Throwable $exception) {});

        $this->progress->advance();

        sleep($this->timeout);
    }

    private function pool(): Pool
    {
        $pool = Pool::create();
        $pool->concurrency($this->concurrency);

        return $pool;
    }

    private function progress(int $limit)
    {
        $this->progress = new ProgressBar(new ConsoleOutput, $limit);
    }
}
