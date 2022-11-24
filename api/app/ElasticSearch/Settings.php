<?php


namespace App\ElasticSearch;

/**
 * Class Settings
 * @package App\ElasticSearch
 */
class Settings
{
    private string $index;

    /**
     * Settings constructor.
     * @param string $index
     */
    public function __construct(string $index)
    {
        $this->index = $index;
    }

    /**
     * @return string
     */
    public function getIndex(): string {
        return $this->index;
    }
}