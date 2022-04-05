<?php

namespace App\Helpers;

class CsvHelper
{
    private $url;

    private $delimiter;

    public function __construct(string $url, string $delimiter = ';')
    {
        $this->url = $url;
        $this->delimiter = $delimiter;
    }

    /**
     * @param bool $transliteKeys
     * @return array
     */
    public function toAssocArray($transliteKeys = true): array
    {
        if (($handle = fopen($this->url, "r")) !== FALSE) {
            while (($data[] = fgetcsv($handle, 0, $this->delimiter)) !== FALSE) {}
            fclose($handle);
        }

        $headers = array_shift($data);

        if (true === $transliteKeys) {
            foreach ($headers as $key => $header) {
                $headers[$key] = Translit::translit($header);
            }
        }


        $csv  = [];
        foreach(array_filter($data) as $row) {
            $csv[] = array_combine($headers, $row);
        }

        return $csv;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $rows = array_map(function(string $row) {
            return str_getcsv($row, $this->delimiter);
        }, file($this->url));


        array_shift($rows);

        return $rows;
    }
}
