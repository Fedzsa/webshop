<?php


namespace App\Helpers\Database;


class MySQLQueryHelper
{
    public const wildcards = ['*'];

    public static function generateFullTextSearchQuery(string $table, array $columns) {
        return "SELECT * FROM ".$table." WHERE ".self::generateFullTextSearchQueryPart($columns);
    }

    public static function generateFullTextSearchQueryPart(array $columns) {
        $columnString = implode(",", $columns);
        return "MATCH(".$columnString.") AGAINST(? IN BOOLEAN MODE)";
    }
}
