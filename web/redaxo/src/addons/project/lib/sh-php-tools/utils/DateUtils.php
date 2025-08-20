<?php

class DateUtils
{
    public static function dateTimeToSqlDate(DateTime $dateTime): string
    {
        return date_format($dateTime, 'Y-m-d H:i:s');
    }

    public static function dateTimeToSchemaOrgDateTime(DateTime $dateTime): string
    {
        return date_format($dateTime, 'Y-m-d\TH:i');
    }
}