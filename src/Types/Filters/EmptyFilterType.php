<?php
/**
 * @author Timur Kasumov (aka XAKEPEHOK)
 * Datetime: 20.05.2018 0:25
 */

namespace XAKEPEHOK\FspGraphQL\Types\Filters;


use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class EmptyFilterType extends InputObjectType
{

    public function __construct()
    {
        $config = [
            'fields' => [
                'field' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'Field for filtering',
                ],
                'empty' => [
                    'type' => Type::nonNull(Type::boolean()),
                    'description' => 'Should be field empty or not'
                ],
            ],
        ];
        parent::__construct($config);
    }

}