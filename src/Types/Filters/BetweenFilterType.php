<?php
/**
 * @author Timur Kasumov (aka XAKEPEHOK)
 * Datetime: 19.05.2018 22:56
 */

namespace XAKEPEHOK\FspGraphQL\Types\Filters;


use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class BetweenFilterType extends InputObjectType
{

    public function __construct()
    {
        $config = [
            'description' => 'Filtering values where field within the range of min and max (inclusive)',
            'fields' => [
                'field' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'Field for filtering',
                ],
                'min' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'Min value (inclusive)',
                ],
                'max' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'Max value (inclusive)',
                ],
            ],
        ];
        parent::__construct($config);
    }

}