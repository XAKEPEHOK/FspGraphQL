<?php
/**
 * Created for LeadVertex 2.0.
 * Datetime: 21.05.2018 11:16
 * @author Timur Kasumov aka XAKEPEHOK
 */

namespace XAKEPEHOK\FspGraphQL\Types\Filters;


use GraphQL\Type\Definition\InputObjectType;
use XAKEPEHOK\FspGraphQL\Types\FspTypes;

class GroupFilterType extends InputObjectType
{

    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'and' => [
                        'type' => FspTypes::andGroup(),
                    ],
                    'or' => [
                        'type' => FspTypes::orGroup(),
                    ],
                    'between' => [
                        'type' => FspTypes::between(),
                    ],
                    'compare' => [
                        'type' => FspTypes::compare(),
                    ],
                    'empty' => [
                        'type' => FspTypes::empty(),
                    ],
                    'equals' => [
                        'type' => FspTypes::equals(),
                    ],
                    'fulltextSearch' => [
                        'type' => FspTypes::fulltextSearch(),
                    ],
                    'in' => [
                        'type' => FspTypes::in(),
                    ],
                    'wildcard' => [
                        'type' => FspTypes::wildcard(),
                    ],
                    'notBetween' => [
                        'type' => FspTypes::notBetween(),
                    ],
                    'notEquals' => [
                        'type' => FspTypes::notEquals(),
                    ],
                    'notIn' => [
                        'type' => FspTypes::notIn(),
                    ],
                    'notWildcard' => [
                        'type' => FspTypes::notWildcard(),
                    ],
                ];
            },
        ];
        parent::__construct($config);
    }

}