<?php

namespace App\ElasticSearch;

/**
 * Class ElasticaUtils
 * @package App\ElasticSearch
 */
class ElasticaUtils
{
    /**
     * @param string $table
     * @param array $result
     * @return array
     */
    public static function formatSearch(string $table, array $result): array
    {
        $return = [
            'total' => $result['hits']['total'] ?? ["value" => 0],
            $table => []
        ];
        if(count($result) !== 0) {
            foreach ($result['hits']['hits'] as $row) $return[$table][] = $row['_source'];
        }
        return $return;
    }
}