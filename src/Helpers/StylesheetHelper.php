<?php

namespace App\Helpers;

use InvalidArgumentException;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class StylesheetHelper
{
    public const XLSX = 'xlsx';

    public const SUPPORTED_FORMATS = [
        self::XLSX,
    ];

    /**
     * @param string $filepath
     *
     * @param string $originalExtension
     * @param bool $translit
     * @return array
     */
    public static function toAssosiativeArray(string $filepath, string $originalExtension, bool $translit = true): array
    {
        if (!in_array($originalExtension,self::SUPPORTED_FORMATS)) {
            throw new InvalidArgumentException("формат $originalExtension неподдерживается");
        }

        if ($originalExtension === self::XLSX) {
            $reader = new Xlsx();

            $data = $reader
                ->load($filepath)
                ->getActiveSheet()
                ->toArray();

            $headers = array_shift($data);

            if ($translit === true) {
                $headers  = array_map(function(string $value) {
                    return Translit::translit($value);
                }, $headers);
            }

            $result = [];
            foreach ($data as $row) {
                $result[] = array_combine($headers, $row);
            }

            return $result;
        }
    }
}