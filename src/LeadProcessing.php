<?php declare(strict_types=1);

namespace LeadHandler;

use LeadGenerator\Lead;
use LeadHandler\Contracts\LeadProcessingInterface;

class LeadProcessing implements LeadProcessingInterface
{
    private string $fileName    = 'leads.txt';
    private string $storageDir  = 'storage';

    public function process(Lead $lead): void
    {
        $this->toFile(
            sprintf('%s|%s|%s%s', $lead->id, $lead->categoryName, $this->datatime(), PHP_EOL)
        );
    }

    public static function factory(): self
    {
        return new static();
    }

    private function toFile(string $line): self
    {
        file_put_contents($this->filePath(), $line, FILE_APPEND);
        return $this;
    }

    private function filePath(): string
    {
        return dirname(__DIR__)
            . DIRECTORY_SEPARATOR
            . $this->storageDir
            . DIRECTORY_SEPARATOR
            . $this->fileName;
    }


    private function datatime(): string
    {
        $datatime = new \DateTime();
        return $datatime->format('Y-m-d h:i:s');
    }
}
