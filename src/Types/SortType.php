<?php
/**
 * @author Timur Kasumov (aka XAKEPEHOK)
 * Datetime: 19.05.2018 21:49
 */

namespace XAKEPEHOK\FspGraphQL\Types;


use GraphQL\Type\Definition\EnumType;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class SortType extends InputObjectType
{

    public function __construct()
    {
        $config = [
            'description' => 'Sorting by one or more fields',
            'fields' => [
                'by' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'Field name, which used for sorting',
                ],
                'direction' => [
                    'type' => Type::nonNull(new EnumType([
                        'name' => 'SortDirection',
                        'values' => [
                            'ASC' => [
                                'value' => 1,
                            ],
                            'DESC' => [
                                'value' => -1,
                            ],
                        ],
                    ])),
                    'description' => 'Sort direction'
                ],
            ],
        ];
        parent::__construct($config);
    }

}