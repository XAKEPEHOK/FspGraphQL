<?php
/**
 * @author Timur Kasumov (aka XAKEPEHOK)
 * Datetime: 20.05.2018 0:21
 */

namespace XAKEPEHOK\FspGraphQL\Types\Filters;


use GraphQL\Type\Definition\EnumType;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class CompareFilterType extends InputObjectType
{

    public function __construct()
    {
        $config = [
            'fields' => [
                'field' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'Field for filtering',
                ],
                'comparator' => [
                    'type' => Type::nonNull(new EnumType([
                        'name' => 'Comparator',
                        'values' => [
                            'EQUALS' => [
                                'value' => '=',
                            ],
                            'GREAT_THAN' => [
                                'value' => '>',
                            ],
                            'GREAT_OR_EQUALS_THAN' => [
                                'value' => '>=',
                            ],
                            'LESS_THAN' => [
                                'value' => '<',
                            ],
                            'LESS_OR_EQUALS_THAN' => [
                                'value' => '<=',
                            ],
                        ],
                    ]))
                ],
                'value' => [
                    'type' => Type::nonNull(Type::string()),
                ],
            ]
        ];
        parent::__construct($config);
    }

}