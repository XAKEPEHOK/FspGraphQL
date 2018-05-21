<?php
/**
 * @author Timur Kasumov (aka XAKEPEHOK)
 * Datetime: 19.05.2018 21:30
 */

namespace XAKEPEHOK\FspGraphQL\Types;


use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class PaginateType extends InputObjectType
{

    public function __construct()
    {
        $config = [
            'description' => 'Split data to pages',
            'fields' => function() {
                return [
                    'number' => [
                        'type' => Type::int(),
                        'description' => 'Page number',
                        'defaultValue' => 1,
                    ],
                    'size' => [
                        'type' => Type::int(),
                        'description' => 'Page size',
                        'defaultValue' => 50,
                    ],
                ];
            },
        ];
        parent::__construct($config);
    }

}