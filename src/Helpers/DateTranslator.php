<?php

namespace App\Helpers;

use DateTimeInterface;

/**
 * Хелпер для преобразования дат
 */
class DateTranslator
{
    /**
     * Перевод названий месяцев
     */
    private const RUS_MONTHS = [
        'January' => 'января',
        'February' => 'февраля',
        'March' => 'марта',
        'April' => 'апреля',
        'May' => 'мая',
        'June' => 'июня',
        'July' => 'июля',
        'August' => 'августа',
        'September' => 'сентября',
        'October' => 'октября',
        'November' => 'ноября',
        'December' => 'декабря',
    ];

    /**
     * @param DateTimeInterface $dateTime
     * @param string            $format
     *
     * @return string
     */
    public static function getRusTranslate(DateTimeInterface $dateTime, string $format): string
    {
        $newFormat = str_replace(
            'F',
            self::RUS_MONTHS[$dateTime->format('F')],
            $format
        );

        return $dateTime->format($newFormat);
    }
}
