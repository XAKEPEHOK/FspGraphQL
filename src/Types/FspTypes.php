<?php
/**
 * Created for LeadVertex 2.0.
 * Datetime: 21.05.2018 11:04
 * @author Timur Kasumov aka XAKEPEHOK
 */

namespace XAKEPEHOK\FspGraphQL\Types;


use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use XAKEPEHOK\FspGraphQL\Types\Filters\AndFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\BetweenFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\CompareFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\EmptyFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\EqualsFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\FulltextSearchFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\InFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\NotBetweenFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\NotEqualsFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\NotInFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\NotWildcardFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\OrFilterType;
use XAKEPEHOK\FspGraphQL\Types\Filters\WildcardFilterType;

class FspTypes
{

    private static $types;

    public static function andGroup(): ListOfType
    {
        return Type::listOf(self::get(AndFilterType::class));
    }

    public static function orGroup(): ListOfType
    {
        return Type::listOf(self::get(OrFilterType::class));
    }

    public static function between(): BetweenFilterType
    {
        return self::get(BetweenFilterType::class);
    }

    public static function compare(): CompareFilterType
    {
        return self::get(CompareFilterType::class);
    }

    public static function empty(): EmptyFilterType
    {
        return self::get(EmptyFilterType::class);
    }

    public static function equals(): EqualsFilterType
    {
        return self::get(EqualsFilterType::class);
    }

    public static function fulltextSearch(): FulltextSearchFilterType
    {
        return self::get(FulltextSearchFilterType::class);
    }

    public static function in(): InFilterType
    {
        return self::get(InFilterType::class);
    }

    public static function wildcard(): WildcardFilterType
    {
        return self::get(WildcardFilterType::class);
    }

    public static function notBetween(): NotBetweenFilterType
    {
        return self::get(NotBetweenFilterType::class);
    }

    public static function notEquals(): NotEqualsFilterType
    {
        return self::get(NotEqualsFilterType::class);
    }

    public static function notIn(): NotInFilterType
    {
        return self::get(NotInFilterType::class);
    }

    public static function notWildcard(): NotWildcardFilterType
    {
        return self::get(NotWildcardFilterType::class);
    }

    private static function get(string $class)
    {
        if (!isset(self::$types[$class])) {
            self::$types[$class] = new $class();
        }
        return self::$types[$class];
    }

}